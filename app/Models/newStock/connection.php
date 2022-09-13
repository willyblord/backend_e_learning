<?php
$host = "localhost";
$db = "laravel";
$charset = "utf8";
$username = "root";
$password = "";
try{
$db = new PDO("mysql:host=".$host."; dbname=".$db."; charset=".$charset, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(exception $ex){
die("Error : " . $ex->getMessage());
}
?>