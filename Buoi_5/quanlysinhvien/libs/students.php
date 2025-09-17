<?php
/**
 * File thư viện cho các hàm xử lý sinh viên, được viết lại bằng PDO.
 */

// Biến toàn cục để lưu trữ kết nối PDO, đảm bảo chỉ kết nối một lần
global $conn;

/**
 * Hàm kết nối cơ sở dữ liệu bằng PDO.
 * Sử dụng biến $conn toàn cục để tránh kết nối lại nhiều lần.
 * @return PDO đối tượng kết nối PDO
 */
function connect_db()
{
    global $conn;

    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn) {
        $host = "sql209.infinityfree.com";
        $dbname = "if0_39693741_buoi5"; // Tên database
        $user = "if0_39693741";
        $password = "loveart1210";

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $conn = new PDO($dsn, $user, $password);
            // Thiết lập chế độ báo lỗi để PDO ném ra ngoại lệ khi có lỗi
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Không thể kết nối đến cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    return $conn;
}

/**
 * Hàm ngắt kết nối database. Với PDO, việc này thường không cần thiết
 * vì kết nối sẽ tự động đóng khi script kết thúc.
 * Ta chỉ cần gán biến kết nối về null.
 */
function disconnect_db()
{
    global $conn;
    if ($conn) {
        $conn = null;
    }
}

/**
 * Hàm lấy tất cả sinh viên.
 * @return array Mảng chứa tất cả sinh viên
 */
function get_all_students()
{
    $conn = connect_db();
    $sql = "SELECT * FROM sinhvien";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Hàm lấy thông tin một sinh viên theo ID.
 * @param int $student_id ID của sinh viên
 * @return array Mảng chứa thông tin sinh viên, hoặc false nếu không tìm thấy
 */
function get_student($student_id)
{
    $conn = connect_db();
    $sql = "SELECT * FROM sinhvien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Hàm thêm mới sinh viên.
 * @param string $student_name Tên sinh viên
 * @param string $student_sex Giới tính
 * @param string $student_birthday Ngày sinh
 * @return bool True nếu thành công, False nếu thất bại
 */
function add_student($student_name, $student_sex, $student_birthday)
{
    $conn = connect_db();
    $sql = "INSERT INTO sinhvien(hoten, gioitinh, ngaysinh) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$student_name, $student_sex, $student_birthday]);
}

/**
 * Hàm cập nhật thông tin sinh viên.
 * @param int $student_id ID sinh viên cần sửa
 * @param string $student_name Tên sinh viên mới
 * @param string $student_sex Giới tính mới
 * @param string $student_birthday Ngày sinh mới
 * @return bool True nếu thành công, False nếu thất bại
 */
function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    $conn = connect_db();
    $sql = "UPDATE sinhvien SET hoten = ?, gioitinh = ?, ngaysinh = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$student_name, $student_sex, $student_birthday, $student_id]);
}

/**
 * Hàm xóa sinh viên.
 * @param int $student_id ID của sinh viên cần xóa
 * @return bool True nếu thành công, False nếu thất bại
 */
function delete_student($student_id)
{
    $conn = connect_db();
    $sql = "DELETE FROM sinhvien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$student_id]);
}

?>