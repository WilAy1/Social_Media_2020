<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['user']) && isset($_POST['groupid']) && !isset($_POST['pr'])){
        $id = 0;
        $user = sanitizeString($_POST['user']);
        $groupid =  $_POST['groupid'];
        $time = time();
        queryMysql("INSERT INTO groupmembership VALUES ('$id', '$user', 
        '1', '$groupid',0, '$time', '$time')");
        $cde = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='$groupid'"));
        $nnmb = (int) $cde['numberofmembers'] + 1;
        queryMysql("UPDATE selfgroups SET numberofmembers='$nnmb' WHERE id='$groupid'"); 
}
if(isset($_POST['user']) && isset($_POST['groupid']) && isset($_POST['pr'])){
    $id = 0;
    $user = sanitizeString($_POST['user']);
    $groupid =  $_POST['groupid'];
    $time = time();
    queryMysql("INSERT INTO groupmembership VALUES ('$id', '$user', 
    '2', '$groupid',0, '$time', '$time')");
    /*$cde = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='$groupid'"));
    $nnmb = (int) $cde['numberofmembers'] +1;
    queryMysql("UPDATE selfgroups SET numberofmembers='$nnmb' WHERE id='$groupid'"); */
}
if(isset($_POST['m'])){
    $id = sanitizeString($_POST['m']);
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $row['user'];
        $l = mysqli_fetch_array(queryMysql("SELECT * FROM groupmembership WHERE user='$user'"));
        if($l['isadmin'] == '1'){
            queryMysql("UPDATE groupmembership SET membership='1' WHERE id='$id'");
           $lx = mysqli_fetch_array(queryMysql("SELECT * FROM groupmembership WHERE id='$id'"));
           $ma = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='".$lx['groupid']."'"));
           $ng = sanitizeString($ma['nameofgroup']);
           $t = time();
           $link = '/students_connect/messages/?group='.$ma['grouplinkhash'];
            queryMysql("INSERT INTO notifications VALUES('0', '$user', '".$lx['user']."', '0', '$ng Invitation Request Accepted', 'Click to open group','0', '$link', '0', '$t')");
        }
    }
}
if(isset($_POST['q'])){
    $id = sanitizeString($_POST['q']);
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $row['user'];
        $l = mysqli_fetch_array(queryMysql("SELECT * FROM groupmembership WHERE user='$user'"));
        if($l['isadmin'] == '1'){
            $o = queryMysql("DELETE FROM groupmembership WHERE id='$id'");
        }
    }
}
?>