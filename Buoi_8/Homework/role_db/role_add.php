<?php
require_once '../database_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_name   = $_POST['role_name'];
    $description = $_POST['description'] ?? ""; // nếu không nhập, để rỗng

    add_role($role_name);

    header("Location: role_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm vai trò</title>
</head>
<body>
    <h2>Thêm vai trò</h2>
    <form method="POST">
        <label for="role_name">Tên vai trò:</label>
        <input type="text" name="role_name" id="role_name" required><br><br>

        <button type="submit">Lưu</button>
    </form>
    <br>
    <a href="../role_list.php">Quay lại</a>
</body>
</html>
