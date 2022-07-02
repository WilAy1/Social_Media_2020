
        <?php
        define('op', '/Users/wilay/students_connect/');
       require_once op.'/connect.php';
       require_once op.'/header2.php';
       require_once op.'/f/submitposts.php';
        echo "<script>
        var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {  
            var a = xmlhttp.responseText;
                document.getElementById('quest').innerHTML = a;
                var f = document.createElement('script');
               f.src = '/students_connect/jsf/forumscript.js';
               f.type = 'text/javascript';
               var e = document.getElementsByTagName('HEAD')[0];
                e.append(f);
            }
                    };
                    xmlhttp.open('GET', '/students_connect/f/index.php?fid=1');
                    xmlhttp.send();       
     </script>"
     ?>