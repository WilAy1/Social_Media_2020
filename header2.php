<?php
session_start();
  require_once 'connect.php';
  $userstr = 'StudCo';
  $merro = '';
  if (isset($_SESSION['user']) || isset($_COOKIE['tuname'])){
    if (isset($_SESSION['user']) && isset($_COOKIE['auth_t'])){
      $xt = $_SESSION['user'];
      $chck = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$xt'"));
      if($chck['psdhd'] == $_COOKIE['auth_t']){
        $urs = $_SESSION['user'];
      }
      else {
        $urs = "";
      }
    }
    elseif(isset($_COOKIE['tuname'])){
        $gck = $_COOKIE['tuname'];
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $decryptionkey = "t/h/i/s/i/s/@/q/u/e/s/t";
        $options = 0;
        $decryption = openssl_decrypt($gck, $ciphering, $decryptionkey, $options, $decryption_iv);
        $egck = queryMysql("SELECT * FROM members WHERE user='$decryption'");
        if($egck->num_rows){
          $mfks = mysqli_fetch_array($egck);
          if(isset($_COOKIE['auth_t'])){
          if($_COOKIE['auth_t'] == $mfks['psdhd']){
          $_SESSION['user'] = $decryption;
          $urs = $_SESSION['user'];
          }
          else {
            $urs = "";
          }
        }
        else {
          $urs = "";
        }
        }
        else {
            $urs = "";
        }
    }
    else {
      $urs = "";
    }
    $efks = queryMysql("SELECT * FROM members WHERE user='".$urs."' AND active='1'");
    if($efks->num_rows){
    $mfks = mysqli_fetch_array($efks);
    $user = $mfks['user'];
    $loggedin = TRUE;
    $userstr  = $user;
    $time= time();
    queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$user'");
    }
    else {
        $loggedin = FALSE;
    }
    $motee = queryMysql("SELECT * FROM members WHERE user='".$urs."' AND active='3'");
    if($motee->num_rows){
      $merro = '?err=1';
    }
}
  else $loggedin = FALSE;
  if(isset($_GET['pid'])){
  $aaid = $_GET['pid'];
    global $aaid;
}
    else {
        $aaid = "";
        global $aaid;
    }
    if(isset($_GET['n']) && (strpos($_SERVER['PHP_SELF'], '/messages/')!=true)){
        $nm = $_SESSION['user'];
        global $nm;
    }
    else {
        $nm ="";
        global $nm;
    }
    if(isset($_POST['anul'])){
      $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
      $user = $row['user'];
      $psdhd =$row['psdhd'];
      $ste = $row['user'];
      $ttime = time() + 3600 * 24 * 30*12;
      if(isset($_COOKIE['t'])){
        $qe = json_decode($_COOKIE['t']);
      }
      else {
        $qe = array();
      }
      array_push($qe, array($row['id'], $ste, $psdhd));
      setcookie('t', json_encode($qe), $ttime);
      
    }
    if(isset($_POST['rm'])){
      $ptr = dec($_POST['rm']);
      if(isset($_COOKIE['t'])){
        $x = $_COOKIE['t'];
        $e = json_decode($x);
        if(is_object($e)){
          $e = (array) $e;
          $e = array_values($e);
        }
        for($i = 0; $i < count($e); $i++){
          $gh = $e[$i][1];
          if($gh == $ptr){
            $ttime = time() + 3600 * 24 * 30*12;
            unset($e[$i]);
            setcookie('t', json_encode(array()), $ttime);
            $xtime = time() + 3600 * 24 * 30*12;
            setcookie('t', json_encode($e), $xtime);
          }
        }  
      }
    }
 echo <<<_END
<!DOCTYPE html>
<html lang="en-ng" id='quest'>
<head>
<title>Qwifty - $userstr</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
<link rel="stylesheet" href="/students_connect/cssf/hstyle.css" type="text/css">
<link rel="stylesheet" href="/students_connect/cssf/settingstyle.css" type="text/css">
<link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
<link rel='icon' href='/students_connect/ico/favicon.ico' type="image/x-icon">
<link rel="shortcut icon" href="/students_connect/ico/favicon.ico" type="image/x-icon"/>
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.botstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
--><link rel='apple-touch-icon' href='/students_connect/ico/StudCo.ico'>
<link rel="apple-touch-startup-image" href="/students_connect/ico/StudCo.png">
<meta name="apple-mobile-web-app-title" content="StudCo">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<!--<script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
--><link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='/students_connect/jsf/web.js'></script>
<script data-cfasync="false" src="/students_connect/jquery.min.js" type="javascript"></script>
<script data-cfasync="false" src="/students_connect/jquerya-3.5.1.js"></script>
<script data-cfasync="false" src="/students_connect/jquery-ui/jquery-ui.min.js"></script>
<script data-cfasync="false" src="/students_connect/jsf/student_connect.js" type="text/javascript"></script>
<script data-cfasync="false" src='/students_connect/jsf/student_connect.js.php?pid=$aaid'></script>
<script src="/students_connect/jsf/tckreader.js" type="text/javascript"></script>
<script data-cfasync="false" src='/students_connect/jsf/student_connectflw.js.php?n=$nm'></script>
<link href='/students_connect/jquery-ui/jquery-ui.css' type='text/css' />
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

  function displayComment(){
    document.getElementById("addcom").style.display = "flex";
}

  if(document.getElementsByClassName('lastpl')){
    var g = document.getElementsByClassName('lastpl');
    for(var i = 0; i < g.length; i++){
      var xe = g[i];
      xe.onclick = function(){
        var crar = [];
        var value= this.value;
        var pid = this.children[3].value;
        var user = this.children[2].value;
        a = this.firstElementChild.className;
      this.firstElementChild.className = a.replace('far fa-circle c_y', 'fas fa-check-circle c_x');
      this.style.backgroundColor = 'rgb(31, 182, 31)';
      var x = this.parentElement;
        var xy = x.parentElement;
        var ex = xy.parentElement;
        var kxy = ex.children;
        for(var e = 0; e < kxy.length; e++){ 
        var k = kxy[e].children;
        for(var d = 0; d < k.length; d++){
          var l = k[d].children;
          for(var t = 0; t < l.length; t++){
          l[t].setAttribute('disabled', 'disabled');
          crar.push(l[t]);
        }
        }
      }
      var ls1 = crar[0].children[4];
      var ls2 = crar[1].children[4];
      var ls3 = crar[2].children[4];
      var ls4 = crar[3].children[4];
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var db = xmlhttp.responseText;
          var p1 = db.indexOf('P');
          var p2 = parseInt(db.indexOf('K')+1);
          var p3 = parseInt(db.indexOf('A')+1);
          var p4 = db.indexOf('T');
          ls1.innerHTML = db.substring(0, p1);
          ls2.innerHTML = db.substring(p1+1, parseInt(p2-1));
          ls3.innerHTML = db.substring(p2, p3-1);
          ls4.innerHTML = db.substring(p3, p4);
        }
    };
    xmlhttp.open('GET', '/students_connect/polls/?id='+pid+'&vote='+value+'&user='+user);
    xmlhttp.send();
    }
    }
  }
  $.ajax({
    url:'/students_connect/xeo.php?time='+Intl.DateTimeFormat().resolvedOptions().timeZone,
    method:'GET',
  });
</script>
_END;
echo <<<_END
<style>
@media screen and (min-width:799px) {
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
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body onload="checkDark();" id='body'>
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
  <div class='action-center'></div>
_END;
if ($loggedin && !isset($_GET['u']))
  {

echo <<<_END

_END;
  }
  elseif($loggedin && isset($_GET['u'])){
    $a = $_GET['u'];
    $d = queryMysql("SELECT * FROM members WHERE userprofilecode='$a'");   
    if($d->num_rows){
            $a= $_GET['u'];
        $dq = mysqli_fetch_array($d);
        $wk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        if($dq['user'] != $wk['user']){
        echo "<script>
            function Redirect() {
                window.location='/students_connect/profile?u=$a';
            }
            setTimeout('Redirect()', 1)</script>";
            }
            else {
                echo "<script>
            function Redirect() {
                window.location='/students_connect/profile.php';
            }
            setTimeout('Redirect()', 1)</script>";
            }
        }
        else {
            echo "<script>
            function Redirect() {
                window.location='/students_connect/profile.php';
            }
            setTimeout('Redirect()', 1)</script>";
        }
  }
  else
  {
    if((strpos($_SERVER['PHP_SELF'], '/user/')==true) || (strpos($_SERVER['PHP_SELF'], '/posts/')==true)
    || (strpos($_SERVER['PHP_SELF'], '/search/')==true)){
      $user = '';
      if((strpos($_SERVER['PHP_SELF'], '/user/')==true)){
        require_once "user/streamlined.php";
      }
      elseif((strpos($_SERVER['PHP_SELF'], '/posts/')==true)){
        require_once "../pst/streamlined.php";
      }
      elseif((strpos($_SERVER['PHP_SELF'], '/search/')==true)){
        
      }
      else {
        if(isset($_SERVER['HTTP_REFERER'])){
          $gto = '?utm='.$_SERVER['HTTP_REFERER'];
        }
        else {
          $gto =  "";
        }
        if($merro == ''){
        die("<script>
        function Redirect() {
            window.location='/students_connect/login.php".$gto."';
        }
        setTimeout('Redirect()', 1)</script>");
      }
      else {
        die("<script>
        function Redirect() {
            window.location='/students_connect/logout.php".$merro."';
        }
        setTimeout('Redirect()', 1)</script>");
      }
      } 
    }
    else {
      if(isset($_SERVER['HTTP_REFERER'])){
        $gto = '?utm='.$_SERVER['HTTP_REFERER'];
      }
      else {
        $gto =  "";
      }
      if($merro == ''){
        die("<script>
        function Redirect() {
            window.location='/students_connect/login.php".$gto."';
        }
        setTimeout('Redirect()', 1)</script>");
      }
      else {
        die("<script>
        function Redirect() {
            window.location='/students_connect/logout.php".$merro."';
        }
        setTimeout('Redirect()', 1)</script>");
      }
    }
  }
?>
<script>
  window.onclick = function(){
  errortypes = {
    
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById('pgerror').style.display = 'none';
    }
    if(navigator.onLine == false) {
      document.getElementById('pgerror').style.display = 'block';
    }
};
xmlhttp.open('POST', '/students_connect/conline.php');
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send();
}
window.onload = function(){
  var td = new Date();
  var ctd = td.getTime();
  var lt = parseInt(ctd/1000);    
  setInterval(function(){
    var fl =false;
      if(window.FormData){
      fl =  new FormData();
      }
      var td = new Date();
      var ctd = td.getTime();
      var rr = parseInt(ctd/1000);
      fl.append('oltm', rr);
      fl.append('lt', lt);
      $.ajax({
        url: '/students_connect/eupdate.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(d){
          lt = rr;
          if(d == ''){
            document.getElementsByClassName('in_notification')[0].style.display = 'none';
          }
          else {
            $('.in_notification').html(d);
            document.getElementsByClassName('in_notification')[0].style.display = 'block';
            document.getElementsByClassName('in_notification')[0].classList.remove('in__eee');
            document.getElementsByClassName('in_notification')[0].classList.add('in__eee');
          }
        }
      });
  }, 5000);
}
document.onclick = function(e){
  if(e.target != document.getElementsByClassName('in_notification')[0]){
    document.getElementsByClassName('in_notification')[0].style.display = 'none';
  }
}
</script>