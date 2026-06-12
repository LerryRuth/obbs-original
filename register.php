<?php
include("connect.php");
include("header.php");
$customer_name = $email = $phone = $address = $password = "";
$email_error = $password_error = "";

if (isset($_POST['register'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    }

    // Validate password
    if (strlen($password) < 8) {
        $password_error = "Password must be at least 8 characters";
    }
    if (empty($email_error) && empty($password_error)) {
        $sql = "INSERT INTO customer (customer_name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $customer_name, $email, $phone, $address, $password);
        $stmt->execute();
        $stmt->close();
        $con->close();
        header("Location: login.php");
        exit;
    }
}
?>


<!-- ScrollSpy Start -->
<div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    <!-- register start -->
    <div class="mainForm">
        <div class="mainContainer row rounded shadow ">
            <!-- leftside -->
            <div class="leftside col-xxl-6 col-12 p-5 text-dark">
                <h2>THE FLOWER SHOP</h2>
                <p class="lh-lg mt-4">Join Us Today!<br>
                    Creating an account is quick and easy. <br>
                    By registering, you’ll unlock exclusive access to our services, special offers, and more. <br>
                    Start your journey with us and experience the best we have to offer. We’re excited to welcome you to our community!<br>
                    <em>We Bouquets For Ordering, Sending Gift and Share the joy...</em>
                </p>
                <div>
                    <a href="login.php" class="btn btn-secondary mt-5">Login</a>
                </div>
            </div>

            <!-- rightside -->
            <div class="rightside col-xxl-6  col-12 p-5 bg-light text-dark ">
                <h2>REGISTRATION FORM</h2>

                <form action="" method="post">
                    <div class="mt-4">
                        <label for="customer_name">Customer Name:</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>


                    <div class="mt-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                        <span class="error"><?php echo $email_error; ?></span>
                    </div>

                    <div class="mt-4">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mt-4">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="mt-4">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" pattern=".{8,}" required>
                        <span class="error"><?php echo $password_error; ?></span>
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-secondary" name="register" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- register end -->


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