<?php
require '../database_functions.php';
if (!empty($_POST['add_role'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    if (empty($name)) {
        $error = 'Vui lòng nhập tên chức vụ';
    } else {
        add_role($name);
        header("location: role_list.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm chức vụ</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Thêm chức vụ</h1>
    <a href="role_list.php">Trở về</a> <br/><br/>
    <form method="post" action="role_add.php">
        <input type="text" name="name" value="" placeholder="Tên chức vụ"/>
        <?php if (!empty($error)) echo $error; ?>
        <input type="submit" name="add_role" value="Lưu"/>
    </form>
</body>
</html>
