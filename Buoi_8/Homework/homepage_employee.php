<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Employee') {
    header("Location: B7_auth_http/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Nhân viên</title>
</head>
<body>
    <h1>Xin chào <?php echo $_SESSION['username']; ?>.</h1>
    <p>Đây là trang cho nhân viên.</p>
    <a href="employee_db/change_password.php">Đổi mật khẩu</a><br><br>
    <a href="B7_auth_http/logout.php">Đăng xuất</a>
</body>
</html>
