<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    $orderId = $_POST['order_id'];

    try {
        $cancelStmt = $conn->prepare("UPDATE orders SET status = 'Canceled' WHERE order_id = :order_id");
        $cancelStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $cancelStmt->execute();

        $orderStmt = $conn->prepare("SELECT * FROM orders WHERE order_id = :order_id");
        $orderStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $orderStmt->execute();
        $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'Your Email';
        $mail->Password = 'password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('Your Email', 'admin');
        $mail->addAddress($order['email'], $order['first_name']);

        $mail->isHTML(true);
        $mail->Subject = 'Order Cancellation';
        $mail->Body = 'Your order has been canceled.';

        $mail->send();

        $deleteStmt = $conn->prepare("DELETE FROM orders WHERE order_id = :order_id");
        $deleteStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $deleteStmt->execute();

        header("Location: order.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Email Error: " . $mail->ErrorInfo;
    }
}

// Fetch orders
try {
    $stmt = $conn->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .cancel-button {
            background-color: #d9534f;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        .cancel-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>
    <h2>All Orders</h2>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>email</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['first_name']; ?></td>
                    <td><?php echo $order['last_name']; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <input type="submit" name="cancel_order" class="cancel-button" value="Cancel Order">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
