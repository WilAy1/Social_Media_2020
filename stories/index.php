<?php
define('ROOT' , "/Users/wilay/students_connect/");
require_once ROOT."connect.php";
require_once ROOT."header2.php";
if (!$loggedin) die();
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
echo <<<_END
<link rel='stylesheet' href='/students_connect/cssf/stories.css'>
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
if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
}
else{
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
  </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:695px;">
_END;
$flname = ucfirst($row['firstname'])." ".ucfirst($row['surname']);
$user = $row['user'];
if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){ 
    $stomg = "/students_connect_hidden/users_profile_upload/$user/$user.png";
    }
else {
    $stomg = "/students_connect/user.png";
    }
echo <<<_STORIES
<div class='sto_page'>
<div class='sto_cont'>
<div class='sto_hd'><div class='sto_hc'>Qwifty Stories</div></div>
<div class='my_sto'>
<div class='sto_fme'><span class='stomyy'>My Story</span>
</div>
<div class='sto_upld'>
<input type='hidden' value='$user'>
<div class='sto_pic mo_sto_pic' style='background-image: url("$stomg");'></div>
<div class='sto_name mo_sto_name'>
<div class='sto_nme'>$flname</div>
<div class='sto_usr'><i class='fas fa-at'></i>$user</div>
</div>
<input type='file' class='sto_inp' style='display: none;' accept='image/*' id='sto_add' multiple>
<div class='sto_plus'><label for='sto_add'><i class='fas fa-plus'></i></label></div>
</div>
</div>
</div>
_STORIES;
$ofl = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
while($eth = mysqli_fetch_array($ofl)){
    $un = $eth['friend'];
    $ol = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$un'"));
    $lle = $ol['user'];
    $xl = queryMysql("SELECT * FROM stories WHERE user='$lle' ORDER BY timeofupdate DESC");
    if($xl->num_rows){
    $qrl = mysqli_fetch_array($xl);
    $lle = $qrl['user'];
    $mottl  = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$lle'"));
      $flname = $mottl['firstname']." ".$mottl['surname'];
    if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){ 
      $omg = "/students_connect_hidden/users_profile_upload/$lle/$lle.png";
      }
    else {
      $omg = "/students_connect/user.png";
      }
    
    echo "<div class='sto_upld'>
<input type='hidden' value='$lle'>
<div class='mo_sto_pic' style='background-image: url(".$omg.");'></div>
<div class='mo_sto_name'>
<div class='mo_sto_nme'>$flname</div>
<div class='mo_sto_usr'><i class='fas fa-at'></i>$lle</div>
</div>
</div>";
    }
}
echo <<<_END
    <div class='sto_view'>
    <div class='sto_name oth_sto_name'>
    <div class='sto_view_nme'></div>
    <div class='sto_view_usr'><i class='fas fa-at'></i></div>
    </div>
    <span class='sto_how'></span>
    <span class='sto_view_close'><i class='fas fa-arrow-left'></i></span>
    <div class='sto_file_to_view'></div>
    </div>
    <div class='sto_preview'>
    <span class='sto_close'><i class='fas fa-arrow-left'></i></span>
    <div class='sto_lft'>
    <div class='sto_img_plan'></div>
    </div>
    </div>
    </div></div>
    <script src='/students_connect/jsf/stories.js'></script>
_END;
?>