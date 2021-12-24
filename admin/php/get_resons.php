<?php
	include '../../master.php';
	$index=0;
	$id = 
		mysqli_query(
			$conn,
			"SELECT `reason` FROM `report` WHERE `post_id` = '".$_POST['id']."'"
	);
	while($row = mysqli_fetch_array($id)){
		$response[$index] = $row['reason'];
		$index++;
		//echo($row['reason']);
	}
	echo(json_encode($response));
?>