<?php
    require_once "/Users/wilay/students_connect/connect.php";
    session_start();
    if(isset($_POST['p'])){
        $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $user = $row['user'];
        $val = sanitizeString($_POST['p']);
        if(isset($_POST['prec'])){
            $valx = 'rcountrypost';
            $val = (int) $val;
        }
        elseif(isset($_POST['urec'])){
            $valx = 'rcountryuser';
            $val = (int) $val;
        }
        elseif(isset($_POST['intr'])){
            $valx = 'rinterest';
            $val = (int) $val;
        }
        elseif(isset($_POST['notf'])){
            $valx = 'notifications';
        }
        elseif(isset($_POST['sved'])){
            $valx = 'dsaved';
        }
        else {
            $valx = sanitizeString($_POST['what']);
        }
        echo $val;
        queryMysql("UPDATE settings SET ".$valx."='".$val."' WHERE user='$user'");
    }
?>