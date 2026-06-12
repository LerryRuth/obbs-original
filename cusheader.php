<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Flower Shop</title>
    <link rel="icon" href="./images/icon.jpg">
    <!--Fontawesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- glight box CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.0.6/css/glightbox.css"
        integrity="sha512-W6tnUTZBVdXJgPP/fQ54FsK7G119t8olYvMP133J1Z5tiLtWw53MNodsEmV8y+h4IKALXAbpvYSBKYRIm5WuzA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Css CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
        crossorigin="anonymous">

    <!-- Main Css link -->
    <link rel="stylesheet" type="text/css" href="style.css">





</head>

<body style="background-color: #07c5d3;">
    <?php
    $current_page = basename($_SERVER['PHP_SELF'], ".php");


    ?>
    <!-- Nav bar start -->
    <nav id="navBar" class="navbar navbar-expand-lg sticky-top bg-secondary">
        <div class="container-fluid bg-secondary">
            <img class="DuolingoLogo" src="./images/logo1.jpg" alt="duolingo_logo">
            <a class="navbar-brand fs-3 text-light" href="#">Online Flower Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center text-warning">
                    <li class="nav-item me-xl-3 me-lg-1">
                        <a class="nav-link fs-5 text-light" aria-current="page" href="index.php#home">Home</a>
                    </li>
                    
                    <li class="nav-item me-xl-3 me-lg-1">
                        <a class="nav-link fs-5 text-light" href="item.php#item">Items</a>
                    </li>
                    <li class="nav-item me-xl-3 me-lg-1">
                        <a class="nav-link fs-5 text-light" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item me-xl-3 me-lg-1">
                        <a class="nav-link fs-5 text-light" href="about.php#about">About</a>
                    </li>
                    <li class="nav-item me-xl-3 me-lg-1">
                        <a class="nav-link fs-5 text-light" href="contact.php#contact">Contact</a>
                    </li>

                   



                </ul>


                <a href="cart.php" class="me-3 fs-5 text-light">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <form class="d-flex" role="search" action="item.php" method="GET">
                    <input class="form-control me-2" type="search" name="search_key" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Nav bar end -->