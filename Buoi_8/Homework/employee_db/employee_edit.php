<?php
require '../database_functions.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if (!$id || !$employee = get_employee($id)) {
    header("location: employee_list.php");
}

$roles = get_all_roles();
$departments = get_all_departments();
$errors = [];

if (!empty($_POST['edit_employee'])) {
    $data['firstname'] = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $data['lastname'] = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $data['role_id'] = isset($_POST['role_id']) ? (int)$_POST['role_id'] : '';
    $data['department_id'] = isset($_POST['department_id']) ? (int)$_POST['department_id'] : '';

    if (empty($data['firstname'])) {
        $errors['firstname'] = 'Chưa nhập họ đệm';
    }
    if (empty($data['lastname'])) {
        $errors['lastname'] = 'Chưa nhập tên';
    }

    if (!$errors) {
        edit_employee($id, $data['firstname'], $data['lastname'], $data['department_id'], $data['role_id']);
        header("location: employee_list.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin nhân viên</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Sửa thông tin nhân viên</h1>
    <a href="employee_list.php">Trở về</a> <br/> <br/>
    <form method="post" action="employee_edit.php?id=<?php echo $id; ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Họ đệm</td>
                <td>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($employee['first_name']); ?>"/>
                    <?php if (!empty($errors['firstname'])) echo $errors['firstname']; ?>
                </td>
            </tr>
            <tr>
                <td>Tên</td>
                <td>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($employee['last_name']); ?>"/>
                    <?php if (!empty($errors['lastname'])) echo $errors['lastname']; ?>
                </td>
            </tr>
            <tr>
                <td>Chức vụ</td>
                <td>
                    <select name="role_id">
                        <?php foreach ($roles as $item){ ?>
                        <option value="<?php echo $item['role_id']; ?>" <?php if ($employee['role_id'] == $item['role_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($item['role_name']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Phòng ban</td>
                <td>
                    <select name="department_id">
                        <?php foreach ($departments as $item){ ?>
                        <option value="<?php echo $item['department_id']; ?>" <?php if ($employee['department_id'] == $item['department_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($item['department_name']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="edit_employee" value="Lưu"/></td>
            </tr>
        </table>
    </form>
</body>
</html>
