<?php
    require_once "/Users/wilay/students_connect/connect.php";
    
    echo "function loadfContent(nmfu){
        var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 3){
                        document.getElementById('loadingf').style.display='block';
                        }
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('loadingf').style.display='none';
                            document.getElementById('flshw').innerHTML = xmlhttp.responseText;
                            var x = document.getElementsByTagName('head')[0];
                            var s = document.createElement('script');
                            s.src = '/students_connect/jsf/student_connectflw.js.php?n=';
                            s.onload = 
                            x.appendChild(s);
                        }
                        else if (xmlhttp.status == 404) {
                            document.getElementById('tagnf').style.display='block';
                            document.getElementById('loadingf').style.display='none';
                        }
                    };
                    xmlhttp.open('GET', '/students_connect/friends/fetchfollowers.php?n='+ nmfu);
                    xmlhttp.send();
    }
    function loadfoContent(nmfu){
        var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 3){
                        document.getElementById('loadingff').style.display='block';
                        }
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('loadingff').style.display='none';
                            document.getElementById('fllshw').innerHTML = xmlhttp.responseText;
                        }
                        else if (xmlhttp.status == 404) {
                            document.getElementById('tagnff').style.display='block';
                            document.getElementById('loadingff').style.display='none';
                        }
                    };
                    xmlhttp.open('GET', '/students_connect/friends/fetchfollowers.php?nm='+ nmfu);
                    xmlhttp.send();
    }
    function loadfmContent(nmfu){
        var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 3){
                        document.getElementById('loadingm').style.display='block';
                        }
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('loadingm').style.display='none';
                            document.getElementById('mushw').innerHTML = xmlhttp.responseText;
                        }
                        else if (xmlhttp.status == 404) {
                            document.getElementById('tagnmf').style.display='block';
                            document.getElementById('loadingm').style.display='none';
                        }
                    };
                    xmlhttp.open('GET', '/students_connect/friends/fetchfollowers.php?nmm='+ nmfu);
                    xmlhttp.send();
    }
    function unFollow(user, name){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            }
        };
        xmlhttp.open('GET', '/students_connect/friends/flw.php?user='+user+'&nme='+name);
    }
        ";
?>