<?php
	session_start();
	set_include_path("../");
	require_once("config/database.php");
	$email = $_POST['email'];
	$loginpass = $_POST['passwd'];

try {
		$stmt = $conn->prepare("SELECT * FROM user WHERE email=?");
		$stmt->execute(array($email));
		$data = $stmt->fetch();
		var_dump($data);
		if($data)
		{
			if (password_verify($loginpass, $data["passwd"])){
				$_SESSION["uid"] = $data['id'];
				$_SESSION["username"] = $data['username'];
				$_SESSION["email"] = $data['email'];
				$_SESSION["notify"] = $data['notify'];
				echo json_encode(["Status" => true]);
				header("Location: /cama/index.php");
				exit();
			}
			else 
			{
				echo "incorrect password or emailaddress";
				header("Location: /cama/login/login.php?error=failuretoconnect");
				return;
			}
			$stmt->execute(array($username, $firstname, $lastname, $email, $hshpwd));
			header("Location: /cama/login/login.php");
			exit();
		}
		else 
		{
			echo "incorrect password or emailaddress";
			header("Location: /cama/login/login.php?error=failuretoconnect");
			return;
		}
	}
	catch (PDOException $e)
	{
		echo "failed to login: ".$e->getMessage();
		header("Location: /cama/login/login.php?error=failure");
		exit();
	}
?>