<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['user']) && $_GET['nme']){
        $user = $_POST['user'];
        $noff = $_POST['nme'];
        $x = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND 
        friend='$noff'");
        if($x->num_rows){
            queryMysql("DELETE FROM followstatus WHERE user='$user' AND 
            friend='$noff'");
        }
        else {
            queryMysql("INSERT INTO followstatus VALUES('$user', 'Following', '$noff')");
        }
    }
    if(isset($_POST['fr'])){
        $usr = $_SESSION['user'];
        $ms = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $ms['user'];
        $fried = $_POST['fr'];
        $f = queryMysql("SELECT * FROM members WHERE user='$fried'");
        if($f->num_rows){
        $xf = mysqli_fetch_array($f);
        $friend = $xf['user'];
        $ve = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$friend'");
        if($ve->num_rows){
            queryMysql("DELETE FROM followstatus WHERE user='$user' AND friend='$friend'");
            echo "Follow";
        }
        else{
        $type = "Following";
        $time = time();
        queryMysql("INSERT INTO followstatus VALUES('$user', '$type', '$friend', '$time')");
        $notlink = '/students_connect/user/'.$user;
        $hidenot = 0;
        $timeofnot = time();
        $notheading = '<b>New Follower</b>';
        $notcontent = '<a href="/students_connect/user/'.$user.'">@'.$user.'</a> started following you.';
        $id = 0;
        $i = 0;
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$friend', '$i', '$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')");
        echo "Unfollow";
    }
    }
    else {
        echo "Follow";
    }
}
?>