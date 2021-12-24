<?php
session_start();
include '../../master.php';
$search = $_POST['search'];
if($search!=" "){
	if($search=="/all"){
		$search="";
	}
	$sql = "SELECT page_name,page_sr,sr_user_id FROM page WHERE `visible` = 0 AND page_name LIKE '".$search."%'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($result)){
		if($row['sr_user_id'] == $_SESSION["sr_user_id"]){
			continue;
		}
		$csql = 'SELECT COUNT(user_sr) as mem FROM page_followers WHERE page_sr = '.$row['page_sr'];
		$cresult = mysqli_query($conn,$csql);
		$crow = mysqli_fetch_array($cresult);

		$psql = 'SELECT COUNT(user_sr) as unjoin FROM page_followers WHERE page_sr = '.$row['page_sr'].' AND user_sr = '.$_SESSION["sr_user_id"];
		$presult = mysqli_query($conn,$psql);
		$prow = mysqli_fetch_array($presult);

		if($prow['unjoin']=="1"){
			$button = '<button onclick="join_to_page('.$row['page_sr'].','.$_SESSION["sr_user_id"].',-1)" style="margin-top: auto;margin-bottom: auto;margin-left: auto;" class = "join_button">
			<i class="material-icons">clear</i>
			</button>';
		}else{
			$button = '<button onclick="join_to_page('.$row['page_sr'].','.$_SESSION["sr_user_id"].',1)" style="margin-top: auto;margin-bottom: auto;margin-left: auto;" class = "join_button">
			<i class="material-icons">add</i>
			</button>';
		}

		echo('
    	<li>
        <img src="../res/ico/bookmarks3.png" class="img">
        <div style="display: flex;flex-flow: column;}">
            <span class="mdl-color-text--black">'.$row['page_name'].'</span>
            <i class="mdl-color-text--black" style="font-size: smaller;">'.$crow['mem'].' Members</i>
        </div>
        '.$button.'
   		</li>'
    );
	}
}
?>