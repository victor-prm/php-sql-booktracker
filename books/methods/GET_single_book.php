<?php
// $id is already set from the router
$book = ensureExists("books", $id); // pass $id explicitly
$data = $book['data']; // fetched row

// Now fetch the product with its joined media
$sql = "SELECT
    b.id AS book_id,
    b.title,
    b.year,
    b.description,
    b.pages,
    b.frontpage_img,
    b.main_genre_id,
    mg.name AS main_genre,
    b.status_id,
    s.name AS status,
    a.id AS author_id,
    a.name AS author_name,
    g.id AS genre_id,
    g.name AS genre_name
    FROM books b
    LEFT JOIN reading_status s ON b.status_id = s.id
    LEFT JOIN genres mg ON b.main_genre_id = mg.id
    LEFT JOIN book_authors ba ON b.id = ba.book_id
    LEFT JOIN authors a ON ba.author_id = a.id
    LEFT JOIN book_genres bg ON b.id = bg.book_id
    LEFT JOIN genres g ON bg.genre_id = g.id
    WHERE b.id = :id
    ORDER BY a.name, g.name
    ";

//Query for main object
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Free the statement before running others
$stmt->closeCursor();

// Now safe to run next/prev
// Query for previous link
$sqlPrev = "SELECT id AS previous_id FROM books WHERE id < :id ORDER BY id DESC LIMIT 1";
$stmtPrev = $conn->prepare($sqlPrev);
$stmtPrev->execute(['id' => $id]);
$prev = $stmtPrev->fetch(PDO::FETCH_ASSOC);

// Query for next link
$sqlNext = "SELECT id AS next_id FROM books WHERE id > :id ORDER BY id ASC LIMIT 1";
$stmtNext = $conn->prepare($sqlNext);
$stmtNext->execute(['id' => $id]);
$next = $stmtNext->fetch(PDO::FETCH_ASSOC);

$output = [
    "id" => $results[0]["book_id"],
    "title" => $results[0]["title"],
    "authors" => [],
    "genres" => [
        [
            "name" => $results[0]['main_genre'],
            "url"  => "$base_url/genres?id=" . $results[0]['main_genre_id'],
        ]
    ],
    "frontpage_img" => $results[0]["frontpage_img"],
    "summary" => $results[0]["description"],
    "published_year" => $results[0]["year"],
    "page_count" => $results[0]["pages"],
    "reading_status" => $results[0]["status"],
    /* "link" => "$base_url/books?id=$id", */
    "navigation" => [
        "prev" => $prev ? "$base_url/books?id={$prev['previous_id']}" : null,
        "next" => $next ? "$base_url/books?id={$next['next_id']}" : null
    ]
];

// Track which authors and genres have been added
$addedAuthors = [];
$addedGenres = [];

// Fill in authors
foreach ($results as $row) {
    if (!in_array($row["author_id"], $addedAuthors) && $row["author_id"]) {
        $output["authors"][] = [
            "name" => $row['author_name'],
            "url"  => "$base_url/authors?id=" . $row['author_id']
        ];
        $addedAuthors[] = $row["author_id"];
    }
}

// Fill in subgenres
foreach ($results as $row) {
    if (!in_array($row["genre_id"], $addedGenres) && $row["genre_id"]) {
        $output["genres"][] = [
            "name" => $row['genre_name'],
            "url"  => "$base_url/genres?id=" . $row['genre_id'],
        ];
        $addedGenres[] = $row["genre_id"];
    }
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($output, JSON_PRETTY_PRINT);
