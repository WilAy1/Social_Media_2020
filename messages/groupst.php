<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['idfg']) && isset($_POST['chuser']) && isset($_POST['ngn'])){
        $id  = $_POST['idfg'];
        $nname = sanitizeString($_POST['ngn']);
        $aid = 0;
        $time = time();
        $msg = $_POST['chuser']." changed the group name.";
        queryMysql("UPDATE selfgroups SET nameofgroup = '$nname' WHERE id='$id'");
        queryMysql("INSERT INTO groupmessages values ('$aid', 'sp', '$id', '$msg',
         '$time', '0', '0', '0')");
         $dbb = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='$id'"));
        echo $dbb['nameofgroup'];
        }
if(isset($_POST['idd']) && isset($_POST['duser']) && isset($_POST['ngd'])){
    $id  = $_POST['idd'];
    $ngd = sanitizeString($_POST['ngd']);
    $aid = 0;
    $time = time();
    if(!empty($_POST['ngd'])){
    $msg = $_POST['duser']." changed the group description.";
    }
    else {
        $msg = $_POST['duser']." removed the group description.";
    }
    queryMysql("UPDATE selfgroups SET description = '$ngd' WHERE id='$id'");
    queryMysql("INSERT INTO groupmessages values ('$aid', 'sp', '$id', '$msg',
     '$time', '0', '0', '0')");
     $dbb = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='$id'"));
    }
    if(isset($_POST['admin']) && isset($_POST['grpid'])){
        $grpid = $_POST['grpid'];
        $dm = queryMysql("SELECT * FROM groupmembership WHERE isadmin='1' and groupid='$grpid'");
        echo "<div class='galst'><div class='atmn' title='Add Admin' 
        style='padding-left: 6px; cursor: pointer;' onclick='mgMbs(\"$grpid\")'>
        Add Admin <i class='fas fa-plus'style='padding-left: 30px;'></i></div>";
        while($gdm = mysqli_fetch_assoc($dm)){
            if($gdm['user'] == $_POST['admin']){
                $mins = 'You';
            }
            else {
                $mins = "<i class='fas fa-at'></i> ".$gdm['user'];
            }
            echo "<div class='eads' id='aalst$grpid'>
           <div class='ntn' title='".$gdm['user']."'>$mins 
           <i class='fas fa-check-circle' style='font-size: 11px; color: blue;'></i></div></div>";
        }
        echo "</div><div id='sntb'></div></div>";
    }
    if(isset($_POST['mgrpid'])){
        $mgrpid=  $_POST['mgrpid'];
        echo '<div class="ndm" style="padding: 10px;">
        <div class="cnnm" style="font-size: 13px;">Choose New Admins</div>
        <div class="mxc" style="padding-left: 14px;">';
        $nm = queryMysql("SELECT * FROM groupmembership WHERE groupid='$mgrpid' AND isadmin='0' ORDER BY user ASC");
        if($nm->num_rows){
            $ol = "<div class='ole' style='display: flex; float: right;'>
            <div class='ata bn' title='Add to Admin'><i class='fas fa-user-plus'></i></div>
            <div class='mg bn' title='Message'><i class='fas fa-envelope'></i></div>
            <div class='rmfg bn' title='Remove from Group'><i class='fas fa-minus-circle' style='color: red;'>
            </i></div></div>";
            while($gnm = mysqli_fetch_array($nm)){
            $nad  = $gnm['user'];
                echo "<div class='tba' title='$nad'
                 style='padding-top: 6px; border-bottom: 1px solid; width: 40%;'>
                <i class='fas fa-at'></i> $nad $ol</div>";
            }
        }
        else {
            echo "<div class='tba'>No member</div>";
        }
        echo '</div></div>';
    }
    if(isset($_POST['rid']) && isset($_POST['ruser'])){
        $rid = $_POST['rid'];
        $ruser = $_POST['ruser'];
        $glh = md5(rand(0, 1000));
        queryMysql("UPDATE selfgroups SET grouplinkhash='$glh' WHERE id='$rid'");
        echo $glh;
    }
?>