<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

<<<<<<< HEAD
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
=======

>>>>>>> 9c5606f2c376045eeff1e647c8f0299593ae459c

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $userType = $user['usertype'];

        if ($userType === 'admin') {
            header("Location: index.html");
        } elseif ($userType === 'student') {
            header("Location: ind.html");
        } else {
            header("Location: login.html");
        }
        exit();
    } else {
        echo "Invalid email or password";
    }

    $stmt->close();
}

$conn->close();
?>
