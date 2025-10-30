<?php
// Default pagination values
$limit = isset($_GET['limit']) ? intval($_GET['limit'], 10) : 10;   // default 10
$offset = isset($_GET['offset']) ? intval($_GET['offset'], 10) : 0; // default 0

// Guard against negative or unreasonable values
$limit = max(1, min($limit, 50)); // 1–50 results max
$offset = max(0, $offset);

// Get total number of products for pagination info
$count_sql = "SELECT COUNT(*) AS total FROM genres";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Main query with LIMIT + OFFSET
$sql_get_info = "SELECT a.id, a.name FROM genres a LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$genres = [];


// Build structured array of genres with their genres/genres
foreach ($results as $row) {
    $id = $row['id'];

    // Always include minimal info
    if (!isset($genres[$id])) {
        $genres[$id] = [
            "name" => $row['name'],
            "url" => "$base_url/genres?id=$id"
        ];
    }
}

// Build pagination navigation links
$next_offset = $offset + $limit;
$prev_offset = max(0, $offset - $limit);

$links = [
    // "next" points to the next page if more results exist
    "next" => $next_offset < $total ? "$base_url/genres?limit=$limit&offset=$next_offset" : null,
    // "prev" points to the previous page if offset > 0
    "prev" => $offset > 0 ? "$base_url/genres?limit=$limit&offset=$prev_offset" : null
];

// Output as JSON (with metadata and hypermedia controls)
header("Content-Type: application/json; charset=utf-8");
$output = [
    "meta" => [
        "limit" => $limit,               // number of items requested
        "offset" => $offset,             // starting position
        "count" => count($genres),       // actual number of items returned
        "total" => $total,               // total number of products available
        "navigation" => $links           // navigation links (next, prev)
    ],
    "results" => array_values($genres)   // actual data results
];

echo json_encode($output, JSON_PRETTY_PRINT);