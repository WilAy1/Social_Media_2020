<?php
    require_once "/Users/wilay/students_connect/connect.php";
if(isset($_POST['rpostid']) && isset($_POST['rcmtid']) && isset($_POST['rid']) && isset($_POST['cmtreplyreplyedupst']) ** !empty($_POST['cmtreplyreplyedupst'])){
    $content = sanitizeString($_POST['cmtreplyreplyedupst']);
    $usr = $_SESSION['user'];
    $gusr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $user = $gusr['user'];
    $id = 0;
    $postid = sanitizeString($_POST['rpostid']);
    $cmtid = sanitizeString($_POST['rcmtid']);
    $rid = sanitizeString($_POST['rid']);
    $time = time();
    $tnr = 0;
    $tun = 0;
    $tdn = 0;
    $educh = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));
    $pnc = (int) ++$educh['pnc'];
    $a = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$cmtid' AND postid='$postid'"));
    $tnc = (int) ++$a['tnc'];
    $b = mysqli_fetch_array(queryMysql("SELECT * FROM replyeducomments WHERE id='$rid' AND cmtid='$cmtid' AND postid='$postid'"));
    $tpnc = (int) ++$b['tnr'];
    queryMysql("INSERT INTO replyreplieseducomments VALUES('$user', 
        '$id', '$postid', '$cmtid','$rid', '$content', '$time', '$tnr', '$tun',
        '$tdn')");
        queryMysql("UPDATE educomments SET tnc='$tnc' WHERE postid='$postid' AND id='$cmtid'");
        queryMysql("UPDATE eduposts SET pnc='$pnc' WHERE id='$postid'");
        queryMysql("UPDATE replyeducomments SET tnr='$tpnc' WHERE postid='$postid' AND cmtid='$cmtid' AND id='$rid'");
    }
if(isset($_POST['srpostid']) && isset($_POST['srcmtid']) && isset($_POST['srid']) && isset($_POST['scmtreplyreplysocpst']) && !empty($_POST['scmtreplyreplysocpst'])){
        $content = sanitizeString($_POST['scmtreplyreplysocpst']);
        $usr = $_SESSION['user'];
        $gusr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $gusr['user'];
        $id = 0;
        $postid = sanitizeString($_POST['srpostid']);
        $cmtid = sanitizeString($_POST['srcmtid']);
        $rid = sanitizeString($_POST['srid']);
        $time = time();
        $tnr = 0;
        $tun = 0;
        $educh = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$postid'"));
        $pnc = (int) ++$educh['pnc'];
        $a = mysqli_fetch_array(queryMysql("SELECT * FROM soccomments WHERE id='$cmtid' AND postid='$postid'"));
        $tnc = (int) ++$a['tnc'];
        $b = mysqli_fetch_array(queryMysql("SELECT * FROM replysoccomments WHERE id='$rid' AND cmtid='$cmtid' AND postid='$postid'"));
        $tpnc = (int) ++$b['tnr'];
        queryMysql("INSERT INTO replyrepliessoccomments VALUES('$user', 
            '$id', '$postid', '$cmtid','$rid', '$content', '$time', '$tnr', '$tun')");
            queryMysql("UPDATE soccomments SET tnc='$tnc' WHERE postid='$postid' AND id='$cmtid'");
            queryMysql("UPDATE socposts SET pnc='$pnc' WHERE id='$postid'");
            queryMysql("UPDATE replysoccomments SET tnr='$tpnc' WHERE postid='$postid' AND cmtid='$cmtid' AND id='$rid'");
        }   
?>