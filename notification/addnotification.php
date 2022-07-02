<?php
    if(isset($_GET['i']) && isset($_GET['1'])){
        $i = $_GET['i'];
        $user = $_SESSION['user'];
        $nu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $nu['user'];
        $chifus = queryMysql("SELECT * FROM notifications WHERE user='$user' AND postid='$i'");
        
        $chus = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$i'"));
        $id = 0;
        $usertobenotified = $chus['user'];
        $ur = $_SESSION['user'];
        $mfm = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ur'"));
        $user = $mfm['user'];
        $uprc = $mfm['userprofilecode'];
        $notlink = "/students_connect/posts/$i";
        $hidenot = 0;
        $timeofnot = time();
        $poo = queryMysql("SELECT *  FROM eduposts WHERE usertobenotified='$user' AND notlink='$notlink'");
        if($poo->num_rows == 0){
        if($usertobenotified != $user){
        $notheading = '<b>Your  Post Was Reacted to by @'.$user.'</b>';
        $notcontent = '@'. $user. ' reacted to your post... Click to view post';
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')"); 
    }
    /*else {
        $notheading = '<b>You Reacted to your post.</b>';
        $notcontent = 'Click to view the post you reacted to...';
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified', '$i', '$notheading', '$notcontent', '$hidenot', '$notlink', '0', '$timeofnot')");
}*/
        }
}
if(isset($_POST['id']) && isset($_POST['user']) && isset($_POST['l'])){
    $i = $_POST['id'];
    $user = $_SESSION['user'];
    $nu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $nu['user'];
    $chus = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$i'"));
    $oet = queryMysql("SELECT * FROM loves WHERE id='".$chus['id']."' AND user='".$user."'");
    if($oet->num_rows==0){
        $id = 0;
        $usertobenotified = $chus['user'];
        $ur = $_SESSION['user'];
        $mfm = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ur'"));
        $user = $mfm['user'];
        $uprc = $mfm['userprofilecode'];
        $notlink = "/students_connect/posts/s$i";
        $hidenot = 0;
        $timeofnot = time();
        $poo = queryMysql("SELECT *  FROM eduposts WHERE usertobenotified='$user' AND notlink='$notlink'");
        if($poo->num_rows == 0){
        if($usertobenotified != $user){
        $notheading = '<b><i class=\"fas fa-heart\" style=\"color: rgb(255, 136, 156);\"></i> @'.$user.' loved your post</b>';
        $notcontent = 'Click to view post';
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified','$i','$notheading', '$notcontent', '$hidenot', '$notlink', '0', '$timeofnot')"); 
    }
    }
}
}
if(isset($_POST['cmtedupst'])){
    $postid = $_POST['postid'];
    $usr= $_SESSION['user'];
    $mfm = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $user = $mfm['user'];
    $chus = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));
    $tpc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE user='$user' AND postid='$postid'"));
    $id = 0;
    $usertobenotified = $chus['user'];
    $upc = $mfm['userprofilecode'];
    $cflw = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$usertobenotified'");
    $x = $tpc['id']+1;
    $notlink = "/students_connect/posts/$postid#a$x";
    $hidenot = 0;
    $timeofnot = time();
    if($usertobenotified != $user){
        $notheading = sanitizeString('<b>'.$user.' commented on your post.</b>');
        $notcontent = sanitizeString($_POST['cmtedupst']);
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified', '$postid', '$notheading', '$notcontent', '$hidenot', '$notlink', '0','$timeofnot')");
}
}
if(isset($_POST['cmtreplyedupst'])){
    $postid = $_POST['postid'];
    $usr= $_SESSION['user'];
    $mfm = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $user = $mfm['user'];
    $cmtid = $_POST['cmtid'];
    $chus = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));
    $tpc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE user='$user' AND postid='$postid'"));
    $id = 0;
    $usertobenotified = $chus['user'];
    $upc = $mfm['userprofilecode'];
    $cflw = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$usertobenotified'");
    $x = $tpc['id']+1;
    $notlink = "/students_connect/posts/$postid#a$x";
    $hidenot = 0;
    $timeofnot = time();
    if($usertobenotified != $user){
        $notheading = '<b>@'.$user.' replied to a comment on your post.</b>';
        $notcontent = "Open reply of comment on post";
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified', '$postid', '$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')");
}
    // check owner of comment
    $goc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$cmtid' AND postid='$postid'"));
    $utbn = $goc['user'];
    if($utbn != $user){
        $notheading = '<b>@'.$user.' replied to your comment on a post.</b>';
        $notcontent = "Open reply to your comment on post";
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$utbn', '$postid', '$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')");
}
}
    
?>