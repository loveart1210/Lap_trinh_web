<?php
require_once '../database_functions.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID nhân viên");
}
$id = (int)$_GET['id'];
delete_employee($id);
header("Location: employee_list.php");
exit();
