captions = ['','','','','','','','','','','','','','','','','','','', ''];
var tex = document.getElementsByClassName('sto_inp')[0];
tex.onchange = function(e){
    var tx = document.getElementsByClassName('sto_lft')[0];
    var img = document.createElement('img');
    img.className ='sto_img';
    img.src = URL.createObjectURL(e.target.files[0]);
    img.t = e.target.files[0];
    tx.appendChild(img);
    document.getElementsByClassName('sto_preview')[0].style.display='block';
    var i;
    var sip = document.getElementsByClassName("sto_img_plan")[0];
    if(e.target.files.length > 1){
        var alat = document.createElement('div');
        alat.className='sto_alat';
        for(var i = 0; i< e.target.files.length; i++){
    var crt = document.createElement('div');
    crt.className = 'sto_ppr';
    crt.id = i;
    crt.style.backgroundImage = 'url("'+URL.createObjectURL(e.target.files[i])+'")';
    crt.t = URL.createObjectURL(e.target.files[i]);
    alat.append(crt);
}
sip.append(alat);
    document.getElementsByClassName('sto_ppr')[0].classList.add('cctive');
}
    var sip = document.getElementsByClassName("sto_img_plan")[0];
    var mxa = document.createElement('div');
    mxa.className = 'sto_cap';
    mxa.innerHTML = '<textarea class="sto_fill_cap"></textarea><span class="sto_send"><i class="fas fa-paper-plane"></i></span>';
    sip.append(mxa);
    for(var i = 0; i < document.scripts.length; i++){
        if(document.scripts[i].src.includes('stories')){
            var ttl = document.createElement('script');
            ttl.src = '/students_connect/jsf/stories.js';
            document.scripts[i].replaceWith(ttl);
        }
    }
}
if(document.getElementsByClassName('sto_ppr')[0]){
    var tx = document.getElementsByClassName('sto_ppr');
    for(var i = 0; i < tx.length; i++){
        tx[i].onclick = function(){
            var imgname =  this.t;
            document.getElementsByClassName('sto_img')[0].src = imgname;
            for(var i = 0; i < this.parentElement.children.length; i++){
                this.parentElement.children[i].className = this.parentElement.children[i].className.replace('cctive', '');
            }
            this.classList.add('cctive');
            for(var i = 0; i < this.parentElement.children.length; i++){
                if(this.parentElement.children[i].className.includes('cctive')){
                    console.log(captions[i])
            document.getElementsByClassName('sto_fill_cap')[0].value = captions[i];
                }
            }
        }
    }
}
if(document.getElementsByClassName('sto_fill_cap')[0]){
    console.log(captions);
    var cap = document.getElementsByClassName('sto_fill_cap')[0];
    cap.oninput = function(){
        var al = document.getElementsByClassName('sto_alat')[0];
        for(var i = 0; i < al.children.length; i++){
            if(al.children[i].className.includes('cctive')){
                var tid = al.children[i].id;
                captions[i] = this.value;
                console.log(captions)
            }
        }
    }    
}
if(document.getElementsByClassName('sto_send')[0]){
    var snd = document.getElementsByClassName('sto_send')[0];
    snd.onclick = function(){
        if(document.getElementsByClassName('sto_ppr')[0]){
        var spt = document.getElementsByClassName('sto_ppr');
        }
        else {
            var spt = document.getElementsByClassName('sto_img');
        }
        var exa = document.getElementById('sto_add').value;
        var fl = false;
        if(window.FormData){
            fl =  new FormData();
            }
            for(var x = 0; x < spt.length; x++){
                var exa = document.getElementById('sto_add').files;
                fl.append("files[]", exa[x]);
            }
            for(var x = 0; x < spt.length; x++){
            fl.append("captions[]", captions[x]);
            }
            fl.append('status', '');
            document.getElementsByClassName('sto_preview')[0].style.display = 'none';
                    document.getElementsByClassName('sto_preview')[0].innerHTML = "<span class='sto_close'><i class='fas fa-arrow-left'></i></span>"+
                    "<div class='sto_lft'>"+
                    "<div class='sto_img_plan'></div>"+
                    "</div>";
            $.ajax({
                url: '/students_connect/stories/upload.php',
                type:"POST",
                data:fl,
                processData: false,
                contentType: false,
                success: function(){
                    for(var i = 0; i < document.scripts.length; i++){
                        if(document.scripts[i].src.includes('stories')){
                            var ttl = document.createElement('script');
                            ttl.src = '/students_connect/jsf/stories.js';
                            document.scripts[i].replaceWith(ttl);
                        }
                    }
                }
            })
    }
}
if(document.getElementsByClassName('sto_close')[0]){
    var ett = document.getElementsByClassName('sto_close')[0];
    ett.onclick = function(){
        document.getElementsByClassName('sto_preview')[0].style.display = 'none';
                    document.getElementsByClassName('sto_preview')[0].innerHTML = "<span class='sto_close'><i class='fas fa-arrow-left'></i></span>"+
                    "<div class='sto_lft'>"+
                    "<div class='sto_img_plan'></div>"+
                    "</div>";
                    for(var i = 0; i < document.scripts.length; i++){
                        if(document.scripts[i].src.includes('stories')){
                            var ttl = document.createElement('script');
                            ttl.src = '/students_connect/jsf/stories.js';
                            document.scripts[i].replaceWith(ttl);
                        }
                    }       
    }
}
if(document.getElementsByClassName('sto_view_close')[0]){
    var ett = document.getElementsByClassName('sto_view_close')[0];
    ett.onclick = function(){
        document.getElementsByClassName('sto_view')[0].style.display = 'none';
                    document.getElementsByClassName('sto_view')[0].innerHTML = "<div class='sto_name oth_sto_name'>"+
                    "<div class='sto_view_nme'></div>"+
                    "<div class='sto_view_usr'><i class='fas fa-at'></i></div>"+
                    "<span class='sto_how'></span>"+
                    "<span class='sto_view_close'><i class='fas fa-arrow-left'></i></span>"+
                    "<div class='sto_file_to_view'></div>";
                    for(var i = 0; i < document.scripts.length; i++){
                        if(document.scripts[i].src.includes('stories')){
                            var ttl = document.createElement('script');
                            ttl.src = '/students_connect/jsf/stories.js';
                            document.scripts[i].replaceWith(ttl);
                        }
                    }       
    }
}
if(document.getElementsByClassName('sto_upld')[0]){
    var tux = document.getElementsByClassName('sto_upld');
    for(var i = 0; i < tux.length; i++){
        tux[i].onclick = function(ex){
            if((ex.target != document.getElementsByClassName('sto_inp')[0]) && (ex.target != document.getElementsByClassName('fa-plus')[0])){
            var w = this.children[0].value;
            document.getElementsByClassName('sto_view')[0].style.display = 'block';
            var tx = document.getElementsByClassName('sto_view')[0];
            var gox = tx.innerHTML;
            var qa = [gox];
            //click
                        $.ajax({
                url: "/students_connect/stories/fetch_stories.php?w="+w,
                type: "GET",
                success: function(r){
                    var t = JSON.parse(r);
                    var all = t.length;
                    var y = document.createElement('div');
                    var w = + ((100/parseInt(all)) - 4);
                    var txe = '';
                    for(var i = 0; i < all; i++){
                        txe+= "<div class='stox' style='width: "+w+"%; height: 1px; display: inline-block; margin: 5px; background: white; opacity: 0.3;' id='qwe"+i+"'></div>";
                    }
                    var oxe = document.createElement('div');
                    oxe.className = 'so_lo_po';
                    for(var i = 0; i < all; i++){
                    var jk = document.createElement('div');
                    jk.id = 'ox'+i;
                    jk.style.display = 'none';
                    var img = document.createElement('img');
                    img.className ='sto_imge';
                    img.src = '/students_connect_hidden/stories/'+t[i][0]+'.png';
                    jk.append(img);
                    var ty = document.createElement('div');
                    ty.className = 'sto_capt';
                    ty.innerHTML = t[i][1];
                    jk.append(ty);
                    oxe.append(jk)
                }
                oxe.children[0].style.display = 'block';
                var q = 0;
                var mk = setInterval(ox, 5000);            
                function ox(){
                    setTimeout(() => {
                        if(document.getElementById('ox'+(q+1))){
                        document.getElementById('ox'+q).style.display = 'none';
                        document.getElementById('qwe'+q).style.opacity = '0.3';
                        document.getElementById('ox'+(q+1)).style.display = 'block';
                        document.getElementById('qwe'+(q+1)).style.opacity = '1';
                        q = q+1;
                    }
                    else {
                        clearInterval(mk);
                        document.getElementById('ox'+q).style.display = 'none';
                        document.getElementById('qwe'+q).style.opacity = '0.3';
                        document.getElementsByClassName('sto_view')[0].innerHTML = qa[0];
                        document.getElementsByClassName('sto_view')[0].style.display = 'none';
                    }
                    }, 1);
                }
                y.innerHTML = "<div class='s_o_top' style='width: 90%; white-space: nowrap; overflow: hidden; top: 65px; position: relative; margin: auto;'>"+txe+"</div>"
                y.children[0].children[0].style.opacity = '1';
                tx.append(y);
                    tx.append(oxe);
                    for(var i =0; i < document.scripts.length; i++){
                        if(document.scripts[i].src.includes('stories.js')){
                          var oxe = document.createElement('script');
                          oxe.src = '/students_connect/jsf/stories.js';
                          document.scripts[i].replaceWith(oxe);
                        }
                    }
                    for(var et = 0; et < document.scripts.length; et++){
                        if(document.scripts[et].src.includes('comp_stories.js')){
                            document.scripts[et].remove();
                        }
                    }
                    var scr = document.createElement('SCRIPT');
                    scr.src = '/students_connect/jsf/comp_stories.js';
                    document.body.append(scr);
            }
            })
        }
    }
}
}
