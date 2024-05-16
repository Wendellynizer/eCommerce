<?php
session_start();
require_once "config/connection.php";

// if(!$_SESSION["user"]) {
//     header("location: buyer/signin.php");
//     exit;
// }


// do some redirecting when session is active

$conn = DB::connect();
?>