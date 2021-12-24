 <?php
	session_start();
	include '../../toolbox/online.php';
	include '../../notification/get.php';
	include '../../toolbox/update_access.php';
	date_default_timezone_set("Asia/Calcutta");
	update_log($_REQUEST['at'],$_REQUEST['on']);
	$response['notice'] = update_notif();

	$osql = "select user_sr from page_followers where page_sr ='".$_REQUEST['on']."'";
  	$oresult = mysqli_query($conn,$osql);
  	$index = 0;
  	$online = array();
  	while($orow = mysqli_fetch_array($oresult)){
  		if($orow['user_sr'] == $_SESSION['sr_user_id']){
            continue;
        }
 		$timedilation = abs((int)date('dmyhis',strtotime(online('chat',$orow['user_sr']))) - (int)date('dmyhis'));
		if($timedilation < 6){
 			$online[$index][$orow['user_sr']] = true;
 		}
 		else{
 			$online[$index][$orow['user_sr']] = false;
 		}
 		$index++;
 	}
 	$response['online'] = json_encode($online);

 	echo json_encode($response);
?>