<?php
	session_start();
  	include '../../master.php';
  	$username = $_SESSION["username"];
	$sql = "select password from user where user_id ='".$username."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
  	$password = $row['password'];
	if($password == $_POST['op'] && isset($_POST['np'])){
		//echo "Matched";
		$psql = "update user set password = '".$_POST['np']."' where user_id ='".$username."'";
		mysqli_query($conn,$psql);
		echo "Password Updated";
	}
	if($password != $_POST['op']){
		echo "Old Password not Matched";
	}
?>