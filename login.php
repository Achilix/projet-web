<?php
$servername = "localhost"; // Assuming MySQL server is running locally
$username = "root"; // Default username for XAMPP MySQL
$password = ""; // Default password for XAMPP MySQL (empty by default)
$database = "test"; // Change this to the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user record from the result set
        $user = $result->fetch_assoc();
        $userType = $user['usertype']; // Assuming 'usertype' is the column name for user type in the users table

        // Determine the action URL based on user type
        if ($userType === 'admin') {
            $loginAction = 'index.html';
        } elseif ($userType === 'student') {
            $loginAction = 'ind.html';
        } else {
            $loginAction = 'login.html';
        }

        // Redirect the user to the appropriate page
        header("Location: $loginAction");
        exit(); // Ensure script execution stops after redirection
    } else {
        echo "Invalid email or password";
    }

    // Close prepared statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
