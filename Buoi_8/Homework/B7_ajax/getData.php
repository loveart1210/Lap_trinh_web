<?php
function getConnection() {
    $conn = new mysqli("localhost", "root", "135790", "employee_db");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}

function getUser($username, $password) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT username, password_hash, role FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    }
    return null;
}

