<?php
session_start();
require_once "config/connection.php";

if(!$_SESSION["user"]) {
    header("location: buyer/signin.php");
    exit;
}

if(empty($_SESSION["user"]["username"])) {
    header("location: buyer/user.php");
    exit;
}



// do some redirecting when session is active

$conn = DB::connect();
?>