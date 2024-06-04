<?php
session_start();
require_once "../getConnection.php";

if(isset($_POST["login"])) {

    if(empty($_POST["email"]) || empty($_POST["password"])) {
        header("location: ../buyer/signin.php");
        exit;
    }

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $stmt = $conn->prepare("CALL GetUserLogin(?,?)");
    $stmt->bind_param("ss", $email, $password);
    
    if($stmt->execute()) {
        $result = $stmt->get_result();

        if($result->num_rows <= 0) {
            header("location: ../buyer/signin.php?error=noaccountfound");
            return;
        }

        $_SESSION["user"] = $result->fetch_assoc();
        $stmt->close();
    }


    if(empty($_SESSION["user"]["username"])){
        header("location: ../buyer/user.php");
        exit;
    }
    
    header("location: ../index.php");
} else {
    header("location: ../buyer/signin.php");
}
?>