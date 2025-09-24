<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Hệ thống Quản lý Nhân viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&display=swap');

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            margin: 50px 0 0 0;
            padding: 40px;
            text-align: center;
            background-color: #FFF5F7; /* Màu nền hồng rất nhạt */
            color: #555;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        h1 {
            color: #D6336C; /* Màu hồng đậm cho tiêu đề */
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        p {
            color: #777;
            font-size: 1.1em;
        }
        .navigation, .setup {
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            margin: 10px 15px;
            padding: 14px 28px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            min-width: 200px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .nav-link {
            background-color: #E75480; /* Màu hồng chính */
        }
        .nav-link:hover {
            background-color: #D6336C; /* Màu hồng đậm hơn khi di chuột */
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 84, 128, 0.4);
        }
        
        .setup-link {
            background-color: #F06595; /* Màu hồng sáng hơn một chút */
        }
        .setup-link:hover {
            background-color: #D6336C; /* Đồng bộ màu hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(240, 101, 149, 0.4);
        }
        hr {
            border: none;
            border-top: 1px solid #FFE3E9;
            margin: 40px auto 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💖 Hệ thống Quản lý Nhân viên 💖</h1>
        
        <div class="navigation">
            <a href="department_db/department_list.php" class="btn nav-link">Quản lý Phòng ban</a>
            <a href="role_db/role_list.php" class="btn nav-link">Quản lý Chức vụ</a>
            <a href="employee_db/employee_list.php" class="btn nav-link">Quản lý Nhân viên</a>
        </div>

        <div class="setup">
            <hr>
            <p>Nếu đây là lần đầu tiên sử dụng, vui lòng nhấn nút dưới đây để cài đặt.</p>
            <a href="setup_database.php" class="btn setup-link">Cài đặt Database</a>
        </div>
    </div>
</body>
</html>