let page_name = document.getElementById("page_name");
let page_id = document.getElementById("page_id");
let page_info = document.getElementById("page_info");
let page_type = document.getElementById("page_type");
var go = false
document.getElementById("page_create").addEventListener("click", function() {
    if (page_name.value == "") {
        go = false;
        page_name.style.borderColor = "red";
        page_name.style.borderWidth = "2px";
        page_name.placeholder = "Input Page Name"
        anime({
            targets: page_name,
            translateX: [0, -10, 0, 10],
            direction: 'alternate',
            duration: 75,
            loop: 4,
            easing: 'easeInOutSine'
        });
        page_name.style.translateX = "(0px)";
    } else {
        go = true;
    }
    if (page_id.value == "") {
        go = false;
        page_id.style.borderColor = "red";
        page_id.style.borderWidth = "2px";
        page_id.placeholder = "Input Page Name"
        anime({
            targets: page_id,
            translateX: [0, -10, 0, 10],
            direction: 'alternate',
            duration: 75,
            loop: 4,
            easing: 'easeInOutSine'
        });
        page_id.style.translateX = "(0px)";
    } else {
        go = true;
    }
    if (go) {
        $.ajax({
            url: "./php/createPage.php",
            type: "POST",
            data: "pn=" + page_name.value + "&pi=" + page_id.value + "&info=" + page_info.value + "&type=" + page_type.value,
            complete: function(data) {
                //console.log(data.responseText);
                getPageList();
            }
        });
        create_page_close();
    }
});
let search_box = document.getElementById("search");

function showSearch(di) {
    if (di == 'block') {
        search_box.style.display = di;
        document.getElementById('search_result').style.display = di;
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
                    document.getElementById('search_result').style.display = 'none';
                    //search_result.style.display = 'none';
                }
            });
        }
    }
}
function imaa_head_out(id){
    //console.log(document.getElementById(id).innerHTML)
    if (confirm("Are You Sure ?")){
    let form_data = new FormData();
    if(document.getElementById(id).innerHTML == 'Leave Page'){
        form_data.append('leave','TRUE');
    }
    if(document.getElementById(id).innerHTML == 'Delete Page'){
        form_data.append('delete','TRUE');
    }
    form_data.append("id",id);
    form_data.append("selected_page",selected_page);
    $.ajax({
        url: "./php/leave_or_delete.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            if(data.responseText=="ok"){
                location.reload();
            }
        }
    });
    }
}