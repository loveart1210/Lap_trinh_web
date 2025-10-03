<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

require_once '../database_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    addUser($_POST['username'], $_POST['password'], $_POST['role']);
    header("Location: user_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm User</title>
</head>
<body>
    <h2>Thêm User</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Role: 
        <select name="role">
            <option value="Admin">Admin</option>
            <option value="Employee">Employee</option>
        </select><br><br>
        <input type="submit" value="Thêm">
    </form>
    <br>
    <a href="user_list.php">Quay lại danh sách</a>
</body>
</html>
