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

        <!-- contact start -->

        <section class="mt-4" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Contact Title -->
                    <div class="col-12 text-center mb-2">
                        <h5 class="text-secondary">Contact</h5>
                        <h2 class="text-secondary">Need Help?</h2>

                    </div>
                    <!-- Contact Details -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-5 rounded shadow-sm m-3 contactDiv text-center bg-secondary">
                            <h3 class="text-light bg-secondary"><i
                                    class="fa-solid fa-file-contract mt-3 me-3"></i>Supports</h3>
                            <h6 class="text-light bg-secondary">Help Center ,
                                Submit a Request

                            </h6>

                        </div>
                        <div class="col-12 col-md-5  rounded shadow-sm m-3 contactDiv text-center bg-secondary">
                            <h3 class="text-light bg-secondary"><i class="fa-solid fa-envelope mt-3 me-3"></i>Mailing Address</h3>
                            <h6 class="text-light bg-secondary">Online Flower Shop
                                5900 Bloom Street,
                                Pittsburgh, PA 15206 ,
                                USA

                            </h6>

                        </div>
                        <div class="col-12 col-md-5 rounded shadow-sm m-3 contactDiv text-center bg-secondary">
                            <h3 class="text-light bg-secondary"><i class="fa-brands fa-wpforms mt-3 me-3"></i>Community Forums</h3>
                            <h6 class="text-light bg-secondary">Bouquets Forums ,Email Supports ,General Inquiries ,Abuse Reports</h6>

                        </div>
                        <div class="col-12 col-md-5  rounded shadow-sm m-3 contactDiv text-center bg-secondary">
                            <h3 class="text-light bg-secondary"><i class="fa-solid fa-address-book mt-3 me-3"></i>Inquiries Email</h3>
                            <h6 class="text-light bg-secondary"> <a href="info@ourflowersshop.com" style="text-decoration:none;"
                                    class="text-light">info@ourflowersshop.com</a> ,
                                <a href="feedback@ourflowershop.com" style="text-decoration:none;"
                                    class="text-light">feedback@ourflowershop.com</a>

                            </h6>

                        </div>


                    </div>
                    <div class="row justify-content-center">
                        <!-- Contact Image -->
                        <div class="col-12 col-md-4 my-2 text-center">
                            <img class="img img-fluid w-75 " src="./images/conn.jpg" alt="">
                        </div>
                        <!-- Contact Form -->
                        <form class="col-12 col-md-7">
                            <div class="my-3">
                                <input class="form-control" placeholder="your name . . ." type="text">
                            </div>
                            <div class="my-3">
                                <input class="form-control" placeholder="your email . . ." type="email">
                            </div>
                            <div class="my-3">
                                <input class="form-control" placeholder="subject:" type="text">
                            </div>
                            <div class="my-3">
                                <textarea class="form-control" placeholder="your message . . ." name="" id="" cols="30"
                                    rows="5"></textarea>
                            </div>
                            <div class="float-end">
                                <input class="btn btn-secondary text-light" placeholder="" type="button"
                                    value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </section>





        <!-- contact end -->
        </div>
        <!-- ScrollSpy End -->

        <?php include ('footer.php') ?>

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