<?php
	session_start();
	include '../../master.php';
	$username = $_SESSION["username"];


	$sql = "select sr_follower_id from followers where sr_user_id ='".$_SESSION["sr_user_id"]."'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		$follower=$row['sr_follower_id'];
		$psql = "select user_id,profile_img from user where sr_user_id ='".$follower."'";
		$presult = mysqli_query($conn,$psql);
		$prow = mysqli_fetch_array($presult);
		$ppic = $prow['profile_img'];

		echo '<li><button id="'.$prow['user_id'].'_u" value="'.$prow['user_id'].'" onclick="setreciver(this.value,this.id,'.$row['sr_follower_id'].')"><img id ="'.$prow['user_id'].'_upic" class="Followimg" src="'.$ppic.'" id="friend_pic_'.$prow['user_id'].'">';
		echo '<span>'.$prow['user_id'].'</span></button></li>';
	}
?>