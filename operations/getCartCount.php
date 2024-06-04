<?php

require_once "../sessionCheck.php";

$stmt = $conn->prepare("SELECT COUNT(*) AS cart_count FROM cart_details WHERE user_id = ? AND deleted_at IS NULL");
$stmt->bind_param("i", $_SESSION["user"]["user_id"]);

if(!$stmt->execute()) 
    exit;

$result = $stmt->get_result()->fetch_assoc();

echo $result["cart_count"];
?>