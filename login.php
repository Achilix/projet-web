<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

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
        $userID = $user['userid']; // Retrieve user ID from database result

        // Set user ID cookie
        setcookie("userid", $userID, time() + 3600, "/");

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
