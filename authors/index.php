<?php
require("../db.php");
require("../helpers.php");

// Define a base URL used for both item links and pagination links
$base_url = 'http://localhost:8888/booktracker';

//GET SINGLE (detail view)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET["id"])) {
    // GET /authors?id=15 → get single
    $author = ensureExists("authors"); // validation + ensures 404 if not found
    $id = $author["id"]; // safely validated numeric ID

    include __DIR__ . '/methods/read_single_author.php';
}

// GET ALL (with pagination)
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET /authors → get all
    include __DIR__ . '/methods/read_all_authors.php';
}



//POST (create new author)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . '/methods/create_author.php';
}

/* 
//PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
}*/

//DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    include __DIR__ . '/methods/delete_author.php';
}
