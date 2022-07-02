<?php
    define('ROOT', "/Users/wilay/students_connect/");
    require_once ROOT."/connect.php";
    if((isset($_POST['cmtedupst']))&& (!empty($_POST['cmtedupst']) || !empty($_FILES['esfile']['name'][0]))){
        $cmt = sanitizeString($_POST['cmtedupst']);
        $usr = $_SESSION['user'];
        $gusr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $gusr['user'];
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
        $mo = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE user='$user' AND timeofcomment='$toc'"));
        mkdir("../../../students_connect_hidden/comments/".$mo['id']);
        for($i = 0; $i < count($_FILES['esfile']['name']); $i++){
            $nnn = $_FILES['esfile']['name'][$i];
            echo $nnn;
            move_uploaded_file($_FILES['esfile']['tmp_name'][$i],
              '../../../students_connect_hidden/comments/'.$mo['id'].'/'. $nnn);
              if(substr($_FILES['esfile']['type'][$i], 0, 5) == "image"){
                rename('../../../students_connect_hidden/comments/'.$mo['id'].'/'.$_FILES['esfile']['name'][$i],
                 '../../../students_connect_hidden/comments/'.$mo['id'].'/'.$mo['id'].'('.$i.').png');
                }
        }
    }
?>