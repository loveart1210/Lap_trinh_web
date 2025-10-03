<?php
$servername = "localhost";
$username   = "root";
$password   = "135790";
$dbname     = "employee_db";

// 1. Kết nối MySQL (chưa chọn DB)
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// 2. Tạo database nếu chưa có
$sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "✅ Database '$dbname' đã sẵn sàng.<br>";
} else {
    die("Lỗi khi tạo database: " . $conn->error);
}

$conn->close();

// 3. Kết nối lại với DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

/* ================= TẠO BẢNG ================= */

// USERS
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin','Employee') NOT NULL
)";
$conn->query($sql) or die("Lỗi tạo bảng users: " . $conn->error);

// ROLES
$sql = "CREATE TABLE IF NOT EXISTS roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL,
    description VARCHAR(255) DEFAULT NULL
)";
$conn->query($sql) or die("Lỗi tạo bảng roles: " . $conn->error);

// EMPLOYEES
$sql = "CREATE TABLE IF NOT EXISTS employees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    role VARCHAR(50)
)";
$conn->query($sql) or die("Lỗi tạo bảng employees: " . $conn->error);

// DEPARTMENTS
$sql = "CREATE TABLE IF NOT EXISTS departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) DEFAULT NULL
)";
$conn->query($sql) or die("Lỗi tạo bảng departments: " . $conn->error);

echo "✅ Các bảng đã được tạo thành công.<br>";

$conn->close();
?>
