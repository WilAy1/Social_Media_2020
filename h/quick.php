<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_SESSION['user'])){
        $gu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
        $user = $gu['user'];
        if(isset($_POST['qmg'])){
            $gu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
            $user = $gu['user'];

        }
        if(isset($_GET['usr']) && isset($_GET['val'])){
            $not = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
            $user = $not['user'];
            $frnd = sanitizeString($_GET['val']);
        $glst = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend LIKE '%".$frnd."%'");        $mbitt = queryMysql("SELECT * FROM members WHERE firstname LIKE '%".$frnd."%' OR surname LIKE '%".$frnd."%' OR user LIKE '%".$frnd."%' OR user LIKE '%".$frnd."%'");
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
                echo "<div class='flaf' onclick='lfmsg(\"".$user."\", \"".$gfnms['user']."\")'>
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
        if(isset($_POST['fname'])){
            $nmu = $user;
            $fname = $nmf = sanitizeString($_POST['fname']);
            $kt = queryMysql("SELECT * FROM messages WHERE sender='$user' AND receiver='$fname' OR sender='$fname' AND receiver='$nmu'");
            if($kt->num_rows){
                echo "<div class='phu'>";
                while($gfm = mysqli_fetch_array($kt)){
                    $oqa = queryMysql("SELECT * FROM deletedmessages WHERE messageid='".$gfm['messageid']."'");
            $moqa = mysqli_fetch_array($oqa);
            if(($oqa->num_rows == 0) || ($oqa->num_rows && $moqa['byuser'] != $nmu)){
                
                if($gfm['sender'] == $nmu){
                    //do nothing    
                    }
                    else{
                        queryMysql("UPDATE messages SET hasread=1 WHERE sender='$nmf' AND receiver='$nmu'");
                    }
                if($gfm['sender'] == $user){
                    $mexx = "background-color: #147efb; color: white;";
                    $waexspecial = 'waexspecial';
                    $gb = '';
                    $float = "right";
                    $errl = 'q_rsset';
                    $o = "";
                    $distance = "";
                    $rrt = 'You';
                    global $float;
                    if($gfm['hasread'] != 0){
                        $btck = "<i class='fas fa-check-double'></i>";
                    }
                    else {
                        $btck = "<i class='fas fa-check'></i>";
                    }
                }
                else {
                    $rrt = $gfm['sender'];
                    $mexx = '';
                    $waexspecial = '';
                    $gb = '';
                    $o ="onclick='opnfinf(\"".$nmu."\", \"".$nmf."\")'";
                    $float = "";
                    global $float;
                    $btck = "";
                    $errl = 'q_lsset';
                }
                if(file_exists("../../students_connect_hidden/users_profile_upload/".$gfm['sender'].'/'.$gfm['sender'].".png")){ 
                    $img =  '/students_connect_hidden/users_profile_upload/'.$gfm['sender'].'/'.$gfm['sender'].'.png';
                    }
                    else {
                        $img =  '/students_connect/user.png';
                    }
                    $mgae = queryMysql("SELECT * FROM messages WHERE messageid='".$gfm['replyingto']."'");
                    $gae = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE messageid='".$gfm['replyingto']."'"));
                    if($mgae->num_rows){
                    if($gae['replyingto'] == 0){
                        if(!empty($gae['message']) || $gae['hasfile'] == 1){
                            $iu = $gae['sender'];
                            $cl = 'color: green';
                            $po = 'no_po_oo';
                            if($gae['sender'] == $user){
                                $iu = 'You';
                                $cl = 'color: orange';
                                $po = 'p__o_o';
                            }
                        $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                        ': $gae['message'];
                        if($x == ''){
                            $x = 'File';
                        }
                        else {
                            $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                        ': $gae['message'];
                        }
                        $ra = "<div class='trmbx $po'>
                        <a href='#".$gae['messageid']."'>
                        <div class='m_iinit' style='$cl'>".$iu."</div>
                        <div class='strmsg' id='tstrmsg'>".strip_tags($x)."</div></a></div>";
                    }
                    else {
                        $ra = "";
                    }
                    }
                    else {
                        if(!empty($gae['message']) || $gae['hasfile'] == 1){
                            $iu = $gae['sender'];
                            $cl = 'color: green';
                            $po = 'no_po_oo';
                            if($gae['sender'] == $user){
                                $iu = 'You';
                                $cl = 'color: orange';
                                $po = 'p__o_o';
                            }
                        $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                        ': $gae['message'];
                        if($x == ''){
                            $x = 'File';
                        }
                        else {
                            $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                        ': $gae['message'];
                        }
                        $ra = "<div class='trmbx $po'>
                        <a href='#".$gae['messageid']."'>
                        <div class='m_iinit' style='$cl'>".$iu."</div>
                        <div class='strmsg' id='tstrmsg'>".strip_tags($x)."</div></a></div>";
                        }
                        else {
                            $ra = "";
                        }
                    }
                }
                else {
                    $ra = "";
                }
                    
                    $gmsg = str_replace('/ampersandsymbol/', '&', $gfm['message']);
                    echo "<div class='waex' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float;' aria-label='".$gfm['timeofmessage']."'>
                    <div class='pcotm1 $errl jaming' style='float: $float; $gb; $mexx'>
                    $ra
                    <div class='mfl'>
                    <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                        <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                        <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                        </div></div><div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                        \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                        <i class='fas fa-reply'></i>
                        </div><div class='m_options' style='display: none'>
                        <div class='mm_options'></div>
                        </div></div>";


                }
            }
            echo "</div>";
        }
    }
}
?>