<?php
require_once '../database_functions.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID");
}
$id = (int)$_GET['id'];
deleteUser($id);
header("Location: user_list.php");
exit();
