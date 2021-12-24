<?php
	session_start();
  	include '../../master.php';
  	$username = $_SESSION["username"];

	// $sql = "select email,phone from user where user_id ='".$username."'";
	// $result = mysqli_query($conn,$sql);
	// $row = mysqli_fetch_array($result);
 //  	$email = $row['email'];
 //  	$phone = $row['phone'];
  	if(isset($_POST['np'])){
  		$psql = "update user set phone = '".$_POST['np']."' where user_id ='".$username."'";
		mysqli_query($conn,$psql);
  	}
  	if(isset($_POST['ne'])){
		$psql = "update user set email = '".$_POST['ne']."' where user_id ='".$username."'";
		mysqli_query($conn,$psql);
	}
?>