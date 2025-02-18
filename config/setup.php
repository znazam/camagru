<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	set_include_path("../");
	require('config/credentials.php');

	try {
		$conn = new PDO("mysql:host=$host", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$user = "CREATE TABLE IF NOT EXISTS `$db_name`.`user` (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL UNIQUE,
			passwd VARCHAR(60) NOT NULL,
			verified BOOL NOT NULL DEFAULT 0,
			token VARCHAR(60) NOT NULL,
			notify BOOL NOT NULL DEFAULT 0,
			reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	try{
		$conn->exec($user);
	}
	catch(PDOException $e)
	{
		echo $user . "<br>" . $e->getMessage();
	}

	$images = "CREATE TABLE IF NOT EXISTS `$db_name`.`images` (
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`user` varchar(200) NOT NULL,
  		`image` longtext NOT NULL,
		`caption` longtext NOT NULL,
		-- `description` varchar(255),
		creationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	try
	{
		$conn->exec($images);
	}
	catch(PDOException $e)
	{
		echo "Failed to create post table: " . $e->getMessage();
	}

	$comment = "CREATE TABLE IF NOT EXISTS `$db_name`.`comments` (
		id int NOT NULL AUTO_INCREMENT,
		uploaderID int NOT NULL,
		postID int NOT NULL,
		content varchar(1000) NOT NULL,
		creationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id))";
	try
	{
	$conn->exec($comment);
	}
	catch(PDOException $e)
	{
	echo "Failed to create comment table: " . $e->getMessage();
	}

	$like = "CREATE TABLE IF NOT EXISTS `$db_name`.`likes` (
		uploaderID int NOT NULL,
		postID varchar(5) NOT NULL)";
	try
	{
	$conn->exec($like);
	}
	catch(PDOException $e)
	{
	echo "Failed to create like table: " . $e->getMessage();
	}
?>
