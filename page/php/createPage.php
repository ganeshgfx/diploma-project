<?php
	session_start();
	include '../../master.php';
	
	$sql="insert INTO page(
		page_id,
		page_name,
		date,
		sr_user_id,
		info,
		type
		)
		VALUES('".$_POST['pi']."','".$_POST['pn']."',CURDATE(),".$_SESSION["sr_user_id"].",'".$_POST['info']."','".$_POST['type']."')";
	mysqli_query($conn,$sql);
?>