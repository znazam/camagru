<?php
	require('database.php');
	$user = "CREATE TABLE IF NOT EXISTS `mydbpdo`.`MyGuests` (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL,
			password VARCHAR(50) NOT NULL;
			verify VARCHAR(50) NOT NULL,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	try{
	$conn->exec($user);
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;	
?>
