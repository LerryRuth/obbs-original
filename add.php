<?php
session_start();
include('adminheader.php');
include('connect.php');

// Initialize variables
$nameErr = $descErr = $priceErr = $imageErr = $stockErr = '';
$name = $description = $price = $stock_quantity = '';
$imageSuccess = $imageName = ''; $searchKeyErr = '';
$search_key = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    if (empty($_POST['bouquet_name'])) {
        $nameErr = "Bouquet name is required.";
    } else {
        $name = htmlspecialchars($_POST['bouquet_name']);
    }

    if (empty($_POST['description'])) {
        $descErr = "Description is required.";
    } else {
        $description = htmlspecialchars($_POST['description']);
    }

    if (empty($_POST['price'])) {
        $priceErr = "Price is required.";
    } elseif (!is_numeric($_POST['price'])) {
        $priceErr = "Price must be a number.";
    } else {
        $price = htmlspecialchars($_POST['price']);
    }

    if (empty($_POST['stock_quantity'])) {
        $stockErr = "Stock quantity is required.";
    } elseif (!is_numeric($_POST['stock_quantity'])) {
        $stockErr = "Stock quantity must be a number.";
    } else {
        $stock_quantity = htmlspecialchars($_POST['stock_quantity']);
    }

    // Handle image upload without type validation
    if ($_FILES['image']['name']) {
        $tmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $path = "images/" . $imageName;

        if (move_uploaded_file($tmpName, $path)) {
            $imageSuccess = "Image uploaded successfully.";
        } else {
            $imageErr = "Error uploading image.";
        }
    } else {
        $imageErr = "Please select an image.";
    }

   

        // Validate search key
        if (empty($_POST['search_key'])) {
            $searchKeyErr = "Search key is required.";
        } else {
            $search_key = htmlspecialchars($_POST['search_key']);
        }

        // If all fields are valid, insert into the database
        if (empty($nameErr) && empty($descErr) && empty($priceErr) && empty($stockErr) && empty($imageErr) && empty($searchKeyErr)) {
            try {
                // Prepare SQL and bind parameters using mysqli
                $stmt = $con->prepare("INSERT INTO bouquet (bouquet_name, description, price, image, stock_quantity, search_key) 
                                   VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdsis", $name, $description, $price, $imageName, $stock_quantity, $search_key);

                // Execute the query
                $stmt->execute();

                // Redirect or display success message
                header("Location: admin_bouquets.php");
                exit();
            } catch (mysqli_sql_exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>


<?php
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    <!-- Add New Bouquet Form -->
    <div class="mainForm" id="edit">
        <div class="mainContainer row rounded shadow">
            <!-- Left Side -->
            <div class="leftside col-xxl-6 col-12 p-5 text-dark">
                <h2>THE FLOWER SHOP</h2>
                <p class="lh-lg mt-4">Join Us Today!<br>
                    Add new items to our bouquet collection to offer even more choices for our customers.

                    Explore a variety of options that will help others order, send gifts, and share joy through beautiful bouquets.


                    <em> We're excited to see the wonderful creations you'll bring to life!</em>
                </p>
                <div>
                    <a href="item1.php" class="btn btn-secondary mt-5">View</a>
                </div>
            </div>
            <!-- Right Side -->
            <div class="col-xxl-6 col-12 p-5 bg-light text-dark">
                <h2>Add New Bouquet</h2>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="mt-4">
                        <label for="bouquet_name">Bouquet Name:</label>
                        <input type="text" class="form-control" name="bouquet_name" value="<?php echo $name; ?>" placeholder="Enter bouquet name...">
                        <span class="error text-danger"><?php echo $nameErr; ?></span>
                    </div>

                    <div class="mt-4">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter description..."><?php echo $description; ?></textarea>
                        <span class="error text-danger"><?php echo $descErr; ?></span>
                    </div>

                    <div class="mt-4">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" placeholder="Enter price...">
                        <span class="error text-danger"><?php echo $priceErr; ?></span>
                    </div>

                    <div class="mt-4">
                        <label for="stock_quantity">Stock Quantity:</label>
                        <input type="number" class="form-control" name="stock_quantity" value="<?php echo $stock_quantity; ?>" placeholder="Enter stock quantity...">
                        <span class="error text-danger"><?php echo $stockErr; ?></span>
                    </div>

                    <div class="mt-4">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" name="image">
                        <span class="error text-danger"><?php echo $imageErr; ?></span>
                        <span class="success text-success"><?php echo $imageSuccess; ?></span>
                    </div>
                    <!-- New Input for Search Key -->
                    <div class="mt-4">
                        <label for="search_key">Search Key:</label>
                        <input type="text" class="form-control" name="search_key" value="<?php echo $search_key; ?>" placeholder="Enter search key...">
                        <span class="error text-danger"><?php echo $searchKeyErr; ?></span>
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-secondary" value="Add Bouquet">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ScrollSpy End -->

<?php include('footer.php'); ?>

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
</body>

</html>