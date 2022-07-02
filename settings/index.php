<?php
require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
if(!$loggedin) die();
else {
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= $row['user'];
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
  </i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
    if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    $mco = strtoupper($row['country']);
    echo <<<_END
      </ul>   
   
  </div>
  <div class='pycl'>
  <div onload="document.getElementsById('darkmd').style.minHeight = window.innerHeight 'px'" class="dark-mode" id='darkmd' style="">
  <div class='ss_ssts'>
  <div class='ss_oxaa'>
  <div class='ss_oqast'><span class='ss_eeks'>Settings</span></div>
  <div class='ss_oquck'>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'>
  <span class='ss_kiek'>Account Management</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq'><a href='/students_connect/profile/fprofile'>Update Your Profile</a></div>
  <div class='ss_okkq'><a href='updatepassword'>Change Your Password</a></div>
  <div class='ss_okkq'><a href='email_phone'>Change Email/Phone Number</a></div>
  <div class='ss_okkq'><a href='country'>Change Your Country/Region</a>
  <span class='ss_odot'><i class='fas fa-dot-circle'></i></span>$mco</div>
  <div class='ss_okkq'><a href='unblock'>Block/Unblock Users</a></div>
  <div class='ss_okkq'><a href='fsettings#recommendations'>Review Recommendations</a></div>
  <div class='ss_okkq'><a href='fsettings#notifications'>Notification Settings</a></div>
  <div class='ss_okkq'><a href='ac_manage'>Disable/Delete Account</a></div>
  <div class='ss_okkq'><a href='fsettings#others'>Others</a></div>
  </div>
  <!--#account management -> block/unblock, change and verify new details(email, phone number), password, country, recommendations(friend and posts), notifications(keep after - days)-->
  </div>
  </div></div>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'>
  <span class='ss_kiek'>Saved</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq'><a href='/students_connect/saved'>View Saved Posts/Messages</a></div>
  <div class='ss_okkq'><a href='fsettings/#saved'>Manage</a></div>
  </div>
  </div>
  </div></div>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'><span class='ss_kiek'>Interests</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq ss_mint'><a href='/students_connect/settings/interests'>View and Manage my Interests</a></div>
  </div>
  </div>
  </div></div>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'><span class='ss_kiek'>Display</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq ss_mint'>Display Settings</div>
  </div>
  </div>
  </div></div>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'><span class='ss_kiek'>Actions</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq'><a href='/students_connect/saved'>View Saved Posts/Messages</a></div>
  </div>
  </div>
  </div></div>
  <div class='ss_phvj'>
  <div class='ss_okssy'>
  <div class='ss_xcval'><span class='ss_kiek'>Others</span><span class='ss_miak'><i class='fas fa-angle-down'></i></span></div>
  <div class='ss_xccop'>
  <div class='ss_aalx'>
  <div class='ss_okkq'><a href='/students_connect/help'>Help</a></div>
  </div>
  </div>
  </div></div>
  </div>
  </div>
  </div>
  <!--<div class='settings-list'>
  <div class='part1'>
  <ul id='pt1pst'><a href='/students_connect/settings/updateprofile'>Update Your Profile</a>
  <li id='allpsts1'>
  <li id='upds'>Change Name</li>
  <li id='upds'>Add Middle Name</li>
  <li id='upds'>Change Your Email Address</li></li></ul>
  </div>
  <div class='ts_pt'>
  <div class='p_tp_ee'><a href='/students_connect/settings/updatepassword'>Change Password</a></div>
  <div class='re_sta'></div>
  </div>
  </div>-->
_END;
#interests
#saved posts
#actions
#interests
#saved posts
#actions
#account management -> block/unblock, change and verify new details(email, phone number), password, country, recommendations(friend and posts), notifications(keep after - days)
#display dark mode, autoplay videos,
#display dark mode, autoplay videos,
echo "</div></div><script src='/students_connect/jsf/settings.js'></script>";
}
?>
</body>
</html>

