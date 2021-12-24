<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['delete'])){
		$sql = "UPDATE post set `disable` = 1 WHERE `post_id` =".$_POST['id'];
		mysqli_query($conn,$sql);
	}
	if(isset($_POST['report'])){
		$sql = "INSERT INTO `report` (`reporter_id`, `post_id`, `reason`,`page_id`) 
				VALUES ('".$_SESSION['sr_user_id']."', '".$_POST['id']."', '".$_POST['reason']."','".$_POST['selected_page']."')";
		//echo $sql;
		if(mysqli_query($conn,$sql)) {
			echo('ok');
		}
		else{
			echo(mysqli_error($conn));
		}
	}
?>