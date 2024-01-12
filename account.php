<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: loginpage.php");
    exit();
}

$id = $_SESSION['user']['id'];

// Retrieve user data
$stmtUserInfo = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmtUserInfo->bindParam(':id', $id);
$stmtUserInfo->execute();
$userData = $stmtUserInfo->fetch(PDO::FETCH_ASSOC);

// Retrieve order history
$stmtOrderHistory = $conn->prepare("SELECT * FROM orders WHERE email = :email");
$stmtOrderHistory->bindParam(':email', $_SESSION['user']['email']);
$stmtOrderHistory->execute();
$orderHistory = $stmtOrderHistory->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            text-align: center;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-box {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        h1 {
            margin: 0;
        }

        .navigation {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background-color: #ecf0f1;
            border-radius: 0 0 10px 10px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .section {
            display: none;
            padding: 20px;
        }

        .profile-info table,
        .order-history table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        form {
            text-align: left;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="welcome-box">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['firstname']); ?></h1>
        </div>

        <div class="navigation">
            <button id="profileInfoBtn">Profile Info</button>
            <button id="editProfileBtn">Edit Profile</button>
            <button id="orderHistoryBtn">Order History</button>
            <button onclick="logout()">Logout</button>
        </div>

        <div class="section profile-info">
            <h2>Profile Info</h2>
            <table>
                <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo htmlspecialchars($userData['firstname']); ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo htmlspecialchars($userData['lastname']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($userData['email']); ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo htmlspecialchars($userData['address']); ?></td>
                </tr>
            </table>
        </div>

        <div class="section edit-profile-form">
            <h2>Edit Profile</h2>
            <form id="editProfileForm" action="update_profile.php" method="post">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="firstname" value="<?php echo htmlspecialchars($userData['firstname']); ?>" required>

                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="lastname" value="<?php echo htmlspecialchars($userData['lastname']); ?>" required>

                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>

                <label for="editPhone">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required>

                <button type="submit">Update Profile</button>
            </form>
        </div>

        <div class="section order-history">
            <h2>Order History</h2>
            <table>
                <tr>
                    <th>OrderID</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($orderHistory as $order) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['size']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profileInfo = document.querySelector(".profile-info");
            const editProfileForm = document.querySelector(".edit-profile-form");
            const orderHistory = document.querySelector(".order-history");

            const profileInfoBtn = document.getElementById("profileInfoBtn");
            const editProfileBtn = document.getElementById("editProfileBtn");
            const orderHistoryBtn = document.getElementById("orderHistoryBtn");

            profileInfoBtn.addEventListener("click", function () {
                showSection(profileInfo);
            });

            editProfileBtn.addEventListener("click", function () {
                showSection(editProfileForm);
            });

            orderHistoryBtn.addEventListener("click", function () {
                showSection(orderHistory);
            });

            function showSection(section) {
                profileInfo.style.display = "none";
                editProfileForm.style.display = "none";
                orderHistory.style.display = "none";

                section.style.display = "block";
            }
        });
        function logout() {
        // Redirect to the logout script
        window.location.href = 'logout.php';
    }
    </script>
</body>

</html>