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
    if(document.getElementsByClassName('a_me_n')[0]){
      document.getElementsByClassName('a_me_n')[0].style.backgroundColor =  '#282b2f';
      document.getElementsByClassName('a_me_n')[0].style.color = 'white';
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
      if(window.innerWidth > 799){
      if(document.getElementsByClassName('std_yx')[0]){
        a = document.getElementsByClassName('std_yx')
      for(x =0; x < a.length; x++){
        a[x].style.color='white' 
        a[x].style.backgroundColor = '#282b2f';
    }
    }
  }
      if(document.getElementsByClassName('dchngr')[0]){
          document.getElementsByClassName('dchngr')[0].checked = true;
      }
      if(document.getElementsByClassName('oe')[0]){
        document.getElementsByClassName('oe')[0].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';
      }
      if(document.getElementsByClassName('dwn')){
      var dwn = document.getElementsByClassName('dwn');
          for(i = 0; i < dwn.length; i++){
          /*dwn[i].style.backgroundColor = 'rgba(245, 245, 245, 0.1)';*/
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
    if(document.getElementsByClassName('cbr')){
      var cbr = document.getElementsByClassName('cbr');
      for(var i = 0; i<cbr.length; i++){
        cbr[i].style.background = 'rgba(245, 245, 245, 0.4)';
      }
    }
    if(document.getElementsByClassName('must')[0]){
      document.getElementsByClassName('must')[0].style.backgroundColor = '#282b2f';
    }
    if(document.getElementsByClassName('tnavtop')[0]){
      document.getElementsByClassName('tnavtop')[0].style.backgroundColor = '#282b2f';
    }
    if(document.getElementsByClassName('f_jaaheading')[0]){
      document.getElementsByClassName('f_jaaheading')[0].style.backgroundColor = '#282b2f';
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
  if(window.innerWidth > 799){
  if(document.getElementsByClassName('std_yx')[0]){
    a = document.getElementsByClassName('std_yx')
  for(x =0; x < a.length; x++){
    a[x].style.color='black' 
    a[x].style.backgroundColor = 'white';
}
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
  if(document.getElementsByClassName('must')[0]){
    document.getElementsByClassName('must')[0].style.backgroundColor = 'white';
  }
  if(document.getElementsByClassName('dchngr')[0]){
      document.getElementsByClassName('dchngr')[0].checked = false;
  }
  //if(document.getElementsByClassName('dwn')){
    //  var dwn = document.getElementsByClassName('dwn');
      //    for(i = 0; i < dwn.length; i++){
        //  dwn[i].style.backgroundColor = 'rgba(15, 15, 15, 0.1)';
  //}
//}
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
if(document.getElementsByClassName('tnavtop')[0]){
  document.getElementsByClassName('tnavtop')[0].style.backgroundColor = 'white';
}
}
}
window.onload = checkDark();
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
var a = getCookie('tuname');
if(a != ''){
if(document.getElementsByClassName('lastpl')){
  var g = document.getElementsByClassName('lastpl');  
                   for(var i = 0; i < g.length; i++){  
                     var xe = g[i];  
                     xe.onclick = function(){
                       var crar = [];  
                       var value= this.value; 
                       var pid = this.children[3].value; 
                       var user = this.children[2].value; 
                       var pstst = this.children[4].value;
                       a = this.firstElementChild.className; 
                       this.firstElementChild.className = a.replace('far fa-circle c_y', 'fas fa-check-circle c_x'); 
                       this.style.background = 'linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8))'; 
                       this.style.backgroundRepeat = 'no-repeat'; 
                       var x = this.parentElement; 
           var xy = x.parentElement;
           var ex = xy.parentElement;
           var kxy = ex.children; 
           for(var e = 0; e < kxy.length; e++){  
           var k = kxy[e].children; 
           for(var d = 0; d < k.length; d++){ 
             var l = k[d].children; 
             for(var t = 0; t < l.length; t++){ 
             l[t].setAttribute('disabled', 'disabled'); 
             crar.push(l[t]); 
           } 
           } 
          } 
          var ls1 = crar[0].children[5]; 
          var ls2 = crar[1].children[5]; 
          var ls3 = crar[2].children[5]; 
          var ls4 = crar[3].children[5]; 
          var xmlhttp = new XMLHttpRequest(); 
          xmlhttp.onreadystatechange = function() { 
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              var db = xmlhttp.responseText;
              var p1 = db.indexOf('P'); 
              var p2 = parseInt(db.indexOf('K')+1); 
              var p3 = parseInt(db.indexOf('A')+1); 
              var p4 = db.indexOf('T'); 
              ls1.innerHTML = db.substring(0, p1); 
              ls2.innerHTML = db.substring(p1+1, parseInt(p2-1)); 
              ls3.innerHTML = db.substring(p2, p3-1); 
              ls4.innerHTML = db.substring(p3, p4);
              crar[0].style.backgroundSize = ls1.children[0].innerHTML+' 100%'; 
              crar[1].style.backgroundSize = ls2.children[0].innerHTML+' 100%'; 
              crar[2].style.backgroundSize = ls3.children[0].innerHTML+' 100%'; 
              crar[3].style.backgroundSize = ls4.children[0].innerHTML+' 100%'; 
              ex.children[1].innerHTML = parseInt(ex.children[1].innerHTML.substring(0, ex.children[1].innerHTML.length-5))+1+" votes";
            } 
        }; 
        xmlhttp.open('GET', '/students_connect/polls/?id='+pid+'&vote='+value+'&user='+user+'&pstst='+pstst); 
        xmlhttp.send(); 
        } 
        } 
        }
        if(document.getElementsByTagName('IMG')){
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
       if(y.includes('postuploads')){
         if(document.getElementsByClassName('finsihes_img')[0]){
          var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
        if(crack.className.includes('undbtn') == false){
          crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
        }
          document.getElementsByClassName('finsihes_img')[0].innerHTML = crack.innerHTML;
       }
       else {
        var tto = document.createElement('div');
        tto.className = 'finsihes_img';
        tto.classList.add("undbtn");
        var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
        if(crack.className.includes('undbtn') == false){
          crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
        }
        tto.innerHTML = crack.innerHTML;
        document.getElementsByClassName('timgbsys')[0].append(tto);
       }
      }
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
     if(y.includes("postuploads")){
       var tto = document.createElement('div');
       tto.className = 'finsihes_img';
       tto.classList.add("undbtn");
       var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
       if(crack.className.includes('undbtn') == false){
         crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
       }
       tto.innerHTML = crack.innerHTML;
       document.getElementsByClassName('timgbsys')[0].append(tto); 
    }
       document.getElementsByClassName('timgbsys')[0].style.display = 'block'; 
     };
    };
     };
     var mod = document.getElementsByClassName('timgbsys')[0]; 
     window.onclick = function(event) { 
       if (event.target == mod) { 
         document.getElementsByClassName('timgbsys')[0].style.display = 'none';
         if(document.getElementsByClassName('finsihes_img')[0]){
          document.getElementsByClassName('finsihes_img')[0].remove(); 
         }
        } 
     }; 
     if(document.getElementById('clview')){
     var cl = document.getElementById('clview'); 
     cl.onclick = function(){ 
       document.getElementsByClassName('timgbsys')[0].style.display = 'none'; 
       if(document.getElementsByClassName('finsihes_img')[0]){
       document.getElementsByClassName('finsihes_img')[0].remove(); 
      }
    }
      }
 
      }
      

    if(document.getElementsByClassName('cbr')[0]){
  var ex = document.getElementsByClassName('cbr');
  for(var mt = 0; mt < ex.length; mt++){
  var followclick;
  ex[mt].onclick = followclick = function(){
  if(!this.innerHTML.includes('Blocked')){
  var lx = this.parentElement;
  var thiss = this;
  var fuser = lx.children[1].value;
  var user = lx.children[2].value;
  var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      thiss.children[0].innerHTML = xmlhttp.responseText;
                      if(document.getElementsByClassName("ssm_new_action")[0]){
                      document.getElementsByClassName("ssm_new_action")[0].remove()
                      document.getElementsByClassName('flw')[0].innerHTML = xmlhttp.responseText;
                    }
                    if(xmlhttp.responseText.includes('Follow') && !xmlhttp.responseText.includes('Following')){
                        if(document.getElementsByClassName('f_shth123')[0]){
                          document.getElementsByClassName('f_shth123')[0].innerHTML = parseInt(document.getElementsByClassName('f_shth123')[0].innerHTML)-1;
                        }
                    }
                    else {
                      if(document.getElementsByClassName('f_shth123')[0]){
                      document.getElementsByClassName('f_shth123')[0].innerHTML = parseInt(document.getElementsByClassName('f_shth123')[0].innerHTML)+1;
                      }
                    }
                    }
                  };
                  xmlhttp.open('POST', '/students_connect/profile/fform.php');
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlhttp.send("subfol=&fuser="+fuser+"&user="+user);
                }
else {
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
        qx.style.fontSize = '14px';
        qx.innerHTML = 'User was blocked by you. Unblock from <a href="/students_connect/settings/unblock">settings</a>';
        document.body.append(qx);
        setTimeout(function(){
          qx.style.display = 'none';
        }, 4000)
}
}
}
}
if(document.getElementsByClassName('xt_2')[0]){
var pex  = document.getElementsByClassName('xt_2')[0];
pex.onclick = oprofile = function(){
  var x = document.getElementById('xy_y');
  var e = document.getElementById('yx_x');
  var p = document.getElementById('xt_x');
  var q = document.getElementById('xt_y');
  x.style.display = 'block';
  e.style.display = 'none';
  p.style.display = 'none';
  q.style.display = 'none';
  var tuz = x.parentElement.children[0].children[0].value;
  var ep = x.parentElement.children[0].children;
  for(var i = 0; i< ep.length; i++){
    ep[i].className = ep[i].className.replace("practive", "");
  }
  ep[2].classList.add("practive");
  if(x.innerHTML == null || x.innerHTML == ""){
      $.ajax({
        url:'/students_connect/profile/xprofile.php?tuz='+tuz,
        method:'GET',
        success:function(data){
          $('.x_y').html(data);
        }   
  })
  }
}
}
if(document.getElementsByClassName('xt_1')[0]){
var tex  = document.getElementsByClassName('xt_1')[0];
tex.onclick = function(){
  var x = document.getElementById('yx_x');
  var e = document.getElementById('xy_y');
  var p = document.getElementById('xt_x');
  var q = document.getElementById('xt_y');
  x.style.display = 'block';
  x.children[2].style.display = 'block';
  var lt = x.children[0].value;
  var user = x.parentElement.children[0].children[0].value;
  var checking = x.children[1].value;
  $.get('/students_connect/profile/newposts.php?user='+user+'&lt='+lt+'&checking='+checking, function(data){
    $('#ldrfmp').hide();
      $(data).insertAfter($('#ldrfmp'));
      var e = new Date();
      document.getElementById('xyxlt').value = parseInt(e.getTime()/1000);
      var f = document.createElement('script');
               f.src = '/students_connect/jsf/filescript.js';
               f.type = 'text/javascript';
               var e = document.getElementsByTagName('HEAD')[0];
                e.append(f);
    })
  e.style.display = 'none';
  p.style.display = 'none';
  q.style.display = 'none';
  var ep = x.parentElement.children[0].children;
  for(var i = 0; i< ep.length; i++){
    ep[i].className = ep[i].className.replace("practive", "");
  }
  ep[1].classList.add("practive");
}
}
if(document.getElementsByClassName('xt_3')[0]){
var xi = document.getElementsByClassName('xt_3')[0];
var admit = xi.onclick = function(){
  var p = document.getElementById('xy_y');
  var e = document.getElementById('yx_x');
  var x = document.getElementById('xt_x');
  var q = document.getElementById('xt_y');
  x.style.display = 'block';
  e.style.display = 'none';
  p.style.display = 'none';
  q.style.display = 'none';
  var viewing = x.parentElement.children[0].children[0].value;
  var viewer = document.getElementById('checkinguser').value;
  var ep = x.parentElement.children[0].children;
  for(var i = 0; i< ep.length; i++){
    ep[i].className = ep[i].className.replace("practive", "");
  }
  ep[3].classList.add("practive");
      $.ajax({
        url:'/students_connect/profile/fstuff.php?viewing='+viewing+'&viewer='+viewer,
        method:'GET',
        success:function(data){
          $('.t_x').html(data);
          var e = document.createElement('SCRIPT');
          var t = document.getElementsByTagName('HEAD')[0];
          e.src = '/students_connect/jsf/filescript.js';
          t.append(e);
        },
        error:function(){
          $('.t_x').html("<div class='error'>Error Loading Followers,"+
          " <span color='blue' class='trtfollow'>try again</span>.</div><span></span>")
        }   
  })
  }
}
  if(document.getElementsByClassName('rf_xoop')){
  var xex = document.getElementsByClassName('rf_xoop');
  for(var o = 0; o < xex.length; o++){
xex[o].onclick = function(){
  if(!this.innerHTML == 'Blocked'){
  var lx = this.parentElement;
  var fuser = lx.children[0].value;
  var user = lx.children[1].value;
  var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      lx.children[2].innerHTML = xmlhttp.responseText;
                      }
                  };
                  xmlhttp.open('POST', '/students_connect/profile/fform.php');
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlhttp.send("subfol=&fuser="+fuser+"&user="+user);
}
else {
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
        qx.style.fontSize = '14px';
        qx.innerHTML = 'User was blocked by you. Unblock from <a href="/students_connect/settings/unblock">settings</a>';
        document.body.append(qx);
        setTimeout(function(){
          qx.style.display = 'none';
        }, 4000)
}
}
}
  }
  
if(document.getElementsByClassName('extx')){
  var pix = document.getElementsByClassName('extx');  
  var g, i, o, t, p;
    g = pix.length;
    for(i = 0; i < g; i++){
      pix[i].onclick = function(){
        t = this.parentElement.parentElement;
        p = t.children[1].style.display;
        if(p == 'block'){
          t.children[1].style.display = 'none';
        }
        else {
          t.children[1].style.display = 'block';
        };
      window.onclick = function(event) {
        if (event.target == t.children[1]) {
            t.children[1].style.display = "none";
        }
    }
      }
      
    }
}
if(document.getElementsByClassName('xt_4')[0]){
var exi = document.getElementsByClassName('xt_4')[0];
var admit1 = exi.onclick = function(){
  var p = document.getElementById('xy_y');
  var e = document.getElementById('yx_x');
  var q = document.getElementById('xt_x');
  var x = document.getElementById('xt_y');
  x.style.display = 'block';
  e.style.display = 'none';
  p.style.display = 'none';
  q.style.display = 'none';
  var rviewing = x.parentElement.children[0].children[0].value;
  var rviewer = document.getElementById('checkinguser').value;
  var ep = x.parentElement.children[0].children;
  for(var i = 0; i< ep.length; i++){
    ep[i].className = ep[i].className.replace("practive", "");
  }
  ep[4].classList.add("practive");
      $.ajax({
        url:'/students_connect/profile/fstuff.php?rviewing='+rviewing+'&rviewer='+rviewer,
        method:'GET',
        success:function(data){
          $('.t_y').html(data);
          var e = document.createElement('SCRIPT');
          var t = document.getElementsByTagName('HEAD')[0];
          e.src = '/students_connect/jsf/filescript.js';
          t.append(e);
        },
        error:function(){
          $('.t_y').html("<div class='error'>Error Loading Following,"+
          " <span color='blue' class='trtfollow'>try again</span>.</div><span></span>")
        }   
  })
  }
}
if(document.getElementsByClassName('shr') && (window.innerWidth > 799)){
  var q, w, e;
  var q = document.getElementsByClassName('shr');
  if(document.getElementById('darkmd')){
  var mxe = document.getElementById('darkmd').style.backgroundColor;
  var we = document.getElementById('darkmd').style.color;
  var qx = "";
  for(w = 0; w < q.length; w++){
    q[w].onclick = function(){
      qx = window.pageYOffset;
      e = this.parentElement;
      for(var i = 0; i < e.children.length; i++){
        if(e.children[i].className == 'oe'){
          document.documentElement.style.position = 'fixed';
          e.children[i].style.backgroundColor = mxe;
          e.children[i].style.color = we;
          e.children[i].style.zIndex = '20';
          e.children[i].style.display = 'block'; 
          var ql = e.children[i];
          var xc = e.children[i].innerHTML;
            e.children[i].children[0].onclick = function(){
            ql.innerHTML = xc;
            this.parentElement.style.display = 'none';
            this.parentElement.children[1].children[1].style.display = 'block';
            this.parentElement.children[1].children[2].style.display = 'none';
          }
          }
        }
      }
    }
  } 
}
  if(document.getElementsByClassName('shr') && (window.innerWidth <= 799)){
    var q, w, e;
    var q = document.getElementsByClassName('shr');
    if(document.getElementById('darkmd')){
    var mxe = document.getElementById('darkmd').style.backgroundColor;
    var we = document.getElementById('darkmd').style.color;
    var qx = "";
    for(w = 0; w < q.length; w++){
      q[w].onclick = function(){
        qx = window.pageYOffset;
        e = this.parentElement;
        for(var i = 0; i < e.children.length; i++){
          if(e.children[i].className == 'oe'){
            document.body.style.position = 'fixed';
            document.documentElement.style.position = 'fixed';
            console.log(document.getElementById('darkmd').style.backgroundColor)
            e.children[i].style.backgroundColor = document.getElementById('darkmd').style.backgroundColor;
            e.children[i].style.color = document.getElementById('darkmd').style.color;
            e.children[i].style.zIndex = '20';
            e.children[i].style.display = 'block'; 
            var ql = e.children[i];
            var xc = e.children[i].innerHTML;
            e.children[i].children[0].onclick = function(){
            document.body.style.position = 'relative';
            document.documentElement.style.position = 'relative';
            window.scrollTo(0, qx);
            this.parentElement.style.display = 'none';
            this.parentElement.children[1].children[1].style.display = 'block'
            this.parentElement.children[1].children[2].style.display = 'none'
          }
          }
        }
      }
    } 
  }
  }
  if(document.getElementsByClassName('share')[0]){
    var tsl = document.getElementsByClassName('share');
    for(var i = 0; i < tsl.length; i++){
      tsl[i].addEventListener('click', function(){
        var shpid = this.children[0].value;
        var shptype = this.children[1].value;
        var shtext = this.parentElement.children[1].value;
        var olx = this;
        var ll = new FormData();
        ll.append('shpid', shpid);
        ll.append('shptype', shptype);
          ll.append('spcont', shtext);
        $.ajax({
          url:"/students_connect/upsts/shared.php",
          type:'POST',
          data: ll,
          processData: false,
          contentType: false,
          success : function(){
              var os = document.createElement('div');
              os.className = 'o_success';
              os.innerHTML = 'Share Successful';
              os.style.display = 'block';
              document.body.append(os);
              setTimeout(function(){
                  os.remove()
              }, 2500);
          },
          error: function(){
            var os = document.createElement('div');
              os.className = 'o_failed';
              os.innerHTML = 'Share Failed';
              os.style.display = 'block';
              document.body.append(os);
            setTimeout(function(){
              os.remove();
            }, 2500);
          }
        })
        /*$.post("/students_connect/upsts/shared.php",
      {
        shpid: shpid,
        shptype: shptype,
        spcont: shtext
      },
      function(data){
        olx.parentElement.children[0].children[1].innerHTML = '';
      });*/
        })
    }
    var oqx = document.getElementsByClassName('pplex');
    for(var i = 0; i < oqx.length; i++){
      oqx[i].addEventListener('click', function(){
        this.parentElement.parentElement.parentElement.children[2].style.display = 'block';
        this.parentElement.parentElement.parentElement.children[1].style.display = 'none';
      })
    }
  }

    if(document.getElementsByClassName('tesmby')){
      var a, b, l, d, e, f;
      a = document.getElementsByClassName('tesmby');
      for(f = 0; f < a.length; f++){
        b = document.getElementsByClassName('tesmby')[f];
        b.onclick = function(){
          d = this.parentElement;
          l = d.children[1];
          // if(window.innerWidth < 799){
          if(l.style.display =='none' || l.style.display == ''){
            l.style.display = 'block';
            if(window.innerWidth > 799){
            l.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
            l.style.color = document.getElementsByClassName('dark-mode')[0].style.color;
            }
          }
          else {
            l.style.display = 'none'; 
          }
          /*}
          else {
            var kil = document.getElementsByClassName('action-center')[0];
            if(kil.innerHTML.length == 0){
            document.getElementsByClassName('action-center')[0].innerHTML = l.innerHTML;
            kil.style.display = 'block';
            kil.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
            kil.style.color = document.getElementsByClassName('dark-mode')[0].style.color;
            }
            else {
              kil.innerHTML = '';
              kil.style.display = 'none';
            }
          }*/
          window.onclick = function(event){
            if(l == event.target){  
            l.style.display = 'none';
            }
          }
        }
        if(document.getElementsByClassName('yxclose')[f]){
        var lm = document.getElementsByClassName('yxclose')[f];
        lm.onclick = function(){
          d = this.parentElement.parentElement;
          l = d.children[1];
          l.style.animationName = 'emu';
          l.style.display = 'none';
          l.style.animationName = 'mnu';
        }
        b = document.getElementsByClassName('tesmby')[f];
        d = b.parentElement;
          l = d.children[1];
        window.onclick = function(event){
          if(l == event.target){  
            l.style.animationName = 'emu';
          l.style.display = 'none';
          l.style.animationName = 'mnu';
          }
        }
      }  
    }
  }
    if(document.getElementsByClassName('cotx')){
      k = document.getElementsByClassName('cotx')
      var p, q, r,s, t,u;
      for(var u =0; u < k.length; u++){
        p = k[u];
        p.onclick = function(){
          q = this.children[0].value;
        s = this.children[1].value;
        t = this.children[2].value;
          if(q == 0){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById('quest').innerHTML = xmlhttp.responseText;
                  var f = document.createElement('script');
                     f.src = '/students_connect/jsf/filescript.js';
                     f.type = 'text/javascript';
                     var e = document.getElementsByTagName('HEAD')[0];
                      e.append(f);
                  window.history.pushState("", y, '/students_connect/posts/'+s+'/');
              }
          };
          xmlhttp.open('GET', '/students_connect/posts/pst?pid='+s+'&cid=0');
          xmlhttp.send();
          }
          else if(q == 1){
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById('quest').innerHTML = xmlhttp.responseText;
              var f = document.createElement('script');
              f.src = '/students_connect/jsf/filescript.js';
              f.type = 'text/javascript';
              var e = document.getElementsByTagName('HEAD')[0];
               e.append(f);
              window.history.pushState("", t, '/students_connect/posts/s'+s+'/');
  
            }
      };
      xmlhttp.open('GET', '/students_connect/posts/pst?spid='+s);
      xmlhttp.send();
          }
        }
      }
    }
if(document.getElementsByClassName('tr_ash')){
  var x = document.getElementsByClassName('tr_ash');
  for(var i =0; i<x.length; i++){
    x[i].onclick = function(){
      var t = this.children[0].value;
      var p = this.children[1].value;
      var q = this.children[2].value;
      var tes = this.parentElement.parentElement.parentElement.parentElement.parentElement;
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            tes.style.display = 'none';
          }
      };
      xmlhttp.open('GET', '/students_connect/posts/regulator.php?id='+t+'&usr='+p+'&type='+q);
      xmlhttp.send();
    }
  }
}
if(document.getElementsByClassName('ma_li_mp')[0]){
  var ww =[''];
  var e = document.getElementsByClassName('pm_l')[0];
  var f = document.getElementsByClassName('pm_o')[0];
  var g = document.getElementsByClassName('pm_e')[0];
  var u = document.getElementsByClassName('view-posts')[0];
  var v = document.getElementsByClassName('postarea')[0];
  var w = document.getElementsByClassName('mi_e_lan')[0];
  var all = document.getElementsByClassName('md_al_fall')[0];
  var pr = document.getElementsByClassName('md_al_pr')[0];
  var ph = document.getElementsByClassName('md_f_ph')[0];
  var vd = document.getElementsByClassName('md_f_vd')[0];
  var au = document.getElementsByClassName('md_f_au')[0];
  var mg = document.getElementsByClassName('md_f_mg')[0];
  var svd = document.getElementsByClassName('md_f_svd')[0];
  function plx(wh){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      document.getElementsByClassName('m_each_cat')[0].innerHTML = 'Loading...';
      if(xmlhttp.readyState = 4 && xmlhttp.status == 200){
        document.getElementsByClassName('m_each_cat')[0].innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('GET', '/students_connect/profile/lfs.php?'+wh)
    xmlhttp.send();
  }
  all.addEventListener('click', function(){
    var xmlhttp = new XMLHttpRequest();
    document.getElementsByClassName('m_each_cat')[0].innerHTML = 'Loading...';
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState = 4 && xmlhttp.status == 200){
        document.getElementsByClassName('m_each_cat')[0].innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('GET', '/students_connect/profile/lfs.php?all')
    xmlhttp.send();
  });
  pr.addEventListener('click', function(){
    plx('pr');
  });
  ph.addEventListener('click', function(){
    plx('ph');
  });
  vd.addEventListener('click', function(){
    plx('vd');
  });
  au.addEventListener('click', function(){
    plx('au');
  });
  mg.addEventListener('click', function(){
    plx('mg');
  });
  svd.addEventListener('click', function(){
    plx('svd');
  });
  f.onclick = nfile = function(event){
    if(u.style.display != 'none'){
      ww[0] = parseInt(event.pageY)-(27+40);
    }
    u.style.display = 'none';
    w.style.display = 'none';
    v.style.display = 'block';
    var xe = /*this.parentElement.children ||*/ document.getElementsByClassName('pm_o')[0].parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[1].classList.add('mractive');
    window.scrollTo(0, document.body.scrollHeight);
    window.history.pushState('', '', window.location.pathname+'?n');
  }
  e.onclick = function(){
    u.style.display = 'block';
    w.style.display = 'none';
    v.style.display = 'none';
    var xe = this.parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[0].classList.add('mractive');
    if(ww[0] != ''){
      window.scroll(0, ww[0]);
    }
    window.history.pushState('', '', window.location.pathname);
  }
  g.onclick = function(event){
    if(u.style.display != 'none'){
      ww[0] = parseInt(event.pageY)-(27+40);
    }
    u.style.display = 'none';
    w.style.display = 'block';
    v.style.display = 'none';
    var xe = this.parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[2].classList.add('mractive');
    /*var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      xmlhttp.onload = function(){
        w.innerHTML = xmlhttp.responseText;
                    for(var i = 0; i< document.scripts.length; i++ ){
                        if(document.scripts[i].src == '/students_connect/jsf/filescript.js'){
                            document.scripts[i].src = '/students_connect/jsf/filescript.js';
                        }
                    }
      }
    }
    xmlhttp.open('POST','/students_connect/profile/myimages.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send();*/
    window.history.pushState('', '', window.location.pathname+'?f');
  }
}
if(document.getElementsByClassName('plfpoll')[0]){
  var l = document.getElementsByClassName('plfpoll')[0];
  var me = document.getElementsByClassName('opt3')[0];
  var ma = document.getElementsByClassName('opt4')[0];
  l.onclick = function(){
    if(me.style.display == '' || me.style.display == 'none'){
      me.style.display = 'block';
    }
    else {
      ma.style.display = 'block';
      this.style.display = 'none';
    }
  }
  var de = document.getElementsByClassName('m_u_uu')[0];
  var da = document.getElementsByClassName('m_u_uu')[1];
  de.onclick = function(){
    me.style.display = 'none';
    ma.style.display = 'none';
    me.children[0].value = '';
    ma.children[0].value = '';
    me.children[0].parentElement.children[1].innerHTML = '0/20';
    ma.children[0].parentElement.children[1].innerHTML = '0/20';
    document.getElementsByClassName('plfpoll')[0].style.display = 'block';
  }
  da.onclick = function(){
    ma.style.display = 'none';
    ma.children[0].value = '';
    ma.children[0].parentElement.children[1].innerHTML = '0/20';
    document.getElementsByClassName('plfpoll')[0].style.display = 'block';
  }
  var ll = document.getElementById('tfpoll');
  var lq = document.getElementById('tspoll');
  var le = document.getElementById('ttpoll');
  var hu = document.getElementById('tfopoll');
  ll.onkeyup = function(){
    this.parentElement.children[1].innerHTML = this.value.length+"/20";
  }
  lq.onkeyup = function(){
    this.parentElement.children[1].innerHTML = this.value.length+"/20";
  }
  le.onkeyup = function(){
    this.parentElement.children[1].innerHTML = this.value.length+"/20";
  }
  hu.onkeyup = function(){
    this.parentElement.children[1].innerHTML = this.value.length+"/20";
  }
}
if(document.getElementById('th_d')){
  var e = document.getElementById('th_d');
var f = document.getElementById('th_h');
var g = document.getElementById('th_m');
var h = document.getElementById('th_p');
var p = document.getElementById('f_date');
e.onchange = function(){
  if(e.value != 'day'){
    p.value = p.value + ' ' +this.value+' ';
  }
}
f.onchange = function(){
  if(f.value != 'hour'){
    p.value = p.value + this.value + ':';
  }
}
g.onchange = function(){
  if(g.value != 'min'){
    p.value = p.value +''+this.value;
  }
}
h.onchange = function(){
  if(h.value != 'period'){
    p.value = p.value +' '+this.value;
  }
}
}
if(document.getElementsByClassName('d_l_poll')[0]){
  var lx = document.getElementsByClassName('d_l_poll')[0];
  var mo = document.getElementsByClassName('opt1')[0];
  var mt = document.getElementsByClassName('opt2')[0];
  var me = document.getElementsByClassName('opt3')[0];
  var ma = document.getElementsByClassName('opt4')[0];
  var e = document.getElementById('th_d');
  var f = document.getElementById('th_h');
  var g = document.getElementById('th_m');
  var h = document.getElementById('th_p');
  lx.onclick = function(){
    me.children[0].value = '';
    ma.children[0].value = '';
    mo.children[0].value = '';
    mt.children[0].value = '';
    me.children[0].parentElement.children[1].innerHTML = '0/25';
    ma.children[0].parentElement.children[1].innerHTML = '0/25';
    mo.children[0].parentElement.children[1].innerHTML = '0/25';
    mt.children[0].parentElement.children[1].innerHTML = '0/25';
    e.value = 'day';
    f.value = 'hour';
    g.value = 'min';
    h.value = 'period';
    me.style.display = 'none';
    ma.style.display = 'none';
    document.getElementsByClassName('plfpoll')[0].style.display = 'block';
    this.parentElement.style.display = 'none';
  }
}
if(document.getElementsByClassName('f_fflwers')[0]){
  var fee = document.getElementsByClassName('f_fflwers')[0];
  var fle = document.getElementsByClassName('f_fflwing')[0];
  fee.onclick = function(){
      if(window.location.href.includes('profile.php')){ 
      var lo = document.createElement('A');
       lo.href = '/students_connect/friends?flwrs';
       lo.click();
      }
      else {
        admit();
      }
  }
  fle.onclick = function(){
    if(window.location.href.includes('profile.php')){ 
    var lo = document.createElement('A');
    lo.href = '/students_connect/friends';
    lo.click();
    }
    else {
      admit1();
    }
  }
}
function mal(){
  window.onclick = function(e){
    if(document.getElementsByClassName('cntfl')){
          var all = document.getElementsByClassName('cntfl');
          var mlarray = [];
          for(var i = 0; i < all.length; i++){
            mlarray.push(all[i]);
    }
  }
  if(document.getElementsByClassName('cntfl')){
    var all = document.getElementsByClassName('cntfl');
    var mlarray = [];
    for(var i = 0; i < all.length; i++){
      mlarray.push(all[i]);
  }
  }
  if(document.getElementsByClassName('xess')){
    var all = document.getElementsByClassName('xess');
    var cnarray = [];
    for(var i = 0; i < all.length; i++){
      cnarray.push(all[i]);
  }
  }
  if(document.getElementsByClassName('cnt')){
    var all = document.getElementsByClassName('cnt');
    var loarray = [];
    var cmarray = [];
    for(var i = 0; i < all.length; i++){
      if(all[i].className.includes('lkdcnt')){
      loarray.push(all[i]);
      }
      if(all[i].className.includes('cmnt')){
        cmarray.push(all[i]);
        }
  }
  }
  if(document.getElementsByClassName('posted')){
    var all = document.getElementsByClassName('posted');
    var parray = [];
    for(var i = 0; i < all.length; i++){
      if(all[i].parentElement.className == 'amps' && all[i].parentElement.id.includes('soc')){
        parray.push([all[i], 'soc']);
      }
      else if(all[i].parentElement.className == 'amps' && !all[i].parentElement.id.includes('soc') && !all[i].parentElement.id.includes('f')){
        parray.push([all[i], 'edu']);
      }
  }
  }
  $(document).ready(function(){
    function xload(wtl){
      $.ajax({
        async: true,
        type: 'POST',
        url: '/students_connect/posts/reactions.php',
        data: 'wtl='+wtl,
        crossDomain: true,
        success: function(r){
          r = JSON.parse(r);
          
        }
      })
    }
    function load(maya, tide, ty){
      var ul = '';
      if(maya.className.includes('cntfl')){
        var ul = '/students_connect/posts/updates.php?id='+tide
      }
      else if(maya.className.includes('xess')){
        var ul = '/students_connect/posts/updates.php?cid='+tide;
      }
      else if(maya.className.includes('lkdcnt')){
        var ul = '/students_connect/posts/reactions.php?&lid='+tide;
      }
      else if(maya.className.includes('cmnt')){
        var ul = '/students_connect/posts/reactions.php?cmtid='+tide;
      }
      else if(maya.className.includes('posted')){
        var ul = '/students_connect/posts/reactions.php?timid='+tide+'&ttype='+ty;
      }
      $.ajax({
        async: true,
        type: 'GET',
        url: ul,
        crossDomain: true,
        success: function(r){
          maya.innerHTML = r; 
        }
      })
    }
    for(var i = 0; i < mlarray.length; i++){
      target = e.target;
      if(e.target.className.includes('cntfl') || e.target.className.includes('fas') || e.target.className.includes('dwm')){
        target = document.getElementsByClassName('upv')[i]
      }
      if(target != document.getElementsByClassName('upv')[i]){
        var mxe = mlarray[i].id;
      var red = mxe.length;
      var tid = mxe.substring(4, red);
      load(mlarray[i], tid);
      }
    }
    for(var i = 0; i < cnarray.length; i++){
      var mxe = cnarray[i].id;
      var red = mxe.length;
      var tid = mxe.substring(4, red);
      load(cnarray[i], tid);
    }
    for(var i = 0; i < loarray.length; i++){
      var mxe = loarray[i].id;
      var red = mxe.length;
      var tid = mxe.substring(6, red);
      load(loarray[i], tid);
    }
    for(var i = 0; i < cmarray.length; i++){
      var mxe = cmarray[i].classList[2];
      var red = mxe.length;
      var tid = mxe.substring(4, red);
      load(cmarray[i], tid);
    }
    var fparray = [];
    for(var i = 0; i < parray.length; i++){
      var mxe = parray[i][0].id;
      var red = mxe.length;
      var tid = mxe.substring(6, red);
      //fparray.push([tid, parray[i][1]]);
      load(parray[i][0], tid, parray[i][1]);
    }
    //console.log(fparray)
    //xload(JSON.stringify(fparray), parray);
  })
  }
}
window.addEventListener('click', function(){
  mal();
})
window.addEventListener('pageshow', function(){
  mal();
})
window.addEventListener('scroll', function(){
  if(document.getElementsByClassName('std_yx')){
    var t = document.getElementsByClassName('std_yx');
    for(var i = 0; i < t.length; i++){
      if(t[i].style.display=='block'){
        t[i].style.display = 'none';
      }
    }
  }
})
if(document.getElementsByClassName('xia_o')){
  var xiao = document.getElementsByClassName('xia_o');
  for(var i = 0; i < xiao.length; i++){
    xiao[i].onclick = function(){
      // open file
      var oq = this.parentElement;
      ty = oq.children[0];
      if(!oq.innerHTML.includes('mox_d')){
        var mox = document.createElement('div');
      mox.className = 'mox_d';
      mox.style.borderTop = '1px solid #bebebe';
      mox.innerHTML = "<div class='sawwc'><div class='sawc'>Save (Caption)</div><div class='savon'>Save</div></div>";
      mox.children[0].children[0].addEventListener('click', function(){
        oq.style.display = 'none';
        var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.color = document.getElementsByClassName('dark-mode')[0].style.color;
        qx.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
        qx.innerHTML = "<div class='wlx' style='width: 90%; margin: auto; display: flex;'>"+
        "<div class='rexx' style='width: 85%;'><textarea "+
        "placeholder='Caption, 100 characters' style='background: "+qx.style.backgroundColor+"; color: "+qx.style.color+";"
        +" padding-top: 4px; resize: none; font-family: emoji; border: none;  width: 100%; height: 40px; border-radius: 10px;'></textarea></div>"+
        "<div class='savewc' style='margin: auto;'><i class='far fa-bookmark'></i></div>"+
        "<div class='savedel' style='margin: auto; color: red;'><i class='fas fa-trash'></i></div>"+
        "</div>";
        qx.children[0].children[1].addEventListener('click', function(){
          this.innerHTML = "<i class='fas fa-bookmark'></i>";
          var typ = ty.children[0].value;
          var idd = ty.children[1].value;
          var ca = qx.children[0].children[0].children[0].value;
          if(window.FormData){
            fl =  new FormData();
            }
            fl.append('type', typ)
            fl.append('id', idd);
            fl.append('cap', ca);
          $.ajax({
            url: '/students_connect/save/index.php',
            type:"POST",
            data:fl,
            processData: false,
            contentType: false,
            success: function(){
              qx.children[0].children[1].innerHTML = "<i class='fas fa-check' style='color: green'></i>";
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Saved.';
        qx.style.fontSize = '17px';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
          }
        })
        })
        qx.children[0].children[2].addEventListener('click', 
        function(){
          qx.style.display = 'none';
        })
        document.body.append(qx);
      })
      mox.children[0].children[1].addEventListener('click', function(){
        oq.style.display = 'none';
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
        var typ = ty.children[0].value;
          var idd = ty.children[1].value;
          var ca = '';
          if(window.FormData){
            fl =  new FormData();
            }
            fl.append('type', typ)
            fl.append('id', idd);
            fl.append('cap', ca);
          $.ajax({
            url: '/students_connect/save/index.php',
            type:"POST",
            data:fl,
            processData: false,
            contentType: false,
            success: function(){
        qx.innerHTML = 'Saved.';
        qx.style.fontSize = '17px';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
          }
        })
        document.body.append(qx);
        
      })
      this.parentElement.append(mox);
    }
      else {
        for(var i = 0; i < oq.children.length; i++){
          if(oq.children[i].className == 'mox_d' && oq.children[i].style.display == 'none'){
            oq.children[i].style.display = 'block';
          }
          else if(oq.children[i].className == 'mox_d' && oq.children[i].style.display != 'none'){
            oq.children[i].style.display = 'none';
          }
        }
      }
    }
  }
}
if(document.getElementsByClassName('blusr')){
  var fxlw = document.getElementsByClassName('cx_flw');
  for(var i = 0; i < fxlw.length; i++){
    fxlw[i].onclick = function(){

    }
  }
  var block = document.getElementsByClassName('blusr');
  for(var i = 0; i < block.length; i++){
    block[i].onclick = function(){
      var x = window.pageYOffset;
      var typ = this.parentElement.children[0].children[0].value;
      var idd = this.parentElement.children[0].children[1].value;
      document.body.style.position = 'fixed';
      if(window.FormData){
        fl =  new FormData();
        }
        fl.append('type', typ)
        fl.append('id', idd);
      $.ajax({
        url: '/students_connect/bl/',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(r){
          var tb = r;
          var xl = document.createElement('div');
          xl.className = 'blockp';
          xl.innerHTML = "<div class='b_proc' style='margin: auto; margin-top: 30px; width: fit-content; font-size: 13px; font-family: emoji'>"+
          "<div class='bl_hd' style='padding: 20px; width: fit-content; margin: auto; font-size: 15px;'><span class='bl_comp_hd'>Block <i class='fas fa-at'></i>"+tb+"</span></div>"+
          "<div class='by_blck'>"+
          "<div class='block_wrn'><span class='ab_blc'><i class='fas fa-at'></i>"+tb+" wouldn't be able to :-</span>"+
          "<ul><li>send you messages,</li><li>see your posts.</li></ul><span class=u_wont''>You wont see <i class='fas fa-at'></i>"+tb+" posts</span>"+
          "</div><div class='cont_block'><button class='fin_blck'>Block</button><button class='fin_can'>Cancel</button></div>"
          +"</div>"
          +"</div>";
          xl.style.position = 'fixed';
          xl.style.top = '50px';
          xl.style.height = '100%';
          xl.style.width = '100%';
          xl.style.zIndex = '50';
          xl.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
          xl.style.color = document.getElementsByClassName('dark-mode')[0].style.color;
          document.body.style.display = 'fixed';
          var tt = xl.children[0].children[1].children[1];
          tt.children[0].addEventListener('click', function(){
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
        qx.innerHTML = 'Blocking...';
        xl.append(qx);
            if(window.FormData){
              fl =  new FormData();
              }
              fl.append('to', tb)
            $.ajax({
              url: '/students_connect/bl/block.php',
              type:"POST",
              data:fl,
              processData: false,
              contentType: false,
              success: function(){
                console.log(document.url);
                qx.innerHTML = 'Successfully blocked user <i class="fas fa-at"></i>'+tb+
                "<a href='' style='text-decoration: underline;'> Reload Page</a>";
              qx.style.fontSize = '13px';                     
        }})
          })
          tt.children[1].addEventListener('click', function(){
            xl.style.display = 'none';
            console.log(x);
            document.body.style.position = 'relative';
            window.scroll(0, x);
          })
          document.body.append(xl)
        }})
    }
  }
}
if(document.getElementById('cmttextarea')){
  document.getElementById('cmttextarea').style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
  document.getElementById('cmttextarea').style.color = document.getElementsByClassName('dark-mode')[0].style.color;
}
if(document.getElementsByClassName('ikanimi')){
  var ik = document.getElementsByClassName('ikanimi');
  for(var i = 0; i < ik.length; i++){
  ik[i].style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
  ik[i].style.color = document.getElementsByClassName('dark-mode')[0].style.color;
}
}
var qclose = document.getElementsByClassName('qclose');
for(var i = 0; i < qclose.length; i++){
  qclose[i].addEventListener('click', function(){
    this.parentElement.parentElement.style.display = 'none';
  })
}
if(document.getElementsByClassName('rnotint_b')[0]){
  var twe = document.getElementsByClassName('rnotint_b');
  for(var i = 0; i < twe.length; i++){
    twe[i].onclick = function(){
      var qo = this.value;
      var t = this;
      var xo = qo.split(',')
      if(t.innerHTML == 'Not Interested'){
        var mpq = 'd';  
      }
      else {
        var mpq = 'r';
      }
      $.ajax({
        url:'/students_connect/posts/recommend.php?'+mpq+'='+xo[0]+'&t='+xo[1],
        method:'GET',
        success:function(data){
          if(t.innerHTML == 'Not Interested'){
          t.innerHTML = 'Recommend';      
        }
          else {
            t.innerHTML = 'Not Interested'; 
          }
        }
      })  
  }
  }
}
if(document.getElementsByClassName('tagbut')[0]){
  var tee = document.getElementsByClassName('tagbut');
  for(var i = 0; i < tee.length; i++){
    tee[i].onclick = function(){
    var l = this;
      $.ajax({
        url:'/students_connect/profile/pr.php?x='+l.value,
        method:'GET',
        success:function(){
          l.style.backgroundColor = 'rgb(65, 191, 241)';
          l.style.color = 'white';
        },
        error:function(){
          l.style.backgroundColor =  'red';
          l.style.color = 'white';
        }
      })
    }
  }
}
 /* if(document.getElementsByTagName('textarea')[0]){
  var tarea = document.getElementsByTagName('textarea');
  for(var i = 0; i < tarea.length; i++){
    tarea[i].onkeypress = function(e){
      if(e.key == '@' || e.key == '#'){
        document.getElementsByClassName('key_guess').style.display = 'block';
        $.ajax({
          url:'/students_connect/posts/kg.php',
          type:'post',
          data:'d='
        })
      }
    }
  }
}
*/
}
else {
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
   if(y.includes('postuploads')){
     if(document.getElementsByClassName('finsihes_img')[0]){
      var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
    if(crack.className.includes('undbtn') == false){
      crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
    }
      document.getElementsByClassName('finsihes_img')[0].innerHTML = crack.innerHTML;
   }
   else {
    var tto = document.createElement('div');
    tto.className = 'finsihes_img';
    tto.classList.add("undbtn");
    var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
    if(crack.className.includes('undbtn') == false){
      crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
    }
    tto.innerHTML = crack.innerHTML;
    document.getElementsByClassName('timgbsys')[0].append(tto);
   }
  }
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
 if(y.includes("postuploads")){
   var tto = document.createElement('div');
   tto.className = 'finsihes_img';
   tto.classList.add("undbtn");
   var crack = this.parentElement.parentElement.parentElement.parentElement.children[8];
   if(crack.className.includes('undbtn') == false){
     crack = this.parentElement.parentElement.parentElement.parentElement.children[9];
   }
   tto.innerHTML = crack.innerHTML;
   document.getElementsByClassName('timgbsys')[0].append(tto); 
}
   document.getElementsByClassName('timgbsys')[0].style.display = 'block'; 
 };
};
 };
 var mod = document.getElementsByClassName('timgbsys')[0]; 
 window.onclick = function(event) { 
   if (event.target == mod) { 
     document.getElementsByClassName('timgbsys')[0].style.display = 'none';
     if(document.getElementsByClassName('finsihes_img')[0]){
      document.getElementsByClassName('finsihes_img')[0].remove(); 
     }
    } 
 }; 
 if(document.getElementById('clview')){
 var cl = document.getElementById('clview'); 
 cl.onclick = function(){ 
   document.getElementsByClassName('timgbsys')[0].style.display = 'none'; 
   if(document.getElementsByClassName('finsihes_img')[0]){
   document.getElementsByClassName('finsihes_img')[0].remove(); 
  }
}
  }

  } 
  if(document.getElementsByClassName('cbr')[0]){
    var ex = document.getElementsByClassName('cbr')[0];
  ex.onclick = function(){
    document.body.style.position = 'fixed';
    document.getElementById('lpopx').innerHTML = theMessage('follow <i class="fas fa-at"></i>'+this.children[0].value, ""+this.children[1].value+"", 1);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.getElementById('loginpop').style.display = 'none';
      document.body.style.position = 'relative';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.getElementById('loginpop').style.display = 'none';
      document.body.style.position = 'relative';
    }
  }
}  
function theMessage(message, imageurl, add, id){
  if(add != ''){
    action = "<input type='hidden' name='action' value='"+add+"'>";
    if(add == 6){
      var utm = '/students_connect/posts/s'+id;
    }
    else {
      var utm = window.location.href;
    }
  }
  else {
    action = '';
    utm = '';
  }
  if(imageurl !== ""){
    var ex = "<div class='thelogmod'><span class='cl_o_sd'>x</span>"+
    "<div class='th_u_mgi' style='background-image: url(\""+imageurl+"\")'>"+
    "</div>"+
    "<div class='thtypofst'><div class='T_f_mes_gd'>Login to "+message+"</div></div>"+
    "<form action='/students_connect/login.php' method='POST' autocomplete='off'>"+
    "<div class='tcomplginf'><div class='prtfun_nm eds_s_y'>"+action+
    "<input type='text' name='user' class='lpopinp bluste' placeholder='Username'>"+
    "</div><div class='tp_o_nee eds_s_y'><input type='password' placeholder='Password' name='pass' class='lpopinp bluste'></div>"+
    "<input type='hidden' name='utm' value='"+utm+"'/><div class='t_sm_ne_o'><button class='sn_tj_me bluste' type='submit'>Login</div>"+
    "<div class='t_sm_ne_o'><button class='sn_tj_me_x bluste' type='button' onclick='cancel()'>Cancel</div></div></form>"+
    "<div class='fni_par_t'>Create an account today,<a href='/students_connect/signup.php'>Sign Up</a></div></div>";
}
else {
  var ex = "<div class='thelogmod'><span class='cl_o_sd'>x</span>"+
    "<div class='th_u_mgi'>"+
    "</div>"+
    "<div class='thtypofst'><div class='T_f_mes_gd'>Login to "+message+"</div></div>"+
    "<form action='/students_connect/login.php' method='POST' autocomplete='off'>"+
    "<div class='tcomplginf'><div class='prtfun_nm eds_s_y'>"+action+
    "<input type='text' name='user' class='lpopinp bluste' placeholder='Username'>"+
    "</div><div class='tp_o_nee eds_s_y'><input type='password' placeholder='Password' name='pass' class='lpopinp bluste'></div>"+
    "<input type='hidden' name='utm' value='"+utm+"'/><div class='t_sm_ne_o'><button class='sn_tj_me bluste' type='submit'>Login</div>"+
    "<div class='t_sm_ne_o'><button class='sn_tj_me_x bluste' type='button' onclick='cancel()'>Cancel</div></div>"+
    "</form><div class='fni_par_t'>Create an account today,<a href='/students_connect/signup.php'>Sign Up</a></div></div>";
}
return ex;
}
document.getElementsByClassName('edxd')[0].onsubmit = function(event){
  event.preventDefault()
  document.body.style.position = 'fixed';
  document.getElementById('lpopx').innerHTML = theMessage('message <i class="fas fa-at"></i>'+this.children[0].value, ""+this.children[1].value+"", 2);
  document.getElementById('loginpop').style.display = 'block';
  var te = document.getElementsByClassName('sn_tj_me_x')[0]
  te.onclick = function(){
    document.getElementById('loginpop').style.display = 'none';
    document.body.style.position = 'relative';
  }
  var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.getElementById('loginpop').style.display = 'none';
      document.body.style.position = 'relative';
    }
}
var pex  = document.getElementsByClassName('xt_2')[0];
pex.onclick = function(){
  document.body.style.position = 'fixed';
  document.getElementById('lpopx').innerHTML = theMessage('view <i class="fas fa-at"></i>'+this.children[0].value+' profile', ""+this.children[1].value+"", 3);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.getElementById('loginpop').style.display = 'none';
      document.body.style.position = 'relative';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.getElementById('loginpop').style.display = 'none';
      document.body.style.position = 'relative';
    }
}
var lex  = document.getElementsByClassName('xt_3')[0];
lex.onclick = function(){
  document.body.style.position = 'fixed';
  document.getElementById('lpopx').innerHTML = theMessage('view <i class="fas fa-at"></i>'+this.children[0].value+' followers', ""+this.children[1].value+"", 4);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
}
var yex  = document.getElementsByClassName('xt_4')[0];
yex.onclick = function(){
  document.body.style.position = 'fixed';
  document.getElementById('lpopx').innerHTML = theMessage('view who <i class="fas fa-at"></i>'+this.children[0].value+' is following', ""+this.children[1].value+"", 5);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
}
var milk = document.getElementsByClassName('lkd');
for(var i = 0; i < milk.length; i++){
  milk[i].onclick = function(){
    document.body.style.position = 'fixed';
    var pooid = this.children[0].id.substr(4);
    document.getElementById('lpopx').innerHTML = theMessage('love this post', '', 6, pooid);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
  }
}
var milk = document.getElementsByClassName('cmt');
for(var i = 0; i < milk.length; i++){
  milk[i].onclick = function(){
    document.body.style.position = 'fixed';
    var pooid = this.children[0].value;
    document.getElementById('lpopx').innerHTML = theMessage('view comments', '', 7, [pooid, ]);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
  }
}
window.onclick = function(event){ 
  var xe = document.getElementsByClassName('lkd');
  for(var i = 0; i<xe.length; i++){
  if(event.target == xe[i]){
    
  }
}
}

}

/* if('serviceWorker' in navigator){
    navigator.serviceWorker.register('/students_connect/jsf/filescript.js').then(function(registration){
        console.log("Reg Successful", registration.scope);
    })
    .catch(function(error){
        console.log('Servce worker registration failed', error);
    });}
    */
if(window.innerWidth > 799){
  if(document.getElementsByClassName('ma_li_mp')[0]){
  document.body.onload = function(){
    document.getElementsByClassName('ma_li_mp')[0].style.color = document.getElementsByClassName('dark-mode')[0].style.color
  }
  window.onscroll = function(){
  var te = document.getElementsByClassName('ma_li_mp')[0];
  if((window.pageYOffset > (te.offsetTop + 30)) && te){
    document.getElementsByClassName('ma_li_mp')[0].style.color = document.getElementsByClassName('dark-mode')[0].style.color
    var l = te.children;
    for(var i = 0; i < l.length; i++){
      var me = l[i];
      me.style.cssText = 'display: block; width: fit-content; margin: auto; padding-top: 30px';
      me.children[1].style.display = 'none';
      if(document.getElementsByClassName('mractive')[0]){
      var tf = document.getElementsByClassName('mractive')[0];
      tf.className = tf.className.replace('mractive', 'noactive');
      }
    }
    te.style.cssText = 'top: 40px; position: fixed; left:0;height: 100%; width: 10%; box-shadow: rgb(15 15 15 / 70%) -1px 2px 2px 2px; background-color: '+document.getElementsByClassName('dark-mode')[0].style.backgroundColor+';';
  }
  else {
    document.getElementsByClassName('ma_li_mp')[0].style.color = document.getElementsByClassName('dark-mode')[0].style.color
    var l = te.children;
    for(var i = 0; i < l.length; i++){
      var me = l[i];
      me.style.cssText = 'display: inline-block; width: 30%; margin: 4px; padding: 5px';
      me.children[1].style.display = 'inline-block';
      if(document.getElementsByClassName('noactive')[0]){
        var tf = document.getElementsByClassName('noactive')[0];
        tf.className = tf.className.replace('noactive', 'mractive');
        }
    }
    te.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor
    te.style.color = document.getElementsByClassName('dark-mode')[0].style.color
    te.style.cssText = 'top: 40px; position: sticky; left: unset; height: 40px; width: 90%; box-shadow: none; background-color: '+document.getElementsByClassName('dark-mode')[0].style.backgroundColor+';';
  }
}
}
window.onload = function(){
  var te = document.getElementsByClassName('ma_li_mp')[0];
  if(window.pageYOffset > (te.offsetTop-35)){
    var l = te.children;
    for(var i = 0; i < l.length; i++){
      var me = l[i];
      me.style.cssText = 'display: block; width: fit-content; margin: auto; padding-top: 30px';
      me.children[1].style.display = 'none';
      var tf = document.getElementsByClassName('mractive')[0];
      tf.sel
    }
    te.style.cssText = 'top: 40px; position: fixed; left:0;height: 100%; width: 54px;';
  }
  else {
    var l = te.children;
    for(var i = 0; i < l.length; i++){
      var me = l[i];
      me.style.cssText = 'display: inline-block; width: 30%; margin: 4px; padding: 5px';
      me.children[1].style.display = 'inline-block';
    }
    te.style.cssText = 'top: 40px; position: sticky; left: unset; height: 40px; width: 70%';
  }
}
}
window.onload= function(){
if(!getCookie('tuname')){
  if(sessionStorage.in != 1){
  document.body.style.position = 'fixed';
  document.getElementById('lpopx').innerHTML = theMessage('Welf', '', 10);
    document.getElementById('loginpop').style.display = 'block';
    var te = document.getElementsByClassName('sn_tj_me_x')[0]
    te.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
    }
    var et = document.getElementsByClassName('cl_o_sd')[0]
    et.onclick = function(){
      document.body.style.position = 'relative';
      document.getElementById('loginpop').style.display = 'none';
      var mdate = new Date();
      var exp = parseInt(mdate.toUTCString().substr(5, 2))+5;
    }
    sessionStorage.in = 1;
  }
}  
/*
var ere = document.getElementsByTagName('A');
var mot = []
for(var i = 0; i < ere.length; i++){
  var tx = ere[i].href;
  if(ere[i].parentElement.className.includes('mpst') && tx.includes('/search/?hashtag') == false){
      mot.push(ere[i])
  }
}
$(document).ready(function(){
  function n(rl, lm){
    $.ajax({
      async: true,
      type: 'POST',
      url: rl,
      crossDomain: true,
      success: function(r){
        var qox = ere[i].parentElement;
        var titlef = r.search('<title>');
            var titlel = r.search('</title>');
            var title = r.slice(titlef+7, titlel)
            var rr = document.createElement('div');
            rr.innerHTML = rl+"<br/><br/>"+title;
            rr.className = 'ooppl';
            lm.parentElement.append(rr)  
          }
    })
  }
  mor = Array.from(new Set(mot))
    for(var i = 0; i < mor.length; i++){
      l = mor[i].href;
      n(l, mor[i])
    }
})
*/

if(document.getElementsByClassName('mpst')[0]){
 function exe(tt, eem){
  var sint = setInterval(function(){
    var tty = new Date();
    var o = parseInt(tt.getTime()/1000);
    var x = parseInt(tty.getTime()/1000);
    var co = o-x;
    var hr = parseInt(co/3600);
    var sc = parseInt(co%60);
    var mn = parseInt((co/60) - (hr*60));
    var dy = 0;
    if(hr>=24){
      var dy = parseInt(hr/24);
      var hr = parseInt(hr%24);
    }
    if(sc <= 0 && hr <= 0 && dy <= 0 && mn <= 0){
      clearInterval(sint);
      var fs = '00';
      var fh = '00';
      var fm = '00';
      var fd = '00';
      setInterval(function(){
        if(eem.children[0].children[0].style.opacity == '0'){
          eem.children[0].children[0].style.opacity = '1';
          eem.children[1].children[0].style.opacity = '1';
          eem.children[2].children[0].style.opacity = '1';
          eem.children[3].children[0].style.opacity = '1';      
        }else{
          eem.children[0].children[0].style.opacity = '0';
          eem.children[1].children[0].style.opacity = '0';
          eem.children[2].children[0].style.opacity = '0';
          eem.children[3].children[0].style.opacity = '0';      
        }
      }, 1000)
    }
    else {
    var fs = sc > 9 ? sc: '0'+sc;
    var fh = hr > 9 ? hr : '0'+hr;
    var fm = mn > 9 ? mn : '0'+mn;
    var fd = dy > 9 ? dy : '0'+dy;
    }
    eem.children[0].children[0].innerHTML = fd;
    eem.children[1].children[0].innerHTML = fh;
    eem.children[2].children[0].innerHTML = fm;
    eem.children[3].children[0].innerHTML = fs;
  }, 1000);
}
  var dd = document.getElementsByClassName('mpst');
  for(var t=0; t<dd.length;t++){
    var spoq = dd[t].innerHTML.split(" ");
    for(var i = 0; i < spoq.length; i++){
        if(spoq[i].includes("['countdown']:[")){
          var cd = spoq[i].substring(17, spoq[i].length-3); //format - ['countdown']:['2022-October-10-5:23:00]'] || ['countdown']:['2022-10-10-5:23:00]']
          var ncd = cd.replace(/-/g, " ");
          var dy, hr, mn, se
          var ttx = {
            months : {
             'Jan': 31, 'Feb': 28, 'Mar': 31, 'Apr':30, 'May': 31, 'Jun':30, 'Jul':31, 'Aug':31,'Sep':30,'Oct':31,
             'Nov':30, 'Dec':31
            }
          }
          var tt = new Date(ncd);
          var csf = dd[t].innerHTML.indexOf("['countdown']:[");
          var cea = dd[t].innerHTML.indexOf("]']");
          var eem = document.createElement('div');
          eem.className = 'cd_eem';
          eem.innerHTML = "<div class='cd_eem_dy cddye'><div class='cd_by_am'></div><div class='cd_ttag'>Days</div></div><div class='cd_eem_hr cddye'>"+
          "<div class='cd_by_am'></div><div class='cd_ttag'>Hours</div></div>"+
          "<div class='cd_eem_mn cddye'><div class='cd_by_am'></div><div class='cd_ttag'>Minutes</div></div>"+
          "<div class='cd_eem_sc cddye'><div class='cd_by_am'></div><div class='cd_ttag'>Seconds</div></div>";
          dd[t].innerHTML = dd[t].innerHTML.replace(dd[t].innerHTML.substr(csf-1,cea+3), '');
          exe(tt, eem)
          dd[t].append(eem);
 
          
          /*var om = tty.getMonth().toString().split(" ")[1];
          var mm = ttx.months[om];
          var lmm = tt.getFullYear() - tty.getFullYear();
          if(lmm == 0){
            
          }
          else {

          }
          if(om != tt.getMonth().toString().split(" ")[1]){
            dy = mm - tty.getDate() + tt.getDate();
          }
          else {
            dy = tt.getDate() - tty.getDate();
          }
          hr = tt.getHours();
          mn = tt.getMinutes();
          se = tt.getSeconds();
          setInterval(function(){
            if(hr=='0' && se=='0' && mn=='0'){
              hr = 23;
              mn = 60;
              se = 00;
            }
            if(se == '00' || se=='0'){
              mn--;
              se = 60;
            }
            se--;
            if(mn == '00' || mn=='0'){
              mn = 60;
              hr--;
            }
            if(hr == '00' || hr=='0'){
              hr = 23;
              dy--;
            }
            //console.clear();
            dd[0].innerHTML = dy+' days :'+hr+' hours :'+mn+' minutes :'+se+' seconds';
          },
          1000)
          var ndv = document.createElement('div');
          ndv.className = 'p_countd';
          */
          break;
        }
    }
  }
}

if(document.getElementsByClassName('std_yx')){
  if(document.getElementsByClassName('cotx')){
    var cotx = document.getElementsByClassName('cotx');
    for(var i = 0; i < cotx.length; i++){
     // if(document.getElementsByClassName('cxeet_ml')[i] == false){
      var cmtt = document.createElement('SPAN');
      cmtt.className = 'cxeet_ml';
      cmtt.innerHTML = 'Comment';
      cotx[i].append(cmtt);
      var psh = document.createElement('div');
      psh.innerHTML = "<input type='hidden' value='"+cotx[i].children[0].value+"'/><input type='hidden' value='"+cotx[i].children[1].value+"'/><i class='fas fa-link'></i>";
      var tee = document.createElement('span');
      tee.innerHTML = 'Copy Link';
      psh.append(tee);var otq = cotx[i].parentElement.children[1];
      cotx[i].parentElement.insertBefore(psh, otq)
      psh.addEventListener('click', function(){
        var val = document.createElement('input');
        if(this.children[0].value == '1'){
          val.value = window.location.host+'/students_connect/posts/s'+this.children[1].value;
        }
        else {
          val.value = window.location.host+'/students_connect/posts/'+this.children[1].value;
        }
        val.style.width = '1px';
        val.style.opacity = '0'
        this.append(val);
        val.select();
        val.setSelectionRange(0, 99999);
        document.execCommand("copy");
        this.removeChild(val)
        this.children[3].innerHTML = 'Copied';
        var maxx = this;
        setTimeout(function(){
          maxx.children[3].innerHTML = 'Copy Link';
        });
      }, 2000)
    //}
   }
  }
  if(document.getElementsByClassName('tr_ash')){
    var trash = document.getElementsByClassName('tr_ash');
    for(var i = 0; i < trash.length; i++){
    //  if(document.getElementsByClassName('cxeet_trh')[i] == false){
      var trh = document.createElement('SPAN');
      trh.className = 'cxeet_trh';
      trh.innerHTML = 'Delete';
      trh.style.color = 'red';
      trash[i].append(trh);
      var cxia = document.createElement('div');
      cxia.innerHTML = "<input type='hidden' value='"+trash[i].children[0].value+"'/><input type='hidden' value='"+trash[i].children[2].value+"'/><i class='fas fa-cog'></i>";
      var xia = document.createElement('SPAN');
      xia.innerHTML = 'Manage';
      cxia.append(xia);
      trash[i].parentElement.insertBefore(cxia, trash[i]);
      cxia.addEventListener('click', function(){
        var mt = document.createElement('a');
        mt.href = '/students_connect/posts/manage?id='+this.children[0].value+'&t='+this.children[1].value+'&r='+window.location.href;
        mt.target = '_blank';
        mt.click();
      })
      ;
   // }
   }
  }
  if(document.getElementsByClassName('yxclose')){
    var mee = document.getElementsByClassName('yxclose');
    for(var i = 0; i < mee.length; i++){
      //if(document.getElementsByClassName('cxeet_mll')[i] == false){
      mee[i].innerHTML = "<i class='fas fa-times cxeet_mll'></i><span>Close</span>";
    //}
   }
  }
  if(document.getElementsByClassName('xia_o')){
    var xia = document.getElementsByClassName('xia_o');
    for(var i = 0; i < xia.length; i++){
      //if(document.getElementsByClassName('cxeet_grtt')[i] == false){
      var x = document.createElement('SPAN');
      x.innerHTML = 'Save';
      x.className = 'cxeet_grtt';
      xia[i].append(x);
    //}
   }
  }
  if(document.getElementsByClassName('blusr')){
    var xia = document.getElementsByClassName('blusr');
    for(var i = 0; i < xia.length; i++){
      var fusr = document.createElement('div');
      fusr.setAttribute('class', 'tb_y');
      fusr.setAttribute('class', 'cx_flw');
      fusr.innerHTML = "<i class='fas fa-user'></i><span class=''>Follow</span>";
      xia[i].parentElement.insertBefore(fusr, xia[i].parentElement.children[2]);
      //if(document.getElementsByClassName('cxeet_mlo')[i] == false){
      xia[i].style.color = 'red';
      xia[i].classList.add('cxeet_mlo');
      xia[i].innerHTML = "<i class='fas fa-minus-circle'></i><span>Block User</span>";
    //}
  }
 }
  if(document.getElementsByClassName('repop')){
    var xia = document.getElementsByClassName('repop');
    for(var i = 0; i < xia.length; i++){
   //   if(!document.getElementsByClassName('cxeet_mlg')[i]){
      xia[i].classList.add('cxeet_mlg');
      xia[i].innerHTML = "<i class='fas fa-exclamation-circle'></i><span>Report Post</span>";
   // }
   }
  }
}

if(document.getElementsByClassName('dark-mode')[0]){
  document.getElementsByClassName('dark-mode')[0].style.minHeight = window.innerHeight+'px';
}
  if(document.getElementsByClassName('in_notification')[0]){
  var td = new Date();
  var ctd = td.getTime();
  var lt = parseInt(ctd/1000);    
  setInterval(function(){
    var fl =false;
      if(window.FormData){
      fl =  new FormData();
      }
      var td = new Date();
      var ctd = td.getTime();
      var rr = parseInt(ctd/1000);
      fl.append('oltm', rr);
      fl.append('lt', lt);
      $.ajax({
        url: '/students_connect/eupdate.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(d){
          lt = rr;
          if(d == ''){            
            document.getElementsByClassName('in_notification')[0].style.display = 'none';
          }
          else {
            $('.in_notification').html(d);
            var io = d.indexOf('</i>');
            var st = d.indexOf('sent:');
            var snnd = d.substr(io+4, st-io-5);
            mgg = 'New Message'
            var nm = newMessage({sender: snnd, m: mgg})
            console.log(nm);
            if(nm == false){
            document.getElementsByClassName('in_notification')[0].style.display = 'block';
            document.getElementsByClassName('in_notification')[0].classList.remove('in__eee');
            document.getElementsByClassName('in_notification')[0].classList.add('in__eee');
          }
        }
        }
      });
  }, 5000);
}
  if(document.getElementsByTagName('VIDEO')){
  var te = document.getElementsByTagName('VIDEO');
  for(var i = 0; i < te.length; i++){
    te[i].classList.add('a_jined');
    te[i].addEventListener('contextmenu', function(e){
      e.preventDefault();
      e.stopPropagation();
    }, false)
    /*var canv = document.createElement('canvas');
    canv.width = te[i].videoWidth;
    canv.height = te[i].videoHeight;
    canv.getContext('2d').drawImage(te[i], 0, 0, canv.width, canv.height);
      te[i].poster = '/students_connect_hidden/postuploads/s/121(1).png' //canv.toDataURL('image/png');
    var a = document.createElement('img');
    a.style.height = '200px'; a.style.width = '200px'
    a.src = canv.toDataURL('image/png');
    document.body.insertBefore(a, document.body.childNodes[0]);
      */
    if(te[i].controls){
      te[i].controls = false; 
    }
      var me = te[i].parentElement;
    var lx = document.createElement('i');
    lx.className = 'fas fa-play p_vide';
    if(window.innerWidth > 799){
    lx.style.cssText = 'display: block; opacity: 1; z-index: 2;'+
    'width: fit-content; margin: auto; bottom: 74px; position: relative; color: white; font-size: 20px;';
    }
    else {
      lx.style.cssText = 'display: block; opacity: 1; z-index: 2;'+
    'width: fit-content; margin: auto; bottom: 80px; position: relative; color: inherit; font-size: 18px;';
    }
    var tmio = document.createElement('span');
    tmio.style.cssText = 'display: block; x-index: 2; position: relative; left: 5%; bottom: 29px; font-size: 13px; color: white';
    var mo = parseInt(te[i].duration);
    var toxx = mo%60 < 10 ? '0'+mo%60 : mo%60;
    var loqx = parseInt(mo/60);
    if(isNaN(loqx) || isNaN(toxx)){
      tmio.innerHTML = '00:00';
    }
    else {
      tmio.innerHTML = loqx+':'+toxx;
    }
    me.append(lx);
    me.append(tmio);
    var mover = document.createElement('div');
    mover.className = 'seek_line';
    mover.innerHTML = "<div class='tow_th_poiter'><div class='progressline' style='background-color: white;'><div class='smallcircleinside' draggable style='bottom: -2.5px; background-color: white;'></div></div></div>";
    mover.style.cssText = 'position: relative; display: none; left: 13%; bottom: 30px; width: 70%;';
    mover.children[0].onclick = function(e){
      var moxe, gtto, cctt, oxaq, swwi
      oxaq = parseInt(this.offsetWidth);
      moxe = parseInt(e.offsetX);
      if(moxe < 0){
        moxe = 0;
      }
      swii = (moxe/oxaq)*100+'%';
      this.children[0].style.width = swii;
      cctt = this.parentElement.parentElement.children[0].duration;
      gtto = (moxe/oxaq)*parseInt(cctt)
      this.parentElement.parentElement.children[0].currentTime = gtto;
    }
    me.append(mover);
    var expand = document.createElement('div');
    expand.className = 'v_expand';
    expand.addEventListener('click',function(){
      this.parentElement.children[0].webkitEnterFullScreen();
    })
    expand.style.cssText = 'position: relative; display: none; left: 90%; color: white; bottom: 39px; width: fit-content';
    expand.innerHTML = '<i class="fas fa-expand"></i>';
    me.append(expand);
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
  /*te[i].onmouseover = function(){
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
  }*/
  te[i].onclick = function(){
    var op = this.parentElement.children[1];
    if(this.paused == false){
      op.style.opacity = '1';
     setTimeout(function(){
      
      op.style.opacity = '0';
      
    }, 3000)
    }
    else {
      op.style.opacity = '1';
    }
  };
  te[i].onpause = function(){
    var op = this.parentElement.children[1];
    op.className = op.className.replace('pause', 'play');
    op.style.opacity = '1'
  }
  te[i].onplay = function(){
    var op = this.parentElement.children[1];
    op.className = op.className.replace('play', 'pause');
    var los = this;
    op.style.opacity = '0';
    var ppp = setInterval(function(){
      var oto  = los.currentTime;
      los.parentElement.children[3].style.display = 'block'
      los.parentElement.children[4].style.display = 'block'
      var too = los.duration;
      var ok = (oto/too)*100;
      los.parentElement.children[3].children[0].children[0].style.width = ok+'%';
      var mo = parseInt(los.currentTime);
      var toxx = mo%60 < 10 ? '0'+mo%60 : mo%60;
      los.parentElement.children[2].innerHTML = parseInt(mo/60)+':'+toxx;
      if(los.currentTime == los.duration){
        clearInterval(ppp);
        op.className = op.className.replace('pause', 'play');
      }
    }, 1000);
  }
  te[i].playsInline = true;
  }
}
if(document.getElementsByClassName('postimages')[0]){
  var pimg = document.getElementsByClassName('postimages');
  for(var i =0; i< pimg.length; i++){
    if(pimg[i].parentElement.children.length == 2){
      var par =  pimg[i].parentElement;
      par.children[0].children[1].style.width = '50%';
      par.children[1].children[1].style.width = '50%';
      par.children[1].children[1].style.left = '50%';
    }
  }
}
}
if(document.getElementsByClassName('readmore')[0]){
  var read = document.getElementsByClassName('readmore');
  for(var i = 0; i < read.length; i++){
    read[i].onclick = function(){
      var ee = this.children[0].value;
      var eid = this.children[1].value;
      this.innerHTML = '';
      var th = this;
      this.id = 'rmmre';
      var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(ee == 0){
            document.getElementById('mpst'+eid).innerHTML = xmlhttp.responseText;
          }
          else {
            document.getElementById('mpsts'+eid).innerHTML = xmlhttp.responseText;
          }
        };
        if(xmlhttp.status == 0){
          th.id = 'readmr';
          th.innerHTML = '<input type="hidden" value="'+ee+'"> <input type="hidden" value="'+eid+'">' +
          'Read More <i class="fas fa-angle-double-down"></i>';
        }
    }
      xmlhttp.open('POST', '/students_connect/posts/reactions.php');
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("readmore="+eid+"&type="+ee);
    }
  }
}
if(document.getElementsByClassName('s_bt1can')){
  var s_bt1can = document.getElementsByClassName('s_bt1can');
  for(var i=0; i <  s_bt1can.length; i++){
    s_bt1can[i].onclick = function(){
    this.parentElement.parentElement.parentElement.style.display = 'none';
    }
  }
}
if(document.getElementsByClassName('h_f_taag')[0]){
  var telll = document.getElementsByClassName('h_f_taag');
  for(var i =0; i < telll.length; i++){
    telll[i].onclick = function(){
      var ptff = this.children[0].value;
      var meee = this;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function(){
        xmlhttp.onload = function(){
          meee.innerHTML = "<input type='hidden' value='"+ptff+"'>"+xmlhttp.responseText;
        }
        xmlhttp.onerror = function(){
          meee.innerHTML = "<input type='hidden' value='"+ptff+"'><i class='fas fa-rss'></i>Follow";
        }
      }
      xmlhttp.open("POST", "/students_connect/h/c/index.php");
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("u="+ptff);
    }
  }
}
/*if(window.innerWidth < 799){
  if(document.getElementsByClassName('view-posts')[0]){
    var cuu = document.getElementsByClassName('view-posts')[0];
    timing = [];
    var place = [];
    cuu.onmouseover = function(e){
      var ttt = parseInt(new Date().getTime()/1000);
      timing.push(ttt);
      place.push(e.clientX);
    }
    cuu.onmouseout = function(e){
      var vt = parseInt(new Date().getTime()/1000);
      if(parseInt(timing[0])+2000 > vt){
        if((place[0] > e.clientX) && (parseInt(place[0]) - e.clientX) > 200){
          console.log(place[0], e.clientX)
          var e = document.getElementsByClassName('pm_l')[0];
        var f = document.getElementsByClassName('pm_o')[0];
        var g = document.getElementsByClassName('pm_e')[0];
        var u = document.getElementsByClassName('view-posts')[0];
        var v = document.getElementsByClassName('postarea')[0];
        var w = document.getElementsByClassName('mi_e_lan')[0];
          u.style.display = 'none';
          w.style.display = 'none';
          v.style.display = 'block';
          var xe = document.getElementsByClassName('ma_li_mp')[0].children;
          for(var i = 0; i< xe.length; i++){
            xe[i].className = xe[i].className.replace('mractive', '');
          }
          xe[1].classList.add('mractive')
        timing.pop();
        place.pop();
        }
        else {
          timing.pop();
          place.pop();
        }
      }
      else {
        timing.pop();
        place.pop();
      }
    }
    /* start = [];
    time = [];
    var cuu = document.getElementsByClassName('view-posts')[0];
    cuu.onmousemove = function(e){
      var x = e.clientX;
      var y = e.clientY;
      var ttt = parseInt(new Date().getTime()/1000);
      if(start[0]){
      //pass
      }
      else {
        start.push(x);
        time.push(ttt);
      }
      var end = e.clientX;
      if(start[1]){
        start[1] = end;
        time[1] = parseInt(new Date().getTime()/1000);
      }
      else{
        start.push(end);
        time.push(parseInt(new Date().getTime()/1000));
      }
      if(time[0]+2000 < time[1]){
        start.pop();
        start.pop()
        time.pop();
        time.pop();
      }
      else {
      if(start[0] - 200 > start[1]){
        var e = document.getElementsByClassName('pm_l')[0];
        var f = document.getElementsByClassName('pm_o')[0];
        var g = document.getElementsByClassName('pm_e')[0];
        var u = document.getElementsByClassName('view-posts')[0];
        var v = document.getElementsByClassName('postarea')[0];
        var w = document.getElementsByClassName('mi_e_lan')[0];
          u.style.display = 'none';
          w.style.display = 'none';
          v.style.display = 'block';
          var xe = this.parentElement.children;
          for(var i = 0; i< xe.length; i++){
            xe[i].className = xe[i].className.replace('mractive', '');
          }
          xe[1].classList.add('mractive'); 
      }
    }
    
      console.log(start[0], start[1])
    }

  }
}*/
if(window.innerWidth >= 799){
if(document.querySelectorAll('.pstname a')[0]){
  var pnaa = document.querySelectorAll('.pstname a');
  for(var i = 0; i < pnaa.length; i++){
    pnaa[i].onmouseover = function(e){
      if(this.parentElement.children[this.parentElement.children.length-1].className !== 'shv'){
      var tttt = this;
      if(tttt.children[tttt.children.length-1].className !=='shv'){
      $.ajax({
        url: '/students_connect/h/shwdet.php',
        method: 'POST',
        data:'l='+tttt,
        success: function(g){
          var shv =document.createElement('div');
          shv.className = 'shv';
          shv.style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor;
          shv.style.zIndex = '5000';
          shv.innerHTML = g;
          tttt.append(shv);
          /*if(document.getElementsByClassName('shv')[0]){
            var shv = document.getElementsByClassName('shv')[0];
            shv.id = '';
          }
          else {
            var shv = document.createElement('div');
            shv.className='shv';
            shv.id = ''
            tttt.append(shv);
          }
          shv.innerHTML = g;
          shv.style.display = 'block';
          
          tttt.onmouseout = function(){
            shv.style.display = 'none';
          }*/
        }
      })
    }
      else {
        tttt.children[tttt.children.length-1].style.display = 'block';
      }
    }
  }
  pnaa[i].onmouseout = function(e){
    var tttt = this
    tttt.children[tttt.children.length-1].style.display = 'none';
  }
}
}
}
/*if(window.innerWidth > 799){
  var a = document.getElementsByTagName('a');
  for(var i = 0; i < a.length; i++){
    a[i].onclick = function(e){
      e.preventDefault();
      document.getElementsByClassName('xjdsm')[0].innerHTML = '';
      var ref = this.href;
      var nframe = document.createElement('iframe');
      nframe.className = 'loadframe';
      nframe.src = ref;
      nframe.id='loadframe';
      nframe.onload = function(){
      this.contentWindow.document.getElementById('navbar_list').innerHTML = "<div class='jxame'>Mini Mode <i class='fas fa-external-link-alt'></i></div>";  
      this.contentWindow.document.getElementById('navbar_list').style.color = 'white';
      this.contentWindow.document.getElementById('navbar_list').children[0].style.margin = '15px 0px 0px 0px'
      var xthis = this.src;

      this.contentWindow.document.getElementById('navbar_list').children[0].children[0].onclick = function(){
        window.location.href = xthis;
      }
    }  
    document.getElementsByClassName('xjdsm')[0].append(nframe);
  }
}
}*/







// 12/03/22
// add functions to buttons for manage post

if(document.getElementsByClassName('ubbys1')[0]){
  var wb = document.getElementsByClassName('mg_undbtn')[0].children;
  //button for manage
  wb[0].onclick = function() {
    var t = this.children[0].value;
    var p = this.children[1].value;
    var q = this.children[2].value; 
    var pst = document.getElementsByTagName('textarea')[0].value;
    //var tes = location.search.split('=')[3];
    //console.log(tes);
    var lac = new FormData();
    lac.append('id', t);
    lac.append('usr', p);
    lac.append('type', q);
    lac.append('pst', pst);


    $.ajax({
      url:"/students_connect/update/",
      type:'POST',
      data: lac,
      processData: false,
      contentType: false,
      success : function(){
        document.getElementsByClassName('o_success')[0].style.display = 'block';
        document.getElementsByClassName('o_success')[0].innerHTML = 'Successfully Updated';
        setTimeout(function(){
            document.getElementsByClassName('o_success')[0].style.display = 'none';
        }, 2000)
      },
      error: function(){
        
      }
    })

    
  }
  //button for comment->inline onclick function
  //button for delete
  wb[2].onclick = function(){
    var t = this.children[0].value;
    var p = this.children[1].value;
    var q = this.children[2].value;
    var tes = location.search.split('=')[3];
    console.log(tes);

    var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          window.location = tes;      
        }
    };
    xmlhttp.open('GET', '/students_connect/posts/regulator.php?id='+t+'&usr='+p+'&type='+q);
    xmlhttp.send();
    
  }
}