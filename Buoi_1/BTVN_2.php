<!DOCTYPE html>
<html>
<head>
    <style>
        body {
        width: 70%;
        margin: auto;
    }

        #books {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #books td, #books th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        }

        #books tr:nth-child(even){background-color: #f2f2f2;}

        #books tr:hover {background-color: #ddd;}

        #books th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #04AA6D;
        color: white;
        }

        #pagination {
            font-family: 'Open Sans';
            font-size: 20px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // Số dòng trên mỗi trang
    $rowsPerPage = 10;

    // Trang hiện tại, mặc định là 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $rowsPerPage;

    // Tạo dữ liệu mẫu
    $data = [];
    for ($i = 1; $i <= 100; $i++) {
        $data[] = [
            'STT' => $i,
            'TenSach' => "Tensach $i",
            'NoiDung' => "Noidung $i"
        ];
    }

    // Lấy dữ liệu cho trang hiện tại
    $paginatedData = array_slice($data, $start, $rowsPerPage);

    // Tính tổng số trang
    $totalPages = ceil(count($data) / $rowsPerPage);
    ?>

    <table id="books">
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Nội dung sách</th>
        </tr>
        <?php foreach ($paginatedData as $row): ?>
        <tr>
            <td><?php echo $row['STT']; ?></td>
            <td><?php echo $row['TenSach']; ?></td>
            <td><?php echo $row['NoiDung']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <div id="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php echo $i == $page ? 'style="font-weight:bold;"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>