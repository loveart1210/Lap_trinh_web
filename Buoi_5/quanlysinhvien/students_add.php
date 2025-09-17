<?php
require './libs/students.php';
if (!empty($_POST['add_student'])) {
    $data['sv_name'] = isset($_POST['name']) ? trim($_POST['name']) : '';
    $data['sv_sex'] = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['sv_birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $errors = array();
    if (empty($data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh viên';
    }
    if (empty($data['sv_sex'])) {
        $errors['sv_sex'] = 'Chưa chọn giới tính';
    }
    if (!$errors) {
        add_student($data['sv_name'], $data['sv_sex'], $data['sv_birthday']);
        header("location: students_list.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Thêm Sinh Viên Mới</h1>
        <a href="students_list.php" class="back-link">Trở về danh sách</a>
        <div class="form-container">
            <form method="post" action="students_add.php">
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo !empty($data['sv_name']) ? htmlspecialchars($data['sv_name']) : ''; ?>">
                    <?php if (!empty($errors['sv_name'])) echo '<span class="error-message">' . $errors['sv_name'] . '</span>'; ?>
                </div>
                <div class="form-group">
                    <label for="sex">Giới Tính</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="">-- Chọn Giới Tính --</option>
                        <option value="Nam" <?php if (!empty($data['sv_sex']) && $data['sv_sex'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if (!empty($data['sv_sex']) && $data['sv_sex'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                    <?php if (!empty($errors['sv_sex'])) echo '<span class="error-message">' . $errors['sv_sex'] . '</span>'; ?>
                </div>
                <div class="form-group">
                    <label for="birthday">Ngày Sinh</label>
                    <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo !empty($data['sv_birthday']) ? htmlspecialchars($data['sv_birthday']) : ''; ?>">
                </div>
                <button type="submit" name="add_student" class="btn btn-primary">Lưu Lại</button>
            </form>
        </div>
    </div>
</body>
</html>