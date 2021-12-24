<?php
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../res/css/md2.css">
        <link rel="stylesheet" type="text/css" href="../css/ui.css">
        <link rel="stylesheet" type="text/css" href="../css/nav_bar.css">
        <link rel="stylesheet" type="text/css" href="../home/home.css">
        <link rel="icon" href="..\res\sitedp.png" type="image/x-icon">
        <meta charset='utf-8'></meta>
        <style type="text/css">
        *{
        padding: 0px;
        margin: 0px;
        }
        </style>
    </head>
    <body id="body" onload="adjust()" onresize="adjust()">
        <div class="flex_menu">
            <div class="flex_menu_div Hov_div"><a  href="#"><i class="material-icons">notifications_none</i></a></div>
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
        <div class="flex_seli"><a><i class="material-icons">public</i><p>&nbsp;Home</p></a></div>
        <span>|</span>
        <div class="flex_menu_div Hov_div"><a href="..\chat\chat.php"><i class="material-icons">chat</i><p>&nbsp;Chats</p></a></div>
        <span>|</span>
        <div class="flex_menu_div Hov_div">
          <a href="..\page\page.php">
            <i class="material-icons">attach_file</i>
            <p>&nbsp;Pages</p>
          </a>
        </div>
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
        <div class="nav_section"></div>
        <div class="table_div">
            <table border="0" align="center" class="table_bkgrnd">
                <tr>
                    <td class="left">
                        <div align="center">
                            Left Section
                        </div>
                    </td>
                    <td class="middle">
                        <div align="center">
                            Middle Section
                        </div>
                    </td>
                    <td class="right">
                        <div align="center">
                            Right Section
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
<script src="../js-libs/anime.min.js"></script>
<script src="../js-libs/jquery.min.js"></script>
<script src="./js/home.js"></script>
<script src="../search/search.js"></script>