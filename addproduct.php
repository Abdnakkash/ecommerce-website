<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';


$message = "";

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['productImg'])) {

        $productName = $_POST['productName'];
        $productSize = $_POST['productSize'];
        $productPrice = $_POST['productPrice'];
        $productDescription = $_POST['productDescription'];
        $categoryName = $_POST['categoryName'];

        $imageContent = file_get_contents($_FILES["productImg"]["tmp_name"]);

        $stmt = $conn->prepare("INSERT INTO products (productName, img_data, size, price, description, categoryName) VALUES (:productName, :img_data, :size, :price, :description, :categoryName)");
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':img_data', $imageContent, PDO::PARAM_LOB);
        $stmt->bindParam(':size', $productSize);
        $stmt->bindParam(':price', $productPrice);
        $stmt->bindParam(':description', $productDescription);
        $stmt->bindParam(':categoryName', $categoryName);

        if ($stmt->execute()) {
            $message = "Product added successfully!";
        } else {
            $message = "Error executing query: " . implode(" ", $stmt->errorInfo());
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
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input,
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 15px;
            color: #333;
            text-align: center;
        }

        a button {
            margin: 10px;
            padding: 10px;
            width: 150px;

        }

        @media screen and (max-width: 600px) {
            a {
                padding: 8px 16px;
                overflow: hidden;
            }
        }

        @media screen and (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
                overflow: hidden;
            }
        }
    </style>
</head>

<body>
    
    <h2>Add Product</h2>
    <p class="message"><?php echo $message; ?></p>
    <!-- Add Product Form -->
    <form method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <label for="productImg">Product Image:</label>
        <input type="file" id="productImg" name="productImg" accept="image/*" required>

        <label for="productSize">Product Size:</label>
        <input type="text" id="productSize" name="productSize" required>

        <label for="productPrice">Product Price:</label>
        <input type="text" id="productPrice" name="productPrice" required>

        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea>

        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" required>

        <button type="submit" name="addProduct">Add Product</button>
    </form>
    <a href="dashboard.php">
        <button>Return to Dashboard</button>
    </a>

</body>

</html>