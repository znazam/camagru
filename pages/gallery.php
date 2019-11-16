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
   <link rel="stylesheet" href="../main.css">
   <title>gallery</title>
</head>
<body>
	<li class = "active" id="logout"><a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php" style="margin-right: 40%" ><button><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></button></a>
</body>
</html>