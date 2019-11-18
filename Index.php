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
   <title>index</title>
</head>
<body>
<div class = "header">
            <h1 style = "margin-top:1%; color: white">Camagru</h1>
        </div>
        <div class = "menu_bar">
            <ul>
                <li class = "active" id="logout"><a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php" style="margin-right: 40%" ><button><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></button></a>
				<?php if ($_SESSION['uid']) : ?><a href= "pages/profile.php" style="margin-right: 40%; margin-top: 10%"><button>Profile</button></a><?php endif;?>
				<a href= "pages/gallery.php" style="margin-right: 10%; margin-top: 10%"><button>gallery</button></a>
                 </li>
            </ul>
        </div>
        <br/><br/><br/>
</body>
</html>