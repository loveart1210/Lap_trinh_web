<?php
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            margin-top: 200px;
            background: #ffdee9;
        }

        h1, h2 {
            color: #ff90a0ff;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: #ff90a0ff;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3d2b1f;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        echo "<h1>Welcome to GET and POST form</h1>";
        echo "<h2>Choose one form to test</h2>";
        echo '<a href="form_get.php" class="btn">Form GET</a>';
        echo '<a href="form_post.php" class="btn">Form POST</a>';
        ?>
    </div>
</body>

</html>