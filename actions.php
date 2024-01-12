<?php
include 'connection.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'delete':
        
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;

 
        if ($productId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid productId']);
            exit;
        }
        echo json_encode(['success' => true]);
        break;

    case 'edit':
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
        $newProductName = isset($_POST['newProductName']) ? htmlspecialchars($_POST['newProductName']) : '';
        $newPrice = isset($_POST['newPrice']) ? floatval($_POST['newPrice']) : 0;
        $newSize = isset($_POST['newSize']) ? htmlspecialchars($_POST['newSize']) : '';

      
        if ($productId <= 0 || $newPrice <= 0 || empty($newProductName)) {
            echo json_encode(['success' => false, 'message' => 'Invalid input values']);
            exit;
        }

        if (isset($_FILES['newImg']) && $_FILES['newImg']['error'] === UPLOAD_ERR_OK) {
            $imgData = file_get_contents($_FILES['newImg']['tmp_name']);

            try {
             
                $stmt = $conn->prepare("UPDATE products SET productname = ?, price = ?, size = ?, img_data = ? WHERE productid = ?");
                $stmt->bindParam(1, $newProductName);
                $stmt->bindParam(2, $newPrice);
                $stmt->bindParam(3, $newSize);
                $stmt->bindParam(4, $imgData, PDO::PARAM_LOB);
                $stmt->bindParam(5, $productId);
                $stmt->execute();

                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Database error']);
            }
        } else {
           
            try {
                $stmt = $conn->prepare("UPDATE products SET productname = ?, price = ?, size = ? WHERE productid = ?");
                $stmt->bindParam(1, $newProductName);
                $stmt->bindParam(2, $newPrice);
                $stmt->bindParam(3, $newSize);
                $stmt->bindParam(4, $productId);
                $stmt->execute();

                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Database error']);
            }
        }

        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action']);
}
?>
