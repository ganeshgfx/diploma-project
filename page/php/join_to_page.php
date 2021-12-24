<?php
	include '../../master.php';
	switch ($_POST['x']) {
		case '1':
			$sql='INSERT INTO page_followers(page_sr,user_sr) VALUES ('.$_POST['page'].','.$_POST['user'].')';
			break;
		case '-1':
			$sql='DELETE FROM `page_followers` WHERE `page_sr` = '.$_POST['page'].' AND `user_sr` = '.$_POST['user'];
			break;
		default:
			# code...
			break;
	}
	if(mysqli_query($conn,$sql)){echo("ok");}
?>