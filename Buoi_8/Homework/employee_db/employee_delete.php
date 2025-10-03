<?php
require '../database_functions.php';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id) {
    delete_employee($id);
}
header("location: employee_list.php");
?>