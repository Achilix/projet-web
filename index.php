<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

    
    $conn = new mysqli($servername, $username, $password, $database);

    
    $sql = "INSERT INTO codes (code, code_date) VALUES ('$code', NOW());";

   
    $conn->close();
}
?>