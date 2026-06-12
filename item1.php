<?php
include('adminheader.php');
include('connect.php'); // Database connection

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
                <!-- Display bouquets dynamically -->
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php if (!empty($bouquets)): ?>
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
                                            <strong>In Stock:</strong> <?php echo htmlspecialchars($bouquet['stock_quantity']); ?><br>
                                            <strong>Search Key:</strong> <?php echo htmlspecialchars($bouquet['search_key']); ?>
                                        </div>
                                        <a href="edit.php?bouquet_id=<?php echo $bouquet['bouquet_id']; ?>" class="button btn btn-secondary">Update</a>
                                        <a href="delete.php?bouquet_id=<?php echo $bouquet['bouquet_id']; ?>" class="button btn btn-secondary" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p class="text-light">No items match your search criteria.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- item end -->
</div>
<!-- ScrollSpy End -->

<?php include('footer.php'); ?>


<!-- Bootstrap JS CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

<!-- Main JS link -->
<script src="main.js"></script>

</body>

</html>