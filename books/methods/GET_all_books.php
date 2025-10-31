<?php
// Options for expanded object e.g. for grid view in frontend
$expand = isset($_GET['expand']) ? explode(',', $_GET['expand']) : [];

$includeGenres      = in_array('genres', $expand);
$includeAuthors     = in_array('authors', $expand);
$includeImg         = in_array('img', $expand);
$includeYear        = in_array('year', $expand);
$includeDescription = in_array('description', $expand) || !empty($_GET['q']);

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
$from   = " FROM books b";

// Only include description if searching
if ($includeDescription) {
    $select .= ", b.description";
}

// Check if image should be included
if ($includeImg) $select .= ", b.frontpage_img";

// Check if year should be included
if ($includeYear) $select .= ", b.year";

// Check if authors should be included
if ($includeAuthors) {
    $select .= ", a.id AS author_id, a.name AS author_name";
    $from   .= " LEFT JOIN book_authors ba ON b.id = ba.book_id
                 LEFT JOIN authors a ON ba.author_id = a.id";
}

// Join genres if either expand or sub-genre filter is requested
if ($includeGenres) {
    $select .= ", g.id AS genre_id, g.name AS genre_name, b.main_genre_id, mg.name AS main_genre";
    $from   .= " LEFT JOIN book_genres bg ON b.id = bg.book_id
                 LEFT JOIN genres g ON bg.genre_id = g.id
                 LEFT JOIN genres mg ON b.main_genre_id = mg.id";
}


//Apply search and filters
$whereParts = [];
$params = [];
applyBookSearchAndFilters($whereParts, $params, $includeAuthors, $includeGenres);

// Build WHERE clause
$whereSQL = buildWhereClause($whereParts);

// Final concatenated SQL
$sql_get_info = $select . $from . $whereSQL . " LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql_get_info);

// Bind search/filter parameters
foreach ($params as $key => $value) {
    // Bind string parameters
    if (in_array($key, ['search_start', 'search_middle', 'title', 'description'])) {
        $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
    } else {
        $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
    }
}

// Bind limit and offset
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$books = [];

// Build structured array of books with their authors/genres
foreach ($results as $row) {
    $id = $row['id'];
    $matchFields = [];

    // Check which fields matched the query
    if (!empty($_GET['q'])) {
        $q = strtolower($_GET['q']);

        // Check title
        if (strpos(strtolower($row['title']), $q) === 0 || strpos(strtolower($row['title']), ' ' . $q) !== false) {
            $matchFields[] = 'title';
        }

        // Check description
        if (!empty($row['description']) && (strpos(strtolower($row['description']), $q) === 0 || strpos(strtolower($row['description']), ' ' . $q) !== false)) {
            $matchFields[] = 'description';
        }
    }

    // Always include minimal info
    if (!isset($books[$id])) {
        $books[$id] = [
            "title" => $row['title'],
            "url" => "$base_url/books?id=$id",
            "match_fields" => $matchFields
        ];

        // Initialize empty arrays only if needed
        if ($includeImg) $books[$id]['frontpage_img'] = null;
        if ($includeAuthors) $books[$id]['authors'] = [];
        if ($includeGenres) $books[$id]['genres'] = [];
        if ($includeYear) $books[$id]['year'] = null;

        // Keep track of added authors/genres per book
        $books[$id]['_addedAuthors'] = [];
        $books[$id]['_addedGenres'] = [];
    }

    // Conditionally add expanded fields (authors, genres, img, year) as before...
    if ($includeImg && !empty($row['frontpage_img'])) {
        $books[$id]['frontpage_img'] = $row['frontpage_img'];
    }

    if ($includeYear && !empty($row['year'])) {
        $books[$id]['year'] = $row['year'];
    }

    if ($includeAuthors && !empty($row['author_id']) && !in_array($row['author_id'], $books[$id]['_addedAuthors'])) {
        $books[$id]['authors'][] = [
            "name" => $row['author_name'],
            "url"  => "$base_url/authors?id=" . $row['author_id']
        ];
        $books[$id]['_addedAuthors'][] = $row['author_id'];
    }

    if ($includeGenres) {
        if (!isset($books[$id]['genres'])) $books[$id]['genres'] = [];

        if (!empty($row['main_genre_id'])) {
            $mainGenreUrl = "$base_url/genres?id=" . $row['main_genre_id'];
            $books[$id]['genres'][] = [
                "name" => $row['main_genre'],
                "url"  => $mainGenreUrl,
            ];
        }

        if (!empty($row['genre_id'])) {
            $subGenreUrl = "$base_url/genres?id=" . $row['genre_id'];
            $existingUrls = array_column($books[$id]['genres'], 'url');
            if (!in_array($subGenreUrl, $existingUrls)) {
                $books[$id]['genres'][] = [
                    "name" => $row['genre_name'],
                    "url"  => $subGenreUrl,
                ];
            }
        }
    }
}

// Remove internal tracking keys
foreach ($books as &$b) {
    unset($b['_addedAuthors'], $b['_addedGenres']);
}

$output = array_values($books);

// Build pagination navigation links
$next_offset = $offset + $limit;
$prev_offset = max(0, $offset - $limit);

$links = [
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
        "navigation" => $links           // navigation links (next, prev)
    ],
    "results" => array_values($books)    // actual data results
];

header("Content-Type: application/json; charset=utf-8");
http_response_code(200);
echo json_encode($output, JSON_PRETTY_PRINT);
