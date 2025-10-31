<?php
// Default pagination values
$limit = isset($_GET['limit']) ? intval($_GET['limit'], 10) : 10;   // default 10
$offset = isset($_GET['offset']) ? intval($_GET['offset'], 10) : 0; // default 0

// Guard against negative or unreasonable values
$limit = max(1, min($limit, 50)); // 1–50 results max
$offset = max(0, $offset);

// Get total number of authors for pagination info
$count_sql = "SELECT COUNT(*) AS total FROM authors";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Apply search and filters
$whereParts = [];
$params = [];

// Example: search by author name
if (!empty($_GET['q'])) {
    $whereParts[] = "a.name LIKE :search";
    $params['search'] = '%' . $_GET['q'] . '%';
}

// Example: filter by birth year (optional if column exists)
if (!empty($_GET['birth_year']) && is_numeric($_GET['birth_year'])) {
    $whereParts[] = "a.birth_year = :birth_year";
    $params['birth_year'] = (int)$_GET['birth_year'];
}

// Build WHERE clause
$whereSQL = '';
if (!empty($whereParts)) {
    $whereSQL = ' WHERE ' . implode(' AND ', $whereParts);
}

// Final SQL with pagination
$sql_get_info = "SELECT a.id, a.name, a.birth_year, a.bio 
                 FROM authors a" . $whereSQL . " 
                 LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);

// Bind search/filter parameters
foreach ($params as $key => $value) {
    if ($key === 'search') {
        $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
    } else {
        $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
    }
}

// Bind pagination params
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$authors = [];

// Build structured output
foreach ($results as $row) {
    $id = $row['id'];
    $authors[] = [
        "id" => $id,
        "name" => $row['name'],
        "birth_year" => $row['birth_year'] ?? null,
        "url" => "$base_url/authors?id=$id"
    ];
}

// Pagination navigation
$next_offset = $offset + $limit;
$prev_offset = max(0, $offset - $limit);

$links = [
    "next" => $next_offset < $total ? "$base_url/authors?limit=$limit&offset=$next_offset" : null,
    "prev" => $offset > 0 ? "$base_url/authors?limit=$limit&offset=$prev_offset" : null
];

// Output as JSON
header("Content-Type: application/json; charset=utf-8");
$output = [
    "meta" => [
        "limit" => $limit,
        "offset" => $offset,
        "count" => count($authors),
        "total" => $total,
        "navigation" => $links
    ],
    "results" => $authors
];

http_response_code(200);
echo json_encode($output, JSON_PRETTY_PRINT);