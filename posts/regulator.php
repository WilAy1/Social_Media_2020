<?php
require_once "/Users/wilay/students_connect/connect.php";
session_start();
if(isset($_GET['id']) && isset($_GET['usr']) && isset($_SESSION['user'])){
    $id = sanitizeString($_GET['id']);
    $user = $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $row['user'];
    $type = $_GET['type'];

    if($_GET['type'] == '0'){
        $vde = queryMysql("SELECT * FROM eduposts WHERE id='$id' AND user='$user' OR sharedby='$user'");
        if($vde->num_rows){
            queryMysql("DELETE FROM eduposts WHERE id='$id'");
            queryMysql("DELETE FROM votes WHERE id='$id'");
            queryMysql("DELETE FROM polls WHERE pid='$id' AND pstst='$type'");
            queryMysql("DELETE FROM pollbase WHERE pid='$id' AND pstst='$type'");
            queryMysql("DELETE FROM postviews WHERE id='$id'");
            queryMysql("DELETE FROM educomments WHERE postid='$id'");
            queryMysql("DELETE FROM replyeducomments WHERE postid='$id'");
            queryMysql("DELETE FROM commentvotes WHERE postid='$id'");
        }
    }
    elseif($_GET['type'] == '1'){
        $vde = queryMysql("SELECT * FROM socposts WHERE id='$id' AND user='$user' OR sharedby='$user'");
        if($vde->num_rows){
            queryMysql("DELETE FROM socposts WHERE id='$id'");
            queryMysql("DELETE FROM loves WHERE id='$id'");
            queryMysql("DELETE FROM polls WHERE pid='$id' AND pstst='$type'");
            queryMysql("DELETE FROM pollbase WHERE pid='$id' AND pstst='$type'");          
            queryMysql("DELETE FROM soccomments WHERE postid='$id'");
            queryMysql("DELETE FROM replysoccomments WHERE postid='$id'");
            queryMysql("DELETE FROM commentloves WHERE postid='$id'");
        }
    }
}
else {
    header("Location: ../h/");
    exit();
}
?>