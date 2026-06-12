

<?php
include('connect.php'); // Include your database connection file

// Check if a bouquet_id is passed to the page
if (isset($_GET['bouquet_id'])) {
    $bouquet_id = $_GET['bouquet_id'];

    // Delete the bouquet from the database based on the bouquet_id
    try {
        $stmt = $con->prepare("DELETE FROM bouquet WHERE bouquet_id = ?");
        $stmt->bind_param("i", $bouquet_id);
        $stmt->execute();

        // Redirect back to item1.php after deletion
        header("Location: admin_bouquets.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // If no bouquet_id is provided, redirect back to item1.php
    header("Location: admin_bouquets.php");
    exit();
}
?>