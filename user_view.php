<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'header2.php';

  if (!$loggedin) die();
  else {
    $usr = $_SESSION['user'];
$row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
if(isset($_GET['delp'])){
  unlink("../students_connect_hidden/users_profile_upload/".$row['user']."/".$row['user'].".png");
}
if(isset($_GET['delc'])){
  unlink("../students_connect_hidden/users_profile_upload/".$row['user']."/cover/cover.png");
}
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
if(!file_exists("../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"user.png'\")'; class='mypimg'></div></a></li>";
}
else{
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
  </ul> 
  </div>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style='min-height: 695px;'>
  <div class='xh_dhh'>
  <div class='xh_ba mractive'>Profile Image</div>
  <div class='xh_by'>Cover Image</div>
  </div>
  <div class='xHP_f_p' style='display'>
_END;
if(!file_exists("../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  echo "<div class='shwmyimg'><div class='ol_upd' style='background-image: url(\"user.png\")' title='Image'></div></div>";
 }
else{
  echo "<div class='shwmyimg'><div class='ol_upd' style='background-image: url(\"../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\"' title='Image'/></div></div>";
}
echo <<<_END
    <div class='im_al_up'>
    <label for='uploaddp'><span class='ol_opn'><i class='fas fa-camera' style="font-size: 20px;"></i></span></label>
    <span class='ol_del'><a href='?delp'><i class='fas fa-trash' style="font-size: 20px; color: red"></i></a></span></label>
    <form method='post' action='uploads.php' enctype="multipart/form-data">
    <input type='file' id='uploaddp' name='fileToUpload' style="display: none;" accept='image/*'>
    <button type='submit' name='submit' class='ol_oxd'>Upload</button></form>  
    </div></div>
    <div class='ol_xlk'></div>
    <div class='ok_for_bcp' style='display: none;'>
_END;
if(!file_exists("../students_connect_hidden/users_profile_upload/".'/'.$row['user']."/cover/cover.png")){
  echo "<div class='shwmyimg'><div class='ol_upd' style='background-color: brown; background-image: url('user.png')' title='Image'></div></div>";
}
else{
  echo "<div class='shwmyimg'><div class='ol_upd' style='background-color: brown; background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user']."/cover/cover.png\")' title='Image'/></div></div>";
}
echo <<<_END
    <div class='im_al_up'>
    <label for='uploadcover'><span class='ol_opn'><i class='fas fa-camera' style="font-size: 20px;"></i></span></label>
    <span class='ol_del'><a href='?delc'><i class='fas fa-trash' style="font-size: 20px; color: red"></i></a></span></label>
    <form method='post' action='uploads.php' enctype="multipart/form-data">
    <input type='file' id='uploadcover' name='cover' style="display: none;" accept='image/*'>
    <button type='submit' name='cover_submit' class='up_cover'>Upload</button></form>  
    </div>
    </div>
    </div>
    _END;
#require_once "footer/index.php";
echo "  </div></div>";
  }
 ?>
 <script>
   var pio = document.getElementById('uploaddp');
   var xlk = document.getElementsByClassName('ol_xlk')[0];
   pio.addEventListener('change',  function(e){
     console.log(e);
     var img = document.createElement('IMG');
     img.src = URL.createObjectURL(e.target.files[0]);
     img.style.width = '50%';
     img.onload = function(){
       document.body.append(img);
     var canvas = document.createElement('canvas');
     var context = canvas.getContext("2d");
     context.drawImage(img, 10, 10, 300, 175, 0, 0, 100, 175);
     document.body.append(canvas);
     }
   })
   var ml = document.getElementsByClassName('xh_by')[0];
   var q = document.getElementsByClassName('xh_ba')[0];
   var oq = document.getElementsByClassName('xHP_f_p')[0];
   var mq = document.getElementsByClassName('ok_for_bcp')[0];
   ml.addEventListener('click', function(){
    ml.classList.add('mractive');
    q.classList.remove('mractive');
    oq.style.display = 'none';
    mq.style.display=  'block';
   })
   q.addEventListener('click', function(){
    q.classList.add('mractive');
    ml.classList.remove('mractive');
    oq.style.display = 'block';
    mq.style.display=  'none';
   })
  
 </script>
</body>
</html>
