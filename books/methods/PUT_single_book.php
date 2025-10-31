<?php
// 1. Validate book exists
$book = ensureExists("books");
$book_id = $book["id"];

// 2. Parse incoming data (from PUT)
parse_str(file_get_contents("php://input"), $body);

// 3. Check required fields
$requiredFields = ["title", "year", "description", "pages", "frontpage_img", "main_genre", "status_id", "author_name"];
$missingFields = array_filter($requiredFields, fn($field) => empty($body[$field]));

if (!empty($missingFields)) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing information in field(s)",
        "fields" => $missingFields
    ]);
    exit;
}

// 4. Check if author exists or insert
$sql_check_author = "SELECT id FROM authors WHERE LOWER(TRIM(name)) = LOWER(TRIM(:author_name))";
$stmt = $conn->prepare($sql_check_author);
bindField($stmt, ["author_name", $body["author_name"]]);
$stmt->execute();
$author = $stmt->fetch(PDO::FETCH_ASSOC);

$author_id = $author ? $author["id"] : null;
if (!$author_id) {
    $sql_insert_author = "INSERT INTO authors (name) VALUES (:author_name)";
    $stmt = $conn->prepare($sql_insert_author);
    bindField($stmt, ["author_name", $body["author_name"]]);
    $stmt->execute();
    $author_id = $conn->lastInsertId();
}

// 5. Update main book record
$sql_update_book = "UPDATE books SET 
    title = :title,
    year = :year,
    description = :description,
    pages = :pages,
    frontpage_img = :frontpage_img,
    main_genre_id = :main_genre_id,
    status_id = :status_id
WHERE id = :id";

$stmt = $conn->prepare($sql_update_book);
bindField($stmt, ["id", $book_id], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["title", $body["title"]]);
bindField($stmt, ["year", $body["year"]], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["description", $body["description"]]);
bindField($stmt, ["pages", $body["pages"]], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["frontpage_img", $body["frontpage_img"]]);
bindField($stmt, ["main_genre_id", $body["main_genre"]], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["status_id", $body["status_id"]], ["type" => PDO::PARAM_INT]);
$stmt->execute();

// 6. Update author link (replace existing)
$sql_link_author = "REPLACE INTO book_authors (book_id, author_id) VALUES (:book_id, :author_id)";
$stmt = $conn->prepare($sql_link_author);
$stmt->bindValue(":book_id", $book_id, PDO::PARAM_INT);
$stmt->bindValue(":author_id", $author_id, PDO::PARAM_INT);
$stmt->execute();

// 7. Update sub-genres
$sql_delete_genres = "DELETE FROM book_genres WHERE book_id = :book_id";
$stmt = $conn->prepare($sql_delete_genres);
$stmt->bindValue(":book_id", $book_id, PDO::PARAM_INT);
$stmt->execute();

if (!empty($body['sub_genre_ids']) && is_array($body['sub_genre_ids'])) {
    $sql_link_genre = "INSERT INTO book_genres (book_id, genre_id) VALUES (:book_id, :genre_id)";
    $stmt = $conn->prepare($sql_link_genre);
    foreach ($body['sub_genre_ids'] as $genre_id) {
        if (!is_numeric($genre_id)) continue;
        $stmt->bindValue(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->bindValue(":genre_id", (int)$genre_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// 8. Return response
header("Content-Type: application/json; charset=utf-8");
http_response_code(200);

$updatedBook = ensureExists('books');
echo json_encode([
    "message" => "Book updated successfully",
    "data" => $updatedBook['data']
]);