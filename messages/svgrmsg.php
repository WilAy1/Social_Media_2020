<?php
if(!isset($_SESSION['user'])){
    session_start();
}
require_once "/Users/wilay/students_connect/connect.php";
if(isset($_POST['msg']) && isset($_POST['snd']) && isset($_POST['rec'])){
    if(sanitizeString(dec($_POST['snd'])) == $_SESSION['user']){
    if($_POST['msg'] != '' || $_POST['msg'] != ' '){
    $sender = sanitizeString(dec($_POST['snd']));
    $receiver = sanitizeString(dec($_POST['rec']));
    $fsd = queryMysql("SELECT * FROM members WHERE user='$sender'");
    $frc = queryMysql("SELECT * FROM members WHERE user='$receiver'");
    if($fsd->num_rows&& $frc->num_rows);{
    if($_POST['hasfile'] == 0){
    if($_POST['reply'] == 0){
    $sender = sanitizeString(dec($_POST['snd']));
    $receiver = sanitizeString(dec($_POST['rec']));
    $message = urldecode(sanitizeString($_POST['msg']));
    $message = $message;
    $time = time();
    $id = 0;
    $hasfile = $_POST['hasfile'];
    $hasread = 0;
    $isreply = 0;
    $replyto = $_POST['rplyto'];
    queryMysql("INSERT INTO messages VALUES('$id', '$sender', '$receiver', '$message', '$time', '$hasfile', '$hasread', '$isreply', '$replyto')");
    $time= time();
        queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$sender'");
        $bcd = queryMysql("SELECT * FROM messagesbase WHERE fone='$sender'  AND ftwo='$receiver' 
        OR fone='$receiver' AND ftwo='$sender'");
        if($bcd->num_rows==0){
            $id = 0;
            queryMysql("INSERT INTO messagesbase VALUES('$id', '$sender', '$receiver', '$time', '0')");
        }
        else {
            $gbcd = mysqli_fetch_array($bcd);
            $nnnm = (int) ($gbcd['numberofmessages'] + 1);
            queryMysql("UPDATE messagesbase SET lasttimeofmessage='$time', numberofmessages = '$nnnm' WHERE fone='$sender' AND ftwo='$receiver' OR ftwo='$sender' AND fone='$receiver'");
        }
    }
    else {
            $sender = sanitizeString(dec($_POST['snd']));
            $receiver = sanitizeString(dec($_POST['rec']));
            $message = urldecode(sanitizeString($_POST['msg']));
            $message = ($message);
            $time = time();
            $id = 0;
            $hasfile = $_POST['hasfile'];
            $hasread = 0;
            $isreply = 1;
            $replyto = $_POST['rplyto'];
            queryMysql("INSERT INTO messages VALUES('$id', '$sender', '$receiver', '$message', '$time', '$hasfile', '$hasread', '$isreply', '$replyto')");
            $time= time();
                queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$sender'");
                $bcd = queryMysql("SELECT * FROM messagesbase WHERE fone='$sender'  AND ftwo='$receiver' 
        OR fone='$receiver' AND ftwo='$sender'");
        if($bcd->num_rows==0){
            $id = 0;
            queryMysql("INSERT INTO messagesbase VALUES('$id', '$sender', '$receiver', '$time', '0')");
        }
        else {
            $gbcd = mysqli_fetch_array($bcd);
            $nnnm = (int) ($gbcd['numberofmessages'] + 1);
            queryMysql("UPDATE messagesbase SET lasttimeofmessage='$time', numberofmessages='$nnnm' WHERE fone='$sender' AND ftwo='$receiver' OR ftwo='$sender' AND fone='$receiver'");
        }
            }
}
elseif($_POST['hasfile'] == 1){
        $sender = sanitizeString(dec($_POST['snd']));
        $receiver = sanitizeString(dec($_POST['rec']));
        $message = URLdecode(sanitizeString($_POST['msg']));
        $message = ($message);
        $time = time();
        $id = 0;
        $hasfile = $_POST['hasfile'];
        $hasread = 0;
        if($_POST['reply'] == 0){
        $isreply = 0;
        }
        else {
        $isreply = 1;
        } 
        $replyto = $_POST['rplyto'];
        queryMysql("INSERT INTO messages VALUES('$id', '$sender', '$receiver', '$message', '$time', '$hasfile', '$hasread', '$isreply', '$replyto')");
        $time= time();
            queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$sender'");
            $bcd = queryMysql("SELECT * FROM messagesbase WHERE fone='$sender'  AND ftwo='$receiver' 
            OR fone='$receiver' AND ftwo='$sender'");
            if($bcd->num_rows==0){
                $id = 0;
            queryMysql("INSERT INTO messagesbase VALUES('$id', '$sender', '$receiver', '$time', '0')");
            }
            else {
                $gbcd = mysqli_fetch_array($bcd);
            $nnnm = (int) ($gbcd['numberofmessages'] + 1);
                queryMysql("UPDATE messagesbase SET lasttimeofmessage='$time', numberofmessages = '$nnnm' WHERE fone='$sender' AND ftwo='$receiver' OR ftwo='$sender' AND fone='$receiver'");
            }
            $a = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE sender='$sender' AND receiver='$receiver' AND timeofmessage='$time'"));
            $utid = $a['messageid'];
            if(!empty($_FILES['files']['name'][0])){
                chdir("../../students_connect_hidden/messages_uploads/");
                mkdir($utid);
                $nmf = count($_FILES['files']['name']);
                for($i=0; $i < $nmf; $i++){
                  $nnn = $_FILES['files']['name'][$i];
                  move_uploaded_file($_FILES['files']['tmp_name'][$i],
                  '../../students_connect_hidden/messages_uploads/'.$utid.'/'. $nnn);
                  if(substr($_FILES['files']['type'][$i], 0, 5) == "image"){
                  rename('../../students_connect_hidden/messages_uploads/'.$utid.'/'.$_FILES['files']['name'][$i],
                     '../../students_connect_hidden/messages_uploads/'.$utid.'/'.$i.'.png');
                  }
                  elseif(substr($_FILES['files']['type'][$i], 0, 5) == "video"){
                    rename('../../students_connect_hidden/messages_uploads/'.$utid.'/'.$_FILES['files']['name'][$i],
                     '../../students_connect_hidden/messages_uploads/'.$utid.'/'.$i.'.mp4');
                  }
                  elseif(substr($_FILES['files']['type'][$i], 0, 5) == "audio"){
                    rename('../../students_connect_hidden/messages_uploads/'.$utid.'/'.$_FILES['files']['name'][$i],
                     '../../students_connect_hidden/messages_uploads/'.$utid.'/'.$i.'.mp3');
                  }
                  else {
                    rename('../../students_connect_hidden/messages_uploads/'.$utid.'/'.$_FILES['files']['name'][$i],
                    '../../students_connect_hidden/messages_uploads/'.$utid.'/'.$i.'.'.pathinfo($_FILES['files']['name'][$i],PATHINFO_EXTENSION));
                  }
                }
        }
}
    }
}
}
}
if(isset($_POST['username']) && isset($_POST['groupid']) && isset($_POST['message'])
    && isset($_POST['hasfile']) && isset($_POST['isreply'])&& isset($_POST['replying'])){
        $sender= sanitizeString($_POST['username']);
        $time = time();
        $id = 0;
        $groupid = sanitizeString($_POST['groupid']);
        $message = sanitizeString($_POST['message']); 
        $hasfile = sanitizeString($_POST['hasfile']);
        $isreply = sanitizeString($_POST['isreply']);
        $replying = sanitizeString($_POST['replying']);
        queryMysql("UPDATE members SET lastactivitytime='$time' WHERE user='$sender'");
        queryMysql("INSERT INTO groupmessages VALUES ('$id', 
        '$sender', '$groupid', '$message', '$time', '$hasfile', '$isreply', '$replying')");
        queryMysql("UPDATE selfgroups SET lastmessagetime = '$time' 
        WHERE id='$groupid'");
        queryMysql("UPDATE groupmembership SET lastmessageongroup = '$time' WHERE groupid='$groupid'");
        if(isset($_POST['hasfile']) == 1){
            for($i = 0, $i < 5; $i++;){
                if(!file_exists('../../students_connect_hidden/messages_uploads/'.$i.'png')){
                    $dsm = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE sender='$sender' AND receiver='$receiver'"));
                    $target_dir = "../../students_connect_hidden/messages_uploads/";
                    $target_file = $target_dir. basename($_FILES['files']['name']);
                    $uploadOk = 1;
                    if($_FILES['files']['size'] > 500000){
                        $uploadOk = 0;
                    }
                    else {
                        $uploadOk = 1;
                    }
                    if($uploadOk == 0){
                        // file shouldn't be uploaded
                    }
                    else {
                        if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)){
                            rename('../../students_connect_hidden/messages_uploads/'.
                            basename($_FILE['files']['name']), 
                        '../../students_connect_hidden/messages_uploads/'.
                        $dsm['messageid'].'.png');
                        }
                    
                    }
                }
            }            
        }
    }
if(isset($_POST['dxe'])){
    $did = sanitizeString($_POST['dxe']);
    session_start();
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    $mat = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE messageid='$did'"));
    $id = 0;
    $time = time();
    if($mat['sender']==$row['user']){
        queryMysql("DELETE FROM messages WHERE messageid='$did'");
        queryMysql("INSERT INTO deletedmessages VALUES('$id', '$did', '".$row['user']."', '".$time."')");
    }
    elseif($mat['receiver'] == $row['user']){
        queryMysql("INSERT INTO deletedmessages VALUES('$id', '$did', '".$row['user']."', '".$time."')");
    }
}
?>
