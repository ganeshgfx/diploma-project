<?php
	session_start();
  	include '../../master.php';
  	include '../../toolbox/get_id.php';
  	include '../../notification/send.php';
 	$username = $_SESSION["username"];
 	$sms = $_POST['sms'];
 	$reciver = $_POST['reciver'];
 	$sms_sql="insert INTO chat(sr_user_id,sr_receiver_id,msg,date,rr)VALUES ('".getID($username)."','".getID($reciver)."','".$sms."',NOW(),0)";
 	$chk_sql = mysqli_query($conn,$sms_sql);
 	if($chk_sql) {
 		notification(getID($reciver),'chat',$_SESSION["sr_user_id"]);
 		//echo $sms.' sent to '.$reciver;	
 	}
?>