<?php
    session_start();
    include '../../master.php';

    $sql = "select user_id,name,sr_user_id FROM user WHERE user_id LIKE '".$_GET['user_id']."%'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        if($row['sr_user_id'] == $_SESSION['sr_user_id']){
            continue;
        }
        $psql = "select profile_img from user where user_id ='".$row['user_id']."'";
        $presult = mysqli_query($conn,$psql);
        $prow = mysqli_fetch_array($presult);
        $ppic = $prow['profile_img'];
        //----------->Image and profile name
        echo('<li class="user_result">');
        echo '<img src="'.$ppic.'"></img>';
        echo '<span style="margin-right: 6px;color:black;">'.$row['user_id'].'</span>';
        //----------->Image and profile name
        $fllw = mysqli_fetch_array(
            mysqli_query(
                $conn,
                "SELECT COUNT(`sr_user_id`) FROM `followers` WHERE `sr_user_id` = ".$_SESSION['sr_user_id']." AND `sr_follower_id` = '".$row['sr_user_id']."'"
            )
        );
        //echo($fllw['COUNT(`sr_user_id`)']);
            if($fllw['COUNT(`sr_user_id`)']==1){
                //---------->unfollow
               $button ='<button onclick="follow('.$row['sr_user_id'].','."'u'".')" style="margin-left: auto;margin-bottom:auto;margin-top: auto;" class = "join_button">
                    <i class="material-icons">clear</i>
                </button>';
            }
            else{
                //---------->follow
                $button ='<button onclick="follow('."'".$row['sr_user_id']."'".','."'f'".')" style="margin-left: auto;margin-bottom:auto;margin-top: auto;" class = "join_button">
                    <i class="material-icons">add</i>
                </button>';
            }
            echo($button);
        echo('</li>');
    }
?>