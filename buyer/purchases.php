<?php
require_once "../sessionCheck.php";

// make all unread
$conn->query("UPDATE notifications SET is_read = 0 WHERE user_id={$_SESSION["user"]["user_id"]}");
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

                            <span class="text-dark" style="user-select: none;"><?php include_once "../includes/unreadNotif.php" ?></span>
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

                        <span class="text-dark" style="user-select: none;">99</span>
                    </div>

                    <i class="fa-solid fa-bars h2"></i>
                </div>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-3 search-nav">
            <div class="container-xxl d-flex justify-content-center align-items-center gap-5">
                <form action="" class="w-100" style="max-width: 1000px">
                    <div class="input-group ">
                        <input type="text" name="" placeholder="Search here..." class="form-control rounded-0">

                        <button class="btn bg-dark rounded-0 text-light"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <a href="" class="cart-container text-decoration-none d-flex align-items-center gap-2">
                    <span class="text-light"><i class="fa-solid fa-cart-shopping h4"></i></span>

                    <span class="text-light cart-count" style="user-select: none;">0</span>
                </a>
            </div>
        </div>
    </header>

    <section class="padding-from-nav container-xxl">

        <!-- contents -->
        <div class="row">
            <div class="col-2 d-flex flex-column align-items-end gap-3 pt-4 pe-5">
                <a href="user.php" class="text-dark text-decoration-none">Account Profile</a>
                <a href="purchases.php" class="text-dark text-decoration-none fw-bold active">Purchases</a>
                <a href="cart.php" class="text-dark text-decoration-none">My Cart</a>
                <a href="notifications.php" class="text-dark text-decoration-none">Notifications</a>
            </div>

            <div class="col-md-10 p-4" style="background-color: white; max-width: 1080px">
                <div class="border-bottom mb-3 d-flex justify-content-between">
                    <h3 class="fw-bold">My Purchase(s) <i class="fa-solid fa-bag-shopping"></i></h3>

                    <div class="w-25 d-flex align-items-center gap-3">
                        <select class="form-select rounded-0" id="status-filter">
                            <option value="">All</option>
                            <option value="">Pending</option>
                            <option value="">Shipping</option>
                            <option value="">Delivering</option>
                            <option value="">Complete</option>
                            <option value="">Cancelled</option>
                        </select>
                    </div>
                </div>

                <!-- contents -->
                <div class='purchase-body'>
                    
                </div>
            </div>
        </div>
    </section>


</body>

<script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>