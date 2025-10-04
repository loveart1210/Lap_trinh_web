<?php
global $conn;

// Hàm kết nối CSDL
function getConnection()
{
    static $pdo;
    if ($pdo) return $pdo;

    $host = 'sql209.infinityfree.com';
    $db   = 'if0_39693741_buoi8';
    $user = 'if0_39693741';
    $pass = 'loveart1210';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);
    return $pdo;
}



// Hàm ngắt kết nối
function disconnect_db()
{
    global $conn;
    $conn = null;
}

/*
|--------------------------------------------------------------------------
| CÁC HÀM XỬ LÝ NHÂN VIÊN (EMPLOYEES)
|--------------------------------------------------------------------------
*/

// Lấy tất cả nhân viên
function get_all_employees()
{
    $pdo = getConnection(); // PDO
    $sql = "SELECT e.employee_id, 
                   e.first_name, 
                   e.last_name, 
                   d.department_name, 
                   r.role_name
            FROM employees e
            LEFT JOIN departments d ON e.department_id = d.department_id
            LEFT JOIN roles r ON e.role_id = r.role_id
            ORDER BY e.employee_id";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

// Lấy thông tin 1 nhân viên
function get_employee($employee_id)
{
    $pdo = getConnection();
    $sql = "SELECT * FROM employees WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// Thêm nhân viên
function add_employee($first_name, $last_name, $department_id, $role_id)
{
    $pdo = getConnection();
    $sql = "INSERT INTO employees (first_name, last_name, department_id, role_id)
            VALUES (:first_name, :last_name, :dep, :role)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':dep', $department_id, PDO::PARAM_INT);
    $stmt->bindParam(':role', $role_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Cập nhật nhân viên
function edit_employee($employee_id, $employee_firstname, $employee_lastname, $employee_dep, $employee_role)
{
    $pdo = getConnection();
    $sql = "UPDATE employees 
            SET first_name = :first_name, 
                last_name = :last_name, 
                department_id = :dep_id, 
                role_id = :role_id 
            WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $employee_firstname);
    $stmt->bindParam(':last_name', $employee_lastname);
    $stmt->bindParam(':dep_id', $employee_dep, PDO::PARAM_INT);
    $stmt->bindParam(':role_id', $employee_role, PDO::PARAM_INT);
    $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Xóa nhân viên
function delete_employee($employee_id)
{
    $pdo = getConnection();
    $sql = "DELETE FROM employees WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
    return $stmt->execute();
}

/*
|--------------------------------------------------------------------------
| CÁC HÀM XỬ LÝ PHÒNG BAN (DEPARTMENTS)
|--------------------------------------------------------------------------
*/

// Lấy tất cả phòng ban
function get_all_departments()
{
    $pdo = getConnection();
    $sql = "SELECT department_id, department_name FROM departments ORDER BY department_id";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy phòng ban theo ID
function get_department($department_id)
{
    $pdo = getConnection();
    $sql = "SELECT * FROM departments WHERE department_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm phòng ban
function add_department($department_name)
{
    $pdo = getConnection();
    $sql = "INSERT INTO departments (department_name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $department_name, PDO::PARAM_STR);
    return $stmt->execute();
}

// Sửa phòng ban
function edit_department($department_id, $department_name)
{
    $pdo = getConnection();
    $sql = "UPDATE departments SET department_name = :name WHERE department_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $department_name, PDO::PARAM_STR);
    $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Xóa phòng ban
function delete_department($department_id)
{
    $pdo = getConnection();
    $sql = "DELETE FROM departments WHERE department_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
    return $stmt->execute();
}

/*
|--------------------------------------------------------------------------
| CÁC HÀM XỬ LÝ CHỨC VỤ (ROLES)
|--------------------------------------------------------------------------
*/

// Lấy tất cả chức vụ
function get_all_roles()
{
    $pdo = getConnection();
    $sql = "SELECT role_id, role_name FROM roles ORDER BY role_id";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy chức vụ theo ID
function get_role($role_id)
{
    $pdo = getConnection();
    $sql = "SELECT * FROM roles WHERE role_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm chức vụ
function add_role($role_name)
{
    $pdo = getConnection();
    $sql = "INSERT INTO roles (role_name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $role_name, PDO::PARAM_STR);
    return $stmt->execute();
}

// Sửa chức vụ
function edit_role($role_id, $role_name)
{
    $pdo = getConnection();
    $sql = "UPDATE roles SET role_name = :name WHERE role_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $role_name, PDO::PARAM_STR);
    $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Xóa chức vụ
function delete_role($role_id)
{
    $pdo = getConnection();
    $sql = "DELETE FROM roles WHERE role_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// ================= USER FUNCTIONS =================

// Lấy tất cả users
function getAllUsers() {
    $pdo = getConnection();
    $sql = "SELECT id, username, role, password_hash FROM users ORDER BY id";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy user theo id
function getUserById($id) {
    $pdo = getConnection();
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm user
function addUser($username, $password, $role) {
    $pdo = getConnection();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password_hash, role) VALUES (:username, :hash, :role)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':hash', $hash);
    $stmt->bindParam(':role', $role);
    return $stmt->execute();
}

// Sửa user
function updateUser($id, $username, $password, $role) {
    $pdo = getConnection();
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = :username, password_hash = :hash, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hash', $hash);
    } else {
        $sql = "UPDATE users SET username = :username, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
    }
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Xóa user
function deleteUser($id) {
    $pdo = getConnection();
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
?>

