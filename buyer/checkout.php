<?php
require_once "../sessionCheck.php";

if(isset($_GET["id"])) {
    //do some query here
    $productId = $_GET["id"];
    $qty = $_GET["qty"];

} else {
    header("location: cart.php");
}


$fname = $_SESSION["user"]["firstname"];
$lname = $_SESSION["user"]["lastname"];
$address = $_SESSION["user"]["address"];
$contact = $_SESSION["user"]["contact_no"];

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
    </header>

    <section class="padding-from-nav-sm container-xxl">

        <!-- contents -->
        <div class="px-5">
            <p class="h1 fw-bold">Checkout <i class="fa-solid fa-credit-card"></i></p>
            
            <div class="row  gap-3">
                <div class="border-top-5 bg-white shadow-sm p-4">
                    <p class="fw-bold"><i class="fa-solid fa-location-dot"></i> Delivery Address</p>
                    <p><span class="fw-bold me-3"><?php echo $fname." ".$lname." ".$contact?></span> <?php echo $address ?></p>
                </div>

                <div class="bg-white shadow-sm p-4">
                    <p class="fw-bold">Product Ordered</p>


                    <?php
                    
                    $stmt = $conn->prepare("CALL GetProduct(?)");
                    $stmt->bind_param("i", $productId);
                    $stmt->execute();

                    $row = $stmt->get_result()->fetch_assoc();

                    ?>

                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <img src='../<?php echo $row["image_path"]?>' width='100' height='100' style='object-fit: cover;'>
                        </div>
                        
                        <div>
                            <p><?php echo $row["product_name"]?></p>
                            <p>x<?php echo $qty ?></p>
                        </div>

                        <div class="align-self-end text-end flex-grow-1 w-100">
                            <p class="h3 fw-bold text-primary">Total: ₱ <?php echo $qty * $row["price"] ?></p>
                        </div>
                    </div>

                    <div class="text-end">
                        <form action="../operations/processOrder.php" method="post">
                            <input type="hidden" name="productId" value="<?php echo $productId ?>" />
                            <input type="hidden" name="qty" value="<?php echo $qty ?>" />
                            <button type="submit" class="btn btn-primary rounded-0" name="submit">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    
</body>
</html>