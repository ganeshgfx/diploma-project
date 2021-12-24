<?php
	session_start();
	include '../master.php';
	$input = "";
	if(isset($_POST['u']))
		$username = $_POST['u'];
	if(isset($_POST['ps']))
		$password = $_POST['ps'];
	if(isset($_POST['n']))
		$name = $_POST['n'];
	if(isset($_POST['e']))
		$email = $_POST['e'];
	if(isset($_POST['p']))
		$phone = (int)$_POST['p'];
	if(isset($_POST['d']))
		$input = $_POST['d'];

	$date = strtotime($input);
	$date = date('d M Y',$date);
	$date = 'STR_TO_DATE("'.$date.'", "%d %M %Y")';

	if(isset($_POST['saveData']) && $_POST['saveData']=="ok"){
		// echo $username;
		// echo "\n";
		// echo $name;
		// echo "\n";
		// echo $email;
		// echo "\n";
		// echo $phone;
		// echo "\n";
		// echo date('d/M/Y', $date);
		// echo "\n";
		// echo $password;
		$sql_ins="insert into user(user_id,name,email,phone,dob,password,enable,profile_img,banner_img,desci)values('".$username."','".$name."','".$email."','".$phone."',".$date.",'".$password."',1,'noprofile.png','NULL','NULL')";
		if(mysqli_query($conn,$sql_ins)){
			echo "signup_ok";
			$sql = "select sr_user_id from user where user_id ='".$username."'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result);
  			$sr_user_id = $row['sr_user_id'];
			$folder_name="../Upload/".$sr_user_id;
			mkdir($folder_name,0777,true);	
		}
		else{
			echo "ERROR";
		}
		//header("location:..\signup\signup_b.php");
	}

	if(isset($_POST['sf']) && $_POST['sf']=="uchk"){
		$sql_chk = "select count(*) as cntUser from user where user_id='".$username."'";
		$result = mysqli_query($conn,$sql_chk);
		$row = mysqli_fetch_array($result);
 		$count = $row['cntUser'];
		if($count > 0){
			echo "sorry";
		}
		else{
			echo "ok";
		}
	}
 /*	$go=1;
	if($go==1){
	if(!preg_match('/[\'^£$%&*()}{@#~?><>,.|=_+¬-]/',(string)$username)){
		
	}
   	else{
   		header("location:signup_a.php?spacial=1");
    }
    }
    */
?>
