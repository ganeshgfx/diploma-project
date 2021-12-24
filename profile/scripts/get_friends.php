<?php
	session_start();
	include '../../master.php';
	include '../../toolbox/get_id.php';
	$username = $_SESSION["username"];
	$sql = "select sr_user_id from followers where sr_follower_id ='".$_SESSION["sr_user_id"]."'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		echo('<div class="drop_shadow">');
		$follower=$row['sr_user_id'];
		$psql = "select profile_img from user where sr_user_id ='".$follower."'";
		$presult = mysqli_query($conn,$psql);
		$prow = mysqli_fetch_array($presult);
		$ppic = $prow['profile_img'];
		echo '<img src="'.$ppic.'"></img><span>';
		echo getName($follower);
		echo('</span></div>');
	}
?>