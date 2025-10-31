<?php 
function handleOptions($conn, $methods) {
    // Authenticate user
    $role = getUserRoleFromAuthHeader($conn); // now requires DB connection
    var_dump($role);

    // Restrict allowed methods for viewers
    if ($role !== 'editor') {
        $methods = array_filter($methods, fn($m) => in_array($m, ['GET', 'OPTIONS']));
    }

    // CORS + Allow headers
    header('Allow: ' . implode(', ', $methods));
    header('Access-Control-Allow-Methods: ' . implode(', ', $methods));
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400'); // optional: cache preflight for 1 day
    http_response_code(204);
    exit;
}
