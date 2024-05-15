<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // updating
    $sql = "INSERT INTO codes (code, code_date) VALUES ('$code', NOW());";

    if ($conn->query($sql) === TRUE) {
        $updateSql = "UPDATE users SET absencecount = absencecount + 1 WHERE usertype = 'student'";
        if ($conn->query($updateSql) === TRUE) {
            sleep(30);
            $sql = "DELETE FROM codes";
            if ($conn->query($sql) === TRUE) {
                echo "All records deleted successfully";
            } else {
                echo "Error deleting records: " . $conn->error;
            }
            $conn->close();
            header("Location: boncode.html");
            exit;
        } else { 
            echo "Error updating absence count: " . $conn->error;
        }
    } else {
        echo "Error inserting code: " . $conn->error;
    }
    // Close the connection
    $conn->close();
}
?>
