<?php
$servername = "sql209.infinityfree.com";
$username = "if0_39693741"; // Adjust if needed
$password = "loveart1210"; // Adjust if needed
$dbname = "if0_39693741_btvn_buoi_4";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Function to display guests
function displayGuests($conn, $title) {
    $sql = "SELECT id, firstname, lastname, email, reg_date FROM MyGuests";
    $result = $conn->query($sql);

    echo "<h2>$title</h2>";
    echo "<table class='guest-table'>
    <tr>
    <th>Id</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
    <th>Reg Date</th>
    </tr>";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["firstname"] . "</td>
            <td>" . $row["lastname"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["reg_date"] . "</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
    echo "</table>";
}

if ($action == 'create') {
    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }

    // Select the database
    $conn->select_db($dbname);

    // Create table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
} elseif ($action == 'insert') {
    $conn->select_db($dbname);
    // Insert data if table is empty (to avoid duplicates)
    $sql_check = "SELECT COUNT(*) as count FROM MyGuests";
    $result = $conn->query($sql_check);
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
            ('John', 'Doe', 'john@example.com'),
            ('Jane', 'Smith', 'jane@example.com'),
            ('James', 'Johnson', 'james@example.com'),
            ('Emily', 'Brown', 'emily@example.com')";
        if ($conn->query($sql) === TRUE) {
            echo "New records created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Data already inserted<br>";
    }
    displayGuests($conn, "Danh sách nhân viên sau khi chèn");
} elseif ($action == 'display') {
    $conn->select_db($dbname);
    displayGuests($conn, "Danh sách nhân viên");
} elseif ($action == 'update') {
    $conn->select_db($dbname);
    // Update record
    $sql = "UPDATE MyGuests SET firstname='Jane' WHERE firstname='James'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully<br>";
    } else {
        echo "Error updating record: " . $conn->error . "<br>";
    }
    displayGuests($conn, "Danh sách nhân viên sau khi sửa");
} elseif ($action == 'delete') {
    $conn->select_db($dbname);
    // Delete record
    $sql = "DELETE FROM MyGuests WHERE id=3";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully<br>";
    } else {
        echo "Error deleting record: " . $conn->error . "<br>";
    }
    displayGuests($conn, "Danh sách nhân viên sau khi xóa");
} elseif ($action == 'undo') {
    $conn->select_db($dbname);
    // Truncate table to reset
    $sql = "TRUNCATE TABLE MyGuests";
    $conn->query($sql);
    // Insert original data
    $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
        ('John', 'Doe', 'john@example.com'),
        ('Jane', 'Smith', 'jane@example.com'),
        ('James', 'Johnson', 'james@example.com'),
        ('Emily', 'Brown', 'emily@example.com')";
    if ($conn->query($sql) === TRUE) {
        echo "Hoàn tác sửa và xóa thành công<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    displayGuests($conn, "Danh sách nhân viên sau khi hoàn tác");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý MyGuests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            color: #555;
        }
        .menu {
            display: flex;
            text-align: center;
            margin-bottom: 20px;
        }
        .menu a {
            margin: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #45a049;
        }
        .guest-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .guest-table th, .guest-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .guest-table th {
            background-color: #f2f2f2;
            color: #333;
        }
        .guest-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .guest-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Chương trình Quản lý MyGuests</h1>
    <div class="menu">
        <a href="?action=create">Tạo CSDL và Bảng</a>
        <a href="?action=insert">Chèn Dữ liệu</a>
        <a href="?action=display">Hiển thị Danh sách</a>
        <a href="?action=update">Sửa Nhân viên (James -> Jane)</a>
        <a href="?action=delete">Xóa Nhân viên (ID=3)</a>
        <a href="?action=undo">Hoàn tác Sửa và Xóa</a>
    </div>
    <!-- Results will be displayed here based on action -->
</body>
</html>