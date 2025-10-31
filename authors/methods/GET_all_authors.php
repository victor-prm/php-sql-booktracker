<?php
// Default pagination values
$limit = isset($_GET['limit']) ? intval($_GET['limit'], 10) : 10;   // default 10
$offset = isset($_GET['offset']) ? intval($_GET['offset'], 10) : 0; // default 0

// Guard against negative or unreasonable values
$limit = max(1, min($limit, 50)); // 1–50 results max
$offset = max(0, $offset);

// Get total number of products for pagination info
$count_sql = "SELECT COUNT(*) AS total FROM authors";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Main query with LIMIT + OFFSET
$sql_get_info = "SELECT a.id, a.name FROM authors a LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$authors = [];


// Build structured array of authors with their authors/genres
foreach ($results as $row) {
    $id = $row['id'];

    // Always include minimal info
    if (!isset($authors[$id])) {
        $authors[$id] = [
            "name" => $row['name'],
            "url" => "$base_url/authors?id=$id"
        ];
    }
}

// Build pagination navigation links
$next_offset = $offset + $limit;
$prev_offset = max(0, $offset - $limit);

$links = [
    // "next" points to the next page if more results exist
    "next" => $next_offset < $total ? "$base_url/authors?limit=$limit&offset=$next_offset" : null,
    // "prev" points to the previous page if offset > 0
    "prev" => $offset > 0 ? "$base_url/authors?limit=$limit&offset=$prev_offset" : null
];

// Output as JSON (with metadata and hypermedia controls)
header("Content-Type: application/json; charset=utf-8");
$output = [
    "meta" => [
        "limit" => $limit,               // number of items requested
        "offset" => $offset,             // starting position
        "count" => count($authors),      // actual number of items returned
        "total" => $total,               // total number of products available
        "navigation" => $links           // navigation links (next, prev)
    ],
    "results" => array_values($authors)  // actual data results
];

header("Content-Type: application/json; charset=utf-8");
http_response_code(200);
echo json_encode($output, JSON_PRETTY_PRINT);