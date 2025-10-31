<?php
function bindField($statement, array $fieldInfo, array $options = []) {
    // fieldInfo can be either: ["fieldname"] or ["fieldname", $explicitValue]
    $field = $fieldInfo[0];
    $value = $fieldInfo[1] ?? ($_POST[$field] ?? null);

    // Optional settings
    $lowercase = $options['lowercase'] ?? false;
    $type = $options['type'] ?? PDO::PARAM_STR;

    $key = ":$field";

    // Optional lowercase
    if ($lowercase && is_string($value)) {
        $value = strtolower($value);
    }

    $statement->bindParam($key, $value, $type);
}

function ensureExists($table, $id = null) {
    global $conn;

    // Use provided ID or fallback to $_GET['id']
    if ($id === null) {
        if (empty($_GET["id"])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing ID"]);
            exit;
        }
        $id = $_GET["id"];
    }

    // Ensure the ID is numeric
    if (!is_numeric($id)) {
        header("Content-Type: application/json; charset=utf-8");
        http_response_code(400);
        echo json_encode(["message" => "ID is not a number"]);
        exit;
    }

    // Convert ID to an integer (base 10)'
    $id = intval($id, 10);

    // Check if the record exists. If no record is found, send a 404 response
    $sql = "SELECT * FROM $table WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        header("Content-Type: application/json; charset=utf-8");
        http_response_code(404);
        // Remove plural “s” from table name (e.g., “books” → “Book”)
        $item_type_label = rtrim(ucfirst($table), 's');
        echo json_encode(["message" => $item_type_label . " not found"]);
        exit;
    }

    // Return both the validated ID and the fetched record
    return [
        "id" => $id,
        "data" => $result
    ];
}

function applySearchAndFilters(array &$whereParts, array &$params) {
    // Example: search by title
    if (!empty($_GET['q'])) {
        $whereParts[] = "b.title LIKE :search";
        $params['search'] = '%' . $_GET['q'] . '%';
    }

    // Example: filter by main genre
    if (!empty($_GET['genre_id']) && is_numeric($_GET['genre_id'])) {
        $whereParts[] = "b.main_genre_id = :genre_id";
        $params['genre_id'] = (int)$_GET['genre_id'];
    }

    // Example: filter by author
    if (!empty($_GET['author_id']) && is_numeric($_GET['author_id'])) {
        $whereParts[] = "a.id = :author_id";
        $params['author_id'] = (int)$_GET['author_id'];
    }
}