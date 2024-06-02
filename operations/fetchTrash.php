
<?php

require_once "../sessionCheck.php";
                            
$stmt = $conn->prepare("CALL GetAllTrash(100, ?)");
$stmt->bind_param("i", $_SESSION["user"]["user_id"]);

if (!$stmt->execute()) {
    exit;
}

$result = $stmt->get_result();

while ($prod = $result->fetch_assoc()) {

    $badgeColor = "";

    switch ($prod["product_condition"]) {
        case "Very Good":
            $badgeColor = "badge-green";
            break;
        case "Good":
            $badgeColor = "badge-semigreen";
            break;
        case "Fair":
            $badgeColor = "badge-yellow";
            break;
        case "Bad":
            $badgeColor = "badge-red";
            break;
    }

    echo "
    <tr>
        
        <td class='align-middle'>
            <img src='../{$prod["image_path"]}' width='80' height='80' style='object-fit: contain;'>
        </td>
        <td class='align-middle'>{$prod['product_name']}</td>
        <td class='align-middle'>₱ {$prod['price']}</td>
        <td class='align-middle'>{$prod['quantity']}</td>
        <td class='align-middle'>
            <span class='badge " . $badgeColor . " p-2 w-50 text-center'>{$prod["product_condition"]}</span>
        </td>
        <td class='align-middle'>
            <div class='d-flex justify-content-center gap-2'>
                <button type='button' class='btn btn-success text-center w-25 rounded-1' onclick='restoreTrash({$prod["product_id"]}, `{$prod["product_name"]}`)'>
                    <i class='fa-solid fa-trash-arrow-up'></i></i>
                </button>
            </div>
        </td>
    </tr>
    ";
}
                          
?>