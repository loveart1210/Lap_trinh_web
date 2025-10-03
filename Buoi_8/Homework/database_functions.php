<?php
global $conn;

// Hàm kết nối CSDL
function getConnection() {
    // Đổi sang database duy nhất: employee_db
    $conn = new mysqli("localhost", "root", "135790", "employee_db");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
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
    $sql = "SELECT emp_id, emp_name, COALESCE(email,'') AS email, COALESCE(role,'') AS role FROM employees ORDER BY emp_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy thông tin một nhân viên theo ID
function get_employee($employee_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = :id");
        $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return null;
    }
}

// Thêm nhân viên
function add_employee($first_name, $last_name, $department_id, $role_id)
{
    global $conn;
    connect_db();
    try {
        $sql = "INSERT INTO employees (first_name, last_name, department_id, role_id) VALUES (:first_name, :last_name, :department_id, :role_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Sửa thông tin nhân viên
function edit_employee($employee_id, $employee_firstname, $employee_lastname, $employee_dep, $employee_role)
{
    global $conn;
    connect_db();
    try {
        $sql = "UPDATE employees 
                SET first_name = :firstname, 
                    last_name = :lastname, 
                    department_id = :dep_id, 
                    role_id = :role_id 
                WHERE employee_id = :id";
        
        $stmt = $conn->prepare($sql);
        
        // Gán giá trị vào các tham số
        $stmt->bindParam(':firstname', $employee_firstname);
        $stmt->bindParam(':lastname', $employee_lastname);
        $stmt->bindParam(':dep_id', $employee_dep, PDO::PARAM_INT);
        $stmt->bindParam(':role_id', $employee_role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
        
        return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại

    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Xóa nhân viên
function delete_employee($employee_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = :id");
        $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
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
    $sql = "SELECT dept_id, dept_name, COALESCE(location,'') AS location FROM departments ORDER BY dept_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy phòng ban theo ID
function get_department($department_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM departments WHERE department_id = :id");
        $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return null;
    }
}

// Thêm phòng ban
function add_department($department_name)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("INSERT INTO Departments (department_name) VALUES (:name)");
        $stmt->bindParam(':name', $department_name);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}


// Sửa phòng ban
function edit_department($department_id, $department_name)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("UPDATE Departments SET department_name = :name WHERE department_id = :id");
        $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $department_name);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Xóa phòng ban
function delete_department($department_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("DELETE FROM Departments WHERE department_id = :id");
        $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
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
    $sql = "SELECT role_id, role_name, COALESCE(description,'') AS description FROM roles ORDER BY role_id";
    $res = $conn->query($sql);
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    $conn->close();
    return $rows;
}

// Lấy chức vụ theo ID
function get_role($role_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM employeeroles WHERE role_id = :id");
        $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return null;
    }
}

// Thêm chức vụ
function add_role($role_name)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("INSERT INTO EmployeeRoles (role_name) VALUES (:name)");
        $stmt->bindParam(':name', $role_name);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Sửa chức vụ
function edit_role($role_id, $role_name)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("UPDATE EmployeeRoles SET role_name = :name WHERE role_id = :id");
        $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $role_name);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Xóa chức vụ
function delete_role($role_id)
{
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("DELETE FROM EmployeeRoles WHERE role_id = :id");
        $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
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
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash, password_plain, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hash, $password, $role);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Sửa user
function updateUser($id, $username, $password, $role) {
    $conn = getConnection();
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username=?, password_hash=?, password_plain=?, role=? WHERE id=?");
        $stmt->bind_param("ssssi", $username, $hash, $password, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $role, $id);
    }
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Xóa user
function deleteUser($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>

