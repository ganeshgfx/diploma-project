<?php
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "project";
    $conn = mysqli_connect($dbHost,$dbUser,$dbPass);
    $db = mysqli_select_db($conn,$dbName);

    function online($page,$id){
        $conn = $GLOBALS['conn'];
        $db = $GLOBALS['db'];

        $plike = mysqli_fetch_array(
            mysqli_query(
                $conn,"SELECT * FROM `access_log` WHERE `sr_user_id` = '".$id."' ORDER BY `time_stamp` DESC LIMIT 1"));
        return $plike['time_stamp'];
    }
?>