<?php
	session_start();
	include '../../master.php';
	include '../../toolbox/get_id.php';
	$username = $_SESSION["username"];
	$sql = "SELECT `page_sr` FROM `page_followers` WHERE `user_sr` = '".$_SESSION["sr_user_id"]."'";
	//$sql = "select sr_user_id from followers where sr_follower_id ='".$_SESSION["sr_user_id"]."'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		echo('<div>');

		$page = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT page_name FROM page WHERE page_sr = '.$row['page_sr']
			)
		);

		echo('<i class="material-icons" style="
    border-radius: 3px;
    padding: 3px;
        background-color: #4CAF50;
    color: white;
        margin-right: 4px;
        ">book</i>');
		echo '<span>';
		echo $page['page_name'];
		echo('</span></div>');
	}
?>