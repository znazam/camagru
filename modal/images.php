<?php
session_start();
set_include_path("../");
require_once("config/database.php");

// $photo = $_POST['photo'];
// // $msg "photo".$photo;
// $photo = str_replace(" ", "+", $photo);
// $photo = base64_decode(str_replace("data:image/png;base64,", "", $photo));
// $photo = imagecreatefromstring($photo);

// $msg = "";
// $target_dir = "../uploads/";
// $target_file = $target_dir . "file.png";
// echo $target_file;
// imagepng($photo, $target_file);
// $uploadOk = 1;
// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// if(isset($_POST["submit"])) 
// {
//     $check = getimagesize($_FILES["file"]["tmp_name"]);
// 	if($check !== false) 
// 	{
//     	$msg = "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
// 	} 
// 	else 
// 	{
//         $msg = "This is not an image file. Please upload another.";
//         $uploadOk = 0;
//     }
// }

// if (file_exists($target_file)) 
// {
//     $msg = "This file already exists – please upload another.";
//     $uploadOk = 0;
// }

// if ($_FILES["file"]["size"] > 1000000) 
// { 
//     $msg = "Your file is too big. Please try again";
//     $uploadOk = 0;
// }

// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) 
// {
// 	var_dump($_POST);
//     $msg = "Only JPG, JPEG, PNG and GIF files are allowed. Please try again";
//     $uploadOk = 0;
// }

// if ($uploadOk == 0) 
// {
//     $msg = "Your file was not uploaded.";
// } 
// else 
// {
// 	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
// 	{
//         $msg = "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
// 	}
// 	else 
// 	{
//         $msg = "There was an error uploading your file.";
// 	}
// }

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
	//echo $dest;
	$srcXpos = 0;
	$srcYpos = 0;
	$srcXcrop = 0;
	$srcYcrop = 0;


	// $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
	// $stmt->execute(array($email));
	// $data = $stmt->fetchAll();
	// var_dump($data);
	$username = $_SESSION['username'];
	// $username = $data['username'];
	echo "username is :$username";
	$userid = $_SESSION['uid'];
	$caption = $_POST['caption'];
	$time = time();
	if (substr($image, -3) == "gif")
	{
		$newImageName = "../uploads/".$username."_".date("Y_m_d", $time)."_".$time.".gif";
	}
	else
	{
		$newImageName = "../uploads/".$username."_".date("Y_m_d", $time)."_".$time.".jpg";
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
	$postImageResult->bindParam(":user", $username, PDO::PARAM_STR);
	$postImageResult->bindParam(":caption", $caption, PDO::PARAM_STR);
	$postImageResult->execute();
	//header("Location: ../pages/gallery.php");
	die();
}
else if (isset($_POST['url']) && isset($_POST['post_pic']))
{
	$msg = "<script>alert('You forgot something like taking a picture or selecting a frame');</script>";
}
?>