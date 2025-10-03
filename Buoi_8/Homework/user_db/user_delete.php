<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

require_once '../database_functions.php';

$id = $_GET['id'] ?? 0;
if ($id) {
    deleteUser($id);
}
header("Location: user_list.php");
exit();
?>
