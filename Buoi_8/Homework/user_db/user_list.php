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
    <a href="user_add.php">Thêm người dùng</a><br>
    <a href="../homepage_admin.php">Admin Home</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0" id="tbl">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu (hash)</th>
                <th>Vai trò</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr><td colspan="4">Đang tải...</td></tr>
        </tbody>
    </table>

<script>
(async function loadUsers(){
  try {
    const r = await fetch('../API/api_user_list.php', {credentials:'same-origin'});
    if (!r.ok) {
      const t = await r.json().catch(()=>({}));
      document.getElementById('tbody').innerHTML =
        `<tr><td colspan="4">Lỗi tải dữ liệu (${r.status}) ${t.error||''}</td></tr>`;
      return;
    }
    const data = await r.json();
    if (!Array.isArray(data) || data.length===0) {
      document.getElementById('tbody').innerHTML =
        `<tr><td colspan="4">Không có dữ liệu</td></tr>`;
      return;
    }
    document.getElementById('tbody').innerHTML = data.map(u => `
      <tr>
        <td>${u.id}</td>
        <td>${escapeHtml(u.username)}</td>
        <td>${escapeHtml(u.password_hash)}</td>
        <td>${escapeHtml(u.role||'')}</td>
      </tr>
    `).join('');
  } catch (e) {
    document.getElementById('tbody').innerHTML =
      `<tr><td colspan="4">Lỗi: ${e?.message||e}</td></tr>`;
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
