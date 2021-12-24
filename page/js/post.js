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
//
let post_form = document.getElementById("post_form");
document.getElementById("PostButton").addEventListener("click", function() {
    post_form.style.display = 'block';
});
document.getElementById("post_form_X").addEventListener("click", function() {
    post_form.style.display = 'none';
});

let file_view = document.getElementById("upload_file_name");
document.getElementById("upload_button").addEventListener("click", function() {
    document.getElementById('post_file').click();
});

function update_file_view(){
    post_file = $("#post_file").prop("files")[0];
    file_view.innerHTML = post_file.name;
    file_view.style.display = 'block';
    upload_button.innerHTML = '<span class="material-icons">autorenew</span>Change';
    document.getElementById("remove_file").style.display = 'block';
    file_flag = true;
}
document.getElementById("remove_file").addEventListener("click", function() {
    post_file = null;
    document.getElementById("remove_file").style.display = 'none';
    file_view.style.display = 'none';
    file_flag = false;
    upload_button.innerHTML = '<span class="material-icons">cloud_upload</span> Upload File';
});
post_msg.addEventListener("input",function(){
    if(post_msg.value!=""){post_button.disabled = false;}
    else{post_button.disabled = true;}
});
post_button.addEventListener("click",function(){
    //page_Name = document.getElementById("title").innerHTML
    var form_data = new FormData();
    form_data.append("selected_page",selected_page);
    // if(post_title.value==""){
    //     alert("Input Post Title");
    // }
    // else {
    //     form_data.append("post_title",post_title.value);
    // }
    if (file_flag){
        form_data.append("post_file",post_file)
        form_data.append("post_file_type",post_file.type)
    }
    if(post_msg.value==""){
        upload_flag = false;
        alert("Input Post Massage");
    }
    else {
        upload_flag = true;
        form_data.append("post_msg",post_msg.value);
    }
    if(post_tags.value==""){
        upload_flag = false;
        alert("One or more Tags Required");
    }
    else{
        upload_flag = true;
        form_data.append("post_tags",post_tags.value);
    }
    //form_data.append("post_tags",post_tags.value);
    if (upload_flag){
    var g = $.ajax({
        url: "./php/send_post.php", // Upload Script
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        complete: function(data){
          console.log(data.responseText);
          if(data.responseText=="ok"){
            //get_post();
            document.getElementById("post_form_X").click();
            get_post();
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
              //document.getElementById("progress_up").innerHTML = 'Uploading '+Math.ceil(percentComplete*100)+' % Compleated';
           }
       }, false);
       return xhr;
    }
    });
    }
    //get_post();
});
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
let media = '';
function play(id){
    //console.log(id)
    media = document.getElementById("play_"+id);
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
function post_report(id){
    //console.log(id)
    let form_data = new FormData();
    form_data.append('report','TRUE');
    form_data.append("id",id);
    form_data.append("reason",prompt("Enter Reason : "));
    form_data.append("selected_page",selected_page);
    $.ajax({
        url: "./php/delete_report.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //console.log(data.responseText)
            if(data.responseText != 'ok'){
                alert("Already Reported");
            }
        }
    });
}
function post_delete(id){
    //console.log(id)
    if (confirm('Delete Post')){
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
            get_post();
            //console.log(data.responseText)
        }
    });
    }
}
