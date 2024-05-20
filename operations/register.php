<?php
session_start();
require_once "../config/connection.php";
$conn = DB::connect();


/** FIELDS
 * email
 * password
 
*/

if(isset($_POST["register"])) {

    if(empty($_POST["email"]) || empty($_POST["password"])) {
        header("location: ../buyer/signup.php?error=incorrectinput");
        exit;
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("CALL CreateUser(?,?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $stmt->close();

    // header("location: ../buyer/signin.php");
}

header("location: ../buyer/signup.php?error=incorrectinput");
?>