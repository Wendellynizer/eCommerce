<?php
require_once "../sessionCheck.php";

$stmt = $conn->prepare("SELECT * FROM purchases_view WHERE order_by = ? AND deleted_at IS NULL ORDER BY order_date_time DESC");
$stmt->bind_param("i", $_SESSION["user"]["user_id"]);

if(!$stmt->execute()) 
    exit;

$result = $stmt->get_result();

if(!$result->num_rows > 0) {
    echo "<p class='text-center p-5'>No purchases yet. <a href='products.php'>buy now!</a></p>";
    return;
}

while($row = $result->fetch_assoc()) {

    $badgeColor = "rounded-5 ";

    switch ($row['status']) {
        case "Pending":
            $badgeColor .= "bg-pending";
            break;
        case "Shipping":
            $badgeColor .= "bg-shipping";
            break;
        case "Delivering":
            $badgeColor .= "bg-delivering";
            break;
        case "Complete":
            $badgeColor .= "bg-complete";
            break;
        case "Cancelled":
            $badgeColor .= "bg-cancelled";
            break;
    }

    $deliveredMsg = ($row["status"] == "Complete") ? "Parcel has been delivered" : "";

    echo "
    <div class='border gap-5 p-3 mb-2'>
        <div class='d-flex justify-content-between w-100'>
            <p class='text-primary'>{$deliveredMsg}</p>

            <div>
                <span class='badge {$badgeColor}'>{$row["status"]}</span>
            </div>
        </div>

        <div class='d-flex gap-3 border-bottom mb-2'>
            <img src='../{$row["image_path"]}' width='100' height='100' style='object-fit: cover;'>

            <div class='w-100'>
                <p class='fw-bold'>{$row["product_name"]}</p>
                <p>x{$row["qty_ordered"]}</p>
                <p class='fw-bold text-end text-primary'>Order Total: ₱ {$row["total_amount"]}</p>
            </div>
        </div>

        <div class='d-flex justify-content-between align-items-center'>
            <p>".date( "F m, Y h:i a", strtotime($row["order_date_time"]))."</p>
            <a href='product.php?id={$row["product_id"]}' class='btn bg-primary text-white rounded-0'>Buy Again</a>
        </div>
    </div>
    ";
}
?>