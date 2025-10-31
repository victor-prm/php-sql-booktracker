<?php 
header("Content-Type: application/json; charset=utf-8");

// Include database and helper functions
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/helpers.php";

$resource = $_GET['resource'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

// --- Handle OPTIONS globally ---
if ($method === 'OPTIONS') {
    switch ($resource) {
        case 'books':
            handleOptions($conn, ['GET', 'POST', 'PUT', 'DELETE']);
            break;
        case 'authors':
            handleOptions($conn, ['GET', 'POST', 'PUT', 'DELETE']);
            break;
        case 'genres':
            handleOptions($conn, ['GET']);
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Resource not found']);
            exit;
    }
}

// --- Normal routing for non-OPTIONS requests ---
switch ($resource) {
    case 'books':
        include __DIR__ . "/books/index.php";
        break;

    case 'authors':
        include __DIR__ . "/authors/index.php";
        break;

    case 'genres':
        include __DIR__ . "/genres/index.php";
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}