<?php
    require_once "/Users/wilay/students_connect/connect.php";
    $ei = $_GET['uid'];
    $mx = mysqli_fetch_array(queryMysql("SELECT * FROM members where id='$ei'"));
    $user = $mx['user'];
    if(isset($_GET['tfh'])){
        $y = time();
        $x = strtotime('24 hours ago');
        $from = 'AND timeofnot BETWEEN '.$x.' AND '.$y.'';
        $s = 'selected';
        $y = "";
        $z="";
        $slt = "";
        $w = "";
      }
      elseif(isset($_GET['awk'])){
        $y = time();
        $x = strtotime('1 week ago');
        $from = 'AND timeofnot <'.$y.'';
        $y = 'selected';
        $s = "";
        $z = "";
        $slt = "";
        $w = "";
      }
      elseif(isset($_GET['amo'])){
        $y = time();
        $x = strtotime('1 month ago');
        $from = 'AND timeofnot < '.$y.'';
        $z = 'selected';
        $s = "";
        $y = "";
        $w = "";
        $slt = "";
      }
      elseif(isset($_GET['ayo'])){
        $y = time();
        $x = strtotime('1 year ago');
        $from = 'AND timeofnot < '.$y.'';
        $w = 'selected';
        $z = "";
        $s = "";
        $y = "";
        $slt = "";
      }
      else {
        $from = '';
        $slt = '';
        $z = "";
        $s = "";
        $y= "";
        $w = "";
      }
      $not = queryMysql("SELECT * FROM notifications WHERE usertobenotified='$user' $from ORDER BY timeofnot DESC");
if($not->num_rows>0){
  while($mnot = mysqli_fetch_assoc($not)) {
    $eut = queryMysql("SELECT * FROM notifications WHERE id='".$mnot['id']."' AND readalready='0'");
    $eeooo = '';
    if($eut->num_rows){
      $eeooo = "<div class='eeeeoo'></div>";
    }
    $ee ='';
    $ml = '';
    if(strpos($mnot['notlink'], "posts/") !== FALSE){
      $op = explode("/", $mnot['notlink']);
      $ext = count($op);
      $ptype = $op[$ext-1];
      if(strpos($ptype, 's') !== FALSE){
        $q = substr($ptype, 1, strlen($ptype));
        $fl = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$q'"));
        $ee = "<div class='ntter ppee'>\"".substr(strip_tags($fl['pstcont']), 0, 250).'..."</div>';
      }
      else {
        $fl = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$ptype'"));
        $ee = "<div class='ntter ppee'>\"".substr(strip_tags($fl['pstcont']), 0, 250).'..."</div>';
      }
    }
    elseif(strpos($mnot['notlink'], "user/") !== FALSE){
      $op = explode("/", $mnot['notlink']);
      $ext = count($op);
      $ptype = $op[$ext-1];
      $fl = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ptype'"));
      $td = getcwd();
                  chdir("../../students_connect_hidden/users_profile_upload/".$fl['user'].'/');
                  if(file_exists($fl['user'].".png")){ 
                    $img =  '/students_connect_hidden/users_profile_upload/'.$fl['user'].'/'.$fl['user'].'.png';  
                  }
                    else {
                      chdir($td);
                        $img =  '/students_connect/user.png';
                    }
                    chdir($td);
      $oqt = queryMysql("SELECT * FROM followstatus WHERE friend='$ptype'");
      $noff = mysqli_num_rows($oqt);
      if($noff == 0){
        $noff = 'No';
        $ff = 'Follower';
      }
      elseif($noff == 1){
        $ff = 'Follower';
      }
      else {
        $ff = 'Followers';
      }
      $oqt = queryMysql("SELECT * FROM followstatus WHERE user='$ptype'");
      $fnoff = mysqli_num_rows($oqt);
      $eff = 'Following';
      $ml = "<div class='ntter xcape'>
      <div class='plloe pstname' style='display: flex;'>
      <div class='tppooo imgfpstr' style='background-image: url(".$img.");'></div>
      <div class='nnname'>".$fl['firstname']." ".$fl['surname']."
                    <div class='unvme'><i class='fas fa-at'></i>".$fl['user']."</div></div>
      </div>
      <div class='rrttt'>
      <div class='mmeoirflw'>$noff $ff | $fnoff $eff</div>
      <div class='viewprofile'>View Profile</div>
      </div>
      </div>";
    }
    echo "<div class='entf' id='".$mnot['id']."'>
    <div class='chkbx'><input type='checkbox' class='cccllll' style='z-index: 0; background-color: white; border-radius: 100%;'/>
    <input type='hidden' value='".$mnot['id']."'>
    </div>
    <a href='".$mnot['notlink']."'>
    <div class='nothd'>".$mnot['notheading']."</div>
    ".$ee."
    <div class='notct'>".$mnot['notcontent']."</div>".$ml."
    <div class='notim' style='text-align: right; padding-right: 15px; font-size: 13px;'>".date('Y M\' d h:i a',$mnot['timeofnot'])."</div>
    ".$eeooo."</a></div>
    ";
  }
}
else {
  echo "<div class='nna' style='text-align: center; font-size: 30px; padding: 20px;'>No Notification Avaialbe</div>";
}
?>