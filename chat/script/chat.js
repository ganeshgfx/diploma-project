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
function adjust(){
      document.getElementById('body').style.height = window.innerHeight+"px";
}
adjust();
//get friends
function getfrnd() {
    $.ajax({
        url: "../chat/script/get_friends.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        complete: function(data){
            document.getElementById("friends_lst").innerHTML  = data.responseText;
        }
    });
 }
getfrnd();
//setTimeout(function(){},100);
//set reciver name
var rname = "";
function old_select_id(id){
  document.getElementById(id).style.backgroundColor  = 'white';
  document.getElementById(id).style.color = 'black';
  //console.log(id) 
}
id_old = 'none';
function setreciver(riname,id,sr_id){
  //console.log(riname+'_upic')
  reciver_profile = document.getElementById(riname+'_upic').src;
  tempC = "0";
  newC = "0"; 
  if (id_old!='none') {old_select_id(id_old);}
  id_old = id;
  current_activity = sr_id;
  document.getElementById(id).style.backgroundColor  = '#2196f3';
  document.getElementById(id).style.color = 'white';
  //getfrnd();
  rname = riname;
  //document.getElementById("chat").innerHTML = '';
  document.getElementById("chat_title_name").innerHTML = rname;
  document.getElementById("title_name").innerHTML = rname;
  getmsg("b");
  // setTimeout(function(){scrollToBottomFast()},100);
  // scrollToBottomFast();
} 
//send msg
// function fixMsg(msgO){
//   if(msgO.length==1){
//     return msgO;
//   }
//   else{
//   var msgF = "";
//   var cnt = 0; 
//   for (var i = 0; i < msgO.length; i++) {
//     msgF = msgF + msgO[i];
//     if(msgO[i] == " "){
//       cnt++;
//       if(cnt==5){
//         // msgF = msgF + "<br>";
//         cnt=0;
//       }
//     }
//   }
//   return msgF;
//   // console.log(msgF);
//   }
// }
function sendmsg(){
  var send_msg = document.getElementById("msg").value;
  if(document.getElementById("msg").value != "" && rname != ""){
    ///////////////////////
    let form_data = new FormData();
    form_data.append('sms',send_msg);
    form_data.append('reciver',rname);
    $.ajax({
        url: "../chat/script/send.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //console.log(data.responseText)
            setTimeout(function(){
              getmsg();
              newC = 0;
              tempC = 0;
            },0);
        }
    });
    ///////////////////////////////
    document.getElementById("msg").value = "";
  }
}
//get msg
/////////////////////////SCRL AREA
function scrollToBottomFast(){
  var div = document.getElementById("stst");
  document.getElementById("SlBtn").innerHTML = "";
  div.scrollTop = div.scrollHeight - div.clientHeight;
}
function scrollToBottom() {
  document.getElementById("SlBtn").innerHTML = '';
  var id = 'stst';
  var div = document.getElementById(id);
  $('#' + id).animate({
    scrollTop: div.scrollHeight - div.clientHeight
  }, 350);
  //console.log("SMOTH ! scrol");
}
var scrlP = "";
function scrl_UPDOWN(){
    var div = document.getElementById("stst");
    if(div.scrollTop == div.scrollHeight - div.clientHeight){
      document.getElementById("SlBtn").innerHTML = '';
      scrlP="sb";
    }
    if(div.scrollTop != div.scrollHeight - div.clientHeight){
      document.getElementById("SlBtn").innerHTML = '<button onclick=" scrollToBottom()"><span class="material-icons">keyboard_arrow_down</span></button>';
      scrlP="m";
    }
}
function online_update(xlist){
  //console.log(xlist)
  var xlist = JSON.parse(xlist);
  xlist.forEach( function(element,index) {
    key = Object.keys(element);
    value = Object.values(element);
    if(value[0]){
      document.getElementById(key[0]+"_u").style.backgroundColor = '#4CAF50';
      document.getElementById(key[0]+"_u").style.color = 'white';
    }
    else{
      document.getElementById(key[0]+"_u").style = '';
    }
    //   document.getElementById(+"_upic")
  });
    // border-color: ;
    // border-style: solid;
    // box-shadow: 1px 1px 3px #00000052;
    // console.log(element);
}
/////////
var newC = 0;
var tempC = 0; 
function connect_fetch(){
  //getmsg_cnt();
    if (true){
    let form_data = new FormData();
    form_data.append('rvname',rname);
    form_data.append('switch',"0");
    form_data.append('at',current_page);
    form_data.append('on',current_activity);
    $.ajax({
        url: "../chat/script/recive.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //console.log(data.responseText)
            var response = JSON.parse(data.responseText);
            //console.log(response)
            setTimeout(online_update(response.online),0);
            get_notified(JSON.parse(response.notice))
            newC = response.count;
            if(tempC == 0){
              tempC = newC;
            }
            called = false;
            if(newC != tempC){
              //scrl_UPDOWN();
              setTimeout(function(){getmsg();},0);
              tempC = newC;
            }
        }
    });
  }
}
setInterval(function(){
  //console.log(1)
    connect_fetch()
  },5000);
//connect_fetch();
/////////////////////////////////////////////////////////////////NEW add if else
function getmsg_cnt() {
  //if (rname != "")
}
function getmsg(flg) {
  if (rname != ""){
    //console.log(2)
    let form_data = new FormData();
    form_data.append('rvname',rname);
    form_data.append('switch',"1");
    $.ajax({
        url: "../chat/script/recive.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
          var response = JSON.parse(data.responseText);
          //console.log(response);
          var sms = '';
          response.forEach(function(element,index){

            //setTimeout(function(){
              sms = sms + writeSMS(element);
            //},0);

        });
          document.getElementById("chat").innerHTML = sms;
          scrollToBottom();
        }
    });
  }
}
function writeSMS(element){
  if(element.my){
    align="right";
    classs="chat_u";
    pic = '<td></td><td><img class="chat_pic" src="'+my_profile+'"></td>';
    msg = '<td><p id="'+element.id+'">'+element.msg+'</p></td><td class="dele_chat" onclick="dele_chat('+element.id+')"><span>X</span></td>';
  }
  else{
    align="left";
    classs="chat_r";
    pic = '<td><img class="chat_pic" src="'+reciver_profile+'"></td><td></td>';
    msg = '<td></td><td><p id="'+element.id+'">'+element.msg+'</p></td>';
  }
  var sms = '<tr id="'+element.id+'"><td align="'+align+'"><div><table border="0" class="'+classs+'"><tr>'+msg+'</tr><tr>'+pic+'</tr></table></div></td></tr>'
  return sms;
  //setTimeout(function(){document.getElementById("chat").innerHTML = document.getElementById("chat").innerHTML + sms;scrollToBottomFast()},0);
  //console.log(1);
}
///use sesion
//make http small
function menuBar(mm){
  console.log(mm);
}
function dele_chat(sr){
  msg_txt = document.getElementById(sr).innerHTML;
  if (confirm('Are you Sure ?, Delete "'+msg_txt+'"')){
    //console.log(sr)
    let form_data = new FormData();
    form_data.append('sr',sr);
    $.ajax({
        url: "../chat/script/chat_delete.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        complete: function(data){
            //console.log(data.responseText)
            if(data.responseText=='ok'){
              document.getElementById('chat_sr_'+sr).style.display='none';
            }
        }
    });
  }
}