<?php
	session_start();
	include '../master.php';
	$username = $_SESSION["username"];
	$u_password = $_POST['p'];
	$sql = "select password FROM user WHERE user_id='".$username."'";
  	$result = mysqli_query($conn,$sql);
 	$row = mysqli_fetch_array($result);
  	$password = $row['password'];
 //  	echo $u_password;
 //  	echo " = >";
	// echo $password;
	// echo " - ";
	// echo $username;
	if(isset($_POST['dele'])){
		if($password == $_POST['p']) {
			$sql = "delete FROM user WHERE user_id='".$username."'";
			mysqli_query($conn,$sql);
			session_unset();
			session_destroy(); 
			setcookie($cook_user, "", time() - 3600);
			setcookie($cook_pass, "", time() - 3600);
			echo "Account Deleted";
		}
		else{
			echo "Wrong Password";
		}
	}
	if(isset($_POST['dese'])){
		if ($password == $u_password){
			$sql = "update user set enable = 0 WHERE user_id = '".$username."'";
			if (mysqli_query($conn,$sql)) {
				echo "Account Desabled";
			}
			session_unset(); 
			session_destroy(); 
			setcookie($cook_user, "", time() - 3600);
			setcookie($cook_pass, "", time() - 3600);

		}
		else{
			echo "Wrong Password";
		}
//		header("location:../login/login_page.php");
	}
?>