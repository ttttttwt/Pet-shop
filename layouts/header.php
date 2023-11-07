<?php
session_start();

if (basename($_SERVER['PHP_SELF']) == "login.php") {
    if (isset($_SESSION['username'])) {
        echo ("<script>alert('You are already logged in'); window.location.href='index.php';</script>");
    }
}

if (basename($_SERVER['PHP_SELF']) == "update_product.php") {
    if ($_SESSION['role'] != 1) {
        echo ("<script>alert('You are not allowed to access this page')</script>");
        header('Location: index.php');
    }
}

if (basename($_SERVER['PHP_SELF']) == "create_product.php") {
    if ($_SESSION['role'] != 1) {
        echo ("<script>alert('You are not allowed to access this page')</script>");
        header('Location: index.php');
    }
}

if (isset($_POST['logout-submit'])) {
    session_destroy();
    header('Location: index.php');
}

if (basename($_SERVER['PHP_SELF']) == "cart.php") {
    if (!isset($_SESSION['username'])) {
        echo ("<script>alert('You are not allowed to access this page')</script>");
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <title>PET SHOP - Pet Shop Website Template</title> -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/dog2.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/96a820946a.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Topbar Start -->
    <!-- <div class="container-fluid border-bottom d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Our Office</h6>
                        <span>123 Street, New York, USA</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center border-start border-end py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Email Us</h6>
                        <span>info@example.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0 ">
        <a href="index.php" class="navbar-brand ms-lg-5">
            <h1 class="m-0 text-uppercase text-dark"><i class="bi bi-shop fs-1 text-primary me-3"></i>Pet Shop</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == "index.php") {
                    echo 'active';
                } ?>">Home</a>
                <a href="shop.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == "shop.php") {
                    echo 'active';
                } ?>">Shop</a>


                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                    <div class="dropdown-menu m-0">
                        <a href="service.php" class="dropdown-item">Service</a>
                        <a href="team.php" class="dropdown-item">The Team</a>
                        <a href="blog.php" class="dropdown-item">Blog Grid</a>
                        <a href="detail.php" class="dropdown-item">Blog Detail</a>
                        <a href="contact.php" class="dropdown-item">Contact</a>
                    </div>
                </div>

                <?php

                // user view
                if (!isset($_SESSION['username'])) {
                    echo '<a href="login.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Login <i class="bi bi-arrow-right"></i></a>';
                } else {
                    $lenname = strlen($_SESSION['username']);

                    if ($lenname > 6) {
                        $name = substr($_SESSION['username'], 0, 6) . "...";
                    } else {
                        $name = $_SESSION['username'];
                    }

                    $is_cart = '';
                    if (basename($_SERVER['PHP_SELF']) == "cart.php") {
                        $is_cart = 'active';
                    }

                    if ($_SESSION['role'] == '1') {
                        // admin view
                        echo '
                        <a href="cart.php" class="nav-item nav-link ' . $is_cart . ' ">
                            <div><i class="bi-cart-fill me-1"></i>
                            Cart <span class="badge bg-dark text-white ms-1 rounded-pill">' . $_SESSION['cart'] . '</span></div>
                        </a>

                        <div class="nav-item dropdown ms-lg-auto" style="padding-right: 25px;">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="img/unknow-person.jpg" alt="mdo" width="32" height="32" class="rounded-circle">  ' . $name . '
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="information.php" class="dropdown-item">Information</a>
                                <a href="order_detail.php" class="dropdown-item">Order</a>
                                <hr class="dropdown-divider">
                                <a href="admin/index.php" class="dropdown-item">Admin view</a>
                                <hr class="dropdown-divider">
                                <form method="POST">
                                    <button type="submit" name="logout-submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>';
                    } else {
                        // user view
                        echo '<a href="cart.php" class="nav-item nav-link ' . $is_cart . ' ">
                                    <div><i class="bi-cart-fill me-1"></i>
                                    Cart <span class="badge bg-dark text-white ms-1 rounded-pill">' . $_SESSION['cart'] . '</span></div>
                                </a>

                                <div class="nav-item dropdown ms-lg-auto" style="padding-right: 25px;">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="img/unknow-person.jpg" alt="mdo" width="32" height="32" class="rounded-circle">  ' . $name . '
                                    </a>
                                     <div class="dropdown-menu m-0">
                                        <a href="information.php" class="dropdown-item">Information</a>
                                        <a href="order_detail.php" class="dropdown-item">Order</a>
                                        <hr class="dropdown-divider">
                                        <form method="POST">
                                            <button type="submit" name="logout-submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </div>';
                    }
                }
                ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</body>

</html>