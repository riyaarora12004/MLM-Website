<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Assuming your MySQL connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "mlm";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$cartItems = $data['cartItems'];
$totalAmount = $data['totalAmount'];
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($user_id) {
    echo $user_id,"<br>";
} else {
    echo "user id not setup";
}
// Prepare and execute SQL statements to insert data into the database
foreach ($cartItems as $item) {
    $productName = $item['productName'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $totalItemAmount = $price * $quantity;

    $sql = "INSERT INTO purchase_details (user_id, product_name, price, quantity, total_amount) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssdd", $user_id, $productName, $price, $quantity, $totalItemAmount);
    $stmt->execute();
}
// Close connection
$conn->close();

// Send a response back to JavaScript
echo "Checkout successful!";
?>
