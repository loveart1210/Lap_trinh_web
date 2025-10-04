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
<title>Danh sách phòng ban</title>
</head>
<body>
    <h2>Danh sách phòng ban</h2>
    <a href="../homepage_admin.php">Admin Home</a> |
    <a href="department_add.php">Thêm phòng ban</a>
    <br><br>

  <table border="1" cellpadding="10" cellspacing="0">
      <thead>
          <tr>
              <th>Mã PB</th>
              <th>Tên phòng ban</th>
              <th>Hành động</th>
          </tr>
      </thead>
      <tbody id="tbody">
          <tr><td colspan="2">Đang tải...</td></tr>
      </tbody>
  </table>

<script>
(async function(){
  try{
    const r = await fetch('../API/api_department_list.php',{credentials:'same-origin'});
    if(!r.ok){ const t=await r.json().catch(()=>({}));
      return document.getElementById('tbody').innerHTML =
        `<tr><td colspan="3">Lỗi (${r.status}) ${t.error||''}</td></tr>`;
    }
    const data = await r.json();
    if(!Array.isArray(data)||data.length===0){
      return document.getElementById('tbody').innerHTML =
        `<tr><td colspan="3">Không có dữ liệu</td></tr>`;
    }
    document.getElementById('tbody').innerHTML = data.map(x=>`
      <tr>
        <td>${x.department_id}</td>
        <td>${escapeHtml(x.department_name)}</td>
        <td>
          <a href="department_edit.php?id=${x.department_id}">Sửa</a> | 
          <a href="department_delete.php?id=${x.department_id}" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
        </td>
      </tr>
    `).join('');
  }catch(e){
    document.getElementById('tbody').innerHTML =
      `<tr><td colspan="3">Lỗi: ${e?.message||e}</td></tr>`;
  }
})();
function escapeHtml(s){return (s??'').toString().replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#39;');}
</script>
</body>
</html>
