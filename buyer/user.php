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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="../assets/css/style.css">
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
                        <a href="" class="ms-5 text-dark text-decoration-none">MY LISTINGS</a>

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
            <div class="col-3 d-flex flex-column align-items-end gap-3 pt-4 pe-5">
                <a href="user.php" class="text-dark text-decoration-none fw-bold">Account Profile</a>
                <a href="" class="text-dark text-decoration-none">Purchases</a>
                <a href="" class="text-dark text-decoration-none">My Cart</a>
                <a href="" class="text-dark text-decoration-none">Notifications</a>
            </div>

            <div class="col-md-9 p-4">
                <div class="border-bottom mb-3">
                    <h3 class="fw-bold">My Profile</h3>
                    <p>Manage your account!</p>
                </div>

                <!-- contents -->
                <form action="../operations/saveProfile.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- user form -->
                        <div class="col-md-8 pe-5">
                            <div>
                                <label for="username">Username:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="uname" value="<?php echo $_SESSION["user"]["username"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="name">First Name:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="fname" value="<?php echo $_SESSION["user"]["firstname"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="username">Last Name:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="lname" value="<?php echo $_SESSION["user"]["lastname"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="username">Contact No.</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="contact" value="<?php echo $_SESSION["user"]["contact_no"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="username">Address:</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="address" value="<?php echo $_SESSION["user"]["address"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="name">Email:</label>
                                <input type="email" class="form-control form-control-sm rounded-0" name="email" value="<?php echo $_SESSION["user"]["email"] ?>">
                            </div>

                            <div>
                                <label class="mt-2" for="username">Password:</label>
                                <input type="password" class="form-control form-control-sm rounded-0" name="password" value="<?php echo $_SESSION["user"]["password"] ?>">
                            </div>

                            <div class="mt-3">
                                <?php
                                $gender = $_SESSION["user"]["gender"];
                                ?>
                                <label>Gender</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="M" <?php echo ($gender == "M")? "checked" : ""?>>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="F" <?php echo ($gender == "F")? "checked" : ""?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="other" value="N" <?php echo ($gender == "N")? "checked" : ""?>>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="dob">Date of Birth</label>
                                <div class="d-flex gap-3">
                                    <div class="col">
                                        <select class="form-control form-control-sm rounded-0" name="day" id="dob-day">
                                        <?php
                                        for($i=1; $i<=31; $i++) {
                                            $daySelected = ($i==$day)? 'selected' : '';
                                            echo"<option value='{$i}' ".$daySelected.">{$i}</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control form-control-sm rounded-0" name="month" id="dob-month">
                                        <?php
                                        for($i=0; $i<count($months); $i++) {
                                            $monthSelected = ($i==$month)? 'selected' : '';
                                            echo "<option value='".($i+1)."' $monthSelected>{$months[$i]}</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control form-control-sm rounded-0" name="year" id="dob-year">
                                        <?php
                                        for($i=2024; $i>=1990; $i--) {

                                            $yearSelected = ($i==$year)? 'selected' : '';
                                            echo "<option value='{$i}' $yearSelected>{$i}</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-0 text-center mt-3" name="submit">Save</button>
                        </div>

                        
                        <div class="col-md-4 text-center image-container">
                            <label for="profile-image">Profile Image</label>
                            <div>
                                <img src="../uploads/profile/default.jpg" alt="Profile Image" class="profile-image mx-auto d-block">
                            </div>

                            <small class="form-text text-muted">File size: maximum 3 MB</small>
                            <small class="form-text text-muted">File extension: .JPEG, .PNG</small>
                            <input type="file" name="image" accept="image/*" class="ml-4 form-control-file mt-3" id="profile-image" value="<?php echo $_SESSION["user"]["profile_pic_path"] ?>"
                        </div>
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