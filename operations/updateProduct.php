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

    $id = $_POST["id"];
    $current_image_path = $_POST["image_path"];
    $image = $_FILES["image"];
    $productName = trim($_POST["productName"]);
    $description = trim($_POST["description"]);
    $category = $_POST["category"];
    $condition = trim($_POST["condition"]);
    $price = $_POST["price"];
    $qty = $_POST["qty"];


    $target_file = $current_image_path;
    // echo $$current_image_path."\n";
    // echo $productName."\n";
    // echo $description."\n";
    // echo $category."\n";
    // echo $condition."\n";
    // echo $price."\n";
    // echo $qty."\n";
    // exit;
    

    if(!$image["name"] == '') {
        //checks if filename already exists, else return error message
        if(file_exists("../" . $target_file)) {  
            unlink("../" . $target_file); // deletes previous profile from storage
        }

        $image_to_upload = $image["tmp_name"];

        $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
        $new_file_name = "user".$_SESSION["user"]["user_id"] .uniqid().".". $ext; //* new filename
         // image saving logic
        $image_dir = "uploads/product/"; 
        $target_file = $image_dir . basename($new_file_name);
        move_uploaded_file($image_to_upload, "../".$target_file);
    }
    
    
    
    
    $stmt = $conn->prepare("CALL UpdateProduct(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issidiss", $id, $productName, $description, $category, $price, $qty, $target_file, $condition);
    $stmt->execute();

    
    $stmt->close();

    header("location: ../buyer/listings.php");    
} else {

    header("location: ../buyer/listngs.php"); 
}

?>