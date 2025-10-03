<?php
require '../database_functions.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if (!$id || !$role = get_role($id)) {
    header("location: role_list.php");
}
if (!empty($_POST['edit_role'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    if (empty($name)) {
        $error = 'Vui lòng nhập tên chức vụ';
    } else {
        edit_role($id, $name);
        header("location: role_list.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa chức vụ</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Sửa chức vụ</h1>
    <a href="role_list.php">Trở về</a> <br/><br/>
    <form method="post" action="role_edit.php?id=<?php echo $id; ?>">
        <input type="text" name="name" value="<?php echo $role['role_name']; ?>"/>
        <?php if (!empty($error)) echo $error; ?>
        <input type="submit" name="edit_role" value="Lưu"/>
    </form>
</body>
</html>