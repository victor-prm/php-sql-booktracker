<?php
function handleOptions($conn, $methods) {
    // Get the user's role (public if no auth header)
    $role = getUserRoleFromAuthHeader($conn);

    // Restrict allowed methods based on role
    $allowedMethods = [];

    foreach ($methods as $m) {
        switch ($m) {
            case 'GET':
            case 'OPTIONS':
                // GET and OPTIONS are always public
                $allowedMethods[] = $m;
                break;

            case 'POST':
            case 'PUT':
                // Editor or Admin can POST/PUT
                if (in_array($role, ['editor', 'admin'])) {
                    $allowedMethods[] = $m;
                }
                break;

            case 'DELETE':
                // Only Admin can DELETE
                if ($role === 'admin') {
                    $allowedMethods[] = $m;
                }
                break;
        }
    }

    // CORS + Allow headers
    header('Allow: ' . implode(', ', $allowedMethods));
    header('Access-Control-Allow-Methods: ' . implode(', ', $allowedMethods));
    header('Access-Control-Allow-Headers: X-Authorization, Content-Type'); // include custom header
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400'); // cache preflight for 1 day
    http_response_code(204);
    exit;
}
