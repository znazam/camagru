<?php
include_once '../config/database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$msg = "";

if($_SESSION['username'] != TRUE){
	header("location: ../login/login.php");
	$msg = "must login first";
}
$old_username = $_SESSION['username'];
if(isset($_POST['username_submit'])){
    $username = $_POST['new_username'];
    $stmt = $conn->prepare("UPDATE `user` SET `username` = '$username' WHERE username = '$old_username'");
    $stmt->execute();
    $_SESSION['username'] = $username;
}
//$old_email = $_SESSION['email'];
if(isset($_POST['email_submit'])){
    $email = $_POST['new_email'];
    $stmt = $conn->prepare("UPDATE `user` SET `email` = '$email' WHERE `username` = '$old_username'");
    $stmt->execute();
    $_SESSION['email'] = $email;
}
if(isset($_POST['pass_submit']) && ($_POST['new_password'] == $_POST['re_password'])){
    $password = $_POST['new_password'];
    $hashed = password_hash($password , PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE `user` SET `passwd` = '$hashed' WHERE `username` = '$old_username'");
    $stmt->execute();
}
else
{
	header("Location: ../pages/profile.php");
	$msg = "passwords must match";
	die;
}
header("Location: ../pages/profile.php");
?>