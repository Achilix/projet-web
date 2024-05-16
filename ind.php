<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if (isset($_COOKIE['userid'])) {
    $userId = $_COOKIE['userid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];

        $sql = "SELECT code FROM codes ORDER BY code_time DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $latestCode = $row['code'];

            if ($code == $latestCode) {
                $updateSql = "UPDATE users SET absencecount = absencecount - 1 WHERE userid = $userId";
                if ($conn->query($updateSql) === TRUE) {
                    header("Location: boncodeuser.html");
                    exit();
                } else {
                    header("Location: errorpage.html");
                    exit();
                }
            } else {
                header("Location: errorpage.html");
                exit();
            }
        }else {
            header("Location: errorpage.html");
            exit();
        }
    }
}

$conn->close();
?>
