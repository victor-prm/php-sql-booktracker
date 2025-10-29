<?php
$book = ensureExists("books"); // Validates + checks DB
$id = $book["id"];

$sql_delete_byid = "DELETE FROM books WHERE id = :id";
$stmt = $conn->prepare($sql_delete_byid);
bindField($stmt, ["id", $id], ["type" => PDO::PARAM_INT]);

$stmt->execute();
http_response_code(204);
