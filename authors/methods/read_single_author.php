<?php
// $id is already set from the router
$author = ensureExists("authors", $id); // pass $id explicitly
$data = $author['data']; // fetched row

// Now fetch the product with its joined media
$sql = "SELECT
    a.id AS author_id,
    a.name,
    a.bio,
    a.birth_year
    FROM authors a
    WHERE a.id = :id
    ";

//Query for main object
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Free the statement before running others
$stmt->closeCursor();

// Now safe to run next/prev
// Query for previous link
$sqlPrev = "SELECT id AS previous_id FROM authors WHERE id < :id ORDER BY id DESC LIMIT 1";
$stmtPrev = $conn->prepare($sqlPrev);
$stmtPrev->execute(['id' => $id]);
$prev = $stmtPrev->fetch(PDO::FETCH_ASSOC);

// Query for next link
$sqlNext = "SELECT id AS next_id FROM authors WHERE id > :id ORDER BY id ASC LIMIT 1";
$stmtNext = $conn->prepare($sqlNext);
$stmtNext->execute(['id' => $id]);
$next = $stmtNext->fetch(PDO::FETCH_ASSOC);

$output = [
    "id" => $results[0]["author_id"],
    "name" => $results[0]["name"],
    "bio" => $results[0]["bio"],
    "birth_year" => $results[0]["birth_year"],
    /* "link" => "$base_url/authors?id=$id", */
    "navigation" => [
        "prev" => $prev ? "$base_url/authors?id={$prev['previous_id']}" : null,
        "next" => $next ? "$base_url/authors?id={$next['next_id']}" : null
    ]
];

header("Content-Type: application/json; charset=utf-8");
echo json_encode($output, JSON_PRETTY_PRINT);
