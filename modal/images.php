<?php
session_start();
set_include_path("../");
require_once("config/database.php");

if ((isset($_POST['url']) && isset($_POST['post_pic']) && $_POST['url'] != "") || (isset($_POST['chosen_frame']) && $_POST['chosen_frame'] != ""))
{
	if (!file_exists("../uploads"))
	{
		mkdir("../uploads");
	}
	if ($_POST['origin'] == "file")
	{
		$image = "../uploads/".$_FILES['src']['name'];
		$target = "../uploads/".basename($_FILES['src']['name']);
		move_uploaded_file($_FILES["src"]["tmp_name"], $target);
	}
	else
	{
		$rawData = $_POST['url'];
		$filteredData = explode(',', $rawData);
		$unencoded = base64_decode($filteredData[1]);
		$randomName = rand(0, 99999); 
		$fp = fopen("../uploads/".$randomName.'.jpg', 'w');
		fwrite($fp, $unencoded);
		fclose($fp);
		$image = "../uploads/".$randomName.".jpg";
	}
	$srcPath = $_POST['chosen_frame'];
	if (substr($image, -3) == "jpg")
	{
		$dest = imagecreatefromjpeg($image);
	}
	else if (substr($image, -3) == "png")
	{
		$dest = imagecreatefrompng($image);
	}
	else if (substr($image, -3) == "gif")
	{
		$dest = imagecreatefromgif($image);
	}
	$src = imagecreatefrompng($srcPath);
	$srcXpos = 0;
	$srcYpos = 0;
	$srcXcrop = 0;
	$srcYcrop = 0;
	$username = $_SESSION['username'];
	$userid = $_SESSION['uid'];
	$caption = $_POST['caption'];
	$time = time();
	if (substr($image, -3) == "gif")
	{
		$newImageName = "../uploads/".$userid."_".date("Y_m_d", $time)."_".$time.".gif";
	}
	else
	{
		$newImageName = "../uploads/".$userid."_".date("Y_m_d", $time)."_".$time.".jpg";
	}
	list($srcWidth, $srcHeight) = getimagesize($srcPath);
	imagecolortransparent($src, imagecolorat($src, 0, 0));
	imagecopymerge($dest, $src, $srcXpos, $srcYpos, $srcXcrop, $srcYcrop, $srcWidth, $srcHeight, 100);
	if (substr($image, -3) == "gif")
	{
		imagegif($dest, $newImageName, 100);
	}
	else
	{
		imagejpeg($dest, $newImageName, 100);
	}
	if (file_exists($image))
	{
		unlink($image);
	}
	imagedestroy($dest);
	imagedestroy($src);
	
	$postImageQuery = "INSERT INTO `$db_name`.`images`(`image`, `user`, `caption`) VALUES(:image, :user, :caption)";
	$postImageResult = $conn->prepare($postImageQuery);
	$postImageResult->bindParam(":image", $newImageName, PDO::PARAM_STR);
	$postImageResult->bindParam(":user", $userid, PDO::PARAM_STR);
	$postImageResult->bindParam(":caption", $caption, PDO::PARAM_STR);
	$postImageResult->execute();
	header("Location: ../pages/gallery.php");
	die();
}
else if (isset($_POST['url']) && isset($_POST['post_pic']))
{
	$msg = "<script>alert('You forgot something like taking a picture or selecting a frame');</script>";
}
?>