<?php

require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
if(!$loggedin) die();
else {
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $nm = $_SESSION['user'];
    $myusername = $row['user'];
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
$rrtu = queryMysql("SELECT * FROM followstatus WHERE user='".$row['user']."' ORDER BY friend ASC");
$rrrtu = queryMysql("SELECT * FROM followstatus WHERE friend='".$row['user']."' ORDER BY user ASC");
$nrr = mysqli_num_rows($rrtu);
$nrrr = mysqli_num_rows($rrrtu);
if(isset($_GET['flwrs'])){
  $grmt = 'block';
  $rrt = 'none';
  $oth = 'spactive';
  $mot = '';
}
else {
  $grmt = 'none';
  $rrt = 'block';
  $oth = '';
  $mot= 'spactive';
}
echo <<<_END
  </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
  <div class='m_flwbase'>
  <div class='f_jaaheading'>
  <a href='?' class='lrep' style='color: inherit;'><div class='f_ffllwrs $mot'>Following<span class='f_sspan'>($nrr)</span></div></a>
  <a href='?flwrs' class='crepp' style='color: inherit'><div class='f_ffflwing $oth'>Followers<span class='f_sspan'>($nrrr)</span></div></a>
  </div>
  <div class='f_jaabody'>
_END;
  echo "<div class='pl_ff_bby' style='display: $rrt'>";
if($rrtu->num_rows){
  while($gr = mysqli_fetch_array($rrtu)){
    $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gr['friend']."'"));
    $mell = getcwd();
    chdir("../../students_connect_hidden/users_profile_upload/".$mlkk['user'].'/');
    if(file_exists($mlkk['user'].".png")){
      $eoll = "/students_connect_hidden/users_profile_upload/".$mlkk['user'].'/'.$mlkk['user'].".png";
    }
    else {
      $eoll = "/students_connect/user.png";
    }
    chdir($mell);
    echo "<div class='f_nnommm'>
    <div class='f_per_hhd'>
    <div class='f_lloimg' style='background-image: url(\"".$eoll."\")'></div>
    <div class='f_tjjrrm'>
    <a href='/students_connect/user/".$mlkk['user']."'>
    <div class='f_wwlwiikd'>".$mlkk['firstname']." ".$mlkk['surname']."</div>
    <div class='f_lloajjdk'><i class='fas fa-at'></i>".$mlkk['user']."</div>
    </a>
    <div class='f_laldei'>".nl2br(lhash($mlkk['about']))."</div>
    </div>
    <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' name='fuser' value='".$mlkk['user']."'>
            <input type='hidden' name='user' value='".$row['user']."'>
            <button class='f_lioop rf_xoop'>
            Unfollow</button></div>
            </div>
    </div>
    </div>";
  }
}
else {
  echo "<div class='f_nttott'>No Following</div>";
}
echo "</div>";
echo "<div class='f_jjmnnm' style='display: $grmt'>";
if($rrrtu->num_rows){
  while($gr = mysqli_fetch_array($rrrtu)){
    $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gr['user']."'"));
    $mell = getcwd();
    chdir("../../students_connect_hidden/users_profile_upload/".$mlkk['user'].'/');
    if(file_exists($mlkk['user'].".png")){
      $eoll = "/students_connect_hidden/users_profile_upload/".$mlkk['user'].'/'.$mlkk['user'].".png";
    }
    else {
      $eoll = "/students_connect/user.png";
    }
    chdir($mell);
    $yoo = queryMysql("SELECT * FROM followstatus WHERE user='".$row['user']."' AND friend='".$mlkk['user']."'");
    if($yoo->num_rows){
      $readyfunc = 'Unfollow';
    }
    else {
      $readyfunc = 'Follow';
    }
    echo "<div class='f_nnommm'>
    <div class='f_per_hhd'>
    <div class='f_lloimg' style='background-image: url(\"".$eoll."\")'></div>
    <div class='f_tjjrrm'>
    <a href='/students_connect/user/".$mlkk['user']."'>
    <div class='f_wwlwiikd'>".$mlkk['firstname']." ".$mlkk['surname']."</div>
    <div class='f_lloajjdk'><i class='fas fa-at'></i>".$mlkk['user']."</div>
    </a>
    <div class='f_laldei'>".nl2br(lhash($mlkk['about']))."</div>
    </div>
    <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' name='fuser' value='".$mlkk['user']."'>
            <input type='hidden' name='user' value='".$row['user']."'>
            <button class='f_lioop rf_xoop'>
            ".$readyfunc."</button></div>
            </div>
    </div>
    </div>";
  }
}
else {
  echo "<div class='f_nttott'>No Followers</div>";
}
echo <<<_END
  </div>
  </div>
  </div>
  <script>
var mffl = document.getElementsByClassName('f_ffllwrs');
var gffl = document.getElementsByClassName('f_ffflwing');
var t = document.getElementsByClassName('pl_ff_bby')[0];
var n = document.getElementsByClassName('f_jjmnnm')[0];
var fol = document.getElementsByClassName('f_lioop');
var crp = document.getElementsByClassName('crepp')[0];
var lp = document.getElementsByClassName('lrep')[0];
for(var i = 0; i < fol.length; i++){
  fol[i].onclick = function(){
    var tfol = this.children[0].value;
    var tr = this;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      xmlhttp.onload = function(){
        tr.innerHTML = "<input type='hidden' value='"+tfol+"'>"+xmlhttp.responseText;
      }
      xmlhttp.onerror = function(){

      }
    }
    xmlhttp.open("POST", "/students_connect/friends/flw.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("fr="+tfol);
  }
}
mffl[0].onclick = function(){
  var me = this.parentElement.children;
  gffl[0].className = gffl[0].className.replace('spactive', "");
  this.classList.add("spactive");
  t.style.display = 'block';
  n.style.display = 'none';
}
gffl[0].onclick = function(){
  var me = this.parentElement.children;
  mffl[0].className = mffl[0].className.replace('spactive', "");
  this.classList.add("spactive");
  n.style.display = 'block';
  t.style.display = 'none';
}
crp.onclick = function(e){
  window.history.pushState("", "", crp.href);
  e.preventDefault();
}
lp.onclick = function(e){
  window.history.pushState("","",lp.href);
  e.preventDefault();
}
  function showFol(evt, type) {
    // Declare all variables
    var i, tbffcont, tbfflnk;

    // Get all elements with class="tabcontent" and hide them
    tbffcont = document.getElementsByClassName("tbffcont");
    for (i = 0; i < tbffcont.length; i++) {
        tbffcont[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tbfflnk = document.getElementsByClassName("tbfflnk");
    for (i = 0; i < tbffcont.length; i++) {
        tbfflnk[i].classList.remove("nactive");
    }

    // Show the current tab, and add an "nactive" class to the link that opened the tab
    document.getElementById(type).style.display = "block";
    evt.currentTarget.classList.add("nactive");
}
function shwSom(){
    document.getElementsByClassName('ct').classList.add("nactive");
}
  </script>
  
  
  <!-- <div class='tabflw'>
  <ul class='tbff'>
  <li class='flwers cmnsm'><a href='#' class='tbfflnk' onclick='showFol(event, "shflwr"); loadfContent("$nm")'>Followers</a></li>
  <li class='flwng cmnsm'><a href='#' class='tbfflnk' onclick='showFol(event, "shflwn"); loadfoContent("$nm")'>Folowing</a></li>
  <li class='mtual cmnsm dif'><a href='#' class='tbfflnk' onclick='showFol(event, "shmtl"); loadfmContent("$nm")'>Mutual Followers</a></li>
  </ul>
  <div id='shflwr' class='ct tbffcont' onload='shwSom()'>
  <div class='nmoftb'>$myusername's Followers</div>
  <div id='flshw'></div>
  <div id='loadingf' style='display: none;'>Fetching Mutual... Please Wait.</div>
  <div id='tagnf' style='display: none;' onclick='loadfContent("$nm")'>Try Again <i class='fas fa-redo'></i></div>  
  </div>
  <div id='shflwn' class='tbffcont'><div class='nmoftb'>Following</div>
  <div id='fllshw'></div>
  <div id='loadingff' style='display: none;'>Fetching Mutual... Please Wait.</div>
  <div id='tagnff' style='display: none;' onclick='loadfoContent("$nm")'>Try Again <i class='fas fa-redo'></i></div>
  </div>
  <div id='shmtl' class='tbffcont'><div class='nmoftb'>Mutual</div>
  <div id='loadingm' style='display: none;'>Fetching Mutual... Please Wait.</div>
  <div id='tagnmf' style='display: none;' onclick='loadfmContent("$nm")'>Try Again <i class='fas fa-redo'></i></div>  
  <div id='mushw'></div>
  
  </div>
  </div>-->
  
  <script src='/students_connect/jsf/filescript.js'></script>
_END;
}
?>