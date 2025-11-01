<?php
// We assume $conn, $method, and $base_url are already set by the root index.php, but I'm adding them for safety anyways
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/data.php';
require_once __DIR__ . '/../helpers/http.php';

$base_url = 'http://localhost:8888/booktracker';
$method = $method ?? $_SERVER['REQUEST_METHOD'];
$lookupItem = "genre";

//Show options
if ($method === 'OPTIONS') {
    handleOptions($conn, ['GET']);
}

//Methods redirect switch
switch ($method) {
    case 'GET':
        // All GET requests are public, no requireRole needed
        if (!empty($_GET["id"])) {
            $book = ensureExists("{$lookupItem}s");
            $id = $book["id"];
            include __DIR__ . "/methods/{$method}_single_{$lookupItem}.php";
        } else {
            include __DIR__ . "/methods/{$method}_all_{$lookupItem}s.php";
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
