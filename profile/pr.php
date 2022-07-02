<?php
require_once "/Users/wilay/students_connect/connect.php";
$ox = FALSE;
if(!isset($_SESSION['user'])){
    session_start();
    $ox = TRUE;
}
if(isset($_GET['x'])){
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    $user = $row['user'];
    $e = sanitizeString($_GET['x']);
    $ko = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user = '$user'"));
    $int = $ko['interests'];
    $oak = explode(',',$int);
    if(!in_array($e, $oak)){
    if($int == '0'){
        queryMysql("UPDATE members SET interests = '$e' WHERE user='$user'");
    }
    else {
        $int.=','.$e;
        queryMysql("UPDATE members SET interests = '$int' WHERE user='$user'");
    }
}
}
?>