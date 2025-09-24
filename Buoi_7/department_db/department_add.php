<?php
// require '../database_functions.php';
// if (!empty($_POST['add_department'])) {
//     $name = isset($_POST['name']) ? $_POST['name'] : '';
//     add_department($name);
//     header("location: department_list.php");
// }
// disconnect_db();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thêm Phòng Ban</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="navigation-links">
            <a href="../index.php">Về trang chủ</a>
            <a href="department_list.php">Quay lại danh sách</a>
        </div>
        <h1>Thêm Phòng Ban Mới</h1>
        <form method="post" action="department_add.php" class="form-modern">
            <div class="form-group">
                <label for="name">Tên phòng ban</label>
                <input type="text" id="name" name="name" required placeholder="Ví dụ: Phòng Kỹ thuật">
            </div>
            <div class="form-group">
                <button type="submit" name="add_department" class="btn btn-save">Lưu lại</button>
            </div>
        </form>
    </div>
</body>
</html>