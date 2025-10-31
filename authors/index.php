<?php
// We assume $conn, $method, and $base_url are already set by the root index.php, but I'm adding them for safety anyways
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/data.php';
require_once __DIR__ . '/../helpers/http.php';

$base_url = 'http://localhost:8888/booktracker';
$method = $method ?? $_SERVER['REQUEST_METHOD'];
$lookupItem = "author";

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            // Protected: Viewers and Editors only (single item view)
            requireRole(['viewer', 'editor']);
            $book = ensureExists("{$lookupItem}s");
            $id = $book["id"];
            include __DIR__ . "/methods/{$method}_single_{$lookupItem}.php";
        } else {
            // Public: List all books
            include __DIR__ . "/methods/{$method}_all_{$lookupItem}s.php";
        }
        break;

    case 'POST':
    case 'PUT':
    case 'DELETE':
        // Protected: Editors only (single item manipulation)
        requireRole(['editor']);
        include __DIR__ . "/methods/{$method}_single_{$lookupItem}.php";
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
