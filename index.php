<?php
include 'connection.php';
session_start();

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        $image = $_FILES['image']['tmp_name'];

        if ($image) {
            $imgData = file_get_contents($image);

            $stmt = $con->prepare("INSERT INTO products (img_data) VALUES (:imgData)");
            $stmt->bindParam(':imgData', $imgData, PDO::PARAM_LOB);
            $stmt->execute();
        }
    }

    $stmt = $con->query("SELECT * FROM products LIMIT 6");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$con = null;
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
    <title>Sneakers Club</title>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form {
            display: grid;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <!-- Start Nav -->
    <div class="navbar" id="navbar">
        <a href="index.php" class="logo">
            Sneakers
            <span style="color: red">Club</span>
        </a>
        <div class="navbar-right menu">
            <a href="index.php" class="active"> Home</a>
            <a href="AboutUs.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="ContactUs.php"> Contact </a>
            <?php
            if (isset($_SESSION['user'])) {
                // If the user is logged in, show the logout button
                echo '<a href="account.php"><i class="fa-solid fa-user"></i></a>';
                echo '<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
            } else {
                // If the user is not logged in, show the login button
                echo '<a href="Loginpage.php"><i class="far fa-user"></i> Login</a>';
            }
            ?>
        </div>
    </div>
    <!-- End Nav -->
    <!-- Start Main -->
    <div class="navbar-right">
        <a href="javascript:void(0);" class="icon" onclick="showMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div id="slideshow-container" class="slideshow-container">
        <div class="slide-item bgimg fade" style="background-image: url('img/Group\ 1.jpg');">
        </div>

        <div class="slide-item bgimg fade" style="background-image: url('img/airforce.jpg');">
            <div class="caption">
                <button> Order now</button>
            </div>
        </div>

        <div class="slide-item bgimg fade" style="background-image: url('img/airforce2.jpg');">
            <div class="caption">
                <button>
                    Order now
                </button>
            </div>
        </div>

        <div class="slide-item bgimg fade" style="background-image: url('img/ultrraboosy.jpg');">
            <div class="caption">
                <button>
                    Order now
                </button>
            </div>
        </div>

        <div id="slide-control" class="slide-control">
            <span class="dot" onclick="chooseSlide(0)"></span>
            <span class="dot" onclick="chooseSlide(1)"></span>
            <span class="dot" onclick="chooseSlide(2)"></span>
            <span class="dot" onclick="chooseSlide(3)"></span>
        </div>
    </div>

    <script src="js/index.js"></script>
    <!-- End Main -->

    <!-- Start About -->
    <div class="About">
        <div class="image">
            <div class="col">
                <div class="grid-row"><img src="img/lowJordan.jpg"></div>
                <div class="grid-row2"><img src="img/airfoece2.jpg"></div>
                <div class="grid-row3"><img src="img/lowjordan2.jpg"></div>
            </div>
        </div>
        <div class="des">
            <h1>About<span style="color: red">Us</span>
            </h1>
            <h2>We Provide High Quality Shoes.</h2>
            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla possimus omnis consequatur minus eveniet esse. Et modi quas tempora eligendi repudiandae est.</h3>
            <div class="button">
                <button  onclick="window.location.href='AboutUs.php'">Explore More</button>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start category -->
    <div class="category">
        <h1>Categories</h1>
    </div>
    <div class="cat-main">
        <div class="cat-img">
            <img src="img/men shoes.jpg">
            <div class="card-body">
                <h1>Men Collection</h1>
                <div class="button">
                    <a href="shop.html"><button>Explore More</button></a>
                </div>
            </div>
        </div>

        <div class="cat-img">
            <img src="img/kids shoes.jpg">
            <div class="card-body2">
                <h1>Kids Collection</h1>
                <div class="button">
                    <a href="shop.html"><button>Explore More</button></a>
                </div>
            </div>
        </div>

        <div class="cat-img">
            <img src="img/women shoes.jpg">
            <div class="card-body3">
                <h1>Women Collection</h1>
                <div class="button">
                    <a href="shop.html"><button>Explore More</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- End category -->

    <!-- Start featured -->
    <div class="featured">
        <h1>Featured Products</h1>
    </div>
    <div class="row1">
        <?php foreach ($products as $product) : ?>
            <div class="col-4">
                <img src="data:image/png;base64,<?php echo base64_encode($product['img_data']); ?>" alt="<?php echo $product['productname']; ?>">
                <div class="text">
                    <h4><?php echo $product['productname']; ?></h4>
                    <p>$<?php echo $product['price']; ?></p>
                </div>
                <button type="button" class="button1" onclick="showOrderForm('<?php echo $product['productname']; ?>', '<?php echo $product['price']; ?>', '<?php echo $product['size']; ?>')">Buy</button>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Order Form Modal -->
    <div id="order-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeOrderForm()">&times;</span>
            <form id="purchase-form" action="submit_order.php" method="post" onsubmit="return submitOrderForm();">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>

                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" readonly>

                <label for="productPrice">Product Price:</label>
                <input type="text" id="productPrice" name="productPrice" readonly>

                <label for="size">Size:</label>
                <input type="text" id="size" name="size" readonly>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>

                <label for="totalAmount">Total Amount:</label>
                <input type="text" id="totalAmount" name="totalAmount" readonly>

                <button type="submit">Buy It</button>
            </form>

        </div>
    </div>


    <!-- End featured -->

    <!--Start Services-->

    <div class="services" id="Servises">
        <h1>Our Services</h1>

        <div class="services_cards">
            <div class="services_box">
                <i class="fa-solid fa-truck-fast"></i>
                <h3>Fast Delivery</h3>
            </div>

            <div class="services_box">
                <i class="fa-solid fa-rotate-left"></i>
                <h3>10 Days Replacement</h3>
            </div>

            <div class="services_box">
                <i class="fa-solid fa-headset"></i>
                <h3>24 x 7 Support</h3>
            </div>
        </div>
    </div>
    <!--End Services-->

    <!--Start blog-->
    <div class="blog">
        <img src="img/background2.jpg" alt="">
        <div class="card-body">
            <h1>Be a MemeberShip</h1>
            <h2>We have a great deals for you..</h2>
            <div class="button">
                <a href="Login.php"><button>Join Now</button></a>
            </div>
        </div>
    </div>
    <!--End blog-->

    <!--Start Footer-->
    <footer class="footer">
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
    <script>
        function showOrderForm(productName, productPrice, size) {
            document.getElementById('productName').value = productName;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('size').value = size;
            document.getElementById('totalAmount').value = productPrice;
            document.getElementById('order-modal').style.display = 'block';
        }

        function closeOrderForm() {
            document.getElementById('order-modal').style.display = 'none';
        }

        function submitOrderForm() {
            var firstName = document.getElementById('firstName').value;
            var lastName = document.getElementById('lastName').value;
            var email = document.getElementById('email').value;
            var size = document.getElementById('size').value;
            var productName = document.getElementById('productName').value;
            var productPrice = parseFloat(document.getElementById('productPrice').value);
            var address = document.getElementById('address').value;
            var totalAmount = parseFloat(document.getElementById('totalAmount').value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_order.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('Success! Your order is on the way. An email confirmation has been sent.');
                            document.getElementById('order-modal').style.display = 'none';
                        } else {
                            alert('Error! Failed to submit order. ' + response.message);
                        }
                    } else {
                        alert('Error! Failed to submit order. Please try again later.');
                    }
                }
            };

            var formData =
                'firstName=' + firstName +
                '&lastName=' + lastName +
                '&email=' + email +
                '&size=' + size +
                '&productName=' + productName +
                '&productPrice=' + productPrice +
                '&address=' + address +
                '&totalAmount=' + totalAmount;

            xhr.send(formData);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_email.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('Success! Your order is on the way. An email confirmation has been sent.');
                            document.getElementById('order-modal').style.display = 'none';
                        } else {
                            alert('Error! Failed to submit order. ' + response.message);
                        }
                    } else {
                        alert('Error! Failed to submit order. Please try again later.');
                    }
                }
            };

            var formData = 'firstName=' + firstName + '&lastName=' + lastName + '&email=' + email +
                '&size=' + size + '&productName=' + productName + '&productPrice=' + productPrice +
                '&address=' + address + '&totalAmount=' + totalAmount;

            xhr.send(formData);

            return false;
        }
    </script>
    <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>

</html>