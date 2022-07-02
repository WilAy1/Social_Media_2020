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



if(document.getElementsByClassName('std_yx')){
  if(document.getElementsByClassName('cotx')){
    var cotx = document.getElementsByClassName('cotx');
    for(var i = 0; i < cotx.length; i++){
     if(!document.getElementsByClassName('cxeet_ml')[i]){
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
    }
   }
  }
  if(document.getElementsByClassName('tr_ash')){
    var trash = document.getElementsByClassName('tr_ash');
    for(var i = 0; i < trash.length; i++){
    if(!document.getElementsByClassName('cxeet_trh')[i]){
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
    }
   }
  }
  if(document.getElementsByClassName('yxclose')){
    var mee = document.getElementsByClassName('yxclose');
    for(var i = 0; i < mee.length; i++){
      if(!document.getElementsByClassName('cxeet_mll')[i]){
      mee[i].innerHTML = "<i class='fas fa-times cxeet_mll'></i><span>Close</span>";
    }
   }
  }
  if(document.getElementsByClassName('xia_o')){
    var xia = document.getElementsByClassName('xia_o');
    for(var i = 0; i < xia.length; i++){
      if(!document.getElementsByClassName('cxeet_grtt')[i]){
      var x = document.createElement('SPAN');
      x.innerHTML = 'Save';
      x.className = 'cxeet_grtt';
      xia[i].append(x);
    }
   }
  }
  if(document.getElementsByClassName('blusr')){
    var xia = document.getElementsByClassName('blusr');
    for(var i = 0; i < xia.length; i++){
      if(!document.getElementsByClassName('cxeet_mlo')[i]){
      xia[i].style.color = 'red';
      xia[i].classList.add('cxeet_mlo');
      xia[i].innerHTML = "<i class='fas fa-minus-circle'></i><span>Block User</span>";
    }
  }
 }
  if(document.getElementsByClassName('repop')){
    var xia = document.getElementsByClassName('repop');
    for(var i = 0; i < xia.length; i++){
      if(!document.getElementsByClassName('cxeet_mlg')[i]){
      xia[i].classList.add('cxeet_mlg');
      xia[i].innerHTML = "<i class='fas fa-exclamation-circle'></i><span>Report Post</span>";
    }
   }
  }
}
















window.onload = function(){
  if(document.getElementsByClassName('postimages')[0]){
    var pimg = document.getElementsByClassName('postimages');
    for(var i =0; i< pimg.length; i++){
      if(pimg[i].children.length == 2){
        pimg[0].children[1].style.width = '50%';
        pimg[1].children[1].style.width = '50%';
        pimg[1].children[1].style.left = '50%';
      }
    }
  }
}

/*if(document.getElementsByClassName('std_yx')){
  if(document.getElementsByClassName('cotx')){
    var cotx = document.getElementsByClassName('cotx');
    for(var i = 0; i < cotx.length; i++){
      var cmtt = document.createElement('SPAN');
      cmtt.innerHTML = 'Comment';
      cotx[i].append(cmtt);
    }
  }
  if(document.getElementsByClassName('tr_ash')){
    var trash = document.getElementsByClassName('tr_ash');
    for(var i = 0; i < trash.length; i++){
      var trh = document.createElement('SPAN');
      trh.innerHTML = 'Delete';
      trh.style.color = 'red';
      trash[i].append(trh);
    }
  }
  if(document.getElementsByClassName('yxclose')){
    var mee = document.getElementsByClassName('yxclose');
    for(var i = 0; i < mee.length; i++){
      mee[i].innerHTML = "<i class='fas fa-times'></i><span>Close</span>";
    }
  }
  if(document.getElementsByClassName('xia_o')){
    var xia = document.getElementsByClassName('xia_o');
    for(var i = 0; i < xia.length; i++){
      var x = document.createElement('SPAN');
      x.innerHTML = 'Save';
      xia[i].append(x);
    }
  }
  if(document.getElementsByClassName('blusr')){
    var xia = document.getElementsByClassName('blusr');
    for(var i = 0; i < xia.length; i++){
      xia[i].style.color = 'red';
      xia[i].innerHTML = "<i class='fas fa-minus-circle'></i><span>Block User</span>";
    }
  }
  if(document.getElementsByClassName('repop')){
    var xia = document.getElementsByClassName('repop');
    for(var i = 0; i < xia.length; i++){
      xia[i].innerHTML = "<i class='fas fa-exclamation-circle'></i><span>Report Post</span>";
    }
  }
}*/

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
            document.getElementsByClassName('in_notification')[0].style.display = 'block';
            document.getElementsByClassName('in_notification')[0].classList.remove('in__eee');
            document.getElementsByClassName('in_notification')[0].classList.add('in__eee');
          }
        }
      });
  }, 5000);
}
if(document.getElementsByTagName('VIDEO')[0]){
  var te = document.getElementsByTagName('VIDEO');
  for(var q = 0; q < te.length; q++){
    if(!te[q].className.includes('a_jined')){
      te[q].classList.add('a_jined');
    te[q].addEventListener('contextmenu', function(e){
      e.preventDefault();
      e.stopPropagation();
    }, false)
    /*var canv = document.createElement('canvas');
    canv.width = te[q].videoWidth;
    canv.height = te[q].videoHeight;
    canv.getContext('2d').drawImage(te[q], 0, 0, canv.width, canv.height);
      te[q].poster = '/students_connect_hidden/postuploads/s/121(1).png' //canv.toDataURL('image/png');
    var a = document.createElement('img');
    a.style.height = '200px'; a.style.width = '200px'
    a.src = canv.toDataURL('image/png');
    document.body.insertBefore(a, document.body.childNodes[0]);
      */
    if(te[q].controls){
      te[q].controls = false; 
    }
      var me = te[q].parentElement;
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
    var mo = parseInt(te[q].duration);
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
    mxe[q].onclick = function(){
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
  /*te[q].onmouseover = function(){
    var op = this.parentElement.children[1];
    if(this.paused == false){
      op.className = op.className.replace('play', 'pause');
      op.style.display = 'block';
    }
  }
  te[q].onmouseout = function(){
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
  te[q].onclick = function(){
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
  te[q].onpause = function(){
    var op = this.parentElement.children[1];
    op.className = op.className.replace('pause', 'play');
    op.style.opacity = '1'
  }
  te[q].onplay = function(){
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
  te[q].playsInline = true;
  }
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