<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $aed = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        echo $aed['tun'];
    }
    if(isset($_GET['did'])){
        $id = $_GET['did'];
        $aed = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        echo $aed['tdn'];
    }
    if(isset($_GET['cid'])){
        $id = $_GET['cid'];
        $aed = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        echo $aed['pnc'];
    }
?>