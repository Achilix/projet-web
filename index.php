<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "your_database_name";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the highest user ID from the database
$sql = "SELECT MAX(userid) AS max_userid FROM your_table_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxUserId = $row['max_userid'];
    echo $maxUserId;
} else {
    echo "0"; // Default to 0 if no user ID found
}

$conn->close();
?>
