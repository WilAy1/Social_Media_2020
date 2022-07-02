<?php
require_once "/Users/wilay/students_connect/connect.php";
if(isset($_GET['n'])){
    echo "<style>
    .flwstr:hover .details {
        visibility: visible;
    }
    .flwstr {
        position: relative;
        display: inline-block;
        color: inherit;
    }
    
    .flwstr .details {
        visibility: hidden;
        width: 100%;
        color: #fff;
        float: right;
        border-radius: 6px;
        padding: 5px 0;
        padding-left: 110px;
        background-color: black;
        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        height: 100px;
    }
    .flwstr .details::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 100%;
        margin-top: -10px;
        border-width: 10px;
        border-style: solid;
        border-color: transparent black transparent transparent;
    }
    .flwstr {
        padding-top: 20px;
    }
    .flwstr a {
        text-decoration: none;
        color: inherit;
    }
</style>";
    $ur = $_GET['n'];
    $su = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ur'"));
    $user = $su['user'];
    $flw = queryMysql("SELECT * FROM followstatus WHERE friend='$user'");
    if(mysqli_num_rows($flw) == 1){
        $follower = "follower";
        global $follower;
    }
    else{
    $follower = "followers";
        global $follower;
    }
        echo "<div class='shmyflw'>
    <div class='nmff'>".mysqli_num_rows($flw)." $follower. </div>";
    while ($getflw = mysqli_fetch_array($flw)) {
        $friendname = $getflw['user'];
        $getfullpr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$friendname'"));
        $getnedu = queryMysql("SELECT * FROM eduposts WHERE user='$friendname'");
        $getnsoc = queryMysql("SELECT * FROM socposts WHERE user='$friendname'");
        if(mysqli_num_rows($getnedu) == 0){
            $eds = "No Educational Post";
            global $eds;
        }
        else {
            $eds = mysqli_num_rows($getnedu)." Educational post(s)";
            global $eds;
        }
        if(mysqli_num_rows($getnsoc) == 0){
            $soc = "No Social Post";
            global $soc;
        }
        else {
            $soc = mysqli_num_rows($getnsoc)." Social Post(s)";
            global $soc;
        }
        $name = $getfullpr['user'];
        $button1  = "<div class='flwb waf'><button type='button' class='albt' onclick='unFollow(\"".$user."\", \"".$name."\")'>Unfollow</button></div>";
        $button2 = "<div class='vprf waf'><a href='
        /students_connect/profile.php?u=".$getfullpr['userprofilecode']."'><button class='albt'>View Profile</button></a></div>";
        $button3 = "<div class='sndmg waf'><button type='submit' class='albt'>Send Message</button></div>";
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$getflw['user'].'/'.$getflw['user'].".png")){
            $img = "../../../../../students_connect_hidden/users_profile_upload/".$getflw['user'].'/'.$getflw['user'].".png";
            global $img;
        }
        else {
            $img = "../../students_connect/user.png";
            global $img;
        }
        echo "
        
        <div class='flwstr'><a href='/students_connect/profile.php?u=".$getfullpr['userprofilecode']."
        '>".$getfullpr['firstname']."
         ".$getfullpr['surname']." (<i class='fas fa-at'></i>".$getfullpr['user'].")</a>
          <span class='details' style='background-image: url($img); background-repeat: no-repeat;
         background-position: left top; background-size: contain;'>".$getfullpr['surname']." ".$getfullpr['firstname']."<br/>
         <i class='fas fa-at'></i>".$getfullpr['user']."<br/>
".$eds."<br/>
".$soc."<br/>Click on link to view profile</span>
         </div><div class='flwr'></div>
        <div class='dntshw' style='display: none;'></div>
        <div class='tbt'>$button1 $button2 $button3</div></div>";
    }
}
if(isset($_GET['nm'])){
    $user = $_GET['nm'];
    $flw = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
    if(mysqli_num_rows($flw) == 1){
        $follower = "following";
        global $follower;
    }
    else{
    $follower = "following";
        global $follower;
    }
        echo "<div class='shmyflw'>
    <div class='nmff'>".mysqli_num_rows($flw)." $follower. </div>";
    while ($getflw = mysqli_fetch_array($flw)) {
        $friendname = $getflw['friend'];
        $getfullpr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$friendname'"));
        $getnedu = queryMysql("SELECT * FROM eduposts WHERE user='$friendname'");
        $getnsoc = queryMysql("SELECT * FROM socposts WHERE user='$friendname'");
        if(mysqli_num_rows($getnedu) == 0){
            $eds = "No Educational Post";
            global $eds;
        }
        else {
            $eds = mysqli_num_rows($getnedu)." Educational post(s)";
            global $eds;
        }
        if(mysqli_num_rows($getnsoc) == 0){
            $soc = "No Social Post";
            global $soc;
        }
        else {
            $soc = mysqli_num_rows($getnsoc)." Social Post(s)";
            global $soc;
        }
        
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$getflw['friend'].'/'.$getflw['friend'].".png")){
            $img = "../../../../../students_connect_hidden/users_profile_upload/".$getflw['friend'].'/'.$getflw['friend'].".png";
            global $img;
        }
        else {
            $img = "../../students_connect/user.png";
            global $img;
        }
        echo "
        <style>
            .flwstr:hover .details {
                visibility: visible;
            }
            .flwstr {
                position: relative;
                display: inline-block;
                color: inherit;
            }
            
            .flwstr .details {
                visibility: hidden;
                width: 100%;
                color: #fff;
                float: right;
                border-radius: 6px;
                padding: 5px 0;
                padding-left: 110px;
                background-color: black;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
                height: 100px;
            }
            .flwstr .details::after {
                content: '';
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -10px;
                border-width: 10px;
                border-style: solid;
                border-color: transparent black transparent transparent;
            }
            .flwstr {
                padding-top: 20px;
            }
            .flwstr a {
                text-decoration: none;
                color: inherit;
            }
        </style>
        <div class='flwstr'><a href='/students_connect/profile.php?u=".$getfullpr['userprofilecode']."
        '>".$getfullpr['firstname']."
         ".$getfullpr['surname']." (<i class='fas fa-at'></i>".$getfullpr['user'].")</a>
          <span class='details' style='background-image: url($img); background-repeat: no-repeat;
         background-position: left top; background-size: contain;'>".$getfullpr['surname']." ".$getfullpr['firstname']."<br/>
         <i class='fas fa-at'></i>".$getfullpr['user']."<br/>
".$eds."<br/>
".$soc."<br/>Click on link to view profile</span>
         </div><div class='flwr'></div>
        <div class='dntshw' style='display: none;'></div>
         </div>";
    }
}
if(isset($_GET['nmm'])){
    $user = $_GET['nmm'];
    $flw = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
    if(mysqli_num_rows($flw) == 1){
        $follower = "following";
        global $follower;
    }
    else{
    $follower = "following";
        global $follower;
    }
        echo "<div class='shmyflw'>
    <div class='nmff'>".mysqli_num_rows($flw)." $follower. </div>";
    while ($getflw = mysqli_fetch_array($flw)) {
        $friendname = $getflw['friend'];
        $getfullpr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$friendname'"));
        $getnedu = queryMysql("SELECT * FROM eduposts WHERE user='$friendname'");
        $getnsoc = queryMysql("SELECT * FROM socposts WHERE user='$friendname'");
        if(mysqli_num_rows($getnedu) == 0){
            $eds = "No Educational Post";
            global $eds;
        }
        else {
            $eds = mysqli_num_rows($getnedu)." Educational post(s)";
            global $eds;
        }
        if(mysqli_num_rows($getnsoc) == 0){
            $soc = "No Social Post";
            global $soc;
        }
        else {
            $soc = mysqli_num_rows($getnsoc)." Social Post(s)";
            global $soc;
        }
        
        if(file_exists("../../students_connect_hidden/users_profile_upload/".$getflw['friend'].'/'.$getflw['friend'].".png")){
            $img = "../../../../../students_connect_hidden/users_profile_upload/".$getflw['friend'].'/'.$getflw['friend'].".png";
            global $img;
        }
        else {
            $img = "../../students_connect/user.png";
            global $img;
        }
        echo "
        <style>
            .flwstr:hover .details {
                visibility: visible;
            }
            .flwstr {
                position: relative;
                display: inline-block;
                color: inherit;
            }
            
            .flwstr .details {
                visibility: hidden;
                width: 100%;
                color: #fff;
                float: right;
                border-radius: 6px;
                padding: 5px 0;
                padding-left: 110px;
                background-color: black;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
                height: 100px;
            }
            .flwstr .details::after {
                content: '';
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -10px;
                border-width: 10px;
                border-style: solid;
                border-color: transparent black transparent transparent;
            }
            .flwstr {
                padding-top: 20px;
            }
            .flwstr a {
                text-decoration: none;
                color: inherit;
            }
        </style>
        <div class='flwstr'><a href='/students_connect/profile.php?u=".$getfullpr['userprofilecode']."
        '>".$getfullpr['firstname']."
         ".$getfullpr['surname']." (<i class='fas fa-at'></i>".$getfullpr['user'].")</a>
          <span class='details' style='background-image: url($img); background-repeat: no-repeat;
         background-position: left top; background-size: contain;'>".$getfullpr['surname']." ".$getfullpr['firstname']."<br/>
         <i class='fas fa-at'></i>".$getfullpr['user']."<br/>
".$eds."<br/>
".$soc."<br/>Click on link to view profile</span>
         </div><div class='flwr'></div>
        <div class='dntshw' style='display: none;'></div>
         </div>";
    }
}
?>