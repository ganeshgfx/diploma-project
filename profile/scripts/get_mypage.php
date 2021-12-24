<?php
	session_start();
	include '../../master.php';
	include '../../toolbox/get_id.php';
	$username = $_SESSION["username"];
	$sql = "SELECT `page_name` FROM `page` WHERE `sr_user_id` = '".$_SESSION["sr_user_id"]."'";
	//$sql = "select sr_user_id from followers where sr_follower_id ='".$_SESSION["sr_user_id"]."'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		echo('<div>');

		$page=$row['page_name'];
		echo('<i class="material-icons" style="
    border-radius: 3px;
    padding: 3px;
        background-color: #4CAF50;
    color: white;
        margin-right: 4px;
">book</i>');
		echo '<span>';
		echo $page;
		echo('</span></div>');
	}
?>