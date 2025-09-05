-- Tạo cơ sở dữ liệu
-- CREATE DATABASE employee_management;
-- USE employee_management;

-- Tạo bảng departments
-- CREATE TABLE departments (
--     department_id INT(11) PRIMARY KEY,
--     department_name VARCHAR(100) NOT NULL
-- );

-- Tạo bảng employeeroles
-- CREATE TABLE employeeroles (
--     role_id INT(11) PRIMARY KEY,
--     role_name VARCHAR(100) NOT NULL
-- );

-- Tạo bảng employees
-- CREATE TABLE employees (
--     employee_id INT(11) PRIMARY KEY,
--     first_name VARCHAR(50) NOT NULL,
--     last_name VARCHAR(50) NOT NULL,
--     department_id INT(11),
--     role_id INT(11),
--     CONSTRAINT fk_department FOREIGN KEY (department_id) REFERENCES departments(department_id),
--     CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES employeeroles(role_id)
-- );

-- Thêm dữ liệu vào bảng departments
-- INSERT INTO departments (department_id, department_name) VALUES
-- (1, 'HR'),
-- (2, 'Marketing'),
-- (3, 'IT'),
-- (4, 'Finance'),
-- (5, 'Operations');

-- Thêm dữ liệu vào bảng employeeroles
-- INSERT INTO employeeroles (role_id, role_name) VALUES
-- (1, 'Manager'),
-- (2, 'Employee'),
-- (3, 'Intern'),
-- (4, 'Analyst'),
-- (5, 'Director');

-- Thêm dữ liệu vào bảng employees
-- INSERT INTO employees (employee_id, first_name, last_name, department_id, role_id) VALUES
-- (1, 'John', 'Doe', 1, 1),
-- (2, 'Jane', 'Smith', 2, 2),
-- (3, 'Michael', 'Johnson', 1, 3),
-- (4, 'Emily', 'Williams', 2, 1),
-- (5, 'David', 'Brown', 3, 3);

-- 1. Lấy danh sách tất cả nhân viên (bao gồm họ tên, tên phòng ban, tên chức vụ)
SELECT e.first_name, e.last_name, d.department_name, r.role_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id;

-- 2. Lấy danh sách tên tất cả phòng ban
SELECT department_name
FROM departments;

-- 3. Lấy thông tin nhân viên (họ tên, phòng ban, chức vụ) có ID là 3
SELECT e.first_name, e.last_name, d.department_name, r.role_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id
WHERE e.employee_id = 3;

-- 4. Lấy danh sách nhân viên (họ tên, chức vụ, phòng ban) làm việc trong phòng ban "HR"
SELECT e.first_name, e.last_name, r.role_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id
WHERE d.department_name = 'HR';

-- 5. Lấy danh sách nhân viên (họ tên, phòng ban) có vai trò là "Manager"
SELECT e.first_name, e.last_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id
WHERE r.role_name = 'Manager';

-- 6. Lấy tên phòng ban và số lượng nhân viên trong mỗi phòng ban
SELECT d.department_name, COUNT(e.employee_id) AS total_employees
FROM departments d
LEFT JOIN employees e ON d.department_id = e.department_id
GROUP BY d.department_id, d.department_name;

-- 7. Lấy thông tin chức vụ của nhân viên có ID là 2
SELECT r.role_name
FROM employees e
JOIN employeeroles r ON e.role_id = r.role_id
WHERE e.employee_id = 2;

-- 8. Lấy danh sách nhân viên có tên bắt đầu bằng "J"
SELECT e.first_name, e.last_name
FROM employees e
WHERE e.first_name LIKE 'J%';

-- 9. Lấy danh sách các phòng ban và tên của nhân viên có chức vụ "Manager"
SELECT d.department_name, e.first_name, e.last_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id
WHERE r.role_name = 'Manager';

-- 10. Lấy số lượng nhân viên trong mỗi phòng ban và sắp xếp theo số lượng giảm dần
SELECT d.department_name, COUNT(e.employee_id) AS total_employees
FROM departments d
LEFT JOIN employees e ON d.department_id = e.department_id
GROUP BY d.department_id, d.department_name
ORDER BY total_employees DESC;

-- 11. Lấy thông tin vai trò của nhân viên có tên là "Emily Williams"
SELECT r.role_name
FROM employees e
JOIN employeeroles r ON e.role_id = r.role_id
WHERE e.first_name = 'Emily' AND e.last_name = 'Williams';

-- 12. Lấy danh sách nhân viên làm việc trong phòng ban có tên bắt đầu bằng "M"
SELECT e.first_name, e.last_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
WHERE d.department_name LIKE 'M%';

-- 13. Lấy thông tin nhân viên và tên phòng ban của nhân viên có chức vụ "Director"
SELECT e.first_name, e.last_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN employeeroles r ON e.role_id = r.role_id
WHERE r.role_name = 'Director';

-- 14. Lấy danh sách nhân viên làm việc trong phòng ban "IT" hoặc "Finance"
SELECT e.first_name, e.last_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id
WHERE d.department_name IN ('IT', 'Finance');

-- 15. Lấy danh sách nhân viên và số lượng nhân viên của phòng ban có nhiều nhân viên nhất
SELECT e.first_name, e.last_name, d.department_name, sub.max_count AS total_employees
FROM employees e
JOIN departments d ON e.department_id = d.department_id
JOIN (
    SELECT department_id, COUNT(employee_id) AS max_count
    FROM employees
    GROUP BY department_id
    ORDER BY max_count DESC
    LIMIT 1
) sub ON e.department_id = sub.department_id;
