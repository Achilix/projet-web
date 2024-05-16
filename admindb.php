<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e3d2d2;
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

    <h2>User Table</h2>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Absence Count</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "test";
        $conn = new mysqli($servername, $username, $password, $database);
       

        $sql = "SELECT first_name, last_name, absencecount FROM users WHERE usertype != 'admin'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["absencecount"] . "</td>";
                echo "</tr>";
            }
        } else 
        $conn->close();
        ?>
    </table>

    <div class="btn-container">
        <a href="index.html" class="btn">Go Back</a>
    </div>

</div>

</body>
</html>