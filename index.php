<?php
require_once "sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="position-fixed w-100 bg-light m-0 p-0" style="z-index: 999;">
        <nav class="container-xxl py-2 px-sm-5 top-nav">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <a href="index.html">
                        <img src="assets/images/logo/logo.png" alt="ShopX" width="200">
                    </a>
                </h2>
                
                <div class="d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <a href="" class="text-decoration-none fw-bold active">HOME</a>
                        <a href="" class="ms-5 text-dark text-decoration-none">PRODUCTS</a>
                        <a href="" class="ms-5 text-dark text-decoration-none">MY LISTINGS</a>

                        <div class="notification ms-5 d-flex align-items-center position-relative">
                            <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

                            <span class="text-dark" style="user-select: none;">99</span>
                        </div>
                        
                        <!-- profile -->
                        <div class="dropdown">
                            <button type="button" class="profile ms-5 text-decoration-none btn" style="border: none" data-bs-toggle="dropdown">
                                <img src="<?php echo $_SESSION["user"]["profile_pic_path"] ?>" alt="profile">
                                <span class="fw-bold ms-2 text-dark"><?php echo (empty($_SESSION["user"]["username"]))? $_SESSION["user"]["email"] : $_SESSION["user"]["username"]?></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end rounded-1 py-0 profile-dropdown">
                                <li><a class="dropdown-item py-2" href="buyer/user.php">My Account</a></li>
                                <li><a class="dropdown-item py-2" href="#">Purchases</a></li>
                                <li><a class="dropdown-item py-2" href="operations/logout.php">Logout</a></li>
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

    <section class="padding-from-nav">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="products-title">
                <p class="h1 fw-bold text-center">PRODUCTS</p>
            </div>
            
            <div class="products container">
                <div class="row align-items-center gap-0 g-y-4 px-5">
    
                    <a href="facebook.com" class="col-lg-3 col-md-6 mt-4 text-decoration-none">
                        <div class="card rounded-0 product">
                            <div class="overflow-hidden">
                                <img src="uploads/item/sample.jpg" class="product-img card-img-top" alt="sample" >
                            </div>
                            
    
                            <div class="card-body d-flex flex-column">
                              <h5 class="card-title">Goku Figurine</h5>
    
                              <div class="price-container flex-grow-1 d-flex align-items-end">
                                <div class="d-flex align-items-center justify-content-between w-100">
                                    <p class="card-text h4 text-primary fw-bold">₱150</p>
                                    <p class="card-text" style="font-size: 0.8rem;">Very Good</p>
                                </div>
                                
                              </div>
                            </div>
                        </div>
                    </a>
    
                    <a href="facebook.com" class="col-lg-3 col-md-6 mt-4 text-decoration-none">
                        <div class="card rounded-0 product">
                            <div class="overflow-hidden">
                                <img src="uploads/item/sample3.webp" class="product-img card-img-top" alt="sample" >
                            </div>
                            
    
                            <div class="card-body d-flex flex-column">
                              <h5 class="card-title">Goku Figurine</h5>
    
                              <div class="price-container flex-grow-1 d-flex align-items-end">
                                <p class="card-text h4 text-primary fw-bold">₱150</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    
            <a href="#seemore" class="btn btn-primary text-light rounded-0 mt-5">See More</a>
        </div>

        
    </section>
</body>

<!-- bootstrap js -->
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>