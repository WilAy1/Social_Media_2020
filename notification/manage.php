<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['oo']) && isset($_SESSION['user'])){
        $r = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $ear = explode(",",$_POST['oo'][0]);
        for($i =0; $i < count($ear); $i++){
            $ei = $ear[$i];
            $oed = mysqli_fetch_array(queryMysql("SELECT * FROM notifications WHERE id='".$ei."'"));
            if($oed['usertobenotified'] == $r['user']){
                queryMysql("DELETE FROM notifications WHERE id='".$ei."' AND usertobenotified='".$r['user']."'");
            }
        }
    }
    elseif(isset($_POST['ei'])){
        queryMysql("UPDATE notifications SET readalready='1' WHERE id='".$_POST['ei']."'");
    }
    elseif(isset($_POST['mrd'])){
        $r = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $ear = explode(",",$_POST['mrd'][0]);
        for($i =0; $i < count($ear); $i++){
            $ei = $ear[$i];
            $oed = mysqli_fetch_array(queryMysql("SELECT * FROM notifications WHERE id='".$_POST['mrd'][$i]."'"));
            if($oed['usertobenotified'] == $r['user']){
                queryMysql("UPDATE notifications SET readalredy='1' WHERE id='".$_POST['mrd'][$i]."'");
            }
        }    
    }
    else {
        echo 'Nothing on this page';
    }
?>