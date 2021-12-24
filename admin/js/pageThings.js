let page_name = document.getElementById("page_name");
let page_id = document.getElementById("page_id");
let page_info = document.getElementById("page_info");
let page_type = document.getElementById("page_type");
var go = false
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
    console.log(document.getElementById(id).innerHTML)
}