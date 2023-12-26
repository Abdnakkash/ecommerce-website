<?php
include 'connection.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cs/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <title>Sneakers Club| About Us</title>
</head>
<!-- Start Nav -->
<div id="topnav" class="navbar">
    <a href="index.php" class="logo">
        Sneakers
        <span style="color: red">Club</span>
    </a>
    <div class="navbar-right menu">
        <a href="index.php"> Home</a>
        <a href="AboutUs.php" class="active">About</a>
        <a href="shop.php">Shop</a>
        <a href="ContactUs.php"> Contact </a>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        } else {
            echo '<a href="Loginpage.php"><i class="far fa-user"></i> Login</a>';
        }
        ?>
    </div>
</div>
<!-- End Nav -->
<div class="navbar-right">
    <a href="javascript:void(0);" class="icon" onclick="showMenu()">
        <i class="fa fa-bars"></i>
    </a>
</div>
<div id="slideshow-container" class="slideshow-container">
    <div class="slide-item bgimg fade" style="background-image: url('img/Group\ 1.jpg');">
    </div>
    <script src="js/index.js"></script>

    <!-- Start About Us -->
    <div class="about">
        <div class="about-con">
            <div class="about-row">
                <div class="about-flex">
                    <h1>About Us</h1>
                    <h3>Discover Our Company</h3>
                    <p>Welcome to Sneakers Club, where style meets comfort in every step you take! As a premier destination for footwear enthusiasts, we take pride in curating a diverse collection of the latest trends and timeless classics. Our passion for quality craftsmanship is reflected in every pair of shoes we offer, ensuring that each step is not only stylish but also incredibly comfortable. Whether you're seeking the perfect pair for a special occasion or looking to elevate your everyday style, Sneakers Club is your go-to destination. Step into a world of fashion-forward footwear, where each shoe tells a unique story and complements your individuality. Join us in embracing the perfect blend of fashion and function, and let your feet do the talking with Sneakers Club.</p>
                    <div class="about-socail">
                        <a href="#"> <i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <a href="" class="button">Learn More..</a>
                </div>
                <div class="about-img">
                    <img src="img/pexels-vinícius-estevão-8506251.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End About Us -->
    <!--Start Footer-->
    <footer class="footer1">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Sneakers Club</h4>
                    <ul>
                        <li><a href="AboutUs.php">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="FAQ.php">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>shop</h4>
                    <ul>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($categories as $category) {
                            echo '<li><a href="#">' . $category['name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--End Footer-->
    <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    </body>

</html>