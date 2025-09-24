<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cài đặt Cơ sở dữ liệu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; padding: 10px 15px; background-color: #007bff; color: white; border-radius: 5px; }
        a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tiến trình Cài đặt Database</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "135790";
        $dbname = "employee_db";

        try {
            // Bước 1: Kết nối tới MySQL Server
            $conn = new PDO("mysql:host=$servername", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='success'>Đã kết nối thành công đến MySQL Server.</p>";

            // Bước 2: Tạo cơ sở dữ liệu `employee_db` nếu chưa tồn tại
            $conn->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $conn->exec("USE `$dbname`;");
            echo "<p class='success'>Cơ sở dữ liệu '$dbname' đã được tạo hoặc đã tồn tại.</p>";

            // Bước 3: Tạo bảng `departments`
            $sql_departments = "CREATE TABLE IF NOT EXISTS `departments` (
              `department_id` int(11) NOT NULL AUTO_INCREMENT,
              `department_name` varchar(255) NOT NULL,
              PRIMARY KEY (`department_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $conn->exec($sql_departments);
            echo "<p class='success'>Đã tạo bảng 'departments' thành công.</p>";

            // Bước 4: Tạo bảng `employeeroles`
            $sql_roles = "CREATE TABLE IF NOT EXISTS `employeeroles` (
              `role_id` int(11) NOT NULL AUTO_INCREMENT,
              `role_name` varchar(255) NOT NULL,
              PRIMARY KEY (`role_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $conn->exec($sql_roles);
            echo "<p class='success'>Đã tạo bảng 'employeeroles' thành công.</p>";
            
            // Bước 5: Tạo bảng `employees` với khóa ngoại
            $sql_employees = "CREATE TABLE IF NOT EXISTS `employees` (
              `employee_id` int(11) NOT NULL AUTO_INCREMENT,
              `first_name` varchar(255) NOT NULL,
              `last_name` varchar(255) NOT NULL,
              `department_id` int(11) DEFAULT NULL,
              `role_id` int(11) DEFAULT NULL,
              PRIMARY KEY (`employee_id`),
              KEY `department_id` (`department_id`),
              KEY `role_id` (`role_id`),
              CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE SET NULL,
              CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `employeeroles` (`role_id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $conn->exec($sql_employees);
            echo "<p class='success'>Đã tạo bảng 'employees' thành công.</p>";

            echo "<hr><p class='success'>TOÀN BỘ QUÁ TRÌNH CÀI ĐẶT ĐÃ HOÀN TẤT!</p>";

        } catch(PDOException $e) {
            echo "<p class='error'>Lỗi: " . $e->getMessage() . "</p>";
        }

        $conn = null;
        ?>
        <a href="index.php">Quay về Trang chủ</a>
    </div>
</body>
</html>