<?php
	session_start();
	include '../../master.php';
	include '../../toolbox/get_id.php';
	$username = $_SESSION["username"];

	$sql =  $fsql = "select user_sr from page_followers where page_sr ='".$_REQUEST['id']."'";;
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		if($row['user_sr']==$_SESSION["sr_user_id"]){
			continue;
		}
		echo '<li id = "memb_'.$row['user_sr'].'"><i class="material-icons">assignment_ind</i><span>'.getName($row['user_sr'])."</span></li>";
	}
?>
