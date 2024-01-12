<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cs/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <title>Sneakers Club | lOGIN</title>
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

    <!-- Start Main -->
    <div class="wrapper">
        <div class="box-btn">
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
                <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </div>

        <div class="form-box">

            <form action="login.php" method="post" class="login-container" id="login">
                <div class="top">
                    <header>Login</header>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" placeholder="Username or Email" name="email">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Password" name="password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Login">
                </div>
                <div class="two-col">
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </form>
            <form action="register.php" method="post" class="register-container" id="register">
                <div class="top">
                    <header>Sign Up</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Firstname" name="firstname" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Lastname" name="lastname" required>
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Email" name="email" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Address" name="address" required>
                    <i class="fa-regular fa-address-book"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register">
                </div>
                <div class="two-col">
                    <div class="two">
                        <label>By signing up, you agree you've read and accepted our <a href="#">Terms and Conditions.</a> Please see our Privacy Policy for information on how we process your data.</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Main -->



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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>

    <script>
        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }

        function register() {
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>

</body>

</html>