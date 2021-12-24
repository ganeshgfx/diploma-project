var user_id = "";
var name = "";
var email = "";
var phone = "";
var date = "";
var password = "";
var trafic_light = "red";
function signup(){
  if(document.getElementById("pass").value == "" || document.getElementById("cpass").value == ""){
    document.getElementById("passmsg").innerHTML = "<p>Empty Password</p>";
    trafic_light = "red";
  } 
  else if(document.getElementById("pass").value == document.getElementById("cpass").value){
    password = document.getElementById("pass").value;
    trafic_light = "green";
  }else{
    document.getElementById("passmsg").innerHTML = "<p>Password Mismatch</p>";
    trafic_light = "red";
  }
  if(trafic_light == "green"){
    // console.log(user_id);
    // console.log(name);
    // console.log(email);
    // console.log(phone);
    // console.log(date.toString());
    // console.log(password);
    if (window.XMLHttpRequest) {
      http = new XMLHttpRequest();
    }else{
      http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = 'signup_a_script.php';
    var params = 'u='+user_id+'&n='+name+'&e='+email+'&p='+phone+'&d='+date.toString()+'&ps='+password+"&saveData=ok";
    http.open('POST', url, true);
    http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    http.onreadystatechange = function(){
      if(http.readyState == 4 && http.status == 200) {
        if(http.responseText=="signup_ok"){
          window.location.replace("../login/login_page.php");
        }
        if(http.responseText=="ERROR"){
           // console.log(http.responseText);
        }
      }
    }
    http.send(params);
  }
}
function check_email(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);///true false
}
function check_user(id){
  for (var i=0;i<id.length;i++){
    if(id[i].charCodeAt() >= 65 && id[i].charCodeAt() <= 90 || id[i].charCodeAt() >= 97 && id[i].charCodeAt() <= 122 || id[i].charCodeAt() >= 48 && id[i].charCodeAt() <= 57 || id[i]=="_"){
      form = true;
      document.getElementById("umsg").innerHTML = "";
    }
    else{
      // console.log(id[i]+" Not Allowd");
      c = id[i];
      if (c==" "){c="SPACE"}
      document.getElementById("umsg").innerHTML = "<p>"+c+" is not allowed</p>";
      form = false;
      break;
    }
  }
  if(id!="" && form==true){
    if (window.XMLHttpRequest) {
      http = new XMLHttpRequest();
    }
    else{
      http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = 'signup_a_script.php';
    var params = 'u='+id+'&sf=uchk';
    http.open('POST', url, true);
    http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    http.onreadystatechange = function(){
      //console.log(http.responseText)
      if(http.readyState == 4 && http.status == 200) {
        if(http.responseText=="ok"){
           nxt_id = "ok";
           form = true;
        }
        if(http.responseText=="sorry"){
           document.getElementById("umsg").innerHTML = "<p>'"+id+"' is alredy taken</p>";
           form = false;
        }
      }
  }
  http.send(params);
  }
}
var nxt_id = "";
function next_password(){
  var id_flag = false;
  var nm_flag = false;
  var em_flag = false;
  var pn_flag = false;
  var dt_flag = false;
  if(document.getElementById("uid").value != ""){
    check_user(document.getElementById("uid").value);
    if (nxt_id == "ok"){
      id_flag = true;
      document.getElementById("umsg").innerHTML = "";
    }
  }else{
    id_flag = false;
    document.getElementById("umsg").innerHTML = "<p>User Name is Empty</p>";
  }

  if(document.getElementById("nm").value != ""){
    nm_flag = true;
    document.getElementById("nmmsg").innerHTML = "";
  }else{
    nm_flag = false;
    document.getElementById("nmmsg").innerHTML = "<p>Full Name is Empty</p>";
  }

  if(check_email(document.getElementById("em").value) == true && document.getElementById("em").value != ""){
     document.getElementById("Emsg").innerHTML = "";
    em_flag = true;
  }else if(document.getElementById("em").value == ""){
    em_flag = false;
    document.getElementById("Emsg").innerHTML = "<p>Empty E-Mail</p>";
  }else{
    em_flag = false;
    document.getElementById("Emsg").innerHTML = "<p>Invalid E-mail Format</p>";
  }

  if(document.getElementById("pn").value != ""){
    pn_flag = true;
    document.getElementById("pnmsg").innerHTML = "";
  }else{
    pn_flag = false;
    document.getElementById("pnmsg").innerHTML = "<p>Empty Phone No.</p>";
  }

  if(document.getElementById("date").value != ""){
    dt_flag = true;
    document.getElementById("dtmsg").innerHTML = "";
  }else{
    dt_flag = false;
    document.getElementById("dtmsg").innerHTML = "<p>Empty or Half Date Input.</p>";
  }

  if(id_flag && nm_flag && em_flag && pn_flag && dt_flag){
    user_id = document.getElementById("uid").value;
    name = document.getElementById("nm").value;
    email = document.getElementById("em").value;
    phone = document.getElementById("pn").value;
    date = document.getElementById("date").value;
    document.getElementById("p1").innerHTML = document.getElementById("p2").innerHTML;
  }
}
function next_create(){
  ////////////pas in put
}
function chk_pass_strong(){
  document.getElementById("passmsg").innerHTML = "";
  var passv = document.getElementById("pass").value;
  if (passv==""){
    document.getElementById('passW').style.display ='none';
  }
  else{
    document.getElementById('passW').style.display ='block';
  }
  var upc = false;
  var lpc = false;
  var noc = false;
  var ssc = false;
  var cnt = 0;
  for (var i=0;i<passv.length;i++){
    if(passv[i].charCodeAt() >= 65 && passv[i].charCodeAt() <= 90){
      upc = true; 
    }
    if(passv[i].charCodeAt() >= 97 && passv[i].charCodeAt() <= 122){
      lpc = true; 
    }
    if(passv[i].charCodeAt() >= 48 && passv[i].charCodeAt() <= 57){
      noc = true;
    }
    if(passv[i].charCodeAt() >= 32 && passv[i].charCodeAt() <= 47 || passv[i].charCodeAt() >= 58 && passv[i].charCodeAt() <= 64 || passv[i].charCodeAt() >= 91 && passv[i].charCodeAt() <= 96 || passv[i].charCodeAt() >= 123 && passv[i].charCodeAt() <= 126){
      ssc = true;
    }
  }
  if(upc){
    document.getElementById("uc").innerHTML = "✓  Upper Case [A,B..Z]";
    document.getElementById('uc').style.color ='#006b04';
    cnt = cnt+1; 
  }
  else{
    document.getElementById("uc").innerHTML = "✗ Upper Case [A,B..Z]";
    document.getElementById('uc').style.color ='#b70d00';
  }

  if(lpc){
    document.getElementById("lc").innerHTML = "✓ Lower Case [a,b..z]";
    document.getElementById('lc').style.color ='#006b04';
    cnt = cnt+1; 
  }
  else{
    document.getElementById("lc").innerHTML = "✗ Lower Case [a,b..z]";
    document.getElementById('lc').style.color ='#b70d00';
  }

  if(noc){
    document.getElementById("no").innerHTML = "✓ Numbers [0,1..9]";
    document.getElementById('no').style.color ='#006b04';
    cnt = cnt+1; 
  }
  else{
    document.getElementById("no").innerHTML = "✗ Numbers [0,1..9]";
    document.getElementById('no').style.color ='#b70d00';
  }
  if(ssc){
    document.getElementById("ss").innerHTML = "✓ Symbols [@,#..?]";
    document.getElementById('ss').style.color ='#006b04';
    cnt = cnt+1; 
  }
  else{
    document.getElementById("ss").innerHTML = "✗ Symbols [@,#..?]";
    document.getElementById('ss').style.color ='#b70d00';
  }

  if(passv.length >= 8){
    document.getElementById("ln").innerHTML = "✓ 8 Character";
    document.getElementById('ln').style.color ='#006b04';
    cnt = cnt+1; 
  }
  else{
    document.getElementById("ln").innerHTML = "✗ 8 Character";
    document.getElementById('ln').style.color ='#b70d00'; 
  }
  var stxt = "";
  switch(cnt){
    case 1:
      stxt = "Weak";
      break;
    case 2:
      stxt = "Weak";
      break;
    case 3:
      stxt = "Good";
      break;
    case 4:
      stxt = "Strong";
      break;
    default:
      stxt = "Perfect";
      break;
  }
  document.getElementById("dp").innerHTML = " Your Password is "+stxt+" <br> Use following:";
}
