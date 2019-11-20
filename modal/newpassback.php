<?php
set_include_path("../");
include 'config/database.php';
$newpass = $_POST['newpass'];
$password = $_POST['password'];
$email = $_GET['email'];

$msg = "";
if(isset($_POST['submit']))
{
	try
	{
		if (!empty($password) && !empty($newpass))
		{
			if ($newpass == $password)
			{
				$hshpwd = password_hash($password, PASSWORD_BCRYPT);
				$for = $conn->prepare("UPDATE user set passwd = ? WHERE email = ?");
				var_dump($for);
				$for->execute(array($hshpwd, $email));
				header("location: /cama/login/login.php");
				return;
			}
			else
			{
				$msg = "passwords must match";
				header("location: /cama/pages/newpass.phperror=passwords must match");
				return;
			}
		}
		else
		{
			$msg = "passwords fields must be filled";
			header("location: /cama/pages/forgot.phperror=passwords fields must be filled");
			return;
		}
	}
	catch(PDOException $ex)
	{
	$msg = "error";
	echo $msg;
	}
}
?>