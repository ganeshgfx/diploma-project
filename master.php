<?php 

	//cook
	$cook_user = "username";
	$cook_pass = "password";
	
	//DB atributes
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbName = "project";

	$conn = mysqli_connect($dbHost,$dbUser,$dbPass);
	$db = mysqli_select_db($conn,$dbName);
?>