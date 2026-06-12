<?php
session_start();
include('connect.php');
include('header.php');

// Handle login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the credentials are correct
    $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['customer_name'] = $row['customer_name'];

        
            // Check if return URL exists
            if (isset($_GET['return'])) {
                header("Location: " . $_GET['return']);
            } else {
                header("Location: index.php"); // Or any other default page
            }
            exit();
        
    } else {
        $error = "Invalid email or password!";
    }
}
?>


<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    <!-- login start -->
    <div class="mainForm" id="login">
        <div class="mainContainer row rounded shadow ">
            <!-- leftside -->
            <div class="leftside col-xxl-6 col-12 p-5 text-dark">
                <h2>THE FLOWER SHOP</h2>
                <p class="lh-lg mt-4">Welcome Back! <br>
                    Please log in to access your account and continue enjoying our services.<br>
                    If you're new here, create an account to explore all the wonderful things we have to offer.<br>
                    We’re excited to have you with us! <br>


                    <em>We Bouquets For Ordering, Sending Gift and Share the joy...</em>
                </p>
                <div>
                    <a href="register.php" class="btn btn-secondary mt-5">Have An Account</a>
                </div>
            </div>

            <!-- rightside -->
            <div class="rightside col-xxl-6  col-12 p-5 bg-light text-dark ">
                <h2>LOG IN . . .</h2>

                <form action="login.php<?php if (isset($_GET['return'])) echo '?return=' . urlencode($_GET['return']); ?>" method="post">
                    <div class="mt-5">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>

                    </div>


                    <div class="mt-5">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" pattern=".{8,}" required>

                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="mt-5">
                        <input type="submit" class="btn btn-secondary" value="Log In" name="login">
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- login end -->


</div>
<!-- ScrollSpy End -->



<?php include('footer.php') ?>
</body>


<!-- Bootstrap JS CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

<!-- Main JS link -->
<script src="main.js"></script>


</html>