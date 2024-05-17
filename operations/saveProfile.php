<?php

/* FIELDS

uname
fname
lname
email
contact
address
day
month
year
gender
image

*/


if(isset($_POST["submit"])) {

    //!debug only
    $errorMsg = "";

    echo $_POST["uname"];
    echo $_POST["fname"];
    echo $_POST["lname"];
    echo $_POST["contact"];
    echo $_POST["address"];
    echo $_POST["day"];
    echo $_POST["month"];
    echo $_POST["year"];
    echo $_POST["gender"];

    if(empty($_POST["uname"]) && empty($_POST["fname"]) && isset($_POST["lname"]) &&
        empty($_POST["contact"]) && empty($_POST["address"]) &&
        empty($_POST["day"]) && empty($_POST["month"]) && empty($_POST["year"]) && 
        empty($_POST["gender"])
    ) {

        $errorMsg = "IncompleteUserData";
        echo $errorMsg;
    }

    //* saving profile picture data (if any)

    //* checks if there is a photo uploaded
    if(empty($_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE)) {
        $errorMsg = "NoImage";
        echo $errorMsg;
    }

    $image_dir = "../uploads/images/";
    $target_file = $image_dir . basename($_FILES["image"]["name"]);
    $uploadOK = 1;

    echo $target_file;

    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    //* checks if image is fake or not
    // $check = getimagesize($_FILES["image"]["tmp_name"]);

    // echo $check["mime"];

    // if(!$check) {
    //     echo "File is not an image ";
    //     exit;
    // }

    // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


    //* update data for user

    //* change to previous page link
    // header("location: ../index.php?errpr=".$errorMsg);
} else {

}

?>