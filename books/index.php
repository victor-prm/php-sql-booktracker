<?php
require("../db.php");
require("../helpers.php");

// Define a base URL used for both item links and pagination links
$base_url = 'http://localhost:8888/booktracker';

// GET ALL (with pagination)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET["id"])) {

    // Default pagination values
    $limit = isset($_GET['limit']) ? intval($_GET['limit'], 10) : 10;   // default 20
    $offset = isset($_GET['offset']) ? intval($_GET['offset'], 10) : 0; // default 0

    // Guard against negative or unreasonable values
    $limit = max(1, min($limit, 50)); // 1–50 results max
    $offset = max(0, $offset);

    // Get total number of products for pagination info
    $count_sql = "SELECT COUNT(*) AS total FROM products";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->execute();
    $total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Main query with LIMIT + OFFSET
    $sql_get_info = "SELECT id, name FROM products LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql_get_info);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build hypermedia links for each product
    foreach ($results as $i => $r) {
        $results[$i]['url'] = "$base_url/books?id=" . $results[$i]["id"];
        unset($results[$i]["id"]);
    }

    // Build pagination navigation links
    $next_offset = $offset + $limit;
    $prev_offset = max(0, $offset - $limit);

    $links = [
        // "self" represents the current request with limit + offset parameters
        "self" => "$base_url/books?limit=$limit&offset=$offset",
        // "next" points to the next page if more results exist
        "next" => $next_offset < $total ? "$base_url/books?limit=$limit&offset=$next_offset" : null,
        // "prev" points to the previous page if offset > 0
        "prev" => $offset > 0 ? "$base_url/books?limit=$limit&offset=$prev_offset" : null
    ];

    // Output as JSON (with metadata and hypermedia controls)
    header("Content-Type: application/json; charset=utf-8");
    $output = [
        "meta" => [
            "limit" => $limit,               // number of items requested
            "offset" => $offset,             // starting position
            "count" => count($results),      // actual number of items returned
            "total" => $total,               // total number of products available
            "links" => $links                // navigation links (self, next, prev)
        ],
        "results" => $results                // actual data results
    ];

    echo json_encode($output);
}

//GET SINGLE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET["id"])) {
    // GET /books?id=15 → get single
    $book = ensureExists("books"); // validation + ensures 404 if not found
    $id = $book["id"]; // safely validated numeric ID

    include __DIR__ . '/methods/get_single.php';
}

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