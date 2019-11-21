<?php
session_start();
set_include_path("../");
include 'config/database.php';

$email = $_POST['email'];
$for = $conn->prepare("SELECT * FROM user WHERE email=?");
$for->execute(array($email));

if($email)
{
	$subject = "new password";
	$headers = "MIME-Version: 1.0" . "\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
	$body = "enter new password by clicking the Link: <a href=http://localhost:8080/cama/pages/newpass.php?email=$email>link</a><br />";
	mail($email,$subject,$body,$headers);
	header("location: /cama/pages/notifier.php");
	return;
}
else
{
	header("location: /cama/pages/forgot.php?error=email does not exist");
	return;
}
?>