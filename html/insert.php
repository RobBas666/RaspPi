<?php

$hostname = "127.0.0.1";
$username = "bbd";
$password = "passwod";
$dbname = "Escape";


$dbConnected = new mysqli($hostname, $username, $password,$dbname, 3306);

if($dbConnected){
	echo "DB connection established";
}else{
	echo "Failed to establish connection";
}

?>