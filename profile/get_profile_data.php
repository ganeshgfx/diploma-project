<?php
	include '../master.php';
  	$username = $_SESSION["username"];

  //db part
  	$sql = "select sr_user_id,name,phone,dob,email,profile_img,desci from user where user_id ='".$username."'";
  	$result = mysqli_query($conn,$sql);
 	$row = mysqli_fetch_array($result);

  	$fullname = $row['name'];
    $sr_user_id = $row['sr_user_id'];
	 $phone = $row['phone'];
  	$email = $row['email'];
  	$date = $row['dob'];
  	$ppic = $row['profile_img'];
  	$desci = $row['desci'];

  	if(isset($_GET['account'])){
    	if ($_GET['account']=="disable"){
      		$msg1_flag=1;
      		$msg1='<a class="already" href="../del/enable_acc.php">*This Account has been disabled Click Here to enable it.</a>';
    	}
  	}
  	else{
    	$msg1_flag=0;
    	$msg1="";
  	}
    $follow_count = mysqli_fetch_array(
    mysqli_query(
      $conn,
      'SELECT COUNT(`sr_follower_id`) FROM `followers` WHERE `sr_user_id` = '.$_SESSION["sr_user_id"]
      )
    );
    $follow_count = $follow_count['COUNT(`sr_follower_id`)'];

    $following_count = mysqli_fetch_array(
    mysqli_query(
      $conn,
      'SELECT COUNT(`sr_user_id`) FROM `followers` WHERE `sr_follower_id` = '.$_SESSION["sr_user_id"]
      )
    );
    $following_count = $following_count['COUNT(`sr_user_id`)'];

    $mypage_count = mysqli_fetch_array(
    mysqli_query(
      $conn,
      'SELECT COUNT(`page_sr`) FROM `page` WHERE `sr_user_id` = '.$_SESSION["sr_user_id"]
      )
    );
    $mypage_count = $mypage_count['COUNT(`page_sr`)'];

    $page_count = mysqli_fetch_array(
    mysqli_query(
      $conn,
      'SELECT COUNT(`page_sr`) FROM `page_followers` WHERE `user_sr` = '.$_SESSION["sr_user_id"]
      )
    );
    $page_count = $page_count['COUNT(`page_sr`)'];
?>