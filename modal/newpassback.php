<?php
set_include_path("../");
include 'config/database.php';
require_once("pages/newpass.php");
$newpass = $_POST['newpass'];
$password = $_POST['password'];


$msg = "";
if(isset($_POST['submit']))
{
	$email = $code['email'];
	$for = $conn->prepare("UPDATE user set passwd = $hshpwd WHERE email = ?");
	try
	{
		if (empty($password) || empty($newpass))
		{
			$_SESSION['error'] = "password fields need to be filled in";
			header("location: /cama/pages/newpass.php");
			return;
		}
		else
		{
			if ($password == $confirm_password)
			{
				if($email)
				{
					$hshpwd = password_hash($password, PASSWORD_BCRYPT);
					$for->execute(array($email));
					header("location: /cama/login/login.php");
				}
				else
				{
					$_SESSION['error'] = "incorrect email";
					header("location: /cama/pages/forgot.php");
					return;
				}
			}
			else
			{
				$_SESSION['error'] = "passwords must match... check password";
				header("location: /cama/pages/forgot.php");
			}
		}
	}
	catch(PDOException $ex)
	{
	$msg = "error";
	echo $msg;
	}
}
?>