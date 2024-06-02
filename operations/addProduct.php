<?php
session_start();
require_once "../getConnection.php";

/* FIELDS

image
productName
description
category
condition
price
qty

*/


if(isset($_POST["submit"])) {

    $image = $_FILES["image"];
    $productName = trim($_POST["productName"]);
    $description = trim($_POST["description"]);
    $category = $_POST["category"];
    $condition = trim($_POST["condition"]);
    $price = $_POST["price"];
    $qty = $_POST["qty"];

    // echo $image["name"]."\n";
    // echo $productName."\n";
    // echo $description."\n";
    // echo $category."\n";
    // echo $condition."\n";
    // echo $price."\n";
    // echo $qty."\n";
    // exit;

    if(empty($productName) || empty($description) || empty($category) || empty($condition) || empty($price) || empty($qty) || $image["name"] == ""
    ) {

        header("location: ../buyer/productDetails.php?error=incomplete");
        exit;
    }

    // image saving logic
    $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
    $new_file_name = "user".$_SESSION["user"]["user_id"] . uniqid(). ".". $ext; //* new filename
    $image_dir = "uploads/product/";
    $target_file = $image_dir . basename($new_file_name);

    
    $stmt = $conn->prepare("CALL AddProduct(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isidisss", $_SESSION["user"]["user_id"], $productName, $category, $price, $qty, $target_file, $description, $condition);
    $stmt->execute();

    move_uploaded_file($_FILES["image"]["tmp_name"], "../".$target_file);

    $stmt->close();

    header("location: ../buyer/listings.php");    
} else {

    header("location: ../buyer/listings.php"); 
}

?>