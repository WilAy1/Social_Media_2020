const nev = new Event('newmessage', {

});
if(window.location.href.includes("/messages")){
  if('Notification' in window){
  let permission = Notification.requestPermission();
    if(permission != 'granted'){
        Notification.requestPermission()
}
}
}
function newMessage(message){
if(Notification.permission == 'granted'){
    const notf = new Notification(message.sender, {
      body: message.m.substr(0, 150),
      icon: '/students_connect/ico/studco.png' 
    })
    setTimeout(notf.close(), 10000);
    notf.onclick = function(){
      notf.close();
      if(window.closed){
      window.open('/students_connect/messages?n='+message.sender, '_self');
    }
    else {
      window.focus();
    }
    }
    return true;
  }
  else {
    return false;
  }
}
    function Redirect() {
        window.location="profile.php"
    }
    

    
    function checkOnline() {
    var x = navigator.onLine;
    if(x===true){
        document.getElementById('online').style.display = 'block';
        document.getElementById('online').innerHTML = "Online";

    }
    else {
    document.getElementById('offline').style.display = 'block';
    document.getElementById('offline').innerHTML = "Offline";
}   
}
function chAry(data, inarray){
  var c = 0;
  inarray.forEach((b)=> (b === data && c++));
  return c;
}
function vsmiw() {
    var x = document.getElementById('dfun').value;
    var y = document.getElementById('choose-img').value;
    var a = document.getElementById('tfpoll').value;
    var b = document.getElementById('tspoll').value;
    var c = document.getElementById('ttpoll').value;
    var d = document.getElementById('tfopoll').value;
    var t = document.getElementsByClassName('chtype')[0].children[0];
    var ty = document.getElementById('thetagtext').value;
    var spt = x.split('\n');
    var go = [];
    for(var k = 0; k < spt.length; k++){
    var tlk = spt[k].split(" ");
    var mlk = chAry('', tlk);
      if(tlk.length == mlk){
        go.push(true);
      }
      else {
          go.push(false);
      }
    }
    if(a==null || b == null || c == null || d===null){
      document.getElementById('thiddenone').value = 'false';
    }
    else {
      document.getElementById('thiddenone').value = 'true';
    }
    if ((go.length == chAry(true, go)) && ( y == '' || y == null)) {
        document.getElementById("err").innerHTML = 'Write Something or Choose an image';
        return false;
    }
    if(ty == '' && t.checked && t.value !='1'){
      document.getElementById("err").innerHTML = 'Tag this post';
      return false
    }
     return true;
  }
/*function storeDark(){
    var slider = document.getElementById('input');
    if(typeof(Storage) !== "undefined") {
        if (slider.checked == true){
            var d = new Date();
            d.setTime(d.getTime() + (24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = "drkmd=1; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
            sessionStorage.switch = 1;
        }
        else {
            document.cookie = "drkmd=0; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
            sessionStorage.switch = 2; 
        }
    
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

var a = getCookie('drkmd');
if(a == 1){
    document.getElementById('darkmd').style.backgroundColor = '#282b2f';
    document.getElementById('darkmd').style.color = 'white';
}
else {
    document.getElementById('darkmd').style.backgroundColor = 'white';
    document.getElementById('darkmd').style.color = 'black';
}
}
function checkDark(){
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }
    var a=getCookie('drkmd');

    if(a == 1){
        document.getElementById('darkmd').style.backgroundColor = '#282b2f';
        document.getElementById('darkmd').style.color = 'white';
}
else {
    document.getElementById('darkmd').style.backgroundColor = 'white';
    document.getElementById('darkmd').style.color = 'black';
}
}*/
function readURL(input){
    if (input.flies && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#shwmyimg').attr('src', e.target.result)
                .width(150).height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function contactForm(){
    document.getElementById('fcf').style.display = "block";
};
function displayComment(){
    document.getElementById("addcom").style.display = "flex";
}

function save(str){
document.getElementById('yww').value = str;
}

function sndMsg(val, grp, usr){
  if(val == " "){
    //dont do anything
  }
  else {
  document.getElementById('mesgtxt').value="";
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('wka').innerHTML = xmlhttp.responseText;
          if(document.getElementById('darkmd')){
            document.getElementById('darkmd').style.minHeight = document.documentElement.scrollHeight+'px';
            document.getElementById('darkmd').style.minHeight = document.body.scrollHeight+'px';
          }
        }
                  };
                  xmlhttp.open('GET', '/students_connect/messages/svgrmsg.php?msg='+val+"&grp="+grp+"&usr="+usr);
                  xmlhttp.send("msg="+val+"&grp="+grp+"&usr="+usr);
}
}
function goBck(){
          document.getElementById('wcws').style.display='none';
          document.getElementById('amib').style.display='block';
}
function opninf(name, grpname){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('amib').style.display='none';
          document.getElementById('wcws').style.display='none';
          document.getElementById('dinf').style.display='block';
          document.getElementById('dinf').innerHTML = xmlhttp.responseText;
        }
                  };
                  xmlhttp.open('POST', '/students_connect/messages/shwinf.php?user='+name);
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlhttp.send("user="+name+"&grpname="+grpname);
}
function gbtm(nmu, nmg){
  var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          document.getElementById('amib').style.display='none';
                          document.getElementById('wcws').style.display='block';
                          document.getElementById('dinf').style.display='none';
                          document.getElementById('wcws').innerHTML = xmlhttp.responseText;
                        }
                  };
                  xmlhttp.open('POST', '/students_connect/messages/gtmsg.php');
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlhttp.send("usnm="+nmu+"&grpname="+nmg);
}
function editpostvalue(post){
    post = post.replace(/\n/g,"<br/>");
    document.getElementById('mpst').innerHTML = post;
}
function saveeditpost(postid, post, user){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {        
        if (xmlhttp.readyState == 3) {
        document.getElementById('ldng').innerHTML = 'Updating Post. Please Wait...';
        }
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById('ldng').innerHTML = 'Done.'; 
     }
    
};
  xmlhttp.open('POST', '/students_connect/posts/editpost/');
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("user="+user+"&post="+post+"&postid="+postid);
}
function fxvl(){
    if(document.getElementById('pop2').checked == true){
        document.getElementById('grppass').style.display = 'none';
      }
      else if(document.getElementById('pop1').checked == true){
        document.getElementById('grppass').style.display = 'none';
        document.getElementById('dpass').value = '';
 }
}
function openGroupSettings(cuser, gid){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('amib').style.display='none';
            document.getElementById('wcws').style.display='none';
            document.getElementById('dinf').style.display='block';
            document.getElementById('dinf').innerHTML = xmlhttp.responseText;
          }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/shwinf.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("cuser="+cuser+"&gid="+gid);     
  }
  function gbtgm(user, groupid){
   document.getElementById('dinf').style.display = 'none';
    opengroup(user, groupid);
}



function gAdmins(admin, id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(document.getElementById('lgad').innerHTML.length == 0){
            document.getElementById('cac').className = document.getElementById('cac').className.replace('right', 'down');
            document.getElementById('lgad').innerHTML = xmlhttp.responseText;
            }
            else {
                document.getElementById('cac').className = document.getElementById('cac').className.replace('down', 'right');
            document.getElementById('lgad').innerHTML = "";
            }  
        }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/groupst.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("admin="+admin+"&grpid="+id);
}
    function mgMbs(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('sntb').innerHTML = xmlhttp.responseText;
              }
                        };
                        xmlhttp.open('POST', '/students_connect/messages/groupst.php');
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("mgrpid="+id);   
    }
function cGl(id, link, cuser) {
    if(document.getElementById('glnks').innerHTML.length == 0){
        document.getElementById('clc').className = document.getElementById('clc').className.replace('right', 'down');
        document.getElementById('glnks').innerHTML =
        '<input type="text" value="http://localhost:8080/students_connect/messages?group='+link+'" placeholder="Edit Link" id="gld" autocomplete="off" readonly/>' + 
        '<div class="cplk" title="Copy Link" style="padding: 5px;" onclick="copy()">'
        + '<i class="fas fa-copy"></i></div><div title="Revoke Link" class="rvlnk" style="padding: 5px;" onclick="revoke(\''+id+'\', \''+cuser+'\')">Revoke</div>';
    }
    else {
        document.getElementById('clc').className = document.getElementById('clc').className.replace('down', 'right');
        document.getElementById('glnks').innerHTML = '';
    }
}
function copy(){
    var val = document.getElementById('gld');
    val.select();
    val.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.getElementById('ko_llert').innerHTML = 'Copied';
    document.getElementById('middlefor').style.display = 'block';
    window.onscroll = function(){
      document.getElementById('middlefor').style.display = 'none'; 
    }
    window.onresize = function(){
      document.getElementById('middlefor').style.display = 'none'; 
    }
  }
function adSt(){
    if(document.getElementById('gasts').innerHTML.length == 0){
        document.getElementById('cadc').className = document.getElementById('cadc').className.replace('right', 'down');
        document.getElementById('gasts').innerHTML = '<div class="adslst"></div>';
    }
else {
        document.getElementById('cadc').className = document.getElementById('cadc').className.replace('down', 'right');
        document.getElementById('gasts').innerHTML = '';
    }
}
function revoke(rid, ruser){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('gld').value = 'http://localhost:8080/students_connect/messages?group=' + xmlhttp.responseText;
          }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/groupst.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("rid="+rid+"&ruser="+ruser);
 }
function grpD(id, user){
    document.getElementById('dltgrp').innerHTML = '<div class="stdg">'
    + '<div class="dqst">Delete Group</div>'+
    '<div class="rusr">Are you sure you want to delete this group?</div>'+
    '<div class="drpns"><div class="cfdlt">Confirm Delete</div>'+
    '<div class="cncdlt">Cancel</div></div></div>';
}
function ucm(postid, commentid, user){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(document.getElementById('dror'+commentid).style.color == 'red'){
                document.getElementById('dror'+commentid).style.color = 'inherit';
                document.getElementById('ror'+commentid).style.color = 'green';
            }
            else {
                document.getElementById('ror'+commentid).style.color = 'green';
            }
        }
                    };
                    xmlhttp.open('POST', '/students_connect/profile.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("upeducommentid="+commentid+"&upedupostid="+postid+"&user="+user);
}
function lvec(tpid, coid, user){
    if(document.getElementById('tclfh'+coid).style.color == 'pink'){
        document.getElementById('tclfh'+coid).style.color = 'inherit';
    }
    else {
        document.getElementById('tclfh'+coid).style.color = 'pink';
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        }
                    };
                    xmlhttp.open('POST', '/students_connect/posts/reactions.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("soccommentid="+coid+"&lvsocpostid="+tpid+"&user="+user);
}
function dcm(dpostid, dcommentid, user){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(document.getElementById('ror'+dcommentid).style.color == 'green'){
                document.getElementById('ror'+dcommentid).style.color = 'inherit';
                document.getElementById('dror'+dcommentid).style.color = 'red';
            }
            else {
                document.getElementById('dror'+dcommentid).style.color = 'red';
            }
        }
                    };
                    xmlhttp.open('POST', '/students_connect/profile.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("dwneducommentid="+dcommentid+"&dwnedupostid="+dpostid+"&user="+user);
}
function ducm(postid, commentid, user){
    var currentupvote = parseInt(document.getElementById('utcnt'+commentid).innerHTML);
            var currentdownvote = parseInt(document.getElementById('dutcnt'+commentid).innerHTML);
            if(document.getElementById('ror'+commentid).style.color == 'green'){
                // do nothing
            }
            else if(document.getElementById('dror'+commentid).style.color == 'red'){
                document.getElementById('dror'+commentid).style.color = 'inherit';
                document.getElementById('ror'+commentid).style.color = 'green';
                document.getElementById('utcnt'+commentid).innerHTML = currentupvote + 1;
                document.getElementById('dutcnt'+commentid).innerHTML = currentdownvote - 1;
            }
            else {
                document.getElementById('ror'+commentid).style.color = 'green';
                document.getElementById('utcnt'+commentid).innerHTML = currentupvote + 1;
            }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
                    };
                    xmlhttp.open('POST', '/students_connect/posts/reactions.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("upeducommentid="+commentid+"&upedupostid="+postid+"&user="+user);
}
function ddcm(dpostid, dcommentid, user){
    var currentupvote = parseInt(document.getElementById('utcnt'+dcommentid).innerHTML);
            var currentdownvote =parseInt(document.getElementById('dutcnt'+dcommentid).innerHTML);
            if(document.getElementById('dror'+dcommentid).style.color == 'red'){
                //do nothing
                
            }
            else if(document.getElementById('ror'+dcommentid).style.color == 'green'){
                document.getElementById('ror'+dcommentid).style.color = 'inherit';
                document.getElementById('dror'+dcommentid).style.color = 'red';
                document.getElementById('utcnt'+dcommentid).innerHTML = currentupvote - 1;
                document.getElementById('dutcnt'+dcommentid).innerHTML = currentdownvote + 1;
            }
            else {
                document.getElementById('dror'+dcommentid).style.color = 'red';
                document.getElementById('dutcnt'+dcommentid).innerHTML = currentdownvote + 1;
            }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
                    };
                    xmlhttp.open('POST', '/students_connect/posts/reactions.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("dwneducommentid="+dcommentid+"&dwnedupostid="+dpostid+"&user="+user);
}

function share(id){
    var modal = document.getElementById('oe'+id);
        var btn = document.getElementById("sh"+id);
        var span = document.getElementsByClassName("close"+id)[0]; 
            modal.style.display = "block";
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }          
}
function op(id, sb){
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      document.getElementById('pageisloading').style.display = 'block';    
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById('pageisloading').style.display = 'none';
            document.getElementById('quest').innerHTML = xmlhttp.responseText
            window.history.pushState("", sb, '/students_connect/posts/'+id+'/')
            
        }
                    };
                    xmlhttp.open('GET', '/students_connect/posts/pst/?pid='+id+'&cid');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send();
                }
function ops(id, sb){
    console.log(this.ops)
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      document.getElementById('pageisloading').style.display = 'block';
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('pageisloading').style.display = 'none';
            document.getElementById('quest').innerHTML = xmlhttp.responseText
            window.history.pushState("", sb, '/students_connect/posts/s'+id+'/');
            
        }
                    };
                    xmlhttp.open('GET', '/students_connect/posts/pst/?spid='+id);
                    xmlhttp.send();
}
function goBack(page){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.history.pushState("", "", page+'/')
            document.write(xmlhttp.responseText)
            return document.getElementById('quest').innerHTML = xmlhttp.responseText;
        }
                    };
                    xmlhttp.open('GET', '/students_connect/user/WilAy');
                    xmlhttp.send();
}
function storeDark(){  
  var slider = document.getElementById('input');
    if(typeof(Storage) !== "undefined") {
        if (slider.checked == true){
            var d = new Date();
            d.setTime(d.getTime() + (24*60*60*1000*60));
            var expires = "expires="+d.toUTCString();
            document.cookie = "drkmd=1; expires=Thu, 31 Dec 2050 12:00:00 UTC; path=/";
            sessionStorage.switch = 1;
        }
        else {
            document.cookie = "drkmd=0; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
            sessionStorage.switch = 2; 
        }
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
var a = getCookie('drkmd');
if(a == 1){
  document.getElementById('darkmd').style.backgroundColor = '#282b2f';
    document.getElementById('darkmd').style.color = 'white';
    if(document.getElementsByClassName('ma_li_mp')[0]){
      document.getElementsByClassName('ma_li_mp')[0].style.backgroundColor = '#282b2f';
    }
    if(document.getElementsByClassName('ttr')[0]){
        document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgba(15,15,15,0.7)';
        a = document.getElementsByClassName('tgd')
        for(x =0; x < a.length; x++){
           a[x].style.color='white'
            a[x].getElementsByTagName('a')[0].style.color = 'white'; 
        }
    }
    if(document.getElementsByClassName('dchngr')[0]){
        document.getElementsByClassName('dchngr')[0].checked = true;
    }
    /*if(document.getElementsByClassName('dwn')){
    var dwn = document.getElementsByClassName('dwn');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
}*/
if(document.getElementsByClassName('oe')[0]){
  document.getElementsByClassName('oe')[0].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
if(window.innerWidth > 799){
if(document.getElementsByClassName('std_yx')[0]){
  a = document.getElementsByClassName('std_yx')
for(x =0; x < a.length; x++){
  a[x].style.color='white' 
  a[x].style.backgroundColor = '#282b2f';
}
}
}
if(document.getElementsByClassName('mddrt')){
var dwn = document.getElementsByClassName('mddrt');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
}
if(document.getElementsByClassName('comment_section')){
var dwn = document.getElementsByClassName('comment_section');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
}
if(document.getElementsByClassName('posted')){
var dwn = document.getElementsByClassName('posted');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.color = 'white';
}
}
if(document.getElementsByClassName('shwrep')){
    var dwn = document.getElementsByClassName('shwrep');
        for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
    }
    }
    if(document.getElementsByClassName('tsp')){
        var dwn = document.getElementsByClassName('tsp');
            for(i = 0; i < dwn.length; i++){
                dwn[i].style.boxShadow = '1px 1px 1px 1px rgba(15, 15, 15, 0.7)';
        }
    }
    if(window.innerWidth < 799 && (document.getElementsByClassName('ttr'))){
      document.getElementsByClassName('ttr')[0].style.backgroundColor = 'rgb(40, 43, 47)';
      var x = document.getElementsByClassName('ttr'); 
          for(var y =0; y<x.length; y++){
            x[y].style.color = 'white';
            var e = x[y].children;
            for(var i = 0; i < e.length; e++){
              e[i].style.color = 'white';
              var o = e[i].children; 
            for(var t = 0; t < o.length; t++){
              o[t].style.color = 'white';
            }
            }
          }
          $('.icf').css('color', 'white');
            $('.shwname a').css('color', 'white');
    }
}
else {
document.getElementById('darkmd').style.backgroundColor = 'white';
document.getElementById('darkmd').style.color = 'black';
if(document.getElementsByClassName('ma_li_mp')[0]){
  document.getElementsByClassName('ma_li_mp')[0].style.backgroundColor = 'white';
}
if(document.getElementsByClassName('ttr')[0]){
    document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgba(245,245,245,1)';
    a = document.getElementsByClassName('tgd')
        for(x =0; x < a.length; x++){
           a[x].style.color='black'
            a[x].getElementsByTagName('a')[0].style.color = 'black'; 
        }
}
if(window.innerWidth < 799 && (document.getElementsByClassName('ttr'))){
  document.getElementsByClassName('ttr')[0].style.backgroundColor = 'white';
  var x = document.getElementsByClassName('ttr'); 
      for(var y =0; y<x.length; y++){
        x[y].style.color = 'black';
        var e = x[y].children;
        for(var i = 0; i < e.length; e++){
          e[i].style.color = 'black';
          var o = e[i].children; 
        for(var t = 0; t < o.length; t++){
          o[t].style.color = 'black';
        }
        }
      }
      $('.icf').css('color', 'black');
            $('.shwname a').css('color', 'black');
}
if(document.getElementsByClassName('dchngr')[0]){
    document.getElementsByClassName('dchngr')[0].checked = false;
}
//if(document.getElementsByClassName('dwn')){
 //   var dwn = document.getElementsByClassName('dwn');
  //      for(i = 0; i < dwn.length; i++){
   //     dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
//}
//}
if(window.innerWidth > 799){
if(document.getElementsByClassName('std_yx')[0]){
  a = document.getElementsByClassName('std_yx')
for(x =0; x < a.length; x++){
  a[x].style.color='black' 
  a[x].style.backgroundColor = 'white';
}
}
}
if(document.getElementsByClassName('mddrt')){
var dwn = document.getElementsByClassName('mddrt');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
}
}
if(document.getElementsByClassName('comment_section')){
var dwn = document.getElementsByClassName('comment_section');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
}
}
if(document.getElementsByClassName('posted')){
var dwn = document.getElementsByClassName('posted');
    for(i = 0; i < dwn.length; i++){
    dwn[i].style.color = 'black';
}
}
if(document.getElementsByClassName('shwrep')){
    var dwn = document.getElementsByClassName('shwrep');
        for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
    }
    }
    if(document.getElementsByClassName('tsp')){
        var dwn = document.getElementsByClassName('tsp');
            for(i = 0; i < dwn.length; i++){
                dwn[i].style.boxShadow = '1px 1px 1px 1px rgb(173, 173, 173)';
        }
}
}
}
function checkDark(){  
  function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }
    var a=getCookie('drkmd');

    if(a == 1){
      if(document.getElementById('darkmd')){  
        document.getElementById('darkmd').style.backgroundColor = '#282b2f';
        document.getElementById('darkmd').style.color = 'white';
      }
      if(document.getElementsByClassName('ma_li_mp')[0]){
        document.getElementsByClassName('ma_li_mp')[0].style.backgroundColor = '#282b2f';
      }
        if(document.getElementsByClassName('ttr')[0]){
            document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgba(15,15,15,0.7)';
            a = document.getElementsByClassName('tgd')
        for(x =0; x < a.length; x++){
           a[x].style.color='white'
            a[x].getElementsByTagName('a')[0].style.color = 'white'; 
        }
        }
        if(document.getElementsByClassName('dchngr')[0]){
            document.getElementsByClassName('dchngr')[0].checked = true;
        }
        //if(document.getElementsByClassName('dwn')){
        //var dwn = document.getElementsByClassName('dwn');
          //  for(i = 0; i < dwn.length; i++){
            //dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
    //}
//}
if(document.getElementsByClassName('mddrt')){
    var dwn = document.getElementsByClassName('mddrt');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
}
if(document.getElementsByClassName('comment_section')){
    var dwn = document.getElementsByClassName('comment_section');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
}
}
if(document.getElementsByClassName('posted')){
    var dwn = document.getElementsByClassName('posted');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.color = 'white';
}
}
if(document.getElementsByClassName('shwrep')){
    var dwn = document.getElementsByClassName('shwrep');
        for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
    }
    }
if(document.getElementsByClassName('f_jaaheading')[0]){
  document.getElementsByClassName('f_jaaheading')[0].style.backgroundColor = '#282b2f';
}
    if(document.getElementsByClassName('tsp')){
        var dwn = document.getElementsByClassName('tsp');
            for(i = 0; i < dwn.length; i++){
                dwn[i].style.boxShadow = '1px 1px 1px 1px rgba(15, 15, 15, 0.7)';
        }
        }
        if(window.innerWidth < 799){
          if(document.getElementsByClassName('ttr')[0]){
          document.getElementsByClassName('ttr')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          var x = document.getElementsByClassName('ttr'); 
              for(var y =0; y<x.length; y++){
                x[y].style.color = 'white';
                var e = x[y].children;
                for(var i = 0; i < e.length; e++){
                  e[i].style.color = 'white';
                  var o = e[i].children; 
                for(var t = 0; t < o.length; t++){
                  o[t].style.color = 'white';
                }
                }
              }
              $('.icf').css('color', 'white');
            $('.shwname a').css('color', 'white');
        }
      }
    }
else {
  if(document.getElementById('darkmd')){
    document.getElementById('darkmd').style.backgroundColor = 'white';
    document.getElementById('darkmd').style.color = 'black';
    }
    if(document.getElementsByClassName('ma_li_mp')[0]){
      document.getElementsByClassName('ma_li_mp')[0].style.backgroundColor = 'white';
    }
    if(document.getElementsByClassName('ttr')[0]){
        document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgba(245,245,245,1)';
        a = document.getElementsByClassName('tgd')
        for(x =0; x < a.length; x++){
           a[x].style.color='black'
            a[x].getElementsByTagName('a')[0].style.color = 'black'; 
        }
    }
    if(window.innerWidth < 799 && (document.getElementsByClassName('ttr') == true)){
      document.getElementsByClassName('ttr')[0].style.backgroundColor = 'white';
      var x = document.getElementsByClassName('ttr'); 
          for(var y =0; y<x.length; y++){
            x[y].style.color = 'black';
            var e = x[y].children;
            for(var i = 0; i < e.length; e++){
              e[i].style.color = 'black';
              var o = e[i].children; 
            for(var t = 0; t < o.length; t++){
              o[t].style.color = 'black';
            }
            }
            $('.icf').css('color', 'black');
            $('.shwname a').css('color', 'black');
          }
    }
    if(document.getElementsByClassName('dchngr')[0]){
        document.getElementsByClassName('dchngr')[0].checked = false;
    }
    if(document.getElementsByClassName('dwn')){
        var dwn = document.getElementsByClassName('dwn');
            for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
    }
}
if(document.getElementsByClassName('mddrt')){
    var dwn = document.getElementsByClassName('mddrt');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
}
}
if(document.getElementsByClassName('f_jaaheading')[0]){
  document.getElementsByClassName('f_jaaheading')[0].style.backgroundColor = 'white';
}
if(document.getElementsByClassName('comment_section')){
    var dwn = document.getElementsByClassName('comment_section');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
}
}
if(document.getElementsByClassName('posted')){
    var dwn = document.getElementsByClassName('posted');
        for(i = 0; i < dwn.length; i++){
        dwn[i].style.color = 'black';
}
}
if(document.getElementsByClassName('shwrep')){
    var dwn = document.getElementsByClassName('shwrep');
        for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
    }
    }
if(document.getElementsByClassName('tsp')){
        var dwn = document.getElementsByClassName('tsp');
            for(i = 0; i < dwn.length; i++){
                dwn[i].style.boxShadow = '1px 1px 1px 1px rgb(173, 173, 173)';
            }
}
}
}
function gin(id){
    var dbe = document.getElementsByClassName('arsltd'+id)
    var selected = new Array();
    for(var i = 0; i < dbe.length; i++){
        if(dbe[i].checked){
         selected.push(dbe[i].value);
         document.getElementById('countsend'+id).innerHTML = selected;
        }
    }
}
function sall(id){
    if(document.getElementsByClassName('selectall'+id)[0].checked){
        var dbe = document.getElementsByClassName('arsltd'+id)
        var selected = new Array();
        for(var i = 0; i < dbe.length; i++){
            dbe[i].checked = true; 
            selected.push(dbe[i].value);
            document.getElementById('countsend'+id).innerHTML = selected;
        }
    }
    else{
        var dbe = document.getElementsByClassName('arsltd'+id)
        var selected = new Array();
        for(var i = 0; i < dbe.length; i++){
            dbe[i].checked = false; 
            selected.push(dbe[i].value);
            document.getElementById('countsend'+id).innerHTML = '';
        }
    }
}
function sendShare(user, type, id){
    var sendto = document.getElementById('countsend'+id).innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('countsend'+id).innerHTML = xmlhttp.responseText;
        }
                    };
                    xmlhttp.open('GET', '/students_connect/messages/sharedmessage.php?user='+user+'&sendto='+sendto+'&id='+id+'&type='+type); 
                    xmlhttp.send();
}
window.onresize = function(){
    if(d = document.getElementsByClassName('postedimages')){
        for(var i = 0; i < d.length; ++i){
            document.getElementsByClassName('postedimages')[i].style.width = "calc(70%/"+d.length+"'px')";
                }
    }
}
window.onload = function(){
    if(d = document.getElementsByClassName('postedimages')){
        for(var i = 0; i < d.length; ++i){
            document.getElementsByClassName('postedimages')[i].style.width = "calc(70%/d.length)";

                }
    }
}
function displayTag(){
          
}
function login(user, pass) {
    // check for validation 
    if(user.length < 5 || pass.length < 6){
        document.getElementById('err').innerHTML = 'Username or password too short';       
        return false
    }
    else {
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 2){
            document.getElementsByClassName('lgnsbbx')[0].innerHTML = "Logging in."
        }
        if (xmlhttp.readyState == 3){
            document.getElementsByClassName('lgnsbbx')[0].innerHTML = "Logging in.."
        }
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {  
            var a = xmlhttp.responseText;
            if(a.includes("<span class='error'>Invalid username/password</span>")){
                document.getElementById('err').innerHTML = 'Invalid username/password';
            }
            else {
                return document.getElementById('quest').innerHTML = a;
            }
        }
                    };
                    xmlhttp.open('POST', '/students_connect/login.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("user="+user+"&pass="+pass);       
    }
}
var wee = [""];
var tye = [""];
function openReply(a){
  if(document.getElementById('rep'+a).style.display=='none'){
    if(wee[0] == ''){
    wee[0] = document.getElementsByClassName('addcom')[0].innerHTML;
    }
    document.getElementsByClassName('addcom')[0].innerHTML = document.getElementById('rep'+a).innerHTML;
    tye[0] = document.getElementById('rep'+a).innerHTML;
    document.getElementById('rep'+a).innerHTML = ''; 
    document.getElementById('rep'+a).style.display = 'block';
  }
      else {
          document.getElementById('rep'+a).style.display='none'
            document.getElementsByClassName('addcom')[0].innerHTML = wee[0];
            document.getElementById('rep'+a).innerHTML = tye[0];
          } 
          for(var i = 0; i< document.scripts.length; i++ ){
            if(document.scripts[i].src.includes('filescriptextended')){
              var oxe = document.createElement('script');
              oxe.src = '/students_connect/jsf/filescriptextended.js';
              document.scripts[i].replaceWith(oxe);
            }
        }
    };
function rrr(a){
  if(document.getElementById('reprep'+a).style.display=='none'){
        document.getElementById('reprep'+a).style.display='flex';
        }
        else {
            document.getElementById('reprep'+a).style.display='none'
        } 
    };
    var wee = [""];
    var tye = [""];
function opensReply(x){
  if(document.getElementById('rep'+x).style.display=='none'){
    if(wee[0] == ''){
      wee[0] = document.getElementsByClassName('addcom')[0].innerHTML;
      }
      document.getElementsByClassName('addcom')[0].innerHTML = document.getElementById('rep'+x).innerHTML;
    tye[0] = document.getElementById('rep'+x).innerHTML;
    document.getElementById('rep'+x).innerHTML = ''; 
    document.getElementById('rep'+x).style.display = 'block';
    }
    else {
      document.getElementById('rep'+x).style.display='none'
            document.getElementsByClassName('addcom')[0].innerHTML = wee[0];
            document.getElementById('rep'+x).innerHTML = tye[0];
    }
    for(var i = 0; i< document.scripts.length; i++ ){
      if(document.scripts[i].src.includes('filescriptextended')){
        var oxe = document.createElement('script');
        oxe.src = '/students_connect/jsf/filescriptextended.js';
        document.scripts[i].replaceWith(oxe);
      }
  }
}
    function openReplyContent(a, b){
      var wrk = 'dbsb'.concat(a);
      var shw = 'dsplrp'.concat(a);
      if(document.getElementById(wrk)){
      document.getElementById(wrk).style.display='none';
      }
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(shw).innerHTML = xmlhttp.responseText;
            document.cookie= "tpid="+b;
            document.cookie = "tcid="+a;
        }
    };
    xmlhttp.onerror = function(){
      document.getElementById(wrk).style.display='block';
    }
    xmlhttp.open('GET', '/students_connect/posts/pst/fetchreply.php?p='+ b +'&c='+a);
    xmlhttp.send();
    }
function opensReplyContent(a, b){
      var wrk = 'dbsb'.concat(a);
      var shw = 'dsplrp'.concat(a);
      if(document.getElementById(wrk)){
      document.getElementById(wrk).style.display='none';
      }
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(shw).innerHTML = xmlhttp.responseText;
        }
    };xmlhttp.onerror = function(){
      document.getElementById(wrk).style.display='block';
    }
    xmlhttp.open('GET', '/students_connect/posts/pst/fetchreply.php?sp='+ b +'&sc='+a);
    xmlhttp.send();
    }
function openReplyRepliesContent(a, b, c){
    var wrk = 'dbsbr'.concat(a);
      var shw = 'dsplrprp'.concat(a);
      if(document.getElementById(wrk)){
      document.getElementById(wrk).style.display='none';
      }
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(shw).innerHTML = xmlhttp.responseText;
          }
    };
    xmlhttp.onerror = function(){
      document.getElementById(wrk).style.display='block';
    }
    xmlhttp.open('GET', '/students_connect/posts/pst/fetchreply.php?rrc='+a+'&rp='+ c +'&rc='+b);
    xmlhttp.send();
    }
    function opensReplyRepliesContent(a, b, c){
      var wrk = 'dbsbr'.concat(a);
        var shw = 'dsplrprp'.concat(a);
        if(document.getElementById(wrk)){
        document.getElementById(wrk).style.display='none';
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById(shw).innerHTML = xmlhttp.responseText;
            }
      };
      xmlhttp.onerror = function(){
        document.getElementById(wrk).style.display='block';
      }
      xmlhttp.open('GET', '/students_connect/posts/pst/fetchreply.php?srrc='+a+'&srp='+ c +'&src='+b);
      xmlhttp.send();
      }
function c(pid, user){
  document.getElementById('pageloadfailed').style.display = 'block';  
  if(document.getElementById('pageloadfailed')){
    document.getElementById('pageloadfailed').style.display = 'none';
  }
  var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        document.getElementById('pageisloading').style.display = 'block';
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('pageisloading').style.display = 'none';
            document.getElementById('quest').innerHTML = xmlhttp.responseText;
            var f = document.createElement('script');
          f.src = '/students_connect/jsf/filescript.js';
          f.type = 'text/javascript';
          var g = document.createElement('script');
          g.src = '/students_connect/jsf/filescriptextended.js';
          g.type = 'text/javascript';
          var e = document.getElementsByTagName('HEAD')[0];
           e.append(f);
           e.append(g);
            window.history.pushState("", user, '/students_connect/posts/'+pid+'/');
            window.scrollTo(0,0);
          }
          xmlhttp.onerror = function(){
            document.getElementById('pageisloading').style.display = 'none';
            document.documentElement.style.position = 'fixed';
            document.getElementsByClassName('p_l_failed')[0].innerHTML = "<span class='trre_i' onclick='c(\""+pid+"\", \""+user+"\")'>Failed to load answers. Try again</span>";
            document.getElementById('pageloadfailed').style.display = 'block';
          }
    };
    
    xmlhttp.open('GET', '/students_connect/posts/pst?pid='+pid+'&cid=0');
    console.log(xmlhttp);
    xmlhttp.send();   
}
function sc(spid, user){
  document.getElementById('pageloadfailed').style.display = 'block';
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        document.getElementById('pageisloading').style.display = 'block';
        if(document.getElementById('pageloadfailed')){
          document.getElementById('pageloadfailed').style.display = 'none';
        }
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('pageisloading').style.display = 'none';
            document.getElementById('quest').innerHTML = xmlhttp.responseText;
            var f = document.createElement('script');
          f.src = '/students_connect/jsf/filescript.js';
          f.type = 'text/javascript';
          var g = document.createElement('script');
          g.src = '/students_connect/jsf/filescriptextended.js';
          g.type = 'text/javascript';
          var e = document.getElementsByTagName('HEAD')[0];
           e.append(f);
           e.append(g);
            window.history.pushState("", user, '/students_connect/posts/s'+spid+'/');
            window.scrollTo(0,0);
          }
          xmlhttp.onerror = function(){
            document.getElementById('pageisloading').style.display = 'none';
            document.documentElement.style.position = 'fixed';
            document.getElementsByClassName('p_l_failed')[0].innerHTML = "<span class='trre_i' onclick='sc(\""+spid+"\", \""+user+"\")'>Failed to load comments. Try again</span>";
            document.getElementById('pageloadfailed').style.display = 'block';
          }
    };
    xmlhttp.open('GET', '/students_connect/posts/pst?spid='+spid);
    xmlhttp.send();
}
function r(pid, cid, user){
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('quest').innerHTML = xmlhttp.responseText;
            window.history.pushState("", user, '/students_connect/posts/'+pid+'/');
        }
    };
    xmlhttp.open('GET', '/students_connect/posts/pst?pid='+pid+'&cid='+cid+"#"+cid);
    xmlhttp.send();   
}
function si(){
if(document.getElementById('srcmgtb').style.display == 'none'){
    document.getElementById('srcmgtb').style.display = 'block';
    document.getElementById('srchn').innerHTML = '<div class="cs" style="font-size: 14px; padding-bottom: 10px padding-right: 5px;">x</div>'    
}
else {
    document.getElementById('srcmgtb').style.display = 'none';
    document.getElementById('srchn').innerHTML = '<i class="fas fa-search"></i>'    
}
}
function upvote(luser, poid){
  var filldefault = {
    currentcolor: document.getElementById('upv'+poid).style.color,
    currentcount:  document.getElementById('upv'+poid).children[1].innerHTML,
    isdcolor: document.getElementById('dwn'+poid).style.color,
  }
  if(document.getElementById('upv'+poid).style.color == 'green')
        {
            // just be looking
        }
        else {
    document.getElementById('upv'+poid).style.color = 'green';
    var cu = document.getElementById('cntl'+poid).innerHTML;
    document.getElementById('cntl'+poid).innerHTML = parseInt(cu) + 1;
    if(document.getElementById('dwn'+poid).style.color == 'red'){
    document.getElementById('dwn'+poid).style.color = 'inherit';
}
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        }
    };
    xmlhttp.onerror = function(){
      document.getElementById('upv'+poid).style.color = filldefault.currentcolor;
      document.getElementById('cntl'+poid).innerHTML = filldefault.currentcount;
      document.getElementById('dwn'+poid).style.color = filldefault.isdcolor;
    }
    xmlhttp.open('GET', '/students_connect/posts/reactions.php?i='+poid+'&1&user='+luser);
    xmlhttp.send();
}
}
function downvote(luser, poid){
  var filldefault = {
    currentcolor: document.getElementById('dwn'+poid).style.color,
    isucount: document.getElementById('cntl'+poid).innerHTML, 
    isucolor: document.getElementById('upv'+poid).style.color
  }
  if(document.getElementById('dwn'+poid).style.color == 'red')
        {
            // just be looking
        }
        else {
    document.getElementById('dwn'+poid).style.color = 'red';
    var cu = document.getElementById('cntl'+poid).innerHTML;
    if(document.getElementById('upv'+poid).style.color == 'green'){
    document.getElementById('upv'+poid).style.color = 'inherit';
    document.getElementById('cntl'+poid).innerHTML = parseInt(cu) - 1;
}
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
    };
    xmlhttp.onerror = function(){
      document.getElementById('dwn'+poid).style.color = filldefault.currentcolor;
      document.getElementById('cntl'+poid).innerHTML = filldefault.isucount;
      document.getElementById('upv'+poid).style.color = filldefault.isucolor;
    }
    xmlhttp.open('GET', '/students_connect/posts/reactions.php?d='+poid+'&2&user='+luser);
    xmlhttp.send();
}
}
function love(id, user){
  var alldefaults = {
    cc: document.getElementById('love'+id).style.color,
    cn: document.getElementById('lkdcnt'+id).innerHTML,
    cf: document.getElementById('love'+id).children[0].className
  } 
  if(document.getElementById('love'+id).style.color == 'rgb(255, 136, 156)'){
      document.getElementById('love'+id).style.color = 'inherit'
      document.getElementById('love'+id).children[0].className = document.getElementById('love'+id).children[0].className.replace('fas', 'far');
      var e = parseInt(document.getElementById('lkdcnt'+id).innerHTML);
      var f = parseInt(e) - 1;
      document.getElementById('lkdcnt'+id).innerHTML = f;
    }
    else {
        var e = parseInt(document.getElementById('lkdcnt'+id).innerHTML);
        document.getElementById('love'+id).children[0].className = document.getElementById('love'+id).children[0].className.replace('far', 'fas');
        document.getElementById('love'+id).style.color = 'rgb(255, 136, 156)';
      var f = parseInt(e) + 1;
      document.getElementById('lkdcnt'+id).innerHTML = f;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          }
      };
      xmlhttp.onerror = function(){
        document.getElementById('love'+id).style.color = alldefaults.cc;
        document.getElementById('lkdcnt'+id).innerHTML = alldefaults.cn;
        if(alldefaults.cf.includes('far')){
          document.getElementById('love'+id).children[0].className = document.getElementById('love'+id).children[0].className.replace('fas', 'far');
        }
        else {
        document.getElementById('love'+id).children[0].className = document.getElementById('love'+id).children[0].className.replace('far', 'fas');
        }
      }
      xmlhttp.open('POST', '/students_connect/posts/reactions.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('l=l&id='+id+'&user='+user);
}
function dontmove(email){       
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 3) {            
           
        }
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {            
        var x = xmlhttp.responseText;
            if(x.includes('errorx')){
                var a = x.indexOf('errorx');
                var pd = x.indexOf('</div>');
                var b = x.slice(0, pd);
                document.getElementsByClassName('error')[0].innerHTML = b;
            }   
            else{
                 return document.getElementsByClassName('fmwp')[0].innerHTML = x;
            }
        }
    };
    xmlhttp.open('POST', '/students_connect/forgotpass/vimp.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('email='+email);
}
function pSub(code, eora){       
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {   
            var x = xmlhttp.responseText;
            if(x.includes('errorx')){
                var a = xmlhttp.responseText.indexOf('errorx');
                var pd = x.indexOf('</div>');
                var b = x.slice(0, pd);
                document.getElementsByClassName('error')[0].innerHTML = b;
            }   
            else{
                 document.getElementsByClassName('fmwp')[0].innerHTML = xmlhttp.response;
            }

        }
    };
    xmlhttp.open('POST', '/students_connect/forgotpass/vimp.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('code='+code+'&eora='+eora);
}
function final(one, two, ttxt){       
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {   
            var x = xmlhttp.responseText;
            if(x.includes('errorx')){
                var a = xmlhttp.responseText.indexOf('errorx');
                var pd = x.indexOf('</div>');
                var b = x.slice(0, pd);
                document.getElementsByClassName('error')[0].innerHTML = b;
            }   
            else{
                 document.getElementsByClassName('fmwp')[0].innerHTML = xmlhttp.response;
            }

        }
    };
    xmlhttp.open('POST', '/students_connect/forgotpass/vimp.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('normal='+one+'&repeat='+two+'&ttxt='+ttxt);
}
function scrollleft(){
    $('.ttdylst').ready(function(){
        if($(window).scrollLeft() == $(document).width - $(window).width){
            document.write('a')
        }
    })
}

function vlf(){
    var a = document.forms['fform']['forumname'].value;
    var b = document.forms['fform']['forumabout'].value;
    var c = a = document.forms['fform']['purposeofforum'].value;
    if(a == null || a.length < 8 || b == null || b == "" || b.length < 10 || c == null || c == "" || c.length < 5){
      if(a == null || a.length < 8){  
      document.getElementById('nerror').innerHTML = '<div class="error">Name of forum shouldn\'t be less than 8 characters</div>'; 
    }
    else if(b == null || b == "" || b.length < 10){
        document.getElementById('aerror').innerHTML = '<div class="error">About forum should be at least 10 characters</div>';
    }
    else if(c == null || c == "" || c.length < 5){
        document.getElementById('perror').innerHTML = '<div class="error">About forum should be at least 10 characters</div>';
    }
  }
}
function joforum(id, user){
    document.getElementById('tfjgrp').style.display = 'none';
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        }
}
xmlhttp.open('POST', '/students_connect/f/openforum.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('fid='+id+'&user='+user);
}
function ofmenu(){
    if(document.getElementById('ofmenu').style.display == 'none'){
        document.getElementById('ofmenu').style.display = 'block';
    }
    else {
        document.getElementById('ofmenu').style.display = 'none';
    }
}
function nfpsh(){
    if(document.getElementById('cfnpst').style.display == 'none'){
        document.getElementById('cfnpst').style.display = 'block';
    }
    else {
        document.getElementById('cfnpst').style.display = 'none';
    }
}
function fupvote(user, id, fid){
    if(document.getElementById('titg'+id).style.color == 'green')
        {
            document.getElementById('titg'+id).style.color = 'inherit';
    var cu = document.getElementById('fcntl'+id).innerHTML;
    document.getElementById('fcntl'+id).innerHTML = parseInt(cu) - 1;
        }
        else {
    document.getElementById('titg'+id).style.color = 'green';
    var cu = document.getElementById('fcntl'+id).innerHTML;
    document.getElementById('fcntl'+id).innerHTML = parseInt(cu) + 1;
    if(document.getElementById('fdwn'+id).style.color == 'red'){
    document.getElementById('fdwn'+id).style.color = 'inherit';
}
        }
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
    }
    xmlhttp.open('POST', '/students_connect/f/reactions.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('id='+id+'&user='+user+'&fid='+fid+'&s1');   
}
function fdownvote(user, id, fid){
    if(document.getElementById('fdwn'+id).style.color == 'red')
        {
            document.getElementById('fdwn'+id).style.color = 'inherit';
        }
        else {
    var cu = document.getElementById('fcntl'+id).innerHTML;        
    document.getElementById('fdwn'+id).style.color = 'red';
    if(document.getElementById('titg'+id).style.color == 'green'){
    document.getElementById('titg'+id).style.color = 'inherit';
    document.getElementById('fcntl'+id).innerHTML = parseInt(cu) - 1;
        }
    }
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
    }
    xmlhttp.open('POST', '/students_connect/f/reactions.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('id='+id+'&user='+user+'&fid='+fid+'&s2');   
}
function jcforum(id, user){
        var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('tfjgrp').innerHTML = 'Request Sent';
            document.getElementById('flisp').innerHTML = 'Your request to join this forum has been sent.'
            +'You will receive a notiification if you have been approved.';
        }
}
xmlhttp.open('POST', '/students_connect/f/closedforum.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('fid='+id+'&user='+user);
}
function fvmbs(fid){
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('tfobdy').innerHTML =xmlhttp.responseText;
        }
}
xmlhttp.open('POST', '/students_connect/f/setf.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('fid='+fid+'&ap');
}
function adtfo(user, ffid, oxz){
    var xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('xez'+oxz).innerHTML = 'Added';
        }
}
xmlhttp.open('POST', '/students_connect/f/setf.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('ffid='+ffid+'&user='+user);
}
function openFlw(user){
    var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if(xmlhttp.readystate == 3){
                          document.getElementById('loading').style.display = 'block'; 
                        }
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('amib').style.display='none';
                            document.getElementById('wcws').style.display='block';
                            document.getElementById('wcws').innerHTML = xmlhttp.responseText;
                            document.getElementById('wcws').style.backgroundColor = 'inherit';
                          }
                        };
                        xmlhttp.open('POST', '/students_connect/messages/shwmflw.php');
                      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xmlhttp.send("name="+user);
  }
  function lo(){
       window.scrollTo(0, document.body.offsetHeight);
       document.getElementsByClassName('flow_down')[0].style.display = "none";
       document.getElementsByClassName('ejj3')[0].style.display = 'none';
  }
  var cancel = 1;
  var intvl = setInterval(function(){},10000000000);
  function openfMsg(usr, fnm, timeofmessage){
    if(cancel == 1){
      clearInterval(intvl);
    var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        document.getElementById('pageisloading').style.display = 'block';
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          if(!window.location.href.includes('?n=')){
                          window.history.pushState('', '', document.URL+'?n='+fnm)
                          }
                          document.getElementById('pageisloading').style.display = 'none';
                          if(window.innerWidth > 799){  
                            document.getElementById('amib').style.display='block';
                          document.getElementById('pnflws').style.display='none';
                          document.getElementsByClassName('frquently')[0].style.display='none';
                        }
                          else {
                            document.getElementById('amib').style.display='none';
                            document.getElementById('pnflws').style.display='none';
                            clearInterval(qqq);
                            
                          }  
                          
                            document.getElementById('wcws').style.display='block';
                            document.getElementById('wcws').innerHTML = xmlhttp.responseText;
                            var f = document.createElement('script');
                            f.src = '/students_connect/jsf/messagingscript.js';
                            f.type = 'text/javascript';
                            var e = document.getElementsByTagName('HEAD')[0];
                            e.append(f);
                            window.scrollTo(0, document.body.offsetHeight);
                            var nmsg = [];
                            $('.newmesg').ready(function(){
                              setInterval(function(){
                                upmsg();
                              }, 1000);
                              function upmsg(){
                                var timeofmessage = document.getElementById('tl_tm').value;
                                if(timeofmessage.length  < 1){
                                  timeofmessage = 0;
                                }
                                var pr = document.getElementById('pr').value;
                                var biit = '';
                                /*document.getElementById('biit'+pr).value;
                                */var wa = document.getElementsByClassName('waex');
                                var to = [];
                                for(i = 0; i < wa.length; i++){
                                  to.push(wa[i].id);
                                }
                                if((document.body.offsetHeight - window.pageYOffset) > 800){
                                  document.getElementsByClassName('flow_down')[0].style.display = 'flex';
                                }
                                else {
                                  document.getElementsByClassName('flow_down')[0].style.display = 'none';
                                  document.getElementsByClassName('ejj3')[0].style.display = 'none';
                                }
                                $.post("/students_connect/messages/uom.php",{
                                  mnm:usr,
                                  mfn:fnm,
                                  ltm:timeofmessage,
                                  iit:biit,
                                  pr:pr,
                                  to: to
                                }, 
                                function(data){
                                  for(var i =0; i < document.scripts.length; i++){
                                    if(document.scripts[i].src.includes('messagingscript.js')){
                                      var oxe = document.createElement('script');
                                      oxe.src = '/students_connect/jsf/messagingscript.js';
                                      document.scripts[i].replaceWith(oxe);
                                    }
                                    if(document.scripts[i].src.includes('filescript.js')){
                                      var oxe = document.createElement('script');
                                      oxe.src = '/students_connect/jsf/filescript.js';
                                      document.scripts[i].replaceWith(oxe);
                                    }
                                    
                                  }
                                  var e = new Date();
                                  // document.getElementById('tl_tm').value = parseInt(e.getTime()/1000);
                                  if(data.includes('yxip0293msi3902nujxiw0nxi200nsn20')){
                                  
                                  }
                                  else {
                                    document.getElementsByClassName('msgcontnt')[0].style.display = 'none';
                                    /*
                                    $(data).insertBefore($('.newmesg'));
                                    */
                                   d = JSON.parse(data);
                                   var plbls = [];
                                   var bt = document.getElementsByClassName('waex');
                                   for(var u = 0; u < bt.length; u++){
                                     plbls.push(bt[u].ariaLabel);
                                    }
                                   for(var q = 0; q < d.length; q++){
                                   d1 =  parseInt(d[q][2])+1
                                   d2 = parseInt(d[q][2])+2
                                   d3 =  parseInt(d[q][2])+3
                                   d4 =  parseInt(d[q][2])-1
                                   d5 = parseInt(d[q][2])-2
                                   d6 =  parseInt(d[q][2])-3
                                   if(document.getElementById(d[q][0]) || plbls.includes(d[q][2]) ||
                                   plbls.includes(d2) || plbls.includes(d3) || plbls.includes(d4) ||
                                   plbls.includes(d1) || plbls.includes(d6) || plbls.includes(d5)){
                                    var h = chAry(d[q][2], plbls);
                                    var h1 = chAry(parseInt(d[q][2])+1, plbls);
                                    var h2 = chAry(parseInt(d[q][2])+2, plbls);
                                    var h3 = chAry(parseInt(d[q][2])+3, plbls);
                                    var h4 = chAry(parseInt(d[q][2])-1, plbls);
                                    var h5 = chAry(parseInt(d[q][2])-2, plbls);
                                    var h6 = chAry(parseInt(d[q][2])-3, plbls);
                                    if(h>1 || h1>1 || h2>1 || h3>1 || h4 > 1 || h5 > 1 || h6 > 1){
                                      document.getElementsByClassName('waex')[plbls.lastIndexOf(d[q][2])].remove();
                                    }
                                    //for(var g = 0; g < plbls.length; g++){
                                          
                                       //   document.getElementsByClassName('waex')[g].remove();
                                     // }
                                    }
                                   else {
                                    
                                    $("<div>"+d[q][1]+"</div>").insertBefore($('.newmesg'));
                                    newMessage({sender: window.location.search.substr(3), m: d[q][3]})
                                    if(document.getElementById('wcws')){
                                      document.getElementById('wcws').style.backgroundColor = 'lightgray';
                                      if(window.innerWidth > 799){
                                        document.body.style.minHeight =  (document.documentElement.scrollHeight)+'px';
                                      }
                                      document.getElementById('wcws').style.minHeight = (document.documentElement.scrollHeight)+'px';
                                      document.getElementsByClassName('ejj3')[0].style.display = 'block';
                                       document.getElementsByClassName('ejj3')[0].children[0].style.display = 'block';
                                    }
                                    if((document.body.offsetHeight - window.pageYOffset) < 1500){
                                      window.scrollTo(0, document.body.offsetHeight);
                                    } 
                                  }
                                  }
                                   
                                    document.getElementById('pr').value = parseInt(pr) + 1;
                                  }
                                }
                                )
                                
                              }
                              })
                            $('.cvro').ready(function(){
                              intvl = setInterval(function(){
                                uponl();
                              }, 1000);
                              function uponl(){
                              $.ajax({
                                url:'/students_connect/messages/uom.php?gun='+usr+'&gfn='+fnm,
                                method:'GET',
                                success:function(data){
                                  $('.cvro').html(data);
                                }
                              })
                              }
                              })
                            var e = document.documentElement.scrollHeight - document.getElementById('wcws').offsetTop;
                            window.scrollTo(0, (e+60));
                            for(var i =0; i < document.scripts.length; i++){
                              if(document.scripts[i].src.includes('messagingscript.js')){
                                var oxe = document.createElement('script');
                                oxe.src = '/students_connect/jsf/messagingscript.js';
                                document.scripts[i].replaceWith(oxe);
                              }
                            }
                            
                            if(document.getElementById('wcws')){
                              document.getElementById('wcws').style.backgroundColor = 'lightgray';
                              document.getElementById('wcws').style.color = 'black';
                              if(window.innerWidth > 799){
                                document.body.style.minHeight =  (document.documentElement.scrollHeight)+'px';
                              }
                              document.getElementById('wcws').style.minHeight = document.documentElement.scrollHeight+'px';
                            }
                            document.getElementById('replymessage').innerHTML = "<input id='rmid' type='hidden' name='mid' value='0'><input id='rplyto' type='hidden' name='rplyto' value='0'>";
                            document.getElementById('disfile').innerHTML = "<input id='isfile' type='hidden' name='hasfile' value='0'>";                          }
                        };
                        xmlhttp.open('POST', '/students_connect/messages/gtmsg.php');
                      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xmlhttp.send("name="+usr+"&fname="+fnm+"&ltm="+timeofmessage);
                      }
                      else {
                        return false;
                      }
                    }
                    function save(str){
                        document.getElementById('yww').value = str;
                       }
                       
                        function sndMsg(val, grp, usr){
                          if(val == "" || val == " " || val == "  " || val == "   "){
                            //dont do anything
                          }
                          else {
                          document.getElementById('mesgtxt').value="";
                          var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                  if(document.getElementById('darkmd')){
                                    document.getElementById('darkmd').style.minHeight = document.documentElement.scrollHeight+'px';
                                    document.getElementById('darkmd').style.minHeight = document.body.scrollHeight+'px';
                                  }
                                }
                                          };
                                          xmlhttp.open('POST', '/students_connect/messages/svgrmsg.php');
                                          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                    
                                          xmlhttp.send("msg="+val.replace('&', '&amp')+"&grp="+grp+"&usr="+usr);
                            }
                      }
                      function fsave(str){
                        document.getElementById('fyww').value = str;
                      }
                       
                        function sndfMsg(val, usr, frnd, reply, rplyto, hasfile, file){
                          var spt = val.split('\n');
                          var go = [];
                          for(var k = 0; k < spt.length; k++){
                            var tlk = spt[k].split(" ");
                            var mlk = chAry('', tlk);
                            if(tlk.length == mlk){
                              go.push(true);
                            }
                            else {
                              go.push(false);
                            }
                          }
                          //var exa = document.getElementById('chsimg').value;
                          var exa = added;
                          if(((go.length == chAry(true, go)) && exa == "") || (val == "" && exa == "")){
                              //console.log(val, exa);  
                              //dont do anything
                              }
                              else {
                                if(val == ('q'+'\\'+'startgame')){
                                  opengamecenter(usr, frnd);
                                }
                                else {
                          
                          document.getElementById('replymessage').style.display = 'none';
                          var msge = document.createElement('DIV');
                          if(document.getElementsByClassName('waex')[0]){
                          var ei = document.getElementsByClassName('waex');
                          var xi = parseInt(ei[ei.length - 1].id) + 1;
                          var show = ''
                          }
                          else {
                            var xi = '1';
                            var show = 'display: none';
                          }
                          var e = new Date();
                          var lbl = parseInt(e.getTime()/1000);
                          var o = e.toLocaleString().length;
                          var w = e.toLocaleString().substr(o-2).toLowerCase()
                          var ho = e.getHours();
                          var min = e.getMinutes();
                          var ampm = ho >= 12 ? "pm" : "am";
                          ho = ho % 12;
                          ho = ho < 10? "0"+ho : ho;
                          min = min <  10 ? '0'+min : min;
                          var curd = ho + ':'+min+' '+ampm;
                          var tu = document.getElementById('eupqq').name;
                          var eq = document.getElementById('eupqe').name;
                          qwe = '';
                          if(reply == 1){
                            var y = document.getElementById('rplyto').value;
                            var te = document.getElementById(y).title;
                            if(te == tu){
                              te = 'You';
                            } 
                            else {
                              te = eq;
                            }
                            var r = document.getElementById('msgco'+y).innerHTML;
                            if(r == ''){
                              r = 'File';
                            }
                            qwe = "<div class='trmbx p__o_o'>"+
                            "<a href='#"+y+"'><div class='m_iinit' style='color: orange'>"+te+"</div>"+
                            "<div class='strmsg' id='tstrmsg'>"+decodeURIComponent(r)+"</div></a></div>";
                          }
                          if(val == "" && exa == ""){
                          }
                          else {
                          if(hasfile=='1'){
                            var ex = added;
                            //var ex = document.getElementById('chsimg').files;
                            var ot = [];
                            for(var i =0; i < ex.length; i++){
                              ot.push(ex[i]);
                              var pe = ex[i];
                              var oxl = pe.type.split("/");
                              if(oxl[0] == 'image'){
                                msge.innerHTML = "<div class='waex waexspecial' id='"+xi+"' title='"+tu+"' style='float: right; margin: 0px; "+show+"' aria-label='"+lbl+"'>"+
                                "<div class='pcotm1 q_rsset pcotm1special' style='float: right; background-color: #147efb; color: white;'>"+qwe+
                                "<div class='pl_eeimg' style='background-image: url(\""+URL.createObjectURL(pe)+"\")'></div>"+
                                "<img src='"+URL.createObjectURL(pe)+"' alt='Images' class='tf_eeimg'>"+
                                "<div class='mfl' style='padding-top: 3px;'><div class='mgcont' id='msgco"+xi+"'>"+val.replace(/<\/?[^>]+(>|$)/g, '').replace(/\n/g, '<br/>')+"</div>"+
                          "<div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'><i class='far fa-clock'></i></div>"+
                          "<div class='tms'>"+curd+"</div>"+
                          "</div></div><div class='replymessage' onclick='replyMessage(\""+xi+"\", \""+tu+"\", document.getElementById(\"msgco"+xi+"\").innerHTML);'>"+
                          "<i class='fas fa-reply'></i>"+
                          "</div>"+
                                "</div></div><div class='m_options' style='display: none'></div>"+
                                "<div class='m_options' style='display: none'>"+
                                "</div></div>";
                              }
                            else if(oxl[0] == 'video'){
                              msge.innerHTML = "<div class='waex waexspecial' id='"+xi+"' title='"+tu+"' style='float: right; margin: 0px; "+show+"' aria-label='"+lbl+"'>"+
                                "<div class='pcotm1 q_rsset pcotm1special' style='float: right; background-color: #147efb; color: white;'>"+qwe+
                                "<video style='opacity: 1' width='200' height='200' controls>"+
                                "<source src='"+URL.createObjectURL(pe)+"'>"+
                                "</video>"+
                                "<div class='mfl' style='padding-top: 3px;'><div class='mgcont' id='msgco"+xi+"'>"+val.replace(/<\/?[^>]+(>|$)/g, '').replace(/\n/g, '<br/>')+"</div>"+
                          "<div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'><i class='far fa-clock'></i></div>"+
                          "<div class='tms'>"+curd+"</div>"+
                          "</div></div><div class='replymessage' onclick='replyMessage(\""+xi+"\", \""+tu+"\", document.getElementById(\"msgco"+xi+"\").innerHTML);'>"+
                          "<i class='fas fa-reply'></i>"+
                          "</div>"+
                                "</div></div><div class='m_options' style='display: none'></div>"+
                                "<div class='m_options' style='display: none'>"+
                                "</div></div>";
                            }
                            else if(oxl[0] == 'audio'){
                              msge.innerHTML = "<div class='waex waexspecial' id='"+xi+"' title='"+tu+"' style='float: right; margin: 0px; "+show+"' aria-label='"+lbl+"'>"+
                                "<div class='pcotm1 q_rsset pcotm1special' style='float: right; background-color: #147efb; color: white;'>"+qwe+
                                "<div class='audio_demo'>"+
                                "<div class='play_button'><i class='fas fa-play'></i>"+
                                "<input type='hidden' value='"+URL.createObjectURL(pe)+"'>"+
                                "</div>"+
                                "<div class='seek_line'>"+
                                "<div class='tow_th_poiter'>"+
                                "<div class='progressline'>"+
                                "<div class='smallcircleinside' draggable></div>"+
                                "</div>"+
                                "</div>"+
                                "</div>"+
                                "</div>"+
                                "<div class='mfl' style='padding-top: 3px;'><div class='mgcont' id='msgco"+xi+"'>"+val.replace(/<\/?[^>]+(>|$)/g, '').replace(/\n/g, '<br/>')+"</div>"+
                          "<div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'><i class='far fa-clock'></i></div>"+
                          "<div class='tms'>"+curd+"</div>"+
                          "</div></div><div class='replymessage' onclick='replyMessage(\""+xi+"\", \""+tu+"\", document.getElementById(\"msgco"+xi+"\").innerHTML);'>"+
                          "<i class='fas fa-reply'></i>"+
                          "</div>"+
                                "</div></div><div class='m_options' style='display: none'></div>"+
                                "<div class='m_options' style='display: none'>"+
                                "</div></div>";
                            }
                            else {
                              msge.innerHTML = "<div class='waex waexspecial' id='"+xi+"' title='"+tu+"' style='float: right; margin: 0px; "+show+"' aria-label='"+lbl+"'>"+
                                "<div class='pcotm1 q_rsset pcotm1special' style='float: right; background-color: #147efb; color: white;'>"+qwe+
                                "<div class='file_etype' onclick='download(\""+URL.createObjectURL(pe)+"\")'><i class='fas fa-file-download'></i>"+
                                "<span class='file_ext' style='"+
                                "font-size: 11px; padding-left: 3px; font-family: helvetica;'>"+oxl[1].toUpperCase()+" FILE</span>"+
                                "</div>"+
                                "<div class='mfl' style='padding-top: 3px;'><div class='mgcont' id='msgco"+xi+"'>"+val.replace(/<\/?[^>]+(>|$)/g, '').replace(/\n/g, '<br/>')+"</div>"+
                          "<div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'><i class='far fa-clock'></i></div>"+
                          "<div class='tms'>"+curd+"</div>"+
                          "</div></div><div class='replymessage' onclick='replyMessage(\""+xi+"\", \""+tu+"\", document.getElementById(\"msgco"+xi+"\").innerHTML);'>"+
                          "<i class='fas fa-reply'></i>"+
                          "</div>"+
                                "</div></div><div class='m_options' style='display: none'></div>"+
                                "<div class='m_options' style='display: none'>"+
                                "</div></div>";
                            }
                            }
                          }
                          else {
                          msge.innerHTML = "<div class='waex' id='"+xi+"' title='"+tu+"' style='float: right; "+show+"' aria-label='"+lbl+"'>"+
                          "<div class='pcotm1 q_rsset' style='float: right; background-color: #147efb; color: white;'>"+qwe+""+
                          "<div class='mfl'><div class='mgcont' id='msgco"+xi+"'>"+val.replace(/<\/?[^>]+(>|$)/g, '').replace(/\n/g, '<br/>')+"</div>"+
                          "<div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'><i class='far fa-clock'></i></div>"+
                          "<div class='tms'>"+curd+"</div>"+
                          "</div></div><div class='replymessage' onclick='replyMessage(\""+xi+"\", \""+tu+"\", document.getElementById(\"msgco"+xi+"\").innerHTML);'>"+
                          "<i class='fas fa-reply'></i>"+
                          "</div><div class='m_options' style='display: none'>"+
                          "<div class='mm_options'></div>"+
                          "</div></div>";
                          }
                          $(msge).insertBefore($('.newmesg'));
                          if(document.getElementById('wcws')){
                            document.getElementById('wcws').style.backgroundColor = document.getElementById('wcws').style.backgroundColor;
                            if(window.innerWidth > 799){
                              //document.body.style.minHeight = (document.documentElement.scrollHeight)+'px';
                            }
                            document.getElementById('wcws').style.minHeight = (document.documentElement.scrollHeight)+'px';
                          }
                          window.scroll(0, document.body.scrollHeight);
                        }
                          if(val.includes('&') == true){
                            val = val.replace(/&/g, '/ampersandsymbol/');
                          }
                         
                              var fl =false;
                            if(window.FormData){
                            fl =  new FormData();
                            }
                          if(added.length >= 1){
                            var exa = added;
                            for(var i =0; i < exa.length; i++){
                              var pet = exa[i];
                              fl.append("files[]", pet);
                            }
                          }
                          fl.append("msg", encodeURIComponent(val));
                            fl.append("snd", usr);
                            fl.append("rec", frnd);
                            fl.append('reply', reply);
                            fl.append("rplyto", rplyto);
                            fl.append("hasfile", hasfile);
                          document.getElementById('mesgtxt').value="";
                          document.getElementById('fyww').value = '';
                          document.getElementById('mesgtxt').style.height = '';
                          document.getElementById('chsimg').value='';
                          added.splice();
                          $.ajax({
                              url: '/students_connect/messages/svgrmsg.php',
                              type:"POST",
                              data:fl,
                              processData: false,
                              contentType: false,
                              success: function(){
                                document.getElementById('rmid').value='';
                                document.getElementById('rplyto').value='0';
                                document.getElementById('isfile').value = '0';  
                                var co = msge.children[0].children[0].children[0];
                                if(hasfile == '0'){
                                if(!co.className.includes('trmbx')){
                                  co.children[1].innerHTML = "<i class='fas fa-check'></i>";
                                }
                                else {
                                  co.parentElement.children[1].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                }
                                }
                                else {
                                  console.log(ot);
                                  for(var i =0; i < ot.length; i++){
                                    var pe = ot[i];
                                    var oxl = pe.type.split("/");
                                  if(oxl[0] == 'image'){
                                  if(!co.className.includes('trmbx')){
                                    co.parentElement.children[2].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                  }
                                  else {
                                    co.parentElement.children[3].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                  }
                                  }
                                  else if(oxl[0] == 'video' || oxl[0] == 'audio'){
                                    if(!co.className.includes('trmbx')){
                                      co.parentElement.children[1].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                    }
                                    else {
                                      co.parentElement.children[2].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                    }
                                  }
                                  else {
                                    if(!co.className.includes('trmbx')){
                                      co.parentElement.children[1].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                    }
                                    else {
                                      co.parentElement.children[2].children[1].innerHTML = "<i class='fas fa-check'></i>";
                                    }
                                  }
                                  }
                                }
                              }
                            })

                            }
                          }
                        }
                        function goBck(){
                                  document.getElementById('wcws').style.display='none';
                                  document.getElementById('amib').style.display='block';
                        }
                        function opninf(name, grpname){
                          var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                  document.getElementById('amib').style.display='none';
                                  document.getElementById('wcws').style.display='none';
                                  document.getElementById('dinf').style.display='block';
                                  document.getElementById('dinf').innerHTML = xmlhttp.responseText;
                                }
                                          };
                                          xmlhttp.open('POST', '/students_connect/messages/shwinf.php');
                                          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                          xmlhttp.send("user="+encodeURIComponent(name)+"&grpname="+encodeURIComponent(grpname));
                        }
                        function gbtm(nmu, nmg){
                          var xmlhttp = new XMLHttpRequest();
                                            xmlhttp.onreadystatechange = function() {
                                              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                  document.getElementById('amib').style.display='none';
                                                  document.getElementById('wcws').style.display='block';
                                                  document.getElementById('dinf').style.display='none';
                                                  document.getElementById('wcws').innerHTML = xmlhttp.responseText;
                                                }
                                          };
                                          xmlhttp.open('POST', '/students_connect/messages/gtmsg.php');
                                          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                          xmlhttp.send("usnm="+nmu+"&grpname="+nmg);
                        }
                        function crGrp(creator){
                          var xmlhttp = new XMLHttpRequest();
                                            xmlhttp.onreadystatechange = function() {
                                              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                document.getElementById('amib').style.display='none';
                                                  document.getElementById('wcws').style.display='none';  
                                                document.getElementById('crtgrpst').innerHTML = xmlhttp.responseText;
                                                }
                                          };
                                          xmlhttp.open('POST', '/students_connect/messages/creategroup.php');
                                          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                          xmlhttp.send("creatinguser="+creator);
                        }
                        function searchFriends(user, srch){
                            document.getElementById('uubtwk').style.display='none';
                            $('.srchresult').ready(function(){
                              $.ajax({
                                url:"srchf.php?usr="+user+"&val="+srch,
                                method:"GET",
                                success:function(data){
                                  $('.srchresult').html(data);
                                }
                              })
                              })    
                          }
                          function ftx(){
                          }
                          function replyMessage(mid, snd, msg){
                            if(msg.includes('/ampersandsymbol/') == true){
                              msg = msg.replace(/\/ampersandsymbol\//g, '&');
                            }
                            else {
                              msg = msg;
                            }
                            if(msg.indexOf('<div><i style="font-size: 12px;"><i class="fas fa-share"></i> shared</i></div>') == 0){
                              msg = 'Shared';
                            }
                            msg = msg.replace(/<\/?[^>]+(>|$)/g, '');
                            if(msg == ''){
                              msg = 'File';
                            } 
                            msg = msg.replace(/<br>/g, '');
                            var reply = "<div class='h_christmas'><div class='to_who'>"+snd+"</div> <div class='to_you'>"+msg.substring(0, 50)+"</div><div class='h_welll' onclick='popOut()'>x</div></div>";
                            document.getElementById('replymessage').style.display = 'block';
                            document.getElementById('replymessage').innerHTML = reply + "<input id='rmid' type='hidden' name='mid' value='1'><input type='hidden' name='rplyto' id='rplyto' value='"+mid+"'>";
                            document.getElementById('mesgtxt').focus();
                          }
                          function popOut(){
                            document.getElementById('replymessage').style.display = 'none';
                            document.getElementById('replymessage').innerHTML = "<input id='rmid' type='hidden' name='mid' value='0'><input id='rplyto' type='hidden' name='rplyto' value='0'>";
                          }
                          const added = [];
                          function crImg(){
                            var moxx = document.getElementById('chsimg').files;
                            for(var m=0; m < moxx.length; m++){
                              added.push(moxx[m]);
                            }
                            let fileArray = Array.from(moxx);
                            if(moxx.length > 0){
                            var tio = document.getElementsByClassName('fl_slctd')[0];
                              for(var i =0; i < moxx.length; i++){
                              var ftyp = moxx[i].type.split("/")[0];
                              if(ftyp == 'image'){
                                var ttui = document.createElement("div");
                                ttui.id=i;
                                ttui.className = "fl_slctfl";
                                ttui.style.backgroundImage = "url('"+URL.createObjectURL(moxx[i])+"')"
                                ttui.innerHTML = "<i class='fas fa-trash ljvlr'></i><img src='"+URL.createObjectURL(moxx[i])+"' class='up_mmeo'/>";
                                ttui.children[0].onclick = function(){
                                  added.splice(parseInt(this.parentElement.id), parseInt(this.parentElement.id));
                                  this.parentElement.remove(); fileArray.splice("+i+",1);
                                  if(added.length>0){
                                  for(var p = 0; p < added.length; p++){
                                    tio.children[p].id = p;
                                  }
                                }
                                  console.log(added)
                                }
                                tio.append(ttui);
                              }
                              else if(ftyp == 'video'){
                                var ttui = document.createElement("div");
                                ttui.id=i;
                                ttui.className = "fl_slctfl";
                                ttui.innerHTML = "<i class='fas fa-trash ljvlr'></i><video style='width: 100%'><source src='"+URL.createObjectURL(moxx[i])+"'></video><i style='position: absolute; color: white; top: 40%; right: 40%;' class='fas fa-play'></i>";
                                ttui.children[0].onclick = function(){
                                  added.splice(parseInt(this.parentElement.id), parseInt(this.parentElement.id));
                                  this.parentElement.remove(); fileArray.splice("+i+",1);
                                  if(added.length>0){
                                    for(var p = 0; p < added.length; p++){
                                      tio.children[p].id = p;
                                    }
                                  }
                                  console.log(added)
                                }
                                ttui.children[2].onclick = function(){
                                  this.parentElement.children[1].play();
                                  this.parentElement.children[1].webkitEnterFullscreen();
                                }
                                tio.append(ttui);
                              }
                              else if(ftyp == 'audio'){
                                var ttui = document.createElement("div");
                                ttui.id=i;
                                ttui.className = "fl_slctfl";
                                ttui.innerHTML = "<i class='fas fa-trash ljvlr'></i><audio src='"+URL.createObjectURL(moxx[i])+"' stlye='width: 100%; opacity: 0;'></audio><i class='fas fa-file-audio kkjenr'></i>";
                                ttui.children[0].onclick = function(){
                                  added.splice(parseInt(this.parentElement.id), parseInt(this.parentElement.id));
                                  this.parentElement.remove(); fileArray.splice("+i+",1);
                                  if(added.length>0){
                                    for(var p = 0; p < added.length; p++){
                                      tio.children[p].id = p;
                                    }
                                  }
                                  console.log(added)
                                }
                                ttui.children[2].onclick = function(){
                                  this.parentElement.children[1].play();
                                }
                                tio.append(ttui);
                              }
                              else{
                                var ttui = document.createElement("div");
                                ttui.id=i;
                                ttui.className = "fl_slctfl";
                                ttui.innerHTML = "<i class='fas fa-trash ljvlr'></i><i class='fas fa-file kkjenr'></i>";
                                ttui.children[0].onclick = function(){
                                  added.splice(parseInt(this.parentElement.id), parseInt(this.parentElement.id));
                                  this.parentElement.remove(); fileArray.splice("+i+",1);
                                  if(added.length>0){
                                    for(var p = 0; p < added.length; p++){
                                      tio.children[p].id = p;
                                    }
                                  }
                                  console.log(added)
                                }
                                tio.append(ttui);
                              }
                            }
                            }
                            document.getElementById('disfile').innerHTML = "<input id='isfile' type='hidden' name='hasfile' value='1'>";
                            console.log(added);
                          }
                          if(document.getElementById('srcmgtb') == true){
                          window.onload = function(){
                            var input = document.getElementById('srcmgtb').focus();
                          }
                        }
                          function showResult(user, srch){
                            if(srch==""){
                              document.getElementById('lom').style.display= 'block';
                            document.getElementById('lofm').style.display= 'block';
                            document.getElementById('livesearch').style.display= 'none';
                            }
                            else {
                              var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                    document.getElementById('livesearch').innerHTML = xmlhttp.responseText;
                                    document.getElementById('lom').style.display= 'none';
                                    document.getElementById('lofm').style.display= 'none';
                                  }
                            };
                            xmlhttp.open('POST', '/students_connect/messages/srchf.php');
                            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlhttp.send("usr="+user+"&mes="+srch);
                        }
                      }
                      function opnfinf(usr, frnd){
                        var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                    document.getElementById('amib').style.display='none';
                                    document.getElementById('wcws').style.display='none';
                                    document.getElementById('dinf').style.display='block';
                                    document.getElementById('dinf').innerHTML = xmlhttp.responseText;
                                    window.scrollTo(0, 0);
                                  }
                            };
                            xmlhttp.open('POST', '/students_connect/messages/shwinf.php');
                            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlhttp.send("username="+usr+"&friendsname="+frnd);
                      }
                      if(window.innerWidth > 799){
                      function displayprop(mgbid){
                        //document.getElementById('prop'+mgbid).style.display = 'block';
                      }
                      function hideprop(mgbid){
                        //document.getElementById('prop'+mgbid).style.display = 'none';
                      }
                    }
                    function displayprop(){
                    }
                    function hideprop(){
                    }
                      function deletemsg(id){
                        cancel = 0;
                        var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                  location.reload(true);
                                  cancel = 1;
                                  }
                            };
                            xmlhttp.open('POST', '/students_connect/messages/uom.php');
                            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlhttp.send("msgid="+id);
                      }
                      function clearfMessage(user,id){
                        cancel = 0;
                        var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                  cancel = 1;
                                  }
                            };
                            xmlhttp.open('POST', '/students_connect/messages/uom.php');
                            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlhttp.send("clearforuser="+user+"&mesgid="+id);
                      }
                      function startprocess(creator, namefgroup, description, dpass){
                        if (document.getElementById('pop1').checked == true){
                         var type = '0';
                        }
                        else if (document.getElementById('pop2').checked == true){
                          var type = '1';
                        }
                        var members = new Array();
                        var pdsmth = document.getElementById('pdsmth');
                        var bxes = pdsmth.getElementsByTagName('INPUT');
                        for(var i = 0; i < bxes.length; i++){
                          if(bxes[i].checked){
                            members.push(bxes[i].value);
                          }
                        }
                        if(members.length > 0){
                          var d = members.length;
                        }
                        var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                  document.getElementById('rpns').innerHTML = xmlhttp.responseText;
                                  var gid = document.getElementById('mgrpid').value;
                                  opengroup(creator, gid);
                                }
                            };
                              xmlhttp.open('POST', '/students_connect/messages/creategroup.php');
                              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                              for(var i = 0; i < members.length; i++){
                              xmlhttp.send("creator="+creator+"&nameofgroup="+namefgroup+"&description="+description+"&members="+d+"&pop="+type+"&eachmember="+members+"&dpass="+dpass);
                      }
                      }
                      function opengroup(user, groupid){
                        var xmlhttp = new XMLHttpRequest();
                                            xmlhttp.onreadystatechange = function() {
                                              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                  document.getElementById('amib').style.display='none';
                                                  document.getElementById('pnflws').style.display='none';
                                                  document.getElementById('wcws').style.display='block';
                                                  document.getElementById('crtgrpst').style.display = 'none';
                                                  document.getElementById('wcws').innerHTML = xmlhttp.responseText;
                                                  document.getElementById('replymessage').innerHTML = "<input id='rmid' type='hidden' name='mid' value='0'><input id='rplyto' type='hidden' name='rplyto' value='0'>";
                                                  document.getElementById('disgfile').innerHTML = "<input id='isfile' type='hidden' name='hasfile' value='0'>"; 
                                                  var e = document.documentElement.scrollHeight - document.getElementById('wcws').offsetTop;
                                                  window.scrollTo(0, (e+60));
                                                  for(var i =0; i < document.scripts.length; i++){
                                                    if(document.scripts[i].src.includes('messagingscript.js')){
                                                      var oxe = document.createElement('script');
                                                      oxe.src = '/students_connect/jsf/messagingscript.js';
                                                      document.scripts[i].replaceWith(oxe);
                                                    }
                                                  }
                                                  
                                                  if(document.getElementById('wcws')){
                                                    document.getElementById('wcws').style.backgroundColor = 'lightgray';
                                                    if(window.innerWidth > 799){
                                                      document.body.style.minHeight =  (document.documentElement.scrollHeight)+'px';
                                                    }
                                                    document.getElementById('wcws').style.minHeight = document.documentElement.scrollHeight+'px';
                                                    document.getElementById('wcws').style.minHeight = document.body.scrollHeight+'px';
                                                  }
                                                  window.onload = function(){
                                                    var input = document.getElementById('mesgtxt').focus(); 
                                                  }
                                                  
                                                }
                                          };
                                          xmlhttp.open('POST', '/students_connect/messages/gtmsg.php');
                                          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                          xmlhttp.send("username="+user+"&groupid="+groupid);
                                            $('.newmesg').ready(function(){
                                              setInterval(function(){
                                                upmsg();
                                              }, 1000);
                                              function upmsg(){
                                                if(document.getElementById('tl_tm')){
                                                var timeofmessage = document.getElementById('tl_tm').value;
                                                }
                                                else {
                                                  var timeofmessage = 0;
                                                }
                                                $.ajax({
                                                  url:'/students_connect/messages/uom.php?username='+user+'&groupid='+groupid+'&ltm='+timeofmessage,
                                                method:'GET',
                                                success:function(data){
                                                  var e = new Date();
                                                  // document.getElementById('tl_tm').value = parseInt(e.getTime()/1000);
                                                  if(data.includes('yxip0293msi3902nujxiw0nxi200nsn20')){
                                                  
                                                  }
                                                  else {
                                                    $('.newmesg').html(data);
                                                  }
                                                }
                                              })
                                              }
                                              })
                      }
                      
                      function replyGMessage(mid, snd, msg){
                        if(msg.includes('/ampersandsymbol/') == true){
                          msg = msg.replace(/\/ampersandsymbol\//g, '&');
                        }
                        else {
                          msg = msg;
                        }
                        msg = msg.replace(/<br>/g, '');
                        var reply = "<div class='h_christmas'><div class='to_who'>"+snd+"</div> <div class='to_you'>"+msg.substring(0, 50)+"</div><div class='h_welll' onclick='popOut()'>x</div></div>";
                        document.getElementById('replymessage').style.display = 'block';
                        document.getElementById('replymessage').innerHTML = reply + "<input id='rmid' type='hidden' name='mid' value='1'><input type='hidden' name='rplyto' id='rplyto' value='"+mid+"'>";
                      }
                      function jgrp(user, groupid){
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            opengroup(user, groupid);
                          }
                      };
                        xmlhttp.open('POST', '/students_connect/messages/joingroup.php');
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("user="+user+"&groupid="+groupid);
                      }
                      function vpgrp(user, groupid){
                          var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('wpsrd').innerHTML = 'Request sent<br/>You will receive a notification when added.';
                          }
                      };
                        xmlhttp.open('POST', '/students_connect/messages/joingroup.php');
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("user="+user+"&groupid="+groupid+"&pr");
                        }
                      function opengamecenter(q, a){
                        window.history.pushState('', '', 'http://localhost:8080/students_connect/games/')
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('quest').innerHTML = xmlhttp.responseText;
                          }
                      };
                        xmlhttp.open('GET', '/students_connect/games/index.php?user='+q+'friend='+a);
                        xmlhttp.send();
                      }
function fsrch(user, search){
    if(search == null || search == "" || search == " "){
        document.getElementById('fsugst').style.display = 'none';
    }
    else {
        document.getElementById('fsugst').style.display= 'block';
    }
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('fsugst').innerHTML = xmlhttp.responseText;
        }
    };
      xmlhttp.open('GET', '/students_connect/f/search.php?sug='+search+'&user='+user);
      xmlhttp.send();
      window.onclick = function(){
        document.getElementById('fsugst').style.display = 'none';
      }
}
function cttm(tval,x){
    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.history.pushState('', '', '/students_connect/notification?'+tval);
            document.getElementsByClassName('not_container')[0].innerHTML = xmlhttp.responseText;
        }
    };
      xmlhttp.open('GET', '/students_connect/notification/filter.php?'+tval+'&uid='+x);
      xmlhttp.send();
}
function sndSoc(user, scmt, postid){
    var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById('cmttextarea'+postid).value= '';  
    document.getElementById('cmttextarea'+postid).innerHTML = xmlhttp.responseText;
    $('#cmt_sec'+postid).ready(function(){
      function upcmt(){
      $.ajax({
        url:'/students_connect/posts/reactions.php?c&user=$user&postid='+postid,
        method:'GET',
        success:function(data){
          $('#cmt_sec'+postid).html(data);
        }
      })
      }
      setTimeout(upcmt(), 5000);
      })
  }
    };
    xmlhttp.open('POST', '/students_connect/comment/soccomment.php');
  xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xmlhttp.send('user='+user+'&scmt='+scmt+'&postid='+postid);
  }
  function sndEdu(user, ecmt, postid){
    var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById('ecmttextarea'+postid).value= '';  
      document.getElementById('ecmttextarea'+postid).innerHTML = xmlhttp.responseText;
      $('#cmtedu'+postid).ready(function(){
        function upcmt(){
        $.ajax({
          url:'/students_connect/posts/reactions.php?ec&user=$user&postid='+postid,
          method:'GET',
          success:function(data){
            $('#cmtedu'+postid).html(data);
          }
        })
        }
        setTimeout(upcmt(), 5000);
        })
  }
    };
    xmlhttp.open('POST', '/students_connect/comment/index.php');
  xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xmlhttp.send('user='+user+'&cmtedupst='+ecmt+'&postid='+postid);
  }
function ename(user, fname, sname, mname){
  var xmlhttp = new XMLHttpRequest();
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("user="+user+"&fname="+fname+"&sname="+sname+"&mnmae="+mname);
} 
function ename(user, fname, sname, mname){
  var xmlhttp = new XMLHttpRequest();
  var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Updating...';
        qx.style.fontSize = '17px';
        document.body.append(qx);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      qx.innerHTML = 'Updated.';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
    }
};
xmlhttp.onerror = function(){
  qx.innerHTML = 'Failed to update.';
  setTimeout(function(){
    qx.style.display = 'none';
  }, 1500);
}
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("user="+user+"&fname="+fname+"&sname="+sname+"&mname="+mname);
}
function edob(user, day, month, year){
  var xmlhttp = new XMLHttpRequest();
  var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Updating...';
        qx.style.fontSize = '17px';
        document.body.append(qx);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      qx.innerHTML = 'Updated.';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
    }
};
xmlhttp.onerror = function(){
  qx.innerHTML = 'Failed to update.';
  setTimeout(function(){
    qx.style.display = 'none';
  }, 1500);
}
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("user="+user+"&day="+day+"&month="+month+"&year="+year);
}
function econt(user, email, number){
  var xmlhttp = new XMLHttpRequest();
  var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Updating...';
        qx.style.fontSize = '17px';
        document.body.append(qx);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      qx.innerHTML = 'Updated.';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
    }
};
xmlhttp.onerror = function(){
  qx.innerHTML = 'Failed to update.';
  setTimeout(function(){
    qx.style.display = 'none';
  }, 1500);
}
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("user="+user+"&email="+email+"&number="+number);
}
function eoth(user, inst, course){
  var a = document.getElementById("male");
  var b = document.getElementById("female");
  var c = document.getElementById("ddndis");
  if(a.checked){
    var sex = '1';
  }
  else if(b.checked){
    var sex='2';
  }
  else if(c.checked){
    var sex = '3';
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Updating...';
        qx.style.fontSize = '17px';
        document.body.append(qx);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      qx.innerHTML = 'Updated.';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
    }
};
xmlhttp.onerror = function(){
  qx.innerHTML = 'Failed to update.';
  setTimeout(function(){
    qx.style.display = 'none';
  }, 1500);
}
};
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("user="+user+"&inst="+encodeURIComponent(inst)+"&course="+encodeURIComponent(course)+"&sex="+sex);
}
function tagPost(){
  a = document.getElementById('tagthepost').style.display;
  if(a == 'none'){
  document.getElementById('tagthepost').style.display = 'block';
}
else {
  document.getElementById('tagthepost').style.display = 'none';
}
}
var alr = [];
function plyt(val){
  var x = document.getElementById('thetagtext').value;
  if(val == 'adnw'){
    document.getElementById('thetagtext').style.display = 'block';
    document.getElementById('tagmsg').style.display = 'block';
  }
  else {
    if(alr.includes(val) == true){
      var dd = alr.indexOf(val);  
      alr.splice(dd, 1);
      }
      else {
        alr.push(val);
      }
    document.getElementById('thetagtext').value = alr.toString();
}
}
function dispOths(){
 document.getElementsByClassName('own')[0].style.display = 'block';
 document.getElementById('zymbxs').style.display = 'none'; 
}
function disptOths(){
 document.getElementsByClassName('smoretags')[0].style.display = 'block';
 document.getElementById('trtags').style.display = 'none'; 

}
function forMenu(){
  var d = document.getElementById('fsMenu').style.display;
  if(d == 'none'){
  document.getElementById('fsMenu').style.display='block';
  }
  else {
  document.getElementById('fsMenu').style.display='none';
}
}
function disnav(){
  if(window.innerWidth < 799 && (document.getElementsByClassName('ttr'))){
  var a = document.getElementsByClassName('ttrdad')[0].style.display;
  if(a == 'none' || a == ''){
    document.documentElement.style.position = 'fixed';
    document.body.style.position = 'fixed';
  document.getElementsByClassName('ttrdad')[0].style.display = 'block';
  document.getElementsByClassName('ttr')[0].style.width = '50%';
  document.getElementsByClassName('ttr')[0].style.display = 'block';
}
  else {
    document.documentElement.style.position = 'relative';
      document.body.style.position = 'relative';
    document.getElementsByClassName('ttrdad')[0].style.display = 'none';   
  }
}
window.onclick = function(event){
  var ot = document.getElementsByClassName('ttrdad')[0];
  if(event.target == ot){
    document.documentElement.style.position = 'relative';
      document.body.style.position = 'relative';
    ot.style.display = 'none';
  }
}
}
var loadFile = function(event) {
  var output = document.getElementById('img2bu');
  var outputx = document.getElementById('img3bu');
    output.src = URL.createObjectURL(event.target.files[0]);
  document.getElementById('img2bu').style.display='block';
  if(event.target.files[1]){
    document.getElementById('img3bu').style.display='block';
  outputx.src = URL.createObjectURL(event.target.files[1]);
  outputx.onload = function () {
    URL.revokeObjectURL(outputx.src)
  }
}
};
function getkVal(event,user, ecmt, postid){
  var x = event.keyCode;
  if(x == 13){
    sndEdu(user, ecmt, postid);
  }
}

window.onload = function(){
  if(document.getElementsByClassName('posted')){
  var g = document.getElementsByClassName('posted');
  for(var i = 0; i < g.length; i++){
    var mid = g[i].id.length;
    var full = g[i].id.substring(7, mid);
    setInterval(function(){
    updatetime();
  }, 120000);
  function updatetime(){
  $.ajax({
    url:'/students_connect/posts/timeupdate.php?id='+full,
    method:'GET',
    success:function(data){
      $(g[i]).html(data);
    }
  })
}
  }
}
}
function pollReq(){
  var s = document.getElementsByClassName('pollpost')[0].style.display;
  if(s == 'none'){
    document.getElementsByClassName('pollpost')[0].style.animationName = 'preq';
    document.getElementsByClassName('pollpost')[0].style.display = 'block';
  }
  else {
      document.getElementsByClassName('pollpost')[0].style.display ='none';
  }
}
function pollReeq(){
  var s = document.getElementsByClassName('pollpost')[1].style.display;
  if(s == 'none'){
    document.getElementsByClassName('pollpost')[1].style.animationName = 'preq';
    document.getElementsByClassName('pollpost')[1].style.display = 'block';
  }
  else {
      document.getElementsByClassName('pollpost')[1].style.display ='none';
  }
}
if(document.getElementsByClassName('esign')){
  var a, b, l, e, f;
  a = document.getElementsByClassName('esign');
  for(f = 0; f < a.length; f++){
    b = document.getElementsByClassName('esign')[f];
    b.onclick = function(){
      l = this.children[1];
      if(l.style.display =='none'){
        l.style.display = 'block';
      }
      else {
        l.style.display = 'none'; 
      } 
    }
  }
}

if(document.getElementsByClassName('ttr') && (window.innerWidth < 799)){
  var x = document.getElementsByClassName('ttr')[0];
  window.onclick = function(event){
    if(event.target == x){
      x.style.display = 'none';
    }
  }
  window.onscroll = function(event){
    if(event.target == x){
      x.style.display = 'none';
    }
  }
}
/*if('serviceWorker' in navigator){
  navigator.serviceWorker.register('/students_connect/sw.js').then(function(registration){
      console.log("Reg Successful", registration.scope);
    Notification.requestPermission();
    })
  .catch(function(error){
      console.log('Servce worker registration failed', error);
  });}
  */
function sendReq(fvals){
  var f = new Object(fvals);
  var url, type, vals, success;
  url = f.url;
  type = f.type;
  vals = f.vals;
  success = f.success;
  error = f.error;
  resp = f.response;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      console.log(xmlhttp.responseText);
    }
    if(xmlhttp.status == 0 || xmlhttp.status > 200){
      return "Error";
    }
  }
  switch(type) {
    case 'POST': 
      xmlhttp.open(type, url);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var mals = vals.toString();
      mals.replace(',', '&');
      xmlhttp.send(mals);
      break;
    case 'GET':
      xmlhttp.open(qtype, url);
      var mals = vals.toString();
      mals.replace(',', '&');
      xmlhttp.send(mals);
      break;
    default:
      reqtype = 'GET';
      xmlhttp.open(reqtype, url);
      var mals = vals.toString();
      mals.replace(',', '&');
      xmlhttp.send(mals);
      break;
    }
    
}

  window.onload = function(){
    setInterval(function(){
    srq()
  }, 1000);
    function srq(){
    var xe = sendReq({
    url: "/students_connect/h/c/index.php",
    type: "POST",
    vals: "a=a",
  });
  console.log(xe);
  if(document.getElementById('h_shn12w')){
    var to = document.getElementById('h_shn12w');
    
    if(xe = ''){
      console.log(xe);
      to.style.display = 'none';
    }
    else{
      to.style.display = 'block';
    }
  }
}
}
window.onload= function(){
  if(document.getElementsByTagName('VIDEO')){
  var te = document.getElementsByTagName('VIDEO');
  for(var i = 0; i < te.length; i++){
    var me = te[i].parentElement;
    var lx = document.createElement('i');
    lx.className = 'fas fa-play p_vide';
    if(window.innerWidth > 799){
    lx.style.cssText = 'display: block; opacity: 1; z-index: 2;'+
    'width: fit-content; margin: auto; bottom: 55px; position: relative; color: white; font-size: 20px;';
    }
    else {
      lx.style.cssText = 'display: block; opacity: 1; z-index: 2;'+
    'width: fit-content; margin: auto; bottom: 80px; position: relative; color: inherit; font-size; 15px;';
    }
    me.append(lx);
  }
  var mxe = document.getElementsByClassName('p_vide');
  for(var i = 0; i < mxe.length; i++){
    mxe[i].onclick = function(){
      var le = this.parentElement.children[0];
      if(le.paused){
      le.play();
      this.className = this.className.replace('play', 'pause');
      }
      else {
        le.pause();
        this.className = this.className.replace('pause', 'play');
        this.style.display = 'block';
      }
    }
  }
  for(var i =0; i< te.length; i++){ 
  te[i].onmouseover = function(){
    var op = this.parentElement.children[1];
    if(this.paused == false){
      op.className = op.className.replace('play', 'pause');
      op.style.display = 'block';
    }
  }
  te[i].onmouseout = function(){
    var op = this.parentElement.children[1];
    if(this.paused){
      op.className = op.className.replace('pause', 'play');
      op.style.display = 'block';
    }
    else {
      op.className = op.className.replace('play', 'pause');
      op.style.display = 'none';
    }
  }
  te[i].onpause = function(){
    
  }
  te[i].onplay = function(){
    
  }
  }
}
}
window.onclick = function(){
  if(document.getElementsByClassName('s_thmiw')[0]){
    var ethe = document.getElementsByClassName('s_thmiw')[0];
    $.ajax({
      url:'/students_connect/',
      method:'GET',
      success:function(data){
        
      }
    })
  }
}
var qxlt = [];
var org = [parseInt(new Date().getTime()/1000)]
window.onscroll = function(){
  if(document.getElementsByClassName('dfp_A')[0]){
  if(document.getElementsByClassName('h_shn12w')[0] && window.scrollY < 50){
    document.getElementsByClassName('h_shn12w')[0].style.display = 'none';
  }
  if(window.scrollY > 700){
    document.getElementsByClassName('sc_up')[0].style.display  = 'block';
  }
  else {
    document.getElementsByClassName('sc_up')[0].style.display  = 'none';
  }
}
}
setInterval(function(){
  if(document.getElementsByClassName('dfp_A')[0]){
    var xot = document.getElementsByClassName('h_shn12w')[0];
    if(qxlt[0]){
      var pqrst = new Date();
      qxlt[0] = parseInt(pqrst.getTime()/1000);
    }
    else {
      var pqrst = new Date();
      qxlt.push(parseInt(pqrst.getTime()/1000));
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        if(xmlhttp.responseText.length > 0){
          var ii = document.createElement('div');
          ii.innerHTML = xmlhttp.responseText;
          var tq = document.getElementsByClassName('dfp_A')[0];
          tq.insertBefore(ii, tq.childNodes[0]);
          xot.style.display = 'block';
          org[0] = qxlt[0];
        }
      }
    }
    xmlhttp.open('POST', '/students_connect/h/ro.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('t='+qxlt[0]+'&ot='+org[0]);
  }
}, 30000)
function download(a){
  if(a.indexOf('b') == 0){
    var l = document.createElement('a');
  l.setAttribute('download', 'file')
  l.setAttribute('target', '_blank');
  l.href = a;
  document.body.appendChild(l);
  l.click();
  l.remove();
  }
  else {
  var l = document.createElement('a');
  l.setAttribute('download', 'file')
  l.setAttribute('target', '_blank');
  l.href = '/students_connect_hidden/messages_uploads/'+a;
  document.body.appendChild(l);
  l.click();
  l.remove();
  }
}
/*if(document.getElementsByClassName('xadd')){
  function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return '';
}
var a = getCookie('drkmd');
  var xd = document.getElementsByClassName('xadd')[0];
  xd.addEventListener('click', function(){
    var cts = {'auth_t': 0,
                'drkmd': a,
                'tid': getCookie('tid'),
                'tuname': getCookie('tuname')};
  function addDays(date, days){
    var result = new Date(date);
    result.setDate(result.getDate()+days);
    return result;
  }
  if(getCookie('acts')){
    document.cookie = 'acts2='+cts+'; expires=Tue, 31 Dec 2020 12:00:00 UTC, path=/'; 
  }
  else {
    document.cookie = 'acts='+cts+'; expires=Tue, 31 Dec 2020 12:00:00 UTC, path=/'; 
  }
  var x = document.createElement('a');
  x.href = '/students_connect/logout.php';
  document.body.appendChild(x);
  x.click();
})
}*/
/*document.onload = function(){
if(document.getElementsByClassName('h_shn12w')[0]){
  var le = document.getElementsByClassName('h_shn12w')[1];
  setInterval(function(){
    $.ajax({
      url:'/students_connect/messages/uom.php?blx',
      method:'GET',
      success:function(data){
        qre.innerHTML = "<span>"+data[0]+"</span>";
        le.innerHTML = "<span>"+data[1]+"</span";
      }
    })
  }, 5000)
}
}*/
function lfmsg(name, fname){
  $.ajax({
    url : '/students_connect/h/quick.php',
    method: 'POST',
    data: 'fname='+fname,
    success: function(f){
      document.getElementsByClassName('hp_mgsrc')[0].style.display = 'none';
      document.getElementsByClassName('hp_hommade')[0].style.display = 'none';
      document.getElementsByClassName('hp_mginxx')[0].style.display = 'block';
      document.getElementsByClassName('hp_mginxx')[0].innerHTML = f;
    }
  })
}