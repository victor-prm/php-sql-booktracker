<?php
function bindField($statement, array $fieldInfo, array $options = []) {
    // fieldInfo can be either: ["fieldname"] or ["fieldname", $explicitValue]
    $field = $fieldInfo[0];
    $value = $fieldInfo[1] ?? ($_POST[$field] ?? null);

    // Optional settings
    $lowercase = $options['lowercase'] ?? false;
    $type = $options['type'] ?? PDO::PARAM_STR;

    $key = ":$field";

    // Optional lowercase
    if ($lowercase && is_string($value)) {
        $value = strtolower($value);
    }

    $statement->bindParam($key, $value, $type);
}

function ensureExists($table, $id = null) {
    global $conn;

    // Use provided ID or fallback to $_GET['id']
    if ($id === null) {
        if (empty($_GET["id"])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing ID"]);
            exit;
        }
        $id = $_GET["id"];
    }

    // Ensure the ID is numeric
    if (!is_numeric($id)) {
        header("Content-Type: application/json; charset=utf-8");
        http_response_code(400);
        echo json_encode(["message" => "ID is not a number"]);
        exit;
    }

    // Convert ID to an integer (base 10)'
    $id = intval($id, 10);

    // Check if the record exists. If no record is found, send a 404 response
    $sql = "SELECT * FROM $table WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        header("Content-Type: application/json; charset=utf-8");
        http_response_code(404);
        // Remove plural “s” from table name (e.g., “books” → “Book”)
        $item_type_label = rtrim(ucfirst($table), 's');
        echo json_encode(["message" => $item_type_label . " not found"]);
        exit;
    }

    // Return both the validated ID and the fetched record
    return [
        "id" => $id,
        "data" => $result
    ];
}


//Apply search and filters for books
function applyBookSearchAndFilters(&$whereParts, &$params, $includeAuthors = false, $includeGenres = false) {
    // Make sure $whereParts and $params are arrays
    $whereParts = (array) $whereParts;
    $params = (array) $params;

    // Cast booleans explicitly
    $includeAuthors = (bool) $includeAuthors;
    $includeGenres = (bool) $includeGenres;

    // Search by title
    if (!empty($_GET['q'])) {
        $whereParts[] = "b.title LIKE :search";
        $params['search'] = '%' . (string) $_GET['q'] . '%';
    }

    // Filter by main genre
    if (!empty($_GET['main_genre_id'])) {
        $whereParts[] = "b.main_genre_id = :main_genre_id";
        $params['main_genre_id'] = (int) $_GET['main_genre_id'];
    }

    // Filter by sub-genre (only if genres join exists)
    if ($includeGenres && !empty($_GET['sub_genre_id'])) {
        $whereParts[] = "g.id = :sub_genre_id";
        $params['sub_genre_id'] = (int) $_GET['sub_genre_id'];
    }

    // Filter by author (only if authors join exists)
    if ($includeAuthors && !empty($_GET['author_id'])) {
        $whereParts[] = "a.id = :author_id";
        $params['author_id'] = (int) $_GET['author_id'];
    }

    // Filter by publication year
    if (!empty($_GET['year'])) {
        $whereParts[] = "b.year = :year";
        $params['year'] = (int) $_GET['year'];
    }

    // Optional: filter by description
    if (!empty($_GET['description'])) {
        $whereParts[] = "b.description LIKE :description";
        $params['description'] = '%' . (string) $_GET['description'] . '%';
    }
}

//Apply search and filters for authors
function applyAuthorSearchAndFilters(array &$whereParts, array &$params) {
    // Search by author name
    if (!empty($_GET['q'])) {
        $whereParts[] = "a.name LIKE :search";
        $params['search'] = '%' . $_GET['q'] . '%';
    }

    // Search by bio (optional)
    if (!empty($_GET['bio'])) {
        $whereParts[] = "a.bio LIKE :bio";
        $params['bio'] = '%' . $_GET['bio'] . '%';
    }

    // Filter by birth year
    if (!empty($_GET['birth_year']) && is_numeric($_GET['birth_year'])) {
        $whereParts[] = "a.birth_year = :birth_year";
        $params['birth_year'] = (int)$_GET['birth_year'];
    }
}

//Build where clause for authors/books filters/search
function buildWhereClause($whereParts) {
    return !empty($whereParts) ? ' WHERE ' . implode(' AND ', $whereParts) : '';
}
