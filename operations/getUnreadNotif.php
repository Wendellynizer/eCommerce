<?php
require_once "../sessionCheck.php";

$stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE is_read = 1 AND user_id = ?");
$stmt->bind_param("i", $_SESSION["user"]["user_id"]);

if(!$stmt->execute()) 
    exit;

$result = $stmt->get_result()->fetch_assoc();

echo $result["unread_count"];
?>