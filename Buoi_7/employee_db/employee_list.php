<?php
require '../database_functions.php';
$employees = get_all_employees();
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhân viên</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Danh sách nhân viên</h1>
    <a href="../index.php">Trang chủ</a> | <a href="employee_add.php">Thêm nhân viên</a> <br/> <br/>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td><b>Họ đệm</b></td>
            <td><b>Tên</b></td>
            <td><b>Chức vụ</b></td>
            <td><b>Phòng ban</b></td>
            <td><b>Thao tác</b></td>
        </tr>
        <?php foreach ($employees as $item){ ?>
        <tr>
            <td><?php echo htmlspecialchars($item['first_name']); ?></td>
            <td><?php echo htmlspecialchars($item['last_name']); ?></td>
            <td><?php echo htmlspecialchars($item['role_name'] ?? 'N/A'); ?></td>
            <td><?php echo htmlspecialchars($item['department_name'] ?? 'N/A'); ?></td>
            <td>
                <form method="post" action="employee_delete.php">
                    <input onclick="window.location = 'employee_edit.php?id=<?php echo $item['employee_id']; ?>'" type="button" value="Sửa"/>
                    <input type="hidden" name="id" value="<?php echo $item['employee_id']; ?>"/>
                    <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
