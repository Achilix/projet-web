<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

    $conn = new mysqli($servername, $username, $password, $database);

 
    $sql = "INSERT INTO codes (code, code_date) VALUES ('$code', NOW());";
    if ($conn->query($sql) === TRUE) {
        $updateSql = "UPDATE users SET absencecount = absencecount + 1 WHERE usertype = 'student'";
        if ($conn->query($updateSql) === TRUE) {
            sleep(30);
            $sql = "DELETE FROM codes";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                header("Location: boncode.html");
                exit;
            } 
        } 
    } 
    
    $conn->close();
}
?>
