<?php
require_once("../config/database.php");
echo "erf7tuy";
session_start();
if(!$_SESSION['username']){
	header("location: ../login/login.php");
}
if(isset($_POST['submit'])){
	    $sql = $db->prepare("DELETE FROM `images` WHERE `username` = $username ");
	}
?>