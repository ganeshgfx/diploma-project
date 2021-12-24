<?php
	session_start();
	include '../master.php';
	$username = "";
	$password = "";
	if(isset($_COOKIE[$cook_user]) && isset($_COOKIE[$cook_pass])){
		$username = $_COOKIE[$cook_user];
		$password = $_COOKIE[$cook_pass];
	}
	if(isset($_POST['u']) && isset($_POST['p'])){
		$username = $_POST['u'];
		$password = $_POST['p'];
		setcookie($cook_user,$username);
		setcookie($cook_pass,$password);
	}
	$sql = "select count(*) as cntUser from user where user_id ='".$username."' and password ='".$password."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $count = $row['cntUser'];
	if($count > 0){
		$sql = "select enable from user where user_id ='".$username."'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
  		$enable = $row['enable'];
  		////////////////////////////////////////////////
  		  	$sql = "select sr_user_id,name,phone,dob,email,profile_img,desci from user where user_id ='".$username."'";
  			$result = mysqli_query($conn,$sql);
 			$row = mysqli_fetch_array($result);
  		///////////////////////////////////////////////
    	//Session name Vars

    	$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["ppic"] = $row['profile_img'];
		$_SESSION["sr_user_id"] = $row['sr_user_id'];
    	if($enable == "0"){
    		$login = "Desabled";
			echo $login;
    	}
    	else{
			$login = "valid";
			echo $login;
    	}
	}
	else{
		$login = "invalid";
		echo $login;
	}
	if(isset($_GET['index']) && $_GET['index']=="yes"){
		if($login == "valid"){
			header("location:../profile/profile.php");
		}
		else{
			header("location:login_page.php");
		}
	}
	// else {
	// 	if($_GET['index']=="yes") {
	// 		header("location:login_page.php");
	// 	}
	// 	else{
	// 		$invalid = "yes";
	// 		header("location:login_page.php?invalid=".$invalid);
	// 	}
	// }
?>