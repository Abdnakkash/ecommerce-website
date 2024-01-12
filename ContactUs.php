<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $message = isset($_POST['message']) ? $_POST['message'] : '';

  if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
    $mail = new PHPMailer();

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'Your Email';
    $mail->Password = 'password';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("Your Email");
    $mail->Subject = "New Contact Form Submission";
    $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";

    try {
      $mail->send();
      $response = array("status" => "success", "message" => "Thank you for your email. We will contact you shortly.");
    } catch (Exception $e) {
      $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      error_log($errorMessage);
      $response = array("status" => "failed", "message" => $errorMessage);
    }
  } else {
    $response = array("status" => "failed", "message" => "Invalid input data.");
  }

  exit(json_encode($response));
}
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
  <title>Sneakers Club| Contact Us</title>
  <style>
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      align-items: center;
      justify-content: center;
    }

    .message-popup {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    #popupTitle {
      color: #333;
      font-size: 24px;
      margin-bottom: 10px;
    }

    #popupText {
      color: #555;
      font-size: 16px;
      margin-bottom: 20px;
    }

    #popupCloseBtn {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    #popupCloseBtn:hover {
      background-color: #2980b9;
    }
  </style>
</head>

<!-- Start Nav -->
<div id="topnav" class="navbar1">
  <a href="index.php" class="logo">
    Sneakers
    <span style="color: red">Club</span>
  </a>
</div>
<!-- End Nav -->

<body>
  <div class="container-cn">
    <span class="big-circle"></span>
    <div class="form">
      <div class="contact-info">
        <h3 class="title">Let's get in touch</h3>
        <p class="text">
          Feel free to get in touch with us! Your questions, feedback, and inquiries are important to us.
          Drop us a message or give us a call. Our dedicated team is here to assist you and provide the
          information you need. You can also connect with us on social media. We look forward to hearing
          from you and serving you better.
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

        <form id="contactForm" method="post" autocomplete="off">
          <h3 class="title">Contact us</h3>
          <div class="input-container">
            <input type="text" name="name" id="name" class="input" />
            <label for="name">Username</label>
            <span>Username</span>
          </div>
          <div class="input-container">
            <input type="email" name="email" id="email" class="input" />
            <label for="email">Email</label>
            <span>Email</span>
          </div>
          <div class="input-container">
            <input type="tel" name="phone" id="phone" class="input" />
            <label for="phone">Phone</label>
            <span>Phone</span>
          </div>
          <div class="input-container textarea">
            <textarea name="message" id="message" class="input"></textarea>
            <label for="message">Message</label>
            <span>Message</span>
          </div>
          <input type="submit" value="Send" class="bt" />
        </form>

        <!-- Message overlay -->
        <div id="messageOverlay" class="overlay" style="display:none;">
          <div class="message-popup">
            <h2 id="popupTitle"></h2>
            <p id="popupText"></p>
            <button id="popupCloseBtn" onclick="closePopup()">OK</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Footer -->
  <footer class="footer">
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
            <li><a href="#">Man Shoes</a></li>
            <li><a href="#">Women Shoes</a></li>
            <li><a href="#">Kids Shoes</a></li>
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

  <script src="js/app.js"></script>
  <script src="https://kit.fontawesome.com/b3c50b5888.js" crossorigin="anonymous"></script>
  <script>
    function openPopup(status, message) {
      var overlay = document.getElementById("messageOverlay");
      var popup = document.getElementById("popup");

      // Set the class based on status (success, error)
      popup.className = "message-popup " + status;

      // Update title and text
      document.getElementById("popupTitle").innerText = status === "success" ? "Thank you!" : "Oops...";
      document.getElementById("popupText").innerHTML = message;

      overlay.style.display = "block";
    }

    function closePopup() {
      document.getElementById("messageOverlay").style.display = "none";
    }

    $(document).ready(function() {
      $("#contactForm").submit(function(event) {
        event.preventDefault();

        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();

        $.ajax({
          type: "POST",
          url: "ContactUs.php",
          data: {
            name: name,
            email: email,
            message: message
          },
          dataType: "json",
          success: function(response) {
            openPopup(response.status, response.message);

            if (response.status === "success") {
              $('#contactForm')[0].reset();
            }
          },
          error: function() {
            openPopup("error", "An error occurred while processing your request.");
          }
        });
      });
    });
  </script>

</body>

</html>
