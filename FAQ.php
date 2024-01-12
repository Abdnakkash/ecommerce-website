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
    <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <title>Sneakers Club| FAQ</title>
</head>

<body>

    <!-- Start Nav -->
    <div id="topnav" class="navbar1">
        <a href="index.php" class="logo">
            Sneakers
            <span style="color: red">Club</span>
        </a>
    </div>
    <!-- End Nav -->

    <div class="faq">
        <h1>Frequently Asked Questions</h1>
        <div class="main">
            <button class="accordion">
                How do I place an order on your website?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>To place an order, simply browse our collection, select your desired pair of shoes, choose the size and quantity, and click "Add to Cart." Follow the prompts to complete your purchase.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                Is it possible to track the status of my order?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Yes, you can track your order by logging into your account and navigating to the "Order History" section. We also provide tracking information via email once your order is shipped.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                Can I modify or cancel my order after it has been placed?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Unfortunately, once an order is confirmed, modifications or cancellations are not possible. Please review your order carefully before completing the purchase.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                What payment methods do you accept?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>We accept major credit cards (Visa, MasterCard, American Express) and PayPal for secure and convenient transactions.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                What is your return policy?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Our return policy allows returns within 30 days of purchase. Please visit our Returns and Exchanges page for instructions on initiating a return.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                How can I find the right size for my shoes?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Consult our size guide, which provides detailed information on measuring your feet to ensure the perfect fit. You can find the size guide on each product page.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                How can I contact customer support?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Our customer support team can be reached via email at Sneakersclub@gmail.com or through our Contact Us page. We aim to respond to inquiries within 24 hours.</p>
            </div>
        </div>

        <div class="main">
            <button class="accordion">
                Why should I create an account on your website?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>Creating an account allows you to track your orders, save your favorite items, and streamline the checkout process for future purchases.</p>
            </div>
        </div>
    </div>

    <!--Start Footer-->
    <footer class="footer1">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Sneakers Club</h4>
                    <ul>
                        <li><a href="AboutUs.html">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="FAQ.html">FAQ</a></li>
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

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;

                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
</body>

</html>