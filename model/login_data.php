<?php
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
				$_SESSION["login"] = "OK";
				echo json_encode(["Status" => true]);
				header("Location: /cama/login/login.php?connected");
				exit();
			}
			else 
			{
				header("Location: /cama/login/login.php?failuretoconnect");
				echo "invalid email address or password";
				return;
			}
			$stmt->execute(array($username, $firstname, $lastname, $email, $hshpwd));
			header("Location: /cama/login/login.php?success=true");
		}
	}
	catch (PDOException $e)
	{
		echo "failed to login: ".$e->getMessage();
		header("Location: /cama/login/login.php?failure");
	}
?>