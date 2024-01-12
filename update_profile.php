<?php
include 'connection.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: loginpage.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_SESSION['user']['id']; // Assuming you have 'id' stored in the session
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";

    // Validate and sanitize form data as needed

    // Update user information in the database
    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, address = :address WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':address', $address);

    try {
        $stmt->execute();
        // Optionally, you can redirect the user to the profile page after successful update
        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        // Handle the error as needed
    }
}

// Close the database connection
$conn = null;
?>
