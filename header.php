<?php
session_start();
require_once 'connect.php';
$userstr = 'Studco';
if (isset($_SESSION['user']) || isset($_COOKIE['tuname'])){
    if (isset($_SESSION['user']) && isset($_COOKIE['auth_t'])){
    $xt = $_SESSION['user'];
    $chck = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$xt'"));
      if($chck['psdhd'] == $_COOKIE['auth_t']){
        $loggedin = TRUE;
        $userstr = "$user"; 
      }
      else {
          $loggedin = FALSE;
        $urs = "";
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
            $chck = mysqli_fetch_array($egck);
            if(isset($_COOKIE['auth_t'])){
        if($chck['psdhd'] == $_COOKIE['auth_t']){
            $loggedin = TRUE;
            $userstr = "$user";}
        else {
            $loggedin = FALSE;
            $userstr = "";
        }
            }
            else {
                $loggedin = FALSE;
                $userstr = "";
            }
        }
            else {
                $loggedin = FALSE;
                $user = "";
            }
          }
          else {
            $user = "";
          $loggedin = FALSE;
          }
    }
else $loggedin = FALSE;
echo <<<_END
<!DOCTYPE html>
<html lang="en-ng" id='quest'>
<head>
<title>Sign Up / Log In - StudCo</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link rel='icon' href='/students_connect/ico/favicon.ico' type="image/x-icon">
<link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
<link rel="shortcut icon" href="/students_connect/ico/favicon.ico" type="image/x-icon"/>
<script src="/students_connect/jsf/student_connect.js" type="text/javascript"></script>
<script data-cfasync="false" src="/students_connect/jquery.min.js" type="javascript"></script>
<script data-cfasync="false" src="/students_connect/jquerya-3.5.1.js"></script>
<script data-cfasync="false" src="/students_connect/jquery-ui/jquery-ui.min.js"></script>
<script>
function showPass() {
    var x = document.getElementById("ypass");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showPassword1").style.display="inline-block";
      document.getElementById("showPassword").style.display="none";
    } else {
      x.type = "password";
      document.getElementById("showPassword1").style.display="none";
      document.getElementById("showPassword").style.display="inline-block";
    }
  }
function lessage(){
    document.getElementById('alins').style.display='block';
}
function nas(){
    if(document.getElementById('institution').value == 'nas'){
        document.getElementById('course').value = 'nas';
        document.getElementById('status_3').checked = true;
    }
    else {
        document.getElementById('course').value = 'acct';
        document.getElementById('status_3').checked = false;
    }
}
</script>
<style>
@media screen and (min-width:465px) {
    .navbar {
        min-width: 100%;
        padding:0px;
        overflow: hidden;
    }
   #navbar_list {
       list-style-type: none;
       margin: 0;
       padding: 0;
       overflow: hidden;
       background-color:#555;
       display: block;
   }
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
   li a:hover {
       background-color: black;
   }
   .active {
       background-color:green;
   }
}
</style>
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body onload="checkDark()" style="">
_END;

if ($loggedin)
{
    header("Location:/students_connect/profile.php");
    exit;
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