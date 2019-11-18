<?php
	session_start();
	set_include_path ("../");
	require_once("config/database.php");
	
	if(isset($_POST['postlike']))
	{
		echo "something";
		// $ver = $conn->prepare("SELECT id FROM images WHERE `image`=?");
		// $ver->execute(array($imageid));
		// $code = $ver->fetch();
		$statement = $conn->prepare("INSERT INTO `$db_name`.`likes`(`uploaderID`, `postID`) VALUES (:user, :post)");
		$statement->bindParam(":user", $_POST['uid']);
		$statement->bindParam(":post", $_POST['id']);
		try
		{
			$statement->execute();
			heaader("Location: ../pages/gallery");
		}
		catch(PDOExeption $e)
		{
			echo "Error: ".$e->message();
		}
	}
	
	//dislike it
	set_include_path ("../");
	require 'config/setup.php';
	$statement = $conn->prepare("DELETE FROM `likes` WHERE uploaderID = :user AND postID = :post");
	$statement->bindParam(":user", $_POST['user']);
	$statement->bindParam(":post", $_POST['post']);
	$statement->execute();
	
	//display likes
	$statement = $conn->prepare("SELECT COUNT(*) FROM posts;");
	$statement->execute();
	print($statement->fetch()[0]);
?>