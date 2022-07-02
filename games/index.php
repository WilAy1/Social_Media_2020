<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    echo <<<_END
    <div class="navbar2">
  <ul id="navbar_list">
  <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/friends"><i class="fas fa-user-friends"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="fas fa-bell"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="fas fa-envelope"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
}
else{
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
    <li id="search"></li>
    </ul>
    </div>
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height: 650px;">
  _END;
  if(isset($_GET['user']) && isset($_GET['friend'])){
      $user = $_GET['user'];
      $friend = $_GET['friend'];
  }
  else {
      $user = $row['user'];
      $friend = "";
  }
  echo <<<_
    <script src='/students_connect/games/bot.js'>
    </script>
    <div class='gcby'>
    <div class='gbt'>
    <div class='gamebotdesign'>
    <div class='gamebotheader'>
    <div class='gamebotlogo'>
    </div><div class='gamebotname'>
    GaME bOT</div></div>
    <div class='gamebotbody' id='gamebotbody'>
    <div class='sbatype' style='width: 100%;'></div>
    </div>
    <div class='gamebotfooter'>
    <i class='fas fa-at'></i>!GaMe bOT &copy;2020</div></div>
    </div>
    </div>
    <div id='test'></div>
  _;
?>