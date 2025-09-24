<?php
require '../database_functions.php';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id) {
    delete_department($id);
}
header("location: department_list.php");
?>
