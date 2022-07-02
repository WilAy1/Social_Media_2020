<?php
require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$emi = $row['id'];
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
echo <<<_END
  </ul>   
  </div>
_END;
if(isset($_GET['tfh'])){
  $y = time();
  $x = strtotime('24 hours ago');
  $from = 'AND timeofnot BETWEEN '.$x.' AND '.$y.'';
  $s = 'selected';
  $y = "";
  $z="";
  $slt = "";
  $w = "";
}
elseif(isset($_GET['awk'])){
  $y = time();
  $x = strtotime('1 week ago');
  $from = 'AND timeofnot >'.$y.'';
  $y = 'selected';
  $s = "";
  $z = "";
  $slt = "";
  $w = "";
}
elseif(isset($_GET['amo'])){
  $y = time();
  $x = strtotime('1 month ago');
  $from = 'AND timeofnot > '.$y.'';
  $z = 'selected';
  $s = "";
  $y = "";
  $w = "";
  $slt = "";
}
elseif(isset($_GET['ayo'])){
  $y = time();
  $x = strtotime('1 year ago');
  $from = 'AND timeofnot > '.$y.'';
  $w = 'selected';
  $z = "";
  $s = "";
  $y = "";
  $slt = "";
}
else {
  $from = '';
  $slt = '';
  $z = "";
  $s = "";
  $y= "";
  $w = "";
}
echo <<<_END
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
  <div class='nwbd'>
  <div class="sdbd">
  <div class='trl'>
  <a id='hello' href="">1234</a>
  <a id='hello' href="">1234</a>
  <a id='hello' href="">1234</a>
  <a id='hello' href="">1234</a>
  </div>
  </div>
  <div class='fln'>
  <div class='dcv'>
  <div class='nhd'>Notifications
  <div class='filter_cont'>
  <div class='filter'><span title='Filter Post'><i class='fas fa-filter'></i></span></div>
  <div class='sltopt'>
  <select title='Filter Post' id='ftpst' onchange='cttm(this.value, "$emi")'>
  <option value='flt' $slt>Filter</option>
  <option value='tfh' $s >24 Hours Ago</option>
  <option value='awk' $y>A Week Ago</option>
  <option value='amo' $z>A Month Ago</option>
  <option value='ayo' $w>A Year Ago</option>
  </select>
  </div>
  </div></div></div>
  <div class='ntc'>
  <div class='not_container'>
_END;
$not = queryMysql("SELECT * FROM notifications WHERE usertobenotified='$user' $from ORDER BY timeofnot DESC");
if($not->num_rows>0){
while($mnot = mysqli_fetch_assoc($not)) {
  $eut = queryMysql("SELECT * FROM notifications WHERE id='".$mnot['id']."' AND readalready='0'");
  $eeooo = '';
  if($eut->num_rows){
    $eeooo = "<div class='eeeeoo'></div>";
  }
  $ee ='';
  $ml = '';
  if(strpos($mnot['notlink'], "posts/") !== FALSE){
    $op = explode("/", $mnot['notlink']);
    $ext = count($op);
    $ptype = $op[$ext-1];
    if(strpos($ptype, 's') !== FALSE){
      $q = substr($ptype, 1, strlen($ptype));
      $fl = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$q'"));
      $ee = "<div class='ntter ppee'>\"".substr(strip_tags($fl['pstcont']), 0, 250).'..."</div>';
    }
    else {
      $fl = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$ptype'"));
      $ee = "<div class='ntter ppee'>\"".substr(strip_tags($fl['pstcont']), 0, 250).'..."</div>';
    }
  }
  elseif(strpos($mnot['notlink'], "user/") !== FALSE){
    $op = explode("/", $mnot['notlink']);
    $ext = count($op);
    $ptype = $op[$ext-1];
    $fl = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ptype'"));
    $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/".$fl['user'].'/');
                if(file_exists($fl['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$fl['user'].'/'.$fl['user'].'.png';  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
    $oqt = queryMysql("SELECT * FROM followstatus WHERE friend='$ptype'");
    $noff = mysqli_num_rows($oqt);
    if($noff == 0){
      $noff = 'No';
      $ff = 'Follower';
    }
    elseif($noff == 1){
      $ff = 'Follower';
    }
    else {
      $ff = 'Followers';
    }
    $oqt = queryMysql("SELECT * FROM followstatus WHERE user='$ptype'");
    $fnoff = mysqli_num_rows($oqt);
    $eff = 'Following';
    $ml = "<div class='ntter xcape'>
    <div class='plloe pstname' style='display: flex;'>
    <div class='tppooo imgfpstr' style='background-image: url(".$img.");'></div>
    <div class='nnname'>".$fl['firstname']." ".$fl['surname']."
                  <div class='unvme'><i class='fas fa-at'></i>".$fl['user']."</div></div>
    </div>
    <div class='rrttt'>
    <div class='mmeoirflw'>$noff $ff | $fnoff $eff</div>
    <div class='viewprofile'>View Profile</div>
    </div>
    </div>";
  }
  echo "<div class='entf' id='".$mnot['id']."'>
  <div class='chkbx'><input type='checkbox' class='cccllll' style='z-index: 0; background-color: white; border-radius: 100%;'/>
  <input type='hidden' value='".$mnot['id']."'>
  </div>
  <a href='".$mnot['notlink']."'>
  <div class='nothd'>".$mnot['notheading']."</div>
  ".$ee."
  <div class='notct'>".$mnot['notcontent']."</div>".$ml."
  <div class='notim' style='text-align: right; padding-right: 15px; font-size: 13px;'>".date('Y M\' d h:i a',$mnot['timeofnot'])."</div>
  ".$eeooo."</a></div>
  ";
}
}
else {
  echo "<div class='nna' style='text-align: center; font-size: 30px; padding: 20px;'>No Notification Avaialbe</div>";
}
  echo "</div>
  <div class='markasread' style='position: fixed; right: 10px; bottom: 60px;
  color: blue; padding:9px 12px; background: white; border-radius: 100%;
  border: 1px solid #ccc; display: none; z-index: 10;'><i class='fas fa-envelope-open'></i></div>
  <div class='d_lleette' style='position: fixed; right: 10px; bottom: 15px;
  color: red; padding:9px 12px; background: white; border-radius: 100%;
  border: 1px solid #ccc; display: none; z-index: 10;'><i class='fas fa-trash'></i></div></div></div>";
?>
<script>
 var toq = [];
 if(document.getElementsByClassName('cccllll')[0]){
   var ttt = document.getElementsByClassName('cccllll');
   for(var i =0; i< ttt.length; i++){
   ttt[i].onclick = function(){
    if(this.checked){
    toq.push(this.parentElement.children[1].value);
  }
  else {
    toq.pop(this.parentElement.children[1].value);
  }
  if(toq.length > 0){
      document.getElementsByClassName('d_lleette')[0].style.display = 'block';
      document.getElementsByClassName('markasread')[0].style.display = 'block';
    }
  else {
    document.getElementsByClassName('d_lleette')[0].style.display = 'none';
      document.getElementsByClassName('markasread')[0].style.display = 'none';
    }
 }
  }
 }
if(document.getElementsByClassName('d_lleette')[0]){
  document.getElementsByClassName('d_lleette')[0].onclick = function(){
    var fl =false;
      if(window.FormData){
      fl =  new FormData();
      } 
    for(var i =0; i < toq.length; i++){
      fl.append('oo[]', toq);
    }
    var t = this;
    $.ajax({
        url: '/students_connect/notification/manage.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(){
          for(var i =0; i < toq.length; i++){
            document.getElementById(toq[i]).style.display = 'none';
          }
          toq = [];
        t.style.display = 'none';
        }
      })
  }
}
if(document.getElementsByClassName('markasread')[0]){
  document.getElementsByClassName('markasread')[0].onclick = function(){
    var fl =false;
      if(window.FormData){
      fl =  new FormData();
      } 
    for(var i =0; i < toq.length; i++){
      fl.append('mrd[]', toq);
    }
    var t = this;
    $.ajax({
        url: '/students_connect/notification/manage.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(){
        t.style.display = 'none';
        }
      })
  }
}
if(document.getElementsByClassName('entf')[0]){
  var entf = document.getElementsByClassName('entf');
  for(var i = 0; i < entf.length; i++){
    entf[i].onclick = function(){
      var eii = this.id;
      var fl =false;
      if(window.FormData){
      fl =  new FormData();
      }
      fl.append("ei",eii);
      $.ajax({
        url: '/students_connect/notification/manage.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(){
        }
      });
    }
  }
}
</script>
<script src='/students_connect/jsf/filescript.js'></script>
</body>
</html>