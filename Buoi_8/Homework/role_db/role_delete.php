<?php
require '../database_functions.php';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id) {
    delete_role($id);
}
header("location: role_list.php");
?>