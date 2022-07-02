<?php
require_once "/Users/wilay/students_connect/connect.php";
if(isset($_POST['creatinguser'])){
    $creatinguser = sanitizeString($_POST['creatinguser']);
    echo "<div class='startgrpup'>
    <div class='crtcrg'><i class='fas fa-users'></i> Create a Group</div>
    <div class='nmfngrp'>
    <div class='gn_la_b'>
    <label for='nmfngtp'>Group Name</label>
    </div>
    <div class='inong'>
    <input type='text' name='ngrp' id='nmfngtp' placeholder='Group Name'/></div></div>
    <div class='gd_la_b'>
    <label for='dscrpt'>Group Description</label>
    </div>
    <div class='ttex_t_fl'>
    <textarea rows='10'  id='dscrpt' placeholder='Group description'></textarea>
    </div>
    <div class='sltgrpmb' id='pdsmth'>";
        $fnds = queryMysql("SELECT * FROM followstatus WHERE user='$creatinguser' AND 
        type='following'");
            while($gfrnds = mysqli_fetch_assoc($fnds)){
            $fte = $gfrnds['friend'];
            $he = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$fte'"));
            echo "<div class='chthm'><input type='checkbox' name='nmbrs' id='nmbr'
             value='".$he['user']."' id='gfrnds'/>
             <label for='gfrnds'>".$he['firstname']." ".$he['surname']." (<i class='fas fa-at'></i>
             ".$he['user'].")</label></div>";
            }
    echo "</div>
    <div class='puopr'>
    <div class='frbot'>
    <input type='radio' value='0' onclick='fxvl()' name='type' id='pop1'><label for='public'>Public</label>
    <input type='radio' value='1' onclick='fxvl()' name='type' id='pop2'><label for='private'>Private</label>
    </div>
    <div class='grppass' id='grppass' style='display: none;'>
    <input type='text' id='dpass' placeholder='Password'/>
    </div>
    <div class='fnl'>
    <button class='o_go_nc_l' onclick='startprocess(\"$creatinguser\", 
    document.getElementById(\"nmfngtp\").value,
     document.getElementById(\"dscrpt\").value, 
     document.getElementById(\"dpass\").value)'>Create Group</button></div></div>
    </div>
    ";
    
    echo "</div>";
}
if(isset($_POST['creator']) && isset($_POST['nameofgroup']) && 
isset($_POST['members']) && isset($_POST['pop']) && isset($_POST['eachmember'])){
    $creator = sanitizeString($_POST['creator']);
    $nameofgroup = sanitizeString($_POST['nameofgroup']);
    $time= time();
    $type = sanitizeString($_POST['pop']);
    $number =  sanitizeString($_POST['members']) + 1;
    $id =  0;
    $grouplinkhash = md5(rand(0,1000));
    $grouppassword = sanitizeString($_POST['dpass']);
    $description = sanitizeString($_POST['description']);
    queryMysql("INSERT INTO selfgroups VALUES ('$id', '$creator', 
    '$nameofgroup', '$description', '$number', '$type', '$time', '$time', 
    '$grouplinkhash', '$grouppassword')");
    $mbrs = explode(",", $_POST['eachmember']);
    $gidft =  mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE creator='$creator' AND 
    nameofgroup='$nameofgroup' AND type='$type' AND timeofcreation='$time' 
    AND description='$description'"));
    $groupid  = $gidft['id'];
    queryMysql("INSERT INTO groupmembership VALUES ('$id', '$creator', 
        '1', '$groupid', '1', '$time', '$time')");
    for($i = 0; $i <count($mbrs); $i++){
        queryMysql("INSERT INTO groupmembership VALUES ('$id', '$mbrs[$i]', 
        '1', '$groupid', '0', '$time', '$time')");
    }
    $msg = $creator.' started a group';
    queryMysql("INSERT INTO groupmessages values ('$id', 'sp', '$groupid', '$msg',
         '$time', '0', '0', '0')");
    echo "<input type='hidden' value='".$groupid."' id='mgrpid'>";
}
?>