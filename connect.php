<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "pts";

	$conn = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}else{
			//echo "Connected successfully";	
		}
		return $conn;

	?>