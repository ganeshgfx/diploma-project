let ring_bell = document.getElementById("ring_bell_data");
let notif = document.getElementById("notif_data");
let state = true;
var current_activity = 'NULL'
ring_bell.addEventListener("click", function() {
	//notif.innerHTML = '';
	if(state){
		document.getElementById("notif").style.maxHeight = '90%';
    	state = false;
	}
	else{
		document.getElementById("notif").style.maxHeight = '0%';
		//document.getElementById("notif").style.display = 'none';
		state = true;
	}
});

function get_notified(response){
	//console.log(response)
	NEWinnerHTML = '';
    count = 0;
	response.forEach( function(element, index) {
        count++;
        if(element.page=="chat"){
        	NEWinnerHTML = NEWinnerHTML + '<li><div style="display: flex;"><span class="material-icons" style="color: black;">feedback</span><span style="color: black;">New Message</span></div><div>By '+element.by+'</div></li>';
        }
        if(element.page=="page"){
            NEWinnerHTML = NEWinnerHTML + '<li><div style="display: flex;"><span class="material-icons" style="color: black;">feedback</span><span style="color: black;">New Post</span></div><div>on '+element.by+'</div></li>';
        }
    });
    //console.log(NEWinnerHTML)
    notif.innerHTML = NEWinnerHTML;
    if(NEWinnerHTML != ''){
    	ring_bell.innerHTML = '<i class="material-icons mdl-badge mdl-badge--overlap" data-badge="'+count+'">notifications_none</i>'
    }
    else{
    	ring_bell.innerHTML = '<i class="material-icons">notifications_none</i>'
    }
}
function clear_notifi(){
	$.ajax({
        	url: "../notification/check.php",
        	dataType: 'script',
        	cache: false,
        	contentType: false,
        	processData: false,
        	//data: form_data,
        	type: 'post',
        	complete: function(data){
        		console.log(data.responseText)
        }
    });	
}