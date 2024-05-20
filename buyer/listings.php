<?php
session_start();

$months = [
    "January", "February", "March", "April",
    "May", "June", "July", "August", "September",
    "October", "November", "December"
];


$dateString = $_SESSION["user"]["date_of_birth"]; // Example date string

// separates year, month, and day from dateString
if (preg_match('/(\d{4})-(\d{2})-(\d{2})/', $dateString, $matches)) {
    $year = (int)$matches[1];
    $month = (int)$matches[2];
    $day = (int)$matches[3];
} else {
    echo "Date format is incorrect.";
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
                        <a href="" class="ms-5 text-dark text-decoration-none">PRODUCTS</a>
                        <a href="" class="ms-5 text-dark text-decoration-none fw-bold active">MY LISTINGS</a>

                        <div class="notification ms-5 d-flex align-items-center position-relative">
                            <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                            <span class="text-dark" style="user-select: none;">99</span>
                        </div>
                        
                        <!-- profile -->
                        <div class="dropdown">
                            <button type="button" class="profile ms-5 text-decoration-none btn" style="border: none" data-bs-toggle="dropdown">
                                <img src="<?php echo "../".$_SESSION["user"]["profile_pic_path"]?>">
                                <span class="fw-bold ms-2 text-dark"><?php echo (empty($_SESSION["user"]["username"]))? $_SESSION["user"]["email"] : $_SESSION["user"]["username"]?></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end rounded-1 py-0 profile-dropdown">
                                <li><a class="dropdown-item py-2" href="user.php">My Account</a></li>
                                <li><a class="dropdown-item py-2" href="#">Purchases</a></li>
                                <li><a class="dropdown-item py-2" href="../operations/logout.php">Logout</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>

                <!-- for mobile -->
                <div class="d-md-none d-sm-flex d-xs-flex gap-5">
                    <div class="notification ms-5 d-flex align-items-center position-relative">
                        <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

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

                    <span class="text-light" style="user-select: none;">99</span>
                </a>
            </div>
        </div>
    </header>

    <section class="padding-from-nav container-xxl">

        <!-- contents -->
        <div class="row">
            <div class="col-2 d-flex flex-column align-items-end gap-3 pt-4 pe-5">
                <a href="dashboard.php" class="text-dark text-decoration-none">Dashboard</a>
                <a href="" class="text-dark text-decoration-none fw-bold active">My Listings</a>
                <a href="sales.php" class="text-dark text-decoration-none">Sales Report</a>
            </div>

            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between mb-2">
                    <p class="h4 fw-bold">My Listings</p>

                    <div class="input-group w-25">
                        <input type="text" name="" placeholder="Search here..." class="form-control rounded-0">
                        <button class="btn bg-dark rounded-0 text-light"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>

                <p>999 Products</p>
                
                <div class="row p-2">
                    <!-- <div class="col-12 p-0">
                        <p>No Listings Yet.</p>
                    </div> -->

                    <div class="col-12 p-0">
                        <table class="table table-striped border">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Condition</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <img src="../uploads/product/sample.jpg" width="56" style="object-fit: contain;">
                                    </td>
                                    <td class="align-middle">₱999,999</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">
                                        <select name="" class="form-select rounded-0 w-50">
                                            <option value="">Very Good</option>
                                            <option value="">Good</option>
                                            <option value="">Fair</option>
                                            <option value="">Bad</option>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column gap-3">
                                            <a href="" class="text-center">Edit</a>
                                            <a href="" class="text-center">Delete</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle">
                                        <img src="../uploads/product/sample3.webp" width="56" style="object-fit: contain;">
                                    </td>
                                    <td class="align-middle">₱999,999</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">
                                        <select name="" class="form-select rounded-0 w-50">
                                            <option value="">Very Good</option>
                                            <option value="">Good</option>
                                            <option value="">Fair</option>
                                            <option value="">Bad</option>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column gap-3">
                                            <a href="" >Edit</a>
                                            <a href="">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
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