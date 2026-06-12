<?php
session_start();
include('connect.php'); // Ensure this file contains the correct database connection
include('adminheader.php'); // Include admin header for navigation

// Pagination settings
$limit = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch all orders with customer and bouquet details, including payment screenshot
$query = "SELECT orders.order_id, customer.customer_name, bouquet.bouquet_name,
orders.total_amount, orders.order_date, orders.delivery_date, payment.image_upload AS file_path
FROM orders
JOIN customer ON orders.customer_id = customer.customer_id
JOIN bouquet ON orders.bouquet_id = bouquet.bouquet_id
LEFT JOIN payment ON orders.order_id = payment.order_id
GROUP BY orders.order_id
LIMIT ?, ?";

$stmt = $con->prepare($query);
$stmt->bind_param("ii", $start, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total order count for pagination
$count_query = "SELECT COUNT(*) AS total_orders FROM orders";
$count_result = mysqli_query($con, $count_query);
$total_orders = mysqli_fetch_assoc($count_result)['total_orders'];
$total_pages = ceil($total_orders / $limit);

// Handle order deletion
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $delete_query = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Order deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Error deleting order: " . $stmt->error;
    }
    $stmt->close();
    header("Location: admin_orders.php"); // Redirect to the same page to refresh the order list
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <style>
        img.lazy-image {
            background: url('path/to/placeholder.png') no-repeat center center;
            min-height: 150px; /* Or any default height */
        }
        .btn-disabled {
            background-color: grey;
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Manage Orders and Payments</h1>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_SESSION['error_message']); ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th> Order ID</th>
                <th>Customer Name</th>
                <th>Total Amount (MMK)</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Payment Screenshot</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): 
                    $current_date = date('Y-m-d');
                    $delivery_date = $row['delivery_date'];
                    $is_deliverable = strtotime($delivery_date) <= strtotime($current_date); // Check if delivery date is reached
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_amount']); ?> MMK</td>
                        <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_date']); ?></td>
                        <td>
                            <?php if (!empty($row['file_path'])): ?>
                                <a href="viewss.php?file_path=<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">View Screenshot
                                   
                             
                            <?php else: ?>
                                <span>No Screenshot Uploaded</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="admin_orders.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>">
                                <button type="submit" class="btn <?php echo $is_deliverable ? 'btn-danger' : 'btn-disabled'; ?>" <?php echo $is_deliverable ? '' : 'disabled'; ?>>
                                    Delete Order
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="admin_orders.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let lazyImages = [].slice.call(document.querySelectorAll("img.lazy-image"));

        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy-image");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
            // Fallback for older browsers
            let lazyLoadThrottleTimeout;
            function lazyLoad() {
                if (lazyLoadThrottleTimeout) {
                    clearTimeout(lazyLoadThrottleTimeout);
                }    
                lazyLoadThrottleTimeout = setTimeout(function() {
                    let scrollTop = window.pageYOffset;
                    lazyImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy-image');
                        }
                    });
                    if (lazyImages.length == 0) { 
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationChange", lazyLoad);
                    }
                }, 20);
            }
            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationChange", lazyLoad);
        }
    });
</script>
</body>
</html>
<?php mysqli_close($con); ?>