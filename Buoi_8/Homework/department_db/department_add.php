<?php
require '../database_functions.php';
if (!empty($_POST['add_department'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    if (empty($name)) {
        $error = 'Vui lòng nhập tên phòng ban';
    } else {
        add_department($name);
        header("location: department_list.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm phòng ban</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Thêm phòng ban</h1>
    <a href="department_list.php">Trở về</a> <br/><br/>
    <form method="post" action="department_add.php">
        <input type="text" name="name" value="" placeholder="Tên phòng ban"/>
        <?php if (!empty($error)) echo $error; ?>
        <input type="submit" name="add_department" value="Lưu"/>
    </form>
</body>
</html>