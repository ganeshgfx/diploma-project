<?php
  include '../master.php';
  session_start();

  $flag = FALSE;
  $sql = "SELECT user_id FROM user WHERE user_id LIKE '%@admin'";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($result)){
    if($row['user_id']==$_SESSION["username"]){
      $flag = TRUE;
    }
  }
  if($flag==FALSE){
    header("location:../login/login.php?index=yes");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title id="title">
    <?php
    if (isset($_REQUEST['page'])) {
    echo $_REQUEST['page'];
    }
    else{
    echo("Pages");
    }
    ?>
    </title>
    <link rel="stylesheet" type="text/css" href="../res/css/md2.css">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet" type="text/css" href="page.css">
    <link rel="stylesheet" type="text/css" href="../css/nav_bar.css">
    <link rel="stylesheet" type="text/css" href="../css/ui.css">
    <link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon">
    <meta charset='utf-8'></meta>
  </head>
  <body class="full_body" onload="adjust()" onresize="adjust()">
    <div  id="body">
      <!-- MENU PART -->
      <div class="nav_body">
        <div class="flex_menu" >
        <div style="margin-right: auto;" class="flex_menu_div Hov_div">
          <a style="width: fit-content;" href="..\profile\profile.php"><i class="material-icons">rowing</i><p style="word-break:keep-all;">&nbsp;Visit Regular Site</p></a>
        </div>
        <div class="flex_menu_div Hov_div"><a href="..\login\logout.php"><i class="material-icons">power_settings_new</i><p>&nbsp;LogOut</p></a></div>
        <!-- <span>|</span> -->
        <!--         <div>::</div> -->
      </div>
    </div>
    <div class="main_body">
      <div class="side_pane">
        <!-- Others -->
        <div>
          <p
            style="
            text-align: center;
            color: grey;
            font-size: 17px;
            font-weight: bold;"
          >Reports</p>
        </div>
        <div class="scroll_pane">
          <div class="pagelist_content_box">
            <ul id="pagelist">
            </ul>
            <ul style="display: none;">
              <li id="none"></li>
            </ul>
          </div>
        </div>
        <!-- MY -->
      </div>
      <div class="middle_pane">
        <!-- <div style="position: absolute;display: none;margin-left: auto;margin-right: auto;flex-direction: column;" id="PostButton_box">
          <button style="display: none;">||</button>
          <button class="post_button" id="PostButton">
          <i><b>+</b> Create Post</i>
          </button>
        </div> -->
        <div class="post_pane">
          <span id="chat_title_name">
            <i style="display: none" id="loading_icon" class="material-icons loading">hourglass_empty</i>
          </span>
          <div class="post_box" id="post_bx">
            <ul style="height: 6px" id="post_list">
            </ul>
          </div>
        </div>
      </div>
      <div class="side_pane">
        
        <div>
          <p
            style="
            text-align: center;
            color: grey;
            font-size: 17px;
            font-weight: bold;"
          >Reasons</p>
        </div>
        <div class="scroll_pane">
          <div class="pagelist_content_box">
          <ul id="reports_list"></ul>
        </div>
      </div>
    </div>
  </div>
  <!--   <div style="height: 6px"></div> -->
</div>
<script src="../js-libs/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="../js-libs/anime.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script> -->
<script src="page.js"></script>
<script src="./js/pageThings.js"></script>
<script src="./js/post.js"></script>
<script src="./js/get_post.js"></script>
<script src="../search/search.js"></script>
</body>
</html>