<!-- index.php -->
<?php 
session_start();
include('connect.php'); 
if(isset($_SESSION['customer_id'])){
    include('cusheader.php');
}else{
    include('header.php');
}




?>

    <!-- ScrollSpy Start -->
    <div data-bs-spy="scroll" data-bs-target="#navBar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
        class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">

<!-- home start-->
        <header class="header d-flex align-items-center" id="home">
            <div class="container-fluid">
                <div class="row align-items-center text-center">
                    <!-- home text -->
                    <div class="col-12 col-lg-6 order-2 order-lg-1 mb-5">
                        <h2 class="headerText1 mt-3 mb-5 text-secondary">
                            Welcome to Flower Shop
                        </h2>
                        <p class="mb-4 w-75 m-auto text-secondary text-center ">
                            Where nature's beauty meets artistic design!<br>
                            We are delighted to offer you a stunning selection of fresh flowers,
                            expertly arranged to brighten any occasion. Whether you're celebrating a special event,
                            expressing love and appreciation, or simply bringing a touch of nature into your home,
                            our floral creations are crafted with care and attention to detail. Visit us today and
                            let us help you find the perfect bouquet to make your moment unforgettable.
                        </p>
                        <div class="d-flex justify-content-center align-items-center">
                            <a class="btn btn-secondary text-light rounded-pill me-5" href="item.php">Order! </a>
                            <a class="glightbox headPlay text-secondary fs-2 me-2"
                                href="https://www.youtube.com/watch?v=0XT3H35pOuI">
                                <i class="fa-regular fa-circle-play"></i></a>
                            <span class="text-secondary fw-bold">WATCH</span>
                        </div>

                    </div>
                    <!-- home image -->
                    <div class="col-12 col-lg-6 order-1 order-lg-2 text-center">
                        <img class="img img-fluid w-75 h-100 mt-5" src="./images/h.jpg" alt="homeImage">

                    </div>
                </div>
            </div>
        </header>
        <!-- home end -->
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