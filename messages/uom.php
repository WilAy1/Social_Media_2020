<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
if(isset($_POST['mnm']) && $_POST['mfn']){
    $nmu = sanitizeString($_POST['mnm']);
    $nmf = sanitizeString($_POST['mfn']);
    $ltm = sanitizeString($_POST['ltm']);
    $bi = dec($_POST['iit']);
    $to = $_POST['to'];
    $x = "";
    $art = array();
    if(!empty($to)){
    for($i = 0; $i < count($to); $i++){
        $x.="AND messageid != '".$to[$i]."'";
    }
    }
    else {
        $x = '';
    }
    $fm = queryMysql("SELECT * FROM messages WHERE sender='$nmu' AND receiver='$nmf'  AND receiver='$nmf' OR sender='$nmf' AND receiver='$nmu'");
    if($fm->num_rows == 0){
        $report = "<div class='nmof'>No message. Send a message to $nmf</div>
        <input type='hidden' value='yxip0293msi3902nujxiw0nxi200nsn20'>";
        $btck = "";
        array_push($art, array('0', "<div class='msgcontnt'>$report</div>"));
    }
    else {
        $report = "";
        $fm = queryMysql("SELECT * FROM messages WHERE (sender='$nmu' AND receiver='$nmf'  AND receiver='$nmf' OR sender='$nmf' AND receiver='$nmu' $x) $bi AND timeofmessage > $ltm");
        if($fm->num_rows){
            $lastday = array();
            while($gfm = mysqli_fetch_assoc($fm)){
                $oqa = queryMysql("SELECT * FROM deletedmessages WHERE messageid='".$gfm['messageid']."'");
                $moqa = mysqli_fetch_array($oqa);
            if(($oqa->num_rows == 0) || ($oqa->num_rows && $moqa['byuser'] != $nmu)){
            array_push($lastday, $gfm['timeofmessage']);
            if(count($lastday)>1){
            $cld = (int) count($lastday) - 2;
            if(date("d", $lastday[$cld]) != date("d", $gfm['timeofmessage'])){
            if(isset($lastday[$cld+1])){
                $usetime = date("Y/m/d", $lastday[$cld+1]);
            }    
            else {
                $usetime = 'Today';
            }
            if(date("y m d", $lastday[$cld]) == date("y m d", strtotime('yesterday'))){
                    $usetime = 'Today';
            }
            //array_push($art, array('0', "<div class='waexs'>
            //    <div class='pcotm1s'>".$usetime."</div></div>"));
            }
            } 
            if($gfm['sender'] == $nmu){
                //do nothing    
                }
                else{
                    queryMysql("UPDATE messages SET hasread=1 WHERE sender='$nmf' AND receiver='$nmu'");
                }
            $user = $_POST['mnm'];
            if($gfm['sender'] == $user){
                $rrt = 'You';
                $mexx = "background-color: #147efb; color: white;";
                $waexspecial = 'waexspecial';
                $gb = '';
                $float = "right";
                $errl = 'q_rsset';
                $distance = "";
                global $float;
                $o = "";
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
                $float = "";
                global $float;
                $btck = "";
                $o ="onclick='opnfinf(\"".$nmu."\", \"".$nmf."\")'";
                $errl = 'q_lsset';
            }
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$gfm['sender'].'/'.$gfm['sender'].".png")){ 
                $img =  '../../../../../students_connect_hidden/users_profile_upload/'.$gfm['sender'].'/'.$gfm['sender'].'.png';
                }
                else {
                    $img =  '../user.png';
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
                            $lox = mysqli_fetch_array(queryMysql("SELECT * FROM settings WHERE user='$user'"))['ucolor'];
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
                if($gfm['hasfile'] == 1){
                    if($gfm['hasfile'] == 1){
                        $cd = getcwd();
                        $olx = "../../students_connect_hidden/messages_uploads/".$gfm['messageid'];
                        $gmsg = str_replace('/ampersandsymbol/', '&', $gfm['message']);
                        if(file_exists($olx)){
                            $oqx = scandir($olx);
                            unset($oqx[0]);
                            unset($oqx[1]);
                            }
                            else {
                                $oqx = [];
                            }
                        if(!empty($oqx)){
                        $oqx = array_values($oqx);
                        for($i = 0; $i < count($oqx); $i++){
                            if(is_file($olx."/".$oqx[$i])){
                                if(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'png'){
                                    array_push($art, array($gfm['messageid'],"<div class='waex $waexspecial' title='".$rrt."' id='".$gfm['messageid']."' style='float: $float; margin: 0px;'  aria-label='".$gfm['timeofmessage']."'>
                        <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                        $ra
                        <div class='pl_eeimg' style='background-image:url(\"/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".png\")'></div>
                        <img src='/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".png' alt='Images' class='tf_eeimg'>
                        <div class='mfl' style='padding-top: 3px;'>
                <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                    <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                    <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                    </div>
                        </div>
                        <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                    \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                    <i class='fas fa-reply'></i>
                    </div>
                        
                        <div class='m_options' style='display: none'><div class='mm_options'></div>
                        </div>
                        </div>
                        ", $gfm['timeofmessage'], $gfm['message']));
                                }
                                elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp4'){
                                    array_push($art, array($gfm['messageid'],"<div class='waex $waexspecial' title='".$rrt."' id='".$gfm['messageid']."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
                        <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                        $ra
                        <video style='opacity: 1' width='200' height='200' controls>
                        <source src='/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".mp4'>
                        </video>
                        <div class='mfl' style='padding-top: 3px;'>
                <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                    <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                    <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                    </div>
                        </div>
                        <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                    \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                    <i class='fas fa-reply'></i>
                    </div>
                        
                        <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                        </div>
                        ", $gfm['timeofmessage'], $gfm['message']));
                                }
                                elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp3'){
                                    array_push($art, array($gfm['messageid'],"<div class='waex $waexspecial' id='".$gfm['messageid']."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
                        <div class='pcotm1 $errl audiopcotm' title='".$rrt."' style='float: $float; padding: 10px !important; $gb; $mexx'>
                        $ra
                        <div class='audio_demo'>
                        <div class='play_button'><i class='fas fa-play'></i>
                        <input type='hidden' value='http://".$_SERVER['SERVER_NAME'].":8080/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".mp3'>
                        </div>
                        <div class='seek_line'>
                        <div class='tow_th_poiter'>
                        <div class='progressline'>
                        <div class='smallcircleinside' draggable></div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='mfl' style='padding-top: 3px; padding-left: 20px;'>
                <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                    <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                    <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                    </div>
                        </div>
                        <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                    \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                    <i class='fas fa-reply'></i>
                    </div>
                        
                        <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                        </div>
                        ", $gfm['timeofmessage'], $gfm['message']));
                                }
                                else {
                                    array_push($art, array($gfm['messageid'],"<div class='waex $waexspecial' id='".$gfm['messageid']."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
                                    <div class='pcotm1 $errl pcotm1special' title='".$rrt."' style='float: $float; $gb; $mexx'>
                                    $ra
                                    <div class='file_etype' onclick='download(\"".$gfm['messageid']."/".$oqx[$i]."\")'><i class='fas fa-file-download'></i>
                                    <span class='file_ext' style='
                                    font-size: 11px; padding-left: 3px; font-family: helvetica;'>".strtoupper(pathinfo($oqx[$i], PATHINFO_EXTENSION))." FILE</span>
                                    </div>
                                    <div class='mfl' style='padding-top: 3px;'>
                            <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                                <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                                </div>
                                    </div>
                                    <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                                \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                                <i class='fas fa-reply'></i>
                                </div>
                                    
                                    <div class='m_options' style='display: none'><div class='mm_options'></div>
                                    </div>
                                    </div>
                                    ", $gfm['timeofmessage'], $gfm['message']));
                                }
                            }
                        }
                    }
                        $chd = chdir($cd);
                }
            }
            else {
                    $gmsg = str_replace('/ampersandsymbol/', '&', $gfm['message']);
                    array_push($art, array($gfm['messageid'],"<div class='waex' id='".$gfm['messageid']."' style='float: $float;' aria-label='".$gfm['timeofmessage']."'>
                    <div class='pcotm1 $errl' title='".$rrt."' style='float: $float; $gb; $mexx'>
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
                        </div></div>", $gfm['timeofmessage'], $gfm['message']));
                        $bi.=" AND messageid != '".$gfm['messageid']."'";  
        }
    }
}
}
}
echo json_encode($art);
/*$biit = (int) $_POST['pr'] + 1;
echo "<input type='hidden' id='biit".$biit."' value='".enc($bi)."'>";
*/
    $user = $_POST['mnm'];

}
if(isset($_GET['gun']) && isset($_GET['gfn'])){
    $usr = $_GET['gfn'];
    $gtfi = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $ctm = strtotime(date("Y-m-d H:i:s")."-50 second");
    if($gtfi['lastactivitytime'] > $ctm){
        $online = 'Online';
    }
    else {
            if($gtfi['lastactivitytime'] > strtotime("today")){    
                $online = 'Last Seen: Today at '.date("h:i a", $gtfi['lastactivitytime']);
    }
    elseif(strtotime('yesterday') < $gtfi['lastactivitytime'] && $gtfi['lastactivitytime'] < strtotime('Today'))
    {
        $online = 'Last seen: Yesterday at '.date("h:i a", $gtfi['lastactivitytime']);
    }
    else {
        $online = 'Last Seen: '.date("m-d h:i a", $gtfi['lastactivitytime']);
    }
}
    echo "<div class='gnmb'>$online</div>";
}
if(isset($_POST['msgid'])){
    $id = $_POST['msgid'];
    queryMysql("DELETE FROM messagesbase WHERE id='$id'");
}
if(isset($_POST['clearforuser']) && isset($_POST['mesgid'])){
    
}
if(isset($_GET['username']) && isset($_GET['groupid'])){
    $username = $_GET['username'];
    $id = $_GET['groupid'];
    $ltm = sanitizeString($_GET['ltm']);
    $mfg = queryMysql("SELECT * FROM groupmessages WHERE groupid='$id'");
    if($mfg->num_rows == 0){
        $report = "<div class='nmof'>No Message on Group.</div>
        <input type='hidden' value='yxip0293msi3902nujxiw0nxi200nsn20'>";
    }
    else {
        $report = "";
        $mfg = queryMysql("SELECT * FROM groupmessages WHERE (groupid='$id') AND timeofmessage > $ltm");
        while($ggm = mysqli_fetch_assoc($mfg)){
            if($ggm['user'] == $username){
                $mexx = "background-color: #147efb; color: white;";
                $float = "right";
                $distance = "";
                global $float;
                $btck = "<i class='fas fa-check'></i>'";
                $errl = 'q_rsset';
            }
            elseif($ggm['user'] == 'sp'){
                $mexx = '';
                $float = "; margin-left:auto; margin-right:auto;";
                $btck = "";
                $errl = '';
            }
            else {
                $mexx = '';
                $btck = "";
                $float = "";
                global $float;
                $errl = 'q_lsset';
            }
            if($ggm['user'] == 'sp'){
                $reply = "";
            }
            else {
                $reply = "<i class='fas fa-reply'></i>";
            }
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$ggm['user'].'/'.$ggm['user'].".png")){ 
                $img =  '../../../../../students_connect_hidden/users_profile_upload/'.$ggm['user'].'/'.$ggm['user'].'.png';
                }
                elseif($ggm['user'] == 'sp'){
                    $img = "";
                }
                else {
                    $img =  '../user.png';
                }
                if($ggm['user'] == 'sp'){
                    $guser = "";
                }
                elseif($ggm['user'] == $username) {
                    $guser = '';
                }
                else {
                   $guser = "<i class='fas fa-at'></i>".$ggm['user'];
                }
                $gae = mysqli_fetch_array(queryMysql("SELECT * FROM groupmessages WHERE id='".$ggm['replying']."'"));
                if($gae['replying'] == 0){
                    if(!empty($gae['message'])){
                        $iu = $gae['user'];
                        $cl = 'color: green';
                        $po = 'no_po_oo';
                        if($gae['user'] == $username){
                            $iu = 'You';
                            $cl = 'color: orange';
                            $po = 'p__o_o';
                        }
                    $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                    ': $gae['message'];
                    $ra = "<div class='trmbx $po'>
                    <a href='#".$gae['id']."'>
                    <div class='m_iinit' style='$cl'>".$iu."</div>
                    <div class='strmsg' id='tstrmsg'>".strip_tags($x)."</div></a></div>";
                }
                else {
                    $ra = "";
                }
                }
                else {
                    if(!empty($gae['message'])){
                        $iu = $gae['user'];
                        if($gae['user'] == $username){
                            $iu = 'You';
                        }
                        $x = strlen($gae['message']) > 15 ? substr($gae['message'], 0, 15).'&hellip;
                        ': $gae['message'];
                        $ra = "<div class='trmbx $po'>
                        <a href='#".$gae['id']."'>
                        <div class='m_iinit'>".$iu."</div>
                        <div class='strmsg' id='tstrmsg'>".strip_tags($x)."</div></a></div>";
                    }
                    else {
                        $ra = "";
                    }
                }
                $gmsg = str_replace('/ampersandsymbol/', '&', $ggm['message']);
            echo "<div class='waex' id='".$ggm['id']."' style='float: $float;'>
            <div class='pcotm1 $errl' style='float: $float;  $mexx'>
            $ra
            <div class='umpn' style=';' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
            <div class='mfl'>
            <div class='mgcont' id='msgco".$ggm['id']."'>
                ".nl2br(linkk($gmsg))."
                </div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                </div></div><div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
                $reply
                </div></div>";
            
        }
        echo "</div>";
    }
    echo "<div class='msgcontnt'>$report</div>";
}
if(isset($_GET['blx'])){
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
    $eeex = mysqli_num_rows($mecc);
    $lx = [];
    array_push($lx, $cntnm, $eeex);
    echo json_encode($lx);
}
if(isset($_POST['oop'])){
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $a = sanitizeString($_POST['a']);
    $b = sanitizeString($_POST['b']);
    $nmf = sanitizeString($_POST['mgm']);
    $nmu = $row['user'];
    $user = $row['user'];
    $fm = queryMysql("SELECT * FROM (SELECT * FROM messages WHERE sender='$nmu' AND receiver='$nmf' OR sender='$nmf' AND receiver='$nmu' ORDER BY messageid DESC LIMIT $a,$b) t1 ORDER BY t1.messageid ASC");
    if($fm->num_rows > 0){
        $report = "";
        $lastday = array();
        while($gfm = mysqli_fetch_assoc($fm)){
            array_push($lastday, $gfm['timeofmessage']);
            if(count($lastday)>1){
            $cld = (int) count($lastday) - 2;
            if(date("d", $lastday[$cld]) != date("d", $gfm['timeofmessage'])){
            if(isset($lastday[$cld+1])){
                $usetime = date("Y/m/d", $lastday[$cld+1]);
            }    
            else {
                $usetime = 'Today';
            }
            if(date("y m d", $lastday[$cld]) == date("y m d", strtotime('yesterday'))){
                    $usetime = 'Today';
            }
                echo "<div class='waexs'>
                <div class='pcotm1s'>".$usetime."</div></div>";
            }
            }
            if($gfm['sender'] == $nmu){
                //do nothing    
                }
                else{
                    queryMysql("UPDATE messages SET hasread=1 WHERE sender='$nmf' AND receiver='$nmu'");
                }
            $user = $row['user'];
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
                $img =  '../../../../../students_connect_hidden/users_profile_upload/'.$gfm['sender'].'/'.$gfm['sender'].'.png';
                }
                else {
                    $img =  '../user.png';
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
                if($gfm['hasfile'] == 1){
                    $cd = getcwd();
                    $olx = "../../students_connect_hidden/messages_uploads/".$gfm['messageid'];
                    $gmsg = str_replace('/ampersandsymbol/', '&', $gfm['message']);
                    if(file_exists($olx)){
                        $oqx = scandir($olx);
                        unset($oqx[0]);
                        unset($oqx[1]);
                        }
                        else {
                            $oqx = [];
                        }
                    if(!empty($oqx)){
                    $oqx = array_values($oqx);
                    for($i = 0; $i < count($oqx); $i++){
                        if(is_file($olx."/".$oqx[$i])){
                            if(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'png'){
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                    $ra
                    <div class='pl_eeimg' style='background-image:url(\"/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".png\")'></div>
                    <img src='/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".png' alt='Images' class='tf_eeimg'>
                    <div class='mfl' style='padding-top: 3px;'>
            <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div>
                    </div>
                    </div>
                    ";
                            }
                            elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp4'){
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                    $ra
                    <video style='opacity: 1' width='200' height='200' controls>
                    <source src='/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".mp4'>
                    </video>
                    <div class='mfl' style='padding-top: 3px;'>
            <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                    </div>
                    ";
                            }
                            elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp3'){
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl audiopcotm' style='float: $float; padding: 10px !important; $gb; $mexx'>
                    $ra
                    <div class='audio_demo'>
                    <div class='play_button'><i class='fas fa-play'></i>
                    <input type='hidden' value='http://".$_SERVER['SERVER_NAME'].":8080/students_connect_hidden/messages_uploads/".$gfm['messageid']."/".$i.".mp3'>
                    </div>
                    <div class='seek_line'>
                    <div class='tow_th_poiter'>
                    <div class='progressline'>
                    <div class='smallcircleinside' draggable></div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class='mfl' style='padding-top: 3px; padding-left: 20px;'>
            <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                    </div>
                    ";
                            }
                            else {
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                                <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                                $ra
                                <div class='file_etype' onclick='download(\"".$gfm['messageid']."/".$oqx[$i]."\")'><i class='fas fa-file-download'></i>
                                <span class='file_ext' style='
                                font-size: 11px; padding-left: 3px; font-family: helvetica;'>".strtoupper(pathinfo($oqx[$i], PATHINFO_EXTENSION))." FILE</span>
                                </div>
                                <div class='mfl' style='padding-top: 3px;'>
                        <div class='mgcont' id='msgco".$gfm['messageid']."'>".nl2br(linkk($gmsg))."</div>
                            <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                            <div class='tms'>".date('h:i a', $gfm['timeofmessage'])."</div>
                            </div>
                                </div>
                                <div class='replymessage' onclick='replyMessage(\"".$gfm['messageid']."\",
                            \"".$gfm['sender']."\", document.getElementById(\"msgco".$gfm['messageid']."\").innerHTML);'>
                            <i class='fas fa-reply'></i>
                            </div>
                                
                                <div class='m_options' style='display: none'><div class='mm_options'></div>
                                </div>
                                </div>
                                ";
                            }
                        }
                        }
                    }
                    
                    $chd = chdir($cd);
            }
            else {
            $gmsg = str_replace('/ampersandsymbol/', '&', $gfm['message']);
            echo "<div class='waex' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float;'>
            <div class='pcotm1 $errl' style='float: $float; $gb; $mexx'>
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
    }
}
?>
