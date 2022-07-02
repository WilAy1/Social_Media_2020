<?php
    session_start();
    define("loot", "/Users/wilay/students_connect/");
    require_once loot.'connect.php';
    if(isset($_POST['shpid']) && isset($_POST['shptype']) && isset($_POST['spcont']) && !empty($_POST['spcont'])){
        $pru = $_SESSION['user'];
        $erst = queryMysql("SELECT * FROM members WHERE user='$pru'");
        $timeofupdate = time();
        if($erst->num_rows){
            $pprst = mysqli_fetch_array($erst);
            $user = $pprst['user'];
            $ptype = $_POST['shptype'];
            $spid = $_POST['shpid'];
            $sharedpostcont = sanitizeString($_POST['spcont']);
            
            if($ptype == '0' || $ptype == '1'){
            if($ptype == '0'){
                $into = 'eduposts';
                $rro = '';
                $myid = '$mid';
            }
            elseif($ptype == '1'){
                $into = 'socposts';
                $rro = 's';
                $myid = '$myid';
            }
            $sharedpostcont = str_replace("\\r\\n", " \r\n ", $sharedpostcont);
    $nsp = explode("\\r\\n", $sharedpostcont);
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
        queryMysql("INSERT INTO hashtags VALUES('$id', '$user', '$ins', '$ptype', '$timeofupdate')");
        $cch = queryMysql("SELECT * FROM hashtagsbase WHERE tagname='$ins'AND type='$ptype'");
        if($cch->num_rows){
          $dce = mysqli_fetch_array($cch);
          $cn = $dce['numberofusages'];
          $increment = (int) ++$cn;
          queryMysql("UPDATE hashtagsbase SET numberofusages='$increment' WHERE tagname='$ins'AND type='$ptype'");
        }
        else {
          queryMysql("INSERT INTO hashtagsbase VALUES('$id', '$user', '$ins', '$ptype','1', '$timeofupdate')");
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
          $sharedpostcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/tags/?hashtag=$sns").">"
        .$ns."</a>", $sharedpostcont);
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
            $prt = queryMysql("SELECT * FROM $into WHERE id='$spid'");
            if($prt->num_rows){
            $gprt = mysqli_fetch_array($prt);
            if($gprt['isshare'] == '0'){
              $pid = $gprt['id'];
              $ppost = $gprt['pstcont'];
            }
            else {
              $pid = $gprt['id'];
             // $moth = mysqli_fetch_array(queryMysql("SELECT * FROM $into WHERE id "))
              $ppost = $gprt['sharedpstcont'];
            }
            $id = 0;
            $puser = $gprt['user'];
            $time = time();
            $isshare = '1';
            $interest = $gprt['pinterest'];
            queryMysql("INSERT INTO $into VALUES('$puser', '0', '$id', '$ppost', '$ptype', '$time', '$isshare', '$user', '$pid', '$sharedpostcont', '0', '0', '0', '0', '0', '$interest')");
            queryMysql("INSERT INTO ".$rro."postviews VALUES('$id', '0')");
            $a = mysqli_fetch_array(queryMysql("SELECT * FROM $into WHERE user='$puser' AND sharedby='$user' AND isshare='1' AND timeofupdate='$time' ORDER BY timeofupdate DESC"));
        $gcd = getcwd();
       chdir("../posts");
       mkdir($rro.$a['id']);
       $f = fopen($rro.$a['id'].'/index.php', "w");
       fwrite($f, "
       <?php
       ".$myid." = '".$a['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'posts/pst/index.php';
      ?>");
        }
        
        }
        }
    }
?>