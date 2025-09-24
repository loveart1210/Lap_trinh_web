<?php
require '../database_functions.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if (!$id || !$department = get_department($id)) {
    header("location: department_list.php");
}
if (!empty($_POST['edit_department'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    if (empty($name)) {
        $error = 'Vui lòng nhập tên phòng ban';
    } else {
        edit_department($id, $name);
        header("location: department_list.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa phòng ban</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Sửa phòng ban</h1>
    <a href="department_list.php">Trở về</a> <br/><br/>
    <form method="post" action="department_edit.php?id=<?php echo $id; ?>">
        <input type="text" name="name" value="<?php echo $department['department_name']; ?>"/>
        <?php if (!empty($error)) echo $error; ?>
        <input type="submit" name="edit_department" value="Lưu"/>
    </form>
</body>
</html>