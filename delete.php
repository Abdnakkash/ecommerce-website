<?php
include 'connection.php';

$message = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteProduct'])) {
        $productName = $_POST['productName'];
        $stmt = $conn->prepare("DELETE FROM products WHERE productname = :productName");
        $stmt->bindParam(':productName', $productName);

        if ($stmt->execute()) {
            $message = "Product deleted successfully!";
        } else {
            $message = "Error deleting product: " . implode(" ", $stmt->errorInfo());
        }
    }
} catch (PDOException $e) {
    $message = "Exception: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }

        .message {
            margin-top: 15px;
            color: #333;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Delete Product</h2>

    <form method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <button type="submit" name="deleteProduct">Delete Product</button>
    </form>

    <?php if ($message) : ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</body>

</html>