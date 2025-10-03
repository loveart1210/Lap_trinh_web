<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

require_once '../database_functions.php';

$id = $_GET['id'] ?? 0;
$user = getUserById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updateUser($id, $_POST['username'], $_POST['password'], $_POST['role']);
    header("Location: user_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa User</title>
</head>
<body>
    <h2>Sửa User</h2>
    <form method="post">
        Username: <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>
        Password (để trống nếu không đổi): <input type="password" name="password"><br><br>
        Role: 
        <select name="role">
            <option value="Admin" <?= $user['role']=='Admin'?'selected':'' ?>>Admin</option>
            <option value="Employee" <?= $user['role']=='Employee'?'selected':'' ?>>Employee</option>
        </select><br><br>
        <input type="submit" value="Cập nhật">
    </form>
    <br>
    <a href="user_list.php">Quay lại danh sách</a>
</body>
</html>
