//post variable//
let page_Name = document.getElementById("title").innerHTML;
let post_title = document.getElementById("post_title");
let post_file = "";
let post_msg = document.getElementById("post_msg");
let post_tags = document.getElementById("post_tags");
let upload_button = document.getElementById("upload_button");
let post_button = document.getElementById("post_button");
let file_flag = false;
let upload_flag = false;

function update_file_view(){
    post_file = $("#post_file").prop("files")[0];
    file_view.innerHTML = post_file.name;
    file_view.style.display = 'block';
    upload_button.innerHTML = '<span class="material-icons">autorenew</span>Change';
    document.getElementById("remove_file").style.display = 'block';
    file_flag = true;
}
function showrating(id){
    document.getElementById('rating_'+id).style.display = 'flex';
}

function showComment(id){
    //console.log(id)
    let comment_box = document.getElementById("comment_box_"+id);
    if (comment_box.style.display == 'none'){comment_box.style.display = 'flex';comment(id);}
    else{comment_box.style.display = 'none'}
}
function comment(id){
    //console.log('comment_'+id)
    let form_data = new FormData();
    let comment_list = document.getElementById('comment_'+id);
    form_data.append('get','TRUE');
    form_data.append("id",id)
    $.ajax({
        url: "./php/comment.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
        //console.log(comment_list)
          comment_list.innerHTML = data.responseText;
        }
    });
}
function comment_send(id){
    let form_data = new FormData();
    let comment_val = document.getElementById('comment_val'+id);
    form_data.append("selected_page",selected_page)
    form_data.append("id",id)
    form_data.append('comment',comment_val.value);
    form_data.append('send','TRUE');
    $.ajax({
        url: "./php/comment.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            comment(id);
            comment_val.value = "";
            //console.log(data.responseText);
          //comment_list.innerHTML = data.responseText;
        }
    });
}
function postprop(value,todo,id){
let form_data = new FormData();
    form_data.append('id',id);
    form_data.append(todo,value);

    $.ajax({
        url: "./php/postprop.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          //console.log(data.responseText);
          document.getElementById('rating_'+id).style.display = 'none';
        }
    });
    get_post_content(id);
}
// document.getElementById("post_list").addEventListener('DOMNodeInserted', function( event ) {
//     console.log(event.target.id.substr(0,9))
//     if(event.target.tagName=='LI' && event.target.id.substr(0,9) == 'new_post_'){
//         document.getElementById(event.target.id).id = event.target.id.substring(4)
//         console.log(document.getElementById(event.target.id).id)
//         get_post_content(event.target.id);
//     }
// }, false);
function play(id){
    //console.log(id)

    let media = document.getElementById("play_"+id);

    document.getElementById("ply_"+id).style.display = 'none';
    document.getElementById("play_"+id).style.display = 'block';
    document.getElementById("play_"+id).play();
}
function post_option(id){
    let option =  document.getElementById("post_option_"+id);
    //console.log(option.style.display)
    switch(option.style.display){
        case  'block':
            option.style.display = 'none';
            break;
        case  'none':
            option.style.display = 'block';
            break;
        default:
            option.style.display = 'block';
            break;
    }
}
function post_delete(id){
    //console.log(id)
    let form_data = new FormData();
    form_data.append('delete','TRUE');
    form_data.append("id",id)
    $.ajax({
        url: "./php/delete_report.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            post_list.innerHTML = "";
            page_lst.innerHTML = "";
            getPageList();
            //console.log(data.responseText)
        }
    });
}
