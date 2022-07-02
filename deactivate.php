<?php
require_once "connect.php";
require_once "header2.php";
if (!$loggedin) die();
echo <<<_END
<div class="navbar2">
  <ul id="navbar_list">
  <li id="studco"><a href="/students_connect//.php"><i class="fa fa-home"></i>Home</a></li>
  <li id="signup"><a href="/students_connect/profile.php"><i class="fa fa-"></i>Profile</a></li>
  <li id="login"><a href="/students_connect/messages">Messages</a></li>
  <li id="login"><a href="/students_connect/help.php">Help</a></li>
  </ul>   
  </div>
_END;


$search = queryMysql("SELECT user FROM members WHERE user = '$user'");
$match = $search ->num_rows;
if($match > 0){
queryMysql("UPDATE members SET active='0' WHERE user='$user' AND active='1'");
echo "Account has been successfully deactivated.
<script>
function Redirect() {
    window.location='logout.php';
}
setTimeout('Redirect()', 10000)</script>";
}

else {
    echo "Account not activated";
    die("<script>
function Redirect() {
    window.location='logout.php';
}
setTimeout('Redirect()', 1)</script>");
}
?>