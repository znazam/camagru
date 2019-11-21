<?php
set_include_path("../");
require_once("pages/checkmail.php");
include 'config/database.php';
$code_name = $_POST['Code_Name'];
$ver = $conn->prepare("SELECT email FROM user WHERE token=?");
$ver->execute(array($code_name));
$code = $ver->fetch();
var_dump($code);

$email = $code['email'];
$ver = $conn->prepare("UPDATE user set verified = 1 WHERE email = ?");

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
			header("location: /cama/pages/checkmail.php?error=incorrect code or didn't submit code... check mail");
		}
   }
   catch(PDOException $ex){
		echo "Error: ".$e->message();
   }
}
?>