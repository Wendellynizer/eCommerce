<?php
require_once "../sessionCheck.php";

if(isset($_POST["submit"])) {

    $productId = $_POST["productId"];
    $qty = $_POST["qty"];
    $currentDateTime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_by, product_id, qty_ordered, order_date_time) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis", $_SESSION["user"]["user_id"], $productId, $qty, $currentDateTime);

    if($stmt->execute()) {
       
        // $msg = $_SESSION['user']['username']." has placed an order";
        // $notif_type = "Customer Order";

        // $stmt2 = $conn->prepare("
        //     INSERT INTO notifications (user_id, notif_type, message) 
        //     SELECT u.user_id, ?, ? FROM users u INNER JOIN products p 
        //     WHERE ");

        // $stmt2->bind_param("iss",  $_SESSION['user']['user_id'], $notif_type, $msg);
        // $stmt2->execute();
    }

    $stmt->close();

    header("location: ../buyer/products.php");
}
?>