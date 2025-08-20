<?php
if (isset($_POST['ten_sach'], $_POST['tac_gia'], $_POST['nxb'], $_POST['nam'])) {
    $ten_sach = htmlspecialchars($_POST['ten_sach']);
    $tac_gia  = htmlspecialchars($_POST['tac_gia']);
    $nxb      = htmlspecialchars($_POST['nxb']);
    $nam      = htmlspecialchars($_POST['nam']);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Form POST</title>
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background: #ffdee9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        #information-box {
            margin: 40px auto;
            padding: 30px;
            width: 350px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        h2 {
            color: #ff90a0;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-size: 14px;
            color: #333;
            text-align: left;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #ff90a0;
            outline: none;
        }

        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .back:hover {
            background: #0056b3;
        }

        #elements {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        #elements h3 {
            color: #333;
            margin-bottom: 15px;
        }

        #elements p {
            margin: 8px 0;
            color: #555;
        }
    </style>
</head>

<body>
    <div id="information-box">
        <h2>Book Information (POST)</h2>
        <?php if (!empty($ten_sach) && !empty($tac_gia) && !empty($nxb) && !empty($nam)): ?>
            <div id="elements">
                <h3>Result:</h3>
                <p><b>Book name:</b> <?= $ten_sach ?></p>
                <p><b>Author:</b> <?= $tac_gia ?></p>
                <p><b>Publisher:</b> <?= $nxb ?></p>
                <p><b>Publish year:</b> <?= $nam ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="form_post.php">
            <label for="ten_sach">Book Name</label>
            <input type="text" id="ten_sach" name="ten_sach" placeholder="Enter book name" required>
            <label for="tac_gia">Author</label>
            <input type="text" id="tac_gia" name="tac_gia" placeholder="Enter author" required>
            <label for="nxb">Publisher</label>
            <input type="text" id="nxb" name="nxb" placeholder="Enter publisher" required>
            <label for="nam">Publish Year</label>
            <input type="number" id="nam" name="nam" placeholder="Enter publish year" required>
            <input type="submit" value="Submit">
        </form>
        <a href="homepage.php" class="back">⬅ Back to Homepage</a>
    </div>
</body>

</html>