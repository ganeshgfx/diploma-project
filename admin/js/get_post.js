let post_list = document.getElementById("post_list");
function get_post(){
	let form_data = new FormData();
  post_list.innerHTML = "";
  form_data.append("switch",'list');
  form_data.append("selected_page",page_id_name);
	con = $.ajax({
        url: "./php/get_post.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          //console.log(data.responseText);
          var response = JSON.parse(data.responseText);
          response.forEach( function(id, index) {
            post_list.innerHTML = post_list.innerHTML+ '<li class="post_box_ul_li" id="post_'+id+'"></li>';
            get_post_content(id);
          });
          document.getElementById("loading_icon").style.display = 'none';
         smooth_scroll('post_bx');
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
  // post_bx=document.getElementById("post_bx");
  // post_bx.scrollTop = post_bx.scrollHeight - post_bx.clientHeight;
  smooth_scroll("post_bx");
}
function get_post_content(id){
  //page(page_id_name);
  let form_data = new FormData();
  form_data.append("switch",'post');
  form_data.append("pid",id);
  form_data.append("selected_page",7);
  //console.log(pageid);
  $.ajax({
        url: "./php/get_post.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          //console.log(data.responseText);
          post_list.innerHTML = '<li class="post_box_ul_li" id="post_'+id+'"></li>';
          document.getElementById('post_'+id).innerHTML = data.responseText;
          get_reson(id);
        }
    });
}
function get_reson(id){
  document.getElementById('reports_list').innerHTML = "";
  let form_data = new FormData();
  form_data.append("id",id);
  $.ajax({
        url: "./php/get_resons.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          response = JSON.parse(data.responseText)
          response.forEach( function(element, index) {
            //console.log(element);
            document.getElementById('reports_list').innerHTML = document.getElementById('reports_list').innerHTML+'<li>'+element+'</li>';
          });
        }
    });
}