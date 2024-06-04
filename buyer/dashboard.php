<?php
session_start();
require_once "../getConnection.php";

$stmt = $conn->query("SELECT COUNT(*) as total_products FROM products WHERE product_of = {$_SESSION['user']['user_id']} GROUP BY product_of");
$results = $stmt->fetch_assoc();
$total_products = (empty($results["total_products"])? 0 : $results["total_products"]); 

$stmt = $conn->query("SELECT SUM(total_amount) as total_sales FROM order_details WHERE seller_id = {$_SESSION['user']['user_id']} AND status='Complete'");
$results = $stmt->fetch_assoc();
$total_sales = $results["total_sales"];
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
                        <a href="products.php" class="ms-5 text-dark text-decoration-none">PRODUCTS</a>
                        <a href="" class="ms-5 text-dark text-decoration-none fw-bold active">MY LISTINGS</a>

                        <div class="notification ms-5 d-flex align-items-center position-relative">
                            <a href="notifications.php" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                            <span class="text-dark notif-count" style="user-select: none;">99</span>
                        </div>

                        <!-- profile -->
                        <div class="dropdown">
                            <button type="button" class="profile ms-5 text-decoration-none btn" style="border: none" data-bs-toggle="dropdown">
                                <img src="<?php echo "../" . $_SESSION["user"]["profile_pic_path"] ?>">
                                <span class="fw-bold ms-2 text-dark"><?php echo (empty($_SESSION["user"]["username"])) ? $_SESSION["user"]["email"] : $_SESSION["user"]["username"] ?></span>
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
                        <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                        <span class="text-dark notif-count" style="user-select: none;">99</span>
                    </div>

                    <i class="fa-solid fa-bars h2"></i>
                </div>
            </div>
        </nav>
    </header>

    <section class="padding-from-nav-sm container-xxl">

        <!-- contents -->
        <div class="row">
            <div class="col-2 d-flex flex-column align-items-end gap-3 pt-4 pe-5">
                <a href="dashboard.php" class="text-dark text-decoration-none fw-bold active">Dashboard <i class="fa-solid fa-gauge ms-3"></i></a>
                <a href="listings.php" class="text-dark text-decoration-none ">My Listings <i class="fa-solid fa-box ms-3"></i></a>
                <a href="orders.php" class="text-dark text-decoration-none">Orders <i class="fa-solid fa-box ms-3"></i> </a>
                <a href="trash.php" class="text-dark text-decoration-none">Trash <i class="fa-solid fa-trash ms-3"></i></a>
            </div>

            <!-- CONTENT HERE -->
     
        <div class="col-md-10 ">
        <div class="container ">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text display-4"><?php echo $total_products ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text display-4">₱ <?php echo (empty($total_sales))? 0 : $total_sales ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
           

        </div>
        
        </div>
    </section>


</body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<!-- <script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/user.js"></script> -->

</html>