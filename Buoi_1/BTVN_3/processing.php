<?php
function calculateSum($num1, $num2) {
    return $num1 + $num2;
}

function calculateDifference($num1, $num2) {
    return $num1 - $num2;
}

function calculateProduct($num1, $num2) {
    return $num1 * $num2;
}

function calculateQuotient($num1, $num2) {
    if ($num2 == 0) {
        return "Cannot divide by zero";
    }
    return $num1 / $num2;
}

function isPrime($num) {
    if ($num <= 1) return "Không phải số nguyên tố";
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) return "Không phải số nguyên tố";
    }
    return "Số nguyên tố";
}

function isEvenOrOdd($num) {
    if (!is_numeric($num)) return "Không phải số chẵn/lẻ";
    return ($num % 2 == 0) ? "Số chẵn" : "Số lẻ";
}

// Kết nối đến cơ sở dữ liệu
$sqlservername = "sql209.infinityfree.com";  // Hostname từ InfinityFree
$sqlusername   = "if0_39693741";            // Username từ InfinityFree
$sqlpassword   = "loveart1210";         // Mật khẩu bạn đặt khi tạo DB
$sqldbname     = "if0_39693741_caculator_db";  // Tên database bạn đã tạo

$connsql = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$servername = "localhost";
$username = "root";
$password = "135790";
$database = "calculator_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save calculation history
function saveCalculation($operation, $num1, $num2, $result) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO calculation_history (operation, num1, num2, result, timestamp) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sddd", $operation, $num1, $num2, $result);
    $stmt->execute();
    $stmt->close();
}

// Save query history
function saveQuery($queryType, $num, $result) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO query_history (query_type, number, result, timestamp) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sds", $queryType, $num, $result);
    $stmt->execute();
    $stmt->close();
}

// if (isset($conn) && $conn instanceof mysqli) {
//     $conn->close();
// }
?>