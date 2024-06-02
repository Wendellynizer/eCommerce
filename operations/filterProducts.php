<?php
require_once "../sessionCheck.php";


$search = (isset($_GET["search"]))? $_GET["search"] : "";
$catSearch = $_GET["category"];



$result = $conn->query('CALL RetrieveProducts("'.$search.'", "'.$catSearch.'")');


if(!$result->num_rows > 0) {
    echo "<p class='mt-4 text-center'>No results found</p>";
    return;
}

while($row = $result->fetch_assoc()) {

    $badgeColor = "";

    switch($row["product_condition"]) {
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
    <a href='product.php?id={$row["product_id"]}' class='col-lg-3 col-md-6 mt-4 text-decoration-none'>
        <div class='card product overflow-hidden'>
            <div class='overflow-hidden'>
                <input type='hidden' id='productId' value='".$row["product_id"]."'/>
                <img src='../".$row["image_path"]."' class='product-img card-img-top' alt='image' loading='lazy'>
            </div>
        

            <div class='card-body d-flex flex-column'>
                <h5 class='card-title product-name fw-bold'>{$row["product_name"]}</h5>

                <div class='price-container flex-grow-1 d-flex align-items-end'>
                    <div class='d-flex align-items-center justify-content-between w-100'>
                        <p class='card-text h5 text-primary fw-bold'>₱{$row["price"]}</p>
                        <p class='card-text badge-custom ".$badgeColor."' style='font-size: 0.8rem;'>{$row["product_condition"]}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    ";
}
?>