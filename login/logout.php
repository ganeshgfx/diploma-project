<?php
	include '../master.php';
	
	session_start();
	session_unset(); 
	session_destroy(); 

	setcookie($cook_user, "", time() - 3600);
	setcookie($cook_pass, "", time() - 3600);

	header("location:login_page.php");
?>