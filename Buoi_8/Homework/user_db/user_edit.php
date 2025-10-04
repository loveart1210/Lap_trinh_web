<?php
require_once '../database_functions.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID");
}
$id = (int)$_GET['id'];
$user = getUserById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // có thể để trống nếu không đổi
    $role     = $_POST['role'];
    updateUser($id, $username, $password, $role);
    header("Location: user_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sửa user</title></head>
<body>
<h2>Sửa user</h2>
<form method="POST">
    <label>Tài khoản:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

    <label>Mật khẩu (bỏ trống nếu không đổi):</label>
    <input type="password" name="password"><br><br>

    <label>Vai trò:</label>
    <select name="role" required>
        <option value="Admin" <?= $user['role']=="Admin"?"selected":"" ?>>Admin</option>
        <option value="Employee" <?= $user['role']=="Employee"?"selected":"" ?>>Employee</option>
    </select><br><br>

    <button type="submit">Cập nhật</button>
</form>
<a href="user_list.php">Quay lại</a>
</body>
</html>
