<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['to'])){
        $user = $_SESSION['user'];
        $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $row['user'];
        $to = sanitizeString($_POST['to']);
        $id = 0;
        $time = time();
        $ff = queryMysql("SELECT * FROM blocked WHERE user='$user' AND touser='$to'");
        if($ff->num_rows == 0){
        queryMysql("INSERT INTO blocked VALUES('$id', '$user', '$to', '$time')");
        $rt = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$to'");
        if($rt->num_rows){
            queryMysql("DELETE FROM followstatus WHERE user='$user' AND friend='$to'");
        }
    }
}
if(isset($_POST['wh'])){
        $user = $_SESSION['user'];
        $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $user = $row['user'];
        $to = sanitizeString($_POST['wh']);
        queryMysql("DELETE FROM blocked WHERE user='$user' AND touser='$to'");
}

?>