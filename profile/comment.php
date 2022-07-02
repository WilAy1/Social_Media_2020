<?php
define("opp", "/Users/wilay/students_connect/");
require_once opp."connect.php";
    if(isset($_POST['cmtedupst'])){
        $cmt = sanitizeString($_POST['cmtedupst']);
        $user = $_SESSION['user'];
        $id = 0;
        $postid = $_POST['postid'];
        $toc = time();
        $tnc = 0;
        $tun = 0; 
        $tdn = 0;
        $educh = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));
        $pnc = (int) ++$educh['pnc'];
        
        queryMysql("INSERT INTO educomments VALUES('$user', '$id', '$postid','$cmt', '$toc',
        '$tnc', '$tun', '$tdn')");
        queryMysql("UPDATE eduposts SET pnc='$pnc' WHERE id='$postid'");    
    }
?>