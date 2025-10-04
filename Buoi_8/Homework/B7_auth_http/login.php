<?php // login.php
session_start();
$host = 'sql209.infinityfree.com';
$db   = 'if0_39693741_buoi5';
$user = 'if0_39693741';
$pass = 'loveart1210';
$charset = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$db;charset=$charset";
$opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
if (isset($_SESSION['username'])) {
  if ($_SESSION['role'] == 'Admin') {
    header("Location: ../homepage_admin.php");
  } else {
    header("Location: ../homepage_employee.php");
  }
  exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
</head>

<body>
  <h2>Đăng nhập hệ thống</h2>
  <?php if (isset($_GET['error'])) echo "<p style='color:red'>" . $_GET['error'] . "</p>"; ?>
  <form method="post" action="authenticate.php">
    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required><br><br>
    <label>Mật khẩu:</label>
    <input type="password" name="password" required><br><br>
    <button type="submit">Đăng nhập</button>
  </form>
</body>

</html>