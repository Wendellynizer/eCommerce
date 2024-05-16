<?php
session_start();
require_once "../config/connection.php";
$conn = DB::connect();

if($_POST["email"] && $_POST["password"]) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?,?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    header("location: ../buyer/signin.php");
} else {
    header("location: ../buyer/signup.php");
}
?>