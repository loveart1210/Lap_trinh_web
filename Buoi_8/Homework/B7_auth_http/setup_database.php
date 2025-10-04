<?php
$host = 'sql209.infinityfree.com';
$db   = 'if0_39693741_buoi5';
$user = 'if0_39693741';
$pass = 'loveart1210';

$conn = new mysqli($host, $user, $pass);

// Tạo DB nếu chưa có
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Tạo bảng
$conn->query("CREATE TABLE IF NOT EXISTS departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(255) NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL,
    description VARCHAR(255)
)");

$conn->query("CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    department_id INT,
    role_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(department_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
)");

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin','Employee') NOT NULL
)");

echo "✅ Database 'employee_db' và các bảng đã được tạo thành công.";
$conn->close();
?>
