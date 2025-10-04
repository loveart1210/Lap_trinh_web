<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: B7_auth_http/login.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách người dùng</title>
</head>
<body>
    <h2>Danh sách người dùng</h2>
    <a href="../homepage_admin.php">Admin Home</a> |
    <a href="user_add.php">Thêm người dùng</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0" id="tbl">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr><td colspan="4">Đang tải...</td></tr>
        </tbody>
    </table>

<script>
(async function(){
  try {
    const r = await fetch('../API/api_user_list.php');
    const data = await r.json();
    if (!Array.isArray(data) || data.length === 0) {
      document.getElementById('tbody').innerHTML =
        `<tr><td colspan="5">Không có dữ liệu</td></tr>`;
      return;
    }

    document.getElementById('tbody').innerHTML = data.map(user => `
      <tr>
        <td>${user.id}</td>
        <td>${escapeHtml(user.username)}</td>
        <td>${escapeHtml(user.password_hash ?? "")}</td>
        <td>${escapeHtml(user.role)}</td>
        <td>
          <a href="user_edit.php?id=${user.id}">Sửa</a> | 
          <a href="user_delete.php?id=${user.id}" onclick="return confirm('Bạn có chắc muốn xóa user này?')">Xóa</a>
        </td>
      </tr>
    `).join('');
  } catch (e) {
    document.getElementById('tbody').innerHTML =
      `<tr><td colspan="5">Lỗi: ${e.message}</td></tr>`;
  }
})();

function escapeHtml(str){
  return (str??'').toString()
    .replaceAll('&','&amp;').replaceAll('<','&lt;')
    .replaceAll('>','&gt;').replaceAll('"','&quot;')
    .replaceAll("'",'&#39;');
}
</script>

</body>
</html>
