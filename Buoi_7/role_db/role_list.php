<?php
require '../database_functions.php';
$roles = get_all_roles();
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Chức vụ</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Danh sách Chức vụ</h1>
     <a href="../index.php">Trang chủ</a> | <a href="role_add.php">Thêm chức vụ</a> <br/><br/>
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>ID</td>
            <td>Tên chức vụ</td>
            <td>Thao tác</td>
        </tr>
        <?php foreach ($roles as $item){ ?>
        <tr>
            <td><?php echo $item['role_id']; ?></td>
            <td><?php echo $item['role_name']; ?></td>
            <td>
                <form method="post" action="role_delete.php">
                    <input onclick="window.location = 'role_edit.php?id=<?php echo $item['role_id']; ?>'" type="button" value="Sửa"/>
                    <input type="hidden" name="id" value="<?php echo $item['role_id']; ?>"/>
                    <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>