<?php
session_start();
$_SESSION['uid']= NULL;
header("location: /cama/index.php");
?>