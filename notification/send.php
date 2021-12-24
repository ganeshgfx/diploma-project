<?php
function notification($user_id,$of,$for){
	$dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "project";
    $conn = mysqli_connect($dbHost,$dbUser,$dbPass);
    $db = mysqli_select_db($conn,$dbName);
    
	$array = array();
	$array['page'] = $of;
   	$array['activity'] = $for;
	$sql = 'INSERT INTO `notification`(`sr_user_id`, `notify`,`time_stamp`)VALUES ('.$user_id.",'".json_encode($array)."',current_timestamp())";
	mysqli_query($conn,$sql);
}
?>