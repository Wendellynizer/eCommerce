<?php
require_once "../sessionCheck.php";

if($_POST["email"] && $_POST["password"]) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    
    if($stmt->execute()) {
        $result = $stmt->get_result();

        if($result->num_rows <= 0) {
            header("location: ../buyer/signin.php");
            return;
        }

        $_SESSION["user"] = $result->fetch_assoc();
    }


    header("location: ../index.php");
} else {
    header("location: ../buyer/signup.php");
}
?>