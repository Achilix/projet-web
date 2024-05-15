<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>User Data</h2>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Absence Count</th>
        </tr>
       
    </table>

    <div class="btn-container">
        <a href="ind.html" class="btn">Go Back</a>
    </div>

</div>

</body>
</html>
<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "test";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_COOKIE['userid'])) {
            $userId = $_COOKIE['userid'];

            $sql = "SELECT first_name, last_name, absencecount FROM users WHERE userid = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                die("Error executing statement: " . $stmt->error);
            }
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["absencecount"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data found</td></tr>";
            }
        } else {
            echo "User ID cookie not set.";
        }

        $conn->close();
        ?>
