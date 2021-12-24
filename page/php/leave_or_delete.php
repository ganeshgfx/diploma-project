<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['leave'])){
		$sql = "DELETE FROM `page_followers` WHERE `page_sr` = '".$_POST['selected_page']."' AND `user_sr` = '".$_SESSION["sr_user_id"]."'";
		if(mysqli_query($conn,$sql)){
			echo("ok");
		}
	}
	if(isset($_POST['delete'])){
		$sql = "UPDATE page set `visible` = 1 where `page_sr` = '".$_POST['selected_page']."' AND `sr_user_id` = '".$_SESSION["sr_user_id"]."'";
		if(mysqli_query($conn,$sql)){
			echo("ok");
		}
	}
?>