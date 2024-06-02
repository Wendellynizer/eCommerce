<?php
require_once "../getConnection.php";


if(isset($_POST["order_id"]) && isset($_POST["status_id"])) {

    $orderId = $_POST["order_id"];
    $statusId = $_POST["status_id"];
    $qty = $_POST["qty"];

    if($statusId == 2) {
        //* query for deducting ordered qty to the product stock
        $stmt = $conn->prepare("
        UPDATE orders o 
        INNER JOIN products p ON o.product_id = p.product_id
        SET o.status_id = ?, p.quantity = (p.quantity - ?)
        WHERE o.order_id = ?
        ");

        $stmt->bind_param("iii", $statusId, $qty, $orderId);
        
        if($stmt->execute()) {
            
            $stmt2 = $conn->prepare("SELECT status from order_details WHERE order_id = ?");
            $stmt2->bind_param("i", $orderId);
            $stmt2->execute();
    
            $result = $stmt2->get_result();
            $row = $result->fetch_assoc();
    
            echo $row["status"];
    
        } else {
            echo "product not shipped :(";
        }

        $stmt->close();
        $stmt2->close();
    }
    else if($statusId == 6) {
        //* query for adding ordered qty to the product stock
        $stmt = $conn->prepare("
        UPDATE orders o 
        INNER JOIN products p ON o.product_id = p.product_id
        SET p.quantity = (p.quantity + ?)
        WHERE o.order_id = ?
        ");

        $stmt->bind_param("ii", $qty, $orderId);

        if($stmt->execute()) {
            echo "casdasd";
            
            // $stmt2 = $conn->prepare("SELECT status from order_details WHERE order_id = ?");
            // $stmt2->bind_param("i", $orderId);
            // $stmt2->execute();
    
            // $result = $stmt2->get_result();
            // $row = $result->fetch_assoc();
    
            // echo $row["status"];
    
        } else {
            echo "product not refunded :(";
        }

        $stmt->close();
        // $stmt2->close();
    } else {
        $stmt = $conn->prepare("UPDATE orders SET status_id = ? WHERE order_id = ?");
        $stmt->bind_param('ii', $statusId, $orderId);
        
        if($stmt->execute()) {
            
            $stmt2 = $conn->prepare("SELECT status from order_details WHERE order_id = ?");
            $stmt2->bind_param("i", $orderId);
            $stmt2->execute();
    
            $result = $stmt2->get_result();
            $row = $result->fetch_assoc();
    
            echo $row["status"];
    
        } else {
            echo "product not udpated :(";
        }

        $stmt->close();
        $stmt2->close();
    }

    

    

} else {

}

?>