<?php
	set_include_path("../");
	require_once("config/database.php");

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	//--- validation ---

	try {
		$stmt = $conn->prepare("INSERT INTO `user` (`firstname`, `lastname`, `email`, `passwd`, `verify`) VALUES (?, ?, ?, ?, ?)");
		$hshpwd = password_hash($password, PASSWORD_BCRYPT);
		$val = "blah";
		if (password_verify("Different", $hshpwd))
			$val = "bleh";
		$stmt->execute(array($firstname, $lastname, $email, $hshpwd, "asdiuhasduh"));
		header("location: /cama/login/login.php?success=true&val=$val");
	}
	catch (PDOException $e)
	{
		echo "failed to edit stuff: ".$e->getMessage();
		header("location: /cama/login/login.php?failure=true");
	}
?>