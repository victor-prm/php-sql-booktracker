<?php
echo "Form data received ✅<br>";
var_dump($_POST);

// 2. Insert new author
$sql_insert_author = "INSERT INTO authors (
    name, bio, birth_year
) VALUES (
    :name, :bio, :birth_year
)";
$stmt = $conn->prepare($sql_insert_author);
bindField($stmt, ["name"]);
bindField($stmt, ["bio"]);
bindField($stmt, ["birth_year"],  ["type" => PDO::PARAM_INT]);
$stmt->execute();
$author_id = $conn->lastInsertId();


// 5. Return success
http_response_code(201);
echo json_encode([
    "message" => "Author created successfully",
    "author_id" => $author_id
]);
