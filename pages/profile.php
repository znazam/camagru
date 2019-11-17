<?php
require('../modal/profile.php');
echo "awrextcfyvguh";
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
<body>
<header>
<div class="logo">
	</div>
	<div id="header">
		<div class="header_item">
			<a href="../index.php" style="color: blue; font-size: 300%; margin-left: 10%">HOMEPAGE</a>
			<a href="../pages/gallery.php" style="margin-left: 20%"><img class="user_icon" src="https://static.thenounproject.com/png/18307-200.png"></a>
		<!-- <div class="header_item" style="display: inline; width: 30px;"> -->
			<a href="profileup.php" style="margin-left: 10%"><img src="https://image.shutterstock.com/image-vector/user-account-profile-circle-flat-260nw-467503004.jpg" width="100" width="100"></a>
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
			try {
				$userid = $_SESSION['uid'];
				$stmt = $conn->prepare("SELECT * FROM `images` where user = $userid");
				$stmt->execute();
				if($stmt->rowCount() > 0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
						?>
						<div class="whole">
								<img src="<?=$row['image']?>" width="2000000px"/>
						</div>
						<?php
					}
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			?>

		<div class="col">
			<p><?php echo $row['username']?></p>
			<img src="<?php echo $row['file_name']?>">
			<button type="submit" name="delete">Delete</button>
		</div>
		</div>
	</div>
</div>
<a href="https://www.facebook.com"><img src="https://en.facebookbrand.com/wp-content/uploads/2019/04/f_logo_RGB-Hex-Blue_512.png" height="50px" width="50px"></a>
<hr>
<div id="footer">
	<p id="f_msg" style="color: white">This website is proundly provided to you by Zaid Nazam</p>
    <p id="cr" style="color: white">znazam 2019</p>
</div>
</body>
</html>