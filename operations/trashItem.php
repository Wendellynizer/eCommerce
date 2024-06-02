<?php
require_once '../sessionCheck.php';

if(isset($_POST["product_id"])) {
    $pID = $_POST["product_id"];

    $currentDateTime = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("UPDATE products SET deleted_at = ? WHERE product_id = ?");
    $stmt->bind_param("si", $currentDateTime, $pID);

    if($stmt->execute()) {
        echo "success";
    }
    
    $stmt->close();
} else {
    header("location: ../buyer/listings.php");
}
?>