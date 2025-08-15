<?php
require_once "processing.php";

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
    <title>Phép Tính Trên Hai Số</title>
    <style>
        h2 {
            font-family: Open-Sans, sans-serif;
            margin: 100px 100px;
        }
    </style>
</head>
<body>
    <h2>PHÉP TÍNH TRÊN HAI SỐ</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Chọn phép tính: 
        <input type="radio" name="operation" value="Cong"> Cộng
        <input type="radio" name="operation" value="Tru"> Trừ
        <input type="radio" name="operation" value="Nhan"> Nhân
        <input type="radio" name="operation" value="Chia"> Chia<br>
        Số thứ nhất: <input type="number" step="any" name="num1" required><br>
        Số thứ hai: <input type="number" step="any" name="num2" required><br>
        <input type="number" step="any" name="queryNum" placeholder="Nhập số để kiểm tra"><br>
        <input type="submit" value="Tính">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result)) {
        echo "<h2>Kết quả phép tính</h2>";
        echo "Chọn phép tính: " . htmlspecialchars($operation) . "<br>";
        echo "Số 1: " . htmlspecialchars($num1) . "<br>";
        echo "Số 2: " . htmlspecialchars($num2) . "<br>";
        echo "Kết quả: " . htmlspecialchars($result) . "<br>";
        echo "Kiểm tra nguyên tố: " . htmlspecialchars($primeResult) . "<br>";
        echo "Kiểm tra chẵn/lẻ: " . htmlspecialchars($evenOddResult) . "<br>";
    }
    ?>
</body>
</html>