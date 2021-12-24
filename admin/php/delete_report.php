<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['delete'])){
		$sql = "UPDATE post set `disable` = 1 WHERE `post_id` =".$_POST['id'];
		mysqli_query($conn,$sql);
		$sql = "DELETE FROM `report` WHERE `post_id` = ".$_POST['id'];
		mysqli_query($conn,$sql);
	}
	if(isset($_POST['keep'])){
		$sql = "DELETE FROM `report` WHERE `post_id` = ".$_POST['id'];
		mysqli_query($conn,$sql);
	}
?>