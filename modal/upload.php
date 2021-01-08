<?php
include '../config/database.php';
$statusMsg = '';
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
$username = $_SESSION['username'];
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$userid = $_SESSION['uid'];
$caption = $_POST['caption'];


if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
{
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
	if(in_array($fileType, $allowTypes))
	{
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
		{
			$insert = "INSERT INTO `$db_name`.`images`(`image`, `user`, `caption`) VALUES(:image, :user, :caption)";
			$insert = $conn->prepare($insert);
            $insert->bindParam(":image", $targetFilePath, PDO::PARAM_STR);
            $insert->bindParam(":user", $userid, PDO::PARAM_STR);
            $insert->bindParam(":caption", $caption, PDO::PARAM_STR);
			$insert->execute();
			header("Location: ../pages/profile.php");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
echo $statusMsg;
?>