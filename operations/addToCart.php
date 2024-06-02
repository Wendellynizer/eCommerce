<?php
require_once "../sessionCheck.php";

if(isset($_POST["id"])) {

    $productId = $_POST["id"];
    $qty = $_POST["qty"];

    $stmt = $conn->prepare("INSERT INTO carts (user_id, product_id, qty) VALUES (?,?,?)");
    $stmt->bind_param("iii", $_SESSION["user"]["user_id"], $productId, $qty);
    $stmt->execute();
} else {
    header("location: ../buyer/cart.php");
}
?>