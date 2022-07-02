<?php
    require_once "/Users/wilay/students_connect/connect.php";
    session_start();
    if(isset($_SESSION['user']) && isset($_GET['t'])){
        $c = sanitizeString($_GET['t']);
        $r = queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'");
        $user = $r['user'];
        queryMysql("UPDATE members SET country='$c' WHERE user='$user'");
    }

?>