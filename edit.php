<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['productName'])) {
    $productName = $_GET['productName'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE productname = :productName");
    $stmt->bindParam(':productName', $productName);
    $stmt->execute();

    $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProduct'])) {
    $productName = $_POST['productName'];
    $productSize = $_POST['productSize'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];
    $categoryName = $_POST['categoryName'];

    $targetDirectory = __DIR__ . "/uploads/";
    $targetFile = $targetDirectory . basename($_FILES["productImg"]["name"]);
    move_uploaded_file($_FILES["productImg"]["tmp_name"], $targetFile);

    $stmt = $conn->prepare("UPDATE products SET img = :img, size = :size, price = :price, description = :description, categoryName = :categoryName WHERE productname = :productName");
    $stmt->bindParam(':img', $targetFile);
    $stmt->bindParam(':size', $productSize);
    $stmt->bindParam(':price', $productPrice);
    $stmt->bindParam(':description', $productDescription);
    $stmt->bindParam(':categoryName', $categoryName);
    $stmt->bindParam(':productName', $productName);

    if ($stmt->execute()) {
        $message = "Product updated successfully!";
    } else {
        $message = "Error updating product: " . implode(" ", $stmt->errorInfo());
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="cs/editProduct.css">
</head>

<body>
    <div class="edit-product-container">
        <h2>Edit Product</h2>
        <form id="editProductForm">
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

            <button type="button" onclick="updateProductDetails()">Update Product</button>
        </form>
        <div id="productPreview">
        </div>


        <script>
            function updateProductDetails() {
                const formData = new FormData();
                formData.append('updateProduct', '1');
                formData.append('productName', document.getElementById('productName').value);
                formData.append('productSize', document.getElementById('productSize').value);
                formData.append('productPrice', document.getElementById('productPrice').value);
                formData.append('productDescription', document.getElementById('productDescription').value);
                formData.append('categoryName', document.getElementById('categoryName').value);

                const productImgInput = document.getElementById('productImg');
                formData.append('productImg', productImgInput.files[0]);

                fetch('edit.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(message => {
                        document.getElementById('updateMessage').innerText = message;
                    })
                    .catch(error => {
                        console.error('Error updating product details:', error);
                    });
            }
        </script>
</body>

</html>