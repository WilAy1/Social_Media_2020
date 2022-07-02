<?php
require_once "/Users/wilay/students_connect/connect.php";
$ox = FALSE;
if(!isset($_SESSION['user'])){
    session_start();
    $ox = TRUE;
}
if(isset($_GET['d']) && isset($_GET['t']) && $ox){
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    $d = sanitizeString($_GET['d']);
    $t = sanitizeString($_GET['t']);
    if($t == '0'){
        $rt = 'eduposts';
    }
    elseif($t == '1') {
        $rt = 'socposts';
    }
    else {
        $rt = '';
    }
    $mx = mysqli_fetch_array(queryMysql("SELECT * FROM $rt WHERE id='$d'"));
    $ru = $mx['user'];
    $qe = $row['user'];
    $id = 0;
    $tt = time();
    $ox = queryMysql("SELECT * FROM recommendations WHERE user='$qe' AND rd='$ru'");
    if($ox->num_rows==0){
        queryMysql("INSERT INTO recommendations VALUES ('$id', '$qe', '$ru', '$tt')");
    }
}
if(isset($_GET['r'])&&isset($_GET['t'])&&$ox){
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    $d = sanitizeString($_GET['r']);
    $t = sanitizeString($_GET['t']);
    if($t == '0'){
        $rt = 'eduposts';
    }
    elseif($t == '1') {
        $rt = 'socposts';
    }
    else {
        $rt = '';
    }
    $mx = mysqli_fetch_array(queryMysql("SELECT * FROM $rt WHERE id='$d'"));
    $ru = $mx['user'];
    $qe = $row['user'];
    $id = 0;
    $tt = time();
    queryMysql("DELETE FROM recommendations WHERE user='$qe' AND rd='$ru'");
}
?>