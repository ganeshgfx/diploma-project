<?php
	session_start();
	include '../master.php';
	$username = $_SESSION["username"];
	$sql = "update user set enable = 1 WHERE user_id = '".$username."'";
	mysqli_query($conn,$sql);
	header("location:../profile/profile.php");
?>