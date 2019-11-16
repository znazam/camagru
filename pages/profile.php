<?php
session_start();
if (!$_SESSION['uid'])
	header("location: /cama/login/login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../main.css">
   <title>profile</title>
</head>
<body>
		<?php echo $msg;  ?>
		<form method="post" action="images.php" enctype='multipart/form-data'>
  		<input type='file' name='file' />
  		<input type='submit' value='Save name' name='but_upload'>
		<a href= "images.php"><button>take image</button></a>
		</form>
		<li class = "active" id="logout"><a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php" style="margin-right: 40%" ><button><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></button></a>
</body>
</html>