// setTimeout(function(){cngH()},0);
// function cngH(){
//     //document.getElementById('tbl_bd').style.height = window.innerHeight+'px';
// }
// function getProfileData(){
//    document.getElementById("profile_name").innerHTML= '<p><?php echo $_SESSION["username"]; ?></p>';
//   if (window.XMLHttpRequest) {
//       http = new XMLHttpRequest();
//     }
//     else{
//       http = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     var url = 'signup_a_script.php';
//     var params = 'u='+id+'&sf=uchk';
//     http.open('POST', url, true);
//     http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
//     http.onreadystatechange = function(){
//       if(http.readyState == 4 && http.status == 200) {
//         if(http.responseText=="ok"){
//            nxt_id = "ok";
//         }
//         if(http.responseText=="sorry"){
//            document.getElementById("umsg").innerHTML = "<p>'"+id+"' is alredy taken</p>";
//         }
//       }
//   }
//   http.send(params);
// }
///////////////Modal///////////////////
//setTimeout(showFollower(),0);
let search_box = document.getElementById("search");
function adjust(){
  document.getElementById('body').style.height = window.innerHeight+"px";
}
function showSearch(di) {
    if (di == 'block') {
        search_box.style.display = di;
        anime({
            targets: search_box,
            width: '100%',
            easing: 'linear',
            duration: 100
        });
    }
    if (document.activeElement.id != 'search') {
        if (di == 'none') {
            anime({
                targets: search_box,
                width: '0',
                easing: 'linear',
                duration: 100,
                complete: function(anim) {
                    search_box.style.display = 'none';
                    //search_result.style.display = 'none';
                }
            });
        }
    }
}
function adjust(){
  document.getElementById('body').style.height = window.innerHeight+"px";
}
let modaltitle = document.getElementById("modaltitle");
function showFollower(){
  content = document.getElementById("follow_list");
  document.getElementById("myModal").style.display = "block";
  var Data = '';
    $.ajax({
    url : "../profile/scripts/get_friends.php",
    type: "POST",
    data : Data,
    complete: function(data){
      content.innerHTML=data.responseText;
    }
  });
}
function closeFollower(){
  document.getElementById("myModal").style.display = "none";
}
function showFollowing(){
  modaltitle.innerHTML = "Following";
  content = document.getElementById("follow_list");
  document.getElementById("myModal").style.display = "block";
  var Data = '';
    $.ajax({
    url : "../profile/scripts/get_friends2.php",
    type: "POST",
    data : Data,
    complete: function(data){
      content.innerHTML=data.responseText;
    }
  });
}
function showMypage(){
  modaltitle.innerHTML = "My Pages";
  content = document.getElementById("follow_list");
  document.getElementById("myModal").style.display = "block";
  var Data = '';
    $.ajax({
    url : "../profile/scripts/get_mypage.php",
    type: "POST",
    data : Data,
    complete: function(data){
      content.innerHTML=data.responseText;
    }
  });
}
function showPage(){
  modaltitle.innerHTML = "My Pages";
  content = document.getElementById("follow_list");
  document.getElementById("myModal").style.display = "block";
  var Data = '';
    $.ajax({
    url : "../profile/scripts/get_page.php",
    type: "POST",
    data : Data,
    complete: function(data){
      content.innerHTML=data.responseText;
    }
  });
}
/////////////Setting////////////////
function showSettings(showS){
  if (showS){
    savBtn = document.getElementById("notClicked").innerHTML
    document.getElementById("notClicked").innerHTML = document.getElementById("Clicked").innerHTML;
  }
  else{
    location.reload();
    // document.getElementById("notClicked").innerHTML = savBtn;
    // document.getElementById("delete_tbl").style.display = 'none';
    // document.getElementById("profile_table").style.display = 'block';
    // document.getElementById("update_contact").style.display = 'none';
    // document.getElementById("changePass").style.display = 'none';
    // document.getElementById("update_avatar").style.display = 'none';
  }
}
function SetDelet(){
  // document.getElementById("profile_table").innerHTML = document.getElementById("delete_tbl").innerHTML;
  document.getElementById("profile_table").style.display = 'none';
  document.getElementById("update_contact").style.display = 'none';
  document.getElementById("delete_tbl").style.display = 'block';
  document.getElementById("changePass").style.display = 'none';
  document.getElementById("update_avatar").style.display = 'none';
}
function SetUpdateC(){
  // document.getElementById("profile_table").innerHTML = document.getElementById("delete_tbl").innerHTML;
  document.getElementById("profile_table").style.display = 'none';
  document.getElementById("update_contact").style.display = 'block';
  document.getElementById("delete_tbl").style.display = 'none';
  document.getElementById("changePass").style.display = 'none';
  document.getElementById("update_avatar").style.display = 'none';
}
function Change_Pass(){
  // document.getElementById("profile_table").innerHTML = document.getElementById("delete_tbl").innerHTML;
  document.getElementById("profile_table").style.display = 'none';
  document.getElementById("changePass").style.display = 'block';
  document.getElementById("update_contact").style.display = 'none';
  document.getElementById("delete_tbl").style.display = 'none';
  document.getElementById("update_avatar").style.display = 'none';
}
function next_AVATAR(){
  // document.getElementById("profile_table").innerHTML = document.getElementById("delete_tbl").innerHTML;
  document.getElementById("profile_table").style.display = 'none';
  document.getElementById("update_avatar").style.display = 'block';
   document.getElementById("changePass").style.display = 'none';
  document.getElementById("update_contact").style.display = 'none';
  document.getElementById("delete_tbl").style.display = 'none';
}
///////////////delete////////////////////
function goodbye_delete(svitch){
    var pass = document.getElementById("pass_del").value;
    if (window.XMLHttpRequest) {
      http = new XMLHttpRequest();
    }
    else{
      http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = '../del/del_acc.php';
    if (svitch){
      if(confirm("Are you Sure ?")){
        var params = 'p='+pass+'&dele=1';
        http.open('POST', url, true); 
      }
    }
    if (!svitch){
      if(confirm("Are you Sure ?")){
        var params = 'p='+pass+'&dese=1';
        http.open('POST', url, true); 
      }
    }
    http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    http.onreadystatechange = function(){
      if(http.readyState == 4 && http.status == 200) {
        alert(http.responseText);
        if (http.responseText =="Account Desabled" || http.responseText =="Account Deleted") {
          window.location.replace("../login/login_page.php");
        }
      }
    }
    http.send(params);
    // if (true) {}
}
function change_password(){
  //var newpass = document.getElementById("new_pass").value;
  if(document.getElementById("new_pass").value == ""){
    alert("Password Is Empty !");
  }
  else if(document.getElementById("new_pass").value == document.getElementById("onf_pass").value){
    if (window.XMLHttpRequest) {
      http = new XMLHttpRequest();
    }
    else{
      http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = '../profile/scripts/change_password.php';
    var params = 'op='+document.getElementById("old_pass").value+"&np="+document.getElementById("new_pass").value;
    //console.log(params);
    http.open('POST', url, true);
    http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    http.onreadystatechange = function(){
      if(http.readyState == 4 && http.status == 200) {
        alert(http.responseText);
        window.location.replace("../login/logout.php");
      }
    }
    http.send(params);
  }
  else {
    alert("Password Mismatched !");
  }
}
function check_email(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);///true false
}
function cng_contact(wick){//document.getElementById("").value == ""
  var go = true;
  if (!wick){
    if (document.getElementById("new_email").value == ""){
      go = true;
    }
    if (document.getElementById("new_email").value != ""){
      if(check_email(document.getElementById("new_email").value)){
        go = true;
      }
      else {
        go = false;
        alert("Invalid Email Format");
      }
    }
  }
  console.log(go);
  if(go){
    var new_email = document.getElementById("new_email").value;
    var new_num = document.getElementById("new_num").value;
    if (window.XMLHttpRequest) {
      http = new XMLHttpRequest();
    }
    else{
      http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = '../profile/scripts/change_contact.php';
    if(wick){
      var params = '&np='+new_num;
    }
    if(!wick){
      var params = '&ne='+new_email;
    }
    //var params = '&ne='+new_email+'&np='+new_num;
    console.log(params);
    http.open('POST', url, true);
    http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    http.onreadystatechange = function(){
      //console.log(http.responseText)
      if(http.readyState == 4 && http.status == 200) {
        //console.log(http.responseText);

      }
  }
  http.send(params);
  }
}
function upload_avatar(){
  document.getElementById('avatar').click();
  
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#change_pic_disp').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#avatar").change(function(){
    readURL(this);
    document.getElementById("bttnU").style.display = 'block';
});
// function file_name_change(){
//   
//   let img_file = $("#avatar").prop("files")[0];
//   console.log(img_file)
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#change_pic_disp').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//   //document.getElementById('change_pic_disp').src = 
// }
function do_pic_upload(){
  document.getElementById("bttnU").style.display = 'none';
  document.getElementById("progress_up").style.display = 'block';
  var file_data = $("#avatar").prop("files")[0];
  var form_data = new FormData(); // Creating object of FormData class
    form_data.append("client_pic", file_data) // Appending parameter named file with properties of file_field to form_data
    form_data.append("user_id", 123) // Adding extra parameters to form_data
    
    var g = $.ajax({
        url: "../profile/scripts/change_avatar.php", // Upload Script
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        complete: function(data){
          console.log(data.responseText);
          if (data.responseText == "uploaded"){
            //alert(data.responseText);
            document.getElementById("progress_up").innerHTML = 'Upload Compleat';
            setTimeout(location.reload(),1000);
          }
        },
        //uplaod prosceess things
      xhr: function(){
       var xhr = new window.XMLHttpRequest();
       xhr.upload.addEventListener("progress", function(evt){
           if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              //Do something with upload progress
              //console.log(Math.ceil(percentComplete*100));
              document.getElementById("progress_up").innerHTML = 'Uploading '+Math.ceil(percentComplete*100)+' % Compleated';
           }
       }, false);
       return xhr;
    }
    });
    console.log(g);
    //document.getElementById("").style.transform = "rotate(90deg)";
}
var send = 'x';
function cng_id(){
  var id = document.getElementById("new_id").value;
  check_user();
  //console.log(send);
  if(send == 'ok'){
    var Data = 'u='+id;
    $.ajax({
    url : "../profile/scripts/change_id.php",
    type: "POST",
    data : Data,
    complete: function(data){
      //console.log(data.responseText);
      if (data.responseText=='reload'){
        alert("ID Changed Please Login Again");
        window.location.replace("../login/logout.php");
      }
    }
  });
  }
}
function check_user(){
  var id = document.getElementById("new_id").value;

  for (var i=0;i<id.length;i++){
    if(id[i].charCodeAt() >= 65 && id[i].charCodeAt() <= 90 || id[i].charCodeAt() >= 97 && id[i].charCodeAt() <= 122 || id[i].charCodeAt() >= 48 && id[i].charCodeAt() <= 57 || id[i]=="_"){
      document.getElementById("progress_up").style.display = 'none';
    }
    else{
      c = id[i];
      if (c==" "){c="SPACE"}
      document.getElementById("progress_up").style.display = 'block';
      document.getElementById("progress_up").innerHTML = c+" is not allowed";
      break;
    }
  }
  if(true){
  var Data = 'u='+id+'&sf=uchk';
  $.ajax({
    url : "../signup/signup_a_script.php",
    type: "POST",
    data : Data,
    complete: function(data){
      send = data.responseText;
      if(data.responseText=="ok"){

      }
      if(data.responseText=="sorry"){
        document.getElementById("progress_up").style.display = 'block';
        document.getElementById("progress_up").innerHTML = id+"' is alredy taken";
      }
    }
  });
  }
}
function cng_name(){
  var name = document.getElementById("new_name").value;
  //console.log(name);

    var Data = 'u='+name;
    $.ajax({
    url : "../profile/scripts/change_name.php",
    type: "POST",
    data : Data,
    complete: function(data){
      //console.log(data.responseText);
      if (data.responseText=='reload'){
        alert("Name Changed");
        //window.location.reload();
      }
    }
  });
}
function cng_bio(){
  var bio = document.getElementById("new_bio").value;
  //console.log(name);
    var Data = 'u='+bio;
    $.ajax({
    url : "../profile/scripts/change_bio.php",
    type: "POST",
    data : Data,
    complete: function(data){
      //console.log(data.responseText);
      if (data.responseText=='reload'){
        //alert("Bio Changed");
      }
    }
  });
}
// function tatu(){
//   console.log(document.getElementById("bio").innerHTML);
// }