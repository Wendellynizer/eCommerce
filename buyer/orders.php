<?php
require_once "../sessionCheck.php";


//! test
// $result = $conn->query("SELECT * FROM order_details WHERE seller_id=" . $_SESSION["user"]["user_id"] . " LIMIT 100");

if(isset($_GET["page_no"]) && $_GET["page_no"] !== "") {
    $page_no = $_GET["page_no"];
} else {
    $page_no = 1;
}

$record_limit = 10;
$offset = ($page_no - 1) * $record_limit;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

// get record count 
$record_count = $conn->query("SELECT COUNT(*) as total_records FROM order_details WHERE seller_id = {$_SESSION['user']['user_id']}");
$record = $record_count->fetch_assoc();

$total_pages = ceil($record["total_records"] / $record_limit);

// query
$stmt = $conn->prepare("SELECT order_id, product_name, firstname, lastname, quantity, order_date_time, status, total_amount FROM order_details WHERE seller_id = ? LIMIT ?, ?");
$stmt->bind_param("iii", $_SESSION['user']['user_id'], $offset, $record_limit);
$stmt->execute();

$sql = $stmt->get_result();

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
                                <li><a href="user.php" class="dropdown-item py-2" href="user.php">My Account</a></li>
                                <li><a href="purchases.php" class="dropdown-item py-2" href="purchases.php">Purchases</a></li>
                                <li><a href="../operations/logout.php" class="dropdown-item py-2" href="../operations/logout.php">Logout</a></li>
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
                <a href="dashboard.php" class="text-dark text-decoration-none">Dashboard <i class="fa-solid fa-gauge ms-3"></i></a>
                <a href="listings.php" class="text-dark text-decoration-none">My Listings <i class="fa-solid fa-box ms-3"></i></a>
                <a href="orders.php" class="text-dark text-decoration-none fw-bold active">Orders <i class="fa-solid fa-box ms-3"></i> </a>
                <a href="trash.php" class="text-dark text-decoration-none">Trash <i class="fa-solid fa-trash ms-3"></i></a>
            </div>

            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between mb-2">
                    <p class="h4 fw-bold">Orders</p>

                    <div class="d-flex justify-content-between align-items-center w-25">
                        <label for="status-filter">Status Filter:</label>
                        <select class="form-select w-50" name="status_filter" id="status-filter">
                            <option value="">All</option>
                            <option value="">Pending</option>
                            <option value="">Shipping</option>
                            <option value="">Delivering</option>
                            <option value="">Complete</option>
                            <option value="">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="d-flex justify-content-end gap-4 mb-1">
                        <p>Page <strong><?php echo $page_no ?> of <?php echo ($total_pages != 0)? $total_pages :0 ?></strong></p>

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-primary rounded-0 <?php echo ($page_no <= 1) ? 'disabled' : ''?> " 
                            
                            <?php echo ($page_no > 1) ? 'href=?page_no='.$previous_page : ''?> 
                            >
                            <i class="fa-solid fa-chevron-left"></i></a>

                            <a class="btn btn-primary rounded-0 <?php echo ($page_no >= $total_pages) ? 'disabled' : ''?> "
                            <?php echo ($page_no < $total_pages) ? 'href=?page_no='.$next_page : ''?> 
                            ><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <!-- ALL ORDERS -->
                    <table class="table table-striped border">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Product(s)</th>
                                <th>Quantity</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="order-body">
                            <?php
                            if ($sql->num_rows <= 0) {
                                echo "<tr><td class='align-middle text-center p-5' colspan='9'>No orders found</td></tr>";
                                exit;
                            }

                            while ($prod = $sql->fetch_assoc()) {
                                $badgeColor = "rounded-5 ";
                                $buttonText = "Ship Order";

                                switch ($prod['status']) {
                                    case "Pending":
                                        $badgeColor .= "bg-pending";
                                        break;
                                    case "Shipping":
                                        $badgeColor .= "bg-shipping";
                                        $buttonText = "Deliver";
                                        break;
                                    case "Delivering":
                                        $badgeColor .= "bg-delivering";
                                        $buttonText = "Complete";
                                        break;
                                    case "Complete":
                                        $badgeColor .= "bg-complete";
                                        $buttonText = "Complete";
                                        break;
                                    case "Cancelled":
                                        $badgeColor .= "bg-cancelled";
                                        $buttonText = "Return";
                                        break;
                                }


                                echo "
                                <tr>
                                    <td class='align-middle text-center fw-bold'>{$prod['order_id']}</td>
                                    <td class='align-middle'>{$prod['firstname']}</td>
                                    <td class='align-middle'>{$prod['lastname']}</td>
                                    <td class='align-middle'>{$prod['product_name']}</td>
                                    <td class='align-middle text-center'>{$prod['quantity']}</td>
                                    <td class='align-middle'>{$prod['order_date_time']}</td>
                                    <td class='align-middle'><span class='badge " . $badgeColor . "'>{$prod['status']}</span></td>
                                    <td class='align-middle'>₱ {$prod['total_amount']}</td>
                                    <td class='align-middle gap-2'>
                                        <button class='btn btn-sm btn-warning rounded-0 w-100' onclick='changeStatus({$prod['order_id']}, this)' " . (($prod["status"] == 'Complete') ? 'disabled' : '') . ">" . $buttonText . "</button>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
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