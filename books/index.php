<?php
require("../db.php");
require("../helpers.php");

// Define a base URL used for both item links and pagination links
$base_url = 'http://localhost:8888/booktracker';

//GET SINGLE (detail view)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET["id"])) {
    // GET /books?id=15 → get single
    $book = ensureExists("books"); // validation + ensures 404 if not found
    $id = $book["id"]; // safely validated numeric ID

    include __DIR__ . '/methods/read_single.php';
}

// GET ALL (with pagination)
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET /books → get all
    include __DIR__ . '/methods/read_all.php';
}



//POST (create new book)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // GET /books → get all
    include __DIR__ . '/methods/create_book.php';
}

/* 
//PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
}*/

//DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    include __DIR__ . '/methods/delete_book.php';
}
