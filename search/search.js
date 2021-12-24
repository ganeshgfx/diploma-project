let search_result = document.getElementById("search_result");
let search_flag = true;
function search(){
  let search_txt = document.getElementById("search").value;
  if (search_txt==""){
    search_txt = " ";
  }
  let form_data = new FormData();
  form_data.append("search",search_txt);
  $.ajax({
    url: "../search/php/page_search.php",
    dataType: 'script',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    complete: function(data){
      search_result.innerHTML = data.responseText;
    },
    xhr: function(){
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function(evt){
        if (evt.lengthComputable) {
                //var percentComplete = evt.loaded / evt.total;
                //Do something with upload progress
                //console.log(Math.ceil(percentComplete*100));
                //document.getElementById("progress_up").innerHTML = 'Uploading '+Math.ceil(percentComplete*100)+' % Compleated';
        }
      },false);
      return xhr;
    }
  });
}
function join_to_page(page,user,x){
  let form_data = new FormData();
  form_data.append("page",page);
  form_data.append("user",user);
  form_data.append("x",x);
  $.ajax({
    url: "../page/php/join_to_page.php",
    dataType: 'script',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    complete: function(data){
      //console.log(data.responseText);
      if(data.responseText=="ok"){
        search_result.innerHTML = "";
        document.getElementById("search").value ="";
        getPageList();
      }
    }
  });
}
/////////////////////////#USER#////////////////////////
var str;
str="";
function showUser(name){
  str=name;
  if(str=="" || str[0]==" "){ 
    document.getElementById("search_result").innerHTML = "";
  }
  else{
    xsearch(str);
  }
  if(str=="/all"){
    xsearch(" ");
  }
}
//setInterval(function(){search()},1000);
var go = true;
function xsearch(xstr) {
  go = true;
  if(xstr[0]==" "||xstr[0]==""||xstr==""){
    go = false;
  }
  // console.log(go)
  if(go){
    if(xstr=="/all"){xstr=" "}
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      }
      else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("search_result_user").innerHTML = this.responseText;
          //console.log(this.responseText)
        }
      };
      xmlhttp.open("GET","../search/php/get.php?user_id="+xstr,true);
      xmlhttp.send();
  }
}
function follow(user,flw){
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      }
      else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
          if(this.responseText=='ok'){
            getfrnd();
          }
          //document.getElementById("txt").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","../search/php/follow_script.php?flw_user="+user+"&flw_flag="+flw,true);
      xmlhttp.send();
}
//////////////////////////////////////////////////////