let search_box = document.getElementById("search");
function adjust(){
  document.getElementById('body').style.height = window.innerHeight+"px";
}
function showSearch(di) {
    if (di == 'block') {
        search_box.style.display = di;
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
                    //search_result.style.display = 'none';
                }
            });
        }
    }
}