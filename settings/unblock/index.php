<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
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
  </i></a></li>  <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
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
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
    <div class='co_ttds'>
    <div class='sc_Aacm'><a href='/students_connect/settings'><i class='fas fa-cog'></i>Settings</a><i class='fas fa-arrow-right' style='padding-left:5px;'></i> <i class='fas fa-user-slash'></i>Block|Unblock</div>
    <div class='sc_co_sa'></div>
    <div class='sc_fftto'>
_END;
echo "<div class='l_blo'><div class='l_blckp'>Blocked Users</div><div class='sc_srrc'>
<div class='sc_ffl'><input type='text' placeholder='Search with username ' id='dds'/></div>
</div><div class='sc_cvval'>";
$ma = queryMysql("SELECT * FROM blocked WHERE user='$user'");
if($ma->num_rows){
while($gm = mysqli_fetch_array($ma)){
  $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gm['touser']."'"));
  if(file_exists("../../../students_connect_hidden/users_profile_upload/".$gm['touser'].'/'.$gm['touser'].'.png')){
    $eoll = "/students_connect_hidden/users_profile_upload/".$mlkk['user'].'/'.$mlkk['user'].".png";
  }
  else {
    $eoll = "/students_connect/user.png";
  }
  
  echo "<div class='f_nnommm'>
    <div class='f_per_hhd'>
    <div class='f_lloimg' style='background-image: url(\"".$eoll."\")'></div>
    <div class='f_tjjrrm'>
    <a href='/students_connect/user/".$mlkk['user']."'>
    <div class='f_wwlwiikd'>".$mlkk['firstname']." ".$mlkk['surname']."</div>
    <div class='f_lloajjdk'><i class='fas fa-at'></i>".$mlkk['user']."</div>
    </a>
    <div class='f_laldei'>".nl2br(lhash($mlkk['about']))."</div>
    </div>
    <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' name='nuser' value='".$mlkk['user']."'>
            <input type='hidden' name='user' value='".$row['user']."'>
            <button class='bl_xoop'>Unblock</button></div>
            </div>
    </div>
    </div>"; 
}
}
else {
  echo "<div class='sc_nbu'>No Blocked User</div>";
}
echo "</div><div class='sc_cvvalo'></div></div>
<div class='l_off'><div class='l_blckp'>My Friends</div><div class='sc_srrc'>
<div class='sc_ffl'><input type='text' placeholder='Search with username ' id='ssf'/></div>
</div><div class='sc_oeor'>";
$mk = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
while($gr = mysqli_fetch_array($mk)){
  $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gr['friend']."'"));
    $mell = getcwd();
    chdir("../../../students_connect_hidden/users_profile_upload/".$mlkk['user'].'/');
    if(file_exists($mlkk['user'].".png")){
      $eoll = "/students_connect_hidden/users_profile_upload/".$mlkk['user'].'/'.$mlkk['user'].".png";
    }
    else {
      $eoll = "/students_connect/user.png";
    }
    chdir($mell);
    $yoo = queryMysql("SELECT * FROM followstatus WHERE user='".$row['user']."' AND friend='".$mlkk['user']."'");
    if($yoo->num_rows){
      $readyfunc = 'Unfollow';
    }
    else {
      $readyfunc = 'Follow';
    }
    echo "<div class='f_nnommm'>
    <div class='f_per_hhd'>
    <div class='f_lloimg' style='background-image: url(\"".$eoll."\")'></div>
    <div class='f_tjjrrm'>
    <a href='/students_connect/user/".$mlkk['user']."'>
    <div class='f_wwlwiikd'>".$mlkk['firstname']." ".$mlkk['surname']."</div>
    <div class='f_lloajjdk'><i class='fas fa-at'></i>".$mlkk['user']."</div>
    </a>
    <div class='f_laldei'>".nl2br(lhash($mlkk['about']))."</div>
    </div>
    <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' value='".$mlkk['user']."'>
            <input type='hidden' value='".$row['user']."'>
            <button class='bl_xoop'>Block</button></div>
            </div>
    </div>
    </div>";
}

echo "</div><div class='sc_oeoro'></div></div></div></div></div></div>
<script src='/students_connect/jsf/settings.js'></script>
<script src='/students_connect/jsf/filescript.js'></script>

";
?>