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
} else {
    echo "Connection successfully";
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO `data` (`name`, `email`, `subject`, `query`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $query);

// Set parameters and execute statement
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$query = $_POST["query"];
$stmt->execute();

// Check if record was inserted successfully
if ($stmt->affected_rows > 0) {
    echo "Record inserted";
} else {
    echo "Not inserted";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
