<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_COOKIE['userid'])) {
    $userId = $_COOKIE['userid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];

        $sql = "SELECT * FROM codes ORDER BY code_date DESC LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestCode = $row['code'];
            
            if ($code != $latestCode) {
                sleep(10); 
                $updateSql = "UPDATE users SET absencecount = absencecount + 1 WHERE userid = $userId";
                if ($conn->query($updateSql) === TRUE) {
                    echo "Absent count updated successfully";
                } else {
                    echo "Error updating absent count: " . $conn->error;
                }
            } else {
                echo "Invalid code";
            }
        } else {
            echo "No code found in the database";
        }
    }
} else {
    echo "User ID cookie not set";
}

$conn->close();
?>
