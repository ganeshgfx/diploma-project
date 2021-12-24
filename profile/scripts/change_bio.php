<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['u'])){
		$bio = $_POST['u'];
    	$sql = "update user SET desci = '".$bio."' where user_id ='".$_SESSION['username']."'";
		if(mysqli_query($conn,$sql)){
			echo('reload');
		}
	}
?>
