<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if(isset($_COOKIE['userid'])) {
    $userId = $_COOKIE['userid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];

        // Fetch the latest code entry from the database
        $sql = "SELECT * FROM codes ORDER BY code_date DESC LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestCode = $row['code'];
            $codeDate = strtotime($row['code_date']);
            
            // Check if the code is correct and within the last 30 seconds
            if ($code == $latestCode && (time() - $codeDate) <= 30) {
                echo "Code entered correctly within the last 30 seconds.";
            } else {
                // Update absence count
                $updateSql = "UPDATE users SET absencecount = absencecount + 1 WHERE userid = $userId";
                if ($conn->query($updateSql) === TRUE) {
                    echo "Absent count updated successfully.";
                } else {
                    echo "Error updating absence count: " . $conn->error;
                }
            }
        } else {
            echo "No code found in the database.";
        }
    }
} else {
    echo "User ID cookie not set.";
}

$conn->close();
?>
