<?php
session_start();
require_once "../getConnection.php";



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

    $uname = trim($_POST["uname"]);
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $contact = trim($_POST["contact"]);
    $address = trim($_POST["address"]);
    $day = trim($_POST["day"]);
    $month = trim($_POST["month"]);
    $year = trim($_POST["year"]);
    $gender = trim($_POST["gender"]);
    $password = ($_POST["password"]);
    $email = trim($_POST["email"]);

    $dateOfBirth = $year."-".$month."-".$day;

    $image_to_upload = "uploads/profile/default.jpg";

    if(empty($uname) || empty($fname) || empty($lname) || empty($email) || empty($contact) || empty($address) ||
        empty($day) || empty($month) || empty($year) || empty($gender) || empty($password)
    ) {

        header("location: ../buyer/user.php?error=empty");
        exit;
    }
    
   

    //* saving profile picture data (if any)
    //* checks if there is a photo uploaded
    if(!$_FILES["image"]["name"] == "") {

        if(!($_SESSION["user"]["profile_pic_path"] == "uploads/profile/default.png"))
            unlink("../".$_SESSION["user"]["profile_pic_path"]); // deletes previous profile from storage

        $image = $_FILES["image"];
        $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
        // $size = $image["size"];

        $new_file_name = "user".$_SESSION["user"]["user_id"] . "." . $ext; //* new filename

        $image_dir = "uploads/profile/";
        $target_file = "../". $image_dir . basename($new_file_name);

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        $image_to_upload = $image_dir . $new_file_name;
    } 

    $stmt = $conn->prepare("CALL UpdateUser(?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssssssss", $_SESSION["user"]["user_id"], $email, $uname, $password, 
    $fname, $lname, $address, $contact, $gender, $dateOfBirth, $image_to_upload);
    $stmt->execute();

    $stmt = $conn->prepare("CALL GetUserLogin(?,?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $_SESSION["user"] = $result->fetch_assoc();

    // echo $_SESSION["user"]["email"];

    $stmt->close();

    header("location: ../buyer/user.php");
    
} else {

}

?>