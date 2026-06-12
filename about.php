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


        <!-- About start -->
        <section class="mt-4" id="about">
            <div class="container">
                <div class="row">
                    <!-- about title -->
                    <div class="col-12 text-center mb-2">
                        <h5 class="text-secondary">About Us</h5>
                        <h2 class="text-secondary">Our Flower Shop</h2>

                    </div>
                    <!-- about text -->
                    <div class="col-12 col-xxl-6">
                        <img class="aboutImage img img-fluid img-thumbnail" src="./images/ab.jpg" alt="about">
                    </div>
                    <div class="col-12 col-xxl-6">
                        <div class="row">
                            <div class="col-12 col-lg-8 col-xl-7 col-xxl-12 p-xxl-1 p-3"></div>
                            <p class="aboutText text-secondary-emphasis">
                                We pride ourselves on offering a diverse selection of fresh, vibrant flowers sourced from the finest growers.
                                Whether you're looking for elegant roses, cheerful sunflowers, exotic orchids, or seasonal arrangements,
                                we have something to suit every occasion and style.Our talented florists are here to craft personalized bouquets,
                                stunning centrepieces, and custom floral designs that reflect your unique taste and the sentiments you wish to convey.
                                We also offer services for weddings, events, and corporate settings, ensuring that your floral needs are met with creativity
                                and care.We believe that flowers have the power to transform spaces and uplift spirits.
                                Come visit us today and let us help you find the perfect arrangement to celebrate life's special moments,
                                or simply to bring a little bit of nature's beauty into your everyday life.
                                that perfectly express your sentiments, whether it's for a wedding, a special celebration, or just because.
                                We also provide services for events, corporate functions, and home décor,
                                ensuring that every space you want to enhance with nature’s charm is truly memorable.
                                Visit us today and let our flowers tell your story.
                            </p>
                            <div class="col-12 col-lg-4 col-xl-5 col-xxl-12">
                                <iframe class="border border-2 border-light rounded mt-lg-4" width="100%" height="315"
                                    src="./videos/f1.mp4"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- About end -->




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