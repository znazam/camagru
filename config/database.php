<?php
$host = "localhost";
$user = "root";
$pass = "zaidnazam123";

try {
    $conn = new PDO("mysql:host=$host", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS mydbpdo";
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
?>