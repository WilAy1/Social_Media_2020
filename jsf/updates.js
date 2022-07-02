window.onclick = function(){
    if(document.getElementsByClassName('cntfl')){
        var all = document.getElementsByClassName('cntfl');
        var mlarray = [];
        for(var i = 0; i < all.length; i++){
          var mxe = all[i].id;
            var red = mxe.length;
            var tid = mxe.substring(4, red);
            mlarray.push(tid);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('cntl'+tid).innerHTML = xmlhttp.responseText;
            }
            };
            xmlhttp.open('GET', '/students_connect/posts/updates.php?id='+tid);
            xmlhttp.send();
          }
        }
    }