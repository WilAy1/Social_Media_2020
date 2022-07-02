
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
if(!$loggedin) die();
else {
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));

    echo <<<_END
    <div class="navbar2">
  <ul id="navbar_list">
  <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/friends"><i class="fas fa-user-friends"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="fas fa-bell"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="fas fa-envelope"></i></a></li>
    <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../user.png'\")'; class='mypimg'></div></a></li>";
}
else{
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
    </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="height:768px">
  <div class='offline' id='offline'></div>
  <div class='online' id='online'></div>
    
  _END;
  
$email = '';
  if(isset($_POST['email'])){
  if(!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['newpass'])){
  $email = sanitizeString($_POST['email']);
$oldpass = queryMysql("SELECT pass FROM members WHERE email='$email' AND user='$user'"); 
if($user == $_SESSION['user']){
if($oldpass->num_rows){
    $pass = $_POST['pass'];
    $a = mysqli_fetch_array($oldpass);
    if($pass == $a['pass']){
        $newpass= $_POST['newpass'];
        if($newpass == $a['pass']){
            $error = '<div class="error">Use of same password is not allowed</div>';
        }
        else {
            queryMysql("UPDATE members SET pass='$newpass' WHERE email='$email'");
            $success = '<div class="success">Password Successfully Updated</div>';
        }
    }
    else {
        $error = '<div class="error">Password Doesn\'t Match Record</div>';
    }

}
else {
    $error = "<div class='error'>*Email Not Correct</div>";
}
  }
  else {
    echo "$error = <div class='error'>Logged In Account and Email Doesn't Match</div>";
}
}
  else {
      $error = '<div class="error">*Please Input All Fields</div>';
  }
}
echo <<<_END
<div class='mainbdy'>
<div class'lts' style='float:left;'>
<div class='bdycont' style='margin-left: 1em; line-height: 1.5em;'>
<h1 style='font-size: 20px;'>Change Current Password</h1>
<p id='note' style='font-size: 17px;'><b>NOTE:</b></p>
<article style='padding-left: 14px;'>
<li>To change your current password you will need your email address.
</li><li>You will also need to verify your change.</li>
<li>Your new password shouldn't also be the same with your old password (It isn't safe).
</li></article></div>
<div class='formfill' style='margin-left: 1em; line-height: 2.5em; margin-top: 16px;'>
<form method='post' action='' autocomplete="off">$error $success
<div class='emailbx'>
<input type='email' class='inputtext1' name='email' placeholder='Email Address' value='$email'></div>
<script>

</script>
<div class='passbx'>
<input type='password' name='pass' class='inputtext1' id='curpass' placeholder='Current Password'></div>
<div class='passbx'>
<input type='password' name='newpass' id='newpass' class='inputtext1' placeholder='New Password'>
</div>
<div class='submitbtn'>
<button type='submit' name='submit' class='submit_reg'>Change Password</button>
</div>
</form>
</div>
</div>
<!--<div class='othsettings'>
<div class='group'>
<div class='tpheading'>Other Related Settings</div>
<ul id='setul'>
<li id='set'><a href='/students_connect/settings/updateprofile#displayname'>Change Display Name<span class='tooltiptext'>Change Username</span></a></li>
<li id='set'><a href='/students_connect/settings/updateprofile#profilename'><span class='tooltiptext'>Firstname  Surname  Middlename</span>Change Profile Names</a></li>
<li id='set'><a href='/students_connect/settings/privacy'>Change Privacy Settings<span class='tooltiptext'>Block People Hide Private Details </span></a></li>
<li id='set'><a href='/students_connect/userview.php'>Change Display Picture<span class='tooltiptext'>Change Display Picture</span></a></li>
<li id='set'><a href='/students_connect/logout.php'>Log Out<span class='tooltiptext'>Log Out</spam></a></li>
<ul>
</div>
</div>-->
_END;
echo "</div></div>";
}
?>
</body>
</html>