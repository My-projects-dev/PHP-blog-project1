<?php


$host     = "localhost";
$dbName   = "blog";
$user     = "root";
$password = "";
$charset  = "utf8";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	echo "xeta";
    echo "Data baza bağlantı xətası: " . $e->getMessage();
    }
?>