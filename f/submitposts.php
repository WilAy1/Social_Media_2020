<?php
define('hk', '/Users/wilay/students_connect/');
    require_once hk."/connect.php";
    $gd = getcwd();
    if(isset($_POST['forumpost']) && !empty($_POST['forumpost'])){ 
      $user= $_POST['psby'];
        $pstcont = sanitizeString($_POST['forumpost']);
        $fid = $_POST['tfid'];
        $timefp = time();
        $id = 0;
        $tnu = 0;
        $tnd = 0;
        $tnc = 0;
        $pstst = 0;
        $splpstcont = explode(" ",$pstcont);
    for($x = 0; $x < count($splpstcont); $x++){
      if(strpos($splpstcont[$x], "#") !== false){
          $len = strlen($splpstcont[$x]);
          $gpoh = strpos($splpstcont[$x], "#");
          $st = $splpstcont[$x];
          $id = 0; 
          if(strpos($splpstcont[$x], '\\') !== false){
              $lp = strpos($splpstcont[$x], '\\');
              $ns = substr($splpstcont[$x], $lp);
              $ins = trim($ns);
              $ins = str_replace("\\r\\n", "", $ins);
              queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timefp')"); 
              $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
            if($cch->num_rows){
              $dce = mysqli_fetch_array($cch);
              $cn = $dce['numberofusages'];
              $increment = (int) ++$cn;
              queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
            }
            else {
              queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins','$pstst', '1', '$timefp')");
            }
            }
          else {
            $ns = substr($splpstcont[$x], 0);
            $ins = trim($ns);
            $ins = str_replace("\\r\\n", "", $ins);
            queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timefp')");
            $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
            if($cch->num_rows){
              $dce = mysqli_fetch_array($cch);
              $cn = $dce['numberofusages'];
              $increment = (int) ++$cn;
              queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
            }
            else {
              queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins', '$pstst','1', '$timefp')");
            }
          }
        $pstcont = str_replace($ns, "<a href=\'/students_connect/search/?search=".$ns."\'>"
        .$ns."</a>", $pstcont);
      }
    }
    $a = mysqli_fetch_array(queryMysql("SELECT * FROM forumposts WHERE user='$user' AND dateofpost='$timefp' 
    AND forumid='$fid'"));
    if(empty($_FILES['fimgs']['name'][0])){
        queryMysql("INSERT INTO forumposts VALUES('$id', '$user', '$fid', '$pstcont', 
                   '$timefp', '$tnu', '$tnd', '$tnc')");
        queryMysql("INSERT INTO forumpostviews VALUES('$id', '0')");
    }
    else {
            $nmf = count($_FILES['pstimg']['name']);
            for($i=0; $i < $nmf; $i++){
              $nnn = $_FILES['fimgs']['name'][$i];
              define("q", "c:/apache24/htdocs");
              move_uploaded_file($_FILES['fimgs']['tmp_name'][$i],
              q.'/students_connect_hidden/postuploads/'. $nnn);
              rename('../../students_connect_hidden/postuploads/'.$_FILES['pstimg']['name'][$i],
               q.'/students_connect_hidden/postuploads/f/'.$a['id'].'('.$i.').png');
              }
    }
    $a = mysqli_fetch_array(queryMysql("SELECT * FROM forumposts WHERE user='$user' AND dateofpost='$timefp' 
    AND forumid='$fid'"));
       mkdir($gd.'\\'.$a['id']);
       chdir($gd.'\\'.$a['id']);
       $f = fopen('index.php', "w");
       fwrite($f, "
       <?php
       define('op', '/Users/wilay/students_connect/');
       require_once op.'/connect.php';
       require_once op.'/header2.php';
       require_once op.'/f/submitposts.php';
       echo \"<script>
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
                   xmlhttp.open('GET', '/students_connect/f/fposts.php?pid=".$a['id']."&fid=".$a['forumid']."');
                   xmlhttp.send();       
    </script>\"
    
    ?>");
       fclose($f);
        chdir($gd);
    }
?>