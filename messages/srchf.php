<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_SESSION['user'])){
    if(isset($_GET['usr']) && isset($_GET['val'])){
        $not = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $user = $not['user'];
        $frnd = sanitizeString($_GET['val']);
    $glst = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend LIKE '%".$frnd."%'");
    $mbitt = queryMysql("SELECT * FROM members WHERE firstname LIKE '%".$frnd."%' OR surname LIKE '%".$frnd."%' OR user LIKE '%".$frnd."%' OR user LIKE '%".$frnd."%'");
    if($glst->num_rows == 0){
        echo "No suggestion";
    }
    else {
        while($gmb = mysqli_fetch_assoc($glst)){
        if($gmb['user']){
            $frnds = $gmb['friend'];
        $fnms = queryMysql("SELECT * FROM members WHERE user='$frnds' OR firstname='$frnds' OR surname='$frnds' ORDER BY firstname");
        while($gfnms = mysqli_fetch_assoc($fnms)){
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$gfnms['user'].'/'.$gfnms['user'].".png")){ 
                $mfimg = '../../../../../students_connect_hidden/users_profile_upload/'.$gfnms['user'].'/'.$gfnms['user'].'.png';
                }
                else {
                    $mfimg =  '../user.png';
                }
                $mff = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE sender='$user' AND receiver='$frnds' OR receiver='$user' AND sender='$frnds' ORDER BY timeofmessage DESC"));
                if(isset($mff['timeofmessage'])){
                    $omm = $mff['timeofmessage'];
                }
                else {
                    $omm = 0;
                }
            echo "<div class='flaf' onclick='openfMsg(\"$user\", \"$frnds\", \"".$omm."\")'>
            <div class='mfsimg' style='
            background-image: url(\"$mfimg\");
            '></div>
            <div class='mfnms'>"
            .$gfnms['firstname']." ".$gfnms['surname']."
            </div></div>";            
            }
        }
    }
}
    }
    if(isset($_POST['usr']) && isset($_POST['mes'])){
        $not = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $user = $not['user'];
        $mes = sanitizeString($_POST['mes']);
      $bcs  = queryMysql("SELECT * FROM messages WHERE sender='$user' AND message LIKE '%$mes%'
       OR receiver='$user' AND message LIKE '%$mes%'");
        if($bcs->num_rows == 0){
            echo "No suggestion";
        }
        else {
            echo mysqli_num_rows($bcs)." results<br/>";
            while($bcd = mysqli_fetch_assoc($bcs)){
                echo $bcd['sender']."  <i class='fas fa-arrow-right'></i>  ".$bcd['message']."<br/>";
            }
        }

}
}
?>