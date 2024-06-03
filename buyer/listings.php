<?php
session_start();
require_once "../getConnection.php";

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
$record_count = $conn->query("SELECT COUNT(*) as total_records FROM products WHERE product_of = {$_SESSION['user']['user_id']} AND deleted_at IS NULL");
$record = $record_count->fetch_assoc();

$total_pages = ceil($record["total_records"] / $record_limit);

// query
$stmt = $conn->prepare("SELECT product_id, product_name, product_condition, price, quantity, image_path FROM products WHERE deleted_at IS NULL AND product_of = ? LIMIT ?, ?");
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
                <a href="dashboard.php" class="text-dark text-decoration-none">Dashboard <i class="fa-solid fa-gauge ms-3"></i></a>
                <a href="listings.php" class="text-dark text-decoration-none fw-bold active">My Listings <i class="fa-solid fa-box ms-3"></i></a>
                <a href="orders.php" class="text-dark text-decoration-none">Orders <i class="fa-solid fa-box ms-3"></i> </a>
                <a href="trash.php" class="text-dark text-decoration-none">Trash <i class="fa-solid fa-trash ms-3"></i></a>
            </div>

            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between mb-2">
                    <p class="h4 fw-bold">My Listings</p>

                    <a href="productCreate.php" class="btn btn-primary">Add Product</a>
                </div>

                <div class="row p-2">
                    <div class="col-12 p-0">
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
                        

                        <table class="table table-striped border" id="list-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Condition</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody class="listing-body">
                                <?php
                                if($sql->num_rows <= 0) {
                                    echo "<td colspan='6'>
                                        <div class='text-center p-5'>
                                        No results found.
                                        </div>
                                    </td>";
                                    exit;
                                }

                                while($row = $sql->fetch_assoc()) {

                                $badgeColor = "";

                                switch ($row["product_condition"]) {
                                    case "Very Good":
                                        $badgeColor = "badge-green";
                                        break;
                                    case "Good":
                                        $badgeColor = "badge-semigreen";
                                        break;
                                    case "Fair":
                                        $badgeColor = "badge-yellow";
                                        break;
                                    case "Bad":
                                        $badgeColor = "badge-red";
                                        break;
                                }
                            

                                echo "
                                    <tr>
                                        <td><img src='../". $row['image_path']."' width='100' height='100' style='object-fit: contain;'></td>
                                        <td class='align-middle' style='max-width: 200px;'>{$row["product_name"]}</td>
                                        <td class='align-middle'>{$row["price"]}</td>
                                        <td class='align-middle'>{$row["quantity"]}</td>
                                        <td class='align-middle'>{$row["product_condition"]}</td>
                                        <td class='align-middle'>
                                            <div class='d-flex justify-content-center gap-2'>
                                                <a href='productEdit.php?item={$row["product_id"]}' class='btn btn-warning text-center w-25 rounded-1'><i class='fa-solid fa-pen-to-square'></i></a>
                                                
                                                <button type='button' class='btn btn-primary text-center w-25 rounded-1' onclick='trashItem({$row["product_id"]}, `{$row["product_name"]}`)'>
                                                    <i class='fa-solid fa-trash'></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>
</html>