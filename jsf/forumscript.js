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
          dwn[i].style.backgroundColor = 'rgb(245, 245, 245, 0.1)';
  }
}
if(document.getElementsByClassName('mddrt')){
  var dwn = document.getElementsByClassName('mddrt');
      for(i = 0; i < dwn.length; i++){
      dwn[i].style.backgroundColor = 'rgb(245, 245, 245, 0.1)';
}
}
if(document.getElementsByClassName('comment_section')){
  var dwn = document.getElementsByClassName('comment_section');
      for(i = 0; i < dwn.length; i++){
      dwn[i].style.backgroundColor = 'rgb(245, 245, 245, 0.1)';
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
          dwn[i].style.backgroundColor = 'rgb(245, 245, 245, 0.1)';
  }
  }
  if(document.getElementsByClassName('tsp')){
      var dwn = document.getElementsByClassName('tsp');
          for(i = 0; i < dwn.length; i++){
              dwn[i].style.boxShadow = '1px 1px 1px 1px rgb(15, 15, 15, 0.7)';
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
      document.getElementsByClassName('ttr')[0].style.boxShadow = '-1px 2px 2px 2px rgb(245,245,245,1)';
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
          dwn[i].style.backgroundColor = 'rgb(15, 15, 15, 0.1)';
  }
}
if(document.getElementsByClassName('mddrt')){
  var dwn = document.getElementsByClassName('mddrt');
      for(i = 0; i < dwn.length; i++){
      dwn[i].style.backgroundColor = 'rgb(15, 15, 15, 0.1)';
}
}
if(document.getElementsByClassName('comment_section')){
  var dwn = document.getElementsByClassName('comment_section');
      for(i = 0; i < dwn.length; i++){
      dwn[i].style.backgroundColor = 'rgb(15, 15, 15, 0.1)';
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
          dwn[i].style.backgroundColor = 'rgb(15, 15, 15, 0.1)';
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
window.onload = checkDark();
if(x =document.getElementsByClassName('cmt')){
    var a,b,c,d,e,f, pid;
    for(f = 0; f < x.length; f++){
      a = x[f];
      a.onclick = function(){
          pid = this.children[0].value;
          fid = this.children[1].value;
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById('quest').innerHTML = xmlhttp.responseText;
            window.history.pushState('', '', '/students_connect/f/'+parseInt(fid)+'/'+pid+'/')
        }
     };
     xmlhttp.open('GET', '/students_connect/f/fposts.php?pid='+pid+'&fid='+fid);
     xmlhttp.send();       
      }
    }
}
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
                       this.style.background = 'linear-gradient(90deg, rgb(73, 73, 204, 0.8), rgb(73, 73, 204, 0.8))'; 
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
              crar[0].style.backgroundSize = db.substring(0, p1)+'% 100%'; 
              crar[1].style.backgroundSize = db.substring(p1+1, parseInt(p2-1))+'% 100%'; 
              crar[2].style.backgroundSize = db.substring(p2, p3-1)+'% 100%'; 
              crar[3].style.backgroundSize = db.substring(p3, p4)+'% 100%'; 
            } 
        }; 
        xmlhttp.open('GET', '/students_connect/polls/?id='+pid+'&vote='+value+'&user='+user+'&pstst='+pstst); 
        xmlhttp.send(); 
        } 
        } 
        } 
        var iks = document.getElementsByTagName('IMG'); 
        console.log(iks.length); 
        for(var x = 0; x < iks.length; x++){ 
         var mn = document.getElementsByTagName('IMG')[x]; 
         mn.onclick = function(){ 
           var y = this.src; 
       var z = document.getElementById('thimgv'); 
       var q = z.innerHTML; 
       if(q.includes('img')){ 
       document.getElementsByClassName('imgsmall')[0].src = y; 
       document.getElementsByClassName('timgbsys')[0].style.display = 'block'; 
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
       document.getElementById('plding').style.display = 'block'; 
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
     var mod = document.getElementById('thimgv'); 
     window.onclick = function(event) { 
       if (event.target == mod) { 
         document.getElementsByClassName('timgbsys')[0].style.display = 'none'; 
       } 
     }; 
     var cl = document.getElementById('clview'); 
     cl.onclick = function(){ 
       document.getElementsByClassName('timgbsys')[0].style.display = 'none'; 
       }
