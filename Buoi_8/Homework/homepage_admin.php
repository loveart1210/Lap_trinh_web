<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: B7_auth_http/login.php");
    exit;
}
if ($_SESSION['role'] != 'Admin') {
    header("Location: B7_auth_http/employee_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Hệ thống Quản lý Nhân viên</title>
    <meta charset="UTF-8">
</head>
<body>
    <div class="container">
        <h1>Hệ thống Quản lý Nhân viên</h1>
        
        <a href="department_db/department_list.php" class="btn nav-link">Quản lý Phòng ban</a> | 
        <a href="role_db/role_list.php" class="btn nav-link">Quản lý Chức vụ</a> | 
        <a href="employee_db/employee_list.php" class="btn nav-link">Quản lý Nhân viên</a> |
        <a href="user_db/user_list.php" class="btn nav-link">Quản lý Users</a>
        
        <div class="setup">
            <p>Nhấn nút để tạo Database.</p>
            <a href="setup_database.php" class="btn setup-link">Tạo Database</a>
        </div><br>
        <div class="logout">
            <a href="B7_auth_http/logout.php">Đăng xuất</a>
        </div>
    </div>
</body>
</html>