<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $row['user'];
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
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
  _END;
  if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    $mmg = '/students_connect/user.png';
  }
  else{
    $mmg = "/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png";
    }
    echo "
    <div class='sw_poer'>
    <div class='sw_loxx'>
    <div class='sw_qlo'>Switch Account</div>
    <div class='sw_ppo'>
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
    <div class='sw_soth'>Other Accounts</div>
    <div class='sw_othbd'>";
    $done = [];
    if(isset($_COOKIE['t'])){
      $x = $_COOKIE['t'];
      $e = json_decode($x);
      if(is_object($e)){
        $e = (array) $e;
        }
        $e = array_values($e);
      for($i = 0; $i < count($e); $i++){
        $gh = $e[$i][1];
        if($gh != $row['user']){
        $exz = (queryMysql("SELECT * FROM members WHERE user='$gh'"));
        $mxz = mysqli_fetch_array($exz); 
        if($exz->num_rows && (array_search($mxz['user'], $done) == '')){
          array_push($done, $mxz['user']);
          if(!file_exists("../../students_connect_hidden/users_profile_upload/".$mxz['user'].'/'.$mxz['user'].".png")){
          $mmg = '/students_connect/user.png';
        }
        else{
          $mmg = "/students_connect_hidden/users_profile_upload/".$mxz['user'].'/'.$mxz['user'].".png";
          }
          $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$mxz['user']."' AND hasread=0");
          $cntnm = mysqli_num_rows($cnt);
          $cntnm = $cntnm > 99 ? '99+' : $cntnm;
          $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$mxz['user']."' AND readalready='0'");
          $eeex = mysqli_num_rows($mecc);
          $eeex = $eeex > 99 ? '99+' : $eeex;  
        echo "
        <div class='sw_pcov'>
        <div class='sw_polx'>
        <div class='sw_qw' style='background-image: url(\"".$mmg."\")'></div>
        <div class='sw_lpnm'>
        <div class='sw_fnm'>".$mxz['firstname']." ".$mxz['surname']."</div>
        <div class='sw_usrnm'><i class='fas fa-at'></i>".$mxz['user']."</div>
        </div>
        </div>
        <div class='sw_flo_ops'>
        <span class='sw_fl_mg'>
        ".$cntnm." Message(s) | ".$eeex." Notification(s)
        </span>
        </div>
        <div class='sw_flo_rm'>
        <form action='/students_connect/logout.php' method='POST'>
        <input type='hidden' name='anul'>
        <button class='sw_fl_rmv' type='submit' value='".enc($mxz['user'])."' name='sw'>Switch Account</button>
        </form>
        <form action='' method='POST'>
        <button class='sw_fl_rmv' value='".enc($mxz['user'])."' name='rm'>Remove Account</button>
        </form>
        </div>
        </div>
    ";
        }
        }
      }    
    }
    echo "</div>
    <div class='sw_adac'>
    <div class='sw_dxal'>
    <form action='/students_connect/logout.php' method='POST'>
    <button type='submit' class='sw_bigex'>Add Account</button>
    <input type='hidden' name='anul'>
    <input type='hidden' name='utm' value='/students_connect/ac_manage'>
    </form>
    </div>
    </div>
    </div></div></div>";
  echo '</div></div>';
?>