<?php
session_start();

if($_SESSION['user']){
    unset($_SESSION['user']);
}


// echo $_SESSION['user'];
header("location: ../buyer/signin.php");
?>