<?php
require './libs/students.php';
$students = get_all_students();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Sinh Viên</h1>
        <a href="students_add.php" class="btn btn-add">Thêm Sinh Viên Mới</a>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th class="actions">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['hoten']); ?></td>
                    <td><?php echo htmlspecialchars($item['gioitinh']); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($item['ngaysinh'])); ?></td>
                    <td class="actions">
                        <a href="students_edit.php?id=<?php echo $item['id']; ?>" class="btn btn-edit">Sửa</a>
                        <form method="post" action="students_delete.php">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?');">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>