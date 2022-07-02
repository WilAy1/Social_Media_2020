if(document.getElementsByClassName('bl_xoop')[0]){
var ma = document.getElementsByClassName('bl_xoop');
for(var i = 0; i < ma.length; i++){
  ma[i].onclick = function(){
    fl = new FormData();
    if(this.innerHTML == 'Block'){
      var oo = 'to';
      var llk = '/students_connect/bl/block.php';
    }
    else if (this.innerHTML == 'Unblock'){
      var oo = 'wh';
      var llk =  '/students_connect/bl/block.php';
    }
    else if(this.innerHTML == 'Follow'){
      fl.append('user', this.parentElement.children[1].value)
      fl.append('subfol', '');
      var oo = 'fuser';
      var llk = '/students_connect/profile/fform.php';
    }
    else {
      var llk = '';
    }
    var mot = this;
    fl.append(oo, this.parentElement.children[0].value);
    $.ajax({
      url: llk,
      type:'POST',
      data:fl,
      processData: false,
      contentType: false,
      success: function(){
        if(mot.innerHTML == 'Block'){
          mot.innerHTML = 'Unblock';
        }
        else if(mot.innerHTML == 'Unblock'){
          mot.innerHTML = 'Block';
        }
        else if(mot.innerHTML == 'Follow'){
          mot.innerHTML = 'Following';
        }
      }
    }
      )
  }
}
}
if(document.getElementById('dds')){
document.getElementById('dds').oninput = function(){
  var oma = this.value;
  if(this.value != ''){
  document.getElementsByClassName('sc_cvval')[0].style.display = 'none';
  document.getElementsByClassName('sc_cvvalo')[0].style.display = 'block';
  fl = new FormData();
  fl.append('bb', oma);
  $.ajax({
    url: '/students_connect/settings/unblock/filter.php',
    type:'POST',
    data: fl,
    processData: false,
    contentType: false,
    success: function(R){
      document.getElementsByClassName('sc_cvvalo')[0].innerHTML = R;
    for(var i= 0; i < document.scripts.length; i++){
        if(document.scripts[i].src.includes('settings.js')){
            var s = document.createElement('script');
            s.src = document.scripts[i].src;
            document.scripts[i].replaceWith(s);
        }
    }
    }
  })
}
  else {
    document.getElementsByClassName('sc_cvval')[0].style.display = 'block';
  document.getElementsByClassName('sc_cvvalo')[0].style.display = 'none';
  }
  }
  if(document.getElementById('ssf')){
  document.getElementById('ssf').oninput = function(){
    var oma = this.value;
    if(this.value != ''){
    document.getElementsByClassName('sc_oeor')[0].style.display = 'none';
    document.getElementsByClassName('sc_oeoro')[0].style.display = 'block';
    fl = new FormData();
    fl.append('fr', oma);
    $.ajax({
      url: '/students_connect/settings/unblock/filter.php',
      type:'POST',
      data: fl,
      processData: false,
      contentType: false,
      success: function(R){
        document.getElementsByClassName('sc_oeoro')[0].innerHTML = R;
      for(var i= 0; i < document.scripts.length; i++){
          if(document.scripts[i].src.includes('settings.js')){
              var s = document.createElement('script');
              s.src = document.scripts[i].src;
              document.scripts[i].replaceWith(s);
          }
      }
      }
    })
  }
    else {
      document.getElementsByClassName('sc_oeor')[0].style.display = 'block';
    document.getElementsByClassName('sc_oeoro')[0].style.display = 'none';
    }
    }
  }
}
if(document.getElementsByClassName('ss_xcval')){
  var ss = document.getElementsByClassName('ss_xcval');
  for(var i = 0; i < ss.length; i++){
    ss[i].addEventListener('click' , function(){
      for(var w = 0; w < ss.length; w++){
        ss[w].parentElement.children[1].style.display = 'none'
        ss[w].children[1].children[0].className = ss[w].children[1].children[0].className.replace('up', 'down')
      }
      if(this.parentElement.children[1].style.display == 'none' || this.parentElement.children[1].style.display == ''){
        this.parentElement.children[1].style.display = 'block'
        this.children[1].children[0].className = this.children[1].children[0].className.replace('down', 'up')
      }
      else {
          this.parentElement.children[1].style.display = 'none';
          this.children[1].children[0].className = this.children[1].children[0].className.replace('up', 'down')
        }
    })
  }
}

if(window.location.href.includes('fsettings') && document.getElementsByTagName('button')[0]){
  var btn = document.getElementsByTagName('button');
  for(var i = 0; i < btn.length; i++){
    btn[i].onclick = function(){
      var tll = new FormData;
      if(this.className.includes('ss_rcmds1221')){
        tll.append('p', 1);
        tll.append('prec', '');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_rcmds1222')) {
        tll.append('p', 2);
        tll.append('prec', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_rcmds1321')){
        tll.append('p', 1);
        tll.append('urec', '');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_rcmds1322')) {
        tll.append('p', 2);
        tll.append('urec', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_rcmds1521')){
        tll.append('p', 1);
        tll.append('intr', '');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if (this.className.includes('ss_rcmds1522')){
        tll.append('p', 2);
        tll.append('intr', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_notf1211')){
        tll.append('p', '2,5');
        tll.append('notf', '');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if (this.className.includes('ss_notf1212')) {
        tll.append('p', '1,0');
        tll.append('notf', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_svedx1211')){
        tll.append('p', '1,5');
        tll.append('sved', '');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
this.classList.add('ss_tive')
      }
      else if(this.className.includes('ss_svedx1212')) {
        tll.append('p', '2,0');
        tll.append('sved', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs1111')) {
        tll.append('p', '1');
        tll.append('what', 'number');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs1112')) {
        tll.append('p', '2');
        tll.append('what', 'number');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs1113')) {
        tll.append('p', '3');
        tll.append('what', 'number');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs2111')) {
        tll.append('p', '1');
        tll.append('what', 'email');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs2112')) {
        tll.append('p', '2');
        tll.append('what', 'email');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs2113')) {
        tll.append('p', '3');
        tll.append('what', 'email');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs3111')) {
        tll.append('p', '1');
        tll.append('what', 'sex');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs3112')) {
        tll.append('p', '2');
        tll.append('what', 'sex');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs3113')) {
        tll.append('p', '3');
        tll.append('what', 'sex');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs4111')) {
        tll.append('p', '1');
        tll.append('what', 'dateofbirth');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs4112')) {
        tll.append('p', '2');
        tll.append('what', 'dateofbirth');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.parentElement.children[2].className = this.parentElement.children[2].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
      else if(this.className.includes('ss_othrs4113')) {
        tll.append('p', '3');
        tll.append('what', 'dateofbirth');
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace('ss_tive', '');
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace('ss_tive', '');
        this.classList.add('ss_tive');
      }
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
        document.body.append(qx);
      $.ajax({
        url: '/students_connect/settings/fsettings/u.php',
        type: 'post',
        data: tll,
        processData: false,
        contentType: false,
        success: function(){
          qx.innerHTML = 'Updated';
          setTimeout(function(){
            qx.remove()
          }, 2000)
          
        },
        error : function(){
          qx.innerHTML = 'Update Failed';
          setTimeout(function(){
            qx.remove()
          }, 2000)
        }
      })
    }
  }
}