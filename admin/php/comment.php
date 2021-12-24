<?php
	session_start();
	include '../../master.php';
	if(isset($_POST['get'])){
		$sql = "SELECT * FROM post_data_comment WHERE `post_id` =".$_POST['id'];
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			echo("<li>");
				echo($row['comment']);
			echo("</li>");
		}
	}
	if(isset($_POST['send'])){
		$sql = "INSERT INTO `post_data_comment`(`sr_user_id`, `post_id`, `comment`, `date`)VALUES (".$_SESSION["sr_user_id"].",".$_POST['id'].",'".$_POST['comment']."',CURDATE())";
		//echo($sql);
		mysqli_query($conn,$sql);
		//echo($_POST['comment']);
	}
?>