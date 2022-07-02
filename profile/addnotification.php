<?php
define("great", "/Users/wilay/students_connect/");
require_once great."connect.php";
    if(isset($_GET['i']) && isset($_GET['1'])){
        $i = $_GET['i'];
        $user = $_SESSION['user'];
        $chifus = queryMysql("SELECT * FROM notifications WHERE user='$user' AND postid='$i'");
        if($chifus->num_rows > 0){
        // pass
        }
        else {
        $chus = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$i'")); 
        $id = 0;
        $usertobenotified = $chus['user'];
        $user = $_SESSION['user'];
        $notlink = 0;
        $hidenot = 0;
        $timeofnot = time();
        if($usertobenotified != $user){
        $notheading = '<b>Your  Post Was Reacted to by @'.$user.'</b>';
        $notcontent = '@'. $user. ' reacted to your post... Click to view post';
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')"); 
}
    else {
        $notheading = '<b>You Reacted to your post</b>';
        $notcontent = 'Click to view the post you reacted to...';
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified', '$i', '$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')");
}
}
    }
if(isset($_POST['cmtedupst'])){
    $i = (int) $_POST['postid'];
    $chus = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$i'"));
    $tpc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE user='$user' AND id='$postid'"));
    $id = 0;
    $usertobenotified = $chus['user'];
    $user= $_SESSION['user'];
    $notlink = 0;
    $hidenot = 0;
    $timeofnot = time();
    if($usertobenotified != $user){
        $notheading = '<b>@'.$user.' commented on your post.</b>';
        $cmt = "Content of comment <i class=\'fas fa-arrow-right\'></i> ".sanitizeString($_POST['cmtedupst']);
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified', '$i', '$notheading', '$cmt', '$hidenot', '$notlink', '0', '$timeofnot')");
    }

}
?>