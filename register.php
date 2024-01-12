<?php
$host = "localhost";
$dbname = "sneakersclub";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";
        $address = isset($_POST['address']) ? $_POST['address'] : "";

        $stmt_check = $conn->prepare("SELECT * FROM users WHERE firstname = :firstname OR email = :email");
        $stmt_check->bindParam(':firstname', $firstname);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        $existingUser = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo "The username or email already exists. Please choose a different username or use a different email address.";
        } else {
            $stmt_insert = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, address) VALUES (:firstname, :lastname, :email, :password, :address)");
            $stmt_insert->bindParam(':firstname', $firstname);
            $stmt_insert->bindParam(':lastname', $lastname);
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':password', $password);
            $stmt_insert->bindParam(':address', $address);

            $stmt_insert->execute();

            header("Location: Login.html");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
