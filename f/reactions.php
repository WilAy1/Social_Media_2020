<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['id']) && isset($_POST['fid']) && isset($_POST['user']) && isset($_POST['s1'])){
        $id = 0;
        $pid = $_POST['id'];
        $fid = $_POST['fid'];
        $user = $_POST['user'];
        $ipv = 1;
        $ot = 0;
        $time = time();
        $tov = 'upvote';
        $x = mysqli_fetch_array(queryMysql("SELECT * FROM forumpostsvotes WHERE postid='$pid' AND fid='$fid' AND user='$user'"));
        $f = mysqli_fetch_array(queryMysql("SELECT * FROM forumposts WHERE id='$pid' AND forumid='$fid'"));
        if($x['tov'] == 'upvote'){
            queryMysql("DELETE FROM forumpostsvotes WHERE postid='$pid' AND fid='$fid' AND user='$user' AND tov='upvote'");
            $pn = (int) --$f['tnuvotes'];
            queryMysql("UPDATE forumposts SET tnuvotes='$pn' WHERE id='$pid' AND forumid='$fid'");
        }
        elseif($x['tov'] == 'downvote'){
            $pn = (int) ++$f['tnuvotes'];
            $tn = (int) --$f['tndvotes'];
            queryMysql("UPDATE forumpostsvotes SET tov='upvote' WHERE postid='$pid' AND fid='$fid' AND user='$user'");
            queryMysql("UPDATE forumposts SET tnuvotes='$pn', tndvotes='$tn' WHERE id='$pid' AND forumid='$fid'");
        }
        else{
        queryMysql("INSERT INTO forumpostsvotes VALUES('$id','$user', '$fid',
                    '$tov', '$ipv', '$pid', '$ot', '$ot', '$ot', '$ot', '$ot',
                    '$ot', '$ot', '$ot', '$time')");
        $pn = (int) ++$f['tnuvotes'];
        queryMysql("UPDATE forumposts SET tnuvotes='$pn' WHERE id='$pid' AND forumid='$fid'");
    }
    }
if(isset($_POST['id']) && isset($_POST['fid']) && isset($_POST['user']) && isset($_POST['s2'])){
        $id = 0;
        $pid = $_POST['id'];
        $fid = $_POST['fid'];
        $user = $_POST['user'];
        $ipv = 1;
        $ot = 0;
        $time = time();
        $tov = 'downvote';
        $x = mysqli_fetch_array(queryMysql("SELECT * FROM forumpostsvotes WHERE postid='$pid' AND fid='$fid' AND user='$user'"));
        $f = mysqli_fetch_array(queryMysql("SELECT * FROM forumposts WHERE id='$pid' AND forumid='$fid'"));
        if($x['tov'] == 'downvote'){
            queryMysql("DELETE FROM forumpostsvotes WHERE postid='$pid' AND fid='$fid' AND user='$user' AND tov='downvote'");
            $pn = (int) --$f['tndvotes'];
            queryMysql("UPDATE forumposts SET tndvotes='$pn' WHERE id='$pid' AND forumid='$fid'");
        }
        elseif($x['tov'] == 'upvote'){
            $pn = (int) --$f['tnuvotes'];
            $tn = (int) ++$f['tndvotes'];
            queryMysql("UPDATE forumpostsvotes SET tov='downvote' WHERE postid='$pid' AND fid='$fid' AND user='$user'");
            queryMysql("UPDATE forumposts SET tnuvotes='$pn', tndvotes='$tn' WHERE id='$pid' AND forumid='$fid'");
        }
        else{
        queryMysql("INSERT INTO forumpostsvotes VALUES('$id','$user', '$fid',
                    '$tov', '$ipv', '$pid', '$ot', '$ot', '$ot', '$ot', '$ot',
                    '$ot', '$ot', '$ot', '$time')");
        $pn = (int) ++$f['tndvotes'];
        queryMysql("UPDATE forumposts SET tndvotes='$pn' WHERE id='$pid' AND forumid='$fid'");
    }
    }    
?>