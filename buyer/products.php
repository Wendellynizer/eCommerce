<?php
require_once "../sessionCheck.php";

$catResult = $conn->query("SELECT * FROM category ORDER BY category_name");

// initializing
$search = (isset($_GET["search"]))? urldecode($_GET["search"]) : '';

$catSearch = (isset($_GET["category"]))? urlencode($_GET["category"]) : '%';
$min = (isset($_GET["min"]))? $_GET["min"] : 0;
$max = (isset($_GET["max"]))? $_GET["max"] : 99999999;
$condition = (isset($_GET["condition"]))? $_GET["condition"] : '%';

$priceOrder = "";

if(isset($_GET["price_order"])) {
    $priceOrder = ($_GET["price_order"] == 'lh') ? "ORDER BY price ASC" : "ORDER BY price DESC";
}


$result = $conn->query(
    "SELECT * FROM products_view 
    WHERE product_name LIKE CONCAT('%', '{$search}', '%') 
    AND category_id LIKE CONCAT('%', '{$catSearch}', '%') 
    AND price BETWEEN {$min} AND {$max}
    AND product_condition LIKE CONCAT('{$condition}', '%') 
    AND deleted_at IS NULL
    $priceOrder");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Listings</title>

    <?php include_once "../includes/header.php" ?>
</head>

<body>

    <header class="position-fixed w-100 bg-light p-0" style="z-index: 999;">
        <nav class="container-xxl py-2 px-sm-5 top-nav">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <a href="../index.php">
                        <img src="../assets/images/logo/logo.png" alt="ShopX" width="200">
                    </a>
                </h2>
                
                <div class="d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <a href="../index.php" class="text-dark text-decoration-none">HOME</a>
                        <a href="products.php" class="ms-5 text-dark text-decoration-none fw-bold active">PRODUCTS</a>
                        <a href="listings.php" class="ms-5 text-dark text-decoration-none">MY LISTINGS</a>

                        <div class="notification ms-5 d-flex align-items-center position-relative">
                            <a href="notifications.php" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                            <span class="text-dark notif-count" style="user-select: none;"></span>
                        </div>
                        
                        <!-- profile -->
                        <div class="dropdown">
                            <button type="button" class="profile ms-5 text-decoration-none btn" style="border: none" data-bs-toggle="dropdown">
                                <img src="<?php echo "../".$_SESSION["user"]["profile_pic_path"]?>">
                                <span class="fw-bold ms-2 text-dark"><?php echo (empty($_SESSION["user"]["username"]))? $_SESSION["user"]["email"] : $_SESSION["user"]["username"]?></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end rounded-1 py-0 profile-dropdown">
                                <li><a class="dropdown-item py-2" href="user.php">My Account</a></li>
                                <li><a class="dropdown-item py-2" href="purchases.php">Purchases</a></li>
                                <li><a class="dropdown-item py-2" href="../operations/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- for mobile -->
                <div class="d-md-none d-sm-flex d-xs-flex gap-5">
                    <div class="notification ms-5 d-flex align-items-center position-relative">
                        <a href="cart.php" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                        <span class="text-dark notif-count" style="user-select: none;">99</span>
                    </div>

                    <i class="fa-solid fa-bars h2"></i>
                </div>
            </div>
        </nav>

       <?php include_once "../includes/searchBar.php" ?>

    </header>

    <section class="padding-from-nav container-xxl mb-5">

        <!-- contents -->
        <div class="row px-4">

            <div class="col-2 pe-4">
                <div>
                    <label for="category_filter">By Category</label>
                    <select name="category_filter" id="category-filter" class="form-select rounded-0 mt-2">
                        <option value="" <?php echo ($catSearch == '%') ? 'selected' : '' ?>>All</option>
                        <?php
                        while($cat = $catResult->fetch_assoc()) {
                            echo "<option value='". $cat["category_id"] ."' ". (($cat["category_id"] == $catSearch) ? 'selected' : '') .">{$cat["category_name"]}</option>";
                        }
                        
                        ?>
                    </select>
                </div>
                
                <div class="mt-5">
                    <label for="price_filter">Price Range</label>
                    <input type="number" name="min" id="min" placeholder="Min" class="form-control rounded-0 mt-2" value="<?php echo ($min != 0)? $min : '' ?>">
                    <input type="number" name="max" id="max" placeholder="Max" class="form-control rounded-0 mt-2" value="<?php echo ($max != 99999999)? $max : '' ?>">
                    
                    <button class="btn btn-primary mt-4 rounded-0 w-100" id="apply-btn">Apply</button>
                </div>
            </div>

            <div class="col-10">
                <div class="row">
                    <h5 class="mb-5">Search results for '<span class="text-primary"><?php echo (isset($_GET["search"]))? $_GET["search"] : 'all' ?></span>'</h5>

                    <div class="filter-container d-flex align-items-center gap-2">
                        <!-- all filters here -->
                        <span class="me-2">Sort by</span>
                        
                        <select class="form-select rounded-0 w-25" name="price_order" id="price-order">
                            <option <?php echo ($priceOrder == '') ? 'selected' : '' ?>>Price</option>
                            <option value="lh" <?php echo ($priceOrder == 'lh') ? 'selected' : '' ?>>Price: Low to High</option>
                            <option value="hl" <?php echo ($priceOrder == 'hl') ? 'selected' : '' ?>>Price: High to Low</option>
                        </select>

                        <select class="form-select rounded-0 w-25" name="condition" id="condition">
                            <option value="%" <?php echo ($condition == '%') ? 'selected' : '' ?>>Quality: All</option>
                            <option value="Very%Good" <?php echo ($condition == 'Very%Good') ? 'selected' : '' ?>>Quality: Very Good</option>
                            <option value="Good" <?php echo ($condition == 'Good') ? 'selected' : '' ?>>Quality: Good</option>
                            <option value="Fair" <?php echo ($condition == 'Fair') ? 'selected' : '' ?>>Quality: Fair</option>
                            <option value="Bad" <?php echo ($condition == 'Bad') ? 'selected' : '' ?>>Quality: Bad</option>
                        </select>
                    </div>

                    <div class="row product-body">
                    <?php

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
                                    <h5 class='card-title product-name fw-bold' style='height: 43px'>{$row["product_name"]}</h5>
                                    <p>{$row["category_name"]}</p>

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
                    </div>
                    
                
                </div>
            
            </div>
        </div>
    </section>
</body>
</html>