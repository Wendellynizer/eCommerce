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
                            <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

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
                                <li><a class="purchases.php" class="dropdown-item py-2" href="purchases.php">Purchases</a></li>
                                <li><a class="dropdown-item py-2" href="../operations/logout.php">Logout</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- for mobile -->
                <div class="d-md-none d-sm-flex d-xs-flex gap-5">
                    <div class="notification ms-5 d-flex align-items-center position-relative">
                        <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                        <span class="text-dark notif-count" style="user-select: none; ">99</span>
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
                <a href="cart.php" class="text-dark text-decoration-none">My Cart</a>
                <a href="notifications.php" class="text-dark text-decoration-none fw-bold active">Notifications</a>
            </div>

            <div class="col-md-10 p-4" style="background-color: white; max-width: 1080px">
                <div class="border-bottom mb-3">
                    <h3 class="fw-bold">Notification(s) <i class="fa-solid fa-bell"></i></h3>
                </div>

                <!-- contents -->
                <div>

                    <?php
                    $stmt = $conn->prepare("SELECT notif_type, message, is_read, notif_date FROM notifications WHERE user_id = ?  ORDER BY notif_date DESC");
                    $stmt->bind_param("i", $_SESSION["user"]["user_id"]);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();

                        if (!$result->num_rows > 0) {
                            echo "<p class='text-center mt-5'>No notifications available right now.</p>";
                            return;
                        }

                        while ($row = $result->fetch_assoc()) {
                            $icon = "";
                            $link = "";

                            switch ($row["notif_type"]) {
                                case "Order Processing":
                                    $icon = "fa-gears";
                                    break;
                                case "Order Shipped":
                                    $icon = "fa-cart-flatbed";
                                    break;
                                case "Order Delivery":
                                    $icon = "fa-truck";
                                    break;
                                case "Order Complete":
                                    $icon = "fa-check";
                                    $link = " <a href='purchases.php'>See purchases.</a>";
                                    break;
                                case "Customer Order":
                                    $icon = "fa-cart-arrow-down";
                                    $link = " <a href='orders.php'>See orders now.</a>";
                                    break;
                            }

                            $formattedDate = date('F d, Y h:i a', strtotime($row["notif_date"]));
                            echo "
                            <div class='border border-bottom d-flex align-items-center gap-5 pt-3 ps-4 pe-3 mb-2'>
                                <i class='fa-solid " . $icon . " h1'></i>
        
                                <div class='w-100'>
                                    <p class='fw-bold'>{$row["notif_type"]}</p>
                                    <p>{$row["message"]} {$link}</p>
                                    <p style='font-size: 0.7rem' class='text-end'>{$formattedDate}</p>
                                </div>
                            </div>";
                        }
                    }
                    ?>


                    <!-- <div class="border border-bottom d-flex align-items-center gap-5 py-3 px-3 mb-2">
                        <i class="fa-solid fa-gears h1"></i>

                        <div class="w-100">
                            <p class="fw-bold">Order Processing</p>
                            <p>Your order of {Product Name} is processing.</p>
                            <p style="font-size: 0.7rem" class="text-end">05-31-2024 14:30</p>
                        </div>
                    </div>

                    <div class="border border-bottom d-flex align-items-center gap-5 py-3 px-3 mb-2">
                        <i class="fa-solid fa-cart-flatbed h1"></i>

                        <div class="w-100">
                            <p class="fw-bold">Order Shipped</p>
                            <p>Your order of {Product Name} has been placed.</p>
                            <p style="font-size: 0.7rem" class="text-end">05-31-2024 14:30</p>
                        </div>
                    </div>

                    <div class="border border-bottom d-flex align-items-center gap-5 py-3 px-3 mb-2">
                        <i class="fa-solid fa-truck h1"></i>

                        <div class="w-100">
                            <p class="fw-bold">Order Delivery</p>
                            <p>Your order of {Product Name} is out for delivery. Please prepare an amount of {Price}.</p>
                            <p style="font-size: 0.7rem" class="text-end">05-31-2024 14:30</p>
                        </div>
                    </div>

                    <div class="border border-bottom d-flex align-items-center gap-5 py-3 px-3 mb-2">
                        <i class="fa-solid fa-cart-arrow-down h1"></i>

                        <div class="w-100">
                            <p class="fw-bold">Customer Order</p>
                            <p>{Customer Name} has placed an order(s). See orders now</p>
                            <p style="font-size: 0.7rem" class="text-end">05-31-2024 14:30</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>


</body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/user.js"></script>

</html>