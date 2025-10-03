<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}
if ($_SESSION['role'] !== 'Admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden']);
    exit;
}

require_once '../database_functions.php';
echo json_encode(getAllUsers(), JSON_UNESCAPED_UNICODE);
