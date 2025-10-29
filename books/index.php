<?php
require("../db.php");
require("../helpers.php");

// Define a base URL used for both item links and pagination links
$base_url = 'http://localhost:8888/booktracker';

//GET SINGLE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET["id"])) {
    // GET /books?id=15 → get single
    $book = ensureExists("books"); // validation + ensures 404 if not found
    $id = $book["id"]; // safely validated numeric ID

    include __DIR__ . '/methods/get_single.php';
}

// GET ALL (with pagination)
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET /books → get all
    include __DIR__ . '/methods/get_all.php';
}


/* 
//POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form data received ✅" . "<br>";
    var_dump($_POST);

    $sql_insert_new = "INSERT INTO products (name, description, price, weight_in_grams)
                   VALUES (:name, :description, :price, :weight_in_grams)";
    $stmt = $conn->prepare($sql_insert_new);

    bindField($stmt, ["name"]);
    bindField($stmt, ["description"]);
    bindField($stmt, ["price"], ["type" => PDO::PARAM_INT]);
    bindField($stmt, ["weight_in_grams"], ["type" => PDO::PARAM_INT]);

    $stmt->execute();

    echo $sql_insert_new;
    print_r($stmt->errorInfo());
    http_response_code(201);
}

//PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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
}

//DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $book = ensureExists("products"); // Validates + checks DB
    $id = $book["id"];

    $sql_delete_byid = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql_delete_byid);
    bindField($stmt, ["id", $id], ["type" => PDO::PARAM_INT]);

    $stmt->execute();
    http_response_code(204);
}
 */