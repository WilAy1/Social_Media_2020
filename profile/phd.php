<?php
session_start();
define("root", "/Users/wilay/students_connect/");
require_once root."connect.php";
if(isset($_SESSION['user'])  || isset($_COOKIE['tuname'])){
        if (isset($_SESSION['user'])){
        $user = $_SESSION['user'];
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
            }
        }
        $pol = queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."' AND active='1'");
        if($pol->num_rows){
            $loggedin= TRUE;
        }
        else {
            $loggedin = FALSE;
            if(isset($_SERVER['HTTP_REFERER'])){
                $gto = '?utm='.$_SERVER['HTTP_REFERER'];
              }
              else {
                $gto =  "?";
              }
            die("<script>
            function Redirect() {
                window.location='/students_connect/login.php".$gto."&err=1';
            }
            setTimeout('Redirect()', 1)</script>");
        }
}
elseif((strpos($_SERVER['PHP_SELF'], '/user/')==true)){
    require_once '../streamlined.php';
    die();
}
else {
    $loggedin = FALSE;
    if(isset($_SERVER['HTTP_REFERER'])){
        $gto = '?utm='.$_SERVER['HTTP_REFERER'];
      }
      else {
        $gto =  "";
      }
    die("<script>
    function Redirect() {
        window.location='/students_connect/login.php".$gto."';
    }
    setTimeout('Redirect()', 1)</script>");
    }
if($loggedin && (isset($_GET['u']) || isset($iam))){
    if (isset($_SESSION['user'])){
    $usr = $_SESSION['user'];
    }
    if(isset($_COOKIE['tuname'])){
        $gck = $_COOKIE['tuname'];
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $decryptionkey = "t/h/i/s/i/s/@/q/u/e/s/t";
        $options = 0;
        $decryption = openssl_decrypt($gck, $ciphering, $decryptionkey, $options, $decryption_iv);
        $_SESSION['user'] = $decryption;
    }
    $bed = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $user = $bed['user'];
    if(isset($_GET['u'])){
    $abc = $_GET['u'];
    $abcd = "userprofilecode='$abc'";
    }
    else {
        $abcd = "user = '$iam'";
    }
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE $abcd"));
    if($user == $upc['user']){
        header("Location: /students_connect/profile.php");
        exit;
    }
    else 
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $dc = ucfirst($upc['user']);
    echo <<<_END
    <!DOCTYPE html>
    <html lang="en-ng" id='quest'>
    <head>
    <title>Qwifty - $user | $dc's Profile</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML, CSS,Javascript, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
    <link rel="stylesheet" href="/students_connect/cssf/settingstyle.css" type="text/css">
    <link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
    <link rel='icon' href='/students_connect/ico/favicon.ico' type="image/x-icon">
    <link rel="shortcut icon" href="/students_connect/ico/favicon.ico" type="image/x-icon"/>
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.botstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    --><script src="/students_connect/jsf/student_connect.js" type="text/javascript"></script>
    <script src="/students_connect/jquery.min.js" type="javascript"></script>
    </script>
    <script src="/students_connect/jquerya-3.5.1.js"></script>
    <script src="/students_connect/jquery-ui/jquery-ui.min.js"></script>
    <link href='/students_connect/jquery-ui/jquery-ui.css' type='text/css' />
    <script src="/students_connect/jsf/updates.js.php"></script>
    <script>
    function checkOnline() {
        var x = navigator.onLine;
        if(x===true){
            document.getElementById('online').style.display = 'block';
            document.getElementById('online').innerHTML = "Online";
    
        }
        else {
        document.getElementById('offline').style.display = 'block';
        document.getElementById('offline').innerHTML = "Offline";
    }   
    }
    function vsmiw() {
        var x = document.forms["sndpst"]["sendposts"].value;
        if (x == null || x == "") {
            alert("Name must be filled out");
            return false;
        }
    }
    function storeDark(){
        var slider = document.getElementById('input');
        if(typeof(Storage) !== "undefined") {
            if (slider.checked == true){
                var d = new Date();
                d.setTime(d.getTime() + (24*60*60*1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = "drkmd=1; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
                sessionStorage.switch = 1;
            }
            else {
                document.cookie = "drkmd=0; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
                sessionStorage.switch = 2; 
            }
        
    }
    }
    function readURL(input){
        if (input.flies && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    var loadFile = function(event) {
        var output = document.getElementById("img2bu");
        output.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('img2bu').style.display='block'; 
        output.onload = function () {
          URL.revokeObjectURL(output.src)
        }
      };
      function displayComment(){
        document.getElementById("addcom").style.display = "flex";
    }
    </script>
    
    <style>
    @media screen and (min-width:500px) {
       #navbar_list {
           list-style-type: none;
           margin: 0;
           padding: 0;
           height:51px;
           position: sticky;
           overflow: hidden;
           background-color:#555;
           width: 100%;
           min-width: 100%;
       }
       #studco {
           float: left;
           width: 10%;
           font-size:30px;
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
       .error {
           color: #ff0000;
       }
    
      
    
    #arrange_head {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    
    }
    
    li {
      display:block;
      float:left;
    }
    }
    </style>
    </head>
    <body onload="checkDark();" id="body">
    _END;
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
  </i></a></li>
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
  </i></a></li>    <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
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
<div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:695px;">
<div id='pgerror' style='width: 100%'>
<div class='x_l_abs'>No Internet Connection <span class='mtr_r' style='float: right;'><i class='fas fa-times'></i></span></div>
</div>
<div class='timgbsys' style='display: none;'><div id='thimgv'>
  <span id='plding'></span>
  </div>
  <div id='timgerror'></div>
  <span class='clview' id='clview'>x</span></div>
  <div id='pageisloading' style='display: none'>
  <div id='rpi_l'>
  <div id='p_i_loading'></div>
  </div>
  </div>
  <div id='userpageisloading' style='display: none'>
  <div id='rpi_l'>
  <div id='p_i_loading'></div>
  </div>
  </div>
  <div id='pageloadfailed' style='display:none'>
  <div id='plo_f'>
  <div class='p_l_failed'></div>
  </div>
  </div>
  <div id='middlefor' style='display: none;'>
  <div id='fidforba'>
  <div id='leag_ue'>
  Alert</div>
  <div id='ko_llert'></div>
  <div class='okaybut' 
  onclick='this.parentElement.parentElement.style.display="none"'>Okay</div>
  </div>
  </div>
  <div class='in_notification in__eee'></div>
_END;
}
?>