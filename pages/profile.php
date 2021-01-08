<?php 
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
if(!$_SESSION['uid'])
header("Location: ../login/login.php");
?>
<?php
session_start();
include '../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body width = "100%" style = "font-size: 1vw">
<header>
<div class="logo">
	</div>
	<div id="header">
		<div class="header_item">
			<a href="../index.php" style="color: blue; font-size: 300%; margin-left: 10%">HOMEPAGE</a>
			<a href="../pages/gallery.php?page=1" style="margin-left: 20%"><img class="user_icon" src="https://static.thenounproject.com/png/18307-200.png"></a>
			<a href="profileup.php" style="margin-left: 10%">Update Details?</a>
			<a href="images.php" style="margin-left: 10%"><img src="https://www.creativefabrica.com/wp-content/uploads/2018/10/Camera-logo-by-DEEMKA-STUDIO-580x406.jpg" width="40" height="40"></a>
			<a href="../login/logout.php" style="margin-left: 50%; margin-bottom: 100%"><img class="user_icon" onclick="logOut()" src="https://www.freeiconspng.com/uploads/shutdown-icon-28.png"></a>
		</div>
	</div>
</div>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="container">
	<div class="view-form">
		<div class="row">
			<?php
			if (!isset($_GET['page']))
				$_GET['page'] = 1;
			$offset = 5 * ($_GET['page'] - 1);

			$userid = $_SESSION['uid'];
			$statement = $conn->prepare("SELECT COUNT(*) FROM images WHERE user = $userid");
			$statement->execute();
			$post_count = $statement->fetch()[0];
			$post_count;

			$rc = $conn->prepare("SELECT * FROM `images` WHERE user = $userid ORDER BY `creationDate` DESC LIMIT 5 OFFSET :offset");
			$rc->bindParam(":offset", $offset, PDO::PARAM_INT);
			$rc->execute();
			$row_count = $rc->rowCount();

			if(($offset + 5) < $post_count){
				echo "<a href='?page=".($_GET['page']+1)."'>  Next</a>";
			}
			if($offset >= 2){
				echo "<a href='?page=".($_GET['page']-1)."'><br>Prev</a>";
			}
			if($rc->rowCount() > 0)
			{
				while($row=$rc->fetch(PDO::FETCH_ASSOC))
				{
				$stmt = $conn->prepare("SELECT * FROM `images` where user = $userid");
				$stmt->execute();
				?>
					<div class="booth" style="width:600px">
						<form action ="/cama/modal/profile.php?returnto=<?=$_GET['page']?>" id="submit_form" method="POST" enctype="multipart/form-data">
							<img src="<?=$row['image']?>" style="width: 600px; height:500%"/>
							<?php if ($_SESSION['uid']) : ?><input type='hidden' name="post_id" value="<?php echo $row['id'];?>"/><?php endif;?>
							<?php if ($_SESSION['uid']) : ?><input type='hidden' name="user_id" value="<?php echo $row['user'];?>"/><?php endif;?>
							<button style="background-color: white" type="submit" name="delete">Delete</button>
						</form>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/photo.js"></script>
<a href="https://www.facebook.com"><img src="https://en.facebookbrand.com/wp-content/uploads/2019/04/f_logo_RGB-Hex-Blue_512.png" height="50px" width="50px"></a>
<hr>
<div id="footer">
	<p id="f_msg" style="color: white">This website is proundly provided to you by Zaid Nazam</p>
    <p id="cr" style="color: white">znazam 2019</p>
</div>
</body>
</html>