<?php
$author = ensureExists("authors"); // Validates + checks DB
$id = $author["id"];

$sql_delete_byid = "DELETE FROM authors WHERE id = :id";
$stmt = $conn->prepare($sql_delete_byid);
bindField($stmt, ["id", $id], ["type" => PDO::PARAM_INT]);

$stmt->execute();
http_response_code(204);
