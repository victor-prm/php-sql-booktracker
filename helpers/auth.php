
<?php 
function getUserRoleFromAuthHeader($conn, $allowPublic = true) {
    $headers = getallheaders();
    $authHeader = $headers['X-Authorization'] ?? '';

    if (empty($authHeader)) {
        return $allowPublic ? 'public' : unauthorized();
    }

    if (!str_starts_with($authHeader, 'Bearer ')) {
        return $allowPublic ? 'public' : unauthorized();
    }

    $token = trim(str_replace('Bearer ', '', $authHeader));

    $stmt = $conn->prepare("SELECT name FROM roles WHERE token = :token LIMIT 1");
    $stmt->execute(['token' => $token]);
    $role = $stmt->fetchColumn();

    if (!$role) {
        return $allowPublic ? 'public' : unauthorized();
    }

    return $role;
}

function requireRole($allowedRoles) {
    global $conn; // access shared DB connection

    $currentRole = getUserRoleFromAuthHeader($conn, false);

    // normalize to array
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }

    if (!in_array($currentRole, $allowedRoles)) {
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden: insufficient permissions']);
        exit;
    }
}

function unauthorized() {
    http_response_code(401);
    echo json_encode(['error' => 'Missing or invalid Authorization header']);
    exit;
}
