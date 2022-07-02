<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
if(isset($_POST['name']) && isset($_POST['fname'])){
    $nmf = $_POST['fname'];
    $nmu = $_POST['name'];
    $mo = queryMysql("SELECT * FROM members WHERE user='".$nmf."'");
    $moq = queryMysql("SELECT * FROM members WHERE user='".$nmu."'");
    if($mo->num_rows && $moq->num_rows){
    $gfi = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nmf'"));
    if(file_exists("../../students_connect_hidden/users_profile_upload/".$gfi['user'].'/'.$gfi['user'].".png")){ 
        $mfimg =  '../../../../../students_connect_hidden/users_profile_upload/'.$gfi['user'].'/'.$gfi['user'].'.png';
        }
        else {
            $mfimg =  '../user.png';
        }
        $gtfi = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nmf'"));
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
    $matt = 'disp';
    echo "<div class='nbdye'>
    <div class='uprt'>
    <div class='bckar' onclick='window.location.href=\"/students_connect/messages\"'><i class='fas fa-arrow-left'></i></div>
    <div class='wgmht' style='cursor: pointer;' onclick='document.getElementsByClassName(\"mg_xtended1\")[0].style.display=\"block\";'>
    <div class='gric' style='background-image: url(\"$mfimg\"); height: 30px; width: 30px;
    background-repeat: no-repeat; background-size: 100%; border-radius: 100%;'></div>
    <div class='speechless'>
    <div class='fnm'>".$gfi['firstname']. " " . $gfi['surname']."</div>
    <div class='cvro'><div class='gnmb'>$online</div></div>
    </div>
    </div>
    <div class='mg_xtended1' style='display: none;'>
    <div class='mg_xtended'>
    <div class='mg_moths' onclick='window.location.href = \"/students_connect/user/".$gfi['user']."\"'><i class='fas fa-user'></i> Profile</div>
    <div class='mg_sarch' onclick='document.getElementsByClassName(\"mg_an_ms\")[0].style.display = \"block\"; document.getElementsByClassName(\"nbdye\")[0].style.display = \"none\";'><i class='fas fa-search'></i> Search</div>
    <div class='mg_cancel' onclick='this.parentElement.parentElement.style.display = \"none\"'><i class='fas fa-times'></i> Cancel</div>
    </div>
    </div>
    </div>
    <input type='hidden' id='hvvvl' value='20,40'/>
    ";
    echo "<div class='phu'>";
    $fm = queryMysql("SELECT * FROM (SELECT * FROM messages WHERE sender='$nmu' AND receiver='$nmf' OR sender='$nmf' AND receiver='$nmu' ORDER BY messageid DESC LIMIT 20) t1 ORDER BY t1.messageid ASC");
    if($fm->num_rows == 0){
        $report = "<div class='nmof'>No message. Send a message to $nmf</div>";
        $btck = "";
    }
    else {
        $report = "";
        $lastday = array();
        $e = 0;
        while($gfm = mysqli_fetch_array($fm)){
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
            $user = $_POST['name'];
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
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
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
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
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
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
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
                                echo "<div class='waex $waexspecial' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float; margin: 0px;' aria-label='".$gfm['timeofmessage']."'>
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
            echo "<div class='waex' id='".$gfm['messageid']."' title='".$rrt."' style='float: $float;' aria-label='".$gfm['timeofmessage']."'>
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
        $e++;
    }
    }
    }
    $user = $_POST['name'];
    echo "
    <div class='newmesg'></div>
    <div class='flow_down' onclick='lo()' style='
    position: fixed; bottom: 50px; right: 25px; background: white;
    font-size: 20px; height: 30px; width: 30px; border-radius: 50%;
    display: none;'><i class='fas fa-angle-down' style='
    margin: auto;
    '></i>
    <span class='ejj3' style='display: none;'><i class='fas fa-circle' style='
    font-size: 10px;
    color: red;
    position: absolute;
    top: 20px;
    right: -3px'></i></span>
    </div>
    <div class='msgcontnt'>$report";
    $qrt = sanitizeString($_POST['ltm']);
    echo "<input type='hidden' id='tl_tm' value='".$qrt."'>
    <input type='hidden' value='".enc(" AND messageid != ''")."' id='biit0'>
    <input type='hidden' value='0' id='pr'>
    </div>
    </div>
    <div class='ptp'></div>
    <textarea type='text' id='cc' disabled style='top: -1000px; position: fixed;'></textarea>
    <div class='th_main_audio_player'><audio id='audioplayer' src='' preload='metadata'></audio></div>
    <div class='btmpt' style='bottom: 0; position:fixed;'>
    <div class='micox1' style='display: none'>
    <div class='micox'>
    <div class='mgx_f1nn' onclick='this.parentElement.parentElement.style.display = \"none\"'><i class='fas fa-microphone'></i> Record</div>
    <div class='mgx_f2nn' onclick='this.parentElement.parentElement.style.display = \"none\"'><label for='chsimg'><i class='fas fa-camera'></i> Media</label></div>
    <div class='mgx_f3nn' onclick='this.parentElement.parentElement.style.display = \"none\"'><i class='fas fa-times'></i> Cancel</div>
    </div>
    </div>
    <div class='fl_slctd'></div>
    <div class='replymessagecont' id='replymessage'
    style='bottom: 55px; left: 70px;
    width: 90%; min-height: 30px; max-height: 30px; vertical-align: middle;
    box-shadow: 1px 0px 2px 2px #ccc; border-radius: 50px;
    position: absolute; display: none;'></div>
    <div id='disfile'></div>
    <div class='msgfrmar'>
    <div class='plus mico'></div>
    <div class='cmra mico' onclick='document.getElementsByClassName(\"micox1\")[0].style.display = \"block\"'><i class='fas fa-plus'></i></div>
    <input type='file' onchange='crImg(e);' name='imgrvid' id='chsimg' style='display: none;' multiple/>
    <div class='msgbx'>
    <textarea id='mesgtxt' autofocus oninput='fsave(this.value)' onkeyup='fsave(this.value)' rows='2' 
    onload='ftx()'
    placeholder='Write Message' name='msgsnd'></textarea>
    <input type='hidden' id='eupqq' name='$user'>
    <input type='hidden' id='eupqe' name='$nmf'>
    <input type='hidden' id='fyww'>
    </div>
    <div class='sndmsgbtn mico' onclick='sndfMsg(document.getElementById(\"fyww\").value 
    ,\"".enc($user)."\", \"".enc($nmf)."\", document.getElementById(\"rmid\").value,
    document.getElementById(\"rplyto\").value, 
    document.getElementById(\"isfile\").value);' style='
    right: 6px;
    position: relative;
    bottom: 3px;
    '>
    <i class='fas fa-paper-plane' style='transform: rotateZ(45deg);'></i>
    </div>
    </div>
    </div>
    </div>
    <div class='mg_an_ms' style='display: none;'></div>
    </div>
    ";
}
else {
    echo "<div class='mg_unable'>
    <div class='mg_bclose'><i class='fas fa-times'></i></div>
    Unable to create Message. 
    <div class='mg_bgb'><a href='/students_connect/messages'>Go Back to Messages</a></div>
    <div class='mg_notused' style='display: none !important;'>
    <div id='replymessage'></div>
    <div id='disfile'></div>
    <input type='hidden' value='0' id='tl_tm'>
    <input type='hidden' value='0' id='pr'>
    <div class='flow_down'><div class='ejj3'></div></div>
    </div>
    </div>";
}
}
if(isset($_POST['username']) && isset($_POST['groupid'])){
    $username = $_POST['username'];
    $id = $_POST['groupid'];
    $grpdtls = queryMysql("SELECT * FROM selfgroups WHERE id='$id'");
    $ggrpdtls = mysqli_fetch_assoc($grpdtls);
    $dpp = queryMysql("SELECT * FROM groupmembership WHERE groupid='$id' AND user='$username' AND membership='1'");
    if($dpp->num_rows){
    $nmng = $ggrpdtls['numberofmembers'];
    if($nmng == 1){
        $nmng.= " member";
    }
    else {
        $nmng.= " members";
    }
    echo "<div class='nbdye'>
    <div class='uprt'>
    <div class='bckar' onclick='javascript:location = window.location.pathname'><i class='fas fa-arrow-left'></i></div>
    <div class='wgmht'>
    <div class='gric' style='background-image: url(\"../user.png\"); height: 40px; width: 40px;
    background-repeat: no-repeat; background-size: 100%; border-radius: 100%;'>
    </div>
    <div class='morning'>
    <div class='gnm'>".ucfirst($ggrpdtls['nameofgroup'])."</div>
    <div class='gnmb'>$nmng</div></div>
    ";
    $gdpp = mysqli_fetch_array($dpp);
    if($gdpp['isadmin'] == 1){
        echo "<div class='stgrp' style='
         margin-top: auto; margin-bottom: auto; 
         margin-left: auto;'>
         <div class='stnot'><input type='hidden' value='".$id."'><i class='far fa-bell'></i></div>
         <div class='stmgrp'>
         <input type='hidden' value='".$username."'>
         <input type='hidden' value='".$id."'>
         <i class='fas fa-cog'></i></div></div>";
    }
    echo "</div></div>";
    echo "<div class='spmsg'><div class='stinside'>".ucfirst($ggrpdtls['nameofgroup'])." was created by 
    <i class='fas fa-at'></i>".$ggrpdtls['creator']." at ".date("Y-m-d h:i a", $ggrpdtls['timeofcreation'])."</div></div>";
    if(strlen($ggrpdtls['description']) > 0){
        echo "<div class='grpdes'><div class='stinside'>Group Description: ".$ggrpdtls['description']."</div></div>";
    }
    else {
        echo "<div class='grpdes'><div class='stinside'>No Description</div></div>";
    }
    echo '<div class="phu">';
    $mfg = queryMysql("SELECT * FROM groupmessages WHERE groupid='$id'");
    if($mfg->num_rows == 0){
        $report = "<div class='nmof'>No Message on Group.</div>";
    }
    else {
        $report = "";
        while($ggm = mysqli_fetch_assoc($mfg)){
            $user = $_POST['username'];
            if($ggm['user'] == $user){
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
                $img =  '../../../../../students_connect_hidden/users_profile_upload/'.$gmm['user'].'/'.$ggm['user'].'.png';
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
                        if($gae['user'] == $user){
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
                        if($gae['user'] == $user){
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
                if($ggm['hasfile'] == 1){
                    $cd = getcwd();
                    $olx = "../../students_connect_hidden/group_uploads/".$ggm['id'];
                    $gmsg = str_replace('/ampersandsymbol/', '&', $ggm['message']);
                    $oqx = scandir($olx);
                    unset($oqx[0]);
                    unset($oqx[1]);
                    if(!empty($oqx)){
                    $oqx = array_values($oqx);
                    for($i = 0; $i < count($oqx); $i++){
                        if(is_file($olx."/".$oqx[$i])){
                            if(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'png'){
                                echo "<div class='waex $waexspecial' id='".$ggm['id']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                    <div class='umpn' style='$cl' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
                    $ra
                    <div class='pl_eeimg' style='background-image:url(\"/students_connect_hidden/group_uploads/".$ggm['id']."/".$i.".png\")'></div>
                    <img src='/students_connect_hidden/group_uploads/".$ggm['id']."/".$i.".png' alt='Images' class='tf_eeimg'>
                    <div class='mfl' style='padding-top: 3px;'>
            <div class='mgcont' id='msgco".$ggm['id']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div>
                    </div>
                    </div>
                    ";
                            }
                            elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp4'){
                                echo "<div class='waex $waexspecial' id='".$ggm['id']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                    <div class='umpn' style='$cl' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
                    $ra<video style='opacity: 1' width='200' height='200' controls>
                    <source src='/students_connect_hidden/group_uploads/".$ggm['id']."/".$i.".mp4'>
                    </video>
                    <div class='mfl' style='padding-top: 3px;'>
            <div class='mgcont' id='msgco".$ggm['id']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                    </div>
                    ";
                            }
                            elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp3'){
                                echo "<div class='waex $waexspecial' id='".$ggm['id']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                    <div class='pcotm1 $errl audiopcotm' style='float: $float; padding: 10px !important; $gb; $mexx'>
                    <div class='umpn' style='$cl' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
                    $ra
                    <div class='audio_demo'>
                    <div class='play_button'><i class='fas fa-play'></i>
                    <input type='hidden' value='http://".$_SERVER['SERVER_NAME'].":8080/students_connect_hidden/group_uploads/".$ggm['id']."/".$i.".mp3'>
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
            <div class='mgcont' id='msgco".$ggm['id']."'>".nl2br(linkk($gmsg))."</div>
                <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                </div>
                    </div>
                    <div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
                <i class='fas fa-reply'></i>
                </div>
                    
                    <div class='m_options' style='display: none'><div class='mm_options'></div></div>
                    </div>
                    ";
                            }
                            else {
                                echo "<div class='waex $waexspecial' id='".$ggm['id']."' title='".$rrt."' style='float: $float; margin: 0px;'>
                                <div class='pcotm1 $errl pcotm1special' style='float: $float; $gb; $mexx'>
                                <div class='umpn' style='$cl' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
                                $ra
                                <div class='file_etype' onclick='download(\"".$ggm['id']."/".$oqx[$i]."\")'><i class='fas fa-file-download'></i>
                                <span class='file_ext' style='
                                font-size: 11px; padding-left: 3px; font-family: helvetica;'>".strtoupper(pathinfo($oqx[$i], PATHINFO_EXTENSION))." FILE</span>
                                </div>
                                <div class='mfl' style='padding-top: 3px;'>
                        <div class='mgcont' id='msgco".$ggm['id']."'>".nl2br(linkk($gmsg))."</div>
                            <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                            <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                            </div>
                                </div>
                                <div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
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
                $gmsg = str_replace('/ampersandsymbol/', '&', $ggm['message']);
                echo "<div class='waex' id='".$ggm['id']."' title='".$rrt."' style='float: $float;'>
                <div class='pcotm1 $errl' style='float: $float; $gb; $mexx'>
                <div class='umpn' style='$cl' onclick='opnfinf(\"".$username."\", \"".$gae['user']."\")'>".$guser."</div>
                $ra
                <div class='mfl'>
                <div class='mgcont' id='msgco".$ggm['id']."'>".nl2br(linkk($gmsg))."</div>
                    <div class='btck' style='float: right; padding-left: 6px; font-size: 7px;'>$btck</div>
                    <div class='tms'>".date('h:i a', $ggm['timeofmessage'])."</div>
                    </div></div><div class='replymessage' onclick='replyGMessage(\"".$ggm['id']."\", \"".$ggm['user']."\", document.getElementById(\"msgco".$ggm['id']."\").innerHTML);'>
                    <i class='fas fa-reply'></i>
                    </div><div class='m_options' style='display: none'>
                    <div class='mm_options'></div>
                    </div></div>";
                
        }
    }
    }
    $lmfg = mysqli_fetch_array(queryMysql("SELECT * FROM groupmessages WHERE groupid='$id' ORDER BY timeofmessage DESC"));
    echo "<div class='newmesg'></div>
    <div class='msgcontnt'>$report";
    echo "<input type='hidden' id='tl_tm' value='".$lmfg['timeofmessage']."'>";
    echo "</div></div></div>
    <div class='ptp'></div>
    <div class='btmpt' style='bottom: 0; position:fixed;'>
    <div class='replymessagecont' id='replymessage'
     style='bottom: 55px; left: 70px;
    width: 645px; min-height: 30px; max-height: 30px; vertical-align: middle;
    box-shadow: 1px 0px 2px 2px #ccc; border-radius: 50px;
    position: absolute; display: none;'></div>
    <div id='disgfile'></div>
    <div class='msgfrmar'>
    <div class='plus mico'><i class='fas fa-plus'></i></div>
    <div class='cmra mico'><label for='chsimg'><i class='fas fa-camera'></i></label></div>
    <input type='file' onclick='crImg();' name='imgrvid' id='chsimg' style='display: none;'/>
    <div class='msgbx'>
    <textarea id='mesgtxt' rows='2' autofocus
    onload='ftx()'
    placeholder='Write Message' name='msgsnd'></textarea>
    </div>
    <div class='sndgmsgbtn mico'>
    <input type='hidden' value='".$username."'>
    <input type='hidden' value='".$id."'>
    <i class='fas fa-paper-plane'></i>
    </div>
    </div>
    </div>
    </div>
    ";
}
else {
    $id = sanitizeString($_POST['groupid']);
    $username = sanitizeString($_POST['username']); 
    $grpdtls = queryMysql("SELECT * FROM selfgroups WHERE id='$id'");
    $ggrpdtls = mysqli_fetch_assoc($grpdtls);
    echo '<div id="replymessage"></div><div id="disgfile"></div>
    <input id="mesgtxt" type="hidden">
    <div class="ol_e_st">Join Group</div>';
    if($ggrpdtls['type'] == 0){
    echo '
    <div class="cngrp"><div class="jgrp">
    <div class="nofgroup">'.$ggrpdtls['nameofgroup'].'</div>
    <div class="dofgroup">'.$ggrpdtls['description'].'</div>
    <div class="crtgat">Created by <i class="fas fa-at"></i>
    '.$ggrpdtls['creator'].' at: '.date('Y-m-d h:i a', $ggrpdtls['timeofcreation']).'</div>
    <div class="piknw">'.$ggrpdtls['numberofmembers'].' members</div>
    <div class="t_j_g_btns">
    <button class="joingroup" onclick="jgrp(\''.$username.'\', \''.$id.'\')">Join</button>
    <button class="j_cancel">Cancel</button></div></div></div>';
}
else {
    $k = queryMysql("SELECT * FROM groupmembership WHERE user='".$username."' AND membership='2'");
    if($k->num_rows){
        $alrt = '';
        echo '<div class="cngrp"><div class="jgrp">
    <div id="wpsrd" style="text-align: center;">Request sent<br/>You will receive a notification when added</div>
    <div class="nofgroup">'.$ggrpdtls['nameofgroup'].'</div>
    <div class="dofgroup">'.$ggrpdtls['description'].'</div>
    <div class="crtgat" style="text-align: center;">Created by '.$ggrpdtls['creator'].' at: '.date('Y-m-d h:i a', $ggrpdtls['timeofcreation']).'</div>
    ';
    /*<div class="grouppassword">
    <input type="password" id="pfgrp"/></div>
    */echo '</div></div>';
    }
    else {
        echo '<div class="cngrp"><div class="jgrp">
    <div id="wpsrd"></div>
    <div class="nofgroup">'.$ggrpdtls['nameofgroup'].'</div>
    <div class="dofgroup">'.$ggrpdtls['description'].'</div>
    <div class="crtgat" style="text-align: center;">Created by '.$ggrpdtls['creator'].' at: '.date('Y-m-d h:i a', $ggrpdtls['timeofcreation']).'</div>
    ';
    /*<div class="grouppassword">
    <input type="password" id="pfgrp"/></div>
    */echo '<div class="t_j_g_btns">
    <button class="joingroup" onclick="vpgrp(\''.$username.'\', \''.$id.'\');">Join</button>
    <button class="j_cancel">Cancel</button></div></div></div>';
    }
    $password = $ggrpdtls['grouppassword'];
    
}
}
}
?>
