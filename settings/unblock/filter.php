<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    if(isset($_POST['bb'])){
        $rtt = $_POST['bb'];
    $ma = queryMysql("SELECT * FROM blocked WHERE user='$user' AND touser LIKE '%$rtt%'");
    while($gm = mysqli_fetch_array($ma)){
  $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gm['touser']."'"));
  if(file_exists("../../../students_connect_hidden/users_profile_upload/".$gm['touser'].'/'.$gm['touser'].'.png')){
    $eoll = "/students_connect_hidden/users_profile_upload/".$mlkk['user'].'/'.$mlkk['user'].".png";
  }
  else {
    $eoll = "/students_connect/user.png";
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
            <input type='hidden' name='user' value='".$mlkk['user']."'>
            <button class='bl_xoop'>Unblock</button></div>
            </div>
    </div>
    </div>
    "; 
}
    }
    if(isset($_POST['fr'])){
        $fr = sanitizeString($_POST['fr']);
        $mk = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend LIKE '%$fr%'");
while($gr = mysqli_fetch_array($mk)){
  $mlkk = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gr['friend']."'"));
    $mell = getcwd();
    chdir("../../../students_connect_hidden/users_profile_upload/".$mlkk['user'].'/');
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
            <input type='hidden' value='".$mlkk['user']."'>
            <input type='hidden' value='".$row['user']."'>
            <button class='bl_xoop'>Block</button></div>
            </div>
    </div>
    </div>";
}
    }
?>