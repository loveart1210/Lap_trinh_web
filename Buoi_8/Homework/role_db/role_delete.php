<?php
require_once '../database_functions.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID");
}
$id = (int)$_GET['id'];
delete_role($id);
header("Location: role_list.php");
exit();
