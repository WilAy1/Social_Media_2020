<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= $row['user'];
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
    $eeex = mysqli_num_rows($mecc);
    $error = '';
    if(isset($_POST['dect'])){
      $ispass = sanitizeString($_POST['delpass']);
      $reason = sanitizeString($_POST['delreason']);
      $ol = queryMysql("SELECT * FROM members WHERE user='$user'");
      if($ol->num_rows){
        $l = mysqli_fetch_array($ol);
        if($l['pass']===$ispass){
          $id = 0;
          $time = time();
          $ma = queryMysql("SELECT * FROM deactivated WHERE user='$user'");
          if($ma->num_rows == 0){
          queryMysql("INSERT INTO deactivated VALUES('$id', '".$row['user']."', '1', '$time')"); 
          queryMysql("UPDATE members SET active='3' WHERE user='$user'");
          echo "<script>window.location.href='/students_connect/logout.php'</script>";
          }
        }
        else {
          $error = 'Incorrect Password';
          $play= 'display: block';
        }
      }
    }
    else {
      $play = 'display: none';
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
    if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    $mco = strtoupper($row['country']);
    echo <<<_END
      </ul>   
   
  </div>
  <div class='pycl'>
  <div onload="document.getElementsById('darkmd').style.minHeight = window.innerHeight 'px'" class="dark-mode" id='darkmd' style="">
  _END;
  if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    $mmg = '/students_connect/user.png';
  }
  else{
    $mmg = "/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png";
    }
  echo "
  <div class='clx_oklso'>
  <div class='clk_kmin'>
  <div class='clk_stfcon'>
  <div class='sw_llo'>
    <div class='sw_pic' style='background-image: url(\"".$mmg."\")'></div>
    <div class='sw_othn'>
    <a href='/students_connect/user/".$row['user']."'>
    <div class='sw_nam'>".$row['firstname']." ".$row['surname']."</div>
    <div class='sw_usr'><i class='fas fa-at'></i>".$row['user']."</div>
    </a></div>
    <div class='sw_saylogged'><i class='fas fa-circle' style='color: green; font-size: 8px; 
    padding-right: 3px;'></i>Logged In</div>
    </div>
  <div class='clk_fdis'>
  <div class='clk_fdis_dctv'>
  <div class='clk_oabt'>
  <div class='clk_drck'>Deactivate Account</div>
  <div class='clk_warnx'>
  <ul class='clk_warn'>
  <li>Account would take 15 days to be completely deleted</li>
  <li>You wouldn't be able to access this account with this period</li>
  <li>Profile and posts wouldn't be available to other other users</li>
  </ul>
  </div>
  </div>
  <div class='clk_d_actbtn'>Deactivate</div></div>
  </div>
  <div class='dect_form' style='".$play."'>
  <form action='' method='POST' class='dect_smetn'>
  <div class='dect_xfm'>
  <div class='dect_xfmst'>Deactivate Account</div>
  <div class='error' style='margin-left: 5%'>".$error."</div>
  <div class='dect_xfmin'><input type='password' name='delpass' placeholder='password*' class='dect_inp'/></div>
  <div class='dect_xfmrea'><input class='dect_fill_r' placeholder='reason' name='delreason'></div>
  <div class='dect_xfmch'><input type='checkbox' class='dect_check' style='height: 15px' required name='comp'/><span class='dect_deci'>I have decided to deactivate my account</span></div>
  <div class='dect_xfmsb'><button type='submit' class='dect_fsb' name='dect'>Deactivate</button></div>
  </div>
  </form>
  </div>
  </div>
  </div>
  </div>";

echo "</div></div>
<script>
document.getElementsByClassName('clk_d_actbtn')[0].onclick = function(){
    document.getElementsByClassName('dect_form')[0].style.display = 'block';
}
window.onclick = function(e){
if(e.target.className == document.getElementsByClassName('dect_form')[0].className){
document.getElementsByClassName('dect_form')[0].style.display = 'none';
}
}
</script>
";
?>