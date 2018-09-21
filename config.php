<?php

///////// Database Details change here  ////
$dbhost_name = "127.0.0.1";
$database = "mydb";
$username = "root";
$password = "password";

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host=127.0.0.1;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage();
die();
}





/*$db_host = '127.0.0.1'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'password'; // Password
$db_name = 'mydb'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}*/

?>
