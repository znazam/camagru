<?php
set_include_path("../");
include 'config/database.php';
$email = $_POST['femail'];
$for = $conn->prepare("SELECT * FROM user WHERE email=?");
$for->execute(array($email));
$user = $for->fetch();
var_dump($user);

if($email)
{
	$subject = "new password";
	$body = "enter new password by clicking the Link: 'http://localhost:8080/cama/pages/newpass.php'<br />";
	mail($email,$subject,$body);
	header("location: /cama/pages/notifier.php");
}
?>