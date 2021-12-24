<?php
	session_start();
	include '../../master.php';

	$sql ="SELECT page_sr FROM page WHERE sr_user_id = ".$_SESSION["sr_user_id"]." AND `visible` = 0";

	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){

		$psql = "SELECT page_name FROM page WHERE page_sr = '".$row['page_sr']."'";
		$presult = mysqli_query($conn,$psql);
		$prow = mysqli_fetch_array($presult);
		echo '<li id='.$row['page_sr'].' onclick="getMemList(this.id,'."'".$prow['page_name']."',1)".'">';
			echo '<i class="material-icons">book</i>';
			echo '<span>'.$prow['page_name']."</span>";
		echo "</li>";
	}
?>