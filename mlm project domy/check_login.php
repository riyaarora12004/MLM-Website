<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define your admin credentials
$admin_username = "admin";
$admin_password = "password";

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Database connection parameters
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "mlm";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Sorry we failed to connect: " . $conn->connect_error);
}

// Prepare and bind SQL statement for user authentication
$stmt = $conn->prepare("SELECT * FROM purchase_record WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user is admin
if ($username == $admin_username && $password == $admin_password) {
    // Authentication successful for admin, set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header("Location: display_record.php"); // Redirect admin to welcome page
    exit;
} if ($result->num_rows == 1) {
    // User exists in the database, fetch the row
    $row = $result->fetch_assoc();
    // Check if the entered password matches the hashed password in the database
    if (password_verify($password, $row['password'])) {
        // Authentication successful, set session variables or perform further actions
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirect to dashboard or any other page
        header("Location: products.html");
        exit;
    } else {
        // Incorrect password
        echo "Incorrect Password";
    }
} else {
    // User doesn't exist in the database
    echo "User not found";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
