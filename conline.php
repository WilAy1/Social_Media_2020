<?php
session_start();
require_once "connect.php";
    if(isset($_SESSION['user'])){
    $time = time();
    $urs = $_SESSION['user'];
    $efks = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$urs."'"));
    $user = $efks['user'];
    queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$user'");
    }
?>