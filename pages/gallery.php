<?php
// if($_SESSION['username'] != TRUE){
	//     header("location: ../login/login.php");}
	?>
<?php
	session_start();
	include '../config/database.php';

	// $ID = $_SESSION['uid'];
	// $query = $conn->query("SELECT * FROM `images` WHERE `id` = $ID");
	// $array = $query->fetchall();
	// $x = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
</head>
<body>
<header>
<div class="logo">
	</div>
	<div id="header">
		<div class="header_item">
        	<a href="../index.php" style="color: blue; font-size: 300%; margin-left: 10%">HOMEPAGE</a>
            <?php if ($_SESSION['uid']) : ?><a href= "profile.php" style="margin-right: 40%; margin-top: 10%"><img src="https://image.shutterstock.com/image-vector/user-account-profile-circle-flat-260nw-467503004.jpg" width="100" height="100"></a><?php endif;?>
			<?php if ($_SESSION['uid']) : ?><a href= "images.php" style="margin-right: 40%; margin-top: 10%"><img src="https://www.creativefabrica.com/wp-content/uploads/2018/10/Camera-logo-by-DEEMKA-STUDIO-580x406.jpg" width="40" height="40"></a><?php endif;?>
			<a href = "/cama/login/<?php echo $_SESSION['uid'] ? "logout" : "login"?>.php" style="margin-right: 40%"><button><?php echo $_SESSION['uid'] ? "Logout" : "Login"?></button></a>
		</div>
	</div>
</div>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="container">
	<div class="view-form">
		<div class="row">
			<?php
			$stmt = $conn->prepare("SELECT * FROM `images` ORDER BY `creationDate`");
			$stmt->execute();
			// $stmt = fetch();
			if($stmt->rowCount() > 0)
			{
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<div class="booth" style="width:600px">
						<form action ="/cama/modal/gallery.php" id="submit_form" method="POST" enctype="multipart/form-data">
							<img src="<?=$row['image']?>" style="width: 600px; height:500%"/>
							<?php if ($_SESSION['uid']) : ?><textarea id="img_caption" type="text" name="comment"></textarea><?php endif;?>
							<?php if ($_SESSION['uid']) : ?><button name="postlike" style="width: 10%; height: 50px; margin-top: -70%"><img id="like" style="width: 130%; height: 50px; margin-left: -15%; margin-top: -10%" src="https://i.ytimg.com/vi/sx6Bx29lFWg/hqdefault.jpg"/></button><?php endif;?>
							<?php if ($_SESSION['uid']) : ?><input id="post_pic" name="post_pic" type="submit" value="Upload" style="margin-top: 3%"><?php endif;?>
							<?php if ($_SESSION['uid']) : ?><input type='hidden' ><?php echo $row['id'];?><?php endif;?> 
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
