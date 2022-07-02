<?php
    if(!isset($_SESSION['user'])){
        session_start();
    }
    define('q', '/Users/wilay/students_connect/');
    require_once q."connect.php";
    if(isset($_POST['scmt']) && (!empty($_POST['scmt']) || !empty($_FILES['esfile']['name'][0]))){
        $cmt = sanitizeString($_POST['scmt']);
        $user = $_SESSION['user'];
        $id = 0;
        $postid = $_POST['postid'];
        $toc = time();
        $tnc = 0;
        $tln = 0; 
        $tdn = 0;
        $educh = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$postid'"));
        $pnc = (int) ++$educh['pnc'];
        
        queryMysql("INSERT INTO soccomments VALUES('$user', '$id', '$postid','$cmt', '$toc',
        '$tnc', '$tln')");
        queryMysql("UPDATE socposts SET pnc='$pnc' WHERE id='$postid'");    
        $mo = mysqli_fetch_array(queryMysql("SELECT * FROM soccomments WHERE user='$user' AND timeofcomment='$toc'"));
        mkdir("../../../students_connect_hidden/comments/s".$mo['id']);
        for($i = 0; $i < count($_FILES['esfile']['name']); $i++){
            $nnn = $_FILES['esfile']['name'][$i];
            echo $nnn;
            move_uploaded_file($_FILES['esfile']['tmp_name'][$i],
              '../../../students_connect_hidden/comments/s'.$mo['id'].'/'. $nnn);
              if(substr($_FILES['esfile']['type'][$i], 0, 5) == "image"){
                rename('../../../students_connect_hidden/comments/s'.$mo['id'].'/'.$_FILES['esfile']['name'][$i],
                 '../../../students_connect_hidden/comments/s'.$mo['id'].'/'.$mo['id'].'('.$i.').png');
                }
        }
    }
?>