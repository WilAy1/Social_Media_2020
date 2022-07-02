<?php
    session_start();
    require_once "connect.php";
    if(isset($_SESSION['user'])){
       if(isset($_POST['oltm']))
       $oltm = $_POST['oltm'];
        $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $user = $row['user'];
        $lt = $_POST['lt'];
        $oar = queryMysql("SELECT * FROM messages WHERE (receiver='$user' AND hasread='0') AND timeofmessage BETWEEN '$lt' AND '$oltm'");
        if($oar->num_rows){
            echo "<div class='in_nottt'>
            <div class='eaaem'>Notification</div>";
            while($eet = mysqli_fetch_array($oar)){
                echo "
            <div class='tyof_not'>
            New Message
            </div>
            <div class='cont_of_not'>
            <i class='fas fa-at'></i>".$eet['sender']." sent: ".$eet['message']."
            </div>
            <div class='timeeeofnot'>
            ".date("h:i a", $eet['timeofmessage'])."
        </div>";
    }
       echo "</div>
            </div>";
    }
    }
    else {
    }
?>