<?php
$servername = "localhost";
$username = "dbuser";
$password = "dbpassword";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from URL
$user_id = $_GET['id'];

// SQL query vulnerable to SQL Injection
$sql = "SELECT * FROM users WHERE id = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL Injection Vulnerable Page</title>
</head>
<body>
    <h1>User Information</h1>
    <form method="get">
        <label for="id">Enter User ID:</label>
        <input type="text" id="id" name="id">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
