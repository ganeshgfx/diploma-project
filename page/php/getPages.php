<?php
	session_start();
	include '../../master.php';
	$username = $_SESSION["username"];

	$sql = "SELECT page_sr FROM page_followers WHERE user_sr =".$_SESSION["sr_user_id"];
	$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){

	$go = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT COUNT(page_sr) FROM page WHERE page_sr = '.$row['page_sr'].' AND `visible` = 0'
		)
	);
	if($go['COUNT(page_sr)']!=0){
		$psql = "SELECT page_name FROM page WHERE page_sr = '".$row['page_sr']."'";
		$presult = mysqli_query($conn,$psql);
		$prow = mysqli_fetch_array($presult);
		echo '<li id='.$row['page_sr'].' onclick="getMemList(this.id,'."'".$prow['page_name']."',0)".'">';
			echo '<i class="material-icons">book</i>';
			echo '<span>'.$prow['page_name']."</span>";
		echo "</li>";
	}
}
?>
