<?php
	session_start();
  	include '../../master.php';
  	include '../../toolbox/get_id.php';
  	include '../../toolbox/online.php';
  	include '../../notification/get.php';
  	include '../../toolbox/update_access.php';
  	date_default_timezone_set("Asia/Calcutta");
	//echo getID("ganeshgfx");
 	$username = $_SESSION["sr_user_id"];
 	$reciver =  $_REQUEST['rvname'];
 	$switch = $_REQUEST['switch'];
 	//echo($username);
 	//echo(getID($reciver));
 	// $switch = "0";
if ($switch==0){
		update_log($_REQUEST['at'],$_REQUEST['on']);
		$msg_count = 0;
	if($reciver!=""){
		$sql_chk = "select count(msg) as cntChat from chat where sr_user_id='".$username."' AND sr_receiver_id='".getID($reciver)."'";
		//echo($sql_chk);
		$result = mysqli_query($conn,$sql_chk);
			$row = mysqli_fetch_array($result);

 		$msg_count = $msg_count + number_format($row['cntChat']);

 		$sql_chk = "select count(msg) as cntChat from chat where sr_user_id='".getID($reciver)."' AND sr_receiver_id='".$username."'";
		$result = mysqli_query($conn,$sql_chk);
		$row = mysqli_fetch_array($result);

 		$msg_count = $msg_count + number_format($row['cntChat']);
 	}
 		$response = array();
 		$response['count'] = $msg_count;
 		$response['notice'] = update_notif();
 		//$response['online'] = date('d/m/y h:i:s',strtotime(online('7')));
 		$osql = "select sr_follower_id from followers where sr_user_id ='".$_SESSION["sr_user_id"]."'";
  		$oresult = mysqli_query($conn,$osql);
  		$index = 0;
  		$online = array();
  		while($orow = mysqli_fetch_array($oresult)){
 			$timedilation = abs((int)date('dmyhis',strtotime(online('chat',$orow['sr_follower_id']))) - (int)date('dmyhis'));
 			$user = mysqli_fetch_array(
					mysqli_query(
						$conn,
						"select user_id from user where sr_user_id ='".$orow['sr_follower_id']."'"
					)
			);
 			if($timedilation < 6){
 				$online[$index][$user['user_id']] = true;
 			}
 			else{
 				$online[$index][$user['user_id']] = false;
 			}
 			$index++;
 		}
 		$response['online'] = json_encode($online);
 		//$response['online'] = abs((int)date('dmyhis',strtotime(online('chat','7'))) - (int)date('dmyhis'));
 		//$response['online'] = date('d-m-y:h-i-s',strtotime(online('chat','7')))."|".date('d-m-y:h-i-s');
 		echo json_encode($response);
}
// $switch = "1";
if ($switch==1){
	$response = array();
	$index = 0;
	$sql = "select sr,sr_user_id,msg FROM chat WHERE sr_user_id='".$username."' AND sr_receiver_id='".getID($reciver)."' UNION ALL SELECT sr,sr_user_id,msg FROM chat WHERE sr_user_id='".getID($reciver)."' AND sr_receiver_id='".$username."' ORDER BY sr";
  	$result = mysqli_query($conn,$sql);
  	while($row = mysqli_fetch_array($result)){
		$msg=$row['msg'];
		$echo = "<tr id='chat_sr_".$row['sr']."''>";
		if($row['sr_user_id']==$username){
			$my = TRUE;
			$psql = "select profile_img from user where sr_user_id ='".$username."'";
			$presult = mysqli_query($conn,$psql);
			$prow = mysqli_fetch_array($presult);
			$ppic = $prow['profile_img'];
			$echo =  $echo.'<td align="right"><div><table border="0" class="chat_u">
											
											
											<tr>
												<td><p id="'.$row['sr'].'">'.$msg.'</p></td>
												<td class="dele_chat" onclick="dele_chat('.$row['sr'].')"><span>X</span></td>
											</tr>
											<tr>
												<td></td>
												<td><img class="chat_pic" src="'.$ppic.'"></td>
											</tr>
										</table></div></td>';
			
		}
		else{
			$my = FALSE;
			$psql = "select profile_img from user where sr_user_id ='".getID($reciver)."'";
			$presult = mysqli_query($conn,$psql);
			$prow = mysqli_fetch_array($presult);
			$ppic = $prow['profile_img'];
			$echo = $echo.'<td align="left"><div><table border="0" class="chat_r">
											<tr>
												<td></td>
												<td><p>'.$msg.'</p></td>
											</tr>
											<tr>
												<td><img class="chat_pic" src="'.$ppic.'"></td>
												<td></td>
											</tr>
										</table></div></td>';
			
		}
		$echo =  $echo."</tr>";

	$array = array();
    $array['id'] = $row['sr'];
    $array['my'] = $my;
    $array['msg'] = $msg;
    //$array['echo'] = $echo;
    $response[$index]= $array;
    $index++;
	}
	echo json_encode($response);

}
//echo(mysqli_error($conn));
?>