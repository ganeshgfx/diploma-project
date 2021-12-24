<?php
session_start();
?>
<script type="text/javascript">
  var current_page = 'chat';
  var my_profile = <?php echo '"'.$_SESSION["ppic"].'"'; ?>;
  var reciver_profile = '';
</script>
<html>
  <head>
    <title id="title_name">Chats</title>
    <link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon">
    <link rel="stylesheet" type="text/css" href="../res/css/md2.css">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Sharp|Material+Icons+Round|Material+Icons+Two+Tone">-->
    <link rel="stylesheet" type="text/css" href="../css/ui.css">
    <link rel="stylesheet" type="text/css" href="../css/material.min.css">
    <link rel="stylesheet" type="text/css" href="chat.css">
    <link rel="stylesheet" type="text/css" href="../css/nav_bar.css">
    <meta charset='utf-8'></meta>
  </head>
  <body onresize="adjust()" id="body">
    <div class="full_body">
      <div class="nav_body">
        <div class="flex_menu"><!-- id="homeP" onclick="menuBar(this.id)" -->
        <div class="flex_menu_div" id="ring_bell">
          <a id="ring_bell_data">
            <i class="material-icons">notifications_none</i>
          </a>
          <div class="notif shadow div_anime" id="notif" style="max-height:0%;">
            <ul id="notif_data">
            </ul>
          </div>
        </div>
        <div class="search_box" id="search_box" onmouseenter="showSearch('block')"onmouseleave="showSearch('none')">
          <div>
            <input type="text" id="search" oninput="xsearch(this.value)" onclick="" style="display: none; margin:auto;height: 30px;"><!-- Show_doSearch() -->
            <img src="../res/ico/dock_google_search.png" class="search_ico"></img>
          </div>
          <!-- search body -->
          <div class="search_window" id="search_result">
            <div class="search_window_scroll">
              <ul id="search_result_user" class="shadow search_result_user" style="display: block">
              </ul>
            </div>
          </div>
        </div>
        <!-- <div class="flex_menu_div Hov_div"><a  href="..\page\page.php"><i class="material-icons">public</i><p>&nbsp;Home</p></a></div>
        <span>|</span> -->
        
        <div class="flex_menu_div Hov_div">
          <a   href="..\page\page.php">
            <i class="material-icons">attach_file</i>
            <p>&nbsp;Pages</p>
          </a>
        </div>
        <span>|</span>
        <div class="flex_seli"><a><i class="material-icons">chat</i><p>&nbsp;Chats</p></a></div>
        <span>|</span>
        <div class="flex_menu_div Hov_div">
          <a href="..\profile\profile.php">
            <img <?php echo 'src="'.$_SESSION["ppic"].'"'; ?> style="border-radius: 4px">
            <p>&nbsp;Profile</p>
          </a>
        </div>
        <span>|</span>
        <div class="flex_menu_div Hov_div"><a href="..\login\logout.php"><i class="material-icons">power_settings_new</i><p>&nbsp;LogOut</p></a></div>
      </div>
    </div>
    <div class="main_body">
      <div class="side_pane" style="display: none;">
        <span class="title_name">Online List</span>
        <div class="scroll_pane">
          <div>
            <ul><?php $i=1; while ($i <= 100){echo "<li>Things here....".$i."</li>"; $i++; }?></ul>
          </div>
        </div>
      </div>
      <div class="middle_pane">
        <span id="chat_title_name" class="title_name"  style="display: none">Select A Friend</span>
        <table align="center" class="chattable" border="0">
          <tr class="chat_box">
            <td colspan="3" align="center" >
              <div class="chat_back" id="stst">
                <div><table id="chat" class="chatlist" border="0"></table></div>
              </div>
            </td>
          </tr>
          <tr class="chat_msgbox">
            <td class="typmsg_area"><input class="typmsg" type="text" id="msg" ></td>
            <td align = "center" class="sendbtn_area">
              <button class="sendbtn" onclick="sendmsg()" id="send"><span class="material-icons">
                send
              </span></button>
            </td>
            <td id="SlBtn" class="ScrlBtn"></td>
          </tr>
        </table>
      </div>
      <div class="side_pane">
        <span class="title_name">Friends List</span>
        <div class="scroll_pane">
          <div class="Follow">
            <!-- <table align="center" class="chat_friends" border="0" id="friends_lst"></table> -->
            <ul id="friends_lst" class="flist">
              
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--  <div style="height: 6px"></div> -->
  </div>
</body>
<script src="../chat/script/chat.js" defer></script>
<script src="../js-libs/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="../js-libs/anime.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script> -->
<script src="../js-libs/material.min.js"></script>
<!-- <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script> -->
<script src="../notification/notify.js"></script>
<script src="../search/search.js"></script>
</html>