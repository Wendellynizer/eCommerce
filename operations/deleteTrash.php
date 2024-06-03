<?php

require_once "../sessionCheck.php";
                            
if(isset($_POST["product_id"])) {
    $productId = $_POST["product_id"];

    $stmt = $conn->prepare("CALL DeleteProduct(?)");
    $stmt->bind_param("i", $productId);

    if (!$stmt->execute()) {
        exit;
    }
}     
?>