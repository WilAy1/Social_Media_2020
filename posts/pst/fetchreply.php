<?php
    define("m", "/Users/wilay/students_connect/");
    require_once m."/comment/replycomments/replyreplies/index.php";
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['c']) && isset($_GET['p'])){
    $cmtid = $_GET['c'];
    $postid = $_GET['p'];
    $replyeducomment = queryMysql("SELECT * FROM replyeducomments WHERE postid='$postid' AND cmtid='$cmtid' ORDER BY timeofreply DESC");
    while($getreplyeducomment = mysqli_fetch_array($replyeducomment)){
        $aus = $getreplyeducomment['user'];
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
        $tor = date("Y M d ' H: i a", $getreplyeducomment['timeofreply']);        
        if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){ 
            $pimg =  '/students_connect_hidden/users_profile_upload/'.$upc['user'].'/'.$upc['user'].'.png';
            }
            else {
                $pimg =  '/students_connect/user.png';
            }
            $rid = $getreplyeducomment['id'];
            $getreplyn = queryMysql("SELECT * FROM replyreplieseducomments WHERE postid='$postid' AND cmtid='$cmtid' AND replyid='$rid'");
                if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='openReplyRepliesContent(\"".$getreplyeducomment['id']."\", \"".$getreplyeducomment['cmtid']."\", \"".$getreplyeducomment['postid']."\")'
                     id='dbsbr".$getreplyeducomment['id']."' >View ".$p."
                     ".$r."</button></div>
                     <div class='dsplrprp' id='dsplrprp".$getreplyeducomment['id']."'></div>";
                  }
        echo "<div class='shwrep' id='r".$getreplyeducomment['id']."'>
            <div style='display: flex;'><div class='phead imgapstr' style='
            background-image: url(\"".$pimg."\");'></div>
            <div class='cmtrsnm' style='padding-left: 9px; 
            margin-top: auto; margin-bottom: auto;'>
            <a href='/students_connect/user/".$upc['user']."'><i></i>".$upc['surname']." ".$upc['firstname']."</a></div></div>
            <div class='rpit'>
            ".$getreplyeducomment['reply']."</div>
            <div class='tor posted i_posted'>".$tor."</div>
            <div class='repund'><div class='upvr wao'><i class='fas fa-caret-up'></i></div>
            <div class='dwvr wao'><i class='fas fa-caret-down'></i></div>
            <div class='repr wao' onclick='rrr(\"".$getreplyeducomment['id']."\")'><i class='fas fa-reply'></i></div>
            <div class='upvr wao'>Report</div>
            </div>
            <div class='adreprep' id='reprep".$getreplyeducomment['id']."' style=' display: none;'>
            <form action='#r".$getreplyeducomment['id']."' method='POST'>
            <div class='fto' style='display: inline-flex;'>
            <textarea id='replyrpst".$getreplyeducomment['id']."' class='ler_rr' name='cmtreplyreplyedupst' placeholder='Reply...' value='' title='Input Reply' rows='2' style='margin: 0px; border-radius:10px; resize: none;' wrap: hard;'></textarea></div>
            <div class='gee' style='vertical-align: middle; padding-left: 5px;
            padding-top: 10px; display: inline-block;'><label for='senreprepdbutton".$getreplyeducomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
            </div>
            <input type='hidden' name='rpostid' value='".$getreplyeducomment['postid']."'>
            <input type='hidden' name='rcmtid' value='".$getreplyeducomment['cmtid']."'>
            <input type='hidden' name='rid' value='".$getreplyeducomment['id']."'>
            <input type='submit' id='senreprepdbutton".$getreplyeducomment["id"]."' style='display: none !important'/>
            </form>
            </div>".$vpns."
            </div>";
     }
    }
if(isset($_GET['sc']) && isset($_GET['sp'])){
    $cmtid = $_GET['sc'];
    $postid = $_GET['sp'];
    $replysoccomment = queryMysql("SELECT * FROM replysoccomments WHERE postid='$postid' AND cmtid='$cmtid' ORDER BY timeofreply DESC");
    while($getreplysoccomment = mysqli_fetch_array($replysoccomment)){
        $aus = $getreplysoccomment['user'];
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
        $tor = date("Y M d  H: i a", $getreplysoccomment['timeofreply']);        
        if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){ 
            $pimg =  '/students_connect_hidden/users_profile_upload/'.$upc['user'].'/'.$upc['user'].'.png';
            }
            else {
                $pimg =  '/students_connect/user.png';
            }
            $rid = $getreplysoccomment['id'];
            $getreplyn = queryMysql("SELECT * FROM replyrepliessoccomments WHERE postid='$postid' AND cmtid='$cmtid' AND replyid='$rid'");
                if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='opensReplyRepliesContent(\"".$getreplysoccomment['id']."\", \"".$getreplysoccomment['cmtid']."\", \"".$getreplysoccomment['postid']."\")'
                     id='dbsbr".$getreplysoccomment['id']."' >View ".$p."
                     ".$r."</button></div>
                     <div class='dsplrprp' id='dsplrprp".$getreplysoccomment['id']."'></div>";
                  }
        echo "<div class='shwrep'>
            <div style='display: flex;'><div class='phead imgapstr' style='
            background-image: url(\"".$pimg."\");'></div>
            <div class='cmtrsnm' style='padding-left: 9px; 
            margin-top: auto; margin-bottom: auto;'>
            <a href='/students_connect/user/".$upc['user']."'><i></i>".$upc['surname']." ".$upc['firstname']."</a></div></div>
            <div class='rpit'>
            ".$getreplysoccomment['reply']."</div>
            <div class='tor posted i_posted'>".$tor."</div>
            <div class='repund'><div class='upvr wao'><i class='far fa-heart'></i></div>
            <div class='repr wao' onclick='rrr(".$getreplysoccomment['id'].")'><i class='fas fa-reply'></i></div>
            <div class='upvr wao'>Report</div>
            </div>
            <div class='adreprep' id='reprep".$getreplysoccomment['id']."' style=' display: none;'>
            <form action='#r".$getreplysoccomment['id']."' method='POST'>
            <div class='fto' style='display: inline-flex;'>
            <textarea id='replyrpst".$getreplysoccomment['id']."' class='ler_rr' name='scmtreplyreplysocpst' placeholder='Reply...' value='' title='Input Reply' rows='2' style='margin: 0px; border-radius:10px; resize: none;' wrap: hard;'></textarea></div>
            <div class='gee' style='vertical-align: middle; padding-left: 5px;
            padding-top: 10px; display: inline-block;'><label for='senreprepdbutton".$getreplysoccomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
            </div>
            <input type='hidden' name='srpostid' value='".$getreplysoccomment['postid']."'>
            <input type='hidden' name='srcmtid' value='".$getreplysoccomment['cmtid']."'>
            <input type='hidden' name='srid' value='".$getreplysoccomment['id']."'>
            <input type='submit' id='senreprepdbutton".$getreplysoccomment["id"]."' style='display: none !important'/>
            </form></div>".$vpns."
            </div>";
     }
    }    
    if(isset($_GET['rrc']) && isset($_GET['rp']) && isset($_GET['rc'])){
    $rid = $_GET['rrc'];
    $cmtid = $_GET['rc'];
    $postid = $_GET['rp'];
    $replyreducomment = queryMysql("SELECT * FROM replyreplieseducomments WHERE postid='$postid' AND cmtid='$cmtid' AND replyid='$rid' ORDER BY timeofreply DESC");
    while($getreplyreducomment = mysqli_fetch_array($replyreducomment)){
        $aus = $getreplyreducomment['user'];
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
        $tor = date("Y M d ' H: i a", $getreplyreducomment['timeofreply']);        
        if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){ 
            $pimg =  '/students_connect_hidden/users_profile_upload/'.$upc['user'].'/'.$upc['user'].'.png';
            }
            else {
                $pimg =  '/students_connect/user.png';
            }

        echo "<div class='shwrep' id='rr".$getreplyreducomment['id']."'>
            <div style='display: flex;'><div class='phead imgapstr' style='
            background-image: url(\"".$pimg."\");'></div>
            <div class='cmtrsnm' style='padding-left: 9px; 
            margin-top: auto; margin-bottom: auto;'>
            <a href='/students_connect/user/".$upc['user']."'><i></i>".$upc['surname']." ".$upc['firstname']."</a></div></div>
            <div class='rpit'>
            ".rhash($getreplyreducomment['reply'])."</div>
            <div class='tor posted i_posted'>".$tor."</div>
            <div class='repund'><div class='upvr wao'><i class='fas fa-caret-up'></i></div>
            <div class='dwvr wao'><i class='fas fa-caret-down'></i></div>
            <div class='repr wao'><i class='fas fa-reply'></i></div>
            <div class='upvr wao'>Report</div>
            </div>
            </div>";
     }
    }
    if(isset($_GET['rrc']) && isset($_GET['rp']) && isset($_GET['rc'])){
    $rid = $_GET['rrc'];
    $cmtid = $_GET['rc'];
    $postid = $_GET['rp'];
    $replyreducomment = queryMysql("SELECT * FROM replyreplieseducomments WHERE postid='$postid' AND cmtid='$cmtid' AND replyid='$rid' ORDER BY timeofreply DESC");
    while($getreplyreducomment = mysqli_fetch_array($replyreducomment)){
        $aus = $getreplyreducomment['user'];
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
        $tor = date("Y M d ' H: i a", $getreplyreducomment['timeofreply']);        
        if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){ 
            $pimg =  '/students_connect_hidden/users_profile_upload/'.$upc['user'].'/'.$upc['user'].'.png';
            }
            else {
                $pimg =  '/students_connect/user.png';
            }

        echo "<div class='shwrep' id='rr".$getreplyreducomment['id']."'>
            <div style='display: flex;'><div class='phead imgapstr' style='
            background-image: url(\"".$pimg."\");'></div>
            <div class='cmtrsnm' style='padding-left: 9px; 
            margin-top: auto; margin-bottom: auto;'>
            <a href='/students_connect/user/".$upc['user']."'><i></i>".$upc['surname']." ".$upc['firstname']."</a></div></div>
            <div class='rpit'>
            ".rhash($getreplyreducomment['reply'])."</div>
            <div class='tor posted i_posted'>".$tor."</div>
            <div class='repund'><div class='upvr wao'><i class='fas fa-caret-up'></i></div>
            <div class='dwvr wao'><i class='fas fa-caret-down'></i></div>
            <div class='repr wao'><i class='fas fa-reply'></i></div>
            <div class='upvr wao'>Report</div>
            </div>
            </div>";
     }
    }
    if(isset($_GET['srrc']) && isset($_GET['srp']) && isset($_GET['src'])){
        $rid = $_GET['srrc'];
        $cmtid = $_GET['src'];
        $postid = $_GET['srp'];
        $replyreducomment = queryMysql("SELECT * FROM replyrepliessoccomments WHERE postid='$postid' AND cmtid='$cmtid' AND replyid='$rid' ORDER BY timeofreply DESC");
        while($getreplysoccomment = mysqli_fetch_array($replyreducomment)){
            $aus = $getreplysoccomment['user'];
        $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
            $tor = date("Y M d ' H: i a", $getreplysoccomment['timeofreply']);        
            if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png")){ 
                $pimg =  '/students_connect_hidden/users_profile_upload/'.$upc['user'].'/'.$upc['user'].'.png';
                }
                else {
                    $pimg =  '/students_connect/user.png';
                }
    
            echo "<div class='shwrep' id='rr".$getreplysoccomment['id']."'>
                <div style='display: flex;'><div class='phead imgapstr' style='
                background-image: url(\"".$pimg."\");'></div>
                <div class='cmtrsnm' style='padding-left: 9px; 
                margin-top: auto; margin-bottom: auto;'>
                <a href='/students_connect/user/".$upc['user']."'><i></i>".$upc['surname']." ".$upc['firstname']."</a></div></div>
                <div class='rpit'>
                ".rhash($getreplysoccomment['reply'])."</div>
                <div class='tor posted i_posted'>".$tor."</div>
                <div class='repund'><div class='upvr wao'><i class='far fa-heart'></i></div>
            <div class='repr wao'><i class='fas fa-reply'></i></div>
            <div class='upvr wao'>Report</div>
            </div>
                </div>";
         }
        }
?>