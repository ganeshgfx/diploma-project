<?php
	session_start();
    include '../../master.php';
    $username = $_SESSION["username"];
    $flw_user = $_GET['flw_user'];

    if($_GET['flw_flag']=="f"){
    	$sql = "insert INTO followers(sr_user_id,sr_follower_id) VALUES ('".$_SESSION["sr_user_id"]."','".$flw_user."')";
    }
    if($_GET['flw_flag']=="u"){
    	$sql = "delete FROM followers WHERE sr_user_id='".$_SESSION["sr_user_id"]."' AND sr_follower_id='".$flw_user."'";
    }
    if(mysqli_query($conn,$sql)){
        echo('ok');
    }
?>