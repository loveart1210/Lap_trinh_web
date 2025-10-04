<?php
global $conn;

// Hàm kết nối CSDL
function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "135790";
    $dbname = "employee_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;  // BẮT BUỘC phải return
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
    $conn = getConnection();
    $sql = "SELECT e.employee_id, 
                   e.first_name, 
                   e.last_name, 
                   d.department_name, 
                   r.role_name
            FROM employees e
            LEFT JOIN departments d ON e.department_id = d.department_id
            LEFT JOIN roles r ON e.role_id = r.role_id
            ORDER BY e.employee_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy thông tin một nhân viên theo ID
function get_employee($employee_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id=?");
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $row;
}

// Thêm nhân viên
function add_employee($first_name, $last_name, $department_id, $role_id)
{
    $conn = getConnection(); // lấy kết nối MySQLi
    $sql = "INSERT INTO employees (first_name, last_name, department_id, role_id) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $first_name, $last_name, $department_id, $role_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}


// Sửa thông tin nhân viên
function edit_employee($employee_id, $employee_firstname, $employee_lastname, $employee_dep, $employee_role)
{
    $conn = getConnection(); // lấy kết nối MySQLi
    $sql = "UPDATE employees 
            SET first_name=?, 
                last_name=?, 
                department_id=?, 
                role_id=? 
            WHERE employee_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $employee_firstname, $employee_lastname, $employee_dep, $employee_role, $employee_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}


// Xóa nhân viên
function delete_employee($employee_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id=?");
    $stmt->bind_param("i", $employee_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}

/*
|--------------------------------------------------------------------------
| CÁC HÀM XỬ LÝ PHÒNG BAN (DEPARTMENTS)
|--------------------------------------------------------------------------
*/

// Lấy tất cả phòng ban
function get_all_departments()
{
    $conn = getConnection();
    $sql = "SELECT department_id, department_name FROM departments ORDER BY department_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy phòng ban theo ID
function get_department($department_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM departments WHERE department_id=?");
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $row;
}

// Thêm phòng ban
function add_department($department_name) {
    $conn = getConnection(); // lấy kết nối từ hàm getConnection()
    $stmt = $conn->prepare("INSERT INTO departments (department_name) VALUES (?)");
    $stmt->bind_param("s", $department_name);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}



// Sửa phòng ban
function edit_department($department_id, $department_name)
{
    $conn = getConnection(); // lấy kết nối MySQLi
    $stmt = $conn->prepare("UPDATE departments SET department_name=? WHERE department_id=?");
    $stmt->bind_param("si", $department_name, $department_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}


// Xóa phòng ban
function delete_department($department_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM departments WHERE department_id=?");
    $stmt->bind_param("i", $department_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}

/*
|--------------------------------------------------------------------------
| CÁC HÀM XỬ LÝ CHỨC VỤ (ROLES)
|--------------------------------------------------------------------------
*/

// Lấy tất cả chức vụ
function get_all_roles()
{
    $conn = getConnection();
    $sql = "SELECT role_id, role_name FROM roles ORDER BY role_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy chức vụ theo ID
function get_role($role_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM roles WHERE role_id=?");
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $row;
}

// Thêm chức vụ
function add_role($role_name) {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO roles (role_name) VALUES (?)");
    $stmt->bind_param("s", $role_name);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


// Sửa chức vụ
function edit_role($role_id, $role_name)
{
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE roles SET role_name=? WHERE role_id=?");
    $stmt->bind_param("si", $role_name, $role_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Xóa chức vụ
function delete_role($role_id)
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM roles WHERE role_id=?");
    $stmt->bind_param("i", $role_id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}
?>

<?php
// ================= USER FUNCTIONS =================

// Lấy tất cả users
function getAllUsers() {
    $conn = getConnection();
    $sql = "SELECT id, username, role, password_hash FROM users ORDER BY id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy user theo id
function getUserById($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $user;
}

// Thêm user
function addUser($username, $password, $role) {
    $conn = getConnection();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hash, $role);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


// Sửa user
function updateUser($id, $username, $password, $role) {
    $conn = getConnection();
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username=?, password_hash=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $hash, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $role, $id);
    }
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}

// Xóa user
function deleteUser($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $ok = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $ok;
}
?>

