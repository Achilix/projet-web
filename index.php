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
    
    $sql = "INSERT INTO codes (code, code_date) VALUES ('$code', NOW());";

    if ($conn->query($sql) === TRUE) {
        $updateSql = "UPDATE users SET absencecount = absencecount + 1 WHERE usertype = 'student'";
        if ($conn->query($updateSql) === TRUE) {
            header("Location: boncode.html");
            exit;
        } else {
            echo "Error updating absence count: " . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
   
    $conn->close();
}
?>
