<?php
	//session_start();
  	$dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "project";
    $conn = mysqli_connect($dbHost,$dbUser,$dbPass);
    $db = mysqli_select_db($conn,$dbName);
function update_notif(){
	$conn = $GLOBALS['conn'];
    $db = $GLOBALS['db'];
	$array = array();
	$index = 0;
	$sql = 'SELECT `notify` FROM `notification` WHERE `sr_user_id` = '.$_SESSION["sr_user_id"];
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		$temp = array();
		$temp = json_decode($row['notify'],true);
		//echo($row['notify']);
		if($temp['page']=="page"){
			$nsql = 'SELECT `page_name` FROM `page` WHERE `page_sr` ='.$temp['activity'];
			$nresult = mysqli_query($conn,$nsql);
			$nrow = mysqli_fetch_array($nresult);
			$dat['by'] = $nrow['page_name'];
		}
		if($temp['page']=="chat"){
			$nsql = 'SELECT `user_id` FROM `user` WHERE `sr_user_id` ='.$temp['activity'];
			$nresult = mysqli_query($conn,$nsql);
			$nrow = mysqli_fetch_array($nresult);
			$dat['by'] = $nrow['user_id'];
		}
		$dat['page'] = $temp['page'];
		$dat['activity'] = $temp['activity'];
		$array[$index] = $dat;
		$index++;
	}
	return json_encode($array);
}
?>