<?php
require './libs/students.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $data = get_student($id);
}
if (!$data) {
    header("location: students_list.php");
    exit();
}
if (!empty($_POST['edit_student'])) {
    $form_data['sv_name'] = isset($_POST['name']) ? trim($_POST['name']) : '';
    $form_data['sv_sex'] = isset($_POST['sex']) ? $_POST['sex'] : '';
    $form_data['sv_birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $form_data['sv_id'] = isset($_POST['id']) ? (int)$_POST['id'] : '';
    $errors = array();
    if (empty($form_data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh viên';
    }
    if (!$errors) {
        edit_student($form_data['sv_id'], $form_data['sv_name'], $form_data['sv_sex'], $form_data['sv_birthday']);
        header("location: students_list.php");
        exit();
    }
    $data = array_merge($data, $form_data);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Sinh Viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sửa Thông Tin Sinh Viên</h1>
        <a href="students_list.php" class="back-link">Trở về danh sách</a>
        <div class="form-container">
            <form method="post" action="students_edit.php?id=<?php echo $data['id']; ?>">
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($data['hoten']); ?>">
                    <?php if (!empty($errors['sv_name'])) echo '<span class="error-message">' . $errors['sv_name'] . '</span>'; ?>
                </div>
                <div class="form-group">
                    <label for="sex">Giới Tính</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="Nam" <?php if ($data['gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if ($data['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birthday">Ngày Sinh</label>
                    <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo htmlspecialchars($data['ngaysinh']); ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <button type="submit" name="edit_student" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</body>
</html>