<?php
session_start();
include('connect.php');

// Define correct admin credentials
$admin_username = "admin";
$admin_password = "000000";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Set session and redirect to admin home page
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_bouquets.php"); // Redirect to admin home page
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Bootstrap Css CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- login start -->
    <div class="mainForm" id="login">
        <div class="mainContainer row rounded shadow ">
            <!-- leftside -->
            <div class="leftside col-xxl-6 col-12 p-5 text-dark">
                <h2>THE FLOWER SHOP</h2>
                <p class="lh-lg mt-4">Welcome Back! <br>
                    Please log in to access the admin dashboard and manage the system 

                    If you’re new to the platform, kindly contact the system administrator to set up your admin account.<br>




                    <em> We’re excited to help you manage bouquets for orders, sending gifts, and sharing joy!</em>
                </p>

            </div>

            <!-- rightside -->
            <div class="rightside col-xxl-6  col-12 p-5 bg-light text-dark ">
                <h2>Admin Login</h2>
                <?php
                if (isset($error_message)) {
                    echo "<p class='error'>$error_message</p>";
                }
                ?>
                <form action="adminlogin.php" method="POST">
                    <div class="mt-4 "> <label for="username">Username:</label>
                        <input type="text" id="username" class="form-control" name="username" required><br>
                    </div>

                    <div class="mt-4"> <label for="password">Password:</label>
                        <input type="password" id="password" class="form-control" name="password" required><br>
                    </div>
                    <div class="mt-4">
                        <input type="submit" class="btn btn-secondary" value="Login">
                    </div>
                </form>
            </div>
        </div>


</body>

</html>