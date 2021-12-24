let selected_page = "none";
let page_lst = document.getElementById("pagelist");
let loading_icon = document.getElementById("loading_icon");
function adjust(){
  document.getElementById('body').style.height = window.innerHeight+"px";
}
var box_thing_back = document.getElementById("cp_create_page");
var box_thing = document.getElementById("PNbox");
setTimeout(getPageList(),0);
var list_data="";
let post_array = new Array();
var page_id_name = '';
function arrowPage(id){
  page_id_name = id;
  if(document.getElementById(id).style.display == 'none'){
    document.getElementById(id).style.display = 'flex';
    document.getElementById('arrowX'+id).style.transform = 'rotate(270deg)';
  }
  else{
    document.getElementById(id).style.display = 'none';
    document.getElementById('arrowX'+id).style.transform = 'rotate(0deg)';
  }
}
function getPageList(){
  $.ajax({
    url : "./php/getPages.php",
    type: "POST",
     data : "",
    complete: function(data){
        //console.log(data.responseText)
        let response = JSON.parse(data.responseText);
        //console.log(response)
        let old_post = '';
        let old_page = '';
        Object.values(response).forEach( function(element, index) {
          var page = ""+Object.keys(element);
          var post = ""+Object.values(element);
          //console.log(page,post)
          if(old_page!=page){
            page_lst.innerHTML = page_lst.innerHTML+'<li class="drop_shadow"><span class="arrow_span" onclick="arrowPage('+"'"+page+"'"+')" id="arrow'+page+'"><span class="material-icons" id="arrowX'+page+'">keyboard_arrow_down</span><i class="material-icons">book</i><span>'+page+'</span ></span><span id="'+page+'" style="display: none;flex-flow: column;"></span></li>';
          }
          old_page=page;
          if(!document.getElementById(post)){
            document.getElementById(page).innerHTML = document.getElementById(page).innerHTML+'<div id="'+post+'" onclick="get_post_content('+post+')">Post#'+post+'</div>';
          }
        });
      }
  });
}
let my_page = false;
function getMemList(pid,pname,my){
  //console.log(pname)
  document.getElementById("loading_icon").style.display = 'block';
  selected_page = pid;
  title = document.getElementById("title");
  title.innerHTML = pname;
  getPageList();
  get_post();
}
function get_reported_page(){
  let form_data = new FormData();
 //   form_data.append('delete','TRUE');
  //  form_data.append("id",id)
    $.ajax({
        url: "./php/get_reported_page.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //get_post();
            console.log(data.responseText)
        }
    });
}