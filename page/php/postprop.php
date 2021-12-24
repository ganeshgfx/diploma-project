<?php
	session_start();
	include '../../master.php';
	$post_like = '0';
	$rate = '0';
	$comment = "";
	$save = "0";

	if(isset($_REQUEST['like'])){
		//echo($_REQUEST['like']);
		$post_like = $_REQUEST['like'];
		$values ='`post_like`='.$post_like;
	}
	if(isset($_REQUEST['rate'])){
		//echo($_REQUEST['rate']);
		$rate = $_REQUEST['rate'];
		$values='`rate`='.$rate;
	}
	if(isset($_REQUEST['comment'])){
		//echo($_REQUEST['comment']);
		$comment = $_REQUEST['comment'];
	}
	if(isset($_REQUEST['save'])){
		//echo($_REQUEST['save']);
		$save = $_REQUEST['save'];
    	$values='`save`='.$save;
	}
	$Csql = 'SELECT COUNT(post_id) as chech FROM post_data WHERE post_id = '.$_REQUEST['id'].' AND sr_user_id = '.$_SESSION["sr_user_id"];
	$Cresult = mysqli_query($conn,$Csql);
	$Crow = mysqli_fetch_array($Cresult);

	//echo($Crow['chech']);
	if($Crow['chech'] == '0'){
		$sql = 'INSERT INTO
			`post_data`(
        		`sr_user_id`, `post_id`, `rate`, `post_like`, `save`
    		)VALUES(
        		'.$_SESSION["sr_user_id"].',
        		'.$_REQUEST['id'].',
        		'.$rate.',
        		'.$post_like.',
        		'.$save.'
    		)';
	}
	else{
		$sql = 'UPDATE `post_data` 
			SET
    			'.$values.'
			WHERE post_id = '.$_REQUEST['id'].' AND sr_user_id = '.$_SESSION["sr_user_id"];
	}
	//echo($sql);

    if(mysqli_query($conn,$sql)){echo("ok");}
	//echo(mysqli_error($conn));
?>