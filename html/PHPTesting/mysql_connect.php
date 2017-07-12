<?php

$hostname = "127.0.0.1";
$username = "bbd";
$password = "password";

$databasename = "Escape";

$dbConnected = mysql_connection($hostname, $username, $password);

if ($dbConnected){
	echo "Db connection established<br />";
}else{
	echo "Failed to connect to DB";
}

?>