<?php
session_start();
set_include_path ("../");
require_once("config/database.php");

if(isset($_POST['postlike']))
{
	$statement = $conn->prepare("DELETE FROM `likes` WHERE uploaderID = :user AND postID = :post");
	$statement->bindParam(":user", $_SESSION['uid']);
	$statement->bindParam(":post", $_POST['post_id']);
	$statement->execute();
	if ($statement->rowCount() == 0)
	{
		$statement = $conn->prepare("INSERT INTO `$db_name`.`likes`(`uploaderID`, `postID`) VALUES (:user, :post)");
		$statement->bindParam(":user", $_SESSION['uid']);
		$statement->bindParam(":post", $_POST['post_id']);
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
}
	
if(isset($_POST['post_comment']))
{
	$statement = $conn->prepare("INSERT INTO `$db_name`.`comments`(`uploaderID`, `postID`, `content`) VALUES (:user, :post, :content)");
	$statement->bindParam(":user", $_SESSION['uid']);
	$statement->bindParam(":post", $_POST['post_id']);
	$statement->bindParam(":content", $_POST['comment']);

	$user = $_POST['user'];
	$com = $conn->prepare("SELECT email FROM user WHERE id=?");
	$com->execute(array($user));
	$email = $com->fetch();
	var_dump($email);

	$person = $_SESSION['username'];
	$email = $_SESSION['email'];
	$comment = $_POST['comment'];
	$subject = "$person commented  on your post";
	$body = "$person commented  < $comment > on your post";
	$headers = "MIME-Version: 1.0" . "\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
	$result = mail($email,$subject,$body,$headers);
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