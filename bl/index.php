<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['type']) && isset($_POST['id'])){
        $type = sanitizeString($_POST['type']);
        $id = sanitizeString($_POST['id']);
        if($type == 0){
            $type = 'eduposts';
        }
        else {
            $type = 'socposts';
        }
        $mex = mysqli_fetch_array(queryMysql("SELECT * FROM $type WHERE id='$id'"));
        echo $mex['user'];
    }

?>