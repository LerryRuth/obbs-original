<?php
session_start();
include('connect.php'); // Ensure this file contains the correct database connection

// Check if the user is logged in to place an order
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php?return=cart.php");
    exit();
}

// Initialize the cart session if it is not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize an empty array
}

// Calculate total price
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
} else {
    header("Location: index.php"); // Redirect if cart is empty
    exit();
}

// Handle order placement
if (isset($_POST['place_order'])) {
    $customer_id = $_SESSION['customer_id'];
    $order_date = date('Y-m-d H:i:s');
    $delivery_date = date('Y-m-d H:i:s', strtotime('+2 days')); // Example delivery date
    $status = 'Pending'; // Initial status
    $payment_id = null; // Assuming payment_id will be set after payment confirmation

    // Insert into orders table
    $query = "INSERT INTO orders (customer_id, bouquet_id, payment_id, status, delivery_date, order_date, total_amount) 
              VALUES ('$customer_id', 11, '$payment_id', '$status', '$delivery_date', '$order_date', '$total_price')";

    if (mysqli_query($con, $query)) {
        $order_id = mysqli_insert_id($con); // Get the last inserted order ID

        // Insert each item into orderitem table
        foreach ($_SESSION['cart'] as $item) {
            $bouquet_id = $item['bouquet_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $order_item_query = "INSERT INTO orderitem (order_id, bouquet_id, quantity, price) 
                                 VALUES ('$order_id', '$bouquet_id', '$quantity', '$price')";
            mysqli_query($con, $order_item_query);
        }

        // Clear the cart after order is placed
        $_SESSION['cart'] = [];
        header("Location: order_comfirmation.php?order_id=$order_id");
        exit();
    } else {
        $_SESSION['error_message'] = "Error placing order: " . mysqli_error($con);
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Order Summary</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['bouquet_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?> MMK</td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?> MMK</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Your cart is empty</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h4 class="text-right">Total Price: <?php echo $total_price; ?> MMK</h4>
        <form action="order.php" method="post">
            <button type="submit" name="place_order" class="btn btn-primary btn-block mt-3">Place Order</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>