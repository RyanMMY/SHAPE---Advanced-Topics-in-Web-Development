<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "ATWD";

$conn = new mysqli($hostname, $username, $password, $db);
if ($conn->connect_error) die ("Fatal Error");

mysqli_query($conn, "SET NAMES 'utf8'");
			 
?>
