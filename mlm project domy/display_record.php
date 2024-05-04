<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Records from Data Table</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Query</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mlm";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        }

        // Execute SELECT query
        $sql = "SELECT * FROM `data`";
        $result = mysqli_query($conn, $sql);

        // Check if records exist
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["subject"] . "</td>";
                echo "<td>" . $row["query"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>

    <h2>Records from Product_Record Table</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>User ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        // Execute SELECT query for purchase_record table
        $sql2 = 'SELECT * FROM `purchase_record`';
        $result2 = mysqli_query($conn, $sql2);
        if (!$result2) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Check if records exist
        if (mysqli_num_rows($result2) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </table>

    <h2>Records from Purchase Details Table</h2>
    <table>
        <tr>
            <th>Purchase ID</th>
            <th>User ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Purchase Date</th>
        </tr>
        <?php
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        }

        // Execute SELECT query for purchase_details table
        $sql3 = "SELECT * FROM `purchase_details`";
        $result3 = mysqli_query($conn, $sql3);

        // Check if records exist
        if (mysqli_num_rows($result3) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result3)) {
                echo "<tr>";
                echo "<td>" . $row["purchase_id"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["total_amount"] . "</td>";
                echo "<td>" . $row["purchase_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </table>
    <br><a href="login.html"><button>Login</button></a>
    <br><a href="index1.html"><button>Logout</button></a>
</body>
</html>
