<?php
include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
    die("An error occurred while fetching products.");
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-img {
            width: 50%;
        }

        .btn-delete,
        .btn-edit {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>All Products</h2>
    <form enctype="multipart/form-data" action="actions.php" method="post">
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Description</th>
                <th>Category Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['productid']; ?></td>
                    <td><?php echo $product['productname']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['size']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['categoryname']; ?></td>
                    <td>
                        <img class="product-img" src="data:image/jpeg;base64,<?php echo base64_encode($product['img_data']); ?>" alt="product image">
                    </td>
                    <td>
                        <button class="btn-delete" onclick="deleteProduct(<?php echo $product['productid']; ?>)">Delete</button>
                        <button class="btn-edit" onclick="editProduct(<?php echo $product['productid']; ?>, '<?php echo $product['productname']; ?>', <?php echo $product['price']; ?>, '<?php echo $product['size']; ?>')">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </form>
    
    <script>
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                fetch('actions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=delete&productId=' + productId,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete the product.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            }
        }

        function editProduct(productId, currentProductName, currentPrice, currentSize) {
    var newProductName = prompt('Enter the new product name:', currentProductName);
    var newPrice = prompt('Enter the new price:', currentPrice);
    var newSize = prompt('Enter the new size:', currentSize);

    if (newProductName !== null && newPrice !== null && newSize !== null) {
        var formData = new FormData();
        formData.append('action', 'edit');
        formData.append('productId', productId);
        formData.append('newProductName', newProductName);
        formData.append('newPrice', newPrice);
        formData.append('newSize', newSize);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        fetch('actions.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server Response:', data);
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to edit the product.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    }
}

    </script>
</script>
</body>

</html>
