<?php
set_include_path("../");
require_once("pages/forgot.php");
require_once("pages/newpass.php");
include 'config/database.php';



$email = $_POST['femail'];
$newpass = $_POST['newpass'];
$password = $_POST['password'];
$for = $conn->prepare("SELECT email FROM user WHERE passwd=?");
$for->execute(array($forgot));
$passwd = $for->fetch();
var_dump($passwd);

if($email)
{
	$subject = "new password";
	$body = "enter new password by clicking the Link: <a href = 'http://localhost:8081/cama/pages/forgot.php'>link</a><br />";
	// var_dump($result);
	// $result = mail($email,$subject,$body);
}

$msg = "";
if(isset($_POST['submit']))
{
	$email = $code['email'];
	$for = $conn->prepare("UPDATE user set passwd = $password WHERE email = ?");
	try
	{
		if (empty($password) || empty($newpass))
		{
			$_SESSION['error'] = "password fields need to be filled in";
			header("location: /cama/pages/forgot.php?passwordmissing");
			return;
		}
		else
		{
			if ($password == $confirm_password)
			{
				if($email)
				{
					$for->execute(array($email));
					header("location: /cama/login.php");
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