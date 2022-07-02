<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['postid']) & isset($_POST['cmtid']) && isset($_POST['cmtreplyedupst']) && !empty($_POST['cmtreplyedupst'])){
        $cnt = sanitizeString($_POST['cmtreplyedupst']);
        $usr = $_SESSION['user'];
        $gusr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $gusr['user'];
        $id = 0;
        $postid = $_POST['postid'];
        $cmtid = $_POST['cmtid'];
        $timeofreply = time();
        $tnr = 0;
        $tun = 0;
        $tdn = 0;
        $educh = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));
        $pnc = (int) ++$educh['pnc'];
        $a = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$cmtid' AND postid='$postid'"));
        $tnc = (int) ++$a['tnc'];
        queryMysql("INSERT INTO replyeducomments VALUES('$user', 
        '$id', '$postid', '$cmtid', '$cnt', '$timeofreply', '$tnr', '$tun',
        '$tdn')");
        queryMysql("UPDATE educomments SET tnc='$tnc' WHERE postid='$postid' AND id='$cmtid'");
        queryMysql("UPDATE eduposts SET pnc='$pnc' WHERE id='$postid'");
    }
if(isset($_POST['postid']) && isset($_POST['cmtreplysocpst']) && !empty($_POST['cmtreplysocpst']) && !empty($_POST['cmtreplysocpst'])){
        $cnt = sanitizeString($_POST['cmtreplysocpst']);
        $usr = $_SESSION['user'];
        $gusr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $gusr['user'];
        $id = 0;
        $postid = $_POST['postid'];
        $cmtid = $_POST['cmtid'];
        $timeofreply = time();
        $tnr = 0;
        $tln = 0;
        $educh = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$postid'"));
        $pnc = (int) ++$educh['pnc'];
        $a = mysqli_fetch_array(queryMysql("SELECT * FROM soccomments WHERE id='$cmtid' AND postid='$postid'"));
        $tnc = (int) ++$a['tnc'];
        queryMysql("INSERT INTO replysoccomments VALUES('$user', 
        '$id', '$postid', '$cmtid', '$cnt', '$timeofreply', '$tnr', '$tln')");
        queryMysql("UPDATE soccomments SET tnc='$tnc' WHERE postid='$postid' AND id='$cmtid'");
        queryMysql("UPDATE socposts SET pnc='$pnc' WHERE id='$postid'");
}

?>