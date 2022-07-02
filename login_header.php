<?php
session_start();
  require_once 'connect.php';
  $userstr = 'StudCo';
  if (isset($_SESSION['user']) || isset($_COOKIE['tuname'])){
    if (isset($_SESSION['user']) && isset($_COOKIE['auth_t'])){
      $xt = $_SESSION['user'];
      $chck = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$xt'"));
      if($chck['psdhd'] == $_COOKIE['auth_t']){
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        $userstr = $user;
      }
      else {
        $user = "";
      }
    }
    if(isset($_COOKIE['tuname'])){
        $gck = $_COOKIE['tuname'];
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $decryptionkey = "t/h/i/s/i/s/@/q/u/e/s/t";
        $options = 0;
        $decryption = openssl_decrypt($gck, $ciphering, $decryptionkey, $options, $decryption_iv);
        $egck = queryMysql("SELECT * FROM members WHERE user='$decryption'");
        if($egck->num_rows){
          $_SESSION['user'] = $decryption;
          $mfks = mysqli_fetch_array($egck);
          if(isset($_COOKIE['auth_t'])){
          if($_COOKIE['auth_t'] == $mfks['psdhd']){
            $user = $_SESSION['user'];
            $loggedin = TRUE;
            $userstr = "$user";  
          }
          else {
            $user = "";
          $loggedin = FALSE;
          }
        }
        else {
          $user = "";
          $loggedin = FALSE;
        }
        }
          else {
              $user = "";
            $loggedin = FALSE;
            }
    }
}
  else $loggedin = FALSE;
 
  echo <<<_END
<!DOCTYPE html>
<html lang="en-ng">
<head>
<title>Studco - Login</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
<link rel='icon' href='/students_connect/ico/favicon.ico' type="image/x-icon">
<link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
<link rel="shortcut icon" href="/students_connect/ico/favicon.ico" type="image/x-icon"/>
<!--<link rel="stylesheet" href="https://maxcdn.botstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
--><script src="/students_connect/jsf/student_connect.js">
</script>
<script>
function showPass() {
    var x = document.getElementById("ypass");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showPassword4").style.display="inline-block";
      document.getElementById("showPassword3").style.display="none";
    } else {
      x.type = "password";
      document.getElementById("showPassword4").style.display="none";
      document.getElementById("showPassword3").style.display="inline-block";
    }
  }
</script>
<style>
@media screen and (min-width:465px) {
   #studco {
       float: left;
       width: 10%;
       font-size:20px;
   }
   #signup, #login {
       float:right;
       font-size:20px;
   }
   li#studco a {
       display:block;
       color:white;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#login a {
       display:block;
       color:green;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#signup a {
       display:block;
       color:lightgreen;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   .active {
       background-color:green;
   }
   .error {
       color: #ff0000;
   }
  }
</style>
</head>
<body onload="checkDark()">

_END;
if (isset($loggedin)){
if($loggedin){
  echo <<<_END
      <div class="studco_body">
      <div class="navbar">
      <ul id="navbar_list">
      <li id="studco"><a href="/students_connect/home.php">StudCo</a></li>
      <li id="signup"><a href="/students_connect/signup.php">Sign Up</a></li>
      <li id="login"><a href="/students_connect/login.php">Login</a></li>
      </ul>   
      </div>
      _END;
  if(isset($_GET['utm'])){
      header("Location: ".$_GET['utm']);
  }
  else {
      header("Location: profile.php");
  }
}
else {
  echo <<<_END
      <div class="studco_body">
      <div class="navbar">
      <ul id="navbar_list">
      <li id="studco"><a href="/students_connect/home.php">StudCo</a></li>
      <li id="signup"><a href="/students_connect/signup.php">Sign Up</a></li>
      <li id="login"><a href="/students_connect/login.php">Login</a></li>
      </ul>   
      </div>
      _END;
}
  }
  else {
      echo <<<_END
      <div class="studco_body">
      <div class="navbar">
      <ul id="navbar_list">
      <li id="studco"><a href="/students_connect/home.php">StudCo</a></li>
      <li id="signup"><a href="/students_connect/signup.php">Sign Up</a></li>
      <li id="login"><a href="/students_connect/login.php">Login</a></li>
      </ul>   
      </div>
      _END;
  }
  ?>