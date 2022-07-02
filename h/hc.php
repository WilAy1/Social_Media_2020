<?php
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
        '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink', '0', '$timeofnot')"); 
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
        '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')"); 
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
            }
        }
}
echo "<script>
window.history.replaceState('','', location.href);
</script>";
}

 $dsm = $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
 $user = $dsm['user'];
 // methods to fetch post
 // 1. posts from friends.
 // 2. Posts from interests.
 // 3. Posts from users in the same institution or are in the same institution and stufying the same course
 // 4. ....
 // 5. Posts from discover
 // from friends
 $myf = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
 $far = array();
 $puf = array();
 array_push($far, $user);
 while($f = mysqli_fetch_array($myf)){
  $trr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$f['friend']."') OR (user='".$f['friend']."' 
  AND touser='".$user."') OR (user='$user' AND touser='".$f['friend']."') OR 
  (user='".$f['friend']."' AND touser='".$user."')");
  if($trr->num_rows == 0){
  array_push($far, $f['friend']);
  array_push($puf, $f['friend']);
  }
}
$win = "'".implode("','",$far)."'";
// from interests
$myinterests = $dsm['interests'];
$exc = explode(",",$myinterests);
$nstr = '';
$oea = '';
$frre = '';
$adq = '';
for($i = 0; $i < count($exc); $i++){
  $nstr.= " OR pinterest LIKE '%".$exc[$i]."%'";
  $adq.= " OR sptags LIKE '%".$exc[$i]."%'";
  $oea.= " OR relatedto LIKE '%".$exc[$i]."%'";
  $frre.=" OR purpose LIKE '%".$exc[$i]."%' OR about LIKE '".$exc[$i]."'";
}
$last = strtotime("5 day ago");
$mlove = queryMysql("SELECT * FROM loves WHERE user='$user' AND timeoflike > $last ORDER BY timeoflike DESC");
$isq = [];
while($mlo = mysqli_fetch_array($mlove)){
  $mlov = number_format($mlo['id']);
  $llox = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$mlov'"));
  array_push($isq, $llox['user']);
}
$isq = array_values(array_unique($isq));
$mow = explode(',', $win);
for($i = 0; $i < count($isq); $i++){
  $mk = queryMysql("SELECT * FROM recommendations WHERE user='$user' AND rd='".$isq[$i]."'");
if((!in_array("'".$isq[$i]."'", $mow)) && (mysqli_num_rows($mk) == 0)){
  $win.=",'".$isq[$i]."'";
}
}
$mvote = queryMysql("SELECT * FROM votes WHERE user='$user' AND voted='upvote' AND timeofvote > $last");
$isq = [];
while($mlo = mysqli_fetch_array($mvote)){
  $mlov = number_format($mlo['id']);
  $llox = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$mlov'"));
  array_push($isq, $llox['user']);
}
$isq = array_values(array_unique($isq));
$mow = explode(',', $win);
for($i = 0; $i < count($isq); $i++){
  $mk = queryMysql("SELECT * FROM recommendations WHERE user='$user' AND rd='".$isq[$i]."'");
if((!in_array("'".$isq[$i]."'", $mow)) && (mysqli_num_rows($mk) == 0)){
  $win.=",'".$isq[$i]."'";
}
}
$ma = queryMysql("SELECT * FROM socposts WHERE user='$user' AND timeofupdate > $last
                  UNION ALL
                  SELECT * FROM eduposts WHERE user='$user' AND timeofupdate > $last");
while($gmaa = mysqli_fetch_array($ma)){
  if(!in_array($gmaa['user'], $mow)){
    $win.=",'".$gmaa['user']."'";
  }
}
$oak = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$koak = explode(',',$oak['interests']);
// from institution and course
$mycourse = $dsm['course'];
$myinstitution = $dsm['institution'];
if($mycourse != '' || $myinstitution != ''){

}
$ptime = time();
$lthidays = strtotime("20 day ago");
$surelyoccured = " AND id != ''";
$ssurelyoccured = " AND id != ''";
if($myf->num_rows){
$sltm = queryMysql("SELECT * FROM eduposts WHERE (user IN ($win) or sharedby IN ($win)$nstr $surelyoccured) 
                  OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
        UNION ALL
    SELECT * FROM socposts WHERE (user IN ($win) OR sharedby IN ($win)$nstr $ssurelyoccured) 
    OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
    ORDER BY timeofupdate DESC LIMIT 15");
      if($sltm->num_rows == 0){
                    echo "<div class='camp macamps'><div class='ho_fn_pes'><span class='qclose' style='cursor: pointer;'><i class='fas fa-times'></i></span>
                    <div class='wh_s_clo'><i class='fas fa-cloud'></i></div>
        <div class='wh_wrng'>Low on Posts or Old Posts?</div>
        <div class='wh_ca_do'>Take Actions Now</div>
        <div class='wh_u_wil_do'>
        <div class='wh_pkxd' style='width: fit-content; margin: auto;'>
        <div class='wh_flnpp'><a href='/students_connect/newpost'>Create Posts</a></div>
        <div class='wh_dise'><a href='/students_connect/suggestions'>Follow Someone</a></div>
        </div>
        <form action='/students_connect/search' method='GET'>
  <input type='hidden' value='$user' id='idde'>
  <input name='search' style='border: 1px solid #bebebe !important; border-radius: 20px' type='text' id='evsrch' class='evs_rch'' placeholder='
  Search and Follow a Friend'
  autocomplete='off' value='' />
  <span class='clsearch' onclick='clrs()' style='display: none;'>x</span>
  <button type='submit' style='border-radius: 20px; margin-left: 5px;' class='peeoo_rr xpeeoo_rr'><i class='fas fa-search'></i></button>
        </form>
        </div>
        </div></div>";
        $sltm = queryMysql("SELECT * FROM eduposts WHERE (id !='' $surelyoccured)
        AND timeofupdate BETWEEN $lthidays AND $ptime
        UNION ALL
          SELECT * FROM socposts WHERE (id != '' $ssurelyoccured)
          AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY timeofupdate, RAND() LIMIT 15");  
          if($sltm->num_rows==0){
            $lthidays = strtotime("100 days ago");
            $sltm = queryMysql("SELECT * FROM eduposts WHERE (user IN ($win) or sharedby IN ($win)$nstr $surelyoccured) 
                 OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
        UNION ALL
    SELECT * FROM socposts WHERE (user IN ($win) OR sharedby IN ($win)$nstr $ssurelyoccured) 
    OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
    ORDER BY timeofupdate DESC LIMIT 15");
      if($sltm->num_rows == 0){
        $sltm = queryMysql("SELECT * FROM eduposts WHERE (id !='' $surelyoccured)
        AND timeofupdate BETWEEN $lthidays AND $ptime
        UNION ALL
          SELECT * FROM socposts WHERE (id != '' $ssurelyoccured)
          AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 15");
      }
          } 
      }
      if($sltm->num_rows <= 5){
    echo "<div class='camp macamps'><div class='ho_fn_pes'><span class='qclose' style='cursor: pointer;'><i class='fas fa-times'></i></span>
    <div class='wh_s_clo'><i class='fas fa-cloud'></i></div>
        <div class='wh_wrng'>Low on Posts or Old Posts?</div>
        <div class='wh_ca_do'>Take Actions Now</div>
        <div class='wh_u_wil_do'>
        <div class='wh_pkxd' style='width: fit-content; margin: auto;'>
        <div class='wh_flnpp'><a href='/students_connect/newpost'>Create Posts</a></div>
        <div class='wh_dise'><a href='/students_connect/suggestions'>Follow Someone</a></div>
        </div>
        <form action='/students_connect/search' method='GET'>
  <input type='hidden' value='$user' id='idde'>
  <input name='search' style='border: 1px solid #bebebe !important; border-radius: 20px' type='text' id='evsrch' class='evs_rch'' placeholder='
  Search and Follow a Friend'
  autocomplete='off' value='' />
  <span class='clsearch' onclick='clrs()' style='display: none;'>x</span>
  <button type='submit' style='border-radius: 20px; margin-left: 5px;' class='peeoo_rr xpeeoo_rr'><i class='fas fa-search'></i></button>
        </form>
        </div>
        </div></div>";
      }
}
else {
      echo "<div class='camp macamps'><div class='ho_fn_pes'><span class='qclose' style='cursor: pointer;'><i class='fas fa-times'></i></span>
      <div class='wh_s_clo'><i class='fas fa-cloud'></i></div>
        <div class='wh_wrng'>Low on Posts or Old Posts?</div>
        <div class='wh_ca_do'>Take Actions Now</div>
        <div class='wh_u_wil_do'>
        <div class='wh_pkxd' style='width: fit-content; margin: auto;'>
        <div class='wh_flnpp'><a href='/students_connect/newpost'>Create Posts</a></div>
        <div class='wh_dise'><a href='/students_connect/suggestions'>Follow Someone</a></div>
        </div>
        <form action='/students_connect/search' method='GET'>
  <input type='hidden' value='$user' id='idde'>
  <input name='search' style='border: 1px solid #bebebe !important; border-radius: 20px' type='text' id='evsrch' class='evs_rch'' placeholder='
  Search and Follow a Friend'
  autocomplete='off' value='' />
  <span class='clsearch' onclick='clrs()' style='display: none;'>x</span>
  <button type='submit' style='border-radius: 20px; margin-left: 5px;' class='peeoo_rr xpeeoo_rr'><i class='fas fa-search'></i></button>
        </form>
        </div>
        </div></div>";
  $sltm = queryMysql("SELECT * FROM  eduposts WHERE (id != '' $surelyoccured)
  AND timeofupdate BETWEEN $lthidays AND $ptime
  UNION ALL
    SELECT * FROM socposts WHERE (id !='' $ssurelyoccured)
    AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 15");
}
if(($oak['interests'] == '0') || (count($koak) < 3)){
  $ltags = ["Arts", "Science", "Computer", 
  "Programming", "Mathematics", "Physics", "Literature", "Chemistry", "Biology", "English", 
  "Book Keeping", "Languages", "Data Science"];
  echo "<div class='camp macamps'>
  <div class='ho_fn_pe'><span class='qclose' style='cursor: pointer;'><i class='fas fa-times'></i></span>
      <div class='h_sh_e'>Add to Your Interests <span class='ad_new_tag' style='padding-left: 6px'><a href='/settings/account/' target='_blank'><i class='fas fa-plus'></a></i></span></div></div><div class='wh_s_cl'>";
      for($i = 0; $i < count($ltags); $i++){
        if(!in_array($ltags[$i], $koak)){
        echo "<div class='tag_but' style='display: inline-block;'>
        <button class='tagbut' value='".$ltags[$i]."' style='margin: 3px 5px;'>".$ltags[$i]."</button></div>";
      }
    }
      echo "</div></div>"; 
}
// friends suggestion
/*
  Getting friends suggestions,
  1. freinds of friends
  2. friends from institution
  3. friends in the perimeter of your surroundings
  4. people following you which you aren't following but friends are following
  5. category of people you follow
  6. ....
*/
// list of friends in $nwin, friends of friends in $nwin in $suglist
$nwin = "'".implode("','", $puf)."'";
$suglist = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend != '$user'");
$fl = array();
while($gs = mysqli_fetch_array($suglist)){
  array_push($fl, $gs['friend']);
}
/*if($mycourse != '' & $myinstitution !=''){
  $lf = queryMysql("SELECT * FROM members WHERE course='$mycourse' AND institution='$myinstitution' AND user != '$user'");
  while($gl = mysqli_fetch_array($lf)){
    if(!in_array($gl['user'], $far)){
      array_push($fl, $gl['user']);
    }
  }
}
*/
$mfl = array_unique($fl);
$mfl = array_merge($mfl);
$agg = array();
for($i = 0; $i < count($mfl); $i++){
    $na = array($mfl[$i], count(array_keys($fl, $mfl[$i])));
    array_push($agg, $na);
}
for($r = 0; $r < count($agg); $r++){
  for($x = 0; $x < 1; $x++){
    //echo $agg[$r][$x].'=>'.$agg[$r][$x+1];
  }
}
$adsspace = array();
for($i = 0; $i < 3; $i++){
    array_push($adsspace, rand(3, 15));
}
$forumspace = array();
for($x = 0; $x < 6; $x++){
  array_push($forumspace, rand(1, 20));
}
$suggestedspace  = array();
for($x = 0; $x<2; $x++){
  array_push($suggestedspace, rand(1, 10));
}
$discoveradspace = array();
array_push($discoveradspace, rand(3, 15));
$forumadspace = array(rand(3, 15));
$commentspace = array();
$hcsp = rand(1, 7);
for($k = 0; $k < $hcsp; $k++){
  array_push($commentspace, rand(1, 15));
}
$e = 0;
if($mbs['status'] == '1' || $mbs['status']== '2'){
while(($medu = mysqli_fetch_array($sltm)) && $e < count($medu)){
  $trr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$medu['user']."') OR (user='".$medu['user']."' 
  AND touser='".$user."') OR (user='$user' AND touser='".$medu['sharedby']."') OR 
  (user='".$medu['sharedby']."' AND touser='".$user."')");
  if($trr->num_rows == 0){
  if($medu['pstst'] == 0){
    $surelyoccured.=" AND id != '".$medu['id']."'";
  }
  else {
    $ssurelyoccured.=" AND id != '".$medu['id']."'";
  }
  for($l = 0; $l < count($commentspace); $l++){
    //queryMysql("SELECT * FROM ");
  }
  //$studco_ad_images = array("/students_connect_hidden/ads/mesimg1.png", "/students_connect_hidden/ads/mesimg2.png", "/students_connect/ico/StudCo.png");
  for($x = 0; $x < count($adsspace); $x++){
    $qguess = queryMysql("SELECT * FROM ads WHERE expired='0' AND  (sptags != '' $adq) ORDER BY RAND()");
    if($adsspace[$x] == $e && $qguess->num_rows){
      $qg = mysqli_fetch_array($qguess);
      $ent = $qg['entity'];
      if($qg['adtype'] == '1'){
        $qgu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$ent."'"));
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png")){
          $umld = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png";
        }
        else {
          $umld = '/students_connect/user.png';
        }
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png")){
          $ucov = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png";
          $ywi = "<img src='".$ucov."' class='wilfad_cv_img'/>";
        }
        else {
          $ywi = '';
          $ucov = '';
        }
        echo "<div class='wilfad_sp'>
        <div class='wilfad_spfus'>
        <div class='wilfad_cont'>
        <div class='wilfad_mg'>
        <div class='wilfad_yaj'>
        <div class='wilfad_cv' style='background-image: url(\"".$ucov."\")'></div>
        ".$ywi."
        </div>
        <div class='wilfad_gam'>
        <div class='wilfad_dp' style='background-image: url(\"".$umld."\");'></div>
        <img src='".$umld."' class='wilfad_dp_img'/>
        </div></div>
        <div class='wilfad_info'>
        <div class='wilfad_name'>
        <a href='/students_connect/user/".$qgu['user']."'>
        <div class='wilfad_fname'>".$qgu['firstname']." ".$qgu['surname']."</div>
        <div class='wilfad_uname'><i class='fas fa-at'>".$qgu['user']."</i></div>
        </a></div>
        <div class='wilfad_abt'>".$qgu['about']."</div>
        </div>
        <div class='wilfad_btns'><button class=''>Follow</button></div>
        </div>
        </div>
        <div class='t_ad_tag'>Ad by StudCo</div>
        </div>";
      }
      elseif($qg['adtype'] == '2'){
        if($qg['ispostid'] == '0'){
          $mj = 'eduposts';
        }
        elseif($qg['ispostid'] == '1'){
          $mj = 'socposts';
        }
        $gm = queryMysql("SELECT * FROM $mj WHERE id='".$qg['extracontent']."'");
        if($gm->num_rows){
          $agm = mysqli_fetch_array($gm);
          echo "<div class='wilfad_sp'>
          <div class='wilfad_spfus'>
          <div class='wilfad_cont'>
          
          </div>
          <div class='t_ad_tag'>Ad by StudCo</div>
          </div></div>";
        }
        elseif($gm['adtype'] == '3'){
          //is special
          echo "<div class='wilfad_sp'>
          <div class='wilfad_spfus'>
          <div class='wilfad_cont'>
          
          </div>
          <div class='t_ad_tag'>Ad by StudCo</div>
          </div></div>";
        }
      }

      /*$tu = array_rand($studco_ad_images, 1);
      $imgtu = $studco_ad_images[$tu];
      $ad_t = nl2br("At studco we work together to make the world a better place.
      Better for me, better for you, together we flow with studco.");
      echo "<div class='s_cus_ad'>
      <div class='ad_container'>
      <div class='t_ad_tag'>Ad by StudCo</div>
      <div class='ad_img' style='background-image: url(\"".$imgtu."\")'>
      </div>
      <div class='ad_text'><div class='main-ad-text'>".$ad_t."</div></div>
      </div>
      <div class='ad_go_tosite'>
      Go to site <i class='fas fa-external-link-alt ad_link_tag'></i>
      </div>
      </div>";*/
    }
  }
  for($x = 0; $x < count($suggestedspace); $x++){
    if($suggestedspace[$x] == $e){
      $ts = '';
      $rs = '';
      for($r = 0; $r < count($agg); $r++){
        for($x = 0; $x < 1; $x++){
          /*echo $agg[$r][$x].'=>'.$agg[$r][$x+1]*/
          $ts.=" OR user = '".$agg[$r][$x]."'";;
        }
      }
      for($i = 0; $i < count($mow); $i++){
        $q = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend=".$mow[$i]."");
        if(($mow[$i] != "'".$row['user']."'")&&($q->num_rows == 0)){
        $ts.=" OR user = ".$mow[$i]."";
      }
    }
      $rs = substr($rs, 3, strlen($rs));
      $nts = substr($ts ,3, strlen($ts));
      if($nts == ''){
        $nts = "user != ''";
      }
      if(!isset($occr)){
        $occr ="user != ''";
        }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      $lry = [];
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
            array_push($lry, $gfsg['user']);
        }
      }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      if((mysqli_num_rows($fsg) > 0) && (count($lry) > 0)){
      echo "<div class='wh_cant'>
      <div class='s_fo_you'>Suggested for you</div>
      <div class='th_li_st'>";
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
        $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/".$gfsg['user'].'/');
      if(file_exists($gfsg['user'].".png")){ 
        $cimg =  '/students_connect_hidden/users_profile_upload/'.$gfsg['user'].'/'.$gfsg['user'].'.png';  
      }
        else {
          chdir($td);
            $cimg =  '/students_connect/user.png';
        }
        if(file_exists('cover/cover.png')){
          $odma = "<div class='atbck' style=\"background-image: url('/students_connect_hidden/users_profile_upload/".$gfsg['user']."/cover/cover.png')\"></div>";
        }
        else {
          $odma = "<div class='atbck' style='background: brown;'></div>";
        }
        chdir($td);
        $eot = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend='".$gfsg['user']."' ORDER BY RAND()");
        $nae = mysqli_num_rows($eot)-1;
        $geot = mysqli_fetch_array($eot);
        echo "
           <div class='on_u_a_Tm'>
           <div class='p_l_atf'>
           <a  href='/students_connect/user/".$gfsg['user']."'>
           ".$odma."
           <div class='cna_aam'>
           <div class='na_aam' style='background-image:url(\"".$cimg."\")' title='".$gfsg['user']." suggested' width='96' height='96'></div>
           <div class='t_fna_m'>
           <div class='p_e_pep'>
           <div class='_m'>
           ".$gfsg['surname']." ".$gfsg['firstname']."
           </div>
           <div class='th_un_m'><i class='fas fa-at'></i>".$gfsg['user']."</div>
           </div>";
           if($eot->num_rows > 0){
           echo "<div class='s_fflw1b'><i class=''>followed by <i class='fas fa-at'></i><span class='s_norm1al'>".$geot['user']."</span></i></div>";
           }
           /*elseif($dsm['institution'] == $gfsg['institution']){
             $xatt = '';
             $att = '';
             if($dsm['status'] == 1){
               $xat = ' aspirant';
             }
             elseif ($dsm['status'] == 2){
               $att = 'attending ';
             }
             else {
               $att = 'attended ';
             }
             echo "<div class='s_fflw1b'><i class=''>$att
             <span class='s_knorm21l'>".$gfsg['institution']."$xat</span></i></div>";
           }*/
           echo "</div></a><div class='o_m_d s_trbt1s'>
           <div class='s_bt1rss h_f_taag'>
           <input type='hidden' value='".$gfsg['user']."'>
           <i class='fas fa-rss'></i>Follow</div>
           </div>
           </div>
           </div></div>";
           $occr .= " AND user != '".$gfsg['user']."'";
      }
    }
      echo "<div class='s_mm_re'>See More</div>";
      echo "</div></div>";
  }
    }
  }
  /*if($e ==  $discoveradspace[0]){
      $oea = substr($oea, 3, strlen($oea));
      $dm = queryMysql("SELECT * FROM discoverfollowers WHERE user='$user'");
      if($dm->num_rows){
        $ooel = '';
      while($dsm = mysqli_fetch_array($dm)){
        $did = $dsm['discoverid'];
        $eex = queryMysql("SELECT * FROM discover WHERE id='$did'");
        while($mex = mysqli_fetch_array($eex)){
          if(strpos($ooel, $mex['relatedto']) == false){
          $ooel .= "OR relatedto LIKE '%".$mex['relatedto']."%'";
        }
      }
      }
      }
      else {
        $ooel = '';
      }
      $d = queryMysql("SELECT * FROM discover WHERE $oea $ooel ORDER BY RAND()");
      if($d->num_rows==0){
          $d = queryMysql("SELECT * FROM discover ORDER BY RAND()");
      }
      echo "<div class='disc_o_vr_spa'>
      <div class='discoveR_rr'>Discover <i class='fas fa-globe s_e12wor' style='float: right;'></i></div>
      <div class='s_abab2y'>";
      while ($ged = mysqli_fetch_array($d)) {
        $mid = $ged['id'];
        $llx = queryMysql("SELECT * FROM discoverfollowers WHERE discoverid='$mid' AND user='$user'");
        if($llx->num_rows == 0){
        $dname = strlen($ged['discovername']) > 30 ? substr($ged['discovername'], 0, 30).'&hellip;
        ' : $ged['discovername'];
        $dabt = strlen($ged['discoverabout']) > 40 ? substr($ged['discoverabout'], 0, 40).'&hellip;
        ' : $ged['discoverabout'];
        $td = getcwd();
        chdir("../../students_connect_hidden/discover_profile/");
        if(file_exists($ged['id'].".png")){ 
           $dpimg =  '/students_connect_hidden/discover_profile/'.$ged['id'].'.png';  
        }
        else {
           chdir($td);
            $dpimg =  '/students_connect/user.png';
         }
        chdir($td);
        $nov = $ged['numberoffollowers'];
                  if($nov == 0){
                    $nofv = "0";
                  }
                  elseif($nov == 1){
                    $nofv = '1';
                  }
                  elseif($nov > 1 && $nov < 1000){
                    $nofv = $nov;
                  }
                  elseif($nov >= 1000 && $nov < 10000){
                    $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."k";
                  }
                  elseif($nov >= 10000 && $nov < 100000){
                    $nofv = substr($nov, 0, 2).".".substr($nov, 2, 1)."k";
                  }
                  elseif($nov >= 100000 && $nov < 1000000){
                    $nofv = substr($nov, 0, 3).".".substr($nov, 3, 1)."k";
                  }
                  elseif($nov >= 1000000 && $nov < 99999999){
                    $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."M";
                  }
        echo "<div class='s_cov11er' style='background-image:url(\"$dpimg\")'>
        <div class='s_ins09x'>
        <div class='s_img101x' style='background-image:url(\"$dpimg\")'></div>
        <div class='s_i1prop'>
        <div class='s_ea71sc'>".$dname."</div>
        <div class='s_ea72sc'>".$dabt."</div>
        </div>
        <div class='s_trbt1s'>
        <div class='s_bt1rss s_allgnr'>
        <span class='s_noo1xf'>".$nofv."</span><i class='fas fa-rss'></i> follow</div>
        <div class='s_bt1can s_allgnr'>
        <i class='fas fa-times'></i>
        </div>
        </div>
        </div>
        </div>";
        }
      }
      echo "</div>
      </div>";     
  }
  if($forumadspace[0] == $e){
    $frre = substr($frre, 3, strlen($frre));
    $eif = queryMysql("SELECT * FROM forummembers WHERE (user IN ($nwin) AND user != '$user')
                      OR (user = '$user' AND isacknoledged = '2')");
    $fla = '';
    while($oeif = mysqli_fetch_array($eif)){
      $fla.= "OR id = '".$oeif['forumid']."'";
    }
    $if = queryMysql("SELECT * FROM forums WHERE typeofforum != '1' AND $frre $fla");
    echo "<div class='disc_o_vr_spa'>
      <div class='discoveR_rr'>Suggested Forums <i class='fas fa-users s_e12wor' style='float: right;'></i></div>
      <div class='s_abab2y'>";
    if($if->num_rows == 0){
      $if = queryMysql("SELECT * FROM forums WHERE typeofforum != '1' ORDER BY RAND()");
    }
    while($gif = mysqli_fetch_array($if)){
      $feid = $gif['id'];
        $llx = queryMysql("SELECT * FROM forummembers WHERE forumid='$feid' AND user='$user'");
        if($llx->num_rows == 0){
        $dname = strlen($gif['nameofforum']) > 30 ? substr($gif['nameofforum'], 0, 30).'&hellip;
        ' : $gif['nameofforum'];
        $dabt = strlen($gif['about']) > 40 ? substr($gif['about'], 0, 40).'&hellip;
        ' : $gif['about'];
        $td = getcwd();
        chdir("../../students_connect_hidden/forum_profile_upload/");
        if(file_exists($gif['id'].".png")){ 
           $dpimg =  '/students_connect_hidden/forum_profile_upload/'.$gif['id'].'.png';  
        }
        else {
           chdir($td);
            $dpimg =  '/students_connect/user.png';
         }
        chdir($td);
        $nov = $gif['numberofmembers'];
                  if($nov == 0){
                    $nofv = "0";
                  }
                  elseif($nov == 1){
                    $nofv = '1';
                  }
                  elseif($nov > 1 && $nov < 1000){
                    $nofv = $nov;
                  }
                  elseif($nov >= 1000 && $nov < 10000){
                    $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."k";
                  }
                  elseif($nov >= 10000 && $nov < 100000){
                    $nofv = substr($nov, 0, 2).".".substr($nov, 2, 1)."k";
                  }
                  elseif($nov >= 100000 && $nov < 1000000){
                    $nofv = substr($nov, 0, 3).".".substr($nov, 3, 1)."k";
                  }
                  elseif($nov >= 1000000 && $nov < 99999999){
                    $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."M";
                  }
        echo "<div class='s_cov11er' \*style='background-image:url(\"$dpimg\")'>
        <div class='s_ins09x'>
        <div class='s_img101x' style='background-image:url(\"$dpimg\")'></div>
        <div class='s_i1prop'>
        <div class='s_ea71sc'>".$dname."</div>
        <div class='s_ea72sc'>".$dabt."</div>
        </div>
        <div class='s_trbt1s'>
        <div class='s_bt1rss s_allgnr'>
        <span class='s_noo1xf'>".$nofv."</span><i class='fas fa-plus'></i> Join</div>
        <div class='s_bt1can s_allgnr'>
        <i class='fas fa-times'></i>
        </div>
        </div>
        </div>
        </div>";
      }
    }
    echo "</div></div>";
  }
/*  for($x = 0; $x < count($forumspace); $x ++){
    if($forumspace[$x] == $e){
      $mml = queryMysql("SELECT * FROM forummembers WHERE user='$user'");
      if($mml->num_rows > 0){
      $fss = '';
      if(!isset($alreadyoccured)){
      $alreadyoccured = "id != ''";
      }
      while($gnml = mysqli_fetch_array($mml)){
        $fss.=" OR forumid='".$gnml['forumid']."'";
      }
      $fss = substr($fss, 3, strlen($fss));
      $me = queryMysql("SELECT * FROM forumposts WHERE ($fss) AND ($alreadyoccured) ORDER BY RAND()");
      if($me->num_rows){
      $fme = mysqli_fetch_array($me);
      $moe = mysqli_fetch_array(queryMysql("SELECT * FROM forums WHERE id='".$fme['forumid']."'"));
      $alreadyoccured.= " AND id != '".$fme['id']."'";
    $pusr = $fme['user'];
    $tui = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$pusr'")); 
    $ttime = $fme['dateofpost'];
          $ctime = time();
          if(($ctime - $ttime) < 60){
            $ftime = (int) $ctime - $ttime;
            $ftime.="s";
          }
          elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
            $ftime = (int) (($ctime - $ttime)/60);
            $ftime.= "m";
          } 
          elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
            $ftime = (int) (($ctime - $ttime)/3600);
            $ftime .=  "h";
          }
          elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
            $x = (int)(($ctime - $ttime));
            if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
              $ftime = 'Yesterday at '.date("h:i a", $ttime);
            }
            else {
              $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
            }
          }
          else {
            $ftime = date("M d h:i a", $ttime);
          }
          $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='0'>
                  <input type='hidden' value='".$fme['id']."'>
                  <input type='hidden' value='".$user."'>
                  Open Comments</div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($fme['user'] == $user){
                    $xet = "<div class='tb_y'>Delete Post</div>";
                    $xyt = '';
                    $xzt = '';
                  }
    echo '<div class="camp macamps">      
    <div class="amps" id="f'.$fme['id'].'">
    <div class="esign" style="float: right; cursor: pointer;">
    <div class="tesmby"><i class="fas fa-ellipsis-v vert"></i></div>
    <div id="myDropdown$sid" class="std_yx">
            '.$xot.'
            '.$xyt.'
            '.$xzt.'
            '.$xet.'
            </div>
            </div>
            <div class="namp">';
                $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/".$fme['user'].'/');
                if(file_exists($fme['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$fme['user'].'/'.$fme['user'].'.png';  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$fme['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$tui['surname']." ".$tui['firstname']."</a> <span class='f_n_am_ee'>
                  <a href='/students_connect/f/".$moe['id']."'>(".$moe['nameofforum'].")</a></span></div></div>
          </div>";
          echo '<div class="mpst" id="mpst'.$fme['id'].'">';
          $content = strip_tags($fme['contentofpost']);
          $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
          <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
          Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
          $pstcut = rhash($pstcut);
          echo nl2br($pstcut).'</div>';
                  $tpeid = $fme['id'];
                  $etime = time();
                  $polc = queryMysql("SELECT * FROM forumpolls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $clc = queryMysql("SELECT * FROM forumpollbase WHERE user='$user' AND pid='$tpeid' AND pstst='0'");
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM forumpolls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        $sfo = "<i class='far fa-circle c_y'></i>";
                      $fto = "<i class='far fa-circle c_y'></i>";
                      $ftho = "<i class='far fa-circle c_y'></i>";
                      $ffour = "<i class='far fa-circle c_y'></i>";
                      $buttons = '';
                      $tBg = $sbg = $fbg = $obg = '';
                      $vct = '';
                      $uct = '';
                      $xct = '';
                      $oct = '';
                      if($clc->num_rows){
                        if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                          $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          }
                          else {
                            $x1v = $x2v = $x3v = $x4v = ''; 
                          }
                        $buttons = 'disabled';
                        $clck = mysqli_fetch_array($clc);
                        if($clck['clicked'] == 1){
                         $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                         $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                              background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 2){
                          $fto = "<i class='fas fa-check-circle c_x'></i>";
                          $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 3){
                          $ftho = "<i class='fas fa-check-circle c_x'></i>";
                          $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 4){
                          $ffour = "<i class='fas fa-check-circle c_x'></i>";
                          $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                    }
                      echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                      ".$sfo."".$gpo['opt1']."
                      <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                      <input type='hidden' id='usr1' value='".$row['user']."'>
                      <input type='hidden' value='".$fme['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                      .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                      <input type='hidden' id='usr2' value='".$row['user']."'>
                      <input type='hidden' value='".$fme['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts'>
                      <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                      .$ftho."".$gpo['opt3']."
                      <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                      <input type='hidden' id='usr3' value='".$row['user']."'>
                      <input type='hidden' value='".$fme['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts'>
                      <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                      .$ffour."".$gpo['opt4']."
                      <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                      <input type='hidden' id='usr4' value='".$row['user']."'>
                      <input type='hidden' value='".$fme['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls4'>".$oct."</span>
                      </button>
                      </div>
                      </div>
                      <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                       $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                      </div>";
                    }
                    else {
                      $polc = queryMysql("SELECT * FROM forumpolls WHERE pid='$tpeid' AND pstst='0'");
                      if($polc->num_rows){
                        $gpo = mysqli_fetch_array($polc);
                        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM forumpolls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                        $buttons = 'disabled';
                        echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1'>
                      ".$gpo['opt1']."
                      
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                      .$gpo['opt2']."
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts'>
                      <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                      .$gpo['opt3']."
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts'>
                      <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                      .$gpo['opt4']."
                      <span id='ls4'>".$oct."</span>
                      </button>
                      </div>
                      </div>
                      <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                       $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                      </div>";
                      } 
                    }
                    $arr = array();
                    $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/f/");
                    for($i = 0; $i < 2; $i++){ 
                        if(file_exists($fme['id']."(".$i.").png")){
                          $files[$i] = "/Students_connect_hidden/postuploads/f/".$fme['id']."(".$i.").png";
                          array_push($arr, $files[$i]);
                        }
                      }
                      
                      chdir($td);
                  $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                    echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                    $td = getcwd();
                      chdir("../../students_connect_hidden/postuploads/f/");
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists($fme['id']."(".$i.").png")){  
                        echo "
                        <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/f/".$fme['id']."(".$i.").png'></div>";
                  }
                      else {
                        echo "";                     }
                      }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($fme['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/f/".$fme['id']."(0).mp4' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  echo "</div></div>";
                  echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($fme['id']."(0).mp3")){
                      echo "
                      <div class='postaudio'>
                      
                      <audio controls class='paudio'>
                      <source src='/students_connect_hidden/postuploads/f/".$fme['id']."(0).mp3' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  chdir($td);
                  echo '</div></div>
                  <div class="posted">'.$ftime.'</div>';
                  echo '
                  <div class="pwl"> ';
                  $nc = mysqli_fetch_array(queryMysql("SELECT * FROM forumpostviews WHERE id='".$fme['id']."'"));
                  $nov = $nc['views'];
                  if($nov == 0){
                    $nofv = "No views";
                  }
                  elseif($nov == 1){
                    $nofv = '1 view';
                  }
                  elseif($nov > 1 && $nov < 1000){
                    $nofv = $nov."views";
                  }
                  elseif($nov >= 1000 && $nov < 10000){
                    $nofv = substr($nov, 0, 1)."k views";
                  }
                  elseif($nov >= 10000 && $nov < 100000){
                    $nofv = substr($nov, 0, 2)."k views";
                  }
                  elseif($nov >= 100000 && $nov < 1000000){
                    $nofv = substr($nov, 0, 3)."k views";
                  }
                  elseif($nov >= 1000000 && $nov < 10000000){
                    $nofv = substr($nov, 0, 1)."M views";
                  }
                  $cmmnt = $fme['tncomments'];
                  if($cmmnt == 0){
                    $ans = "No answers";
                  }
                  elseif($cmmnt == 1){
                    $ans = '1 answer';
                  }
                  elseif($cmmnt > 1 && $cmmnt < 1000){
                    $ans = $cmmnt."answers";
                  }
                  elseif($cmmnt >= 1000 && $cmmnt < 10000){
                    $ans = substr($cmmnt, 0, 1)."k answers";
                  }
                  elseif($cmmnt >= 10000 && $cmmnt < 100000){
                    $ans = substr($cmmnt, 0, 2)."k answers";
                  }
                  elseif($cmmnt >= 100000 && $cmmnt < 1000000){
                    $ans = substr($cmmnt, 0, 3)."k answers";
                  }
                  elseif($cmmnt >= 1000000 && $cmmnt < 10000000){
                    $ans = substr($cmmnt, 0, 1)."M answers";
                  }
                  $fl = $fme['tnuvotes'];
                  if($fl == 1){
                    $other  = 'other';
                    global $other;
                  }
                  else {
                    $other = 'others';
                    global $other;
                  } 
                  $rwvot = $fme['tnuvotes'];
                  if($rwvot == 0){
                    $tvoc = "No reaction";
                  }
*///                  if($rwvot == 1){
//                    /*echo '
//                    <button type="submit" id="lbn">
//                    <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reaction</button>';
//                 */
//                  $tvoc = "1 reaction";
//                  }
//                  elseif($rwvot > 1){
//                   /*echo '
//                    <button type="submit" id="lbn">
//                    <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reactions</button>';
//                  */
//                  $tvoc = $fl." reactions";
//                  }
//                 $pid = $fme['id'];
//                  $dvs = queryMysql("SELECT *  FROM forumpostsvotes WHERE user='$user' AND postid='$pid'");
//                  if($dvs->num_rows){
//                    $dcolor = mysqli_fetch_array($dvs);
//                    if($dcolor['tov'] == 'upvote'){
/*                     $mcolor = 'color: green';
                    }
                    else {
                      $mcolor = "";
                    }
                    if($dcolor['tov'] == 'downvote'){
                      $scolor = 'color: red';
                    }
                    else {
                      $scolor = "";
                    } 
                  }
                  else {
                    $mcolor = "";
                    $scolor = "";
                  }
                echo "<div class='nfans tviews'><i class='fas fa-caret-up teyefig'
                 style='color: green; font-size: 15px !important; padding-top: 0px !important;'></i>
                <div class='nmbcfcnt nofviews'>".$tvoc."</div></div>
                <div class='separator'><i class='fas fa-dot-circle'></i></div>
                <div class='nfans tviews'><i class='far fa-comment teyefig'></i>
                <div class='nmbcfcnt nofviews'>".$ans."</div></div>
                <div class='separator'><i class='fas fa-dot-circle'>
                </i></div><div class='tviews'><i class='fas fa-eye teyefig'></i>
                <div class='nofviews'>".$nofv."</div></div>";
                echo '</div>
                <br><div class="undbtn"><div class="upv cmn dwn" id="fupv'.$fme['id'].'" 
                 onclick="fupvote(\''.$user.'\', \''.$fme['id'].'\', \''.$fme['forumid'].'\')"><span id="titg'.$fme['id'].'"
                 style="'.$mcolor.'"><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="fcntl'.$fme['id'].'"
                 style="color: inherit !important;">'.$fme['tnuvotes'].'</div>
                </div><div class="lwv cmn dwn" style="'.$scolor.'" id="fdwn'.$fme['id'].'" onclick="fdownvote(\''.$user.'\', \''.$fme['id'].'\', \''.$fme['forumid'].'\')"><span ><i class="fas fa-caret-down ycd" style="vertical-align: sub"></i></span></div>
                <div class="cmt cmn dwn" id="fcommt">
                <input type="hidden" value="'.$fme['id'].'">
                <input type="hidden" value="'.$fme['forumid'].'">
                <button type="button" class="sbm">
                <span><i class="far fa-comment dwtuc"></i></span>
                <div class="cnt cmn" id="fcntc'.$fme['id'].'">'.$fme['tncomments'].'</div></button></div>
                </div>';
                $fooc = queryMysql("SELECT * FROM forumscomment WHERE pid='".$fme['id']."' AND fid='".$fme['forumid']."' ORDER BY timeofcomment, tnc DESC");
                  if($fooc->num_rows){
                $gfooc = mysqli_fetch_array($fooc);
                  $mee = mysqli_fetch_arraY(queryMysql("SELECT * FROM members WHERE user='".$gfooc['user']."'"));
                  $ttime = $gfooc['timeofcomment'];
          $ctime = time();
          if(($ctime - $ttime) < 60){
            $ftime = (int) $ctime - $ttime;
            $ftime.="s";
          }
          elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
            $ftime = (int) (($ctime - $ttime)/60);
            $ftime.= "m";
                    } 
          elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
            $ftime = (int) (($ctime - $ttime)/3600);
            $ftime .=  "h";
          }
          elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
            $x = (int)(($ctime - $ttime));
            if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
              $ftime = 'Yesterday at '.date("h:i a", $ttime);
            }
            else {
              $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
            }
          }
          else {
            $ftime = date("M d h:i a", $ttime);
          }
                  $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/".$mee['user'].'/');
                if(file_exists($mee['user'].".png")){ 
                  $fnimg =  '/students_connect_hidden/users_profile_upload/'.$mee['user'].'/'.$mee['user'].'.png';  
                }
                  else {
                    chdir($td);
                      $fnimg =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='v_al_l'>
                  <div class='id_knw'>
                  <div class='t_fc_na_mq'>
                  <div class='devi_sjonimg' style='background-image: url(\"$fnimg\");'></div>
                  <div class='devi_sjon'>
                  <div class='tm_fc_nam'>
                  ".$mee['surname']." ".$mee['firstname']."</div>
                  <div class='tm_fc_unam'><i class='fas fa-at'></i>".$mee['user']."
                  </div>
                  </div>
                  </div>
                  <div class='pe_qq'>
                  ".$gfooc['cmt']."</div>
                  <div class='tm_fcc_bott'>".$ftime."</div>
                  <div class='all_ccee'>
                  <div class='aaaaa'><i class='fas fa-caret-up'></i></div>
                  <div class='aaaaa'><i class='fas fa-caret-down'></i></div>
                  <div class='aaaaa'><span class=''>Report</span></div>
                  </div>";
                  if($fooc->num_rows > 1){
//                  echo "<div class='vw_ff_more'>View all</div>";
//                }
//                  echo "</div>
//                  </div>";
//                }
//                echo "</div></div>";
//              }
//             }
//            }
  }
*/  
  $ttime = $medu['timeofupdate'];
          $ctime = time();
          if(($ctime - $ttime) < 60){
            $ftime = (int) $ctime - $ttime;
            $ftime.="s";
          }
          elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
            $ftime = (int) (($ctime - $ttime)/60);
            $ftime.= "m";
          } 
          elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
            $ftime = (int) (($ctime - $ttime)/3600);
            $ftime .=  "h";
          }
          elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
            $x = (int)(($ctime - $ttime));
            if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
              $ftime = 'Yesterday at '.date("h:i a", $ttime);
            }
            else {
              $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
            }
          }
          else {
            $ftime = date("M d h:i a", $ttime);
          }
          $my = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
                $ok = [];
                while($m = mysqli_fetch_array($my)){
                  array_push($ok, $m['friend']);
                }
          if((!in_array($medu['user'], $ok)) && (!in_array($medu['sharedby'], $ok)) && ($medu['user'] != $row['user']) && ($medu['sharedby'] != $row['user']) && (strpos($medu['pstcont'], '@'.$row['user']) == false)){
            echo "<div class='r_rcor'><span class='r_quip'>Recommended</span> <span class='r_notint'><button class='rnotint_b' value='".$medu['id'].", ".$medu['pstst']."'>Not Interested</button></span></div>";
          }
          if($medu['pstst'] == 0){
          $n = (queryMysql("SELECT pstcont FROM eduposts WHERE user='$user' AND sharedby='$user'"));
          $id = $medu['id'];
          $vot = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='upvote' ORDER BY timeofvote DESC");
          $chvot = mysqli_fetch_array($vot);
          $dwnp = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='downvote'");
          $chdwn = mysqli_fetch_array($dwnp);
          $rwvot = (int) mysqli_num_rows($vot); 
          $fl = $rwvot;
          $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY
           tun or tnc desc LIMIT 1"); 
          $mbse = mysqli_fetch_array(queryMysql("SELECT *FROM members WHERE user='".$medu['user']."'"));
          if($medu['isshare'] == 0){
                echo <<<PSTS
                  <div class='camp macamps'>
                  PSTS;
                  if($medu['pinterest'] != '0' || !empty($medu['pinterest']) || $medu['pinterest'] == NULL){
                    echo "<div class='phonetags' style='display: flex;'>";
                    $tg = explode(",",$medu['pinterest']);
                  sort($tg);
                  if(count($tg) <=4){
                  for($i = 0; $i < count($tg); $i++){
                  echo "
                  <div class='ttags' style='padding: 5px; dipslay: none; margin-right:6px;'>
                  <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                  }
                }
                else {
                  for($i = 0; $i < 4; $i++){
                    echo "
                    <div class='ttags' style='padding: 5px; margin-right:6px;'>
                    <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                    }
                    echo "<div class='ttags phown' id='trtags' style='padding: 5px; margin-right:6px;' onclick='disptOths()'>...</div>";
                }
                echo "<div class='smoretags' 
                  id='moretags' style='display: none;'>";
                for($i = 4; $i < count($tg); $i++){
                  echo "
                  <div class='ttags' style='padding: 5px; margin-right:6px;'>
                  <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
                  ";
                  
              echo "</div>";
                }
                echo "</div></div>";
              }
                  
                  
                  $sid = $medu['id'];
                  echo <<<PSTS
                   <div class='amps' id='
                  PSTS;
                  echo $medu['id']."'>";
                  $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='0'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['user'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='0'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                      <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$sid" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div>
                  </div>
                  PSTS;
                  if($medu['pinterest'] != '0' || !empty($medu['pinterest'])){
                  echo "<div class='ptags' style='float: right; display: flex;'>
                  ";
                  $tg = explode(",",$medu['pinterest']);
                  sort($tg);
                  if(count($tg) <=4){
                  for($i = 0; $i < count($tg); $i++){
                  echo "
                  <div class='ttags' style='padding: 5px; margin-right:6px;'>
                  <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                  }
                }
                else {
                  for($i = 0; $i < 4; $i++){
                    echo "
                    <div class='ttags' style='padding: 5px; margin-right:6px;'>
                    <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                    }
                    echo "<div class='ttags' id='zymbxs' style='padding: 5px; margin-right:6px;' onclick='dispOths()'>...</div>";
                }
                for($i = 4; $i < count($tg); $i++){
                  echo "<div class='ttags own' 
                  id='moretags' style='display: none; padding: 5px; margin-right:6px;'>
                  <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
                  </div>";
              }
              
              echo "</div>";
            }
                $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
                if(file_exists($medu['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  if($n->num_rows){
                    $en = ": ".mysqli_num_rows($n)." Post(s)";
                  }
                  else {
                    $en = "";
                  }
                  echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                  $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                  $tpeid = $medu['id'];
                  $etime = time();
                  $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='0'");
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        $sfo = "<i class='far fa-circle c_y'></i>";
                      $fto = "<i class='far fa-circle c_y'></i>";
                      $ftho = "<i class='far fa-circle c_y'></i>";
                      $ffour = "<i class='far fa-circle c_y'></i>";
                      $buttons = '';
                      $tBg = $sbg = $fbg = $obg = '';
                      $vct = '';
                      $uct = '';
                      $xct = '';
                      $oct = '';
                      if($clc->num_rows){
                        if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                          $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          }
                          else {
                            $x1v = $x2v = $x3v = $x4v = '0'; 
                          }
                        $buttons = 'disabled';
                        $clck = mysqli_fetch_array($clc);
                        if($clck['clicked'] == 1){
                         $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                         $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                              background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 2){
                          $fto = "<i class='fas fa-check-circle c_x'></i>";
                          $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 3){
                          $ftho = "<i class='fas fa-check-circle c_x'></i>";
                          $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 4){
                          $ffour = "<i class='fas fa-check-circle c_x'></i>";
                          $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                          background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                    }
                                    $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                      echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                      ".$sfo."".$gpo['opt1']."
                      <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                      <input type='hidden' id='usr1' value='".$row['user']."'>
                      <input type='hidden' value='".$medu['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                      .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                      <input type='hidden' id='usr2' value='".$row['user']."'>
                      <input type='hidden' value='".$medu['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts' $for>
                      <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                      .$ftho."".$gpo['opt3']."
                      <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                      <input type='hidden' id='usr3' value='".$row['user']."'>
                      <input type='hidden' value='".$medu['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts' $ffr>
                      <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                      .$ffour."".$gpo['opt4']."
                      <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                      <input type='hidden' id='usr4' value='".$row['user']."'>
                      <input type='hidden' value='".$medu['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls4'>".$oct."</span>
                      </button>
                      </div>
                      </div>
                      <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                       $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                      </div>";
                    }
                    else {
                      $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='0'");
                      if($polc->num_rows){
                        $gpo = mysqli_fetch_array($polc);
                        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                          $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          }
                          else {
                            $x1v = $x2v = $x3v = $x4v = '0'; 
                          }
                        
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                        $buttons = 'disabled';
                        $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                        echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1'>
                      ".$gpo['opt1']."
                      
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                      .$gpo['opt2']."
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts' $for>
                      <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                      .$gpo['opt3']."
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts' $ffr>
                      <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                      .$gpo['opt4']."
                      <span id='ls4'>".$oct."</span>
                      </button>
                      </div>
                      </div>
                      <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                       $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                      </div>";
                      } 
                    }
                    $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/".$medu['id']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    
                    chdir($td);
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                  echo '</div></div>';
                  echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp4")){
                    echo "
                    <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp4' type='video/mp4'>
                    </video></div>
                    <!--<iframe src='/students_connect/video/?t=".$medu['pstst']."&crvid=postuploads/".$medu['id']."(0).mp4' width='100%'
                    height='100%' frameBorder='0' autoplay; allow='accelerometer;encrypted-media; gyroscope; picture-in-picture;' allowfullscreen=''></iframe>
                    -->";                      
                }
                echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                chdir($td);
                  echo '</div></div>
                  <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                }
                else {
                  
                  echo <<<PSTS
                  <div class='camp macamps'>
                  PSTS;
                  echo <<<PSTS
                   <div class='amps' id='
                  PSTS;
                  echo $medu['id']."'>";
                  $xet = "";
                  $sid = $medu['id'];
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='0'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['sharedby'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='0'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                      <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$sid" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div>
                  </div>
                  PSTS;
                  //echo <<<PSTS
                //      <div class='ipt'></div><div class='namp'>
                //PSTS;
                $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                if(file_exists($mbss['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                  chdir($td);  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                  $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
                  echo nl2br($pstcute).'</div>';
                  $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
                  if(file_exists($mbse['user'].".png")){ 
                    $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                    chdir($td);  
                  }
                    else {
                      chdir($td);
                        $simg =  '/Students_connect/user.png';
                    }
                  echo "<div class='eap' style='padding-bottom: 40px;'>
                  <div class='tsp' onclick='op(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                   style='cursor: pointer; min-height: 120px;'>
                  <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['sharedpostid'].'">';
                  $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                  $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['sharedpostid']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                      echo "
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['sharedid']."(".$i.").png\")'></div>
                      <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div>
                  </div>';
                    echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($medu['sharedpostid']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['sharedpostid']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    <div class='audiops'>Audio</div>
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                  echo '</div></div></div></div>';
                  echo '<div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                }
                  echo '
                  <div class="pwl"> ';
                  $nc = mysqli_fetch_array(queryMysql("SELECT * FROM postviews WHERE id='".$medu['id']."'"));
                  $nov = $nc['views'];
                  if($nov == 0){
                    $nofv = "No views";
                  }
                  elseif($nov == 1){
                    $nofv = '1 view';
                  }
                  elseif($nov > 1 && $nov < 1000){
                    $nofv = $nov."views";
                  }
                  elseif($nov >= 1000 && $nov < 10000){
                    $nofv = substr($nov, 0, 1)."k views";
                  }
                  elseif($nov >= 10000 && $nov < 100000){
                    $nofv = substr($nov, 0, 2)."k views";
                  }
                  elseif($nov >= 100000 && $nov < 1000000){
                    $nofv = substr($nov, 0, 3)."k views";
                  }
                  elseif($nov >= 1000000 && $nov < 10000000){
                    $nofv = substr($nov, 0, 1)."M views";
                  }
                  $cmmnt = $medu['pnc'];
                  if($cmmnt == 0){
                    $ans = "No answers";
                  }
                  elseif($cmmnt == 1){
                    $ans = '1 answer';
                  }
                  elseif($cmmnt > 1 && $cmmnt < 1000){
                    $ans = $cmmnt."answers";
                  }
                  elseif($cmmnt >= 1000 && $cmmnt < 10000){
                    $ans = substr($cmmnt, 0, 1)."k answers";
                  }
                  elseif($cmmnt >= 10000 && $cmmnt < 100000){
                    $ans = substr($cmmnt, 0, 2)."k answers";
                  }
                  elseif($cmmnt >= 100000 && $cmmnt < 1000000){
                    $ans = substr($cmmnt, 0, 3)."k answers";
                  }
                  elseif($cmmnt >= 1000000 && $cmmnt < 10000000){
                    $ans = substr($cmmnt, 0, 1)."M answers";
                  }
                  if($fl == 1){
                    $other  = 'other';
                    global $other;
                  }
                  else {
                    $other = 'others';
                    global $other;
                  }
                    $dwns = "";
                  if($rwvot == 0){
                    $tvoc = "No reaction";
                  }
                  if($rwvot == 1){
                    /*echo '
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reaction</button>';
                  */
                  $tvoc = "1 reaction";
                  }
                  elseif($rwvot > 1){
                    /*echo '
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reactions</button>';
                  */
                  $tvoc = $fl." reactions";
                  }
                echo "<div class='nfans tviews'><i class='fas fa-caret-up teyefig'
                 style='color: green; font-size: 15px !important; padding-top: 0px !important;'></i>
                <div class='nmbcfcnt nofviews'>".$tvoc."</div></div>
                <div class='nfans tviews'><i class='far fa-comment teyefig'></i>
                <div class='nmbcfcnt nofviews'>".$ans."</div></div>
                
                <div class='tviews'><i class='fas fa-eye teyefig'></i>
                <div class='nofviews'>".$nofv."</div></div>";
                $geteducomment = mysqli_fetch_array($educomment);
                  $dvs = queryMysql("SELECT *  FROM votes WHERE user='".$row['user']."' AND id='".$medu['id']."'");
                  if($dvs->num_rows){
                    $dcolor = mysqli_fetch_array($dvs);
                    if($dcolor['voted'] == 'upvote'){
                      $mcolor = 'color: green';
                    }
                    else {
                      $mcolor = "";
                    }
                    if($dcolor['voted'] == 'downvote'){
                      $scolor = 'color: red';
                    }
                    else {
                      $scolor = "";
                    } 
                  }
                  else {
                    $mcolor = "";
                    $scolor = "";
                  }
                  echo '</div>
                  <div class="undbtn"><div class="upv cmn dwn" id="upv'.$medu['id'].'" 
                  style="'.$mcolor.'" onclick="upvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn cntfl" id="cntl'.$medu['id'].'"
                   style="color: inherit !important;">'.red($medu['tun']).'</div>
                  </div><div class="lwv cmn dwn" style="'.$scolor.'" id="dwn'.$medu['id'].'" onclick="downvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span style="vertical-align: sub"><i class="fas fa-caret-down ycd"></i></span></div>
                  <div class="cmt cmn dwn" id="commt" onclick="c(\''.$medu['id'].'\', \''.$row['user'].'\')">
                  <button type="button" class="sbm">
                  <span><i class="far fa-comment dwtwc"></i></span>
                  <div class="cnt cmn xod xess" id="cntc'.$medu['id'].'">'.red($medu['pnc']).'</div></button></div>
                  <div class="shr cmn dwn" style="padding: 10px;">
                  <span id="sh'.$medu['id'].'"><i class="fas fa-share"></i></span></div>
                  <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' closex"><i class="fas fa-arrow-left"></i></span>
                  <div class="sfff"><div class="shrtpst">Share Post</div>
                  <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="0">
                     Share</button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                  <div class="sam">Share as message</div>
                  <div class="rcntt"><input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                  $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' OR ftwo='$user' order by lasttimeofmessage desc limit 5");
                  if($mffs->num_rows==0){
                    echo 'No recently messaged user';
                  }
                  else {
                    while($gmffs = mysqli_fetch_assoc($mffs)){
                      if($row['user'] == $gmffs['fone']){
                        $nof = $gmffs['ftwo'];
                      }
                      else {
                        $nof = $gmffs['fone'];
                      }
                      echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$medu['id']."' onchange='gin(\"".$medu['id']."\")'>".$nof."</div>";
                    }
                  }
                  echo '<div class="orrsb"><div class="orrs">Others</div>';
                  $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND type='following'");
                  if($mfss->num_rows==0){
                    echo 'No recently messaged user';
                  }
                  else {
                    while($gmfss = mysqli_fetch_assoc($mfss)){
                      echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                    }
                  }
                  echo'</div></div><div id="countsend'.$medu['id'].'">
                  </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</buton>
                  </div>
                  </div>
                  </div></div>
                  ';
                  if(mysqli_num_rows($educomment) == 0){  
                    //leave space blank
                    echo "
                    <div class='comment_section' id='cmtedu".$medu['id']."'></div>";
                  }
                  else {
                    $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='".$row['user']."'
                     AND postid='".$medu['id']."'
                     AND commentid='".$geteducomment['id']."'"));
                     $pa = queryMysql("SELECT * FROM commentvotes WHERE user='".$row['user']."'
                     AND postid='".$medu['id']."'
                     AND commentid='".$geteducomment['id']."'");
                     if($pa->num_rows){
                     if($dpa['voted'] == 'upvote'){
                      $clrr = 'color: green';
                     }
                     else {
                       $clrr = '';
                     }
                     if($dpa['voted'] == 'downvote'){
                      $clerr = 'color: red';
                     }
                     else {
                       $clerr = '';
                     }
                   }
                   else {
                     $clrr = $clerr = '';
                   }
                     $gd = getcwd();
                     chdir("../../Students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/');
                     if(file_exists($geteducomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$geteducomment['user'].'/'.$geteducomment['user'].'.png';
                      chdir($gd);  
                    }
                      else {
                          $pimg =  '/students_connect/user.png';
                          chdir($gd);
                        }
                        chdir($gd);
                    $aus = $geteducomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    echo "
                    <div class='comment_section' id='cmtedu".$medu['id']."' style='background-color: rgba(245, 245, 245, 0.4);'>
                    <div class='commt_cont'>
                    <div class='uswc' style='display: flex;'>
                    <div class='fet'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div></div>
                    <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                    <div class='comcnt'>".wordwrap($geteducomment['cmt'], 60, "<br />")."</div>
                    <div class='posted'>".date('M d h:i a', $geteducomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                    <span onclick='ucm(\"".$medu['id']."\",
                     \"".$geteducomment['id']."\", \"".$mbs['user']."\")'>
                     <i class='fas fa-caret-up' style='$clrr' id='ror".$geteducomment['id']."'></i></span>
                    </div><div class='cdv ccmn cdwn'><span onclick='dcm(\"".$medu['id']."\",
                    \"".$geteducomment['id']."\", \"".$mbs['user']."\")'>
                    <i class='fas fa-caret-down' style='$clerr'
                     id='dror".$geteducomment['id']."'></i></span></div>
                    <div class='cshr ccmn cdwn' id='reply".$geteducomment['id']."'>
                    <button type='button' class='sbm' onclick='r(\"".$medu['id']."\", \"".$geteducomment['id']."\", \"".$row['user']."\")'><span><i class='fas fa-reply'></i></span></button></div>
                    <div class='cupv ccmn cdwn report'>Report</div>
                    </div>
                    </div></div>";
                  }
                  echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                    <textarea name="cmtedupst"  onkeyup="getkVal(event, \''.$mbs['user'].'\', this.value, 
                    \''.$medu['id'].'\')" class="albts" id="ecmttextarea'.$medu['id'].'" placeholder="Comment..."" value="" title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                    </div><div class="sndbtn"><label for="esendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                    <input type="hidden" name="postid" value="'.$medu['id'].'">
                    <input type="button" id="esendbutton'.$medu['id'].'" style="display: none !important;" onclick="sndEdu(\''.$mbs['user'].'\', document.getElementById(\'ecmttextarea'.$medu['id'].'\').value, 
                     \''.$medu['id'].'\')"/></div>
                    </div></div>';          
                  echo '</div></div>';
              }
              else {
                $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
        $id = $medu['id'];
        $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
        $chlov = mysqli_fetch_array($lov);
        $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
        $chdwn = mysqli_fetch_array($dwnp);
        $rwlov = (int) mysqli_num_rows($lov); 
        $fl = $rwlov - 1;
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
        $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='liked' AND id='".$medu['id']."'");
         $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='disliked' AND id='".$medu['id']."'");
       $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
       
       if($medu['isshare'] == 0){
      echo <<<PSTS
      <div class='camp macamps'>
      <div class='amps' id='soc
      PSTS;
      $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='1'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['user'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='1'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
      echo $medu['id']."'>";
      echo <<<PSTS
           <div class='ipt'></div><div class='namp'>
           <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$id" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div></div>
      PSTS;
      $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
      if(file_exists($medu['user'].".png")){ 
          $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
          chdir($td);
        }
      else {
        chdir($td);
         $img =  '/students_connect/user.png';
            }
          chdir($td);
      echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'
      ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
      <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
      <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
      echo '<div class="mpst" id="mpsts'.$medu['id'].'">';
      $content = strip_tags($medu['pstcont']);
      $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
      <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
      Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
      $pstcut = rhash($pstcut);
      echo nl2br($pstcut).'</div>';
                $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                  if($polc->num_rows){
                    $gpo = mysqli_fetch_array($polc);
                    $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='1'");
                    $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      
                      $sfo = "<i class='far fa-circle c_y'></i>";
                    $fto = "<i class='far fa-circle c_y'></i>";
                    $ftho = "<i class='far fa-circle c_y'></i>";
                    $ffour = "<i class='far fa-circle c_y'></i>";
                    $buttons = '';
                    $tBg = $sbg = $fbg = $obg = '';
                    $vct = '';
                    $uct = '';
                    $xct = '';
                    $oct = '';
                    if($clc->num_rows){
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = 0; 
                        }
                      $buttons = 'disabled';
                      $clck = mysqli_fetch_array($clc);
                      if($clck['clicked'] == 1){
                       $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                       $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                            background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 2){
                        $fto = "<i class='fas fa-check-circle c_x'></i>";
                        $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 3){
                        $ftho = "<i class='fas fa-check-circle c_x'></i>";
                        $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 4){
                        $ffour = "<i class='fas fa-check-circle c_x'></i>";
                        $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                  }
                                  $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                    echo "<div class='shpollpost'>
                    <div class='thopts'>
                    <div class='tfopt mopts'>
                    <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                    ".$sfo."".$gpo['opt1']."
                    <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                    <input type='hidden' id='usr1' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                    .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                    <input type='hidden' id='usr2' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                    .$ftho."".$gpo['opt3']."
                    <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                    <input type='hidden' id='usr3' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                    .$ffour."".$gpo['opt4']."
                    <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                    <input type='hidden' id='usr4' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                    </div>";
                  }
                  else {
                    $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='1'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = '0'; 
                        }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                      $buttons = 'disabled';
                      $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                      echo "<div class='shpollpost'>
                    <div class='thopts'>
                    <div class='tfopt mopts'>
                    <button class='lastpl p-1' id='p_1' $buttons value='1'>
                    ".$gpo['opt1']."
                    
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                    .$gpo['opt2']."
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                    .$gpo['opt3']."
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                    .$gpo['opt4']."
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                    </div>";
                    } 
                  }
                $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/s/");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';

                    if(file_exists($medu['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp4' type='video/mp4'>
                      </video>
                      </div>
                      ";              
                              
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>
                <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
              }
              else {
                
                  echo <<<PSTS
                  <div class='camp macamps'>
                  PSTS;
                  echo <<<PSTS
                   <div class='amps' id='
                  PSTS;
                  echo $medu['id']."'>";
                  $xet = "";
                  $sid = $medu['id'];
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='1'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['sharedby'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='1'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                      <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$sid" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div>
                  </div>
                  PSTS;
                  //echo <<<PSTS
                  //    <div class='ipt'></div><div class='namp'>
                //PSTS;
                $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                if(file_exists($mbss['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                  chdir($td);  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                  echo '<div class="mpst" id="mpsts'.$medu['id'].'" style="min-height: 30px;">';
                  $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
                  echo nl2br($pstcute).'</div>';
                  $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
                  if(file_exists($mbse['user'].".png")){ 
                    $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                    chdir($td);  
                  }
                    else {
                      chdir($td);
                        $simg =  '/Students_connect/user.png';
                    }
                  echo "<div class='eap' style='padding-bottom: 40px;'>
                  <div class='tsp' onclick='ops(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                   style='cursor: pointer; min-height: 120px;'>
                  <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                  echo '<div class="mpst" id="mpsts'.$medu['sharedpostid'].'">';
                  $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                  $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['sharedpostid']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/s");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($medu['sharedpostid']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['sharedpostid']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                  echo '</div></div></div>
                  </div>';
                  echo '<div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
              }
                echo '
                <div class="pwl"> ';
                if($fl == 1){
                  $other  = 'other';
                  global $other;
                }
                else {
                  $other = 'others';
                  global $other;
                }
                  global $dwns;
                
                if($lov->num_rows){
                if($chlov['user'] == $user){
                  $chlov['user'] = 'You';
                  if($rwlov == 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                }
                elseif($rwlov > 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                }
              }
              else {
                if($rwlov == 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                }
                elseif($rwlov > 1){
                  echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                }
              }
            }
              if($lvd->num_rows){
                $clr = 'color: rgb(255, 136, 156);';
                $far = 'fas';
              }
              else {
                $clr = 'color: inherit';
                $far = 'far';
              }
              if($dlkd->num_rows){
                $color = 'color: red;';
              }
              else {
                $color = 'color: inherit';
              }
              echo "
  
            ";
              $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$medu['id']."'"));
            $getsoccomment = mysqli_fetch_array($soccomment);
                echo '</div>
                <div class="undbtn sundbtn"><div class="lkd cmn dwn" onclick="love(\''.$medu['id'].'\', \''.$mbs['user'].'\')">
                <span id="love'.$medu['id'].'" style="'.$clr.'"><i class="'.$far.' fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                '.red($msoc['tln']).'</div>
                </div>
                <div class="cmt cmn dwn" id="commt" onclick="sc(\''.$medu['id'].'\', \''.$row['user'].'\')">
                <input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="scid" value="">
                  <button type="submit" class="sbm">
                <span><i class="far fa-comment dwtwc"></i></span>
                <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.red($medu['pnc']).'</div></div></button>
                </div><div class="shr cmn dwn" style="padding: 10px;">
                <span><i class="fas fa-share"></i></span></div>
                <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' close"><i class="fas fa-arrow-left"></i></span>
                     <div class="sfff"><div class="shrtpst">Share Post</div>
                     <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="1">
                     Share</button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                     <div class="sam">Share as message</div>
                     <div class="rcntt"><input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                     $gser = $row['user'];
                     $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$gser' OR ftwo='$gser' order by lasttimeofmessage desc limit 5");
                     if($mffs->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmffs = mysqli_fetch_assoc($mffs)){
                         if($row['user'] == $gmffs['fone']){
                           $nof = $gmffs['ftwo'];
                         }
                         else {
                           $nof = $gmffs['fone'];
                         }
                         echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$medu['id']."' onchange='gin(\"".$medu['id']."\")'>".$nof."</div>";
                       }
                     }
                     echo '<div class="orrsb"><div class="orrs">Others</div>';
                     $xerw = $row['user'];
                     $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$xerw' AND type='following'");
                     if($mfss->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmfss = mysqli_fetch_assoc($mfss)){
                         echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                       }
                     }
                     echo'</div></div><div id="countsend'.$medu['id'].'">
                     </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</button>
                     </div><div></div></div></div>
                </div>
                ';
                if(mysqli_num_rows($soccomment) == 0){  
                  //leave space blank
                  echo "<div class='comment_section' id='cmt_sec".$medu['id']."'></div>";
                }
                else {
                  $aus = $getsoccomment['user'];
                  $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                  $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                     AND postid='".$medu['id']."'
                     AND commentid='".$getsoccomment['id']."'"));
                  $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                  AND postid='".$medu['id']."'
                  AND commentid='".$getsoccomment['id']."'");
                     if($pa->num_rows){
                      $clrr = 'color: rgb(255, 136, 156)';
                     }
                     else {
                       $clrr = '';
                     }
                     $gd = getcwd();
                     $gd = getcwd();
                     chdir("../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
                     if(file_exists($getsoccomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                      chdir($gd);  
                    }
                      else {
                          $pimg =  '/students_connect/user.png';
                          chdir($gd);
                        }
                        chdir($gd);
                  echo "<div class='comment_section' id='cmt_sec".$medu['id']."'><div class='commt_cont'><div class='uswc' style='display: flex;'>
                  <div class='fet'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div></div>
                    <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                  <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                  <div class='posted'> ".date('M d h:i a', $getsoccomment['timeofcomment'])."</div>
                  <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                   style='$clrr' onclick='lvec(\"".$medu['id']."\", 
                  \"".$getsoccomment['id']."\", \"".$mbs['user']."\")' id='tclfh".$getsoccomment['id']."'>
                  <span><i class='far fa-heart'></i></span>
                  </div>
                  <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                  <input type='hidden' name='pid' value='".$medu['id']."'>
                  <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                  <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                  <div class='cupv ccmn cdwn scbtn report'>Report</div>
                  </div>
                  </div></div>";
                }
                echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                  <textarea name="socedupst" class="albts" id="cmttextarea'.$medu['id'].'" placeholder="Comment..."" value="" 
                  title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                  </div><div class="sndbtn"><label for="sendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                  <input type="hidden" name="postid" value="'.$medu['id'].'">
                  <input type="" id="sendbutton'.$medu['id'].'" style="display: none !important;"
                  onclick="sndSoc(\''.$mbs['user'].'\', document.getElementById(\'cmttextarea'.$medu['id'].'\').value, 
                  \''.$medu['id'].'\')"/></div>
                  </div></div>';          
                echo '</div></div>';
  }
  $e++;
              }
            }
            }
            elseif($dsm['status'] == 3) {
              if($myf->num_rows){
                $sltm = queryMysql("SELECT * FROM socposts WHERE (user IN ($win) OR sharedby IN ($win)$nstr $ssurelyoccured) 
                                 OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
                                  ORDER BY  
                                  rand() DESC limit 15");
                    if($sltm->num_rows == 0){
                        $sltm = queryMysql("SELECT * FROM socposts WHERE (id !='' $ssurelyoccured)
                        AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 15");
                          if($sltm->num_rows==0){
                            echo "<span class='n_mor4pst'>No more Post, go to <a href='#quest'>top</a><span>";
                          } 
                      }
                }
                else {
                  $sltm = queryMysql("SELECT * FROM socposts WHERE (id !='' $ssurelyoccured)
                  AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 15");
                }
              $e = 0;
            while(($medu = mysqli_fetch_array($sltm)) && $e < count($medu)){
              
  $ttr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$medu['user']."') OR (user='".$medu['user']."' 
  AND touser='".$user."') OR (user='$user' AND touser='".$medu['sharedby']."') OR 
  (user='".$medu['sharedby']."' AND touser='".$user."')");
  if($ttr->num_rows == 0){
              $studco_ad_images = array("/students_connect_hidden/ads/mesimg1.png", "/students_connect_hidden/ads/mesimg2.png", "/students_connect/ico/StudCo.png");
              for($x = 0; $x < count($adsspace); $x++){
                $qguess = queryMysql("SELECT * FROM ads WHERE expired='0' AND  (sptags != '' $adq) ORDER BY RAND()");
                if($adsspace[$x] == $e && $qguess->num_rows){
                  $qg = mysqli_fetch_array($qguess);
                  $ent = $qg['entity'];
                  if($qg['adtype'] == '1'){
                    $qgu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$ent."'"));
                    if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png")){
                      $umld = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png";
                    }
                    else {
                      $umld = '/students_connect/user.png';
                    }
                    if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png")){
                      $ucov = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png";
                      $ywi = "<img src='".$ucov."' class='wilfad_cv_img'/>";
                    }
                    else {
                      $ywi = '';
                      $ucov = '';
                    }
                    echo "<div class='wilfad_sp'>
                    <div class='wilfad_spfus'>
                    <div class='wilfad_cont'>
                    <div class='wilfad_mg'>
                    <div class='wilfad_yaj'>
                    <div class='wilfad_cv' style='background-image: url(\"".$ucov."\")'></div>
                    ".$ywi."
                    </div>
                    <div class='wilfad_gam'>
                    <div class='wilfad_dp' style='background-image: url(\"".$umld."\");'></div>
                    <img src='".$umld."' class='wilfad_dp_img'/>
                    </div></div>
                    <div class='wilfad_info'>
                    <div class='wilfad_name'>
                    <a href='/students_connect/user/".$qgu['user']."'>
                    <div class='wilfad_fname'>".$qgu['firstname']." ".$qgu['surname']."</div>
                    <div class='wilfad_uname'><i class='fas fa-at'>".$qgu['user']."</i></div>
                    </a></div>
                    <div class='wilfad_abt'>".$qgu['about']."</div>
                    </div>
                    <div class='wilfad_btns'><button class=''>Follow</button></div>
                    </div>
                    </div>
                    <div class='t_ad_tag'>Ad by StudCo</div>
                    </div>";
                  }
                  elseif($qg['adtype'] == '2'){
                    if($qg['ispostid'] == '0'){
                      $mj = 'eduposts';
                    }
                    elseif($qg['ispostid'] == '1'){
                      $mj = 'socposts';
                    }
                    $gm = queryMysql("SELECT * FROM $mj WHERE id='".$qg['extracontent']."'");
                    if($gm->num_rows){
                      $agm = mysqli_fetch_array($gm);
                      echo "<div class='wilfad_sp'>
                      <div class='wilfad_spfus'>
                      <div class='wilfad_cont'>
                      
                      </div>
                      <div class='t_ad_tag'>Ad by StudCo</div>
                      </div></div>";
                    }
                    elseif($gm['adtype'] == '3'){
                      //is special
                      echo "<div class='wilfad_sp'>
                      <div class='wilfad_spfus'>
                      <div class='wilfad_cont'>
                      
                      </div>
                      <div class='t_ad_tag'>Ad by StudCo</div>
                      </div></div>";
                    }
                  }
            
                  /*$tu = array_rand($studco_ad_images, 1);
                  $imgtu = $studco_ad_images[$tu];
                  $ad_t = nl2br("At studco we work together to make the world a better place.
                  Better for me, better for you, together we flow with studco.");
                  echo "<div class='s_cus_ad'>
                  <div class='ad_container'>
                  <div class='t_ad_tag'>Ad by StudCo</div>
                  <div class='ad_img' style='background-image: url(\"".$imgtu."\")'>
                  </div>
                  <div class='ad_text'><div class='main-ad-text'>".$ad_t."</div></div>
                  </div>
                  <div class='ad_go_tosite'>
                  Go to site <i class='fas fa-external-link-alt ad_link_tag'></i>
                  </div>
                  </div>";*/
                }
              }
  for($x = 0; $x < count($suggestedspace); $x++){
    if($suggestedspace[$x] == $e){
      $ts = '';
      $rs = '';
      for($r = 0; $r < count($agg); $r++){
        for($x = 0; $x < 1; $x++){
          /*echo $agg[$r][$x].'=>'.$agg[$r][$x+1]*/
          $ts.=" OR user = '".$agg[$r][$x]."'";;
        }
      }
      for($i = 0; $i < count($mow); $i++){
        $q = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend=".$mow[$i]."");
        if(($mow[$i] != "'".$row['user']."'")&&($q->num_rows == 0)){
        $ts.=" OR user = ".$mow[$i]."";
      }
    }
      $rs = substr($rs, 3, strlen($rs));
      $nts = substr($ts ,3, strlen($ts));
      if($nts == ''){
        $nts = "user != ''";
      }
      if(!isset($occr)){
        $occr ="user != ''";
        }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      $lry = [];
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
            array_push($lry, $gfsg['user']);
        }
      }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      if((mysqli_num_rows($fsg) > 0) && (count($lry) > 0)){
      echo "<div class='wh_cant'>
      <div class='s_fo_you'>Suggested for you</div>
      <div class='th_li_st'>";
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
        $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/".$gfsg['user'].'/');
      if(file_exists($gfsg['user'].".png")){ 
        $cimg =  '/students_connect_hidden/users_profile_upload/'.$gfsg['user'].'/'.$gfsg['user'].'.png';  
      }
        else {
          chdir($td);
            $cimg =  '/students_connect/user.png';
        }
        if(file_exists('cover/cover.png')){
          $odma = "<div class='atbck' style=\"background-image: url('/students_connect_hidden/users_profile_upload/".$gfsg['user']."/cover/cover.png')\"></div>";
        }
        else {
          $odma = "<div class='atbck' style='background: brown;'></div>";
        }
        chdir($td);
        $eot = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend='".$gfsg['user']."' ORDER BY RAND()");
        $nae = mysqli_num_rows($eot)-1;
        $geot = mysqli_fetch_array($eot);
        echo "
           <div class='on_u_a_Tm'>
           <div class='p_l_atf'>
           <a  href='/students_connect/user/".$gfsg['user']."'>
           ".$odma."
           <div class='cna_aam'>
           <div class='na_aam' style='background-image:url(\"".$cimg."\")' title='".$gfsg['user']." suggested' width='96' height='96'></div>
           <div class='t_fna_m'>
           <div class='p_e_pep'>
           <div class='_m'>
           ".$gfsg['surname']." ".$gfsg['firstname']."
           </div>
           <div class='th_un_m'><i class='fas fa-at'></i>".$gfsg['user']."</div>
           </div>";
           if($eot->num_rows > 0){
           echo "<div class='s_fflw1b'><i class=''>followed by <i class='fas fa-at'></i><span class='s_norm1al'>".$geot['user']."</span></i></div>";
           }
           /*elseif($dsm['institution'] == $gfsg['institution']){
             $xatt = '';
             $att = '';
             if($dsm['status'] == 1){
               $xat = ' aspirant';
             }
             elseif ($dsm['status'] == 2){
               $att = 'attending ';
             }
             else {
               $att = 'attended ';
             }
             echo "<div class='s_fflw1b'><i class=''>$att
             <span class='s_knorm21l'>".$gfsg['institution']."$xat</span></i></div>";
           }*/
           echo "</div></a><div class='o_m_d s_trbt1s'>
           <div class='s_bt1rss h_f_taag'>
           <input type='hidden' value='".$gfsg['user']."'>
           <i class='fas fa-rss'></i>Follow</div>
           </div>
           </div>
           </div></div>";
           $occr .= " AND user != '".$gfsg['user']."'";
      }
    }
      echo "<div class='s_mm_re'>See More</div>";
      echo "</div></div>";
  }
    }
  }
              $ssurelyoccured.=" AND id != '".$medu['id']."'";     
              $ttime = $medu['timeofupdate'];
              $ctime = time();
              if(($ctime - $ttime) < 60){
                $ftime = (int) $ctime - $ttime;
                $ftime.="s";
              }
              elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
                $ftime = (int) (($ctime - $ttime)/60);
                $ftime.= "m";
              } 
              elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
                $ftime = (int) (($ctime - $ttime)/3600);
                $ftime .=  "h";
              }
              elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
                $x = (int)(($ctime - $ttime));
                if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
                  $ftime = 'Yesterday at '.date("h:i a", $ttime);
                }
                else {
                  $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
                }
              }
              else {
                $ftime = date("M d h:i a", $ttime);
              }
              $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
        $id = $medu['id'];
        $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
        $chlov = mysqli_fetch_array($lov);
        $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
        $chdwn = mysqli_fetch_array($dwnp);
        $rwlov = (int) mysqli_num_rows($lov); 
        $fl = $rwlov - 1;
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='".$id."' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
        $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='liked' AND id='".$medu['id']."'");
         $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='disliked' AND id='".$medu['id']."'");
       $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
       if($medu['isshare'] == 0){
      echo <<<PSTS
      <div class='camp macamps'>
      <div class='amps' id='soc
      PSTS;
      $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='1'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['user'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='1'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
      echo $medu['id']."'>";
      echo <<<PSTS
           <div class='ipt'></div><div class='namp'>
           <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$id" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div></div>
      PSTS;
      $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
      if(file_exists($medu['user'].".png")){ 
          $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
          chdir($td);
        }
      else {
        chdir($td);
         $img =  '/students_connect/user.png';
            }
          chdir($td);
      echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'
      ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
      <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
      <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
      echo '<div class="mpst" id="mpsts'.$medu['id'].'">';
      $content = strip_tags($medu['pstcont']);
      $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
      <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
      Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
      $pstcut = rhash($pstcut);
      echo nl2br($pstcut).'</div>';
                $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                  if($polc->num_rows){
                    $gpo = mysqli_fetch_array($polc);
                    $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='1'");
                    $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      
                      $sfo = "<i class='far fa-circle c_y'></i>";
                    $fto = "<i class='far fa-circle c_y'></i>";
                    $ftho = "<i class='far fa-circle c_y'></i>";
                    $ffour = "<i class='far fa-circle c_y'></i>";
                    $buttons = '';
                    $tBg = $sbg = $fbg = $obg = '';
                    $vct = '';
                    $uct = '';
                    $xct = '';
                    $oct = '';
                    if($clc->num_rows){
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = 0; 
                        }
                      $buttons = 'disabled';
                      $clck = mysqli_fetch_array($clc);
                      if($clck['clicked'] == 1){
                       $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                       $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                            background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 2){
                        $fto = "<i class='fas fa-check-circle c_x'></i>";
                        $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 3){
                        $ftho = "<i class='fas fa-check-circle c_x'></i>";
                        $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 4){
                        $ffour = "<i class='fas fa-check-circle c_x'></i>";
                        $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                  }
                                  $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                    echo "<div class='shpollpost'>
                    <div class='thopts'>
                    <div class='tfopt mopts'>
                    <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                    ".$sfo."".$gpo['opt1']."
                    <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                    <input type='hidden' id='usr1' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                    .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                    <input type='hidden' id='usr2' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                    .$ftho."".$gpo['opt3']."
                    <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                    <input type='hidden' id='usr3' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                    .$ffour."".$gpo['opt4']."
                    <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                    <input type='hidden' id='usr4' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                    </div>";
                  }
                  else {
                    $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='1'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = '0'; 
                        }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                      $buttons = 'disabled';
                      $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                      echo "<div class='shpollpost'>
                    <div class='thopts'>
                    <div class='tfopt mopts'>
                    <button class='lastpl p-1' id='p_1' $buttons value='1'>
                    ".$gpo['opt1']."
                    
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                    .$gpo['opt2']."
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                    .$gpo['opt3']."
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                    .$gpo['opt4']."
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                    </div>";
                    } 
                  }
                $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/s/");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';

                    if(file_exists($medu['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp4' type='video/mp4'>
                      </video>
                      </div>
                      ";              
                              
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>
                <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
              }
              else {
                  echo <<<PSTS
                  <div class='camp macamps'>
                  PSTS;
                  echo <<<PSTS
                   <div class='amps' id='
                  PSTS;
                  echo $medu['id']."'>";
                  $xet = "";
                  $sid = $medu['id'];
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='1'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['sharedby'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='1'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                      <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$sid" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div>
                  </div>
                  PSTS;
                  //echo <<<PSTS
                  //    <div class='ipt'></div><div class='namp'>
                 //PSTS;
                $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                if(file_exists($mbss['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                  chdir($td);  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                  echo '<div class="mpst" id="mpsts'.$medu['id'].'" style="min-height: 30px;">';
                  $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
                  echo nl2br($pstcute).'</div>';
                  $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
                  if(file_exists($mbse['user'].".png")){ 
                    $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                    chdir($td);  
                  }
                    else {
                      chdir($td);
                        $simg =  '/Students_connect/user.png';
                    }
                  echo "<div class='eap' style='padding-bottom: 40px;'>
                  <div class='tsp' onclick='ops(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                   style='cursor: pointer; min-height: 120px;'>
                  <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['sharedpostid'].'">';
                  $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                  $arr = array();
                  $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['sharedpostid']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../students_connect_hidden/postuploads/s");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($medu['sharedpostid']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['sharedpostid']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                  echo '</div></div></div>
                  </div>';
                  echo '<div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
              }
                echo '
                <div class="pwl"> ';
                if($fl == 1){
                  $other  = 'other';
                  global $other;
                }
                else {
                  $other = 'others';
                  global $other;
                }
                $dwns = "";
                
                if($lov->num_rows){
                if($chlov['user'] == $user){
                  $chlov['user'] = 'You';
                  if($rwlov == 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                }
                elseif($rwlov > 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                }
              }
              else {
                if($rwlov == 1){
                  echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                }
                elseif($rwlov > 1){
                  echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="svl" value="'.$medu["id"].'">
                  <button type="submit" id="lbn">
                  <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                }
              }
            }
              if($lvd->num_rows){
                $clr = 'color: rgb(255, 136, 156);';
                $far = 'fas';
              }
              else {
                $clr = 'color: inherit';
                $far = 'far';
              }
              if($dlkd->num_rows){
                $color = 'color: red;';
              }
              else {
                $color = 'color: inherit';
              }
              echo "
  
            ";
              $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$medu['id']."'"));
            $getsoccomment = mysqli_fetch_array($soccomment);
                echo '</div>
                <div class="undbtn sundbtn"><div class="lkd cmn dwn" onclick="love(\''.$medu['id'].'\', \''.$mbs['user'].'\')">
                <span id="love'.$medu['id'].'" style="'.$clr.'"><i class="'.$far.' fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                '.red($msoc['tln']).'</div>
                </div>
                <div class="cmt cmn dwn" id="commt" onclick="sc(\''.$medu['id'].'\', \''.$row['user'].'\')">
                <input type="hidden" name="spid" value="'.$medu["id"].'">
                  <input type="hidden" name="scid" value="">
                  <button type="submit" class="sbm">
                <span><i class="far fa-comment dwtwc"></i></span>
                <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.red($medu['pnc']).'</div></div></button>
                </div><div class="shr cmn dwn" style="padding: 10px;">
                <span><i class="fas fa-share"></i></span></div>
                <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' close"><i class="fas fa-arrow-left"></i></span>
                     <div class="sfff"><div class="shrtpst">Share Post</div>
                     <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="1">
                     Share</button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                     <div class="sam">Share as message</div>
                     <div class="rcntt"><input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                     $gser = $row['user'];
                     $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$gser' OR ftwo='$gser' order by lasttimeofmessage desc limit 5");
                     if($mffs->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmffs = mysqli_fetch_assoc($mffs)){
                         if($row['user'] == $gmffs['fone']){
                           $nof = $gmffs['ftwo'];
                         }
                         else {
                           $nof = $gmffs['fone'];
                         }
                         echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$medu['id']."' onchange='gin(\"".$medu['id']."\")'>".$nof."</div>";
                       }
                     }
                     echo '<div class="orrsb"><div class="orrs">Others</div>';
                     $xerw = $row['user'];
                     $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$xerw' AND type='following'");
                     if($mfss->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmfss = mysqli_fetch_assoc($mfss)){
                         echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                       }
                     }
                     echo'</div></div><div id="countsend'.$medu['id'].'">
                     </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</button>
                     </div><div></div></div></div>
                </div>
                ';
                if(mysqli_num_rows($soccomment) == 0){  
                  //leave space blank
                  echo "<div class='comment_section' id='cmt_sec".$medu['id']."'></div>";
                }
                else {
                  $aus = $getsoccomment['user'];
                  $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                  $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                     AND postid='".$medu['id']."'
                     AND commentid='".$getsoccomment['id']."'"));
                  $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                  AND postid='".$medu['id']."'
                  AND commentid='".$getsoccomment['id']."'");
                     if($pa->num_rows){
                      $clrr = 'color: rgb(255, 136, 156)';
                     }
                     else {
                       $clrr = '';
                     }
                     $gd = getcwd();
                     $gd = getcwd();
                     chdir("../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
                     if(file_exists($getsoccomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                      chdir($gd);  
                    }
                      else {
                          $pimg =  '/students_connect/user.png';
                          chdir($gd);
                        }
                        chdir($gd);
                  echo "<div class='comment_section' id='cmt_sec".$medu['id']."'><div class='commt_cont'><div class='uswc' style='display: flex;'>
                  <div class='fet'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div></div>
                    <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                  <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                  <div class='posted'> ".date('M d h:i a', $getsoccomment['timeofcomment'])."</div>
                  <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                   style='$clrr' onclick='lvec(\"".$medu['id']."\", 
                  \"".$getsoccomment['id']."\", \"".$mbs['user']."\")' id='tclfh".$getsoccomment['id']."'>
                  <span><i class='far fa-heart'></i></span>
                  </div>
                  <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                  <input type='hidden' name='pid' value='".$medu['id']."'>
                  <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                  <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                  <div class='cupv ccmn cdwn scbtn report'>Report</div>
                  </div>
                  </div></div>";
                }
                echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                  <textarea name="socedupst" class="albts" id="cmttextarea'.$medu['id'].'" placeholder="Comment..."" value="" 
                  title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                  </div><div class="sndbtn"><label for="sendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                  <input type="hidden" name="postid" value="'.$medu['id'].'">
                  <input type="" id="sendbutton'.$medu['id'].'" style="display: none !important;"
                  onclick="sndSoc(\''.$mbs['user'].'\', document.getElementById(\'cmttextarea'.$medu['id'].'\').value, 
                  \''.$medu['id'].'\')"/></div>
                  </div></div>';          
                echo '</div></div>';
            $e++;
              }
            }
          }
/*$xinst = $dsm['institution'];
  $xcourse = $dsm['course'];
 $myf = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
 $far = array(); 
 $puf = array();
 array_push($far, $user);
 array_push($puf, $user);
 while($f = mysqli_fetch_array($myf)){
    array_push($far, $f['friend']);
    array_push($puf, $f['friend']);
}
// generate 2 random friends and select some of their friends
if(count($far) > 2){
$f1 = array_rand($far, 3);
}
elseif(count($far) > 1 && count($far) <= 2){
    $f1 = array_rand($far, 2);
}
elseif(count($far) > 0 && count($far) <= 1){
    $f1 = array_rand($far, 1);
}
else {
    $f1 = array_rand($far, 0);
}
$sugar = array();
if(count($far) > 1){
foreach($f1 as $num){
    if($far[$num] !== $user){
        array_push($sugar, $far[$num]);
    }
}
}
$fff1 = array();

if(isset($sugar[0])){
$f1 = $sugar[0];
$f1f = queryMysql("SELECT * FROM followstatus WHERE user='$f1'");
while($gf1 = mysqli_fetch_array($f1f)){
    array_push($fff1, $gf1['friend']);
}
}
if(isset($sugar[1])){
$f2 = $sugar[1];
$f2f = queryMysql("SELECT * FROM followstatus WHERE user='$f2'");
while($gf2 = mysqli_fetch_array($f2f)){
    array_push($fff1, $gf2['friend']);
}
}
if(isset($sugar[2])){
$f3 = $sugar[2];
$f3f = queryMysql("SELECT * FROM followstatus WHERE user='$f3'");
while($gf3 = mysqli_fetch_array($f3f)){
    array_push($fff1, $gf3['friend']);
}
}
for($x=0; $x < count($fff1); $x++){
    if($fff1[$x] !== $user){
        $hm = array_keys($fff1, $fff1[$x]);
        if(count($hm) > 1){
            if(in_array($fff1[$x], $far)){
                // it is not suggested
            }
            else {
                array_push($far, $fff1[$x]);
                
            }
        }
    }
}
$ptime = time();
$lthidays = strtotime("1 day ago");
$ints = $dsm['interests'];
$xone = "";
$xtwo = "";
if($ints !== 0){
$fints = explode(",", $dsm['interests']);
$xone = $fints[array_rand($fints, 1)];
if(count($fints) >1){
$xtwo = $fints[array_rand($fints, 1)];
}
}
$win = "'".implode("','",$far)."'";
$sltm = queryMysql("SELECT * FROM eduposts WHERE user IN ($win) or sharedby IN ($win) OR pinterest like '%$xone%' OR pinterest like '%$xtwo%' 
    AND timeofupdate BETWEEN $lthidays AND $ptime
    UNION ALL
    SELECT * FROM socposts WHERE user IN ($win) OR sharedby IN ($win) OR pinterest like '%xone%' OR pinterest LIKE '%$xtwo%' 
    AND timeofupdate BETWEEN $lthidays AND $ptime
    ORDER BY  
     (timeofupdate) desc LIMIT 0, 10");
$adsspace = array();
for($i = 0; $i < 3; $i++){
    array_push($adsspace, rand(3, 20));
}
$forumspace = array();
for($x = 0; $x < 6; $x++){
  array_push($forumspace, rand(1, 20));
}
$suggestedspace  = array();
for($x = 0; $x<2; $x++){
  array_push($suggestedspace, rand(1, 10));
}
$e = 0;
while(($post = mysqli_fetch_array($sltm)) && $e < count($post)){
    if(!in_array($post['user'],$puf)){
        $tag = 'Suggested';
    }
    else {
        $tag = "";
    }
    for($x = 0; $x < 3; $x++){
        if($e == $adsspace[$x]){
            echo  'ADVERT NOW';
    }
}
for($p = 0; $p < 6; $p++){
  if($e == $forumspace[$p]){
    $exd = queryMysql("SELECT * FROM forummembers  WHERE user='$'");
  }
}
for($x=0; $x < 1; $x++){
  if($e == $suggestedspace[$x]){
  $jg = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
  $xray = array();
  while($gjg = mysqli_fetch_array($jg)){
    array_push($xray, $gjg['friend']);
  }
  $nwi = "'".implode("','",$xray)."'";
  $xme = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwi)");
  $narr = array();
  while($gxme = mysqli_fetch_array($xme)){
    array_push($narr, $gxme['friend']);
  }
  $xnar = array_unique($narr);
  $xxap = array();
  $xde = array_merge($xxap, $xnar);
  $dbe = array();
  for($c = 0; $c<count($xde); $c++){
    if(($xde[$c] !== $user) && !in_array($xde[$c], $xray)){
      array_push($dbe, $xde[$c]);
      echo "<div class='onormal'>";
      if(count($xde) < 5){
        // change focus to searches or random from anywhere,
        $xone = "";
        $xtwo = "";
        if($ints !== 0){
          $fints = explode(",", $dsm['interests']);
          $xone = $fints[array_rand($fints, 1)];
          if(count($fints) >1){
          $xtwo = $fints[array_rand($fints, 1)];
          }
          }
        $rex = queryMysql("SELECT * FROM members WHERE institution='$xinst' OR course='$xcourse' OR  pinterest like '%$xone%' OR pinterest like '%$xtwo%' ORDER BY RAND() LIMIT 5");
        if($rex->num_rows){
        while($grex = mysqli_fetch_array($rex)){
          $frod = $grex['user'];
          $mix = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$frod'");
          if($mix->num_rows == 0){
          echo "
          <div class='qe_r'>
          <div class='xp_r'>
          <div class='to_fl'>
          <div class='t_p_img'>
          </div>
          <div class='tnmn_sene'>
          <div class='txu_n'>".$grex['surname']." ".$grex['firstname']."</div>
          <div class='txu_u'><i class='fas fa-at'></i>".$grex['user']."</div>
          </div>
          </div>
          <div class='to_fr'>
          <div class='f_pers'><button type='button' class='fzlw'>Follow</button></div>
          <div class='r_ar_pers'><i class='fas fa-caret-right'></i></div>
          </div>
          </div>
          </div>
          ";
        }
      }
        }
        
      }
      else {
        $xoc = $xde[$c];
        $rex = queryMysql("SELECT * FROM members WHERE user='$xde' LIMIT 5");
        if($rex->num_rows){
        while($grex = mysqli_fetch_array($rex)){
          $frod = $grex['user'];
          $mix = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$frod'");
          if($mix->num_rows == 0 && $frod !== $user){
          echo "
          <div class='qe_r'>
          <div class='xp_r'>
          <div class='to_fl'>
          <div class='t_p_img'>
          </div>
          <div class='tnmn_sene'>
          <div class='txu_n'>".$grex['surname']." ".$grex['firstname']."</div>
          <div class='txu_u'><i class='fas fa-at'></i>".$grex['user']."</div>
          </div>
          </div>
          <div class='to_fr'>
          <div class='f_pers'><button type='button' class='fzlw'>Follow</button></div>
          <div class='r_ar_pers'><i class='fas fa-caret-right'></i></div>
          </div>
          </div>
          </div>
          ";
        }
      }
      }
      }
      echo "</div>";
    }
    else {
      echo "<div class='onormal'>";
      if(count($xde) < 5){
        // change focus to searches or random from anywhere,
        $xone = "";
        $xtwo = "";
        if($ints !== 0){
          $fints = explode(",", $dsm['interests']);
          $xone = $fints[array_rand($fints, 1)];
          if(count($fints) >1){
          $xtwo = $fints[array_rand($fints, 1)];
          }
          }
        $rex = queryMysql("SELECT * FROM members WHERE institution='$xinst' OR course='$xcourse' OR  interests like '%$xone%' OR interests like '%$xtwo%' ORDER BY RAND() LIMIT 5");
        if($rex->num_rows){
        while($grex = mysqli_fetch_array($rex)){
          $frod = $grex['user'];
          $mix = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$frod'");
          if($mix->num_rows == 0){
          echo "
          <div class='qe_r'>
          <div class='xp_r'>
          <div class='to_fl'>
          <div class='t_p_img'>
          </div>
          <div class='tnmn_sene'>
          <div class='txu_n'>".$grex['surname']." ".$grex['firstname']."</div>
          <div class='txu_u'><i class='fas fa-at'></i>".$grex['user']."</div>
          </div>
          </div>
          <div class='to_fr'>
          <div class='f_pers'><button type='button' class='fzlw'>Follow</button></div>
          <div class='r_ar_pers'><i class='fas fa-caret-right'></i></div>
          </div>
          </div>
          </div>
          ";
        }
      }
    }
      }
    }
  }
}
}
$ttime = $post['timeofupdate'];
          $ctime = time();
          if(($ctime - $ttime) < 60){
            $ftime = (int) $ctime - $ttime;
            $ftime.="s";
          }
          elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
            $ftime = (int) (($ctime - $ttime)/60);
            $ftime.= "m";
          } 
          elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
            $ftime = (int) (($ctime - $ttime)/3600);
            $ftime .=  "h";
          }
          elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
            $x = (int)(($ctime - $ttime));
            if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
              $ftime = 'Yesterday at '.date("h:i a", $ttime);
            }
            else {
              $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
            }
          }
          else {
            $ftime = date("M d h:i a", $ttime);
          }
$pstr = $post['user'];
                    $fup = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$pstr'"));
                    $fname = ucwords($fup['surname']." ".$fup['firstname']);
                    $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$post['user']."'"));
                    if($post['pstst'] == 0){
                    # educational post
                    $id = $post['id'];
                    $vot = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='upvote' ORDER BY timeofvote DESC");
                    $rwvot = (int) mysqli_num_rows($vot); 
                    $fl = $rwvot;
                    $pid = 'e'.$post['id'];
                    $pstcut = nl2br($post['pstcont']);
                    $id = $post['id'];
                    $gv = queryMysql("SELECT * FROM eduposts WHERE id='$id'");
                    $gvu = queryMysql("SELECT * FROM votes WHERE id='$id'");
                    $any = mysqli_fetch_array($gvu);
                    if($gvu->num_rows > 0){
                    $m = (int) mysqli_num_rows($gvu);
                    $ln = $m -1;
                    
                    $mg = "<div class='shp'><i class='fas fa-caret-up' style='color: green;'></i>";
                    $imgar = array();
                    while($all = mysqli_fetch_array($gvu)){
                        if(in_array($all['user'], $far)){
                            for($i=0; $i < 2; $i++){
                                // select 2 images
                            array_push($imgar, $all['user']);    
                            }
                            if(isset($imgar[1]) != isset($imgar[2])){
                                if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[1].".png")){ 
                                    $mg .=  
                                    '<div class="raimg" 
                                    style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[1].'.png\')"></div>';
                                 }
                                if(isset($imgar[2])){
                                if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[2].".png")){ 
                                    $mg .=  '<div class="raimg" 
                                    style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[2].'.png\')"></div>';
                                 }
                            }
                            
                        }
                        else {
                            if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[1].".png")){ 
                                $mg .=  
                                '<div class="raimg" 
                                style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[1].'.png\')"></div>';
                             }
                        }      
                        }
                    }
                    $mg .= "</div>";
                }
                else {
                    $mg = "<div class='shp'></div>";
                    #if($m == 1){
                    #    $nm = $any['surname']." ".$any['lastname']." reacted" ;
                    #}
                    #elseif($m > 1 && $m < 2){
                    #    $nm = $any['surname']." ".$any['lastname']." 1 other reaced";
                    #}
                    #elseif($m > 2){
                    #    $nm = $any['surname']." ".$any['lastname'].", ".$ln." other reaced";    
                    #}
                }
                
if(file_exists("../../students_connect_hidden/users_profile_upload/".$post['user'].".png")){ 
    $img =  '../../students_connect_hidden/users_profile_upload/'.$post['user'].'.png';  
  }
    else {
        $img =  '../../../students_connect/user.png';
    }
    if($post['isshare'] == 0){
      if($post['pinterest'] != '0' || !empty($post['pinterest']) || $post['pinterest'] == NULL){
        echo "<div class='camp macamps'>";
        echo "<div class='phonetags' style='display: flex;'>";
        $tg = explode(",",$post['pinterest']);
      sort($tg);
      if(count($tg) <=4){
      for($i = 0; $i < count($tg); $i++){
      echo "
      <div class='ttags' style='padding: 5px; dipslay: none; margin-right:6px;'>
      <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
      }
    }
    else {
      for($i = 0; $i < 4; $i++){
        echo "
        <div class='ttags' style='padding: 5px; margin-right:6px;'>
        <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
        }
        echo "<div class='ttags phown' id='trtags' style='padding: 5px; margin-right:6px;' onclick='disptOths()'>...</div>";
    }
    echo "<div class='smoretags' 
      id='moretags' style='display: none;'>";
    for($i = 4; $i < count($tg); $i++){
      echo "
      <div class='ttags' padding: 5px; margin-right:6px;'>
      <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
      </div>";
      
  echo "</div>";
    }
    echo "</div></div>";
  }
      
     
      $sid = $post['id'];
      echo <<<PSTS
       <div class='amps anamps' id='
      PSTS;
      echo $post['id']."'>";
      $xet = "";
      $xot = "<div class='tb_y cotx'>
      <input type='hidden' value='0'>
      <input type='hidden' value='".$post['id']."'>
      <input type='hidden' value='".$dsm['user']."'>
      Open Comments</div>";
      $xzt = "<div class='tb_y repop'>Report Post</div>";
      $xyt = "<div class='tb_y blusr'>Block User</div>";
      if($post['user'] == $dsm['user']){
        $xet = "<div class='tb_y'>Delete Post</div>";
        $xyt = '';
        $xzt = '';
      }
      echo <<<PSTS
          <div class='ipt'></div><div class='namp'>
          <div class='esign' style='float: right; cursor: pointer;'>
      <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
      <div id="myDropdown$sid" class="std_yx">
      $xot
      $xyt
      $xzt
      $xet
      </div>
      </div>
      PSTS;
      if($post['pinterest'] != '0' || !empty($post['pinterest'])){
      echo "<div class='ptags' style='float: right; display: flex;'>
      ";
      $tg = explode(",",$post['pinterest']);
      sort($tg);
      if(count($tg) <=4){
      for($i = 0; $i < count($tg); $i++){
      echo "
      <div class='ttags' style='padding: 5px; margin-right:6px;'>
      <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
      }
    }
    else {
      for($i = 0; $i < 4; $i++){
        echo "
        <div class='ttags' style='padding: 5px; margin-right:6px;'>
        <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
        }
        echo "<div class='ttags' id='zymbxs' style='padding: 5px; margin-right:6px;' onclick='dispOths()'>...</div>";
    }
    for($i = 4; $i < count($tg); $i++){
      echo "<div class='ttags own' 
      id='moretags' style='display: none; padding: 5px; margin-right:6px;'>
      <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
      </div>";
  }
  
  echo "</div>";
}
    $td = getcwd();
    chdir("../../students_connect_hidden/users_profile_upload/");
    if(file_exists($post['user'].".png")){ 
      $img =  '/students_connect_hidden/users_profile_upload/'.$post['user'].'.png';  
    }
      else {
        chdir($td);
          $img =  '/students_connect/user.png';
      }
      chdir($td);
      echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
      <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
      <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
      <div class='unvme'><i class='fas fa-at'></i>".$mbs['user']."</div></a></div></div></div>";
      echo '<div class="mpst" id="mpst'.$post['id'].'">';
      $pstcut = strlen($post['pstcont']) > 250 ? substr($post['pstcont'], 0, 250).'&hellip;
      <div class="readmore" onclick="rdmore(\''.$post['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['pstcont'];
      $pstcut = str_replace("search=\r\n", "", $pstcut);            
      echo nl2br($pstcut).'</div>';
      $tpeid = $post['id'];
      $etime = time();
      $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
        if($polc->num_rows){
          $gpo = mysqli_fetch_array($polc);
          $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='0'");
          $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
            $x1 = (int) $xed['o1clicks'];
            $x2 = (int) $xed['o2clicks'];
            $x3 = (int) $xed['o3clicks'];
            $x4 = (int) $xed['o4clicks'];
            $sfo = "<i class='far fa-circle c_y'></i>";
          $fto = "<i class='far fa-circle c_y'></i>";
          $ftho = "<i class='far fa-circle c_y'></i>";
          $ffour = "<i class='far fa-circle c_y'></i>";
          $buttons = '';
          $tBg = $sbg = $fbg = $obg = '';
          $vct = '';
          $uct = '';
          $xct = '';
          $oct = '';
          if($clc->num_rows){
            if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
              $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
              }
              else {
                $x1v = $x2v = $x3v = $x4v = '0'; 
              }
            $buttons = 'disabled';
            $clck = mysqli_fetch_array($clc);
            if($clck['clicked'] == 1){
             $sfo = "<i class='fas fa-check-circle c_x'></i>";  
             $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                  background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
            }
            elseif($clck['clicked'] == 2){
              $fto = "<i class='fas fa-check-circle c_x'></i>";
              $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
              background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
            }
            elseif($clck['clicked'] == 3){
              $ftho = "<i class='fas fa-check-circle c_x'></i>";
              $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
              background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
            }
            elseif($clck['clicked'] == 4){
              $ffour = "<i class='fas fa-check-circle c_x'></i>";
              $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
              background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
            }
            $vct = '<label id="xc_1">'.$x1v.'%</label>';
            $uct = '<label id="xc_2">'.$x2v.'%</label>';
            $xct = '<label id="xc_3">'.$x3v.'%</label>';
            $oct = '<label id="xc_4">'.$x4v.'%</label>';
                        }
                        $for = "";
                      $ffr = "";
          if(empty($xed['opt3']) || $xed['opt3'] == NULL){
            $for = "style='display: none;'";
          }
          if(empty($xed['opt4']) || $xed['opt4'] == NULL){
            $ffr = "style='display: none;'";
          }
          echo "<div class='shpollpost'>
          <div class='thopts'>
          <div class='tfopt mopts'>
          <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
          ".$sfo."".$gpo['opt1']."
          <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
          <input type='hidden' id='usr1' value='".$dsm['user']."'>
          <input type='hidden' value='".$post['id']."'>
          <input type='hidden' value='0'>
          <span id='ls1'>".$vct."</span>
          </button>
          </div>
          <div class='tfsect mopts'>
          <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
          .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
          <input type='hidden' id='usr2' value='".$dsm['user']."'>
          <input type='hidden' value='".$post['id']."'>
          <input type='hidden' value='0'>
          <span id='ls2'>".$uct."</span>
          </button>
          </div>
          <div class='tthrpt mopts' $for>
          <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
          .$ftho."".$gpo['opt3']."
          <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
          <input type='hidden' id='usr3' value='".$dsm['user']."'>
          <input type='hidden' value='".$post['id']."'>
          <input type='hidden' value='0'>
          <span id='ls3'>".$xct."</span>
          </button>
          </div>
          <div class='tforpt mopts' $ffr>
          <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
          .$ffour."".$gpo['opt4']."
          <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
          <input type='hidden' id='usr4' value='".$dsm['user']."'>
          <input type='hidden' value='".$post['id']."'>
          <input type='hidden' value='0'>
          <span id='ls4'>".$oct."</span>
          </button>
          </div>
          </div>
          <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
           $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
          </div>";
        }
        else {
          $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='0'");
          if($polc->num_rows){
            $gpo = mysqli_fetch_array($polc);
            $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
            $x1 = (int) $xed['o1clicks'];
            $x2 = (int) $xed['o2clicks'];
            $x3 = (int) $xed['o3clicks'];
            $x4 = (int) $xed['o4clicks'];
            if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
              $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
              $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
              }
              else {
                $x1v = $x2v = $x3v = $x4v = '0'; 
              }
            
            $vct = '<label id="xc_1">'.$x1v.'%</label>';
            $uct = '<label id="xc_2">'.$x2v.'%</label>';
            $xct = '<label id="xc_3">'.$x3v.'%</label>';
            $oct = '<label id="xc_4">'.$x4v.'%</label>';
            $buttons = 'disabled';
            $for = "";
                      $ffr = "";
          if(empty($xed['opt3']) || $xed['opt3'] == NULL){
            $for = "style='display: none;'";
          }
          if(empty($xed['opt4']) || $xed['opt4'] == NULL){
            $ffr = "style='display: none;'";
          }
            echo "<div class='shpollpost'>
          <div class='thopts'>
          <div class='tfopt mopts'>
          <button class='lastpl p-1' id='p_1' $buttons value='1'>
          ".$gpo['opt1']."
          
          <span id='ls1'>".$vct."</span>
          </button>
          </div>
          <div class='tfsect mopts'>
          <button class='lastpl p-2' id='p_2' $buttons value='2'>"
          .$gpo['opt2']."
          <span id='ls2'>".$uct."</span>
          </button>
          </div>
          <div class='tthrpt mopts' $for>
          <button class='lastpl p-3' id='p_3' $buttons value='3'>"
          .$gpo['opt3']."
          <span id='ls3'>".$xct."</span>
          </button>
          </div>
          <div class='tforpt mopts' $ffr>
          <button class='lastpl p-4' id='p_4' $buttons value='4'>"
          .$gpo['opt4']."
          <span id='ls4'>".$oct."</span>
          </button>
          </div>
          </div>
          <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
           $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
          </div>";
          } 
        }
        $arr = array();
      $td = getcwd();
      chdir("../../students_connect_hidden/postuploads/");
      for($i = 0; $i < 2; $i++){ 
          if(file_exists($post['id']."(".$i.").png")){
            $files[$i] = "/Students_connect_hidden/postuploads/".$post['id']."(".$i.").png";
            array_push($arr, $files[$i]);
          }
        }
        
        chdir($td);
    $data = count($arr);
  if($data == 1){
    $da = 1;
  }
  else {
    $da = 2;
  }
      echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
      $td = getcwd();
        chdir("../../students_connect_hidden/postuploads/");
      for($i = 0; $i < 2; $i++){ 
        if(file_exists($post['id']."(".$i.").png")){  
          echo "
          <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$post['id']."(".$i.").png'></div>";
    }
        else {
          echo "";                     }
        }
      echo '</div></div>';
      echo '<div class="allimgposted"><div class="aimg">';
      if(file_exists($post['id']."(0).mp4")){
        echo "
        <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
        <source src='/students_connect_hidden/postuploads/".$post['id']."(0).mp4' type='video/mp4'>
        </video></div>
        ";                      
    }
    echo "</div></div>";
    echo '<div class="allimgposted"><div class="aimg">';
      if(file_exists($post['id']."(0).mp3")){
        echo "
        <div class='postaudio'>
        
        <audio controls class='paudio'>
        <source src='/students_connect_hidden/postuploads/".$post['id']."(0).mp3' type='video/mp4'>
        </video></div>
        ";                      
    }
    chdir($td);
      echo '</div></div>
      <div class="posted" id="posted'.$post['id'].'">'.$ftime.'</div>';
    }
    else {
      if($post['sharedby'] == $mbs['user']){
        $shrus = 'You';
      }
      else {
          $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
      }
      $shr = $shrus." shared <a href='/students_connect/user/".$mbse['user']."'>
      <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
      echo <<<PSTS
      <div class='camp macamps'>
      PSTS;
      echo <<<PSTS
       <div class='amps anamps' id='
      PSTS;
      echo $post['id']."'>";
      echo <<<PSTS
          <div class='ipt'></div><div class='namp'>
    PSTS;
    $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$post['sharedby']."'"));
    $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/");
    if(file_exists($mbss['user'].".png")){ 
      $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'.png';
      chdir($td);  
    }
      else {
        chdir($td);
          $img =  '/students_connect/user.png';
      }
      chdir($td);
      echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbss['user']."'>
      <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
      <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
      <div class='unvme'><i class='fas fa-at'></i>".$mbs['user']."</div></a></div></div></div>";
      echo '<div class="mpst" id="mpst'.$post['id'].'" style="min-height: 30px;">';
      $pstcute = strlen($post['sharedpstcont']) > 250 ? substr($post['sharedpstcont'], 0, 250).'&hellip;
      <div class="readmore" onclick="rdmore(\''.$post['id'].'\')" id="readmr'.$post['id'].'">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['sharedpstcont'];
      echo nl2br($pstcute).'</div>';
      $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/");
      if(file_exists($mbse['user'].".png")){ 
        $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'.png';
        chdir($td);  
      }
        else {
          chdir($td);
            $simg =  '/Students_connect/user.png';
        }
      echo "<div class='eap' style='padding-bottom: 40px;'>
      <div class='tsp' onclick='op(\"".$post['sharedpostid']."\",\"".$post['sharedby']."\")'
       style='cursor: pointer; min-height: 120px;'>
      <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
      <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
      <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
      <div class='unvme'><i class='fas fa-at'></i>".$mbs['user']."</div></a></div></div>";
      echo '<div class="mpst" id="mpst'.$post['id'].'">';
      $pstcut = strlen($post['pstcont']) > 250 ? substr($post['pstcont'], 0, 250).'&hellip;
      <div class="readmore" onclick="rdmore(\''.$post['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['pstcont'];
      echo nl2br($pstcut).'</div>';
      $arr = array();
      $td = getcwd();
      chdir("../../students_connect_hidden/postuploads/");
      for($i = 0; $i < 2; $i++){ 
          if(file_exists($post['sharedpostid']."(".$i.").png")){
            $files[$i] = "/Students_connect_hidden/postuploads/".$post['sharedpostid']."(".$i.").png";
            array_push($arr, $files[$i]);
          }
        }
        chdir($td);
    $data = count($arr);
    if($data == 1){
      $da = 1;
    }
    else {
      $da = 2;
    }
      echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
      $td = getcwd();
        chdir("../../students_connect_hidden/postuploads/");
      for($i = 0; $i < 2; $i++){ 
        if(file_exists($post['sharedpostid']."(".$i.").png")){  
          echo "
          <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$post['sharedpostid']."(".$i.").png'></div>";
    }
        else {
          echo "";                     }
        }
        echo '</div>
      </div>';
        echo '<div class="allimgposted"><div class="aimg">';
        if(file_exists($post['sharedpostid']."(0).mp4")){
          echo "
          <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
          <source src='/students_connect_hidden/postuploads/".$post['sharedpostid']."(0).mp4' type='video/mp4'>
          </video></div>
          ";                      
      }
      echo "</div></div>";
    echo '<div class="allimgposted"><div class="aimg">';
      if(file_exists($post['sharedpostid']."(0).mp3")){
        echo "
        <div class='postaudio'>
        <div class='audiops'>Audio</div>
        <audio controls class='paudio'>
        <source src='/students_connect_hidden/postuploads/".$post['sharedpostid']."(0).mp3' type='video/mp4'>
        </video></div>
        ";                      
    }
      chdir($td);
      echo '</div></div></div></div>';
      echo '<div class="posted" id="posted'.$post['id'].'">'.$ftime.'</div>';
    }
      echo '
      <div class="pwl"> ';
      $nc = mysqli_fetch_array(queryMysql("SELECT * FROM postviews WHERE id='".$post['id']."'"));
      $nov = $nc['views'];
      if($nov == 0){
        $nofv = "No views";
      }
      elseif($nov == 1){
        $nofv = '1 view';
      }
      elseif($nov > 1 && $nov < 1000){
        $nofv = $nov."views";
      }
      elseif($nov > 1000 && $nov < 10000){
        $nofv = substr($nov, 0, 1)."k views";
      }
      elseif($nov > 10000 && $nov < 100000){
        $nofv = substr($nov, 0, 2)."k views";
      }
      elseif($nov > 100000 && $nov < 1000000){
        $nofv = substr($nov, 0, 3)."k views";
      }
      elseif($nov > 1000000 && $nov < 10000000){
        $nofv = substr($nov, 0, 1)."M views";
      }
      $cmmnt = $post['pnc'];
      if($cmmnt == 0){
        $ans = "No answers";
      }
      elseif($cmmnt == 1){
        $ans = '1 answer';
      }
      elseif($cmmnt > 1 && $cmmnt < 1000){
        $ans = $cmmnt."answers";
      }
      elseif($cmmnt > 1000 && $cmmnt < 10000){
        $ans = substr($cmmnt, 0, 1)."k answers";
      }
      elseif($cmmnt > 10000 && $cmmnt < 100000){
        $ans = substr($cmmnt, 0, 2)."k answers";
      }
      elseif($cmmnt > 100000 && $cmmnt < 1000000){
        $ans = substr($cmmnt, 0, 3)."k answers";
      }
      elseif($cmmnt > 1000000 && $cmmnt < 10000000){
        $ans = substr($cmmnt, 0, 1)."M answers";
      }
      if($fl == 1){
        $other  = 'other';
        global $other;
      }
      else {
        $other = 'others';
        global $other;
      }
        $dwns = "";
      if($rwvot == 0){
        $tvoc = "No reaction";
      }
      if($rwvot == 1){
        echo '
        <button type="submit" id="lbn">
        <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reaction</button>';
      
      $tvoc = "1 reaction";
      }
      elseif($rwvot > 1){
        echo '
        <button type="submit" id="lbn">
        <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reactions</button>';
      
      $tvoc = $fl." reactions";
      }
    echo "<div class='nfans tviews'><i class='fas fa-caret-up teyefig'
     style='color: green; font-size: 15px !important; padding-top: 0px !important;'></i>
    <div class='nmbcfcnt nofviews'>".$tvoc."</div></div>
    <div class='separator'><i class='fas fa-dot-circle'></i></div>
    <div class='nfans tviews'><i class='far fa-comment teyefig'></i>
    <div class='nmbcfcnt nofviews'>".$ans."</div></div>
    <div class='separator'><i class='fas fa-dot-circle'>
    </i></div><div class='tviews'><i class='fas fa-eye teyefig'></i>
    <div class='nofviews'>".$nofv."</div></div>";
      $dvs = queryMysql("SELECT *  FROM votes WHERE user='".$dsm['user']."' AND id='".$post['id']."'");
      if($dvs->num_rows){
        $dcolor = mysqli_fetch_array($dvs);
        if($dcolor['voted'] == 'upvote'){
          $mcolor = 'color: green';
        }
        else {
          $mcolor = "";
        }
        if($dcolor['voted'] == 'downvote'){
          $scolor = 'color: red';
        }
        else {
          $scolor = "";
        } 
      }
      else {
        $mcolor = "";
        $scolor = "";
      }
      echo '</div>
      <br><div class="undbtn"><div class="upv cmn dwn" id="upv'.$post['id'].'" 
      style="'.$mcolor.'" onclick="upvote(\''.$dsm['user'].'\', \''.$post['id'].'\')"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="cntl'.$post['id'].'"
       style="color: inherit !important;">'.$post['tun'].'</div>
      </div><div class="lwv cmn dwn" style="'.$scolor.'" id="dwn'.$post['id'].'" onclick="downvote(\''.$dsm['user'].'\', \''.$post['id'].'\')"><span style="vertical-align: sub"><i class="fas fa-caret-down ycd"></i></span></div>
      <div class="cmt cmn dwn" id="commt" onclick="c(\''.$post['id'].'\', \''.$dsm['user'].'\')">
      <button type="button" class="sbm">
      <span><i class="far fa-comment dwtwc"></i></span>
      <div class="cnt cmn xod xess" id="cntc'.$post['id'].'">'.$post['pnc'].'</div></button></div>
      <div class="shr cmn dwn" style="padding: 10px;">
      <span id="sh'.$post['id'].'" onclick="share(\''.$post['id'].'\')"><i class="fas fa-share"></i></span></div>
      <div id="oe'.$post['id'].'" class="oe" style="display: none;"><span class="close'.$post['id'].' closex"><i class="fas fa-arrow-left"></i></span>
      <div class="sfff"><div class="shrtpst">Share Post</div>
      <div class="sam">Share as message</div>
      <div class="rcntt"><input type="checkbox" class="selectall'.$post['id'].'" onclick="sall(\''.$post['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
      $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' OR ftwo='$user' order by lasttimeofmessage desc limit 5");
      if($mffs->num_rows==0){
        echo 'No recently messaged user';
      }
      else {
        while($gmffs = mysqli_fetch_assoc($mffs)){
          if($dsm['user'] == $gmffs['fone']){
            $nof = $gmffs['ftwo'];
          }
          else {
            $nof = $gmffs['fone'];
          }
          echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$post['id']."' onchange='gin(\"".$post['id']."\")'>".$nof."</div>";
        }
      }
      echo '<div class="orrsb"><div class="orrs">Others</div>';
      $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND type='following'");
      if($mfss->num_rows==0){
        echo 'No recently messaged user';
      }
      else {
        while($gmfss = mysqli_fetch_assoc($mfss)){
          echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$post['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$post['id']."\")'>".$gmfss['friend']."</div>";
        }
      }
      echo'</div></div><div id="countsend'.$post['id'].'">
      </div><button onclick="sendShare(\''.$dsm['user'].'\', \''.$post['pstst'].'\', \''.$post['id'].'\')">Send</buton>
      <div class="shasp">
      <div class="sap_h">Share as Post</div>
      <div class="thbtnfs">
      <button class="tp_s">
      <input type="hidden" value="'.$post['id'].'">
      Share</button>
      </div>
      </div>
      </div>
      </div></div>
      ';
      
              }
elseif($post['pstst'] == 1){
    # social post
    $pid = 's'.$post['id'];
    $pstcut = nl2br($post['pstcont']);
    $id = $post['id'];
    $gv = queryMysql("SELECT * FROM socposts WHERE id='$id'");
    $gvu = queryMysql("SELECT * FROM loves WHERE id='$id'");
    $id = $post['id'];
        $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
        $chlov = mysqli_fetch_array($lov);
        $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
        $chdwn = mysqli_fetch_array($dwnp);
        $rwlov = (int) mysqli_num_rows($lov); 
        $fl = $rwlov - 1;
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC LIMIT 1");  
        $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='liked' AND id='".$post['id']."'");
         $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='disliked' AND id='".$post['id']."'");
    if($gvu->num_rows > 0){
    $mg = "<div class='shp'><i class='far fa-heart' style='color: pink'></i>";
    
    $imgar = array();
   /* while($all = mysqli_fetch_array($gvu)){
        if(in_array($all['user'], $far)){
            for($i=0; $i < 2; $i++){
                // select 2 images
            array_push($imgar, $all['user']);
            }
            if($imgar[1] != isset($imgar[2])){
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[1].".png")){ 
                $mg .=  
                '<div class="raimg" 
                style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[1].'.png\')"></div>';
             }
            if(isset($imgar[2])){
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[2].".png")){ 
                $mg .=  '<div class="raimg" 
                style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[2].'.png\')"></div>';
             }
        }
    }
    else {
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$imgar[1].".png")){ 
            $mg .=  
            '<div class="raimg" 
            style="background-image: url(\'../../students_connect_hidden/users_profile_upload/'.$imgar[1].'.png\')"></div>';
         }
    }         
        }
    }
    $mg .= "</div>";
}
else {
    $mg = "<div class='shp'></div>";
}

}
if(file_exists("../../students_connect_hidden/users_profile_upload/".$post['user'].".png")){ 
    $img =  '../../students_connect_hidden/users_profile_upload/'.$post['user'].'.png';  
  }
    else {
        $img =  '../../../students_connect/user.png';
    }
if($post['isshare'] == 0){
echo <<<PSTS
    <div class='camp macamps'>
                 <div class='amps anamps' id='$pid'>
                 <div class='ipt'></div><div class='namp'>
                 <div class='pstname' style='display:flex;'>
                 <a href='/students_connect/user/$pstr'>
                 <div class='imgfpstr' style='background-image: url("$img");'></div>
                       <div class='name'>$fname</a></div>
                     </div></div>
PSTS;
                echo '<div class="mpst">';
                   $pstcut = strlen($post['pstcont']) > 250 ? substr($post['pstcont'], 0, 250).'&hellip;
                   <div class="readmore">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['pstcont'];
              echo nl2br($pstcut).'</div>
              <div class="allimgposted"><div class="postimages">';
                $arr = array();
                $td = getcwd();
                chdir("../../students_connect_hidden/postuploads/s/");
                for($i = 0; $i < 20; $i++){ 
                    if(file_exists($post['id']."(".$i.").png")){
                      $files[$i] = "/Students_connect_hidden/postuploads/s/".$post['id']."(".$i.").png";
                      array_push($arr, $files[$i]);
                    }
                  }
                  chdir($td);
              $data = count($arr);
              $da = $data/2;
                echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s/");
                for($i = 0; $i < 6; $i++){ 
                  if(file_exists($post['id']."(".$i.").png")){  
                    echo "
                    <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$post['id']."(".$i.").png'></div>";
              }
                  else {
                    echo "";                     }
                  }
                chdir($td);
              echo '</div></div></div></div>
              <div class="posted">'.date("M d h:i a", $post['timeofupdate']).'</div>';
            }
            else {
              if($post['sharedby'] == $mbs['user']){
                  $shrus = 'You';
                }
                else {
                    $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                }
                $shr = $shrus." shared <a href='/students_connect/user".$mbse['user']."'>
                <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                echo <<<PSTS
                <div class='camp macamps'>
                 <div class='amps anamps' id='$pid'>
                 <div class='ipt'></div><div class='namp'>
                 <div class='pstname' style='display:flex;'>
                 <a href='/students_connect/user/$pstr'>
                 <div class='imgfpstr' style='background-image: url("$img");'></div>
                       <div class='name'>$fname</a></div>
                     </div></div>
                PSTS;
                echo '<div class="mpst" id="mpst'.$post['id'].'" style="min-height: 30px;">';
                $pstcute = strlen($post['sharedpstcont']) > 250 ? substr($post['sharedpstcont'], 0, 250).'&hellip;
                <div class="readmore" onclick="rdmore(\''.$post['id'].'\')" id="readmr'.$post['id'].'">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['sharedpstcont'];
                echo nl2br($pstcute).'</div>';
                $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/");
                if(file_exists($mbse['user'].".png")){ 
                  $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'.png';
                  chdir($td);  
                }
                  else {
                    chdir($td);
                      $simg =  '/Students_connect/user.png';
                  }
                echo "<div class='eap' style='padding-bottom: 40px;'>
                <div class='tsp' onclick='ops(\"".$post['sharedpostid']."\",\"".$post['sharedby']."\")'
                 style='cursor: pointer; min-height: 120px;'>
                <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div>";
                echo '<div class="mpst" id="mpst'.$post['id'].'">';
                $pstcut = strlen($post['pstcont']) > 250 ? substr($post['pstcont'], 0, 250).'&hellip;
                <div class="readmore" onclick="rdmore(\''.$post['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $post['pstcont'];
                echo nl2br($pstcut).'</div>
                <div class="allimgposted"><div class="postimages">';
                $arr = array();
                $td = getcwd();
                chdir("../../students_connect_hidden/postuploads/s");
                for($i = 0; $i < 20; $i++){ 
                    if(file_exists($post['sharedpostid']."(".$i.").png")){
                      $files[$i] = "/Students_connect_hidden/postuploads/s/".$post['sharedpostid']."(".$i.").png";
                      array_push($arr, $files[$i]);
                    }
                  }
                  chdir($td);
              $data = count($arr);
              $da = $data/2;
                echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                $td = getcwd();
                  chdir("../../students_connect_hidden/postuploads/s");
                for($i = 0; $i < 6; $i++){ 
                  if(file_exists($post['sharedpostid']."(".$i.").png")){  
                    echo "
                    <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$post['sharedpostid']."(".$i.").png'></div>";
              }
                  else {
                    echo "";                     }
                  }
                chdir($td);
                echo '</div></div></div>
                </div></div>';
                echo '<div class="posted">'.date("M d h:i a", $post['timeofupdate']).'</div>';
            }
            echo '</div></div>';
            }
    $e++;

}
*/
echo <<<GODMAKEMYWORKPROSPER
    <input type='hidden' value='15' id='pnum'>
    <div id='more'></div>
    <div class='mf_dje' style='position: relative; width: 100%; bottom: 0px;'>
    <div class='fp_pplw'>
    <div class='f_eppee'>Fetching Posts. Please Wait</div>
    </div>
    <div id='br_kk_ea'>
    </div>
    </div>
    </div></div>
    <div class='mspst'>
    </div><div class='mspsticon' title='Messages'><a href='/students_connect/messages/'><div class='tpcc' 
    style="background-image: url(
    GODMAKEMYWORKPROSPER;
    if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){ 
    echo "'../../../../../students_connect_hidden/users_profile_upload/$user/$user.png');";
    }
    else {
        echo "'../user.png');";
    }
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='$user' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    echo <<<GODMAKEMYWORKPROSPER
    background-repeat: no-repeat;
    height: 50px; width: 50px; bottom: 100px; right: 20px; position: fixed; 
    border-radius: 50px; background-size: 100%;"><i class='fas fa-envelope' style='float: right; color: black;
    bottom: -5px; right: 5px; position: absolute; color: red;'></i><span class='nofmg'>$cntnm</i></div></a></div>
GODMAKEMYWORKPROSPER;
$changes = enc($surelyoccured);
$schanges = enc($ssurelyoccured);
echo <<<_END
    <input type='hidden' value='$changes' id='tpe0'/>
    <input type='hidden' value='$schanges' id='tpel0'/>
    <input type='hidden' value='3' id='bthm'/>
    <input type='hidden' value='0' id='r_round'/>
    <script>
    $(window).scroll(function(){
      if($(window).scrollTop() == ($(document).height() - $(window).height())){
          lmore();
        }
  })
function lmore(){
    var r = document.getElementById('r_round').value;
    var pel = document.getElementById('tpe'+r).value;
    var pell = document.getElementById('tpel'+r).value;
    var lp = document.getElementById('bthm').value;
    var p = document.getElementById('pnum').value;
    $.post("lmore.php",
    {
        su:pel,
        ssu: pell,
        end:p,
        la:p,
        r:r
    },
    function(data){
      document.getElementById('pnum').value = parseInt(p) + 10;
      document.getElementById('bthm').value = parseInt(lp) + 4;
      document.getElementById('r_round').value = parseInt(r) + 1;
      $(data).insertBefore($('#more'));
      for(var i =0; i < document.scripts.length; i++){
        if(document.scripts[i].src.includes('tckreader.js')){
          var oxe = document.createElement('script');
          oxe.src = '/students_connect/jsf/tckreader.js';
          document.scripts[i].replaceWith(oxe);
      }
      }
  })
}
function newpost(){
  $.post("new.php",
  {

  },
  function(data){
    if(data.length > 0){
      var ii = document.createElement('div');
      ii.innerHTML = data;
      var tq = document.getElementsByClassName('dfp_A')[0];
      tq.insertBefore(ii, tq.childNodes[0]);
    }
  })
}
if(window.innerWidth > 799){
var modal = document.getElementById('dispst');

// Get the button that opens the modal
var btn = document.getElementById("pbtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
}
if(window.innerWidth < 799){
  var wxd = document.getElementsByClassName('adpsticon')[0];
  wxd.onclick = function(){
    var t = document.getElementById('dispst').style.display;
    if(t=='none'){
      document.getElementById('dispst').style.display = 'block';
      document.getElementById('tbck_o_btn').style.display = 'block';
      document.getElementsByClassName('dfp_A')[0].style.display = 'none';
      document.getElementsByClassName('dfp_A')[0].style.position = 'fixed';
      document.getElementsByClassName('adpost')[0].style.display = 'none';
    }
  }
}
var et = document.getElementById('tbck_o_btn');
et.onclick = function(){
  document.getElementById('dispst').style.display = 'none';
      document.getElementById('tbck_o_btn').style.display = 'block';
      document.getElementsByClassName('dfp_A')[0].style.display = 'block';
      document.getElementsByClassName('dfp_A')[0].style.position = 'relative';
      document.getElementsByClassName('adpost')[0].style.display = 'block';
      this.style.display = 'none';
    }
    setTimeout(function(){
      for(var i =0; i < document.scripts.length; i++){
        if(document.scripts[i].src.includes('filescript.js')){
          var oxe = document.createElement('script');
          oxe.src = '/students_connect/jsf/filescript.js';
          document.scripts[i].replaceWith(oxe);
        }
      }
    }, 2000)
</script>
<script src='/students_connect/jsf/filescript.js'></script>
_END;
?>