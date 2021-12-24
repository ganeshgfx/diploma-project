<?php 
  	session_start();
  	include '../profile/get_profile_data.php';
  	$_SESSION["username"] = $username;
  	//$username = $_SESSION["username"];
  	$sql = "select enable from user where user_id ='".$username."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
  	$enable = $row['enable'];
    if($enable == "0"){
    	header("location:..\login\logout.php");
    }
    if(isset($_GET['e']) && $_GET['e']=="yes"){
    	$sql = "update user set enable = 1 where user_id ='".$username."'";
		mysqli_query($conn,$sql);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../res/css/md2.css">
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet" type="text/css" href="../css/ui.css">
	<title id="tst"><?php echo $fullname; ?></title>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link rel="stylesheet" type="text/css" href="../css/nav_bar.css">
	<link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon">
</head>
<body onload="adjust()" onresize="adjust()" id="body">
	<div class="flex_menu"><!-- id="homeP" onclick="menuBar(this.id)" -->
    	 <!-- <div class="flex_menu_div Hov_div"><a  href="#"><i class="material-icons">notifications_none</i></a></div> -->

        <!-- <div class="search_box" id="search_box" onmouseenter="showSearch('block')"onmouseleave="showSearch('none')">
          <div>
            <input type="text" id="search" oninput="search()" onclick="" style="display: none; margin:auto;height: 30px;">
            <img src="../res/ico/dock_google_search.png" class="search_ico"></img>
          </div>
          <div class="search_window">
            <div class="shadow">
              <ul id="search_result" style="display: none">
                
              </ul>
            </div>
         	</div>
        </div> -->

        <!-- <div class="flex_menu_div Hov_div"><a  href="..\page\page.php"><i class="material-icons">public</i><p>&nbsp;Home</p></a></div>
        <span>|</span> -->
        
        <div class="flex_menu_div Hov_div">
          <a   href="..\page\page.php">
            <i class="material-icons">attach_file</i>
            <p>&nbsp;Pages</p>
          </a>
        </div>
        <span>|</span>
        <div class="flex_menu_div Hov_div "><a href="..\chat\chat.php"><i class="material-icons">chat</i><p>&nbsp;Chats</p></a></div>
        <span>|</span>
        <div class="flex_seli">
          <a href="..\profile\profile.php">
            <img <?php echo 'src="'.$_SESSION["ppic"].'"'; ?> style="border-radius: 4px">
            <p>&nbsp;Profile</p>
          </a>
        </div>
        <span>|</span>
        <div class="flex_menu_div Hov_div"><a href="..\login\logout.php"><i class="material-icons">power_settings_new</i><p>&nbsp;LogOut</p></a></div>    	  
    </div>
	<table border="0" id="tbl_bd" class="BODYtable">
		<!-- menu  bar -->
		<tr class="tr_top">
			<td class="td_menu">
		
			</td>
		</tr>
		<!-- profile thing  -->
		<tr class="tr_profile_area">
			<td align="center"><div id="profile_table">
				<table border="0">
					<tr>
						<td colspan="" align="center">
							<div class="Profileimg">
							<img class="Profileimg_spl"  <?php echo'src="'.$ppic.'"' ?> align="center">
						</div>
						</td>
					</tr>
					<tr>
						<td align=" center" id="profile_name">
							<p><?php echo $fullname; ?></p>
							<span style="color:#464646;font-style: italic;">#<?php echo $username; ?></span>
						</td>
					</tr>
					<tr>
						<td>
						<div class="profile_btn" >
							<button onclick="showFollowing()" style="border-radius: 100px 2px 2px 100px;">Following <span class="count"><?php echo $follow_count; ?></span></button>
							<button onclick="showFollower()">Follower <span class="count"><?php echo $following_count; ?></span></button>
							<button onclick="showMypage()">Page Created <span class="count"><?php echo $mypage_count; ?></span></button>
							<button onclick="showPage()" style="border-radius: 2px 100px 100px 2px;">Page Followed <span class="count"><?php echo $page_count; ?></span></button>
						</div>
					</td>
					</tr>
					<tr>
						<td align="Center" style="display: flex;">
							<span style="margin-left: auto;" class="material-icons-outlined">emoji_symbols</span>&nbsp;<span style="margin-top: auto;margin-bottom: auto;margin-right: auto;">
							<u> Bio </u></span>
						</td>
					</tr>
					<tr>
						<td align="center"><pre><?php echo $desci ?></pre></td>
					</tr>
<!-- 					<tr>
						<td style="display: flex;"><span class="material-icons-outlined">recent_actors</span>&nbsp;<u style="margin-top: auto;margin-bottom: auto;">Contact information:</u></td>
					</tr> -->
					<tr>
						<td style="display: flex;">
							<span class="material-icons-outlined">email</span>&nbsp;<span style="margin-top: auto;margin-bottom: auto;">Email: <?php echo $email ?></span>
						</td>
					</tr>
					<tr>
						<td  style="display: flex;">
							<span class="material-icons-outlined">call</span>&nbsp;<span style="margin-top: auto;margin-bottom: auto;">Phone: <?php echo $phone ?></span>
						</td>
					</tr>
				</table>
			</div>
			<div id="changePass" style="display: none">
				<table class="del_accnt" border="0" >
				<tr align="center">
					<td>Old Password</td>
					<td><input id="old_pass" class="psd_input" type="text" placeholder="" name="" required></td>
				</tr>
				<tr align="center">
					<td>New Password</td>
					<td><input id="new_pass" class="psd_input" type="text" placeholder="" name="" required></td>
				</tr>
				<tr  align="center">
					<td>Confirm Password</td>
					<td><input id="onf_pass" class="psd_input" type="text" placeholder="" name="" required></td>
				</tr>
				<tr  align="center">
					<td  colspan="2">
					<div class="profile_btn">
						<input id="file_name" type="button" class="btn" value="Change" onclick="change_password()">
					</div></td>
				</tr>
			</table>
</div>
			<div style="display: none" id="update_contact">
				<table class="del_accnt" border="0">

				<tr>
					<td colspan="2" align="center">Update Contact</td>
				</tr>

				<tr  align="center" style="display: none">
					<td>Old Number</td>
					<td><input id="old_num"  class="psd_input" type="number" placeholder="" name="" required>

					</td>
				</tr>

				<tr  align="center" >
					<td>New Number</td>
					<td><input id="new_num" class="psd_input" type="number" placeholder="" name="" required>
					<input class="tr_optionx" onclick="cng_contact(true)" type="submit" class="btn" value="SAVE" name="dele"></td>
				</tr>

				<tr  align="center" style="display: none">
					<td>Old Email</td>
					<td><input id="old_email" class="psd_input" type="text" placeholder="" name="" required></td>
				</tr>

				<tr  align="center">
					<td>New Email</td>
					<td><input id="new_email" class="psd_input" type="email" placeholder="" name="" required>
						<input class="tr_optionx" onclick="cng_contact(false)" type="submit" class="btn" value="SAVE" name="dele"></td>
				</tr>

				<tr  align="center" style="display: none">
				<td  colspan="2"><div class="profile_btn"><input onclick="cng_contact()" type="submit" class="btn" value="SAVE" name="dele">
					</div>
				</td>
				</tr>
				<tr>
					<td colspan="2"><div class="already">Leave Empty and Save To Remove Number or Email</div></td>
				</tr>
			</table>
			</div>
			<div id="delete_tbl" style="display: none">
				<table class="del_accnt" border="0" >
				<tr align="center">
					<td class="Profileimg" colspan="2">
									<img  <?php echo'src="'.$ppic.'"' ?> align="center">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">Delete Account ?</td>
				</tr>

				<tr  align="center">
					<td>Confirm Password</td>
					<td><input id="pass_del" class="psd_input" type="text" placeholder="" name="" required></td>
				</tr>

				<tr  align="center">
					<td  colspan="2"><div id="delbtn" class="profile_btn"><input onclick="goodbye_delete(true)" type="submit" class="btn" value="DELETE" name="dele"></div></td>
				</tr>

				<tr  align="center">
					<td  colspan="2">Disable your Account?</td>
				</tr>

				<tr  align="center">
					<td  colspan="2"><div class="profile_btn"><input onclick="goodbye_delete(false)" type="submit" class="btn" value="DISABLE" name="dele"></div></td>
				</tr>

				<tr>
					<td colspan="2" align="center">Note: Account will Be Inactive<br>Till Next Login.</td></td>
				</tr>

			</table>
</div>
<div id="update_avatar" style="display: none">
				<table class="del_accnt" border="0" >
				
				<tr align="center">

					<td class="Profileimg" colspan="2">
						<button class="Profileimg_spl_up" onclick="upload_avatar()">
							<img id="change_pic_disp" src="../res/ico/upload.png" align="center"></img>
							<span>Change profile</span>
						</button>
						<img id="pimg" class="Profileimg_spl"  <?php echo'src="'.$ppic.'"' ?> align="center" ></img>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center">
						<div id="bttnU" class="profile_btn" style="display: none">
							<input type="button" name="" value="Change Profile" onclick="do_pic_upload()">
						</div>
						<span id="progress_up" class="already" style="display: none"></span>
					</td>
				</tr>
				<tr  align="center" >
					<td>New User ID</td>
					<td><input id="new_id" class="psd_input" type="text" oninput="check_user()"></input>
					<button class="tr_optionx" onclick="cng_id()">SAVE</button>
					</td>
				</tr>
				<tr  align="center">
					<td>New Name</td>
					<td><input id="new_name" class="psd_input" type="text">
					<button class="tr_optionx" onclick="cng_name()">SAVE</button>
					</td>
				</tr>
				<tr  align="center" >
					<td>New Bio</td>
					<td><textarea id="new_bio" class="psd_input" rows="3" cols="25"></textarea>
					<button class="tr_optionx" onclick="cng_bio()">SAVE</button>
					</td>
				</tr>
				<input onchange="" type="file" id="avatar" accept="image/png, image/jpeg" style="display: none;color:  #ffffff00;background-color: #ffffff00;border: hidden;">
			</table>
</div>
			</td>
		</tr>
	</table>

	<div id="myModal" class="modal">
  		<div class="modal-content">
    		<div class="modal-header">
      			<span>
      				<span id="modaltitle">Follower</span>
      				<span class="close material-icons" onclick="closeFollower()">highlight_off</span>
      			</span>
    		</div>
    		<div class="modal-body">
      			<div class="modal_scrl">
      				<div class="modal_scrl_cnt" id="follow_list">
      				</div>
      			</div>
    		</div>
 		</div>
	</div>
				<div id="Clicked" style="display: none">
					<button style="border-radius: 100px 2px 2px 100px;" onclick="showSettings(false)">Close</button>
					<button onclick="next_AVATAR()">Update Profile</button>
					<button onclick="SetUpdateC()">Update Contacts</button>
					<button onclick="Change_Pass()">Reset Password</button>
					<button style="border-radius: 2px 100px 100px 2px;" onclick="SetDelet()">Delete Account</button>
				</div>
	<div class="tr_option" id="notClicked">
		<div onclick="showSettings(true)">
			<span class="material-icons">settings</span>
			<span>Settings</span>
		</div>
	</div>
<script src="../js-libs/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="../js-libs/anime.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script> -->

	<script defer src="profile.js"></script>
</body>
</html>
