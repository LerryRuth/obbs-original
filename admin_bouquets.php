<?php
// Database connection
include('connect.php');
include('adminheader.php');

// Fetch all bouquets from the database
$sql = "SELECT * FROM bouquet";
$result = $con->query($sql);
?>
<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    <div class="container mt-5">
        <h2>Admin - Manage Bouquets</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Image</th>
                    <th>Bouquet Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    
                    <th>Search Key</th> <!-- New Search Key Column -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each bouquet
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        
                        // echo "<td>" . $row['bouquet_id'] . "</td>";
                        echo "<td><img src='images/" . $row['image'] . "' width='100' alt='Bouquet Image'></td>";
                        echo "<td>" . $row['bouquet_name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['stock_quantity'] . "</td>";
                        
                        echo "<td>" . $row['search_key'] . "</td>"; // Display search_key
                        echo "<td>
                                <a href='edit.php?bouquet_id=" . $row['bouquet_id'] . "' class='btn btn-primary'>Edit</a>
                                <a href='delete.php?bouquet_id=" . $row['bouquet_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No bouquets found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>