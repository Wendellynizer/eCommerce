<?php
require_once '../sessionCheck.php';

if(isset($_POST["product_id"])) {
    $pID = $_POST["product_id"];

    $stmt = $conn->prepare("UPDATE products SET deleted_at = NULL WHERE product_id = ?");
    $stmt->bind_param("i", $pID);

    if($stmt->execute()) {
        echo "success";
    }
    
    $stmt->close();
} else {
    header("location: ../buyer/listings.php");
}
?>