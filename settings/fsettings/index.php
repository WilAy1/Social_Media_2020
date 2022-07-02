<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= $row['user'];
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
/*  $ko = queryMysql("SELECT * FROM members");
  while($M = mysqli_fetch_array($ko)){
    $id = 0;
    queryMysql("INSERT INTO settings values('$id', '".$M['user']."', '2', '1,0','1', '1', '1', '2', '1', '1,0', '1', '1', '1', '1', '1', '1', '1', '1')");
  }
  */
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
  <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="far fa-bell">
_END;
if($eeex>0){
  echo "<span class='h_shn12w s_thmiw'><span>".$eeex."</span></span>";
  }
echo <<<_END
  </i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
    if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    $mco = strtoupper($row['country']);
    echo <<<_END
      </ul>   
   
  </div>
  <div class='pycl'>
  <div onload="document.getElementsById('darkmd').style.minHeight = window.innerHeight+'px'" class="dark-mode" id='darkmd' style="">
  <div class='ss_nssp'>
  <div class='s_ssydn'>
  <span class='ss_itntf'><a href='/students_connect/settings'><i class='fas fa-cog'></i>Settings</a> <i class='fas fa-arrow-right' style='font-size: 13px'></i><i class='far fa-user'></i> Account Settings</span>
  </div>
  <div class='ss_contrmn'>
  <div class='ss_sthfc'>
_END;
  $ty = mysqli_fetch_array(queryMysql("SELECT * FROM settings WHERE user='$user'"));
  $ri = $ty['rinterest'];
  $k = $y = $o = $mi = $yi = $ori = '';
  if($ty['rcountryuser'] == 1){
    $k = 'ss_tive';
  }
  else {
    $mi = 'ss_tive';
  }
  if($ty['rcountrypost'] == 1){
    $y = 'ss_tive';
  }
  else {
    $yi = 'ss_tive';
  }
  if($ty['rinterest'] == 1){
    $or = 'ss_tive';
  }
  else {
    $ori = 'ss_tive';
  }
  $ko = explode(",",$ty['notifications']);
  if($ko[0]=='1'){
    $lo = 'ss_tive';
    $ko = '';
  }
  else {
    $ko = 'ss_tive';
    $lo = '';
  }
  $xo = explode(",",$ty['dsaved']);
  if($xo[0]=='2'){
    $no = 'ss_tive';
    $so = '';
  }
  else {
    $so = 'ss_tive';
    $no = '';
  }
  $yno = $ymail = $ysex = $ydob = $evno = $evmail = $evsex = $evdob = $nno = $nmail = $nsex = $ndob = '';
  if($ty['number'] == 1) $yno = 'ss_tive';
  elseif($ty['number'] == 2) $evno = 'ss_tive';
  else $nno = 'ss_tive';

  if($ty['email'] == 1) $ymail = 'ss_tive';
  elseif($ty['email'] == 2) $evmail = 'ss_tive';
  else $nmail = 'ss_tive';
  if($ty['sex'] == 1) $ysex = 'ss_tive';
  elseif($ty['sex'] == 2) $evsex = 'ss_tive';
  else $nsex = 'ss_tive';
  if($ty['dateofbirth'] == 1) $ydob = 'ss_tive';
  elseif($ty['dateofbirth'] == 2) $evdob = 'ss_tive';
  else $ndob = 'ss_tive';
  echo "<div class='ss_cwtp'>Manage your account</div>
  </div>
  <div class='ss_rcmds' id='recommendations'>
  <div class='ss_rcmds01'>Recommendations</div>
  <div class='ss_rcmds1' id='rcountry'>
  <div class='ss_rcmds11'><div class='ss_rcmds112'>Country</div>
  <div class='ss_rcmds12'>
  <div class='ss_rcmds121'>Allow post recommendations from country</div>
  <div class='ss_rcmds122'><button class='ss_rcmds1221 $y'>Yes</button><button class='ss_rcmds1222 $yi'>No</button></div>
  </div>
  <div class='ss_rcmds13'>
  <div class='ss_rcmds131'>Allow user recommendations from country</div>
  <div class='ss_rcmds132'><button class='ss_rcmds1321 $k'>Yes</button><button class='ss_rcmds1322 $mi'>No</button></div>
  </div>
  <div class='ss_rcmds14'><span class='ss_rcmds141'>".$row['country']."</span> <a href='/students_connect/settings/country'>Change my country</a></div>
  </div>
  </div>
  <div class='ss_rcmds21'>
  <div class='ss_rcmds211'>Interests</div>
  <div class='ss_rcmds151'>Display interests to follow</div>
  <div class='ss_rcmds152'>
  <button class='ss_rcmds1521 $or'>Yes</button><button class='ss_rcmds1522 $ori'>No</button></div>
  <div class='ss_rcmds213'><a href='/students_connect/interests'>View My Interests</a></div>
  </div>
  </div>
  <div class='ss_ficat' id='notifications'>
  <div class='ss_notf01'>Notifications</div>
  <div class='ss_notf1'>
  <div class='ss_notf11'>Auto delete notifications</div>
  <div class='ss_notf12'>
  <div class='ss_notf131'><button class='ss_notf1211 $ko'>Yes</button><button class='ss_notf1212 $lo'>No</button></div>
  <span class='ss_notf121'>Notifications will delete after 5 days</span>
  </div>
  <div class='ss_notf14'>
  <a href='/students_connect/notification'>My Notifications</a>
  </div>
  </div>
  </div>
  <div class='ss_svedx' id='saved'>
  <div class='ss_svedx01'>Saved</div>
  <div class='ss_svedx1'>
  <div class='ss_svedx11'>Auto delete saved posts and messages</div>
  <div class='ss_svedx12'>
  <div class='ss_svedx131'><button class='ss_svedx1211 $so'>Yes</button><button class='ss_svedx1212 $no'>No</button></div>
  <span class='ss_svedx121'>Saved posts and messages will delete after 5 days</span>
  </div>
  <div class='ss_svedx14'>
  <a href='/students_connect/saved'>My Saved Posts and Messages</a>
  </div>
  </div>
  </div>
  <div class='ss_othrs' id='others'>
  <div class='ss_othrs01'>Others</div>
  <div class='ss_othrs1'>
  <div class='ss_othrs11'>Display Number to</div>
  <div class='ss_othrs111'><button class='ss_othrs1111 $yno'>Everyone</button><button class='ss_othrs1112 $evno'>Following</button><button class='ss_othrs1113 $nno'>No one</button></div>
  </div>
  
  <div class='ss_othrs2'>
  <div class='ss_othrs21'>Display Email to</div>
  <div class='ss_othrs211'><button class='ss_othrs2111 $ymail'>Everyone</button><button class='ss_othrs2112 $evmail'>Following</button><button class='ss_othrs2113 $nmail'>No one</button></div>
  </div>

  <div class='ss_othrs3'>
  <div class='ss_othrs31'>Display Gender to</div>
  <div class='ss_othrs311'><button class='ss_othrs3111 $ysex'>Everyone</button><button class='ss_othrs3112 $evsex'>Following</button><button class='ss_othrs3113 $nsex'>No one</button></div>
  </div>

  <div class='ss_othrs4'>
  <div class='ss_othrs41'>Display Date of Birth to</div>
  <div class='ss_othrs411'><button class='ss_othrs4111 $ydob'>Everyone</button><button class='ss_othrs4112 $evdob'>Following</button><button class='ss_othrs4113 $ndob'>No one</button></div>
  </div>
  </div>
  </div>
  </div>
  </div>";

echo "</div></div>
<script>
var hash=window.location.hash.substring(1, window.location.hash.length);
if(document.getElementById(hash)){
  document.getElementById(hash).style.opacity = '0.6';
  document.getElementById(hash).style.backgroundColor = 'lightgrey';
}
setTimeout(function(){
  document.getElementById(hash).style.opacity = '1';
  document.getElementById(hash).style.backgroundColor = 'inherit';
}, 1000)
</script>
<script src='/students_connect/jsf/settings.js'></script>
<script src='/students_connect/jsf/filescript.js'></script>
<script>
document.getElementsByClassName('s_ssydn')[0].style.backgroundColor = document.getElementById('darkmd').style.backgroundColor
</script>
";
?>