<?php
	session_start();
	include '../../master.php';
	include '../../notification/send.php';
	date_default_timezone_set("Asia/Calcutta");
	//echo($_SESSION["sr_user_id"]);
	//echo($_POST['selected_page']." | "); 
	//echo($_POST['post_title']." | "); 
	//echo(isset($_FILES["post_file"]["name"])." | "); 
	//echo($_POST['post_file_type']." | "); 
	//echo($_POST['post_msg']." | "); 
	//echo($_POST['post_tags']." | "); 
	$post_file_type = "NULL";
	$loc = "NULL";
	$post_tags = "NULL";
	if(isset($_POST['post_tags'])){
		$post_tags=$_POST['post_tags'];
	}
	if(isset($_FILES["post_file"]["name"])){
		$post_file_type = $_POST['post_file_type'];
		$target_dir = "../../Upload/".$_SESSION["sr_user_id"]."/";
		$file_name = date("M_d_Y")."_at_".date("h_i_a")."_file_".basename($_FILES["post_file"]["name"]);
		$target_dir = $target_dir.$file_name;
		//echo($target_dir);
		if(move_uploaded_file($_FILES["post_file"]["tmp_name"],$target_dir)){
			$loc = "../Upload/".$_SESSION["sr_user_id"]."/".$file_name;
        }
	}
	$sql_upld = "insert INTO `post`(`page_sr`, `sr_user_id`, `path`, `type`, `msg`, `date`, `tags`)
	VALUES (
		".$_POST['selected_page'].",
		".$_SESSION["sr_user_id"].",
		'".$loc."',
		'".$post_file_type."',
		'".$_POST['post_msg']."',
		CURDATE(),
		'".$post_tags."'
	);";
	//echo($sql_upld.">>>>>>");
	if(mysqli_query($conn,$sql_upld)){
  		echo("ok");
	}

	$sql = "SELECT `user_sr` FROM `page_followers` WHERE `page_sr` = '".$_POST['selected_page']."'";
	$result = mysqli_query($conn,$sql);
	$json = '';
	$nsql = '';
  	while($row = mysqli_fetch_array($result)){
  		notification($row['user_sr'],'page',$_POST['selected_page']);
  	}
	//echo(mysqli_error($conn));
?>