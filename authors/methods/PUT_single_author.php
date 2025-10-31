<?php
// 1. Ensure author exists
$author = ensureExists('authors'); // validates id in $_GET['id']
$author_id = $author['id'];

// 2. Parse PUT data
parse_str(file_get_contents("php://input"), $body);

// 3. Validate required fields
$requiredFields = ['name', 'bio', 'birth_year'];
$missingFields = array_filter($requiredFields, fn($f) => empty($body[$f]));

if (!empty($missingFields)) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing field(s)",
        "fields" => $missingFields
    ]);
    exit;
}

// 4. Update author
$sql_update = "UPDATE authors
               SET name = :name, bio = :bio, birth_year = :birth_year
               WHERE id = :id";
$stmt = $conn->prepare($sql_update);
bindField($stmt, ['id', $author_id], ['type' => PDO::PARAM_INT]);
bindField($stmt, ['name', $body['name']]);
bindField($stmt, ['bio', $body['bio']]);
bindField($stmt, ['birth_year', $body['birth_year']], ['type' => PDO::PARAM_INT]);
$stmt->execute();

// 5. Re-fetch updated author
$updatedAuthor = ensureExists('authors');
http_response_code(200);
echo json_encode($updatedAuthor['data']);