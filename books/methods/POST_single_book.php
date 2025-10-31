<?php
// 1. Check if author exists
$sql_check_author = "SELECT id FROM authors WHERE LOWER(TRIM(name)) = LOWER(TRIM(:author_name))";
$stmt = $conn->prepare($sql_check_author);
bindField($stmt, ["author_name"]);
$stmt->execute();
$author = $stmt->fetch(PDO::FETCH_ASSOC);

if ($author) {
    $author_id = $author['id'];
} else {
    // Insert new author
    $sql_insert_author = "INSERT INTO authors (name) VALUES (:author_name)";
    $stmt = $conn->prepare($sql_insert_author);
    bindField($stmt, ["author_name"]);
    $stmt->execute();
    $author_id = $conn->lastInsertId();
}

// 2. Insert new book
$sql_insert_book = "INSERT INTO books (
    title, year, description, pages, frontpage_img, main_genre_id, status_id
) VALUES (
    :title, :year, :description, :pages, :frontpage_img, :main_genre_id, :status_id
)";
$stmt = $conn->prepare($sql_insert_book);
bindField($stmt, ["title"]);
bindField($stmt, ["year"], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["description"]);
bindField($stmt, ["pages"], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["frontpage_img"]);

// **Fix main genre binding**
// Map $_POST['main_genre'] → :main_genre_id
$_POST['main_genre_id'] = $_POST['main_genre'] ?? null;
bindField($stmt, ["main_genre_id"], ["type" => PDO::PARAM_INT]);

bindField($stmt, ["status_id"], ["type" => PDO::PARAM_INT]);
$stmt->execute();
$book_id = $conn->lastInsertId();

// 3. Link the author
$sql_link_author = "INSERT INTO book_authors (book_id, author_id) VALUES (:book_id, :author_id)";
$stmt = $conn->prepare($sql_link_author);
$stmt->bindValue(":book_id", $book_id, PDO::PARAM_INT);
$stmt->bindValue(":author_id", $author_id, PDO::PARAM_INT);
$stmt->execute();

// 4. Link sub-genres if provided
if (!empty($_POST['sub_genre_ids']) && is_array($_POST['sub_genre_ids'])) {
    $sql_link_genre = "INSERT INTO book_genres (book_id, genre_id) VALUES (:book_id, :genre_id)";
    $stmt = $conn->prepare($sql_link_genre);
    foreach ($_POST['sub_genre_ids'] as $genre_id) {
        // Ensure only numeric genre IDs are used
        if (!is_numeric($genre_id)) continue;
        $stmt->bindValue(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->bindValue(":genre_id", (int)$genre_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// 5. Return success
header("Content-Type: application/json; charset=utf-8");
http_response_code(201);

$updatedBook = ensureExists('books', $book_id);
echo json_encode([
    "message" => "Book created successfully",
    "data" => $updatedBook['data']
]);
