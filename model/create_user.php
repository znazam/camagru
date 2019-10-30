<?php
	set_include_path("../");
	require_once("config/database.php");

	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$confirm_password = $_POST['confirm_password'];


	//--- validation ---
	try
	{	
		if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password))
		{
			header("location: /cama/login/register.php?error=fieldsempty");
			return;
		}
		else
		{
			if (empty($password) || empty($confirm_password))
			{
				header("location: /cama/login/register.php?passwordmissing");
				return;
			}
			else
			{
				if ($password == $confirm_password)
				{
					$hshpwd = password_hash($password, PASSWORD_BCRYPT);
					$reg = $conn->prepare("INSERT INTO `user` (`username`, `firstname`, `lastname`, `email`, `passwd`) VALUES (?, ?, ?, ?, ?)");
					$reg->execute(array($username, $firstname, $lastname, $email, $hshpwd));
					header("location: /cama/login/login.php?success");
				}
				else
				{
					echo "passwords must be same";
					header("location: /cama/login/register.php?passwordsmustbethesame");
					return;
				}
			}
		}
	}
	catch (PDOException $e)
	{
		echo "failed to login: ".$e->getMessage();
	} catch (Exception $e)
	{
		print($e->message);
	}
?>