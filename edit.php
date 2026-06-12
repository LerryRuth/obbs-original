<?php
session_start();
include('adminheader.php');
include('connect.php');

if (isset($_GET['bouquet_id'])) {
    // Get bouquet_id from the URL
    $bouquet_id = $_GET['bouquet_id'];

    // Fetch the existing bouquet details
    $sql = "SELECT * FROM bouquet WHERE bouquet_id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $bouquet_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the bouquet exists
        if ($result->num_rows == 1) {
            $bouquet = $result->fetch_assoc();
        } else {
            echo "Bouquet not found.";
            exit;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data from POST request
    $bouquet_id = $_POST['bouquet_id'];
    $bouquet_name = $_POST['bouquet_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $search_key = $_POST['search_key'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_folder = "" . $image_name;  // Updated to 'images/'

        // Move uploaded file to the desired folder
        if (!move_uploaded_file($image_tmp, $image_folder)) {
            echo "Error uploading image.";
            exit;
        }
    } else {
        $image_folder = $_POST['existing_image'];
    }

    // Update the bouquet details
    $sql = "UPDATE bouquet 
            SET bouquet_name = ?, description = ?, price = ?, image = ?, stock_quantity = ?, search_key = ?
            WHERE bouquet_id = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("ssisssi", $bouquet_name, $description, $price, $image_folder, $stock_quantity, $search_key, $bouquet_id);
        if ($stmt->execute()) {
            echo "Bouquet updated successfully!";
            header("Location: admin_bouquets.php"); // Redirect to the admin bouquets list after update
        } else {
            echo "Error updating bouquet: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing update statement: " . $con->error;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Close the connection
$con->close();
?>

<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    <div class="mainForm">

        <div class="mainContainer row rounded shadow ">





            <!-- leftside -->
            <div class="leftside col-xxl-6 col-12 p-5 text-dark">
                <h2>THE FLOWER SHOP</h2>
                <p class="lh-lg mt-4">Welcome Back! <br>

                    Edit Items Context:

                    Make updates to our existing bouquet collection, ensuring that each bouquet reflects the beauty and joy we strive to share with our customers.

                    Whether it's updating descriptions, adjusting prices, or enhancing bouquet offerings, your changes will help us continue delivering exceptional experiences.<br>



                    <em>We're looking forward to seeing how you refine and perfect our collection to keep it fresh and delightful!...</em>
                </p>

            </div>
            <div class="rightside col-xxl-6  col-12 p-5 bg-light text-dark ">
                <h2>Update Bouquet Details</h2>
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="bouquet_id" value="<?php echo $bouquet['bouquet_id']; ?>">
                    <input type="hidden" name="existing_image" value="<?php echo $bouquet['image']; ?>">
                    <div class="mt-3">
                        <label for="bouquet_name">Bouquet Name:</label>
                        <input type="text" id="bouquet_name" class="form-control" name="bouquet_name" value="<?php echo $bouquet['bouquet_name']; ?>" required>
                    </div>

                    <div class="mt-3">
                        <label for="description">Description:</label>
                        <input type="text" id="description" class="form-control" name="description" value="<?php echo $bouquet['description']; ?>" required>
                    </div>

                    <div class="mt-3">
                        <label for="price">Price:</label>
                        <input type="number" id="price" class="form-control" name="price" value="<?php echo $bouquet['price']; ?>" required>

                    </div>
                    <div class="mt-3">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <p>Current Image: <?php echo $bouquet['image']; ?></p>
                    </div>

                    <div class="mt-3">
                        <label for="stock_quantity">Stock Quantity:</label>
                        <input type="number" id="stock_quantity" class="form-control" name="stock_quantity" value="<?php echo $bouquet['stock_quantity']; ?>" required>

                    </div>

                    <div class="mt-3">
                        <label for="search_key">Search Key:</label>
                        <input type="text" id="search_key" class="form-control" name="search_key" value="<?php echo $bouquet['search_key']; ?>" required>
                    </div>

                    <div class="mt-3">
                        <input type="submit" class="btn btn-secondary" value="Update Bouquet">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ScrollSpy End -->

<?php include('footer.php'); ?>