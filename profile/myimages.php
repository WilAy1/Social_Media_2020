<?php
session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $user = $_SESSION['user'];
    $rt = queryMysql("SELECT * FROM eduposts WHERE user='$user' OR sharedby='$user' 
    UNION ALL
    SELECT * FROM socposts WHERE user='$user' OR sharedby='$user'");
while ($g = mysqli_fetch_array($rt)) {
    if(file_exists("../../students_connect_hidden/postuploads/s/".$g['id']."(0).png")){
        echo "<img src='/students_connect_hidden/postuploads/s/".$g['id']."(0).png' height='150' width='150' style='margin: 3px;'>";
    }
}
?>