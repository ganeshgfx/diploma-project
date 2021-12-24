<?php
	session_start();
  	include '../../master.php';
  	include '../../toolbox/get_id.php';
	//echo getID("ganeshgfx");
 	$username = $_SESSION["username"];
 	$sr = $_POST['sr'];
 	$sms_sql="DELETE FROM `chat` WHERE `sr` = ".$sr;
 	//echo($sms_sql);
 	$chk_sql = mysqli_query($conn,$sms_sql);
 	if($chk_sql) {
 		echo 'ok';	
 	}
?>