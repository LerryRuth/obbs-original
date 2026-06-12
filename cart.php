<?php
session_start();
include('cusheader.php');
include('connect.php'); // Ensure this file contains the correct database connection

// Calculate the total price from the cart
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
} else {
    header("Location: index.php"); // Redirect if cart is empty
    exit();
}

// Remove item from cart logic
if (isset($_POST['remove_item'])) {
    $bouquet_id = $_POST['bouquet_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['bouquet_id'] == $bouquet_id) {
            unset($_SESSION['cart'][$key]); // Remove item from cart
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
}

// Update quantity and calculate total
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $bouquet_id => $quantity) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['bouquet_id'] == $bouquet_id) {
                $item['quantity'] = $quantity; // Update quantity
                break;
            }
        }
    }
}

// Display cart
?>
<div class="container mt-5">
    <h2>Your Cart</h2>
    <form action="cart.php" method="post">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr data-bouquet-id="<?php echo $item['bouquet_id']; ?>">
                            <td><img src="./images/<?php echo htmlspecialchars($item['image']); ?>" width="100px"></td>
                            <td><?php echo htmlspecialchars($item['bouquet_name']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($item['description'])); ?></td>
                            <td class="item-price"><?php echo htmlspecialchars($item['price']); ?> MMK</td>
                            <td>
                                <input type="number" class="quantity" name="quantities[<?php echo $item['bouquet_id']; ?>]"
                                       value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                            </td>
                            <td class="item-total"><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?> MMK</td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="bouquet_id" value="<?php echo $item['bouquet_id']; ?>">
                                    <button type="submit" name="remove_item" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Your cart is empty</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-right">
            <h3>Total Price: <span id="total-price"><?php echo $total_price; ?></span> MMK</h3>
            <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
        </div>
    </form>
    <?php if (!empty($_SESSION['cart'])): ?>
        <form action="order.php" method="post">
            <button type="submit" name="place_order" class="btn btn-primary mt-3">Proceed to Order</button>
        </form>
    <?php endif; ?>
</div>

<script>
    // Function to update the total price
    function updateTotalPrice() {
        let totalPrice = 0;

        // Loop through each item row and calculate its total
        document.querySelectorAll('#cart-items tr').forEach(function(row) {
            const price = parseFloat(row.querySelector('.item-price').textContent);
            const quantity = parseInt(row.querySelector('.quantity').value);
            const itemTotal = price * quantity;

            // Update the item total for this row
            row.querySelector('.item-total').textContent = itemTotal.toFixed(2) + ' MMK';

            // Add this item's total to the overall total
            totalPrice += itemTotal;
        });

        // Update the total price in the UI
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }

    // Attach event listeners to all quantity input fields
    document.querySelectorAll('.quantity').forEach(function(input) {
        input.addEventListener('input', function() {
            updateTotalPrice();
        });
    });

    // Run the total price update on page load
    updateTotalPrice();
</script>

<?php include('footer.php'); ?>
