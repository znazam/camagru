<?php
require('config/credentials.php');
$conn = null;
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
?>