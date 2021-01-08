<?php
include_once '../config/database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

$user = $_SESSION['uid'];
$curemail = $_SESSION["email"];
$n = $conn->prepare("SELECT * FROM user WHERE email=?");
$n->execute(array($curemail));
$data = $n->fetch();
//var_dump($result);

if($_SESSION['username'] != TRUE){
	header("location: ../login/login.php?error=must login first");
}
$old_username = $_SESSION['username'];
if(isset($_POST['username_submit'])){
    $username = $_POST['new_username'];
	$name = $conn->prepare("UPDATE `user` SET `username`=? WHERE `id` = ?");
	$_SESSION['uid'];
    $name->execute(array($username, $_SESSION['uid']));
    $_SESSION['username'] = $username;
}
if(isset($_POST['email_submit'])){
	$email = $_POST['new_email'];
	if($email == $curemail)
	{
		header("Location: ../pages/profileup.php?error=emails are the same as the one currently set");
		die;
	}
	else
	{
		$mail = $conn->prepare("UPDATE `user` SET `email` = ?, `verified` = ? WHERE `id` = ?");
		echo $email.$_SESSION['uid'];
		$mail->execute(array($email, '0', $_SESSION['uid']));
		$_SESSION['email'] = $email;
		$subject = "verify your account";
		$body = "Verify your account by clicking the Link: <a href = 'http://localhost:8080/cama/pages/checkmail.php'>link</a><br />and enter the code $random";
		$subject = "new password";
		$headers = "MIME-Version: 1.0" . "\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
		$result = mail($email,$subject,$body,$headers);
		header("location: /cama/pages/checkmail.php?success");
		die;
	}
}
if(isset($_POST['notify'])){
	if($_SESSION['notify'] == '0')
		$notify = '1';
	else
		$notify = '0';
	$no = $conn->prepare("UPDATE `user` SET `notify` = :notify WHERE `id` = :userid");
	$no->bindParam(":userid", $_SESSION['uid']);
	$no->bindParam(":notify", $notify, PDO::PARAM_INT);
	$no->execute();
	$_SESSION["notify"] = $notify;
}
if(isset($_POST['pass_submit']) && ($_POST['new_password'] == $_POST['re_password'])){
    $password = $_POST['new_password'];
    $hashed = password_hash($password , PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE `user` SET `passwd` = ? WHERE `id` = ?");
    $stmt->execute(array($hashed, $_SESSION['uid']));
}
else
{
	header("Location: ../pages/profileup.php?error=passwords must match");
	die;
}
header("Location: ../pages/profile.php");
?>