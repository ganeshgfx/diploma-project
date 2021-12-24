<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['u'])){
		$username = $_POST['u'];
		$sql = "select user_id from user where user_id ='".$_SESSION['username']."'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
    	$id = $row['user_id'];
    	if($id != $username){
    		$sql = "update user SET user_id = '".$username."' where user_id ='".$_SESSION['username']."'";
			if(mysqli_query($conn,$sql)){
				echo('reload');
			}
    	}
	}
?>
