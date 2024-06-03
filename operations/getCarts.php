<?php

require_once "../sessionCheck.php";

$stmt = $conn->prepare("SELECT * FROM cart_details WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION["user"]["user_id"]);

if(!$stmt->execute()) 
    exit;

$result = $stmt->get_result();

if(!$result->num_rows > 0) {
    echo "<tr><td class='p-5 text-center' colspan='5'>Empty cart. Add more! <i class='fa-solid fa-cart-plus'></i></td></tr>";
    return;
}

while($row = $result->fetch_assoc()) {
    echo "
    <tr>
        <td class='align-middle'>
            <div class='d-flex align-items-center gap-3'>
                <img src='../{$row["image_path"]}' width='80' height='80' style='object-fit: cover;'>
                <p class='product-name'>{$row["product_name"]}</p>
            </div>
        </td>
        <td class='align-middle'>₱ <span class='price'>{$row["price"]}</span></td>
        <td class='align-middle'>
            <div class='btn-group d-flex justify-content-center' role='group'>
                <button type='button' class='btn btn-outline-secondary rounded-0 subtract' style='max-width: 40px;' onclick='subtract(this)'>-</button>
                <input type='text' name=' id=' class='form-control rounded-0 w-25 text-center qty-field' value='".$row["qty"]."'>
                <button type='button' class='btn btn-outline-secondary rounded-0 add' style='max-width: 40px;' onclick='add(this)'>+</button>
            </div>
            
        </td>
        <td class='align-middle total-amount'>₱ <span class='total'>999999</span></td>
        <td class='align-middle'>
            <div>
                <a href='checkout.php?id={$row["product_id"]}&qty={$row["qty"]}' class='btn btn-sm btn-primary rounded-0')>Checkout</a>
                <button class='btn btn-sm btn-outline-primary rounded-0' onclick='deleteCart(".$row["cart_id"].")'>Delete</button>
            </div>
        </td>
    </tr>
    ";
}
?>           