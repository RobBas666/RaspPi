<?php

$hostname = "127.0.0.1";
$username = "bbd";
$password = "password";

$dbConnected = mysql_connet($hostname, $username, $password);

if($dbConnected){
echo "DB connection established<br />";
}else{
echo "Failed to establish connection";
}

?>