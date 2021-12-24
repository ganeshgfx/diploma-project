let selected_page = "none";
let loading_icon = document.getElementById("loading_icon");
function adjust(){
  document.getElementById('body').style.height = window.innerHeight+"px";
}
var box_thing_back = document.getElementById("cp_create_page");
var box_thing = document.getElementById("PNbox");

function create_page_open(){
	box_thing_back.style.display = 'block';
	box_thing.style.opacity = '0%'
	anime({
  			targets:box_thing,
  			translateY: [-100,0],
  			opacity:100,
  			duration:350
		});
}
function create_page_close(){
	box_thing.style.opacity= '100%';
	anime({
  		targets:box_thing,
  		translateY: [0],
  		duration:350,
  		opacity:0,
  		complete:function(){
  			box_thing_back.style.display = 'none';
  		}
	});
}
function online_update(xlist){
  //console.log(xlist)
  var xlist = JSON.parse(xlist);
  xlist.forEach( function(element,index) {
    key = Object.keys(element);
    value = Object.values(element);
    if(value[0]){
      document.getElementById("memb_"+key[0]).style.backgroundColor = '#4CAF50';
      document.getElementById("memb_"+key[0]).style.color = 'white';
    }
    else{
      //console.log(value,key)
      document.getElementById("memb_"+key[0]).style = '';
    }
  });
}
var current_activity = "NULL";
setInterval(function(){
  let form_data = new FormData();
    form_data.append('at',current_page);
    form_data.append('on',current_activity);
    $.ajax({
        url: "./php/check_post.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //console.log(data.responseText)
            var response = JSON.parse(data.responseText);
            setTimeout(online_update(response.online),0);
            //console.log(response)
            get_notified(JSON.parse(response.notice))
        }
    }); 
},5000);
setTimeout(getPageList(),0);
var list_data="";
function getPageList(){
  $.ajax({
    url : "./php/getPages.php",
    type: "POST",
     data : "",
    complete: function(data){
        document.getElementById("pagelist").innerHTML = data.responseText;
        document.getElementById(selected_page).style.color = '#ffffff';
        document.getElementById(selected_page).style.background = '#007ac1';
        if(url_page_click == 1){
          url_click();
          url_page_click = 0;
        }
      }
  });
  $.ajax({
    url : "./php/get_my_Pages.php",
    type: "POST",
     data : "",
    complete: function(data){
      //console.log(document.getElementById(selected_page));
        document.getElementById("pagelist_my").innerHTML = data.responseText;
        document.getElementById(selected_page).style.color = '#ffffff';
        document.getElementById(selected_page).style.background = '#007ac1';
        if(url_page_click == 1){
          url_click();
          url_page_click = 0;
        }
      }
  });
}
// if(window.location.search!="" || window.location.search!="?" || window.location.search!=" "){
//   getMemList(window.location.search.substr(1,window.location.search.length));
// }
let my_page = false;
function getMemList(pid,pname,my){
  //console.log(pname)
  current_activity = pid;
  post_list_array_index = 0;
  post_list_array = [];
  // if(document.getElementById("checkbox-2").checked){
  //   document.getElementById("save_pst_book").click();
  // }
  if (document.getElementById("leave_Page").style.display == 'none'){document.getElementById("leave_Page").style.display = 'block'}
  if(my==1){
    document.getElementById("leave_Page").innerHTML = "Delete Page";
    my_page = true;
  }
  if(my==0){
    document.getElementById("leave_Page").innerHTML = "Leave Page";
    my_page = false;
  }
  document.getElementById("loading_icon").style.display = 'block';
  selected_page = pid;
  title = document.getElementById("title");
  title.innerHTML = pname;
  getPageList();
  //console.log(pid);
  $.ajax({
    url : "./php/getPages_mem.php",
    type: "POST",
     data : "id="+pid,
    complete: function(data){
      //console.log(data.responseText)
      document.getElementById("memlist").innerHTML = data.responseText;
    }
  });
  // if(document.getElementById("post_list").style.display == 'none'){
  //   document.getElementById("post_list").style.display = 'block';
  // }
  //document.getElementById("PostButton").style.display = 'block';
  document.getElementById("PostButton_box").style.display = 'flex';
  get_post();
  // post_bx=document.getElementById("post_bx");
  // post_bx.scrollTop = post_bx.scrollHeight - post_bx.clientHeight;
}
function showOP(x){
  document.getElementById('menu_list').style.display = x;
  
}
/////////loading
function url_click(){
    document.getElementById(url_page_sr).click();
}