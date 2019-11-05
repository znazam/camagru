<?php
	session_start();
	set_include_path("../");
	require_once("config/database.php");

	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$confirm_password = $_POST['confirm_password'];
	$existemail = $conn->prepare( "SELECT `email` FROM `user` WHERE `email` = ?" );
	$existemail->bindValue( 1, $email );
	$existemail->execute();
	$up = "UPDATE user set verified = 1 WHERE email = ?";
	$random = mt_rand(0, 99999);

	try
	{	
		if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password))
		{
			$_SESSION['error'] = "fields need to be filled";
			header("location: /cama/login/register.php?error=fieldsempty");
			return;
		}
		else
		{
			if( $existemail->rowCount() == 1 )
			{
				$_SESSION['error'] = "email is in use";
				header("location: /cama/login/register.php?emailexists");
				return;
			}
			else
			{
				if (empty($password) || empty($confirm_password))
				{
					$_SESSION['error'] = "password fields need to be filled in";
					header("location: /cama/login/register.php?passwordmissing");
					return;
				}
				else
				{
					if ($password == $confirm_password)
					{
						$hshpwd = password_hash($password, PASSWORD_BCRYPT);
						$reg = $conn->prepare("INSERT INTO `user` (`username`, `firstname`, `lastname`, `email`, `passwd`, `token`) VALUES (?, ?, ?, ?, ?, ?)");
						$reg->execute(array($username, $firstname, $lastname, $email, $hshpwd, $random));
						$email = $_POST['email'];
						$subject = "verify your account";
						$body = "Verify your account by clicking the Link: <a href = 'http://localhost:8080/cama/pages/checkmail.php'></a><br />and enter the code $random";
						var_dump($result);
						$result = mail($email,$subject,$body);
						header("location: /cama/pages/checkmail.php?success");
					}
					else
					{
						$_SESSION['error'] = "passwords must be the same";
						header("location: /cama/login/register.php?passwordsmustbethesame");
						return;
					}
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