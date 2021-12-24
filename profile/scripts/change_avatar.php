<?php
session_start();
include '../../master.php';

$sql = "select sr_user_id from user where user_id ='".$_SESSION['username']."'";
//echo($sql);
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$sr_user_id = $row['sr_user_id'];

$target_dir = "../../Upload/".$sr_user_id."/";

date_default_timezone_set("Asia/Calcutta");
$file_name = date("M_d_Y")."_at_".date("h_i_a")."_file_".basename($_FILES["client_pic"]["name"]);

$target_file = $target_dir.$file_name;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["client_pics"])) {
    $check = getimagesize($_FILES["client_pic"]["tmp_name"]);
    if($check !== false) {
        echo "<br>File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<br>File is not an image.";
        $uploadOk = 0;
    }
}

// if (file_exists($target_file)) {
//     echo "<br>Sorry, file already exists.";
//     $uploadOk = 0;
// }
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "<br>Sorry, only JPG,PNG are allowed.";
    $uploadOk = 0;
}

///do upload
if ($uploadOk == 0) {
    echo "<br>Sorry, your file was not uploaded.";
}else {
    if (move_uploaded_file($_FILES["client_pic"]["tmp_name"],$target_file)) {
    	$loc = "../Upload/".$sr_user_id."/".$file_name;
    	$sql_upld = "update user SET profile_img = '".$loc."' where user_id='".$_SESSION['username']."'";
    	//echo($sql_upld)
		mysqli_query($conn,$sql_upld);
        echo "uploaded";
    } else {
        echo "<br>Sorry, there was an error uploading your file.";
    }
}








/////////////////compress
//compressImage($_FILES['client_pic']['tmp_name'],$location,60);
// function compressImage($source, $destination, $quality) {

//   $info = getimagesize($source);

//   if ($info['mime'] == 'image/jpeg') 
//     $image = imagecreatefromjpeg($source);

//   elseif ($info['mime'] == 'image/gif') 
//     $image = imagecreatefromgif($source);

//   elseif ($info['mime'] == 'image/png') 
//     $image = imagecreatefrompng($source);

//   imagejpeg($image, $destination, $quality);

// }
?>