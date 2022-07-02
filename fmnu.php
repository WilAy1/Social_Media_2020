<?php
require_once "header2.php";
    $tus = $_SESSION['user'];
    $gus = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$tus'"));
    $user = $gus['user'];
    echo <<<_END
  <div class="navbar2">
  <ul id="navbar_list">
  <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/friends"><i class="fas fa-user-friends"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="fas fa-bell"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="fas fa-envelope"></i></a></li>
    <li id="hmic" class='tbstr' style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
if(!file_exists("../../students_connect_hidden/users_profile_upload/".$user.'/'.$user.".png")){
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
}
else{
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/"/$user.'/'.$user.".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
    </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
 _END;
 ?>