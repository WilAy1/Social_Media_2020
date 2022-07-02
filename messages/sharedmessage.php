<?php
    require_once '/Users/wilay/students_connect/connect.php';
    if(isset($_GET['user']) && isset($_GET['sendto']) && isset($_GET['type'])){
        $user = sanitizeString($_GET['user']);
        $sendto = explode(",", sanitizeString($_GET['sendto']));
        $oq = sanitizeString($_GET['type']);
        if($oq == '1'){
            $s = 's';
        }
        else {
            $s = '';
        }
        $themessage = '<div><i style="font-size: 12px;"><i class="fas fa-share"></i> shared</i></div><a target="_blank" href="/students_connect/posts/'.$s.''.sanitizeString($_GET['id']).'">Go to post.</a>';
        $id = 0;
        $time = time();
        for($i = 0; $i < count($sendto); $i++){
            echo $sendto[$i]."<br/>";
            queryMysql("INSERT INTO messages VALUES('$id', '$user', '$sendto[$i]', '$themessage', '$time', '0','0','0','0')");
            $bcd = queryMysql("SELECT * FROM messagesbase WHERE fone='$user'  AND ftwo='$sendto[$i]' 
            OR fone='$sendto[$i]' AND ftwo='$user'");
            if($bcd->num_rows==0){
                $id = 0;
                queryMysql("INSERT INTO messagesbase VALUES('$id', '$user', '$sendto[$i]', '$time', '1')");
            }
            else {
                queryMysql("UPDATE messagesbase SET lasttimeofmessage='$time'  WHERE fone='$user' AND ftwo='$sendto[$i]' OR ftwo='$user' AND fone='$sendto[$i]'");
            }
        }
    }
?>