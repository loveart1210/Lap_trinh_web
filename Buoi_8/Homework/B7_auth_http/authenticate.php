<?php
session_start();
// Chỉ lưu session trong bộ nhớ của trình duyệt
ini_set('session.cookie_lifetime', 0); 
ini_set('session.gc_maxlifetime', 0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../B7_ajax/getData.php'; // file chứa hàm kết nối DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Bạn đã nhập thiếu thông tin");
        exit();
    }

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Kiểm tra password hash
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'Admin') {
                header("Location: ../homepage_admin.php");
            } else {
                header("Location: ../homepage_employee.php");
            }
            exit();
        }
    }
    // Sai username/password
    header("Location: login.php?error=Bạn đã đăng nhập chưa đúng, vui lòng nhập lại");
    exit();
}
?>
