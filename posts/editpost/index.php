<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
if(isset($_POST['edtpstid']) && isset($_POST['editor'])){
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    echo <<<_END
    <div class="navbar2">
    <ul id="navbar_list">
    <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
    <li id="hmic" style=''><a href="/students_connect/trend"><i class="fas fa-bolt"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="fas fa-bell"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="fas fa-envelope"></i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
  _END;
  if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../user.png'\")'; class='mypimg'></div></a></li>";
  }
  else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
  }
  echo <<<_END
      </ul>   
    </div>
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height: 650px;">
    <div class='ebdy'>
    _END;
$id = $_POST['edtpstid'];
$user = $_POST['editor'];
if($_POST['editor'] == $row['user']){
$pststry = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id' AND user='$user'"));
echo "<div class='edttxt' style='float: left; width: 50%;'>
<div class='edtxtbx'>
<textarea rows='30' style='width: 80%;' name='edtpst' id='editedpost' 
class='earea' onkeyup='editpostvalue(this.value)' placeholder='Edit Post.' autofocus>".$pststry['pstcont']."</textarea>
</div>
<div class='edtoth'>
<div class='ademg nnd'>
<label for='edpimg' style='cursor: pointer;' title='Add Image'><i class='fas fa-camera'></i></label>
<input type='file' name='edpstimg[]' style='display: none' id='edpimg' multiple/>
</div>
<div class='dltinedt nnd' style='color: red' title='Delete Post'>
<form method='POST' action='/students_connect/profile.php'>
<input type='hidden' value='".$id."' name='dltpstid'>
<input type='hidden' name='dltpst' value='".$user."'>
<button type='submit' name='dltpstsb' title='Delete Post' class='igmsig'>
<i class='fas fa-trash'></i></button></div>
</form>
<div class='sndmsg nnd' title='Submit Edited Post' onclick='saveeditpost(\"".$id."\" , 
  document.getElementById(\"editedpost\").value, \"".$user."\")'>
  Edit Post</div>
<div class='addecmt nnd'>
<form action='/students_connect/posts/pst#$id' method='GET'>
<input type='hidden' name='pid' value='$id'>
  <input type='hidden' name='cid' value='0'>
  <button type='submit' class='sbm' title='Add Comment'>
<span><i class='far fa-comment'></i></span>
</button></div></div>
  </div></div>
<div class='pstgngn' style='float: right; width: 50%;'>
";
$medu = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE user='$user' AND id='$id'"));
    echo <<<PSTS
                  <div class='camp'>
                   <div class='amps' style='width: 80%' id='
            PSTS;
                  echo $medu['id']."'>";
                  echo <<<PSTS
                      <div class='ipt'></div><div class='namp'>
                PSTS;
                if(file_exists("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/'.$medu['user'].".png")){ 
                  $img =  '../../../students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
                  }
                  else {
                      $img =  'user.png';
                  }
                  
                  echo "<div class='pstname' style='display: flex;'><a href='profile.php?u=".$mbs['userprofilecode']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$mbs['surname']." ".$mbs['firstname']."</a></div></div></div>";
                  echo '<div class="mpst" id="mpst">
                  '.nl2br($medu['pstcont']).'</div>
                  <div class="postimages">';
                  for($i = 0; $i < 6; $i++){
                    if(file_exists("../Students_connect_hidden/postuploads/".$medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postedimages' style='background-image: url(\"../../../students_connect_hidden/postuploads/".$medu['id']."(".$i.").png\");
                      height: 80px;
                      width: 80px; 
                      background-repeat: no-repeat;
                      background-size: 100%; cursor: pointer; vertical-align: middle;
                      background-position: 50% 50%;'></div>";
                }
                    else {
                      echo "";                     }
                  }
                  echo '</div>
                  <div class="posted">'.date("h:i a", $medu['timeofupdate']).'</div>';
                  echo '
                  <div class="pwl"> ';

}
else {
  header('Location: /students_connect/profile.php');
  exit();
}
}
echo '</div></div>';
echo '<div id="ldng"></div>';
if(isset($_POST['user']) && isset($_POST['post']) && isset($_POST['postid'])){
  $user = $_POST['user'];
  $id = $_POST['postid'];
  $adb = mysqli_fetch_assoc(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
  if($adb['user'] == $user){
  $post = sanitizeString($_POST['post']);
  queryMysql("UPDATE eduposts SET pstcont='$post' WHERE user='$user' AND id='$id'");
}
else {
  header('Location: /students_connect/profile.php');
  exit();
}
}
?>