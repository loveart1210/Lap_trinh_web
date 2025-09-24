<?php
require '../database_functions.php';
$departments = get_all_departments();
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Phòng ban</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Danh sách Phòng ban</h1>
    <a href="../index.php">Trang chủ</a> | <a href="department_add.php">Thêm phòng ban</a> <br/><br/>
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>ID</td>
            <td>Tên phòng ban</td>
            <td>Thao tác</td>
        </tr>
        <?php foreach ($departments as $item){ ?>
        <tr>
            <td><?php echo $item['department_id']; ?></td>
            <td><?php echo $item['department_name']; ?></td>
            <td>
                <form method="post" action="department_delete.php">
                    <input onclick="window.location = 'department_edit.php?id=<?php echo $item['department_id']; ?>'" type="button" value="Sửa"/>
                    <input type="hidden" name="id" value="<?php echo $item['department_id']; ?>"/>
                    <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

