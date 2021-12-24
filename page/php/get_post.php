<?php
session_start();
include '../../master.php';
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Calcutta");

if($_REQUEST['switch']=="post"){

	$response = array();

	$cc='SELECT COUNT(`comment`) FROM `post_data_comment` WHERE `post_id` = '.$_REQUEST['pid'];
	$cresult = mysqli_query($conn,$cc);
	$cmt_cnt = mysqli_fetch_array($cresult);

	$mycomt='SELECT COUNT(`comment`) FROM `post_data_comment` WHERE `post_id` = '.$_REQUEST['pid'].' AND sr_user_id = '.$_SESSION["sr_user_id"];
	$mycomt_result = mysqli_query($conn,$mycomt);
	$mycomt_row = mysqli_fetch_array($mycomt_result);
	$cclass = $mycomt_row['COUNT(`comment`)'];
	$cclass = 'post_comnt';
	if($mycomt_row['COUNT(`comment`)']>'0'){
		$cclass = 'post_comnt2';
		$commented= true;
	}


	$sql = "select * FROM post where page_sr = ".$_REQUEST['selected_page']." AND post_id = ".$_REQUEST['pid'];
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	$array = array();
	$array['type'] = $row['type'];
	$file_name = "";
	$file_type = substr($row['type'],0,5);
	$ico = "";
	if($row['path']!="NULL"){
		$f = $row['path'];
		$i=0;
		while($f[$i].$f[$i+1].$f[$i+2].$f[$i+3].$f[$i+4].$f[$i+5]!='_file_'){
			$i++;
		}
		$file_name = substr($row['path'],$i+6);
		if($file_type=='video'){
			$ico = "videocam";
		}
		if($file_type=='audio'){
			$ico = "volume_up";
		}
	}
	$play_button='
		<div class="play_box" id="ply_'.$row['post_id'].'">
			<button id="playBTN_'.$row['post_id'].'" onclick="play('.$row['post_id'].')" class="play_button">
				<i class="material-icons play_button_i">play_circle_filled</i><span>Play</span>
			</button>
			<span class="play_box_file"><i class="material-icons">'.$ico.'</i><span>'.$file_name.'</span></span>
		</div>';
	switch($file_type){
		case 'video':
			$media = '<video id="play_'.$row['post_id'].'" style=" display: none;" controls><source src="'.$row['path'].'" type="'.$row['type'].'"></video>';
			break;
		case 'audio':
			$media = '<audio id="play_'.$row['post_id'].'" style=" display: none;" controls><source src="'.$row['path'].'"type="'.$row['type'].'"></audio>';
			break;
		case 'image':
			$media = '<img src="'.$row['path'].'"></img>';
			$play_button='';
			break;
		default:
			$media = '';
			$play_button='';
			break;
	}
	//select user name
	$sql = "select name FROM user where sr_user_id = ".$row['sr_user_id'];
	$sender_name = mysqli_fetch_array(mysqli_query($conn,$sql));
	//select profile
	$psql = "select profile_img from user where sr_user_id ='".$row['sr_user_id']."'";
	$presult = mysqli_query($conn,$psql);
	$prow = mysqli_fetch_array($presult);
	$ppic = $prow['profile_img'];
	//select pst data
	$liked = false;
	$commented= false;
	$saved= false;
	$rated= false;

	$plike = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT COUNT(post_like) FROM post_data WHERE (NOT post_like=0) and post_id = '.$row['post_id'] 
		)
	);
	$lv = 1;
	$ps = 1;
	$ps_bg = "";
	$myData = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT * FROM post_data WHERE post_id = '.$row['post_id'].' AND sr_user_id = '.$_SESSION["sr_user_id"]
		)
	);
	$lclass='post_like';
	if($myData['post_like']=='1'){
		$lv = 0;
		$ps_bg = "";
		$lclass='post_like2';
		$liked = true;
	}
	$rclass='post_rte';
	if($myData['rate']>'0'){
		$rclass='post_rte2';
		$rated= true;
	}
	$sclass='post_sav';
	if($myData['save']=='1'){$ps = 0;$sclass='post_sav2';$saved= true;}
	$prate = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT AVG(`rate`) FROM `post_data` WHERE NOT `rate` = 0 AND `post_id` = '.$row['post_id']
		)
	);
	//chk my post
	$my_post = mysqli_fetch_array(
		mysqli_query(
			$conn,
			'SELECT COUNT(sr_user_id) FROM post WHERE post_id = '.$row['post_id'].' AND sr_user_id = '.$_SESSION['sr_user_id']
		)
	);
	$post_my = false;          				
	$post_delete = '';
	$post_report = '<li onclick="post_report('.$row['post_id'].')">
                					<span class="material-icons-outlined">notification_important</span>
                					<span>Report</span>
                				</li>';
	if($my_post['COUNT(sr_user_id)'] == '1'){
		$post_my = true;
		$post_delete = '<li onclick="post_delete('.$row['post_id'].')" id="delete">	
                					<span class="material-icons-outlined">delete_forever</span>
                					<span>Delete</span>
                				</li>';
        $post_report = '';
	}
	//echo
		$response[1]='
		<table align="center" border="0" class="post_table" id="postT_'.$row['post_id'].'">
            <tr>
                <td colspan="4" class="post_title_bar">
                	<img class="post_sender_img" src="'.$ppic.'"></img>
                	<span style="font-size: small;margin-left: 3px;">'.date("d/m/Y", strtotime($row['date'])).'/'.$sender_name['name'].'/</span>
                	<div style="margin-left: auto;">
                	</div>
                	<div onclick="post_option('.$row['post_id'].')" style="flex-flow: row-reverse;display: flex;">
                		<span style="font-size: medium;" class="material-icons post_option_ico drop_shadow">settings</span>
                		<div class="post_option" id="post_option_'.$row['post_id'].'">
                			<ul>
                				'.$post_delete.'
								'.$post_report.'
                			</ul>
                		</div>
                	</div>
                </td>
           	</tr>
            <tr>
                <td colspan="4">
                	<ul>
                		<li>'.$media.''.$play_button.'</li>
                		<li class="post_txt">'.$row['msg'].'</li>
                	</ul>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" style="display: flex;">
                
                	<button onclick="postprop('.$lv.','."'like'".','.$row['post_id'].')" class='.$lclass.'>
                    	<i class="material-icons">favorite</i><span>'.$plike['COUNT(post_like)'].'</span>
                    </button>

                    <button id="post_comnt" onclick="showComment('.$row['post_id'].')" class="'.$cclass.'" style="margin-left: 2px;margin-right: 2px;">
                    	<i class="material-icons">drafts</i><span>'.$cmt_cnt['COUNT(`comment`)'].'</span>
                    </button>
                    <button onclick="showrating('.$row['post_id'].')" class="'.$rclass.'">
                    	<i class="material-icons">star</i><span>'.round((double)$prate['AVG(`rate`)']).'</span>
                    </button>
                    <div class="rating" id="rating_'.$row['post_id'].'">
						<span onclick="postprop(5,'."'rate'".','.$row['post_id'].')">☆</span>
						<span onclick="postprop(4,'."'rate'".','.$row['post_id'].')">☆</span>
						<span onclick="postprop(3,'."'rate'".','.$row['post_id'].')">☆</span>
						<span onclick="postprop(2,'."'rate'".','.$row['post_id'].')">☆</span>
						<span onclick="postprop(1,'."'rate'".','.$row['post_id'].')">☆</span>
					</div>

                <td align="right" style="margin-left: auto;">
                	<button class="'.$sclass.'" onclick="postprop('.$ps.','."'save'".','.$row['post_id'].')">
                    	<i class="material-icons">loyalty</i>
                    </button>
                </td>
           	</tr>
            <tr id="comment_box_'.$row['post_id'].'" style="flex-flow: column; display: none;">
            	<td colspan="3">
            		<ul id="comment_'.$row['post_id'].'">
            		</ul>
            	</td>
            	<td style="display: flex;">
            		<input id="comment_val'.$row['post_id'].'" class="comnt_txt PNinptBox" type="text" />
            		<button onclick="comment_send('.$row['post_id'].')" class="material-icons comnt_btn">send</button>
            	</button>
        </table>
        ';

    $array['post_id'] = $_REQUEST['pid'];
    $array['like'] = (int)$plike['COUNT(post_like)'];
    $array['comment'] = (int)$cmt_cnt['COUNT(`comment`)'];
    $array['rate'] = (int)round((double)$prate['AVG(`rate`)']);
   	$array['date'] = date("d/m/Y", strtotime($row['date']));
   	$array['save'] = $myData['save'];
   	$array['post_avatar'] = $ppic;
   	$array['my'] = $post_my;
   	$array['path'] =$row['path'];
   	$array['file_name'] =$file_name;
   	$array['msg'] = $row['msg'];
   	$array['sender_name'] = $sender_name['name'];
   	$array['liked'] = $liked;
   	$array['commented'] = $commented;
   	$array['saved'] = $saved;
   	$array['rated'] = $rated;

    $response['data']= $array;

    $data = json_encode($response); 
	echo $data;
}
if($_REQUEST['switch']=="list"){
	$index = 0;
	$response = array();
	$sql = "select * FROM post where page_sr = ".$_POST['selected_page']." AND `disable` = 0 ORDER BY post_id DESC";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		//$response[] = $row['post_id'];
		$response[$index] = $row['post_id'];
		$index++;
	}

	$data = json_encode($response); 
	echo $data;
}
?>