<?php 
	require_once "../sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopX</title>
</head>

<body>
    <form action="../operations/saveProfile.php" method="post" enctype="multipart/form-data">

        <div>
            <label for="">UserName</label>
            <input type="text" name="uname" id="">
        </div>
        
        <div>
            <label for="">First Name</label>
            <input type="text" name="fname" id="">
        </div>
        
        <div>
            <label for="">Last Name</label>
            <input type="text" name="lname" id="">
        </div>

        <div>
            <label for="">Contact No.</label>
            <input type="text" name="contact" id="">
        </div>

        <div>
            <label for="">Address</label>
            <input type="text" name="address" id="">
        </div>

        <div>
            <label for="">Date fo brith</label>
            <input type="number" name="year" min="1990" max="2024" value="1990">

            <select name="month" id="">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
            </select>

            <input type="number" name="day" min="1" max="31" value="1">
        </div>

        <div>
            <input type="radio" name="gender" value="M">
            <label for="">Male</label>
            <input type="radio" name="gender" value="F">
            <label for="">Female</label>
            <input type="radio" name="gender" value="X">
            <label for="">Rather not say</label>
        </div>


        <div>
            Profile Picture
            <input type="file" name="image" id="" accept="image/*">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</body>
</html>