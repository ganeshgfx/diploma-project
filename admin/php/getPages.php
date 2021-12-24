<?php
	session_start();
	include '../../master.php';
	$username = $_SESSION["username"];
	$response = array();
	$index = 0;

	$sql = "SELECT post_id FROM report ORDER BY page_id DESC";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){

		$prow = mysqli_fetch_array(
			mysqli_query(
				$conn,
				"SELECT `page_sr` FROM post WHERE `post_id` = '".$row['post_id']."'"
			)
		);
		$prow = mysqli_fetch_array(
			mysqli_query(
				$conn,
				"SELECT `page_id` FROM page WHERE `page_sr` = '".$prow['page_sr']."'"
			)
		);
		$response[$index][$prow['page_id']] = $row['post_id'];
		$index++;
	}
	$data = json_encode($response,JSON_PRETTY_PRINT); 
	echo $data;
?>