<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_COOKIE['userid'])) {
    $userId = $_COOKIE['userid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];

        // Fetch the latest code entry from the database
        $sql = "SELECT code FROM codes ORDER BY code_time DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestCode = $row['code'];

            // Check if the code is correct
            if ($code == $latestCode) {
                // Decrement absence count by one
                $updateSql = "UPDATE users SET absencecount = absencecount - 1 WHERE userid = $userId";
                if ($conn->query($updateSql) === TRUE) {
                    // Redirect to success page for correct code
                    header("Location: boncodeuser.html");
                    exit();
                } else {
                    echo "Error updating absence count: " . $conn->error;
                }
            } else {
                // Redirect to error page for incorrect code
                header("Location: errorpage.html");
                exit();
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
