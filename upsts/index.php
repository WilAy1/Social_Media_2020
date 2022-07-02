<?php 
require_once "/Users/wilay/students_connect/connect.php";
session_start();
if (isset($_SESSION['user']))
  {
    $tuser = $_SESSION['user'];
    $ohl = mysqli_fetch_array(queryMysql("SELECT user FROM members WHERE user='$tuser'"));
    $user = $ohl['user'];
    $loggedin = TRUE;
    $userstr  = $user;
  }
  else $loggedin = FALSE;
if(!$loggedin)
{ die("<script>
function Redirect() {
    window.location='../students_connect/login.php';
}
setTimeout('Redirect()', 1)</script>");
}
else {
  if(!empty($_POST['sendposts']) || !empty($_FILES['pstimg']['name'][0])){
    $pstcont = (sanitizeString($_POST['sendposts']));
    $pstst = sanitizeString($_POST['ispost']);
    $timeofupdate = time();
    $pstcont = str_replace("\\r\\n", " \r\n ", $pstcont);
    $nsp = explode("\\r\\n", $pstcont);
    $alh = array();
    $erst = array();
    for($y = 0; $y < count($nsp); $y++){
      $new = explode(" ",$nsp[$y]);
      for($i = 0; $i < count($new); $i++){
      if(strpos($new[$i], "#") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "#");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        $ins = trim($ns);
        $ins = str_replace("\\r\\n", "", $ins);
        queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timeofupdate')");
        $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
        if($cch->num_rows){
          $dce = mysqli_fetch_array($cch);
          $cn = $dce['numberofusages'];
          $increment = (int) ++$cn;
          queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
        }
        else {
          queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins', '$pstst','1', '$timeofupdate')");
        }
        array_push($alh, $ns);
        }
      }
      if(strpos($new[$i], "@") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "@");
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        array_push($erst, $ns);
      }
    }
    }
    for($p = 0; $p < count($alh); $p++){
      $ns = $alh[$p];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/tags/?hashtag=$sns").">"
        .$ns."</a>", $pstcont);
    }
    $erst = array_unique($erst);
    for($r = 0; $r < count($erst); $r++){
      $ns = $erst[$r];
      $tto = queryMysql("SELECT * FROM members WHERE user='".substr($ns, 1, strlen($ns))."'");
      if($tto->num_rows){
        $id = 0;
        $usertobenotified = substr($ns, 1, strlen($ns));
        if($user != $usertobenotified){
        $mot = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usertobenotified'"));
        $usertobenotified = $mot['user'];
        $i = 0;
        $notheading = "<b>You were mentioned in a post</b>";
        $notcontent = "$user mentioned you in a post";
        $hidenot = 0;
        $timeofnot = time();
        $notlink = '';
        queryMysql("INSERT INTO notifications VALUE('$id',
        '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')"); 
      }
      }
    }
    /*$splpstcont = explode(" ",$pstcont);
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
              queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timeofupdate')"); 
              $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
            if($cch->num_rows){
              $dce = mysqli_fetch_array($cch);
              $cn = $dce['numberofusages'];
              $increment = (int) ++$cn;
              queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
            }
            else {
              queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins','$pstst', '1', '$timeofupdate')");
            }
            }
          else {
            $ns = substr($splpstcont[$x], 0);
            $ins = trim($ns);
            $ins = str_replace("\\r\\n", "", $ins);
            queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timeofupdate')");
            $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
            if($cch->num_rows){
              $dce = mysqli_fetch_array($cch);
              $cn = $dce['numberofusages'];
              $increment = (int) ++$cn;
              queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
            }
            else {
              queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins', '$pstst','1', '$timeofupdate')");
            }
          }
          $sns = substr($ns, 3, strlen($ns));
        $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/tags/?hashtag=$sns").">"
        .$ns."</a>", $pstcont);
      }
      if(strpos($splpstcont[$x], "@") !== false){
        $len = strlen($splpstcont[$x]);
          $gpoh = strpos($splpstcont[$x], "@");
          $st = $splpstcont[$x];
          $id = 0; 
          if(strpos($splpstcont[$x], '\\') !== false){
              $lp = strpos($splpstcont[$x], '\\');
              $ns = substr($splpstcont[$x], $lp);
              $ins = trim($ns);
              $ins = str_replace("\\r\\n", "", $ins);
            }
          else {
            $ns = substr($splpstcont[$x], 0);
            $ins = trim($ns);
            $ins = str_replace("\\r\\n", "", $ins);
          }
        $pstcont = str_replace($ns, "<a href=\'".htmlspecialchars("/students_connect/user/".substr($ns, 1, strlen($ns)))."\'>"
        .$ns."</a>", $pstcont);
      }
    }*/
    $pnl = 0;
    $pnc = 0;
    $id=0;
    $tun = 0;
    $tln = 0;
    $tnd = 0;
    $taggedusers = 0;
    $hasfile = 0;
    $nmbffiles = 0;
    $pinterest = sanitizeString($_POST['tagpost']);
    if($pstst == '0'){
      if(empty($_FILES['pstimg']['name'][0])){
      $pstst = sanitizeString($_POST['ispost']);
      queryMysql("INSERT INTO eduposts VALUES('$user', '$taggedusers', '$id',
       '$pstcont', '$pstst', '$timeofupdate', '0', '$user','0','0','0',
       '$pnl', '$tun', '$tnd', '$pnc', '$pinterest')");
       queryMysql("INSERT INTO postviews VALUES('$id', '0')");
       $a = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE user='$user' AND timeofupdate='$timeofupdate' ORDER BY timeofupdate DESC"));
       if(!empty($_POST['opt1']) && !empty($_POST['opt2'])){
        $tpoid = $a['id'];
         $opt1 = sanitizeString($_POST['opt1']);
         $opt2 = sanitizeString($_POST['opt2']);
         $opt3 = sanitizeString($_POST['opt3']);
         $opt4 = sanitizeString($_POST['opt4']);
         $pst = sanitizeString($_POST['ispost']);
         $did = 0;
         $ts = time();
         $m = date("M")." ".$_POST['day']." ".$_POST['hour'].":".
        $_POST['minute']." ".$_POST['period'];
        if(($_POST['finishdate'] == date("M")) || strtotime($m) < time()){
          $et = strtotime("24 hours");
          }
          else {
          $et = strtotime($m);
          }
         queryMysql("INSERT INTO polls VALUES('$did', '$tpoid', '$pst', 
         '$opt1', '$opt2', '$opt3', '$opt4',
         '0', '0', '0', '0', '$ts', '$et')");
        }
       $gcd = getcwd();
       chdir("../posts");
       mkdir($a['id']);
       $f = fopen($a['id'].'/index.php', "w");
       $myid = '$mid';
       fwrite($f, "
       <?php
       ".$myid." = '".$a['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'posts/pst/index.php';
      ?>
       ");
       fclose($f);
       die("<script>
       function Redirect() {
           window.location='../profile.php';
       }
       setTimeout('Redirect()', 1)</script>
       ");
      }
      else {
        $pstcont = sanitizeString($_POST['sendposts']);
    $pstst = sanitizeString($_POST['ispost']);
    $timeofupdate = time();
    $pnl = 0;
    $pnc = 0;
    $id=0;
    $tun = 0;
    $tln = 0;
    $tnd = 0;
    $taggedusers = 0;
    $hasfile = 0;
    $nmbffiles = 0;
    $pinterest = sanitizeString($_POST['tagpost']);
    $pstcont = str_replace("\\r\\n", " \r\n ", $pstcont);
    $nsp = explode("\\r\\n", $pstcont);
    $alh = array();
    $erst = array();
    for($y = 0; $y < count($nsp); $y++){
      $new = explode(" ",$nsp[$y]);
      for($i = 0; $i < count($new); $i++){
      if(strpos($new[$i], "#") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "#");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        $ins = trim($ns);
        $ins = str_replace("\\r\\n", "", $ins);
        queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$pstst', '$timeofupdate')");
        $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$pstst'");
        if($cch->num_rows){
          $dce = mysqli_fetch_array($cch);
          $cn = $dce['numberofusages'];
          $increment = (int) ++$cn;
          queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$pstst'");
        }
        else {
          queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins', '$pstst','1', '$timeofupdate')");
        }
        array_push($alh, $ns);
        }
      }
      if(strpos($new[$i], "@") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "@");
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        array_push($erst, $ns);
      }
    }
    }
    for($p = 0; $p < count($alh); $p++){
      $ns = $alh[$p];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/tags/?hashtag=$sns").">"
        .$ns."</a>", $pstcont);
    }
    $erst = array_unique($erst);
    for($r = 0; $r < count($erst); $r++){
      $ns = $erst[$r];
      $tto = queryMysql("SELECT * FROM members WHERE user='".substr($ns, 1, strlen($ns))."'");
      if($tto->num_rows){
        $id = 0;
        $usertobenotified = substr($ns, 1, strlen($ns));
        if($user != $usertobenotified){
        $mot = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usertobenotified'"));
        $usertobenotified = $mot['user'];
        $i = 0;
        $notheading = "<b>You were mentioned in a post</b>";
        $notcontent = "$user mentioned you in a post";
        $hidenot = 0;
        $timeofnot = time();
        $notlink = '';
        queryMysql("INSERT INTO notifications VALUE('$id',
        '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink', '0','$timeofnot')"); 
       }
      }
    }
      /*if(strpos($splpstcont[$x], "@") !== false){
        $len = strlen($splpstcont[$x]);
          $gpoh = strpos($splpstcont[$x], "@");
          $st = $splpstcont[$x];
          $id = 0; 
          if(strpos($splpstcont[$x], '\\') !== false){
              $lp = strpos($splpstcont[$x], '\\');
              $ns = substr($splpstcont[$x], $lp);
              $ins = trim($ns);
              $ins = str_replace("\\r\\n", "", $ins);
            }
          else {
            $ns = substr($splpstcont[$x], 0);
            $ins = trim($ns);
            $ins = str_replace("\\r\\n", "", $ins);
          }
        $pstcont = str_replace($ns, "<a href=\'".htmlspecialchars("/students_connect/user/".substr($ns, 1, strlen($ns)))."\'>"
        .$ns."</a>", $pstcont);
      }
    }*/
    if($pstst == '0'){
      $pstst = sanitizeString($_POST['ispost']);
      queryMysql("INSERT INTO eduposts VALUES('$user', '$taggedusers', '$id',
       '$pstcont', '$pstst', '$timeofupdate', '0', '$user', '0','0','0',
       '$pnl', '$tun', '$tnd', '$pnc', '$pinterest')");
      queryMysql("INSERT INTO postviews VALUES('$id', '0')");
      $a = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE user='$user' AND timeofupdate='$timeofupdate' ORDER BY timeofupdate DESC"));
      if(!empty($_POST['opt1']) && !empty($_POST['opt2'])){
        $tpoid = $a['id'];
         $opt1 = sanitizeString($_POST['opt1']);
         $opt2 = sanitizeString($_POST['opt2']);
         $opt3 = sanitizeString($_POST['opt3']);
         $opt4 = sanitizeString($_POST['opt4']);
         $pst = sanitizeString($_POST['ispost']);
         $did = 0;
         $ts = time();
         $m = date("M")." ".$_POST['day']." ".$_POST['hour'].":".
        $_POST['minute']." ".$_POST['period'];
        if(($_POST['finishdate'] == date("M")) || strtotime($m) < time()){
          $et = strtotime("24 hours");
          }
          else {
          $et = strtotime($m);
          }
         queryMysql("INSERT INTO polls VALUES('$did', '$tpoid', '$pst', 
         '$opt1', '$opt2', '$opt3', '$opt4',
         '0', '0', '0', '0', '$ts', '$et')");
        }
      $gcd = getcwd();
       chdir("../posts");
       mkdir($a['id']);
       $f = fopen($a['id'].'/index.php', "w");
       $myid = '$mid';
       fwrite($f, "
       <?php
       ".$myid." = '".$a['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'posts/pst/index.php';
    ?>");
       fclose($f);
      $j =  mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE timeofupdate='$timeofupdate' AND user='$user'"));
            $nmf = count($_FILES['pstimg']['name']);
            for($i=0; $i < $nmf; $i++){
              $nnn = $_FILES['pstimg']['name'][$i];
              move_uploaded_file($_FILES['pstimg']['tmp_name'][$i],
              '../../students_connect_hidden/postuploads/'. $nnn);
              if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "image"){
                rename('../../students_connect_hidden/postuploads/'.$_FILES['pstimg']['name'][$i],
                 '../../students_connect_hidden/postuploads/'.$j['id'].'('.$i.').png');
                }
                if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "video"){
                  rename('../../students_connect_hidden/postuploads/'.$_FILES['pstimg']['name'][$i],
                   '../../students_connect_hidden/postuploads/'.$j['id'].'('.$i.').mp4');
                  }
                  if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "audio"){
                    rename('../../students_connect_hidden/postuploads/'.$_FILES['pstimg']['name'][$i],
                     '../../students_connect_hidden/postuploads/'.$j['id'].'('.$i.').mp3');
                    }
               echo "<script>
               function Redirect() {
                   window.location='../profile.php';
               }
               setTimeout('Redirect()', 1)</script>";
              }
          }
}
    }
    else {
      if(empty($_FILES['pstimg']['name'][0])){
      $pstst = sanitizeString($_POST['ispost']);
      queryMysql("INSERT INTO socposts VALUES('$user', '$taggedusers','$id',
       '$pstcont', '$pstst', '$timeofupdate', '0', '$user', '0','0','0',
       '$pnl', '$tln', '$tnd', '$pnc', '$pinterest')");
       queryMysql("INSERT INTO spostviews VALUES('$id', '0')");
       $a = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE user='$user' AND timeofupdate='$timeofupdate' ORDER BY timeofupdate DESC"));
       if(!empty($_POST['opt1']) && !empty($_POST['opt2'])){
        $tpoid = $a['id'];
         $opt1 = sanitizeString($_POST['opt1']);
         $opt2 = sanitizeString($_POST['opt2']);
         $opt3 = sanitizeString($_POST['opt3']);
         $opt4 = sanitizeString($_POST['opt4']);
         $pst = sanitizeString($_POST['ispost']);
         $did = 0;
         $ts = time();
         $m = date("M")." ".$_POST['day']." ".$_POST['hour'].":".
        $_POST['minute']." ".$_POST['period'];
        if(($_POST['finishdate'] == date("M")) || strtotime($m) < time()){
          $et = strtotime("24 hours");
          }
          else {
          $et = strtotime($m);
          }
         queryMysql("INSERT INTO polls VALUES('$did', '$tpoid', '$pst', 
         '$opt1', '$opt2', '$opt3', '$opt4',
         '0', '0', '0', '0', '$ts', '$et')");
        }
        $gcd = getcwd();
       chdir("../posts");
       mkdir("s".$a['id']);
       $f = fopen("s".$a['id'].'/index.php', "w");
       $myid = '$myid';
       fwrite($f, "
       <?php
       ".$myid." = '".$a['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'posts/pst/index.php';
    ?>");
    
       fclose($f);
       die("<script>
       function Redirect() {
           window.location='../profile.php';
       }
       setTimeout('Redirect()', 1)</script>
       ");
    }
    else {
      $pstst = sanitizeString($_POST['ispost']);
      queryMysql("INSERT INTO socposts VALUES('$user', '$taggedusers','$id',
       '$pstcont', '$pstst', '$timeofupdate', '0', '$user', '0','0','0',
       '$pnl', '$tln', '$tnd', '$pnc', '$pinterest')");
       queryMysql("INSERT INTO spostviews VALUES('$id', '0')");
       $a = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE user='$user' AND timeofupdate='$timeofupdate' ORDER BY timeofupdate DESC"));
       if(!empty($_POST['opt1']) && !empty($_POST['opt2'])){
       $tpoid = $a['id'];
        $opt1 = sanitizeString($_POST['opt1']);
        $opt2 = sanitizeString($_POST['opt2']);
        $opt3 = sanitizeString($_POST['opt3']);
        $opt4 = sanitizeString($_POST['opt4']);
        $pst = sanitizeString($_POST['ispost']);
        $did = 0;
        $ts = time();
        $m = date("M")." ".$_POST['day']." ".$_POST['hour'].":".
        $_POST['minute']." ".$_POST['period'];
        if(($_POST['finishdate'] == date("M")) || strtotime($m) < time()){
          $et = strtotime("24 hours");
          }
          else {
          $et = strtotime($m);
          }
        queryMysql("INSERT INTO polls VALUES('$did', '$tpoid', '$pst', 
        '$opt1', '$opt2', '$opt3', '$opt4',
        '0', '0', '0', '0', '$ts', '$et')");
       }
       $gcd = getcwd();
       chdir("../posts");
       mkdir("s".$a['id']);
       $f = fopen("s".$a['id'].'/index.php', "w");
       $myid = '$myid';
       fwrite($f, "
       <?php
       ".$myid." = '".$a['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'posts/pst/index.php';
    ?>");
       fclose($f);
    $j =  mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE timeofupdate='$timeofupdate' AND user='$user'"));
          $nmf = count($_FILES['pstimg']['name']);
          for($i=0; $i < $nmf; $i++){
            $nnn = $_FILES['pstimg']['name'][$i];
            move_uploaded_file($_FILES['pstimg']['tmp_name'][$i],
            '../../students_connect_hidden/postuploads/s/'. $nnn);
            if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "image"){
            rename('../../students_connect_hidden/postuploads/s/'.$_FILES['pstimg']['name'][$i],
             '../../students_connect_hidden/postuploads/s/'.$j['id'].'('.$i.').png');
            }
            if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "video"){
              rename('../../students_connect_hidden/postuploads/s/'.$_FILES['pstimg']['name'][$i],
               '../../students_connect_hidden/postuploads/s/'.$j['id'].'('.$i.').mp4');
              }
              if(substr($_FILES['pstimg']['type'][$i], 0, 5) == "audio"){
                rename('../../students_connect_hidden/postuploads/s/'.$_FILES['pstimg']['name'][$i],
                 '../../students_connect_hidden/postuploads/s/'.$j['id'].'('.$i.').mp3');
                }
             echo "<script>
             function Redirect() {
                 window.location='../profile.php';
             }
             setTimeout('Redirect()', 1)</script>";
            }
        }
}
}
else{
  echo "<script>
       function Redirect() {
           window.location='../profile.php';
       }
       setTimeout('Redirect()', 1)</script>";
} 
}
?> 