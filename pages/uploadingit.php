<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(!$_SESSION['uid'])
header("Location: ../login/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body width = "100%" style = "font-size: 1vw">
<header>
        <div class="headingss">
            <a href="gallery.php?page=1"><img src="https://static.thenounproject.com/png/18307-200.png" width="100" ></a>
            <a href="profile.php?page=1"><img src="https://image.shutterstock.com/image-vector/user-account-profile-circle-flat-260nw-467503004.jpg" width="100" width="100"></a>
            <a href="images.php"><img src="https://www.creativefabrica.com/wp-content/uploads/2018/10/Camera-logo-by-DEEMKA-STUDIO-580x406.jpg" width="40" height="40"></a>
            <a href="../login/logout.php">logout</a>
        </div>
    </header>
<form action="../modal/upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file" required style="background-color: white">
    <input type="submit" name="submit" value="Upload"  style="background-color: white">
    <br>
    <title>Caption</title>
    <textarea id="img_caption" type="text" name="caption"></textarea>
</form>
</body>
</html>