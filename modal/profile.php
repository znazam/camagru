<?php
require_once("../config/database.php");
session_start();
if(!$_SESSION['username']){
	header("location: ../login/login.php");
	die;
}

if(isset($_POST['delete'])){
	$sql = $conn->prepare("DELETE FROM `images` WHERE user = :user AND id = :post");
	$sql->bindParam(":user", $_SESSION['uid']);
	$sql->bindParam(":post", $_POST['post_id']);
	try
	{
		$sql->execute();
		header("Location: ../pages/profile.php?page=".$_GET['returnto']);
	}
	catch(PDOExeption $e)
	{
		echo "Error: ".$e->message();
	}
}
?>