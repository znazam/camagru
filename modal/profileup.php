<?php
include_once '../config/database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$user = $_SESSION['uid'];
$curemail = $_SESSION["email"];
$n = $conn->prepare("SELECT * FROM user WHERE email=?");
$n->execute(array($curemail));
$data = $n->fetch();

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
    $mail = $conn->prepare("UPDATE `user` SET `email` = ? WHERE `id` = ?");
    $mail->execute(array($email, $_SESSION['uid']));
    $_SESSION['email'] = $email;
}
if(isset($_POST['notify'])){
	if($_SESSION['notify'] == '0')
		$notify = '1';
	else
		$notify = '0';
	$curemail = $_SESSION["email"];
	$no = $conn->prepare("UPDATE `user` SET `notify` = :notify WHERE `id` = :userid");
	$no->bindParam(":userid", $_SESSION['uid']);
	$no->bindParam(":notify", $notify, PDO::PARAM_INT);
	$no->execute();
	$_SESSION["notify"] = $notify;
}
if(isset($_POST['pass_submit']) && ($_POST['new_password'] == $_POST['re_password'])){
    $password = $_POST['new_password'];
    $hashed = password_hash($password , PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE `user` SET `passwd` = ? WHERE `username` = ?");
    $stmt->execute(array($hashed, $_SESSION['uid']));
}
else
{
	header("Location: ../pages/profile.php?error=passwords must match");
	die;
}
header("Location: ../pages/profile.php");
?>