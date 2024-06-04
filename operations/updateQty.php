<?php

require_once "../sessionCheck.php";


if(isset($_POST["pID"])) {
    $pID = $_POST["pID"];
    $qty = $_POST["qty"];



    $conn->query("UPDATE carts SET qty = $qty WHERE product_id = $pID");

    // echo "hey";
}

?>