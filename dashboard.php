<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="cs/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="product.php" onclick="loadContent('showproduct')">My Product</a></li>
                <!-- <li><a href="edit.php" onclick="loadContent('editProduct')">Edit Product</a></li> -->
                <li><a href="addproduct.php" onclick="loadContent('addProduct')">Add Product</a></li>
                <!-- <li><a href="delete.php" onclick="loadContent('deleteProduct')">Delete Product</a></li> -->
                <li><a href="order.php" onclick="loadContent('orders')">Orders</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Welcome to the Admin Dashboard</h1>
            <div id="dynamic-content">

            </div>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
</body>

</html>