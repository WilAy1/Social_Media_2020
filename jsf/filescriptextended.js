function chAry(data, inarray){
    var c = 0;
    inarray.forEach((b)=> (b === data && c++));
    return c;
  }
var allforms = document.forms;
 for(var i = 0; i < allforms.length; i++){
allforms[i].onsubmit = function(e){
    e.preventDefault();
    var fl =false;
    if(window.FormData){
        fl =  new FormData();
    }
    for(var k=0; k < this.elements.length; k++){
        var name = this.elements[k].name;
        var value =this.elements[k].value;
        if(name != 'esfile[]'){
            fl.append(name, value);
        }
        else {
            for(var o = 0; o < this.elements[k].files.length; o++){
                fl.append('esfile[]', this.elements[k].files[o])
            }
        }
    }
    var spt = this.elements[0].value.split('\n');
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
    if((go.length == chAry(false, go)) || (this.elements[3].value != '')){
    var oo = this;
    if(this.name == 'spids'){
        var action = '/students_connect/posts/pst/';
        var eed = 'ck';
    }
    else if(this.name == 'ecpid'){
        var action = '/students_connect/posts/pst/';
        var eed = 'ek';
    }
    else if(this.name == 'eccom'){
        action = '/students_connect/posts/pst/';
        eed = 'ecc';
    }
    else if(this.name == 'ecsom'){
        action = '/students_connect/posts/pst/';
        eed = 'scc';
    }
    this.elements[0].value = ''; 
    this.elements[3].value = '';
    $.ajax({
        url: action,
        type: oo.method,
        data:fl,
        processData: false,
        contentType: false,
        success: function(){
            document.getElementsByClassName('o_success')[0].style.display = 'block';
            document.getElementsByClassName('o_success')[0].innerHTML = 'Successfully Replied';
            setTimeout(function(){
                document.getElementsByClassName('o_success')[0].style.display = 'none';
            }, 2000)
            if(eed == 'scc'){
                var a = oo.elements[1].value;
                var b = oo.elements[2].value;
                opensReplyContent(b,a)                       
            }
            else if(eed == 'ecc'){
                var a = oo.elements[1].value;
                var b = oo.elements[2].value;
                openReplyContent(b,a)
            }
            else {
            $.ajax({
                url: '/students_connect/posts/pst/flatest.php',
                type: 'GET',
                data:'pid='+oo.elements[1].value+'&'+eed,
                processData: false,
                contentType: false,
                success: function(data){
                    document.getElementsByClassName('o_success')[0].style.display = 'block';
                    document.getElementsByClassName('o_success')[0].innerHTML = 'Successfully Replied';
                    setTimeout(function(){
                        document.getElementsByClassName('o_success')[0].style.display = 'none';
                    }, 2000)
                    var vodoo = document.createElement('div');
                    vodoo.className = 'comment_section1';
                    vodoo.style.paddingTop = '35px';
                    vodoo.innerHTML = data;
                    var q = document.getElementsByClassName('lkkl_jk')[0];
                    document.getElementsByClassName('lkkl_jk')[0].insertBefore(vodoo, q.childNodes[0]);
                }
            })
        }
        for(var i = 0; i< document.scripts.length; i++ ){
            if(document.scripts[i].src.includes('filescriptextended')){
              var oxe = document.createElement('script');
              oxe.src = '/students_connect/jsf/filescriptextended.js';
              document.scripts[i].replaceWith(oxe);
            }
        }
    }
    })
}
}
 }
if(document.getElementsByClassName('report')[0]){
    var report = document.getElementsByClassName('report');
    for(var i = 0; i < report.length; i++){
        report[i].innerHTML = "<i class='fas fa-ellipsis-v'></i>";
    }
}
 var htar = document.getElementsByTagName('textarea');
 for(var i = 0; i < htar.length; i++){
     htar[i].onkeypress = function(e){
         if(e.key == 'Enter'){

         }
         var brk = this.value.split(" ");
         if(brk[brk.length - 1].substr(0, 1) == '@' || brk[brk.length - 1].substr(0, 1) == '#'){
            var sv = brk[brk.length - 1].substr(1);
            if(brk[brk.length - 1].substr(0, 1) == '@'){
                   
            }
            else {

            }
         }
     }
 }