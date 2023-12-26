<?php
error_reporting(E_ALL);

$host = "localhost";
$dbname = "sneakersclub";
$username = "root";
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = isset($_POST['email']) ? $_POST['email'] : "";


        if ($email === 'admin@example.com') {
            header("Location: dashboard.php");
            exit();
        }


        $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        $user = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $_SESSION['user'] = $user;

            if ($user['email'] === 'admin@example.com') {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Welcome back, " . $user['firstname'] . "!";

                header("refresh:2;url=index.php");
                exit();
            }
        } else {

            echo "Invalid email or password. Please try again.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
