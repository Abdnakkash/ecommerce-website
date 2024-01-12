<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $size = $_POST['size'];
    $address = $_POST['address'];
    $totalAmount = $_POST['totalAmount'];

    try {
        $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare("INSERT INTO orders (first_name, last_name, product_name, price, size, email, address, total_amount) 
            VALUES (:firstname, :lastname, :productname, :price, :size, :email, :address, :total_amount)");

        $stmt->bindParam(':firstname', $firstName);
        $stmt->bindParam(':lastname', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':productname', $productName);
        $stmt->bindParam(':price', $productPrice);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total_amount', $totalAmount);

        $stmt->execute();
        header("refresh:0;url=shop.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}
