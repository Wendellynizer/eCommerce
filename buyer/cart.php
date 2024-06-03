<?php
require_once "../sessionCheck.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>

    <?php require_once "../includes/header.php" ?>
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

    <section class="padding-from-nav container-xxl">

        <!-- contents -->
        <div class="row">
            <div class="col-2 d-flex flex-column align-items-end gap-3 pt-4 pe-5">
                <a href="user.php" class="text-dark text-decoration-none">Account Profile</a>
                <a href="purchases.php" class="text-dark text-decoration-none">Purchases</a>
                <a href="cart.php" class="text-dark text-decoration-none fw-bold active">My Cart</a>
                <a href="notifications.php" class="text-dark text-decoration-none">Notifications</a>
            </div>

            <div class="col-md-10 p-4" style="background-color: white; max-width: 1080px">
                <div class="border-bottom mb-3">
                    <h3 class="fw-bold">My Cart <i class="fa-solid fa-cart-shopping"></i></h3>
                </div>

                <!-- contents -->
                <div>
                    <table class="table">
                        <thead>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th class="text-center">Quantity</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </thead>

                        <tbody class="cart-body">    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


</body>

<script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>