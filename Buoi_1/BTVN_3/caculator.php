<?php
require_once "processing_copy.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operation = $_POST["operation"];
    $num1 = floatval($_POST["num1"]);
    $num2 = floatval($_POST["num2"]);
    $result = 0;

    switch ($operation) {
        case "Cong":
            $result = calculateSum($num1, $num2);
            saveCalculation("Tổng", $num1, $num2, $result);
            break;
        case "Tru":
            $result = calculateDifference($num1, $num2);
            saveCalculation("Hiệu", $num1, $num2, $result);
            break;
        case "Nhan":
            $result = calculateProduct($num1, $num2);
            saveCalculation("Tích", $num1, $num2, $result);
            break;
        case "Chia":
            $result = calculateQuotient($num1, $num2);
            saveCalculation("Thương", $num1, $num2, $result);
            break;
    }

    $queryNum = floatval($_POST["queryNum"]);
    $primeResult = isPrime($queryNum);
    saveQuery("Nguyên tố", $queryNum, $primeResult);
    
    $evenOddResult = isEvenOrOdd($queryNum);
    saveQuery("Chẵn/Lẻ", $queryNum, $evenOddResult);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Máy tính</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f6f8fa;
            color: #24292e;
            line-height: 1.5;
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        h2 {
            font-size: 1.5em;
            font-weight: 600;
            color: #24292e;
            text-align: center;
            margin-bottom: 24px;
        }
        #caculation {
            background-color: #ffffff;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            padding: 24px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        input[type="radio"] {
            margin: 0 8px 0 16px;
            vertical-align: middle;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #d1d5da;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafbfc;
            box-sizing: border-box;
        }
        input[type="number"]:focus {
            outline: none;
            border-color: #0366d6;
            box-shadow: 0 0 0 3px rgba(3, 102, 214, 0.3);
        }
        input[type="submit"] {
            background-color: #2ea44f;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            margin-top: 16px;
            transition: background-color 0.2s ease;
        }
        input[type="submit"]:hover {
            background-color: #28a745;
        }
        label {
            font-size: 14px;
            color: #24292e;
            margin-right: 8px;
        }
        .result {
            margin-top: 30px;
            padding: 0 16px 16px 16px;
            background-color: #f6f8fa;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }
            #caculation {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <h2 style="margin-bottom: 30px;">PHÉP TÍNH TRÊN HAI SỐ</h2>
    <form id="caculation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Chọn phép tính:</label><br>
        <input type="radio" name="operation" value="Cong" required> Cộng
        <input type="radio" name="operation" value="Tru"> Trừ
        <input type="radio" name="operation" value="Nhan"> Nhân
        <input type="radio" name="operation" value="Chia"> Chia<br>
        <label>Số thứ nhất:</label>
        <input type="number" step="any" name="num1" required><br>
        <label>Số thứ hai:</label>
        <input type="number" step="any" name="num2" required><br>
        <label>Kiểm tra số:</label>
        <input type="number" step="any" name="queryNum" placeholder="Nhập số để kiểm tra"><br>
        <input type="submit" value="Tính">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result)) {
        echo "<div class='result'>";
        echo "<h2>Kết quả phép tính</h2>";
        echo "Chọn phép tính: " . htmlspecialchars($operation) . "<br>";
        echo "Số 1: " . htmlspecialchars($num1) . "<br>";
        echo "Số 2: " . htmlspecialchars($num2) . "<br>";
        echo "Kết quả: " . htmlspecialchars($result) . "<br>";
        echo "Kiểm tra nguyên tố: " . htmlspecialchars($primeResult) . "<br>";
        echo "Kiểm tra chẵn/lẻ: " . htmlspecialchars($evenOddResult) . "<br>";
        echo "</div>";
    }
    ?>
</body>
</html>