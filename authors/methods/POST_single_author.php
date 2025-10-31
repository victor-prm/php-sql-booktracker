<?php
// 1. Validate input
$requiredFields = ['name', 'bio', 'birth_year'];
$missingFields = array_filter($requiredFields, fn($field) => empty($_POST[$field]));

/* if (!empty($missingFields)) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing field(s)",
        "fields" => $missingFields
    ]);
    exit;
} */

// 2. Insert new author
$sql_insert_author = "INSERT INTO authors (name, bio, birth_year) 
                      VALUES (:name, :bio, :birth_year)";
$stmt = $conn->prepare($sql_insert_author);
bindField($stmt, ['name']);
bindField($stmt, ['bio']);
bindField($stmt, ['birth_year'], ['type' => PDO::PARAM_INT]);
$stmt->execute();
$author_id = $conn->lastInsertId();

// 3. Return success
header("Content-Type: application/json; charset=utf-8");
http_response_code(201);

$updatedAuthor = ensureExists('authors', $author_id);
echo json_encode([
    "message" => "Author created successfully",
    "data" => $updatedAuthor['data']
]);
