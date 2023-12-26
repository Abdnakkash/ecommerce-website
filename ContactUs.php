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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <title>Sneakers Club| Contact Us</title>
</head>
<!-- Start Nav -->
<div id="topnav" class="navbar1">
  <a href="index.php" class="logo">
    Sneakers
    <span style="color: red">Club</span>
  </a>
</div>
<!-- End Nav -->

<div class="container-cn">
  <span class="big-circle"></span>
  <div class="form">
    <div class="contact-info">
      <h3 class="title">Let's get in touch</h3>
      <p class="text">
        Feel free to get in touch with us! Your questions, feedback, and inquiries are important to us. Drop us a message or give us a call. Our dedicated team is here to assist you and provide the information you need. You can also connect with us on social media. We look forward to hearing from you and serving you better.
      </p>

      <div class="info">
        <div class="information">
          <img src="img/location.png" class="icon" alt="" />
          <p>92 Lebanon, BA 11553</p>
        </div>
        <div class="information">
          <img src="img/email.png" class="icon" alt="" />
          <p>sneakersclub@gmail.com</p>
        </div>
        <div class="information">
          <img src="img/phone.png" class="icon" alt="" />
          <p>123-456-789</p>
        </div>
      </div>

      <div class="social-media">
        <p>Connect with us :</p>
        <div class="social-icons">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="contact-form">
      <span class="circle one"></span>
      <span class="circle two"></span>

      <form action="index.html" autocomplete="off">
        <h3 class="title">Contact us</h3>
        <div class="input-container">
          <input type="text" name="name" class="input" />
          <label for="">Username</label>
          <span>Username</span>
        </div>
        <div class="input-container">
          <input type="email" name="email" class="input" />
          <label for="">Email</label>
          <span>Email</span>
        </div>
        <div class="input-container">
          <input type="tel" name="phone" class="input" />
          <label for="">Phone</label>
          <span>Phone</span>
        </div>
        <div class="input-container textarea">
          <textarea name="message" class="input"></textarea>
          <label for="">Message</label>
          <span>Message</span>
        </div>
        <input type="submit" value="Send" class="bt" />
      </form>
    </div>
  </div>
</div>

<script src="js/app.js"></script>

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
<script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>

</html>