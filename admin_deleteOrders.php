<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include('adminheader.php');

// Check if order_id is set in the POST request
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // First, delete the associated order items from the orderitem table
    $delete_orderitems_sql = "DELETE FROM orderitem WHERE order_id = ?";
    $stmt = $conn->prepare($delete_orderitems_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Then, delete the associated delivery record from the delivery table
    $delete_delivery_sql = "DELETE FROM delivery WHERE order_id = ?";
    $stmt = $conn->prepare($delete_delivery_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Finally, delete the order from the orders table
    $delete_order_sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($delete_order_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the admin orders page after deletion
    header("Location: admin_orders.php");
    exit();
} else {
    echo "Invalid request.";
}

$conn->close();
?>