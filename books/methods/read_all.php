<?php
// Options for expanded object e.g. for grid view in frontend
$expand = isset($_GET['expand']) ? explode(',', $_GET['expand']) : [];

$includeAuthors = in_array('authors', $expand);
$includeGenres  = in_array('genres', $expand);
$includeImg     = in_array('img', $expand);

// Default pagination values
$limit = isset($_GET['limit']) ? intval($_GET['limit'], 10) : 10;   // default 10
$offset = isset($_GET['offset']) ? intval($_GET['offset'], 10) : 0; // default 0

// Guard against negative or unreasonable values
$limit = max(1, min($limit, 50)); // 1–50 results max
$offset = max(0, $offset);

// Get total number of products for pagination info
$count_sql = "SELECT COUNT(*) AS total FROM books";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Main query with LIMIT + OFFSET + EXPAND (conditional query)
$select = "SELECT b.id, b.title";
$from = " FROM books b";
//Check if image should be included
if ($includeImg)        $select .= ", b.frontpage_img";
//Check if authors should be included
if ($includeAuthors) {
    $select .= ", a.id AS author_id, a.name AS author_name";
    $from   .= " LEFT JOIN book_authors ba ON b.id = ba.book_id LEFT JOIN authors a ON ba.author_id = a.id";
}
//Check if genres should be included
if ($includeGenres) {
    $select .= ", g.id AS genre_id, g.name AS genre_name";
    $from   .= " LEFT JOIN book_genres bg ON b.id = bg.book_id LEFT JOIN genres g ON bg.genre_id = g.id";
}
//Concat the final statement
$sql_get_info = $select . $from . " LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$books = [];

// Build structured array of books with their authors
foreach ($results as $row) {
    $id = $row['id'];

    // Always include minimal info
    if (!isset($books[$id])) {
        $books[$id] = [
            "title" => $row['title'],
            "url" => "$base_url/books?id=$id"
        ];
    }

    // Conditionally add expanded fields
    if ($includeImg && !empty($row['frontpage_img'])) {
        $books[$id]['frontpage_img'] = $row['frontpage_img'];
    }

    if ($includeAuthors && !empty($row['author_id'])) {
        // Initialize authors array only if it doesn't exist
        if (!isset($books[$id]['authors'])) $books[$id]['authors'] = [];
        if (!in_array($row['author_id'], array_column($books[$id]['authors'], 'id'))) {
            $books[$id]['authors'][] = [
                "id" => $row['author_id'],
                "name" => $row['author_name']
            ];
        }
    }

    if ($includeGenres && !empty($row['genre_id'])) {
        // Initialize genres array only if it doesn't exist
        if (!isset($books[$id]['genres'])) $books[$id]['genres'] = [];
        if (!in_array($row['genre_id'], array_column($books[$id]['genres'], 'id'))) {
            $books[$id]['genres'][] = [
                "id" => $row['genre_id'],
                "name" => $row['genre_name']
            ];
        }
    }
}

// Build pagination navigation links
$next_offset = $offset + $limit;
$prev_offset = max(0, $offset - $limit);

$links = [
    // "self" represents the current request with limit + offset parameters
    "self" => "$base_url/books?limit=$limit&offset=$offset",
    // "next" points to the next page if more results exist
    "next" => $next_offset < $total ? "$base_url/books?limit=$limit&offset=$next_offset" : null,
    // "prev" points to the previous page if offset > 0
    "prev" => $offset > 0 ? "$base_url/books?limit=$limit&offset=$prev_offset" : null
];

// Output as JSON (with metadata and hypermedia controls)
header("Content-Type: application/json; charset=utf-8");
$output = [
    "meta" => [
        "limit" => $limit,               // number of items requested
        "offset" => $offset,             // starting position
        "count" => count($books),        // actual number of items returned
        "total" => $total,               // total number of products available
        "links" => $links                // navigation links (self, next, prev)
    ],
    "results" => array_values($books)    // actual data results
];

echo json_encode($output, JSON_PRETTY_PRINT);
