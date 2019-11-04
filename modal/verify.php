<?php
set_include_path("../");
require_once("pages/checkmail.php");
include 'config/database.php';
$code_name = $_POST['Code_Name'];
$ver = $conn->prepare("SELECT email FROM user WHERE token=?");
$ver->execute(array($code_name));
$code = $ver->fetch();
var_dump($code);

// $email = $_GET['email'];
$email = $code['email'];
$ver = $conn->prepare("UPDATE user set verified = 1 WHERE email = ?");

$msg = "";
if(isset($_POST['submit']))
{
	try{
		if($code)
		{
			$ver->execute(array($email));
			header("location: /cama/index.php");
		}
		else
		{
			$_SESSION['error'] = "incorrect code... check mail";
			header("location: /cama/pages/checkmail.php");
		}
   }
   catch(PDOException $ex){
       $msg = "error";
       echo $msg;
   }
}
?>