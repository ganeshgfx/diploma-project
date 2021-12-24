let post_list = document.getElementById("post_list");
function get_post(){
  post_list_array_index = 0;
  post_list.innerHTML = "";
  search_order = false;
	let form_data = new FormData();
  form_data.append("switch",'list');
  form_data.append("selected_page",selected_page);
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
          //post_list.innerHTML = "";
          response.forEach(function(id,index){
            post_list.innerHTML = post_list.innerHTML+ '<li class="post_box_ul_li" id="post_'+id+'"></li>';
            setTimeout(get_post_content(id),0);
          });
          document.getElementById("loading_icon").style.display = 'none';
         smooth_scroll('post_bx');
        }
    });
  // post_bx=document.getElementById("post_bx");
  // post_bx.scrollTop = post_bx.scrollHeight - post_bx.clientHeight;
  smooth_scroll("post_bx");
}
let post_list_array = new Array();
let post_list_array_index = 0;

function get_post_content(id){
  let form_data = new FormData();
  form_data.append("switch",'post');
  form_data.append("pid",id);
  form_data.append("selected_page",selected_page);
  $.ajax({
        url: "./php/get_post.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          //console.log(data.responseText)
          var response = JSON.parse(data.responseText);
          document.getElementById('post_'+id).innerHTML = '<table align="center" border="0" class="post_table" id="postT_'+id+'"></table>';
          document.getElementById('post_'+id).innerHTML = response[1];
          //make_post(response.data,id);
          if(!search_order){
            post_list_array[post_list_array_index] = response["data"];
            post_list_array_index++;
          } 
          console.log(response[1]);
        }
    });
}
function make_post(data,id){
  document.getElementById("postT_"+id).innerHTML = '<tr><td>gg</td></tr>';
}
var search_order = false;
let history_tik = "";
function post_sort(by){
  history_tik = by;
  search_order = true;
   post_list.innerHTML = "";
  post_list_array.sort(function(a, b){
    if(!document.getElementById("checkbox-1").checked){
      t=a;
      a=b;
      b=t;
    }
    switch(history_tik){
      case 'like':
        if ( a.like < b.like ){return -1;}
        if ( a.like > b.like ){return 1;}
        return 0;
        break;
      case 'comment':
        if ( a.comment < b.comment ){return -1;}
        if ( a.comment > b.comment ){return 1;}
        return 0;
        break;
      case 'rate':
        if ( a.rate < b.rate ){return -1;}
        if ( a.rate > b.rate ){return 1;}
        return 0;
        break;
      case 'date':
        var d1 = new Date(a.date);
        var d2 = new Date(b.date);
        if ( d1 < d2 ){return -1;}
        if ( d1 > d2 ){return 1;}
        return 0;
        break;
      default:
        return 0;
        break;
    }
  });
  let sorted_post_list_array = post_list_array;
  sorted_post_list_array.forEach( function(element, index) {
    //console.log(element.post_id,element.rate,element.comment,element.like);
    post_list.innerHTML = post_list.innerHTML+ '<li class="post_box_ul_li" id="post_'+element.post_id+'"></li>';
    get_post_content(element.post_id);
    if(document.getElementById("checkbox-2").checked){
      if(element.save != 1){
        //console.log(element.save)
        document.getElementById('post_'+element.post_id).style.display = 'none';
      }
    }
  });
  //console.log(post_list_array);
}
function smooth_scroll(id){
  var div = document.getElementById(id);
  $('#' + id).animate({
      scrollTop: div.scrollHeight - div.clientHeight
  },0);
}