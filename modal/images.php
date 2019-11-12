<?php
session_start();
set_include_path("../");
require_once("config/database.php");

$photo = $_POST['photo'];
// echo "photo".$photo;
$photo = str_replace(" ", "+", $photo);
$photo = base64_decode(str_replace("data:image/png;base64,", "", $photo));
$photo = imagecreatefromstring($photo);

$target_dir = "../uploads/";
$target_file = $target_dir . "file.png";
echo $target_file;
imagepng($photo, $target_file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) 
{
    $check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false) 
	{
    	echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
	} 
	else 
	{
        echo "This is not an image file. Please upload another.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) 
{
    echo "This file already exists – please upload another.";
    $uploadOk = 0;
}

if ($_FILES["file"]["size"] > 1000000) 
{ 
    echo "Your file is too big. Please try again";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) 
{
	echo "something";
	var_dump($_POST);
    echo "Only JPG, JPEG, PNG and GIF files are allowed. Please try again";
    $uploadOk = 0;
}

if ($uploadOk == 0) 
{
    echo "Your file was not uploaded.";
} 
else 
{
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
	{
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
	}
	else 
	{
        echo "There was an error uploading your file.";
    }
}
?>