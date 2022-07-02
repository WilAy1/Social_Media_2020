<?php
    define("x", "/Users/wilay/students_connect/");
    require_once x."/connect.php";
    require_once x."/header2.php";
    require_once x."/comment/replycomments/index.php";
    require_once x."/comment/index.php";
    require_once x."/comment/soccomment.php";
    require_once x."/comment/replycomments/replyreplies/index.php";
    require_once x."/notification/addnotification.php";
    if(!$loggedin) die();
else {
  echo <<<BS
  <script>
  var pid = 'tpid';
  var cid = 'tcid';
  var ck = document.cookie.split(';');
  for(var i=0; i<ck.length; i++) {
      var x = ck[i];
      while (x.charAt(0)==' ') x = x.substring(1);
      if (x.indexOf(pid) == 0)
      var d = x.substring(pid.length+1,x.length);
      if (x.indexOf(cid) == 0)
      var e = x.substring(cid.length+1,x.length);    
  }
  if(d != undefined && e != undefined){
          var wrk = 'dbsb'.concat(e);
          var shw = 'dsplrp'.concat(e);
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(shw).innerHTML = xmlhttp.responseText;
                document.getElementById(wrk).style.display = 'none';
            }
        };
        xmlhttp.open('GET', '/students_connect/posts/pst/fetchreply.php?p='+ d +'&c='+e);
        xmlhttp.send();
      }
        </script>
  BS;
  if(isset($_GET['i']) && isset($_GET['1'])){
    $id = $_GET['i'];
  $get = queryMysql("SELECT * FROM votes WHERE id='$id'");
  $user = $_SESSION['user'];
  $chus = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
    $id = $_GET['i'];
    $chpst = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $chmnou = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
      $chmnouf = mysqli_fetch_array($chmnou);
      $a = $chmnouf['voted'];
  if($a == 'upvote'){
    // do nothing
  }
  elseif ($a == 'downvote'){
    $upvote = 'upvote';
    $time = time();
    queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = ++$new['tun'];
    $tdn = --$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  else {
    $voted = 'upvote';
    $time = time();
    queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = (int) ++$new['tun'];
    $tdn = (int) $new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
    }
    
  
if (isset($_GET['d']) && isset($_GET['2'])){
  $id = $_GET['d'];
  $user = $_SESSION['user'];
  $chmnod = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
  $chmnodf = mysqli_fetch_array($chmnod);
  $a = 'downvote';
  if($chmnodf['voted'] == $a){
    // do nothing
  }
  elseif($chmnodf['voted'] == 'upvote'){
    $upvote = 'downvote';
    $time= time();
    queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = --$new['tun'];
    $tdn = ++$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  else {
    $voted = 'downvote';
    $time = time();
    queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = $new['tun'];
    $tdn = ++$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  }



  if(isset($_GET['de']) && isset($_GET['e'])) {
    $id = $_GET['de'];
    $user = $_SESSION['user'];
    queryMysql("DELETE FROM eduposts WHERE id='$id'");
    queryMysql("DELETE FROM votes WHERE id='$id'");
    queryMysql("DELETE FROM educomments WHERE postid='$id'");
  }
  if(isset($_GET['de']) && isset($_GET['s'])) {
    $id = $_GET['de'];
    $user = $_SESSION['user'];
    queryMysql("DELETE FROM socposts WHERE id='$id'");
    
  }
  if(isset($_POST['upeducommentid']) && 
  isset($_POST['upedupostid']) && isset($_POST['user'])){
    $ctid = $_POST['upeducommentid'];
    $ptid = $_POST['upedupostid'];
    $uuser = sanitizeString($_POST['user']);
    $ot = 0;
    $tm = time();
    $id = 0;
    $cfc = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='$uuser' AND postid='$ptid'
     AND commentid='$ctid'"));
    if($cfc['voted'] == 'upvote'){

     }
    elseif($cfc['voted'] == 'downvote'){
      $uv = 'upvote';
      $tm = time();
      queryMysql("UPDATE commentvotes SET voted='$uv',
      timeofcommentvote='$tm' WHERE user='$uuser' AND commentid='$ctid' AND postid='$ptid'");
      $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
          $tun = ++$cmc['tun'];
          $tdn = --$cmc['tdn'];
          queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$ctid'");  
  }
    else {
    queryMysql("INSERT INTO commentvotes VALUES ('$id', '$uuser', 
    'upvote', '$ptid', '$ctid', '$ot', '$ot', '$tm'
    )");
     $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
     $tun = (int) ++$cmc['tun'];
     $tdn = (int) $cmc['tdn'];
     queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$ctid'");
    }
  }
  if(isset($_POST['dwneducommentid']) && isset($_POST['dwnedupostid'])
   && isset($_POST['user'])){
    $dctid = $_POST['dwneducommentid'];
    $dptid = $_POST['dwnedupostid'];
    $uuser = sanitizeString($_POST['user']);
    $ot = 0;
    $tm = time();
    $id = 0;
    $cfc = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='$uuser' AND postid='$dptid'
     AND commentid='$dctid'"));
    if($cfc['voted'] == 'downvote'){

     }
    elseif($cfc['voted'] == 'upvote'){
      $uv = 'downvote';
      $tm = time();
      queryMysql("UPDATE commentvotes SET voted='$uv',
      timeofcommentvote='$tm' WHERE user='$uuser' AND commentid='$dctid' AND postid='$dptid'");
      $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
          $tun = --$cmc['tun'];
          $tdn = ++$cmc['tdn'];
          queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");  
  }
    else {
    queryMysql("INSERT INTO commentvotes VALUES ('$id', '$uuser', 
    'downvote', '$dptid', '$dctid', '$ot', '$ot', '$tm'
    )");
     $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
     $tun = (int) $cmc['tun'];
     $tdn = (int) ++$cmc['tdn'];
     queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");
    }
   }
}

    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    echo <<<_END
    <div class="navbar2">
    <ul id="navbar_list">
    <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home">
    <span class='h_shn12w'><i class='fas fa-circle'></i></span>
    </i>
    </a>
    </li>
    <li id="hmic" style=''><a href="/students_connect/trend"><i class="fas fa-bolt"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="far fa-envelope">
    _END;
    if($cntnm>0){
    echo "<span class='h_shn12w s_thmiw'><span>".$cntnm."</span></span>";
    }
    echo <<<_END
    </i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="far fa-bell"></i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
    _END;
    if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    echo <<<_END
      </ul>   
      </div>
      <div class='o_success'></div>
  <div class='pycl'>
  
  <div onload="checkDark()" class="dark-mode" id='darkmd'  style="min-height:650px;">
  _END;
  if(isset($_SERVER['HTTP_REFERER'])){
  echo "<div class='gb2pp' onclick='goBack(\"".$_SERVER['HTTP_REFERER']."\")' style='cursor: pointer; color: blue;'><a href='".$_SERVER['HTTP_REFERER']."'>Go Back</a></div>";
  }      
  if(isset($_GET['pid']) || isset($mid) && !isset($_GET['vl'])){
            if(isset($_GET['pid'])){
            $postid = $_GET['pid'];
            }
            elseif($mid){
              $postid = $mid;
            }
            $cmtid = 0;
            $request = queryMysql("SELECT * FROM eduposts WHERE id='$postid'");
            if($request->num_rows){
                $edu = (queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));  
          $medu = mysqli_fetch_assoc($edu);
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
          $us = $medu['user'];
          $usr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$us'"));
          if($row['user'] != $usr['user']){
            $xuv = queryMysql("SELECT * FROM postviews WHERE id='$postid'");
            $uvs = mysqli_fetch_array($xuv);
            if($xuv->num_rows){
            $uvsv = (int) ++$uvs['views'];
            queryMysql("UPDATE postviews SET views='$uvsv' WHERE id='$postid'");
            }
          }
          $n = (queryMysql("SELECT pstcont FROM eduposts WHERE user='$user' AND sharedby='$user'"));
          $id = $medu['id'];
          $vot = queryMysql("SELECT * FROM votes WHERE id='$id' ORDER BY timeofvote DESC");
          $chvot = mysqli_fetch_array($vot);
          $rwvot = (int) mysqli_num_rows($vot); 
          $dwnp = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='downvote'");
          $chdwn = mysqli_fetch_array($dwnp);
          $fl = $rwvot - 1;
          $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC");         
          $geteducomment = mysqli_fetch_array($educomment);              
              $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
              if($medu['isshare'] == 0){
                echo <<<PSTS
                <div class='camp camps'>
                PSTS;
                
                echo <<<PSTS
                 <div class='amps iiamps' style='box-shadow: none;' id='
                PSTS;
                echo $medu['id']."'>";
                echo <<<PSTS
                    <div class='ipt'></div><div class='namp'>
              PSTS;
              $td = getcwd();
              chdir("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
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
                echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                <div class='name'>".$mbse['firstname']." ".$mbse['surname']."
                <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div><div class='typef' style='color: grey'>Educational</div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                $pstcut = $medu['pstcont'];
                echo nl2br(rhash($pstcut)).'</div>';
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
                  chdir("../../../students_connect_hidden/postuploads/");
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
                  chdir("../../../students_connect_hidden/postuploads/");
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
                    <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp4' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio controls class='paudio'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>
                <div class="posted i_posted">'.$ftime.'</div>';
              }
              else {
                if($medu['sharedby'] == $mbs['user']){
                  $shrus = 'You';
                }
                else {
                    $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                }
                $shr = $shrus." shared <a href='/students_connect/user/".$mbse['user']."'>
                <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                echo <<<PSTS
                <div class='camp camps'>
                PSTS;
                echo <<<PSTS
                 <div class='amps iiamps' id='
                PSTS;
                echo $medu['id']."'>";
                echo <<<PSTS
                    <div class='ipt'></div><div class='namp'>
              PSTS;
              $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
              $td = getcwd();
                chdir("../../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
              if(file_exists($mbss['user'].".png")){ 
                $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
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
                <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                $pstcute = $medu['sharedpstcont'];
                echo nl2br(rhash($pstcute)).'</div>';
                $td = getcwd();
                chdir("../../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
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
                <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                $pstcut = $medu['pstcont'];
                echo nl2br($pstcut).'</div>
                <div class="allimgposted"><div class="postimages">';
                $arr = array();
                $td = getcwd();
                chdir("../../../students_connect_hidden/postuploads/");
                for($i = 0; $i < 20; $i++){ 
                    if(file_exists($medu['sharedpostid']."(".$i.").png")){
                      $files[$i] = "/Students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png";
                      array_push($arr, $files[$i]);
                    }
                  }
                  chdir($td);
              $data = count($arr);
              $da = $data/2;
                echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/");
                for($i = 0; $i < 6; $i++){ 
                  if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                    echo "
                    <div class='postimages'>
                    <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                    <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png'></div>";
              }
                  else {
                    echo "";                     }
                  }
                chdir($td);
                echo '</div></div></div>
                </div></div>';
                echo '<div class="posted i_posted">'.$ftime.'</div>';
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
                echo '</div><div class="undbtn"><div class="upv cmn dwn" id="upv'.$medu['id'].'" 
                style="'.$mcolor.'" onclick="upvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="cntl'.$medu['id'].'"
                 style="color: inherit !important;">'.$medu['tun'].'</div>
                </div><div class="lwv cmn dwn" style="'.$scolor.'" id="dwn'.$medu['id'].'" onclick="downvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span style="vertical-align: sub"><i class="fas fa-caret-down"></i></span></div>
                <div class="cmt cmn dwn" id="commt" onclick="c(\''.$medu['id'].'\', \''.$row['user'].'\')">
                <button type="button" class="sbm">
                <span><i class="far fa-comment"></i></span>
                <div class="cnt cmn" id="cntc'.$medu['id'].'">'.$medu['pnc'].'</div></button></div>
                <div class="shr cmn dwn" style="padding: 10px;">
                <span id="sh'.$medu['id'].'" onclick="share(\''.$medu['id'].'\')"><i class="fas fa-share"></i></span></div>
                <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' close">x</span>
                <div class="sfff"><div class="shrtpst">#'.$medu['id'].' Share Post</div>
                <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="0">
                     </button>
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
                </div><div onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</div>
                </div></div>
                </div></div>
                ';
                echo "<div class='lkkl_jk'>";
                  if(mysqli_num_rows($educomment) == 0){  
                    //leave space blank
                  }
                  else {
                    $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC");
                    while($geteducomment = mysqli_fetch_array($educomment)){
                    $aus = $geteducomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    $getreplyn = queryMysql("SELECT * FROM replyeducomments WHERE postid='".$geteducomment['postid']."' AND cmtid='".$geteducomment['id']."'");
                    if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                      global $vpns;
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='openReplyContent(".$geteducomment['id'].", \"".$geteducomment['postid']."\")' id='dbsb".$geteducomment['id']."' 
                    >View ".$p."
                     ".$r."</button></div>
                     ";
                    global $vpns;
                  }
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
                     if(file_exists("../../../students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/'.$geteducomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$geteducomment['user'].'/'.$geteducomment['user'].'.png';
                      }
                      else {
                          $pimg =  '/students_connect/user.png';
                      }
                  $plswrk = $geteducomment['id'];
                  $geucd = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$geteducomment['user']."'"));  
                  echo "
                    <div class='comment_section1' id='a$cmtid' style='padding-top: 35px;'>
                    <div class='fet' style='display: flex;'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div>
                    <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$geteducomment['id']."'>
                    <a href='/students_connect/user/".$upc['user']."'><i></i>
                    <div class='xk_nm'>".$geucd['surname']." ".$geucd['firstname']."</div>
                    <div class='sk_un'><i class='fas fa-at'></i>".$geucd['user']."</div>
                    </a></div>
                    <div class='comcnt'>".rhash(wordwrap($geteducomment['cmt'], 60, "<br />"))."</div>";
                    $arr = [];
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists('../../../students_connect_hidden/comments/'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png')){
                        $files[$i] = '../../../students_connect_hidden/comments/'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png';
                        array_push($arr, $files[$i]);
                      }
                    }
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.'; margin-left: 3px; width: 90%;"><div class="aimg">';
                  $td = getcwd();
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists('../../../students_connect_hidden/comments/'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png')){
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Trq' style='background-image: url(\"/students_connect_hidden/comments/".$geteducomment['id']."/".$geteducomment['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/comments/".$geteducomment['id'].'/'.$geteducomment['id']."(".$i.").png'></div>";
                    }
                  }
                  echo "</div></div>";
                    echo "
                    <div class='posted i_posted'>".date('Y M d h:i a', $geteducomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                    <span onclick='ducm(\"".$medu['id']."\",
                    \"".$geteducomment['id']."\", \"".$mbs['user']."\")'><i class='fas fa-caret-up'
                     style='$clrr' id='ror".$geteducomment['id']."'></i><span class='tccnt' id='utcnt".$geteducomment['id']."'>
                     ".$geteducomment['tun']."</span></span>
                    </div><div class='cdv ccmn cdwn'><span 
                    onclick='ddcm(\"".$medu['id']."\",
                    \"".$geteducomment['id']."\", \"".$mbs['user']."\")'><i class='fas fa-caret-down'
                     style='$clerr' id='dror".$geteducomment['id']."'></i><span class='tccnt' id='dutcnt".$geteducomment['id']."'
                     >".$geteducomment['tdn']."</span></span></div>
                    <div class='cshr ccmn cdwn'  onclick='openReply(".$geteducomment['id'].");' id='reply".$geteducomment['id']."'>
                    <input type='hidden' name='pid' value='".$medu['id']."'>
                    <input type='hidden' name='cid' value='".$geteducomment['id']."'>
                    <button type='submit' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                    <div class='cupv ccmn cdwn report'>Report</div>
                    </div></div></div>
                    <div class='adrep' id='rep".$geteducomment['id']."' style=' display: none;'>
                    <form action='#".$geteducomment['id']."' method='post' name='eccom'>
                    <div class='why_now'>
                    <div class='fto'>
                    <textarea class='ikanimi' id='replypst".$geteducomment['id']."' name='cmtreplyedupst' placeholder='Replying @".$upc['user']."' value='' title='Input Reply'  rows='2' style='margin: 0px; border: none; resize: none;' wrap: hard;'></textarea></div>
                    <div class='gee' style='vertical-align: middle; padding-left: 5px;
                    '><label for='senrepdbutton".$geteducomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
                    </div>
                    <input type='hidden' name='postid' value='".$geteducomment['postid']."'>
                    <input type='hidden' name='cmtid' value='".$geteducomment['id']."'>
                    <input type='submit' id='senrepdbutton".$geteducomment["id"]."' style='display: none !important'/>
                    </div>
                    </form>
                    </div>
                    ".$vpns."<div id='dsplrp".$geteducomment['id']."' class='dsplrp'></div>
                    </div>
                    ";
                  }
                }
                echo '</div></div>
                  </div>';
                echo '<div class="addcom mos must" id="addcom"><form action="#'.$medu['id'].'" id="'.$medu['id'].'" method="POST" name="ecpid"><div class="wcb"><div class="cmttxt">
                    <textarea name="cmtedupst" id="cmttextarea" placeholder="Comment..."" value="" title="Input Comment"  rows="2" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                    </div><div class="sndbtn"><label for="sendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                    <input type="hidden" name="postid" value="'.$medu['id'].'">
                    <input type="hidden" name="user" value="'.$mbs['user'].'">
                    <input type="file" name="esfile[]" multiple max="2" id="sfile" accept="image/*" style="display: none"/>
                    <label for="sfile" class="fsfile"><i class="fas fa-camera"></i></label>
                    <input type="submit" id="sendbutton'.$medu['id'].'" style="display: none !important;"/></div>
                    </div></form></div>';          
                  
              }
            else {
                echo "<div class='pdex' style='font-size: 25px; margin:auto;'>Post doesn't exist</div>
                <div class='gb2hp'><a href='/students_connect/h'>Go back to home</a></div>";
            }
        }
        if(isset($_GET['vl'])){
            $postid = $mid;
            $request = queryMysql("SELECT * FROM eduposts WHERE id='$postid'");
            if($request->num_rows){
              echo "";
              /*  
              $edu = (queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));  
          $medu = mysqli_fetch_assoc($edu);
          $n = (queryMysql("SELECT pstcont FROM eduposts WHERE user='$user' AND sharedby='$user'"));
          $id = $medu['id'];
          $vot = queryMysql("SELECT * FROM votes WHERE id='$id' ORDER BY timeofvote DESC");
          $chvot = mysqli_fetch_array($vot);
          $rwvot = (int) mysqli_num_rows($vot); 
          $dwnp = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='downvote'");
          $chdwn = mysqli_fetch_array($dwnp);
          $fl = $rwvot - 1;
          $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC");
          $geteducomment = mysqli_fetch_array($educomment);
          $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
              if($medu['isshare'] == 0){
              echo <<<PSTS
                  <div class='camp camps'>
                  PSTS;
                  echo <<<PSTS
                   <div class='amps iiamps' id='
                  PSTS;
                  echo $medu['id']."' style='box-shadow: none;'>";
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                PSTS;
                if(file_exists("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/'.$medu['user'].".png")){ 
                     $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
                  }
                  else {
                      $img =  '/students_connect/user.png';
                  }
                  if($n->num_rows){
                    $en = ": ".mysqli_num_rows($n)." Post(s)";
                  }
                  else {
                    $en = "";
                  }
                  echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div><div class='typef' style='color: grey'>Educational</div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                  $pstcut = $medu['pstcont'];
                  echo nl2br(rhash($pstcut)).'</div>
                  <div class="postimages">';
                  for($i = 0; $i < 6; $i++){
                    if(file_exists("../Students_connect_hidden/postuploads/".$medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postedimages' style='background-image: url(\"../../../students_connect_hidden/postuploads/".$medu['id']."(".$i.").png\");
                      height: 80px;
                      width: 80px; 
                      background-repeat: no-repeat;
                      background-size: 100%; cursor: pointer; vertical-align: middle;
                      background-position: 50% 50%;'></div>";
                }
                    else {
                      echo "";                     }
                  }
                  
                  echo '</div>
                  <div class="posted i_posted">'.$ftime.'</div>';
                }
                else {
                  if($medu['sharedby'] == $mbs['user']){
                    $shrus = 'You';
                  }
                  else {
                      $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                  }
                  $shr = $shrus." shared <a href='/students_connect/user/".$mbse['user']."'>
                  <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                  echo <<<PSTS
                  <div class='camp camps'>
                  PSTS;
                  echo <<<PSTS
                   <div class='amps iiamps' id='
                  PSTS;
                  echo $medu['id']."' style='box-shadow: none;'>";
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                PSTS;
                $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                if(file_exists("../../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/'.$mbss['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                  }
                  else {
                      $img =  '/students_connect/user.png';
                  }
                  echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbss['userprofilecode']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                  $pstcute = $medu['sharedpstcont'];
                  echo nl2br(rhash($pstcute)).'</div>';
                  if(file_exists("../../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/'.$mbse['user'].".png")){ 
                    $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                    }
                    else {
                        $simg =  '/students_connect/user.png';
                    }
                  echo "<div class='eap' style='padding-bottom: 40px;'>
                  <div class='tsp' onclick='op(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                   style='cursor: pointer; min-height: 120px;'>

                   <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                  <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div>";
                  echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                  $pstcut = $medu['pstcont'];
                  echo nl2br($pstcut).'</div></div></div>';
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
                  if($chvot['user'] == $user){
                  $chvot['user'] = 'You';
                  if($rwvot == 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="pid" value="'.$medu["id"].'">
                    <input type="hidden" name="vl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$dwns.' '.ucfirst($chvot['user']).' reacted</button></form>';
                  }
                  elseif($rwvot > 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="pid" value="'.$medu["id"].'">
                    <input type="hidden" name="vl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$dwns.' '.ucfirst($chvot['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                  }
                }
                else {
                  if($rwvot == 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="pid" value="'.$medu["id"].'">
                    <input type="hidden" name="vl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$dwns.' '.ucfirst($chvot['user']).' reacted</button></form>';
                  }
                  elseif($rwvot > 1){
                    echo '<form action="/students_connect/posts/pst"><input type="hidden" name="pid" value="'.$medu["id"].'">
                    <input type="hidden" name="vl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="fas fa-caret-up" style="color: green"></i>'.$dwns.' '.ucfirst($chvot['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                  }
                }
                if($medu['user'] === $row['user']){
                  $iown = '';
                }
                else {
                  $iown = '';
                }
                  echo '</div>
                  <br><div class="undbtn"><div class="upv cmn dwn"><a href="?pid='.$medu['id'].'&cid='.$geteducomment['id'].'&i='.$medu['id'].'&1#'.$medu['id'].'"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn">'.$medu['tun'].'</div></a>
                  </div><div class="lwv cmn dwn"><a href="?pid='.$medu['id'].'&cid='.$geteducomment['id'].'&d='.$medu['id'].'&2#'.$medu['id'].'"><span><i class="fas fa-caret-down"></i></span><div class="cnt cmn">'.$medu['tdn'].'</div></a></div>
                  <div class="cmt cmn dwn" id="commt" onclick="displayComment()">
                  <form action="/students_connect/posts/pst#'.$geteducomment["id"].'" method="GET">
                  <input type="hidden" name="pid" value="'.$medu["id"].'">
                    <input type="hidden" name="cid" value="'.$geteducomment["id"].'">
                    <button type="submit" class="sbm">
                  <span><i class="far fa-comment"></i></span>
                  <div class="cnt cmn">'.$medu['pnc'].'</div></button></form></div><div class="shr cmn dwn" style="padding: 10px;">
                  <span><i class="fas fa-share"></i></span></div>
                  <div class="oth cmn dwn">'.$iown.'</div></div>';
                  $vt = queryMysql("SELECT * FROM votes WHERE id='$postid'");
                  echo "<div class='uplis'>".mysqli_num_rows($vt)." Reactions";
                while($vta = mysqli_fetch_array($vt)){
                  $nm = $vta['user'];
                  $gto = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nm'"));
                    if($vta['voted'] == 'upvote'){
                    $ity = "<i class='fas fa-caret-up' id='wwl' style='color: green'></i>";
                    global $ity;
                }
                  elseif($vta['voted'] == 'downvote'){
                      $ity = "<i class='fas fa-caret-down' id='wwl' style='color: red'></i>";
                        global $ity;
                    }
                  echo "<div class='shli'>".$ity." <div class='septm'><a href='/students_connect/user/".$gto['user']."'>".$gto['firstname']." ".$gto['surname']. " (<i class='fas fa-at'></i>".$gto['user'].")
                  </a></div></div>
                  ";
                  }*/
            }
            else {
                echo "Post doesn't exist";
            }
            echo "</div>";
        }

    if(isset($_GET['spid'])|| isset($myid)){
      if(isset($_GET['spid'])){
        $postid = $_GET['spid'];
      }
      elseif(isset($myid)){
        $postid = $myid;
      }
            $request = queryMysql("SELECT * FROM socposts WHERE id='$postid'");
            if($request->num_rows){  
              $edu = (queryMysql("SELECT * FROM socposts WHERE id='$postid'"));  
          $medu = mysqli_fetch_assoc($edu);
          if($medu['user'] != $row['user']){
          $cic = queryMysql("SELECT * FROM spostviews WHERE id='".$medu['id']."'");
          if($cic->num_rows){
            $mhed = mysqli_fetch_array($cic);
            $oppp = $mhed['views']+1;
            queryMysql("UPDATE spostviews SET views='$oppp' WHERE id='".$medu['id']."'");
          }
          else {
            queryMysql("INSERT INTO spostviews VALUES('".$medu['id']."', '1')");
          }
          }
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
          $us = $medu['user'];
          $usr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$us'"));
      $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
        $id = $medu['id'];
        $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
        $chlov = mysqli_fetch_array($lov);
        $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
        $chdwn = mysqli_fetch_array($dwnp);
        $rwlov = (int) mysqli_num_rows($lov); 
        $fl = $rwlov - 1;
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC LIMIT 1");  
        $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
        $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='liked' AND id='".$medu['id']."'");
         $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='disliked' AND id='".$medu['id']."'");
      if($medu['isshare'] == 0){
        echo <<<PSTS
        <div class='camp camps'>
        <div class='amps iiamps' id='soc
        PSTS;
        $sid = $medu['id'];
        echo $medu['id']."'>";
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
            </div><div class='namp'>
        PSTS;
        $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
        if(file_exists($medu['user'].".png")){ 
            $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
            chdir($td);
          }
        else {
          chdir($td);
           $img =  '/students_connect/user.png';
              }
            chdir($td);
        echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'
          ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
          <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
          <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
          echo '<div class="mpst" id="mpsts'.$medu['id'].'">';
                  $pstcut = $medu['pstcont'];
                  echo nl2br(rhash($pstcut)).'</div>';
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
                  $arr = [];
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/s/");
                    
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
                  chdir("../../../students_connect_hidden/postuploads/s/");
                    
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
                      <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
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
                    
                    <audio controls class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                  }
                    chdir($td);
                  echo '</div></div>
                  <div class="posted i_posted">'.$ftime.'</div>';
                }
                else {
                  if($medu['sharedby'] == $mbse['user']){
                      $shrus = 'You';
                    }
                    else {
                        $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                    }
                    $shr = $shrus." shared <a href='/students_connect/user".$mbse['user']."'>
                    <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                    echo <<<PSTS
                    <div class='camp camps'>
                    PSTS;
                    echo <<<PSTS
                     <div class='amps iiamps' id='
                    PSTS;
                    echo $medu['id']."'>";
                    echo <<<PSTS
                        <div class='ipt'></div><div class='namp'>
                  PSTS;
                  $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                  $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                  if(file_exists($mbss['user'].".png")){ 
                    $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                    chdir($td);  
                  }
                    else {
                      chdir($td);
                        $img =  '/students_connect/user.png';
                    }
                    chdir($td);
                    echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbss['user']."'>
                    <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                    <div class='name'>".$mbss['surname']." ".$mbss['firstname']."</a></div></div></div>";
                    echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                    $pstcute = $medu['sharedpstcont'];
                    echo nl2br(rhash($pstcute)).'</div>';
                    $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
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
                    <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                    <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                    <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div>";
                    echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                    $pstcut = $medu['pstcont'];
                    echo nl2br($pstcut).'</div>
                    <div class="allimgposted"><div class="postimages">';
                    $arr = array();
                    $td = getcwd();
                    chdir("../../../students_connect_hidden/postuploads/s");
                    for($i = 0; $i < 20; $i++){ 
                        if(file_exists($medu['sharedpostid']."(".$i.").png")){
                          $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png";
                          array_push($arr, $files[$i]);
                        }
                      }
                      chdir($td);
                  $data = count($arr);
                  $da = $data/2;
                    echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                    $td = getcwd();
                      chdir("../../../students_connect_hidden/postuploads/s");
                    for($i = 0; $i < 6; $i++){ 
                      if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                        echo "
                        <div class='postimages'>
                        <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                        <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                  }
                      else {
                        echo "";                     }
                      }
                    chdir($td);
                    echo '</div></div></div>
                    </div></div>';
                    echo '<div class="posted i_posted">'.$ftime.'</div>';
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
                  <br><div class="undbtn sundbtn"><div class="lkd cmn dwn" onclick="love(\''.$medu['id'].'\', \''.$mbse['user'].'\')">
                  <span id="love'.$medu['id'].'" style="'.$clr.'"><i class="'.$far.' fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                  '.$msoc['tln'].'</div>
                  </div>
                  <div class="cmt cmn dwn" id="commt" onclick="sc(\''.$medu['id'].'\', \''.$row['user'].'\')">
                  <input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="scid" value="">
                    <button type="submit" class="sbm">
                  <span><i class="far fa-comment"></i></span>
                  <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.$medu['pnc'].'</div></div></button>
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
                    <input type="hidden" value="1">Share
                    </button>
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
                    </div></div></div>
                  </div>
                  ';
                  echo "<div class='lkkl_jk'>";
                if(mysqli_num_rows($soccomment) == 0){  
                    //leave space blank
                  }
                  else {
                    $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC");
                    
                    while($getsoccomment = mysqli_fetch_array($soccomment)){
                    $aus = $getsoccomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    $getreplyn = queryMysql("SELECT * FROM replysoccomments WHERE postid='".$getsoccomment['postid']."' AND cmtid='".$getsoccomment['id']."'");
                    if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                      global $vpns;
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='opensReplyContent(".$getsoccomment['id'].", \"".$getsoccomment['postid']."\")' id='dbsb".$getsoccomment['id']."' 
                    >View ".$p."
                     ".$r."</button></div>
                     ";
                    global $vpns;
                  }
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
                     
                     if(file_exists("../../../students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/'.$getsoccomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                      }
                      else {
                          $pimg =  '/students_connect/user.png';
                      }
                  $plswrk = $getsoccomment['id'];
                  $geucd = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$getsoccomment['user']."'"));  
                  echo "
                    <div class='comment_section1' id='s".$getsoccomment['id']."' style='padding-top: 35px;'>
                    <div class='fet' style='display: flex;'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div>
                    <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$getsoccomment['id']."'>
                    <a href='/students_connect/user/".$upc['user']."'><i></i>
                    <div class='xk_nm'>".$geucd['surname']." ".$geucd['firstname']."</div>
                    <div class='sk_un'><i class='fas fa-at'></i>".$geucd['user']."</div>
                    </a></div>
                    <div class='comcnt'>".rhash(wordwrap($getsoccomment['cmt'], 60, "<br />"))."</div>";
                    $arr = [];
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists('../../../students_connect_hidden/comments/s'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png')){
                        $files[$i] = '../../../students_connect_hidden/comments/s'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png';
                        array_push($arr, $files[$i]);
                      }
                    }
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.'; margin-left: 3px; width: 90%;"><div class="aimg">';
                  $td = getcwd();
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists('../../../students_connect_hidden/comments/s'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png')){
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Trq' style='background-image: url(\"/students_connect_hidden/comments/s".$getsoccomment['id']."/".$getsoccomment['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/comments/s".$getsoccomment['id'].'/'.$getsoccomment['id']."(".$i.").png'></div>";
                    }
                  }
                  echo "</div></div>";
                    echo "
                    <div class='posted i_posted'>".date('Y M d h:i a', $getsoccomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                   style='$clrr' onclick='lvec(\"".$medu['id']."\", 
                  \"".$getsoccomment['id']."\", \"".$mbse['user']."\")' id='tclfh".$getsoccomment['id']."'>
                  <span><i class='far fa-heart'></i></span>
                  </div>
                  <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                  <input type='hidden' name='pid' value='".$medu['id']."'>
                  <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                  <button type='button' onclick='opensReply(\"".$getsoccomment['id']."\")' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                  <div class='cupv ccmn cdwn scbtn report'>Report</div>
                  </div></div>
                    <div class='adrep' id='rep".$getsoccomment['id']."' style=' display: none;'>
                    <form action='#".$getsoccomment['id']."' method='post' name='ecsom'>
                    <div class='why_now'>
                    <div class='fto'>
                    <textarea class='ikanimi' id='replypst".$getsoccomment['id']."' name='cmtreplysocpst' placeholder='Replying @".$upc['user']."' value='' title='Input Reply'  rows='2' style='margin: 0px; border: none; resize: none;' wrap: hard;'></textarea></div>
                    <div class='gee' style='vertical-align: middle; padding-left: 5px;
                    '><label for='senrepdbutton".$getsoccomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
                    </div>
                    <input type='hidden' name='postid' value='".$getsoccomment['postid']."'>
                    <input type='hidden' name='cmtid' value='".$getsoccomment['id']."'>
                    <input type='submit' id='senrepdbutton".$getsoccomment["id"]."' style='display: none !important'/>
                    </div></div>
                    </form>
                    </div>
                    ".$vpns."<div id='dsplrp".$getsoccomment['id']."' class='dsplrp'></div></div>
                    ";
                  }
                }
                echo '</div></div>
                  </div>';
                echo '<div class="addcom mos must" id="addcom"><form action="#'.$medu['id'].'" method="POST" name="spids" id="'.$medu['id'].'"><div class="wcb"><div class="cmttxt">
                    <textarea name="scmt" id="cmttextarea" placeholder="Comment..."" value="" title="Input Comment"  rows="2" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                    </div><div class="sndbtn"><label for="sendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                    <input type="hidden" name="postid" value="'.$medu['id'].'">
                    <input type="hidden" name="user" value="'.$mbs['user'].'">
                    <input type="file" name="esfile[]" multiple max="2" id="sfile" accept="image/*" style="display: none"/>
                    <label for="sfile" class="fsfile"><i class="fas fa-camera"></i></label>
                    <input type="submit" id="sendbutton'.$medu['id'].'"  style="display: none !important;"/></div>
                    </div></form></div>';          
                  
              }
              else {
                echo "<div class='pdex' style='font-size: 25px; margin:auto;'>Post doesn't exist</div>
                    <div class='gb2hp'><a href='/students_connect/h'>Go back to home</a></div>";
              }
            }
            echo "
            <script src='/students_connect/jsf/filescript.js'></script>
            <script src='/students_connect/jsf/filescriptextended.js'></script>
            <script>
            if(document.getElementsByClassName('lastpl')){
              var g = document.getElementsByClassName('lastpl');
              for(var i = 0; i < g.length; i++){
                var xe = g[i];
                xe.onclick = function(){
                  var crar = [];
                  var value= this.value;
                  var pid = this.children[3].value;
                  var user = this.children[2].value;
                  a = this.firstElementChild.className;
                this.firstElementChild.className = a.replace('far fa-circle c_y', 'fas fa-check-circle c_x');
                this.style.backgroundColor = 'rgb(31, 182, 31)';
                var x = this.parentElement;
                  var xy = x.parentElement;
                  var ex = xy.parentElement;
                  var kxy = ex.children;
                  for(var e = 0; e < kxy.length; e++){ 
                  var k = kxy[e].children;
                  for(var d = 0; d < k.length; d++){
                    var l = k[d].children;
                    for(var t = 0; t < l.length; t++){
                    l[t].setAttribute('disabled', 'disabled');
                    crar.push(l[t]);
                  }
                  }
                }
                var ls1 = crar[0].children[4];
                var ls2 = crar[1].children[4];
                var ls3 = crar[2].children[4];
                var ls4 = crar[3].children[4];
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var db = xmlhttp.responseText;
                    var p1 = db.indexOf('P');
                    var p2 = parseInt(db.indexOf('K')+1);
                    var p3 = parseInt(db.indexOf('A')+1);
                    var p4 = db.indexOf('T');
                    ls1.innerHTML = db.substring(0, p1);
                    ls2.innerHTML = db.substring(p1+1, parseInt(p2-1));
                    ls3.innerHTML = db.substring(p2, p3-1);
                    ls4.innerHTML = db.substring(p3, p4);
                    crar[1].style.backgroundSize = db.substring(0, p1)+'% 100%';
           crar[2].style.backgroundSize = db.substring(p1+1, parseInt(p2-1))+'% 100%';
           crar[3].style.backgroundSize = db.substring(p2, p3-1)+'% 100%';
           crar[4].style.backgroundSize = db.substring(p3, p4)+'% 100%';
                  }
              };
              xmlhttp.open('GET', '/students_connect/polls/?id='+pid+'&vote='+value+'&user='+user);
              xmlhttp.send();
              }
              }
            }
            </script>
            ";      
if(isset($_GET['action'])){
  $action = sanitizeString($_GET['action']);
  if($action == '6'){
    echo "<script>
    var gid = document.getElementsByClassName('amps')[0].id.substr(3);
    var ur = '".$row['user']."'
    love(gid, ur)
    </script>";
  }
}
?>