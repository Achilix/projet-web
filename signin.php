<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "test"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = "student";

    $sql = "INSERT INTO users (usertype, first_name, last_name, email, password) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $usertype, $f_name, $l_name, $email, $password);
    if ($stmt->execute()) {
        header("Location: login.html");
    } else {
        header("Location: signin.html");
    }
    $stmt->close();
} else {
    echo "Form not submitted";
}
$conn->close();
?>
