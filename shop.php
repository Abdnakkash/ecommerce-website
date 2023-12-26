<?php
include 'connection.php';

try {
  $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $con->query("SELECT * FROM products LIMIT 14");
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

    .confirmation-message {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      padding: 10px;
      font-size: 18px;
    }
  </style>
</head>

<body>
  <!-- Start Nav -->
  <div id="topnav" class="navbar">
    <a href="index.php" class="logo">
      Sneakers
      <span style="color: red">Club</span>
    </a>
    <div class="navbar-right menu">
      <a href="index.php"> Home</a>
      <a href="AboutUs.php">About</a>
      <a href="shop.php" class="active">Shop</a>
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
  <!-- Start Main -->
  <div class="navbar-right">
    <a href="javascript:void(0);" class="icon" onclick="showMenu()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  <div id="slideshow-container" class="slideshow-container">
    <div class="slide-item bgimg fade" style="background-image: url('img/pexels-tamanna-rumee-7957755.jpg');">
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

    <div class="slide-item bgimg fade" style="background-image: url('img/lowJordan.jpg');">
      <div class="caption">
        <button>
          Order now
        </button>
      </div>
    </div>

    <div class="slide-item bgimg fade" style="background-image: url('img/lowjordan2.jpg');">
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
      <span class="dot" onclick="chooseSlide(4)"></span>
      <span class="dot" onclick="chooseSlide(5)"></span>
    </div>
  </div>

  <script src="js/index.js"></script>
  <!-- End Main -->
  <!-- Start Shop -->
  <?php
  try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->query("SELECT * FROM products LIMIT 14");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $con = null;
  ?>

  <div class="products">
    <div class="Pr-con">
      <h1 class="lg-title">Special Shoes With Offers</h1>
      <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur quos sit consectetur, ipsa voluptatem vitae necessitatibus dicta veniam, optio, possimus assumenda laudantium. Temporibus, quis cum.</p>

      <div class="product-items">
        <?php foreach ($products as $product) : ?>
          <div class="product">
            <div class="product-content">
              <div class="product-img">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($product['img_data']); ?>" alt="product image">
              </div>
              <div class="product-btns">
                <button type="button" class="btn-buy" onclick="showOrderForm('<?php echo $product['productname']; ?>', '<?php echo $product['price']; ?>')">
                  Buy now <span><i class="fa-solid fa-bag-shopping"></i></span>
                </button>
              </div>
            </div>
            <div class="product-info">
              <div class="product-info-top">
                <h2 class="sm-title"><?php echo $product['productname']; ?></h2>
              </div>
              <a href="#" class="product-name"><?php echo $product['description']; ?></a>
              <p class="product-price">$ <?php echo $product['price']; ?></p>
              <p class="product-size">Size: <?php echo $product['size']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="pagination">
        <button class="btn1">Prev</button>
        <ul>
          <li class="link active" value="1">1</li>
          <li class="link" value="2">2</li>
          <li class="link" value="3">3</li>
        </ul>
        <button class="btn1">Next</button>
      </div>
    </div>
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

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" readonly>

        <label for="productPrice">Product Price:</label>
        <input type="text" id="productPrice" name="productPrice" readonly>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>

        <label for="totalAmount">Total Amount:</label>
        <input type="text" id="totalAmount" name="totalAmount" readonly>

        <button type="submit">Buy It</button>
      </form>
    </div>
  </div>

  <!-- End Shop -->
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
  <script src="js/app2.js"></script>
  <script>
    function showOrderForm(productName, productPrice) {
      document.getElementById('productName').value = productName;
      document.getElementById('productPrice').value = productPrice;
      document.getElementById('totalAmount').value = productPrice;
      document.getElementById('order-modal').style.display = 'block';
    }

    function closeOrderForm() {
      document.getElementById('order-modal').style.display = 'none';
    }

    function submitOrderForm() {


      alert('Your order is on the way!');
      document.getElementById('order-modal').style.display = 'none';
    }

    function submitOrderForm() {
      var firstName = document.getElementById('firstName').value;
      var lastName = document.getElementById('lastName').value;
      var productName = document.getElementById('productName').value;
      var productPrice = parseFloat(document.getElementById('productPrice').value);
      var address = document.getElementById('address').value;
      var totalAmount = parseFloat(document.getElementById('totalAmount').value);

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'insert_order.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          alert('Your order is on the way!');
          document.getElementById('order-modal').style.display = 'none';
        }
      };
      var data = 'first_name=' + encodeURIComponent(firstName) +
        '&last_name=' + encodeURIComponent(lastName) +
        '&product_name=' + encodeURIComponent(productName) +
        '&price=' + encodeURIComponent(productPrice) +
        '&address=' + encodeURIComponent(address) +
        '&total_amount=' + encodeURIComponent(totalAmount);
      xhr.send(data);

      var confirmationMessage = document.createElement('div');
      confirmationMessage.className = 'confirmation-message';
      confirmationMessage.innerHTML = 'Your order is on the way!';


      document.body.appendChild(confirmationMessage);


      document.getElementById('order-modal').style.display = 'none';


      setTimeout(function() {
        document.body.removeChild(confirmationMessage);
      }, 5000);
    }
  </script>
    <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>

</html>