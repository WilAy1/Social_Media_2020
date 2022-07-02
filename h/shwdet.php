<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_SESSION['user']) && isset($_POST['l'])){
        $l = sanitizeString($_POST['l']);
        $who = explode("/", $l);
        $xw = $who[count($who) - 1];
        $ft = queryMYsql("SELECT * FROM members WHERE user='$xw'");
        if($ft->num_rows){
            $qgu = mysqli_fetch_array($ft);
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png")){
                $umld = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png";
              }
              else {
                $umld = '/students_connect/user.png';
              }
              if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png")){
                $ucov = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png";
                $ywi = "<img src='".$ucov."' class='wilfad_cv_img'/>";
              }
              else {
                $ywi = '';
                $ucov = '';
              }
              echo "<div class='wilfad_sp'>
              <div class='wilfad_spfus'>
              <div class='wilfad_cont'>
              <div class='wilfad_mg'>
              <div class='wilfad_yaj'>
              <div class='wilfad_cv' style='background-image: url(\"".$ucov."\")'></div>
              ".$ywi."
              </div>
              <div class='wilfad_gam'>
              <div class='wilfad_dp' style='background-image: url(\"".$umld."\");'></div>
              <img src='".$umld."' class='wilfad_dp_img'/>
              </div></div>
              <div class='wilfad_info'>
              <div class='wilfad_name'>
              <a href='/students_connect/user/".$qgu['user']."'>
              <div class='wilfad_fname'>".$qgu['firstname']." ".$qgu['surname']."</div>
              <div class='wilfad_uname'><i class='fas fa-at'>".$qgu['user']."</i></div>
              </a></div>
              <div class='wilfad_abt'>".$qgu['about']."</div>
              </div>
              <div class='wilfad_btns'><button class=''>Follow</button></div>
              </div>
              </div>
              </div>";
        }
        else {
            echo "<div class='f_err'>User Doesn't exist</div>";
        }
    }
?>