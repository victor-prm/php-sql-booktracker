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
applyAuthorSearchAndFilters($whereParts, $params);
$whereSQL = buildWhereClause($whereParts);

// Final SQL with pagination
$sql_get_info = "SELECT a.id, a.name, a.birth_year, a.bio 
                 FROM authors a" . $whereSQL . " 
                 LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);

// Bind search/filter parameters
foreach ($params as $key => $value) {
    if (in_array($key, ['search_start', 'search_middle', 'name', 'bio'])) {
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
    $matchFields = [];

    // Check for matches if q is provided
    if (!empty($_GET['q'])) {
        $q = strtolower($_GET['q']);

        // Check name
        if (strpos(strtolower($row['name']), $q) === 0 || strpos(strtolower($row['name']), ' ' . $q) !== false) {
            $matchFields[] = 'name';
        }

        // Check bio (if exists)
        if (!empty($row['bio']) && (strpos(strtolower($row['bio']), $q) === 0 || strpos(strtolower($row['bio']), ' ' . $q) !== false)) {
            $matchFields[] = 'bio';
        }
    }

    $authors[] = [
        "name" => $row['name'],
        "url" => "$base_url/authors?id=$id",
        "match_fields" => $matchFields // NEW
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
