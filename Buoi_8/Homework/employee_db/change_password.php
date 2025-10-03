<?php
session_start();
require_once '../database_functions.php';

// Chỉ cho phép employee đổi mật khẩu chính họ
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Employee') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($oldPassword, $user['password_hash'])) {
        if ($newPassword === $confirmPassword) {
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password_hash=? WHERE username=?");
            $stmt->bind_param("ss", $newHash, $username);
            $stmt->execute();
            $stmt->close();
            $msg = "Đổi mật khẩu thành công!";
        } else {
            $msg = "Mật khẩu mới và xác nhận không khớp!";
        }
    } else {
        $msg = "Mật khẩu cũ không đúng!";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
</head>
<body>
    <h2>Đổi mật khẩu</h2>
    <p style="color:red;"><?= $msg ?></p>
    <form method="post">
        Mật khẩu cũ: <input type="password" name="old_password" required><br><br>
        Mật khẩu mới: <input type="password" name="new_password" required><br><br>
        Xác nhận mật khẩu: <input type="password" name="confirm_password" required><br><br>
        <button type="submit">Đổi mật khẩu</button>
    </form>
    <br>
    <a href="../homepage_employee.php">Quay lại trang nhân viên</a>
</body>
</html>
