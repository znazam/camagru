<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
set_include_path ("../");
require_once("config/database.php");

if(isset($_POST['postlike']))
{
	$del = $conn->prepare("DELETE FROM `likes` WHERE uploaderID = :user AND postID = :post");
	$del->bindParam(":user", $_SESSION['uid']);
	$del->bindParam(":post", $_POST['post_id']);
	$del->execute();
	if ($del->rowCount() == 0)
	{
		$del = $conn->prepare("INSERT INTO `$db_name`.`likes`(`uploaderID`, `postID`) VALUES (:user, :post)");
		$del->bindParam(":user", $_SESSION['uid']);
		$del->bindParam(":post", $_POST['post_id']);
	}
	try
	{
		$del->execute();
		header("Location: ../pages/gallery.php?page=".$_GET['returnto']);
	}
	catch(PDOExeption $e)
	{
		echo "Error: ".$e->message();
	}
}
	
if(isset($_POST['post_comment']))
{
	$statement = $conn->prepare("INSERT INTO `$db_name`.`comments`(`uploaderID`, `postID`, `content`) VALUES (:user, :post, :content)");
	$statement->bindParam(":user", $_SESSION['uid']);
	$statement->bindParam(":post", $_POST['post_id']);
	$statement->bindParam(":content", $_POST['comment']);
	
	$user = $_POST['user'];
	$com = $conn->prepare("SELECT * FROM user WHERE id=?");
	$com->execute(array($user));
	$email = $com->fetch();
	var_dump($email);

	if($email['notify'] == 1)
	{
		$uemail = $email['email'];
		$person = $_SESSION['username'];
		$comment = $_POST['comment'];
		$subject = "$person commented  on your post";
		$body = "$person commented  < $comment > on your post";
		$headers = "MIME-Version: 1.0" . "\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
		$result = mail($uemail,$subject,$body,$headers);
	}
}
try
{
	$statement->execute();
	header("Location: ../pages/gallery.php?page=".$_GET['returnto']);
}
catch(PDOExeption $e)
{
	echo "Error: ".$e->message();
}
?>