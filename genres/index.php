<?php
require("../db.php");
require("../helpers/data.php");

// Define a base URL used for both item links and pagination links
$base_url = 'http://localhost:8888/genretracker';

//GET SINGLE (detail view)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET["id"])) {
    // GET /genres?id=15 → get single
    $genre = ensureExists("genres"); // validation + ensures 404 if not found
    $id = $genre["id"]; // safely validated numeric ID

    include __DIR__ . '/methods/read_single_genre.php';
}

// GET ALL (with pagination)
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET /genres → get all
    include __DIR__ . '/methods/read_all_genres.php';
}