<?php
define("rox", "/Users/wilay/students_connect/");
require_once rox."connect.php";
require_once "phd.php";
require_once "fform.php";
if(isset($_GET['u'])){
  $abc = $_GET['u'];
  $abcd = "userprofilecode='$abc'";
  echo $abcd;  
}
  else {
      $abcd = "user = '$iam'";
  }
   $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE $abcd"));
if(isset($_GET['action'])){
  $action = sanitizeString($_GET['action']);
  $acpos = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
  $od = "style='display: none'";
  $vxt = "";
  $uxt = '';
  if($action == '1'){
    $od = "style='display:block;'";
$chflst1 = queryMysql("SELECT * FROM followstatus WHERE
 user='".$acpos['user']."' AND friend='".$upc['user']."'");
$chflst2 = queryMysql("SELECT * FROM followstatus WHERE
 user='".$upc['user']."' AND friend='".$acpos['user']."'");
$tt = queryMysql("SELECT * FROM blocked WHERE user='".$acpos['user']."'
AND touser='".$row['user']."'");
if($tt ->num_rows == 0){
if($chflst1->num_rows && $chflst2->num_rows){
    $state = 'Following(M)';
    global $state;
}
elseif($chflst1->num_rows && !$chflst2->num_rows){
    $od = "style='display:none;'";
    $state = 'Following';
    global $state;
}
else {
    $state = 'Follow';
    global $state;
}
}
else {
  $state = 'Blocked';
}
    $vxt = "<div class='ssm_lsjne'>Follow</div>";
    $uxt = "
    <div class='ssm_brx'><input type='hidden' name='try'/>
    <input type='hidden' name='fuser' value='".$upc['user']."'/>
    <input type='hidden' name='user' value='".$acpos['user']."'/>
    <button type='button' name='subfol' class='cbr'><div class='flw'><i class='fas fa-user-plus icf'></i> <span class='im_drag'>".$state."</div></button></div>";
  }
  elseif($action == '2') {
    echo "<script>window.location.href='/students_connect/messages?n=".$upc['user']."'</script>";
    
  }
  elseif($action =='3'){
    echo "
    <script>
    var scr = document.createElement('script');
    scr.src = '/students_connect/jsf/filescript.js';
    document.body.append(scr);
    scr.onload = function(){
      oprofile()
    }
    scr.remove();
    </script>
    <script></script>";
  }
  elseif($action =='4'){
    echo "
    <script>
    var scr = document.createElement('script');
    scr.src = '/students_connect/jsf/filescript.js';
    document.body.append(scr);
    scr.onload = function(){
      admit()
    }
    scr.remove();
    </script>
    <script></script>";
  }
  elseif($action =='5'){
    echo "
    <script>
    var scr = document.createElement('script');
    scr.src = '/students_connect/jsf/filescript.js';
    document.body.append(scr);
    scr.onload = function(){
      admit1();
    }
    scr.remove();
    </script>
    <script></script>";
  }
  if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){
    $kodd = "/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png";
  }
  else {
    $kodd = '/students_connect/user.png';
  }
    echo "<div class='ssm_new_action' $od>
      <div class='ssm_build'>
      <div class='ssm_jussy'>
      ".$vxt."
      <div class='ssm_wgtf'>
      <div class='ssm_timg' style='background-image: url(\"".$kodd."\")'></div>
      <div class='ssm_uiom'>
      <div class='ssm_emjr'>".$upc['firstname']." ".$upc['surname']."</div>
      <div class='ssm_murbn'><i class='fas fa-at'>".$upc['user']."</i></div>
      </div>
      ".$uxt."
      </div>
      </div>
      </div></div>";
}
echo <<<_END
<div class='bd'>
<div class='fp'>
<div class='u_fp'>
_END;
if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user']."/cover/cover.png")){
  $bx = 'background-image: url("/students_connect_hidden/users_profile_upload/'.$upc['user'].'/cover/cover.png")';
}
else {
  $bx = '';
}
if (file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png"))
  {
    echo "<div class='cvrp'>
    <div class='tsap' id='tsap'>
    <div class='profileimg' style='width: 100%; height: 150px; background: brown; position: relative; $bx; background-position: center;'>
    <input type='file' id='fille' style='display: none;'>
    </div>
    <div class='profile_side'><div id='img_link'>
    <div id='img_profile' style='background-image:url(\"/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png\"); background-size: 100%;'></div>
    <img src='/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png' style='height: 180px; width: 180px;
     background-size: 100%; opacity: 0; position: absolute;'
     id='img_profile'></div></div>";
  }
  else {
    echo "<div class='cvrp'>
    <div class='tsap'>
    <div class='profileimg' style='width: 100%; height: 150px; background: brown; position: relative; $bx; background-position: center;'>
    </div>
    <div class='profile_side'>
    <div id='img_link'>
    <div id='img_profile' style='background-image:url(\"/students_connect/user.png\"); background-size: 100%;'></div>
    <img style='height: 180px; width: 180px;
    background-size: 100%; opacity: 0; position: absolute;'
    id='img_profile' src='/students_connect/user.png'></div></div>"; 
  }

 
  echo <<<_LAUGH
  <div class='bf_unme'>
  <div class="users_name">

_LAUGH;

$foo = queryMysql("SELECT * FROM followstatus WHERE user='".$upc['user']."'");
$bar = queryMysql("SELECT * FROM followstatus WHERE friend='".$upc['user']."'");
$fn = mysqli_num_rows($foo);
$sn = mysqli_num_rows($bar);
  echo "<div class='fix_name'><div class='f_s_name'>".$upc['surname']. " " .$upc['firstname']."</div>
  <div class='u_name'><i class='fas fa-at'></i>".$upc['user']."</div>
  </div>";
    if(isset($_POST['sendposts'])){
   $sendposts = allposts($_POST['sendposts']);
    }
    $about = lhash($upc['about']);
    $about = nl2br($about);
  echo <<<_END
  <div class='abouty'><span class='tzabout'></span><div class='yabt'>$about</div></div>
  <div class='f_shh129w'>
  <span class='f_fflwers'>Followers <div class='f_shth123'>$sn</div></span><span class='f_fflwing'>Following <div class='f_shth123'>$fn</div></span>
  </div>
  _END;
if($upc['pnumber'] == 0){
    $phonenumber = '';
    global $phonenumber;
}
else {
    $phonenumber = "<div class='phn apd'>Number: <a href='tel:".$upc['pnumber']."'>".$upc['pnumber']."</a></div>";
    global $phonenumber;
}
$g = $_SESSION['user'];
$xege = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$g'"));
$g = $xege['user'];
$f = $upc['user'];
$pos = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$g'"));
$chflst1 = queryMysql("SELECT * FROM followstatus WHERE
 user='$g' AND friend='$f'");
$f = $_SESSION['user'];
$xefe = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$f'"));
$f = $xefe['user'];
$g = $upc['user'];
$chflst2 = queryMysql("SELECT * FROM followstatus WHERE
 user='$g' AND friend='$f'");
$tt = queryMysql("SELECT * FROM blocked WHERE user='$f'
AND touser='$g'");
$invtt = queryMysql("SELECT * FROM blocked WHERE user='$g'
AND touser='$f'");
$isblocked = 0;
if($tt ->num_rows == 0){
if($chflst1->num_rows && $chflst2->num_rows){
    $state = 'Following(M)';
    global $state;
}
elseif($chflst1->num_rows && !$chflst2->num_rows){
    $state = 'Following';
    global $state;
}
else {
    $state = 'Follow';
    global $state;
}
}
else {
  $state = 'Blocked';
  $isblocked = 1;
}
if($invtt->num_rows == 0){
  $qblocked = 0;
}
else {
  $qblocked = 1;
}
$checking = $xefe['user'];
$mus = $upc['user'];
$emoqx = queryMysql("SELECT * FROM eduposts WHERE (user='$mus' AND pstst=0 AND sharedby='$mus') OR
(user != '$mus' AND sharedby = '$mus' AND pstst=0)
 UNION ALL
 SELECT * FROM socposts WHERE (user='$mus' AND pstst=1 AND sharedby='$mus') OR
(user != '$mus' AND sharedby = '$mus' AND pstst=1)
ORDER BY timeofupdate DESC");
$mownpab = mysqli_fetch_array($emoqx);
if($emoqx->num_rows){
  $lasttime = $mownpab['timeofupdate'];
}
else {
  $lasttime = 0;
}
echo "
<div class='pdt'>

</div>
</div>
<div class='smen'>
<div class='pes'>
<input type='hidden' name='try'/>
<input type='hidden' name='fuser' value='".$upc['user']."'/>
<input type='hidden' name='user' value='".$pos['user']."'/>
<button type='button' name='subfol' class='cbr'><div class='flw'><i class='fas fa-user-plus icf'></i> <span class='im_drag'>".$state."</div></button>
</div>
<div class='pes'>
<form method='post' action='/students_connect/messages/'>
<input type='hidden' name='name' value='".$pos['user']."'>
<input type='hidden' name='fname' value='".$upc['user']."'/>
<button type='submit' class='cbr'>
<div class='msg'><i class='fas fa-envelope icf'></i> <span class='im_drag'>Message</span> </div></button></form></div>
<div class='pes'>
<form method='post' action=''>
<button type='submit' class='cbr'>
<div class='chp'><i class='fas fa-camera icf'></i> <span class='im_drag'>Photos</span></div></button></form></div>
</div>
</div></div></div></div>
<div class='xyze' id='oopye'>
<div class='tnavtop'>
<input type='hidden' id='integhide' value='".$upc['user']."'>
<div class='xt_1 arrgaccdn practive'>Posts</div>
<div class='xt_2 arrgaccdn'>Profile</div>
<div class='xt_3 arrgaccdn'>Followers</div>
<div class='xt_4 arrgaccdn'>Following</div>
</div>
<div class='y_x' id='yx_x'>
<input type='hidden' value='$lasttime' id='xyxlt'>
<input type='hidden' value='$checking' id='checkinguser'>
<div id='ldrfmp' style='display: none;'></div>
<div id='tnewptag' style='display: none;'>New Posts Available</div>
";
if($isblocked == 0 && $qblocked == 0){
  require_once "posts.php";
}
else {
  if($isblocked == 1){
  echo "<div class='bbl_koe'>
    <div class='bbl_koex'>
    <span class='bbl_kome'>You blocked <span class='bbl_user'>@$g</span>. To view <span class='bbl_user'>@$g</span> posts, unblock from </span>
    <a class='bbl_ker' href='/students_connect/settings/unblock'>Settings</a>
    </div>
  </div>";
  }
  if($qblocked == 1){
    echo "<div class='bbl_koe'>
    <div class='bbl_koex'>
    <span class='bbl_kome'><span class='bbl_user'>@$g</span> blocked you. You can't view <span class='bbl_user'>@$g</span> posts.
    </div>
  </div>";
  }
  
}
echo "</div>
<div class='x_y' id='xy_y'></div>
<div class='t_x' id='xt_x'></div>
<div class='t_y' id='xt_y'></div>
</div></div></div>
<script src='/students_connect/jsf/filescript.js' type='text/javascript'></script>";
?>