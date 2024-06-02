<?php
require_once "../sessionCheck.php";

if(isset($_POST["cart_id"])) {

    $cartId = $_POST["cart_id"];
    // $qty = $_POST["qty"];


    $stmt = $conn->prepare("DELETE FROM carts WHERE cart_id = ?");
    $stmt->bind_param("i", $cartId);
    $stmt->execute();
} else {
    header("location: ../buyer/cart.php");
}
?>