<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['u'])){
		$username = $_POST['u'];
    	$sql = "update user SET name = '".$username."' where user_id ='".$_SESSION['username']."'";
		if(mysqli_query($conn,$sql)){
			echo('reload');
		}
	}
?>
