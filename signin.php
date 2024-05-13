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
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = "student"; // Set default user type

    // Prepare SQL statement with parameterized query
    $sql = "INSERT INTO users (usertype, first_name, last_name, email, password) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $usertype, $f_name, $l_name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
} else {
    echo "Form not submitted";
}

// Close connection
$conn->close();
?>
