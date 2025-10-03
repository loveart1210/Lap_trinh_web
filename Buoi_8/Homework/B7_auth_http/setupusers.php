<?php
$servername = "localhost";
$username   = "root";
$password   = "135790";
$dbname     = "company_db";

// Kết nối MySQL mà chưa chọn DB
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo database nếu chưa có
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database $dbname đã sẵn sàng.<br>";
} else {
    die("Lỗi khi tạo database: " . $conn->error);
}

$conn->close();

// Kết nối lại nhưng lần này có DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo bảng users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    password_plain VARCHAR(255) NOT NULL,
    role ENUM('Admin','Employee') NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng users thành công.<br>";
} else {
    die("Lỗi khi tạo bảng users: " . $conn->error);
}

// Chuẩn bị dữ liệu mẫu
$adminPlain     = "123456";
$employeePlain  = "123456";

$adminHash     = password_hash($adminPlain, PASSWORD_DEFAULT);
$employeeHash  = password_hash($employeePlain, PASSWORD_DEFAULT);

// Thêm user mẫu
$sqlInsert = "INSERT IGNORE INTO users (username, password_hash, password_plain, role) VALUES
    ('admin', '$adminHash', '$adminPlain', 'Admin'),
    ('employee', '$employeeHash', '$employeePlain', 'Employee')";

if ($conn->query($sqlInsert) === TRUE) {
    echo "Đã thêm user mẫu (admin/employee).<br>";
} else {
    die("Lỗi khi thêm user mẫu: " . $conn->error);
}

$conn->close();
?>
