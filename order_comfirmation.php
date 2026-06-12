<?php
session_start();
include('connect.php'); // Ensure this file contains the correct database connection
include('cusheader.php'); // Include customer header for navigation

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php?return=cart.php");
    exit();
}

// Check if an order ID is provided
if (!isset($_GET['order_id'])) {
    header("Location: index.php"); // Redirect if no order ID is found
    exit();
}

$order_id = $_GET['order_id'];

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['payment_screenshot'])) {
    $target_dir = "uploads/"; // Directory for uploads

    // Check if the upload directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_name = uniqid() . '-' . basename($_FILES['payment_screenshot']['name']);
    $target_file = $target_dir . $file_name;
    $upload_ok = 1;
    $error = '';

    // Check if the file is an actual image
    $check = getimagesize($_FILES['payment_screenshot']['tmp_name']);
    if ($check === false) {
        $error = "File is not an image.";
        $upload_ok = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES['payment_screenshot']['size'] > 2000000) {
        $error = "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow only certain formats (JPEG, PNG)
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png") {
        $error = "Only JPG, JPEG, and PNG files are allowed.";
        $upload_ok = 0;
    }

    // Upload the file if everything is ok
    if ($upload_ok == 1) {
        if (move_uploaded_file($_FILES['payment_screenshot']['tmp_name'], $target_file)) {
            // Use prepared statements to prevent SQL injection
            $stmt = $con->prepare("INSERT INTO payment (order_id, image_upload) VALUES (?, ?)");
            $stmt->bind_param("ss", $order_id, $file_name);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Thank you for your order! Your payment is successful.";
                header("Location: confirmation_success.php");
                exit();
            } else {
                $error = "Error saving payment details: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }

    if (!empty($error)) {
        $_SESSION['error_message'] = $error;
        header("Location: comfirmation_success.php?order_id=$order_id");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Thank You for Your Order!</h2>
    <div class="text-center mt-4">
    <img src="./images/QR.jpg" alt="QR code for payment" width="300px">
    </div><br>
    <h4 class="text-center">Please upload your payment screenshot:</h4>
    <form action="order_comfirmation.php?order_id=<?php echo htmlspecialchars($order_id); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group text-center">
            <input type="file" name="payment_screenshot" accept="image/*" required>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-secondary btn-block mt-3 ">Upload & Send</button>
        </div>
    </form>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger mt-3">
            <?php echo htmlspecialchars($_SESSION['error_message']); ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success mt-3">
            <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>