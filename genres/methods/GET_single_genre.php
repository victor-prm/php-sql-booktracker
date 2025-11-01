<?php
// $id is already set from the router
$genre = ensureExists("genres", $id);
$data = $genre['data'];

// Fetch all books that have this genre either as main or subgenre
$sql = "
    SELECT DISTINCT
        g.id AS genre_id,
        g.name AS genre_name,
        b.id AS book_id,
        b.title AS book_title
    FROM genres g
    LEFT JOIN book_genres bg ON g.id = bg.genre_id
    LEFT JOIN books b 
        ON b.main_genre_id = g.id 
        OR b.id = bg.book_id
    WHERE g.id = :id
    ORDER BY b.title
";
//Query for main object
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Free the statement before running others
$stmt->closeCursor();

// Now safe to run next/prev
// Query for previous link
$sqlPrev = "SELECT id AS previous_id FROM genres WHERE id < :id ORDER BY id DESC LIMIT 1";
$stmtPrev = $conn->prepare($sqlPrev);
$stmtPrev->execute(['id' => $id]);
$prev = $stmtPrev->fetch(PDO::FETCH_ASSOC);

// Query for next link
$sqlNext = "SELECT id AS next_id FROM genres WHERE id > :id ORDER BY id ASC LIMIT 1";
$stmtNext = $conn->prepare($sqlNext);
$stmtNext->execute(['id' => $id]);
$next = $stmtNext->fetch(PDO::FETCH_ASSOC);

// Build output
$output = [
    "id" => $results[0]['genre_id'],
    "name" => $results[0]['genre_name'],
    "books" => [],
    /* "link" => "$base_url/genres?id=$id", */
    "navigation" => [
        "prev" => $prev ? "$base_url/genres?id={$prev['previous_id']}" : null,
        "next" => $next ? "$base_url/genres?id={$next['next_id']}" : null
    ]
];

foreach ($results as $row) {
    if (!empty($row['book_id'])) {
        $output['books'][] = [
            "title" => $row['book_title'],
            "url" => "$base_url/books?id=" . $row['book_id']
        ];
    }
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($output, JSON_PRETTY_PRINT);
