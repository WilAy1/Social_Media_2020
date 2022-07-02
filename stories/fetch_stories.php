<?php
    if(!isset($_SESSION['user'])){
        session_start();
        
    }
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_SESSION['user']) && isset($_GET['w'])){
        $user = $_SESSION['user'];
        $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $row['user'];
        $f = sanitizeString($_GET['w']);
        $oxa = queryMysql("SELECT * FROM stories WHERE user = '$f'");
        $m = array();
        while($k = mysqli_fetch_array($oxa)){
            $sb = '';
            if($k['user'] == $user){
                $sb = $k['seen'];
            }
            array_push($m, array($k['id'], $k['caption'], $k['timeofupdate'], $sb));
        }
        echo json_encode($m);
    }
?>