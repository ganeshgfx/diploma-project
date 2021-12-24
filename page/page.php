<?php
session_start();
include '../master.php';
?>
<!DOCTYPE html>
<script type="text/javascript">
  var current_page = 'page';
</script>
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
    <link rel="stylesheet" type="text/css" href="../css/material.min.css">
    <link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon">
    <meta charset='utf-8'></meta>
  </head>
  <body onload="adjust()" onresize="adjust()" id="body" style='font-family: "Arial Rounded MT";'>
    <!-- // Ceate Page // -->
    <div class="cp_create_page_style" id="cp_create_page" style="display: none">
      <table align="center" id="PNbox">
        <tr>
          <td onclick="create_page_close()" colspan="2" align="right"><span style="cursor: pointer;color: #F44336;" class="material-icons">cancel</span></td>
        </tr>
        <tr>
          <td>
            <div class="PNform">
              <label for="page_name">Page ID</label>
              <input class="PNinptBox" type="text" id="page_id">
              <label for="page_name">Page Name</label>
              <input class="PNinptBox" type="text" id="page_name">
              <label for="page_info">Page Info</label>
              <textarea class="PNtextarea" id="page_info"></textarea>
              <label for="page_type">Page Type</label>
              <select class="PNinptBox" id="page_type">
                <option value="blog">Forum</option>
                <option value="group">Group</option>
                <option value="blog">Blog</option>
              </select>
              <button class="PNbtn" id="page_create">Create</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <!-- // Ceate Post // -->
    <div class="post_form" id="post_form" style="display: none;">
      <table align="center" >
        <tr id="post_form_X">
          <td colspan="2" align="right"><span style="cursor: pointer;color: #F44336;" class="material-icons">cancel</span></td>
        </tr>
        <tr>
          <td>
            <div class="PNform">
              <!--               <label for="post_title">Title</label>
              <input type="text" class="PNinptBox" id="post_title"/> -->
              <label for="post_file">File</label>
              <button class="upload_file_button" id="upload_button"><span class="material-icons">cloud_upload</span> Upload File</button>
              <div style="display: flex;">
                <span id="upload_file_name" class="upload_file_view" style="display: none"></span>
                <span
                  id ="remove_file"
                  style="
                  display: none;
                  color: #F44336;
                  margin-left: 5px;
                  cursor: pointer;"
                  class="material-icons"
                  >
                  delete_forever
                </span>
              </div>
              <br>
              <input class="PNinptBox" type="file" accept=".png,.jpg,.jpeg,.gif,.mp4,.3gp,.mkv,.mov,.mp3,.waw" id="post_file" onchange="update_file_view()" style="display: none;"/>
              <label for="caption">Massage</label>
              <textarea class="PNtextarea" id="post_msg"></textarea>
              <label for="post_topic">Tags Related to Post</label>
              <textarea class="PNtextarea" id="post_tags" placeholder="Use 'SPACE' between tags words"></textarea>
              <button class="PNbtn" id="post_button" disabled>Post</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div class="full_body">
      <!-- MENU PART -->
      <div class="nav_body">
        <div class="flex_menu" ><!-- id="homeP" onclick="menuBar(this.id)" -->
          <div class="flex_menu_div" id="ring_bell">
          <a id="ring_bell_data">
            <i class="material-icons">notifications_none</i>
          </a>
          <div class="notif shadow div_anime" id="notif" style="max-height:0%;">
            <ul id="notif_data">
            </ul>
          </div>
        </div>
        <!-- <div class="flex_menu_div Hov_div"><a  href="#"><i class="material-icons">notifications_none</i></a></div> -->
        <div class="dropdown" style="" id="menu" onmouseenter="showOP('block')"onmouseleave="showOP('none')">
          <a href="#"><i class="material-icons">format_list_bulleted</i><p>Page&nbsp;Option</p></a>
          <ul class="dropdown-content" id="menu_list">
            <li onclick="create_page_open()">
              Create Page
            </li>
            <li style="display: none" onclick="imaa_head_out(this.id)" id = 'leave_Page'>
            </li>
          </ul>
        </div>
        <!-- SORT -->
        <div class="Hov_div sort_box">
          <a class="sort_ttl">
            <i class="material-icons">list_alt</i>
            <p>&nbsp;Sort&nbsp;Posts</p>
          </a>
          <div class="sort_cnt">
            Order By
            <span class="saprator_line"></span>
            <label onclick="post_sort(history_tik)" id="descending_order" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
              <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input">
              <span class="mdl-checkbox__label mdl-color-text--black">Descending Order</span>
            </label>
            Filter By
            <span class="saprator_line"></span>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
              <input onclick="post_sort('like')" type="radio" id="option-1" class="mdl-radio__button" name="options" value="1">
              <span class="mdl-radio__label mdl-color-text--black">Like</span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
              <input onclick="post_sort('rate')" type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
              <span class="mdl-radio__label mdl-color-text--black">Rating</span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
              <input onclick="post_sort('comment')" type="radio" id="option-3" class="mdl-radio__button" name="options" value="3">
              <span class="mdl-radio__label mdl-color-text--black">Comments</span>
            </label>
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
              <input onclick="post_sort('date')" type="radio" id="option-4" class="mdl-radio__button" name="options" value="4">
              <span class="mdl-radio__label mdl-color-text--black">Dates</span>
            </label>
            Bookmark
            <span class="saprator_line"></span>
            <label  id="save_pst_book" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
              <input onclick="post_sort(history_tik)" type="checkbox" id="checkbox-2" class="mdl-checkbox__input">
              <span class="mdl-checkbox__label mdl-color-text--black">Show Bookmarked</span>
            </label>
          </div>
        </div>
        <!-- SORT -->
        <div class="search_box" id="search_box" onmouseenter="showSearch('block')"onmouseleave="showSearch('none')">
          <div>
            <input type="text" id="search" oninput="search()" onclick="" style="display: none; margin:auto;height: 30px;"><!-- Show_doSearch() -->
            <img src="../res/ico/dock_google_search.png" class="search_ico"></img>
          </div>
          <!-- search body -->
          <div class="search_window">
            <div class="shadow">
              <ul id="search_result" style="display: none">
                
              </ul>
            </div>
          </div>
          <!-- search body -->
        </div>
        <!-- <div class="flex_menu_div Hov_div"><a  href="..\home\home.php"><i class="material-icons">public</i><p>&nbsp;Home</p></a></div>
        <span>|</span> -->
        
        <div class="flex_seli">
          <a>
            <i class="material-icons">attach_file</i>
            <p>&nbsp;Pages</p>
          </a>
        </div>
        <span>|</span>
        <div class="flex_menu_div Hov_div"><a href="..\chat\chat.php"><i class="material-icons">chat</i><p>&nbsp;Chats</p></a></div>
        <span>|</span>
        <div class="flex_menu_div Hov_div">
          <a href="..\profile\profile.php">
            <img <?php echo 'src="'.$_SESSION["ppic"].'"'; ?> style="border-radius: 4px">
            <p>&nbsp;Profile</p>
          </a>
        </div>
        <span>|</span>
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
          >Pages</p>
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
        <div>
          <p
            style="
            text-align: center;
            color: grey;
            font-size: 17px;
            font-weight: bold;"
          >My Pages</p>
        </div>
        <div class="scroll_pane">
          <div class="pagelist_content_box">
            <ul id="pagelist_my">
            </ul>
          </div>
        </div>
      </div>
      <div class="middle_pane">
        <div style="position: absolute;display: none;margin-left: auto;margin-right: auto;flex-direction: column;" id="PostButton_box">
          <button style="display: none;">||</button>
          <button class="post_button" id="PostButton">
          <i><b>+</b> Create Post</i>
          </button>
        </div>
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
          >Members</p>
        </div>
        <div class="scroll_pane">
          <div class="pagelist_content_box">
          <ul id="memlist"></ul>
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
<script src="../js-libs/material.min.js"></script>
<!-- <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script> -->
<script src="./js/pageThings.js"></script>
<script src="./js/post.js"></script>
<script src="./js/get_post.js"></script>
<script src="../search/search.js"></script>
<script src="../notification/notify.js"></script>
<?php
if(isset($_GET['page'])){
$data = mysqli_fetch_array(
mysqli_query(
$conn,
"SELECT `page_sr` FROM `page` WHERE `page_id` = '".$_GET['page']."'"
)
);
echo '
<script type="text/javascript">
var url_page_sr = "'.$data['page_sr'].'";
var url_page = "'.$_GET['page'].'";
var url_page_click = 1;
</script>
';
}
else{
echo '
<script type="text/javascript">
var url_page_click = 0;
</script>
';
}
?>
<script src="page.js"></script>
</body>
</html>
