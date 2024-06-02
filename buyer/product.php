<?php
require_once "../sessionCheck.php";

if(isset($_GET["id"])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
} else {
    header("location: products.php");
}


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

                            <span class="text-dark notif-count" style="user-select: none;">99</span>
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
                        <a href="notifications.php" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                        <span class="text-dark notif-count" style="user-select: none;">99</span>
                    </div>

                    <i class="fa-solid fa-bars h2"></i>
                </div>
            </div>
        </nav>

        <?php include_once "../includes/searchBar.php" ?>
    </header>

    <section class="padding-from-nav container-xxl pb-5">

        <!-- contents -->
        <div class="px-5">
            <div class="row p-4 bg-light shadow-sm gap-5">
                <div class="col-4">
                    <div>
                        <img src='../<?php echo $result["image_path"] ?>' width="400" height="500"  alt='image' style="object-fit: cover; max-height: 500px">
                    </div>
                    
                </div>

                <div class="col-7 d-flex flex-column">
                    <h3 class="fw-bold"><?php echo $result["product_name"] ?></h3>

                    <div class="mt-3">
                        <form action="checkout.php" method="GET" id="productForm">
                            <input type="hidden" name="id" value="<?php echo $result["product_id"] ?>">
                            <p class="h4 text-primary">₱<?php echo $result["price"] ?></p>

                            <div class="mt-3">
                                <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-outline-secondary rounded-0 subtract' style='max-width: 40px;' onclick="subtractCountToProduct()">-</button>
                                    <input type='text' name='qty' class='form-control rounded-0 w-25 text-center qty-field' value="1">
                                    <button type='button' class='btn btn-outline-secondary rounded-0 add' style='max-width: 40px;' onclick="addCountToProduct()">+</button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-secondary rounded-0 me-2" onclick="addToCart()">Add to Cart</button>
                                <button type="submit" class="btn btn-primary rounded-0">Buy Now</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    
</body>
    <!-- <script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="../assets/js/main.js"></script> -->
</html>