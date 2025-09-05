<?php
$servername = "localhost";
$username = "root"; // Adjust if needed
$password = "135790"; // Adjust if needed
$dbname = "b5_mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname, email, reg_date FROM MyGuests";
$result = $conn->query($sql);

echo "<h2>Danh sách nhân viên</h2>";
echo "<table border='1'>
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

$conn->close();
?>