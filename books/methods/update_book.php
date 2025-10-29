<?php
$book = ensureExists("products"); // Validates + checks DB
$id = $book["id"];

// Parse incoming PUT data
parse_str(file_get_contents("php://input"), $body);
var_dump($body); // Optional for debugging

// Check for empty fields
$requiredFields = ["name", "description", "price", "weight_in_grams"];
$missingFields = array_filter($requiredFields, fn($field) => empty($body[$field]));

if (!empty($missingFields)) {
    header("Content-Type: application/json; charset=utf-8");
    http_response_code(400);
    echo json_encode([
        "message" => "Missing information in field(s)",
        "fields" => $missingFields
    ]);
    exit;
}

$sql_update = "UPDATE products 
                   SET name = :name, description = :description, price = :price, weight_in_grams = :weight_in_grams
                   WHERE id = :id";
$stmt = $conn->prepare($sql_update);

bindField($stmt, ["id", $id], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["name", $body["name"]]);
bindField($stmt, ["description", $body["description"]]);
bindField($stmt, ["price", $body["price"]], ["type" => PDO::PARAM_INT]);
bindField($stmt, ["weight_in_grams", $body["weight_in_grams"]], ["type" => PDO::PARAM_INT]);

$stmt->execute();

// Re-fetch updated product
$updatedProduct = ensureExists("products");
header("Content-Type: application/json; charset=utf-8");
http_response_code(200);
echo json_encode($updatedProduct["data"]);
