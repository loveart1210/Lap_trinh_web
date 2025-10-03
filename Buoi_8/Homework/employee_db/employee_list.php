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
<title>Danh sách nhân viên</title>
</head>
<body>
    <h2>Danh sách nhân viên</h2>
    <a href="../homepage_admin.php">Admin Home</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Vai trò</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr><td colspan="4">Đang tải...</td></tr>
        </tbody>
    </table>

<script>
(async function(){
  try{
    const r = await fetch('../API/api_employee_list.php',{credentials:'same-origin'});
    if(!r.ok){ const t=await r.json().catch(()=>({}));
      return document.getElementById('tbody').innerHTML =
        `<tr><td colspan="4">Lỗi (${r.status}) ${t.error||''}</td></tr>`;
    }
    const data = await r.json();
    if(!Array.isArray(data)||data.length===0){
      return document.getElementById('tbody').innerHTML =
        `<tr><td colspan="4">Không có dữ liệu</td></tr>`;
    }
    document.getElementById('tbody').innerHTML = data.map(x=>`
      <tr>
        <td>${x.emp_id}</td>
        <td>${escapeHtml(x.emp_name)}</td>
        <td>${escapeHtml(x.email)}</td>
        <td>${escapeHtml(x.role||'')}</td>
      </tr>
    `).join('');
  }catch(e){
    document.getElementById('tbody').innerHTML =
      `<tr><td colspan="4">Lỗi: ${e?.message||e}</td></tr>`;
  }
})();
function escapeHtml(s){return (s??'').toString().replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#39;');}
</script>
</body>
</html>
