<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $size = isset($_POST['size']) ? $_POST['size'] : '';
    $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
    $productPrice = isset($_POST['productPrice']) ? $_POST['productPrice'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : '';

    if (empty($firstName) || empty($lastName) || empty($email) || empty($size) || empty($productName) || empty($productPrice) || empty($address) || empty($totalAmount)) {
        http_response_code(400);
        echo json_encode(array("success" => false, "message" => "All fields are required."));
    } else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'Your Email';
            $mail->Password = 'Password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('Your Email', 'Sneakers Club');
            $mail->addAddress($email, $firstName . ' ' . $lastName);

            $mail->isHTML(true);
            $mail->Subject = 'Order Confirmation - Sneakers Club';
            $mail->Body    = "Thank you for your order!<br><br>" .
                "Product: $productName<br>" .
                "Size: $size<br>" .
                "Total Amount: $totalAmount<br>" .
                "Address: $address<br>";

            $mail->send();
            http_response_code(200);
            echo json_encode(array("success" => true, "message" => "Your order has been submitted successfully. An email confirmation has been sent."));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("success" => false, "message" => "Failed to send the email. Please try again later."));
            error_log('Error sending email: ' . $mail->ErrorInfo);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(array("success" => false, "message" => "Method not allowed."));
}
