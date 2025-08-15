<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chức năng xử lý mảng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
        }
        .input-section {
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
        }
        .input-section input[type="text"] {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
        }
        .input-section input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .input-section input[type="submit"]:hover {
            background-color: #45a049;
        }
        .left-section, .right-section {
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
        }
        .left-section {
            background-color: #fff;
            border-right: 1px solid #ddd;
        }
        .right-section {
            background-color: #fff;
        }
        .result-box {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .right-section input[type="number"] {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
        }
        @media (max-width: 768px) {
            .left-section, .right-section {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
    <h1>Chức năng xử lý mảng</h1>
    <div class="container">
        <div class="input-section">
            <form method="POST" action="">
                <input type="text" name="array_input" placeholder="Nhập mảng, ví dụ: 1,2.5,3.7,4,5.2" required>
                <input type="submit" value="Xử lý">
            </form>
        </div>

        <?php
        include 'processing.php';
        $input_array = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['array_input'])) {
            $input = $_POST['array_input'];
            $input_array = array_map('floatval', explode(',', $input));
        }
        ?>

        <div class="left-section">
            <h2>Kết quả xử lý</h2>
            <div class="result-box">
                <strong>Dãy gốc:</strong> 
                <?php echo !empty($input_array) ? getOriginalArray($input_array) : "Chưa nhập mảng"; ?>
            </div>
            <div class="result-box">
                <strong>Giá trị lớn nhất:</strong> 
                <?php echo !empty($input_array) ? findMax($input_array) : "Chưa nhập mảng"; ?>
            </div>
            <div class="result-box">
                <strong>Giá trị nhỏ nhất:</strong> 
                <?php echo !empty($input_array) ? findMin($input_array) : "Chưa nhập mảng"; ?>
            </div>
            <div class="result-box">
                <strong>Tổng của mảng:</strong> 
                <?php echo !empty($input_array) ? calculateSum($input_array) : "Chưa nhập mảng"; ?>
            </div>
            <div class="result-box">
                <strong>Sắp xếp tăng dần:</strong> 
                <?php 
                $sortedAsc = sortAscending($input_array);
                echo !empty($input_array) ? implode(", ", $sortedAsc) : "Chưa nhập mảng"; 
                ?>
            </div>
            <div class="result-box">
                <strong>Sắp xếp giảm dần:</strong> 
                <?php 
                $sortedDesc = sortDescending($input_array);
                echo !empty($input_array) ? implode(", ", $sortedDesc) : "Chưa nhập mảng"; 
                ?>
            </div>
        </div>

        <div class="right-section">
            <h2>Kiểm tra phần tử</h2>
            <form method="POST" action="">
                <input type="number" name="check_number" step="any" placeholder="Nhập số cần kiểm tra" required>
                <input type="hidden" name="array_input" value="<?php echo isset($_POST['array_input']) ? $_POST['array_input'] : ''; ?>">
                <input type="submit" value="Kiểm tra">
            </form>
            <div class="result-box">
                <strong>Kết quả kiểm tra:</strong> 
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_number'])) {
                    $number = floatval($_POST['check_number']);
                    echo if_available($input_array, $number);
                } else {
                    echo "Chưa nhập số để kiểm tra";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>