<?php
// We assume $conn, $method, and $base_url are already set by the root index.php, but I'm adding them for safety anyways
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helpers.php';

$base_url = 'http://localhost:8888/booktracker';
$method = $method ?? $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            // Protected: single item view
            requireRole(['viewer', 'editor']); 
            $book = ensureExists("books");
            $id = $book["id"];
            include __DIR__ . '/methods/read_single_book.php';
        } else {
            // Public: list all books
            include __DIR__ . '/methods/read_all_books.php';
        }
        break;

    case 'POST':
    case 'PUT':
    case 'DELETE':
        // Protected: editors only
        requireRole(['editor']);
        include __DIR__ . "/methods/" . $method . "_single_book.php";
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}