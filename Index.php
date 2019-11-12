<?php
require_once('config/database.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="./main.css">
   <title>homepage</title>
</head>
<body>
<div class = "header">
            <h1 style = "margin-top:1%;">Camagru</h1>
        </div>
        <div class = "menu_bar">
            <ul>
                <li class = "active" id="logout"><a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php"><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></a></li>
                 </li>
            </ul>
        </div>
        <br/><br/><br/>
   <a href= "pages/images.php"><button>take image</button></a>
   <things class="and" href="stuffses"></things>
</body>
</html>