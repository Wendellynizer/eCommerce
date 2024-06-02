<?php
session_start();
require_once "../getConnection.php";

$category = $conn->query("SELECT * FROM category;");
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
                        <a href="listings.php" class="ms-5 text-dark text-decoration-none fw-bold active">MY LISTINGS</a>

                        <div class="notification ms-5 d-flex align-items-center position-relative">
                            <a href="" class="text-dark"><i class="fa-solid fa-bell h3"></i></a>

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
                                <li><a class="dropdown-item py-2" href="products.php">Purchases</a></li>
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
                <p class="h5 text-align-right">Filling Suggestions</p>
            </div>

            <div class="col-md-10 p-4">
                <p class="h4 fw-bold">Product Information</p>
                <hr>
                
                <form action="../operations/addProduct.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="">Product Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productName" id="" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" placeholder="Product description..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select class="form-select w-25" name="category">
                            <?php
                                while($cat = $category->fetch_assoc()) {
                                    echo "<option value='".$cat["category_id"]."'>{$cat["category_name"]}</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Condition</label>
                        <select class="form-select w-25" name="condition">
                                <option value="Very Good">Very Good</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Bad">Bad</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Quantity</label>
                        <input type="number" name="qty" id="" class="form-control">
                    </div>

                    <div class="position-sticky bottom-0 py-2 d-flex justify-content-end align-items-center gap-2" style="background-color: white;">
                        <a href="listings.php" class="btn btn-outline-success rounded-0">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-0" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    
</body>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/user.js"></script>
</html>