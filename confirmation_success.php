<?php
session_start();
include('cusheader.php'); // Include customer header for navigation

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Clear any session data related to the order if needed
if (isset($_SESSION['total_amount'])) {
    unset($_SESSION['total_amount']);
}

// Set a success message (if it's not already set)
if (!isset($_SESSION['success_message'])) {
    $_SESSION['success_message'] = "Your order and payment have been successfully processed. Thank you!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h4 {
            text-align: center;
            color: #333;
        }
        .alert-success {
            padding: 20px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Order Confirmation Success</h1>
    <h3 class="text-success">Have a great day...</h3>

    <div class="alert-success">
        <?php if (isset($_SESSION['success_message'])): ?>
            <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
    </div>

    <div class="text-center">
        <a href="index.php" class="btn">Continue Shopping</a>
    </div>
</div>
</body>
</html>