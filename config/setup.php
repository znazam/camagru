<?php
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
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL UNIQUE,
			passwd VARCHAR(60) NOT NULL,
			verified BOOL NOT NULL DEFAULT 0,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	try{
		$conn->exec($user);
	}
	catch(PDOException $e)
	{
		echo $user . "<br>" . $e->getMessage();
	}
?>
