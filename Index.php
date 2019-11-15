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
            <h1 style = "margin-top:1%; color: white">Camagru</h1>
        </div>
        <div class = "menu_bar">
            <ul>
                <li class = "active" id="logout"><a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php" style="margin-right: 40%" ><button><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></button></a>
   				<a href= "modal/yellowimages.php" style="margin-right: 40%; margin-top: 10%"><button><?php if ($_SESSION['uid']) : ?>profile<?php endif;?></button></a>
                 </li>
            </ul>
        </div>
        <br/><br/><br/>
   <things class="and" href="stuffses"></things>
</body>
</html>