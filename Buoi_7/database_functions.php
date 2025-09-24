<?php
global $conn;

// Hàm kết nối CSDL
function connect_db()
{
    global $conn;
    if ($conn) {
        return;
    }
    try {
        $conn = new PDO("mysql:host=localhost; dbname=employee_db;charset=utf8", 'root', '135790');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Lỗi kết nối CSDL: " . $e->getMessage());
    }
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
    global $conn;
    connect_db();
    try {
        $sql = "SELECT e.employee_id, e.first_name, e.last_name, d.department_name, r.role_name 
                FROM Employees e
                LEFT JOIN Departments d ON e.department_id = d.department_id 
                LEFT JOIN EmployeeRoles r ON e.role_id = r.role_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return [];
    }
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
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM departments ORDER BY department_name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return [];
    }
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
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM EmployeeRoles ORDER BY role_name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return [];
    }
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