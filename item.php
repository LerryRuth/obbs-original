<?php
session_start();
include('connect.php'); // Database connection 
if(isset($_SESSION['customer_id'])){
    include('cusheader.php');
}else{
    include('header.php');
}


// Check if the search_key is set and not empty
$search_key = '';
if (isset($_GET['search_key']) && !empty($_GET['search_key'])) {
    $search_key = $_GET['search_key'];
}

try {
    if (!empty($search_key)) {
        // Fetch bouquets matching the search key
        $stmt = $con->prepare("SELECT * FROM bouquet WHERE search_key LIKE ?");
        $like_search_key = '%' . $search_key . '%';
        $stmt->bind_param("s", $like_search_key);
    } else {
        // Fetch all bouquets if no search key is provided
        $stmt = $con->prepare("SELECT * FROM bouquet");
    }
    $stmt->execute();
    $result = $stmt->get_result(); // Fetch result set
    $bouquets = $result->fetch_all(MYSQLI_ASSOC); // Fetch all data
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}

// Add to Cart logic
if (isset($_POST['add_to_cart'])) {
    // Check if the customer is logged in
    if (!isset($_SESSION['customer_id'])) {
        // Redirect to login.php if not logged in and pass the return page as a parameter
        header("Location: login.php?return=item.php");
        exit();
    }

    // Customer is logged in, proceed with adding item to cart
    $bouquet_id = $_POST['bouquet_id'];
    $bouquet_name = $_POST['bouquet_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $cart_item = [
        'bouquet_id' => $bouquet_id,
        'bouquet_name' => $bouquet_name,
        'price' => $price,
        'image' => $image,
        'description' => $description,
        'quantity' => 1 // Default quantity is 1
    ];

    // Check if the cart session exists, and if not, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item already exists in the cart
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['bouquet_id'] == $bouquet_id) {
            $item['quantity']++; // If the item is already in the cart, increase the quantity
            $item_exists = true;
            break;
        }
    }

    // If the item is not in the cart, add it
    if (!$item_exists) {
        $_SESSION['cart'][] = $cart_item;
    }

    // Redirect to cart.php after adding the item
    header("Location: cart.php");
    exit();
}
?>

<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">


    <!-- item start -->
    <section id="item">
        <div class="container">
            <div class="row">
                <!-- Title 1-->
                <div class="col-12 text-center text-secondary">
                    <h5>Flowers</h5>
                    <h1>Start Order!</h1>
                </div>
                <!-- list1 -->
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($bouquets as $bouquet): ?>
                        <div class="col">
                            <div class="card text-center">
                                <img src="./images/<?php echo htmlspecialchars($bouquet['image']); ?>" class="card-img-top 1"
                                    alt="<?php echo htmlspecialchars($bouquet['bouquet_name']); ?>"
                                    style="max-width: 500px; max-height: 300px;" height="350px">
                                <div class="card-body bg-secondary text-light">
                                    <h5 class="card-title"><?php echo htmlspecialchars($bouquet['bouquet_name']); ?></h5>
                                    <div class="card-text">
                                        <?php echo nl2br(htmlspecialchars($bouquet['description'])); ?><br>
                                        <strong>Price:</strong> <?php echo htmlspecialchars($bouquet['price']); ?> MMK<br>

                                    </div>

                                    <!-- Each "ADD TO CART" button is a form that submits the bouquet ID -->

                                    <form action="item.php" method="post">
                                        <input type="hidden" name="bouquet_id" value="<?php echo htmlspecialchars($bouquet['bouquet_id']); ?>">


                                        <input type="hidden" name="bouquet_name" value="<?php echo htmlspecialchars($bouquet['bouquet_name']); ?>">
                                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($bouquet['price']); ?>">
                                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($bouquet['image']); ?>">
                                        <input type="hidden" name="description" value="<?php echo htmlspecialchars($bouquet['description']); ?>">
                                        <button type="submit" name="add_to_cart" class="btn btn-light text-secondary px-5">ADD TO CART</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>

    </section>

    <!-- item end -->
</div>
<!-- ScrollSpy End -->

<?php include('footer.php') ?>

</body>
<!-- glightbox CDN link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.0.6/js/glightbox.min.js"
    integrity="sha512-Urs6Q69dOL3+drxqIgag5SNa9ZG/Nm8HsZUg37a8GVfk97Ex3PeojNgp+xpmITdYeWYU59qYxvvMnLVv045UIA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap JS CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

<!-- Main JS link -->
<script src="main.js"></script>

</html>