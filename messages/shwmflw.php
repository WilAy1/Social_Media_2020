<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['name'])){
        $user = $_POST['name'];
        $time= time();
        queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$user'");
    echo "<div class='fbdy'>
    <div class='upflw'>
    <div class='bckar1' title='Go Back' onclick='javascript:location.reload(true)'><i class='fas fa-arrow-left'></i></div>
    <div class='crtgrp' title='Create Group' onclick='crGrp(\"".$user."\");'>
    <i class='fas fa-users smpls'></i> Create Group</div>
    <div class='schfwrs srchmg mleey'>
    <input type='text' class=' loosae' placeholder='Search Friends' id='srcmgtb' onkeyup='searchFriends(\"$user\", this.value)'/>
    </div>
    </div>
    <div class='mflist' id='uubtwk'>";
    $lst = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
    if($lst->num_rows == 0){
        echo "<div class='ynfao'>You are not following anyone</div>";
    }
    else {
    while($glst = mysqli_fetch_assoc($lst)){
        $frnds = $glst['friend'];
        $fnms = queryMysql("SELECT * FROM members WHERE user='$frnds' ORDER BY firstname");
        while($gfnms = mysqli_fetch_assoc($fnms)){
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$gfnms['user'].'/'.$gfnms['user'].".png")){ 
                $mfimg = '../../../../../students_connect_hidden/users_profile_upload/'.$gfnms['user'].'/'.$gfnms['user'].'.png';
                }
                else {
                    $mfimg =  '../user.png';
                }
                $exf = queryMysql("SELECT * FROM messages WHERE sender='$user' AND receiver='$frnds' OR receiver='$user' AND sender='$frnds' ORDER BY timeofmessage DESC");
            if($exf->num_rows){
                $mff = mysqli_fetch_array($exf);
                $mtim = $mff['timeofmessage'];
            }
            else {
                $mtim = 0;  
            }
                echo "<div class='flaf' onclick='openfMsg(\"$user\", \"$frnds\", \"".$mtim."\")'>
            <div class='mfsimg' style='
            background-image: url(\"$mfimg\");
            '></div>
            <div class='mfnms'>"
            .$gfnms['firstname']." ".$gfnms['surname']."
            </div></div>";        
        }
    }  
    echo "</div>
    <div class='srchresult' id='srchresult'></div>
    </div>";
    }
}
?>