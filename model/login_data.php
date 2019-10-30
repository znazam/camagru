<?php
	$loginname = $_POST['login'];
	$loginpass = $_POST['passwd'];

try {
		$stmt = $conn->prepare("SELECT * FROM `user` WHERE `email`=?");
		$data = $stmt->execute(array($email));
		if (password_verify($loginpass, $data["passwd"]))
			header("Location: /login/login.php?success=true");
		$stmt->execute(array($firstname, $lastname, $email, $hshpwd));
		header("Location: /login/login.php?success=true");
	}
	catch (PDOException $e)
	{
		echo "failed to login: ".$e->getMessage();
		header("Location: /login/login.php?failure=true");
	}
?>