setTimeout(function(){cngSize()},0);
function cngSize(){
	h=window.innerHeight;
  	w=window.innerWidth;
  	if(h>w || h==w){
  		document.getElementById("username").style.width = '30%';
  		document.getElementById("password").style.width = '30%';
  		document.getElementById("btn").style.width = '25%';
  	}
  	else {
  		document.getElementById("username").style.width = '15%';
  		document.getElementById("password").style.width = '15%';
  		document.getElementById("btn").style.width = '10%';
  	}
}
function login(){
	var user = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	if(user == "" || pass==""){
		if(user == "" && pass!=""){
			document.getElementById("msg").innerHTML = "<p>Input Username</p>";
		}
		if(user != "" && pass==""){
			document.getElementById("msg").innerHTML = "<p>Input Password</p>";
		}
		if(user == "" && pass==""){
			document.getElementById("msg").innerHTML = "<p>Input Username & Password</p>";
		}
	}	
	else{
		if (window.XMLHttpRequest) {
    		http = new XMLHttpRequest();
    	}
    	else{
    		http = new ActiveXObject("Microsoft.XMLHTTP");
    	}
		var url = 'login.php';
		var params = 'u='+user+'&p='+pass;
		http.open('POST', url, true);
		http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http.onreadystatechange = function(){
    	if(http.readyState == 4 && http.status == 200) {
          if(http.responseText=="Desabled"){
            if(confirm("Your Account is Desabled ! Click 'OK' To Enable it")){
              window.location.replace("../profile/profile.php?e=yes");
            }
            else{
              window.location.replace("../login/login_page.php");
            }
          }
        	else if(http.responseText=="valid"){
            if(user.slice(-6)=='@admin'){
              window.location.replace("../admin/page.php");
            }
            else
        		  window.location.replace("../profile/profile.php");
        	}
        	else{
        		document.getElementById("msg").innerHTML = "<p>Invalid Username or Password</p>";
        	}
    	}
	}
	http.send(params);
	}
}
function enterU(){
  if (event.keyCode == 13)
    document.getElementById("password").focus();
}
function enterP(){
  if (event.keyCode == 13)
    login();
}
let visibility = document.getElementById("visibility");
let pass_view = document.getElementById("password");
visibility.addEventListener("click",function(){
  switch(pass_view.type){
    case "text":
      pass_view.type="password";
      visibility.innerHTML="visibility";
      visibility.style.color = '#424242e8';
      break;
    case "password":
      pass_view.type="text";
      visibility.innerHTML="visibility_off";
      visibility.style.color = '#F44336';
      break;
    default:
      break;
  }
});