<?php
session_start();
define("ROOT", "/Users/wilay/students_connect/");
require_once ROOT."connect.php";
$user = $_SESSION['user'];
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
if(isset($_POST['id']) && isset($_POST['user']) && isset($_POST['l'])){
    $id = $_POST['id'];
  $get = queryMysql("SELECT * FROM loves WHERE id='$id'");
  $user = $row['user'];
  $chus = queryMysql("SELECT * FROM loves WHERE user='$user' AND id='$id'");
    $id = $_POST['id'];
    $chpst = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$id'"));
    $chmnou = queryMysql("SELECT * FROM loves WHERE user='$user' AND id='$id'");
    if($chmnou->num_rows){
      queryMysql("DELETE FROM loves WHERE user='$user' AND id='$id'");
      $new = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$id'"));
      $tln = (int) --$new['tln'];
      $pnl = (int) $new['pnl'] - 1;
      queryMysql("UPDATE socposts SET pnl='$pnl', tln='$tln' WHERE id='$id'");
    }
    else { 
    $chmnouf = mysqli_fetch_array($chmnou);
      $a = $chmnouf['loved'];
  if($a == 'liked'){
    // do nothing
  }
  else {
    $liked = 'liked';
    $time = time();
    queryMysql("INSERT INTO loves  VALUES('$user', '$liked', '$id', '$time')");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$id'"));
    $tln = (int) ++$new['tln'];
    $tdn = (int) $new['tdn'];
    $pnl = $tln + $tdn;
    queryMysql("UPDATE socposts SET pnl='$pnl', tln='$tln', tdn='$tdn' WHERE id='$id'");
  }
}
    }
if(isset($_POST['id']) && isset($_POST['user']) && isset($_POST['d'])){
    $id = $_POST['id'];
    $user = $row['user'];
    $chmnod = queryMysql("SELECT * FROM loves WHERE user='$user' AND id='$id'");
    $chmnodf = mysqli_fetch_array($chmnod);
    $a = 'disliked';
    if($chmnodf['loved'] == $a){
      // do nothing
    }
    elseif($chmnodf['loved'] == 'liked'){
      $liked = 'disliked';
      $time= time();
      queryMysql("UPDATE loves SET user='$user', loved='$liked', timeoflike='$time' WHERE id='$id' AND user='$user'");
      $new = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$id'"));
      $tln = --$new['tln'];
      $tdn = ++$new['tdn'];
      $pnl = $tln + $tdn;
      queryMysql("UPDATE socposts SET pnl='$pnl', tln='$tln', tdn='$tdn' WHERE id='$id'");
    }
    else {
      $liked = 'disliked';
      $time = time();
      queryMysql("INSERT INTO loves  VALUES('$user', '$liked', '$id', '$time')");
      $new = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$id'"));
      $tln = $new['tln'];
      $tdn = ++$new['tdn'];
      $pnl = $tun + $tdn;
      queryMysql("UPDATE socposts SET pnl='$pnl', tln='$tln', tdn='$tdn' WHERE id='$id'");
    }
}
if(isset($_GET['lid'])){
    $id = $_GET['lid'];
    $user = $row['user'];
    $soc = queryMysql("SELECT * FROM socposts WHERE id='$id'");
    while($msoc = mysqli_fetch_assoc($soc)) {
        echo $msoc['tln'];
    }
}
if(isset($_GET['dkl'])){
    $id = $_GET['dkl'];
    $user = $row['user'];
    $soc = queryMysql("SELECT * FROM socposts WHERE id='$id'");
    while($msoc = mysqli_fetch_assoc($soc)) {
        echo '<div class="dnmb" style="display: inline-block">'.$msoc['tdn'].'</div>';
    }
}
if(isset($_GET['c']) && isset($_GET['postid'])){
    $id = $_GET['postid'];
    $ur = $row['user'];
    $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ur'"));
    $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC LIMIT 1");
    $getsoccomment = mysqli_fetch_array($soccomment);
                    $aus = $getsoccomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    if($soccomment ->num_rows ==0){
                      echo "";
                    }
                    else {
                      $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$mbs['user']."'
                     AND postid='".$getsoccomment['postid']."'
                     AND commentid='".$getsoccomment['id']."'"));
                     if($dpa['loved'] == 'loved'){
                      $clrr = 'color: pink';
                     }
                     else {
                       $clrr = '';
                     }
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
                    echo "<div class='commt_cont'><div class='uswc' style='display: flex;'>
                    <div class='fet'>
                      <div class='phead imgapstr' style='
                      background-image: url(\"".$pimg."\");'></div></div>
                      <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                    <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                    <div class='posted'> ".date('M d h:i a', $getsoccomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                     style='$clrr' onclick='lvec(\"".$getsoccomment['postid']."\", 
                    \"".$getsoccomment['id']."\", \"".$mbs['user']."\")' id='tclfh".$getsoccomment['id']."'>
                    <span><i class='far fa-heart'></i></span>
                    </div>
                    <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                    <input type='hidden' name='pid' value='".$getsoccomment['postid']."'>
                    <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                    <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                    <div class='cupv ccmn cdwn report scbtn'>Report</div>
                    </div></div>";
                    }
}
if(isset($_GET['cmtid'])){
    $id = $_GET['cmtid'];
    $user = $row['user'];
    $soc = queryMysql("SELECT * FROM socposts WHERE id='$id'");
    while($msoc = mysqli_fetch_assoc($soc)) {
    echo '<div class="cnmb">'.red($msoc['pnc']).'</div>';
}
}
if(isset($_POST['wtl'])){
  $got = json_decode($_POST['wtl']);
  $kee = [];
  for($i = 0; $i < count($got); $i++){
    $timid = $got[$i][0];
    $type = $mtype = $got[$i][1];
    if($type == 'edu'){
      $type = 'eduposts';
    }
    else {
      $type = 'socposts';
    }
    $q = queryMysql("SELECT * FROM $type WHERE id='$timid'");
    if($q->num_rows){
      $mm = mysqli_fetch_array($q);
        $ttime = $mm['timeofupdate'];
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
          }
          else {
            $ftime ='';
          }
          array_push($kee, array($timid, $mtype, $ftime));
  }
  echo json_encode($kee);
}
if(isset($_GET['timid'])&& isset($_GET['ttype'])){
  $type = sanitizeString($_GET['ttype']);
  $timid = sanitizeString($_GET['timid']);
  if($type == 'edu'){
    $type = 'eduposts';
  }
  else {
    $type = 'socposts';
  }
  $q = queryMysql("SELECT * FROM $type WHERE id='$timid'");
  if($q->num_rows){
  $mm = mysqli_fetch_array(queryMysql("SELECT * FROM $type WHERE id='$timid'"));
  $ttime = $mm['timeofupdate'];
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
  echo $ftime;
        }
}
if(isset($_POST['readmore']) && isset($_POST['type'])){
  $id = $_POST['readmore'];
  $ee = $_POST['type'];
  if($ee == 1){
    $yx = 'socposts';
  }
  else {
    $yx = 'eduposts';
  }
    $ed = mysqli_fetch_array(queryMysql("SELECT * FROM $yx WHERE id='$id'"));
    $ty = strip_tags($ed['pstcont']);
    $ty = rhash($ty);
    echo nl2br($ty);
}
if(isset($_GET['ec']) && isset($_GET['postid'])){
  $id = $_GET['postid'];
  $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC LIMIT 1");
  $ur = $row['user'];
  $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ur'"));
  $geteducomment = mysqli_fetch_array($educomment);
                  $aus = $geteducomment['user'];
                  $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                  if($educomment ->num_rows ==0){
                  }
                  else {
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
                        $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='".$row['user']."'
                        AND postid='".$geteducomment['id']."'
                        AND commentid='".$geteducomment['id']."'"));
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
                  echo "<div class='commt_cont'>
                  <div class='uswc' style='display: flex;'>
                  <div class='fet'>
                  <div class='phead imgapstr' style='
                  background-image: url(\"".$pimg."\");'></div></div>
                  <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                  <div class='comcnt'>".wordwrap($geteducomment['cmt'], 60, "<br />")."</div>
                  <div class='posted'>".date('M d h:i a', $geteducomment['timeofcomment'])."</div>
                  <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                  <span onclick='ucm(\"".$geteducomment['postid']."\",
                   \"".$geteducomment['id']."\", \"".$row['user']."\")'>
                   <i class='fas fa-caret-up' style='$clrr' id='ror".$geteducomment['id']."'></i></span>
                  </div><div class='cdv ccmn cdwn'><span onclick='dcm(\"".$geteducomment['postid']."\",
                  \"".$geteducomment['id']."\", \"".$row['user']."\")'>
                  <i class='fas fa-caret-down' style='$clerr'
                   id='dror".$geteducomment['id']."'></i></span></div>
                  <div class='cshr ccmn cdwn' id='reply".$geteducomment['id']."'>
                  <button type='button' class='sbm' onclick='r(\"".$geteducomment['postid']."\", \"".$geteducomment['id']."\", \"".$row['user']."\")'><span><i class='fas fa-reply'></i></span></button></div>
                  <div class='cupv ccmn cdwn report'>Report</div>
                  </div></div>";
                  }
}
if(isset($_GET['i']) && isset($_GET['1'])){
  $id = $_GET['i'];
$get = queryMysql("SELECT * FROM votes WHERE id='$id'");
$use = $row['user'];;
$guse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$use'"));
$user = $guse['user'];
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
$use =  $row['user'];
  $guse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$use'"));
  $user = $guse['user'];
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



if(isset($_POST['dltpstid']) && isset($_POST['dltpst'])) {
  $id = $_POST['dltpstid'];
  $user = $row['user'];
  queryMysql("DELETE FROM eduposts WHERE id='$id' AND user='$user'");
  queryMysql("DELETE FROM votes WHERE id='$id'");
  queryMysql("DELETE FROM educomments WHERE postid='$id'");
}
if(isset($_GET['de']) && isset($_GET['s'])) {
  $id = $_GET['de'];
  $use = $row['user'];
  $guse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$use'"));
  $user = $guse['user'];
  queryMysql("DELETE FROM socposts WHERE id='$id'");
  
}
if(isset($_POST['soccommentid']) && 
  isset($_POST['lvsocpostid']) && isset($_POST['user'])){
    $ctid = (int) sanitizeString($_POST['soccommentid']);
    $ptid = (int) sanitizeString($_POST['lvsocpostid']);
    $uuser = $row['user'];
    $ot = 0;
    $tm = time();
    $id = 0;
    $cf = queryMysql("SELECT * FROM commentloves WHERE user='$uuser' AND postid='$ptid'
     AND commentid='$ctid'");
     $cfc = mysqli_fetch_array($cf);
    if($cf->num_rows){
      queryMysql("DELETE FROM commentloves WHERE user='$uuser' AND postid='$ptid' 
      AND commentid='$ctid'");
      $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
      $tun = (int) --$cmc['tln'];
      queryMysql("UPDATE soccomments SET tln='$tun' WHERE id='$ctid'");
  }
    else {
     if($cfc['loved'] == 'loved'){

     }
    else {
    queryMysql("INSERT INTO commentloves VALUES ('$id', '$uuser', 
    'loved', '$ptid', '$ctid', '$ot', '$ot', '$tm'
    )");
     $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
     $tun = (int) ++$cmc['tln'];
     queryMysql("UPDATE soccomments SET tln='$tun' WHERE id='$ctid'");
    }
  }
  }
  if(isset($_POST['upeducommentid']) && 
  isset($_POST['upedupostid']) && isset($_POST['user'])){
    $ctid = $_POST['upeducommentid'];
    $ptid = $_POST['upedupostid'];
    $uuser = $row['user'];
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
    $uuser = $row['user'];
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
  require_once ROOT."notification/addnotification.php";
?>
