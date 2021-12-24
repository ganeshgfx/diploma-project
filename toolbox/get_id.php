<?php
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "project";
    $conn = mysqli_connect($dbHost,$dbUser,$dbPass);
    $db = mysqli_select_db($conn,$dbName);

    //this get name give id
    function getID($name){

        $conn = $GLOBALS['conn'];
        $db = $GLOBALS['db'];

    	$fsql = "select sr_user_id from user where user_id ='".$name."'";
    	$fresult = mysqli_query($conn,$fsql);
    	$frow = mysqli_fetch_array($fresult);
        
    	return($frow['sr_user_id']);
    }
    //this get id give name
    function getName($id){
        $conn = $GLOBALS['conn'];
        $db = $GLOBALS['db'];
        
        $fsql = "select user_id from user where sr_user_id ='".$id."'";
        $fresult = mysqli_query($conn,$fsql);
        $frow = mysqli_fetch_array($fresult);

        return($frow['user_id']);
    }
?>