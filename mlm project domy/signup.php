<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Function to check for duplicate records
function isDuplicate($conn, $username) {
    $sql = "SELECT COUNT(*) as count FROM `purchase_record` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    return $count > 0;
}

// Check if username already exists
$username = $_POST["username"];
if (isDuplicate($conn, $username)) {
    echo "Error: Username already exists";
    exit; // Exit script if username already exists
}

// Prepare and bind SQL statement
$sql = "INSERT INTO `purchase_record` (`name`, `username`, `password`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Set parameters and execute statement
$name = $_POST["name"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

$stmt->bind_param("sss", $name, $username, $password);

// Execute statement
if ($stmt->execute()) {
    // Record inserted successfully
    session_start();
    $_SESSION['user_id'] = $stmt->insert_id;
    echo "Record inserted successfully";
} else {
    // Error inserting record
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect to products.html
header("Location: products.html");
exit; // Make sure to exit after redirection
?>
