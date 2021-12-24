<?php
	//session_start();
  	$dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "project";
    $conn = mysqli_connect($dbHost,$dbUser,$dbPass);
    $db = mysqli_select_db($conn,$dbName);
    function update_log($at,$on){
        $conn = $GLOBALS['conn'];
        $db = $GLOBALS['db'];

        //'SELECT * FROM `access_log` WHERE `sr_user_id` = 7 ORDER BY `time_stamp` DESC LIMIT 1'

        $json = '{"page":"'.$at.'","activity":"'.$on.'"}';
    	mysqli_query($conn,"INSERT INTO `access_log`(`sr_user_id`, `log`, `time_stamp`) VALUES ('".$_SESSION["sr_user_id"]."','".$json."',current_timestamp()) ON DUPLICATE KEY UPDATE log='".$json."', time_stamp=current_timestamp()");
        mysqli_query($conn,"DELETE FROM `notification` WHERE `notify` = '".$json."' AND `sr_user_id` =".$_SESSION["sr_user_id"]);
    }
?>