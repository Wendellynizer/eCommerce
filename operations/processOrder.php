<?php

require_once "../sessionCheck.php";

if(isset($_POST["submit"])) {

    $productId = $_POST["productId"];
    $qty = $_POST["qty"];
    $currentDateTime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_by, product_id, qty_ordered, order_date_time) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis", $_SESSION["user"]["user_id"], $productId, $qty, $currentDateTime);

    if($stmt->execute()) {
       

        // get user, seller, and product data
        // $result = $conn->query("SELECT username, seller_id, product_name, quantity, total_amount FROM order_details WHERE username='{$_SESSION["user"]["username"]}' AND order_date_time = '{$currentDateTime}'");
        // $row = $result->fetch_assoc();

        // $customerMsg = "Your order of ". $row["product_name"] ." has been shipped. <a href='purchases.php'>See purchases.</a>";
        // $orderProcessing = "Order Processing";
        // $sellerMsg = $row["username"]. " has placed an order(s). <a href='orders.php'>See orders now</a>";
        // $customerOrder = "Customer Order";


        // $stmt2 = $conn->prepare("CALL AddNotification(?,?,?)");
        // $stmt2->bind_param("iss", $_SESSION["user"]["user_id"], $orderProcessing, $customerMsg);
        // $stmt2->execute();

        // $stmt3 = $conn->prepare("CALL AddNotification(?,?,?)");
        // $stmt3->bind_param("iss",$row["seller_id"], $customerOrder, $sellerMsg);
        // $stmt3->execute();

        // $stmt2->close();
        // $stmt3->close();
    }

    $stmt->close();

    header("location: ../buyer/products.php");
}
?>