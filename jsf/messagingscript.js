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
        if(document.getElementsByClassName('m_own12w')[0]){
          document.getElementsByClassName('m_own12w')[0].style.backgroundColor = '#282b2f';
        }
        if(document.getElementsByClassName('msgfrmar')[0]){
          document.getElementsByClassName('msgfrmar')[0].style.backgroundColor = '#282b2f';
          document.getElementsByClassName('msgfrmar')[0].style.color = 'inherit';
          document.getElementById('mesgtxt').style.backgroundColor = '#282b2f';
          document.getElementById('mesgtxt').style.borderColor = 'white';
        }
        if(document.getElementsByClassName('uprt')[0]){
          document.getElementsByClassName('uprt')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          document.getElementsByClassName('uprt')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('btmpt')[0]){
          document.getElementsByClassName('btmpt')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('micox')[0]){
          document.getElementsByClassName('micox')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          document.getElementsByClassName('micox')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('mg_xtended')[0]){
          document.getElementsByClassName('mg_xtended')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          document.getElementsByClassName('mg_xtended')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('replymessagecont')[0]){
          document.getElementsByClassName('replymessagecont')[0].style.cssText = 'background-color:rgb(40, 43, 47) !important';
          document.getElementsByClassName('replymessagecont')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('pcotm1')[0]){
          for(var i = 0; i < document.getElementsByClassName('pcotm1').length; i++){
          document.getElementsByClassName('pcotm1')[i].style.cssText = 'background-color:rgb(40, 43, 47) !important; color: white !important;';
          if(document.getElementsByClassName('pcotm1')[i].className.includes('q_lsset')){
          document.getElementsByClassName('pcotm1')[i].classList.add('maxit');
          }
          else {
            document.getElementsByClassName('pcotm1')[i].classList.add('maxit1');
          }
          }
        }
        if(document.getElementsByClassName('uprt1')[0]){
          document.getElementsByClassName('uprt1')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          document.getElementsByClassName('uprt1')[0].style.color = 'white';
        }
        if(document.getElementsByClassName('flow_down')[0]){
          document.getElementsByClassName('flow_down')[0].style.backgroundColor = 'rgb(40, 43, 47)';
          document.getElementsByClassName('flow_down')[0].style.color = 'white';
        }
        if(document.getElementById('wcws')){
          document.getElementById('wcws').style.backgroundColor = 'gray';
        }
        if(document.getElementsByClassName('ttr')[0]){
            document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgb(15,15,15,0.7)';
            a = document.getElementsByClassName('tgd')
        for(x =0; x < a.length; x++){
           a[x].style.color='white'
            a[x].getElementsByTagName('a')[0].style.color = 'white'; 
        }
        }
        if(document.getElementsByClassName('dchngr')[0]){
            document.getElementsByClassName('dchngr')[0].checked = true;
        }
        if(document.getElementsByClassName('dwn')){
        var dwn = document.getElementsByClassName('dwn');
            for(i = 0; i < dwn.length; i++){
            dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
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
    document.getElementById('darkmd').style.backgroundColor = 'white';
    document.getElementById('darkmd').style.color = 'black';
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
  window.onload = function(){
    checkDark();
    document.getElementsByClassName('dark-mode')[0].style.minHeight = window.innerHeight+'px';
  }
function openGroupSettings(cuser, gid){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('amib').style.display='none';
            document.getElementById('wcws').style.display='none';
            document.getElementById('dinf').style.display='block';
            document.getElementById('dinf').innerHTML = xmlhttp.responseText;
            var f = document.createElement('script');
            f.src = '/students_connect/jsf/messagingscript.js';
            f.type = 'text/javascript';
            var e = document.getElementsByTagName('HEAD')[0];
             e.append(f);
        }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/shwinf.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("cuser="+cuser+"&gid="+gid);     
}
if(document.getElementsByClassName('stmgrp')){
    var t = document.getElementsByClassName('stmgrp');
    for(var i =0; i < t.length; i++){
    t[i].onclick = function(){
        var k = this.children[0].value;
        var q = this.children[1].value;
    openGroupSettings(k, q);
    }
}
}
if(document.getElementsByClassName('stnot')[0]){
  var xlo = document.getElementsByClassName('stnot')[0];
  xlo.onclick = function(){
    q = this.children[0].value;
    var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById('amib').style.display='none';
            document.getElementById('wcws').style.display='none';
            document.getElementById('dinf').style.display='block';
            document.getElementById('dinf').innerHTML = xmlhttp.responseText;
            var f = document.createElement('script');
            f.src = '/students_connect/jsf/messagingscript.js';
            f.type = 'text/javascript';
            var e = document.getElementsByTagName('HEAD')[0];
             e.append(f);
    }
};
  xmlhttp.open('POST', '/students_connect/messages/shwinf.php');
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("aid="+q);
  }
}
if(document.getElementsByClassName('gr_accp')[0]){
  var gp = document.getElementsByClassName('gr_accp');
  for(var i = 0; i < gp.length; i++){
    gp[i].onclick = function(){
      var oot = this;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          oot.parentElement.innerHTML = 'Done';
                
        }
      }
      xmlhttp.open('POST', '/students_connect/messages/joingroup.php');
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("m="+this.children[0].value);
    }
  }
}
if(document.getElementsByClassName('gr_delet')[0]){
  var gp = document.getElementsByClassName('gr_delet');
  for(var i = 0; i < gp.length; i++){
    gp[i].onclick = function(){
      var oot = this;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          oot.parentElement.innerHTML = 'Done';
        }
      }
      xmlhttp.open('POST', '/students_connect/messages/joingroup.php');
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("q="+this.children[0].value);
    }
  }
}
function sndGMsg(username, groupid, message, hasfile, isreply, replyingto){
    document.getElementById('replymessage').style.display = 'none';
      if(message.includes('&') == true){
        message = message.replace(/&/g, '/ampersandsymbol/');
      }
      if(message == "" || message == " " || message == "  " || message == "   "){
        //dont do anything
      }
      else {
      document.getElementById('mesgtxt').value="";
      var fl =false;
      if(window.FormData){
      fl =  new FormData();
      }
      if(document.getElementById('chsimg').files.length >= 1){
        var exa = document.getElementById('chsimg').files;
        for(var i =0; i < exa.length; i++){
          var pet = exa[i];
          fl.append("files[]", pet);
        }
      }
      fl.append("username", username);
      fl.append("groupid", groupid);
      fl.append("message", message);
      fl.append("hasfile", hasfile);
      fl.append("isreply", isreply);
      fl.append("replying", replyingto);
      document.getElementById('mesgtxt').style.height = '';
      document.getElementById('chsimg').value='';
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
          if(document.getElementById('wcws')){
            document.getElementById('wcws').style.backgroundColor = 'lightgray';
            if(window.innerWidth > 799){
              document.body.style.minHeight = (document.documentElement.scrollHeight)+'px';
            }
            document.getElementById('wcws').style.minHeight = document.documentElement.scrollHeight+'px';
            document.getElementById('wcws').style.minHeight = document.body.scrollHeight+'px';
          }
          window.scroll(0, document.body.scrollHeight);
        }
      })   
    }
  }
  if(document.getElementsByClassName('sndgmsgbtn')){
    var d = document.getElementsByClassName('sndgmsgbtn');
    for(i =0; i < d.length; i++){
        d[i].onclick = function(){
            var n = this.children[0].value;
            var o = this.children[1].value;
            var p = document.getElementById("mesgtxt").value
            var q = document.getElementById("isfile").value;
             var r = document.getElementById("rmid").value;
             var s = document.getElementById("rplyto").value;
            sndGMsg(n, o, p, q, r, s);
            }
    }      
  }
  function cgN(nfg, id, user){
    if(document.getElementById('gnlb').innerHTML.length == 0){
        document.getElementById('cnc').className = document.getElementById('cnc').className.replace('right', 'down');
    document.getElementById('gnlb').innerHTML = 
    '<input type="text" value="'+nfg+'" id="gni" autocomplete="off"/>'+
    '<div class="bfc xfgh"><input type="hidden" value="'+id+'"/>'+
    '<input type="hidden" value="'+user+'">Change</div>';
    var f = document.createElement('script');
    f.src = '/students_connect/jsf/messagingscript.js';
    f.type = 'text/javascript';
    var e = document.getElementsByTagName('HEAD')[0];
     e.append(f);
}
    else {
        document.getElementById('cnc').className = document.getElementById('cnc').className.replace('down', 'right');
        document.getElementById('gnlb').innerHTML = '';
        }
}
function fchg(idfg, ngn, chuser){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('ng').innerHTML = xmlhttp.responseText;
          }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/groupst.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("idfg="+idfg+"&chuser="+chuser+"&ngn="+ngn);
}
if(document.getElementsByClassName('maersk')){
    var gt = document.getElementsByClassName('maersk');
    for(var t = 0; t < gt.length; t++){
        gt[t].onclick = function(){
            var u = this.children[0].value;
            var r = this.children[1].value;
            var m = document.getElementById("ng").innerHTML;
            cgN(m,u,r);
        }
    }
}
if(document.getElementsByClassName('xfgh')){
    var ls = document.getElementsByClassName('xfgh');
    for(var t =0; t < ls.length; t++){
        ls[t].onclick = function(){
            var e = this.children[0].value;
            var f = this.children[1].value;
            var g = document.getElementById('gni').value;
            fchg(e,g ,f)
        }
    }
}
function cgD(ndn, did, duser){
    if(document.getElementById('gdnme').innerHTML.length == 0){
        document.getElementById('cdc').className = document.getElementById('cnc').className.replace('right', 'down');
    document.getElementById('gdnme').innerHTML = 
    '<input type="text" value="'+ndn+'" id="gnd" autocomplete="off"/>'+
    '<div class="bfc lotedes">'+
    '<input type="hidden" value="'+did+'"/>'+
    '<input type="hidden" value="'+duser+'">'+
    'Change</div>';
    var f = document.createElement('script');
    f.src = '/students_connect/jsf/messagingscript.js';
    f.type = 'text/javascript';
    var e = document.getElementsByTagName('HEAD')[0];
     e.append(f);
}
else {
    document.getElementById('cdc').className = document.getElementById('cnc').className.replace('down', 'right');
        document.getElementById('gdnme').innerHTML = '';
}
}
function gdchg(idd, ngd, duser){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

          }
                    };
                    xmlhttp.open('POST', '/students_connect/messages/groupst.php');
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("idd="+idd+"&duser="+duser+"&ngd="+ngd);
}
if(document.getElementsByClassName('cgrdenm')){
    var ft = document.getElementsByClassName('cgrdenm');
    for(var i = 0; i < ft.length; i++){
        ft[i].onclick = function(){
            var qt = this.children[0].value;
            var qp = this.children[1].value;
            var qx = document.getElementById("gd").value;
            cgD(qx, qt, qp);
        }
    }
}
if(document.getElementsByClassName('lotedes')){
    var xt = document.getElementsByClassName('lotedes');
    for(var i =0; i < xt.length; i++){
        xt[i].onclick = function(){
            var m = this.children[0].value;
            var l = this.children[1].value;
            var p = document.getElementById('gnd').value;
            gdchg(m,p,l);
        } 
    }
}
if(window.innerWidth <799 && document.getElementsByTagName('IMG')){
        var iks = document.getElementsByTagName('IMG'); 
        for(var x = 0; x < iks.length; x++){ 
         var mn = document.getElementsByTagName('IMG')[x]; 
         mn.onclick = function(){ 
       var y = this.src;
       var z = document.getElementById('thimgv'); 
       var q = z.innerHTML;
       if(q.includes('img')){ 
       document.getElementsByClassName('imgsmall')[0].src = y; 
       document.getElementsByClassName('timgbsys')[0].style.display = 'block'; 
       document.getElementsByClassName('img_mod')[0].style.backgroundImage = "url('"+y+"')";
       document.getElementsByClassName('imgsmall')[0].onload = function(){ 
       document.getElementById('plding').style.display = 'none'; 
       };
       document.getElementsByClassName('imgsmall')[0].onerror = function(){ 
       document.getElementById('timgerror').innerHTML = 'Error Loading Picture'; 
       document.getElementById('plding').style.display = 'none'; 
       } 
       } 
       else { 
       var a = document.createElement('IMG'); 
       a.className= 'imgsmall'; 
       a.src = y; 
       var newdiv = document.createElement('div');
       newdiv.style.backgroundImage = "url('"+y+"')";
       newdiv.className = 'img_mod';
       document.getElementById('plding').style.display = 'block'; 
       z.append(newdiv);
       z.append(a);
       document.getElementsByClassName('imgsmall')[0].onload = function(){ 
       document.getElementById('plding').style.display = 'none'; 
       };
       document.getElementsByClassName('imgsmall')[0].onerror = function(){ 
       document.getElementById('timgerror').innerHTML = 'Error Loading Picture'; 
       document.getElementById('plding').style.display = 'none'; 
       };
       document.getElementsByClassName('timgbsys')[0].style.display = 'block'; 
     };
    };
     };
     var mod = document.getElementsByClassName('timgbsys')[0]; 
     window.onclick = function(event) { 
       if (event.target == mod) { 
         document.getElementsByClassName('timgbsys')[0].style.display = 'none';
        } 
     }; 
    
     var cl = document.getElementById('clview'); 
     cl.onclick = function(){ 
       document.getElementsByClassName('timgbsys')[0].style.display = 'none'; 
       }
      }
if(document.getElementsByClassName('play_button')[0]){
  var playbutton = document.getElementsByClassName('play_button');
  var progline = document.getElementsByClassName('tow_th_poiter');
  var smallcircle = document.getElementsByClassName('smallcircleinside');
  var audio = document.getElementById('audioplayer');
  for(var i =0; i < playbutton.length; i++){
    playbutton[i].onclick = function(){
      if(audio.src != this.children[1].value){
      audio.src = this.children[1].value;
      }
      var plytyp = this.parentElement.children[1].children[0].children[0];
      var ath = this;
      if(audio.paused){
        audio.play();
        this.children[0].className = this.children[0].className.replace('play', 'pause');
      }
      else {
        var cont = 0;
        var norwidth = audio.duration;
        var curwidth = audio.currentTime;
        var curper = (curwidth/norwidth) * 100;
        plytyp.style.width = curper+'%';
        audio.pause();
        this.children[0].className = this.children[0].className.replace('pause', 'play'); 
      }
        var cont = 1;
        setInterval(function(){
          if(cont == 1){
          cur();
          }
       }, 1000);
       function cur(){
        if(!audio.paused){
        var norwidth = audio.duration;
        var curwidth = audio.currentTime;
        var curper = (curwidth/norwidth) * 100;
        plytyp.style.width = curper+'%';
        if(curper == 100){
          cont = 0;
          this.children[0].className = this.children[0].className.replace('pause', 'play');
        }
      }
      }
      audio.onpause = function(){
        var norwidth = audio.duration;
              var curwidth = audio.currentTime;
              var curper = (curwidth/norwidth) * 100;
            var plytyp = ath.parentElement.children[1].children[0].children[0];
              plytyp.style.width = curper+'%';
              ath.children[0].className = ath.children[0].className.replace('pause', 'play'); 
          }
      audio.onplay = function(){
        ath.children[0].className = ath.children[0].className.replace('play', 'pause');
        
      }
    }
    smallcircle[i].ondrag = function(e){
      audio.src = this.parentElement.parentElement.parentElement.parentElement.children[0].children[1].value;
      var r = parseInt(e.clientX);
      this.parentElement.style.width = ((r-390)/205)*100+'%';
      var audd = parseInt(document.getElementsByTagName('audio')[0].duration);
      var mnian = parseInt(
        ((((r-390)/205)*100)/100)*audd);
      if(mnian==NaN){
        audio.currentTime = 0;
      }
      else {
        audio.currentTime = mnian;
      }
    }
    progline[i].onclick = function(e){
      audio.src = this.parentElement.parentElement.children[0].children[1].value;
      var r = e.clientX;
      this.children[0].style.width = ((r-390)/205)*100+'%';
      var audd = document.getElementsByTagName('audio')[0].duration;
      var mnian = parseInt(
        ((((r-390)/205)*100)/100)*audd);
        if(isNaN(mnian)){
        audio.currentTime = 0;
      }
      else {
        audio.currentTime = mnian;
      }
    }
  }
}
if(document.getElementById('mesgtxt')){
  $('#mesgtxt').on('paste input', function(){
    if($(this).outerHeight() > this.scrollHeight){
      $(this).height(1);
    }
    if(this.scrollHeight <= 96){
    while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth"))
    + parseFloat($(this).css("borderBottomWidth"))){
      $(this).height($(this).height() + 1);
    }
  }
  })
  document.getElementById('mesgtxt').onpaste = function(){
    document.getElementById('fyww').value = this.value;
  }
}
if(document.getElementsByClassName('pcotm1')[0]){
  var pc = document.getElementsByClassName('pcotm1');
  var bpressed = '';
  var spressed = '';
  var e1 = '';
  var e2 = '';
  window.onresize = function(){
    for(var i = 0; i < pc.length; i++){
      pc[i].parentElement.children[2].style.display = 'none';
      }
  }
  window.onscroll = function(){
    for(var i = 0; i < pc.length; i++){
      if(pc[i].parentElement.children[2]){
      pc[i].parentElement.children[2].style.display = 'none';
      }
    }
  }
  window.onclick = function(e){
    for(var i = 0; i < pc.length; i++){
    if(e.target == pc[i].parentElement.children[2]){
      pc[i].parentElement.children[2].style.display = 'none';
    }  
    }
  }
  for(var i = 0; i < pc.length; i++){
    pc[i].oncontextmenu = function(e){
      krass(e);
    }
    pc[i].onclick = krass = function(e){
      var tme = e;
    for(var i = 0; i < pc.length; i++){
      pc[i].parentElement.children[2].style.display = 'none';
      }
      var yth = this;
      var td = new Date();
      var ctd = td.getTime();
      if(spressed == '' && bpressed == ''){
        bpressed = td.getTime();
        e1 = e.target;
      }
      if(parseInt(bpressed) !== parseInt(ctd)){
         spressed = td.getTime();
         e2 = e.target;
      }
      if(bpressed !== '' && spressed !== ''){
        if(((parseInt(spressed)/1000) - (parseInt(bpressed)/1000)) < 2){
          bpressed = '';
          spressed = '';
          if(e1 == e2){
          doublepressed();
          }
        }
        else {
          bpressed = '';
          spressed = '';
        }
      }
      function doublepressed(){
        if(yth.children[0].children[0]){
        if(yth.children[0].children[0].className != 'mgcont'){
          var eeval = yth.children[1].children[0];
        }
        else {
          var eeval = yth.children[0].children[0];
        }
        }
        else {
          if(yth.children[1].className == 'mfl'){
            var eeval = yth.children[1].children[0];
          }
          else {
            var eeval = yth.children[2].children[0];
            console.log(eeval);
          }
        }
        yth.parentElement.children[2].children[0].innerHTML = '<div class="om_options">'+
        '<div onclick="replyMessage(\''+eeval.id.substring(5, eeval.id.length)+'\','+
        '\''+document.getElementById(eeval.id.substring(5, eeval.id.length)).title+'\', document.getElementById(\'msgco'+eeval.id.substring(5, eeval.id.length)+'\').innerHTML); this.parentElement.parentElement.parentElement.style.display=\'none\';">Reply <i class="fas fa-reply"></i></div><div>Forward <i class="fas fa-share"></i></div>'+
        '<div class="x_l_o_c_o_p_y" onclick="xcopy()">Copy <i class="fas fa-copy"></i></div>'
        +'<div>Save <i class="fas fa-bookmark"></i></div><div style="color: red;"><input type="hidden" value="'+eeval.id.substring(5, eeval.id.length)+'"></input>Delete <i class="fas fa-trash"></i></div></div>';
        if(document.body.offsetHeight - tme.clientY > 170 && document.body.offsetWidth - tme.clientX > 150){
        yth.parentElement.children[2].children[0].style.top = tme.clientY - 10+'px';
        yth.parentElement.children[2].children[0].style.left = tme.clientX - 40 +'px';
        }
        else if(document.body.offsetHeight - tme.clientY < 50 && document.body.offsetWidth - tme.clientX < 50){
          yth.parentElement.children[2].children[0].style.top = tme.clientY + 100+'px';
          yth.parentElement.children[2].children[0].style.left = tme.clientX + 100 +'px';
          }
        else {
          yth.parentElement.children[2].children[0].style.top = tme.clientY - 170+'px';
        yth.parentElement.children[2].children[0].style.left = tme.clientX - 150 +'px';
        }
        console.log(tme.clientX, tme.clientY)
        if(yth.parentElement.children[2].style.display == 'none'){
          yth.parentElement.children[2].style.display = 'block';
        }
        else {
          yth.parentElement.children[2].style.display = 'none';
        }
        var sved = yth.parentElement.children[2].children[0].children[0].children[3];
        sved.onclick = function(){
          yth.parentElement.children[2].style.display = 'none'
          if(window.FormData){
            fl =  new FormData();
            }
            fl.append('type', 2)
            fl.append('id', eeval.id.substring(5, eeval.id.length));
            fl.append('cap', '');
          $.ajax({
            url: '/students_connect/save/index.php',
            type:"POST",
            data:fl,
            processData: false,
            contentType: false,
            success: function(){
              document.getElementById('ko_llert').innerHTML = 'Saved';
              document.getElementById('middlefor').style.display = 'block'; 
              window.onscroll = function(){
                document.getElementById('middlefor').style.display = 'none'; 
              }
              window.onresize = function(){
                document.getElementById('middlefor').style.display = 'none'; 
              }   
            },
            error: function(){
              document.getElementById('ko_llert').innerHTML = 'Save Failed';
              document.getElementById('middlefor').style.display = 'block'; 
              window.onscroll = function(){
                document.getElementById('middlefor').style.display = 'none'; 
              }
              window.onresize = function(){
                document.getElementById('middlefor').style.display = 'none'; 
              }
            }
          })
        }
        var del = yth.parentElement.children[2].children[0].children[0].children[4];
        del.onclick = function(){
          var dw = this.children[0].value;
          $.ajax({
            url: '/students_connect/messages/svgrmsg.php',
            type: 'POST',
            data: 'dxe='+dw,
            success: function(){
              document.getElementById(dw).remove();
            }
          })
        }
        var toxc = yth.parentElement.children[2].children[0].children[0].children[2];
        toxc.onclick = function(){
          yth.parentElement.children[2].style.display = 'none'
          xcopy();
        }
        function xcopy(){
          if(yth.children[0].children[0].className != 'mgcont'){
            var val = yth.children[1].children[0].innerHTML.replace(/<\/?[^>]+(>|$)/g, '');
          }
          else {
            var val = yth.children[0].children[0].innerHTML.replace(/<\/?[^>]+(>|$)/g, '');
          }
          console.log(val);
          document.getElementById('cc').value = val;
          var val = document.getElementById('cc');
          val.value = val.value.replace(/<br>/g, ' ')
          val.select();
          val.setSelectionRange(0, 9999999);
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
      }
      
    }
    
  }
}
if(document.getElementsByClassName('trmbx')[0]){
  var eet = document.getElementsByClassName('trmbx');
  for(var i = 0; i < eet.length; i++){
    eet[i].onclick = function(){
      var oh = this.children[0].hash;
      var h = oh.substring(1, oh.length);
      if(document.getElementById(h)){
        var t = document.getElementById(h).offsetTop;
        window.scrollTo(0, t-30);
        document.getElementById(h).classList.add('appn');
        setTimeout(function(){
          document.getElementById(h).classList.remove('appn');
        }, 1000)
      }
    }
  }
}
document.onscroll = function(){
  if(window.scrollY == 0){
    if(document.getElementById('hvvvl') && !document.getElementById('ldrfmp')){
    var ab = document.getElementById('hvvvl').value.split(',');
    var abb = ab[0];
    var bbb = ab[1];
    var hq = document.createElement('DIV');
    hq.id = 'ldrfmp';
    //hq.innerHTML = '<span class="x_occl" style="font-size: 13px;">Fetching Older Messages</span>'; 
    var ttq = document.getElementsByClassName('phu')[0];
     ttq.insertBefore(hq, ttq.childNodes[0]);
    fl = new FormData();
    fl.append('oop', '')
    fl.append('mgm', document.getElementById('eupqe').name);
    fl.append('a', abb);
    fl.append('b', bbb);
    var p = parseInt(ab[0])+20;
    var q = parseInt(ab[1]);
    $.ajax({
      url: '/students_connect/messages/uom.php',
      type: 'POST',
      data: fl,
      processData: false,
      contentType: false,
      success: function(d){
        console.log(abb, bbb);
        
        document.getElementById('hvvvl').value = p+','+q   
        var ttq = document.getElementsByClassName('phu')[0];
        ttq.removeChild(hq); 
        var tq = document.createElement('DIV');
         tq.innerHTML = d; 
          ttq.insertBefore(tq, ttq.childNodes[0]);
          if(document.getElementsByClassName('waex')[36]){
          window.scrollTo(0, document.getElementsByClassName('waex')[36].offsetTop);
        }
        if(document.getElementById('wcws')){
          document.getElementById('wcws').style.backgroundColor = 'lightgray';
          if(window.innerWidth > 799){
            document.body.style.minHeight = (document.documentElement.scrollHeight)+'px';
          }
          document.getElementById('wcws').style.minHeight = (document.documentElement.scrollHeight)+'px'; 
        }
      },
      error : function(){
        var p = parseInt(ab[0])-20;
        ttq.removeChild(hq);
      }
     })
  }
}
}
window.onclick = function(e){
  if(document.getElementsByClassName('micox1')[0]){
  if(e.target == document.getElementsByClassName('micox1')[0]){
  document.getElementsByClassName('micox1')[0].style.display = 'none';
}
}
if(document.getElementsByClassName('mg_xtended1')[0]){
  if(e.target == document.getElementsByClassName('mg_xtended1')[0]){
  document.getElementsByClassName('mg_xtended1')[0].style.display = 'none';
}
}
}
if(document.getElementsByClassName('m_options')[0]){
  var mops = document.getElementsByClassName('m_options');
  window.onclick = function(e){
    for(var i = 0; i < mops.length; i++){
      if(e.target == mops[i]){
        mops[i].style.display = 'none';
      }
    }
  }
}
if(document.getElementById('mesgtxt')){
  if(window.innerWidth > 799){
    document.getElementById('mesgtxt').onkeypress = function(e){
      if(e.key == 'Enter'){
        e.preventDefault();
        document.getElementsByClassName('sndmsgbtn')[0].click();
      }
    }
  }
}
/*if(document.getElementsByClassName('waex')[0]){
  var waex = document.getElementsByClassName('waex');
  for(var i = 0; i < waex.length; i++){
    waex[i].ondrag = function(e){
      console.log(e.offsetX);
      if(e.offsetX < 0){
         this.style.left = window.innerWidth+e.offsetX-100+'px'
      }
  }
  waex[i].ondragend = function(){
    this.style.left = 'inherit';
  }
  }
}*/
window.oncontextmenu = function(e){
  e.preventDefault();
}