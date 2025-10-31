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

function ensureExists($table) {
    global $conn;

    // Validate incoming ID from query string
    if (empty($_GET["id"])) {
        http_response_code(400);
        echo json_encode(["message" => "Missing ID"]);
        exit;
    }

    $id = $_GET["id"];

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


function handleOptions($conn, $methods) {
    // Authenticate user
    $role = getUserRoleFromAuthHeader($conn); // now requires DB connection

    // Restrict allowed methods for viewers
    if ($role !== 'editor') {
        $methods = array_filter($methods, fn($m) => in_array($m, ['GET', 'OPTIONS']));
    }

    // CORS + Allow headers
    header('Allow: ' . implode(', ', $methods));
    header('Access-Control-Allow-Methods: ' . implode(', ', $methods));
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400'); // optional: cache preflight for 1 day
    http_response_code(204);
    exit;
}

function getUserRoleFromAuthHeader($conn, $allowPublic = true) {
    $headers = getallheaders();
    $authHeader = $headers['X-Authorization'] ?? ''; // Custom header from postman
    //var_dump($authHeader);

    if (empty($authHeader)) {
        return $allowPublic ? 'public' : unauthorized();
    }

    if (!str_starts_with($authHeader, 'Bearer ')) {
        return $allowPublic ? 'public' : unauthorized();
    }

    //Remove "Bearer " when looking on the token in the DB
    $token = trim(str_replace('Bearer ', '', $authHeader));

    $stmt = $conn->prepare("SELECT name FROM roles WHERE token = :token LIMIT 1");
    $stmt->execute(['token' => $token]);
    $role = $stmt->fetchColumn();

    if (!$role) {
        return $allowPublic ? 'public' : unauthorized();
    }

    return $role;
}

function requireRole(array|string $allowedRoles) {
    global $conn; // access shared DB connection

    $currentRole = getUserRoleFromAuthHeader($conn, false);

    // normalize to array
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }

    if (!in_array($currentRole, $allowedRoles)) {
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden: insufficient permissions']);
        exit;
    }
}

function unauthorized() {
    http_response_code(401);
    echo json_encode(['error' => 'Missing or invalid Authorization header']);
    exit;
}
