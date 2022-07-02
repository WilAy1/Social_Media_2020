<?php
if(!session_start()){
    session_start();
}
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['viewing']) && isset($_GET['viewer'])){
        $v = sanitizeString($_GET['viewing']);
        $u = sanitizeString($_GET['viewer']);
        $fl = queryMysql("SELECT * FROM followstatus WHERE friend='$v'");
        if($fl->num_rows == 1){
            $io = mysqli_num_rows($fl)." person";
        }
        elseif($fl->num_rows == 0){
            $io = 'No follower';
        }
        else {
            $io = mysqli_num_rows($fl)." persons";
        }
        echo "<div class='tfolpage'>
        <div class='f_nbprs'>Followers: ".$io."</div>";
        $efl = queryMysql("SELECT * FROM followstatus WHERE friend='$v' AND user='$u'");
        if($efl->num_rows){
            $cme =mysqli_fetch_array($efl);
            echo "<div class='theusrinf'>
            <div class='fr_each'>
            <a href='/students_connect/user/".$u."'>
            <div class='r_fullnm'>
            <div class='r_name'>
            You</div>
            <div class='r_user'><i class='fas fa-at'></i>".$u."</a></div>
            </div></div>
            </div>";
        }
        while($gfl = mysqli_fetch_array($fl)){
            $fu = $gfl['user'];
            $ed = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$fu'"));
            $uver = queryMysql("SELECT * FROM followstatus WHERE user='$u' AND friend='$fu'");
            $cver = queryMysql("SELECT * FROM followstatus WHERE user='$fu' AND friend='$u'");
            if($cver->num_rows){
                $mx = '<div class="flws_you">Follows you</div>';
            }
            else {
                $mx = "";
            }
            $tt = queryMysql("SELECT * FROM blocked WHERE user='$u' AND touser = '$fu'");
            if($ed['user'] !== $u){
            if($tt->num_rows==0){
            if($uver->num_rows){
                $ts = 'Unfollow';
            }
            else {
                $ts = 'Follow';
            }
        }
        else {
            $ts = 'Blocked';
        }
            $td = getcwd();
            chdir("../../students_connect_hidden/users_profile_upload/".$ed['user'].'/');
            if(file_exists($ed['user'].".png")){ 
              $img =  '/students_connect_hidden/users_profile_upload/'.$ed['user'].'/'.$ed['user'].'.png';  
            }
              else {
                chdir($td);
                  $img =  '/students_connect/user.png';
              }
            chdir($td);
            echo "
            <div class='theusrinf'>
            <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' name='fuser' value='".$ed['user']."'/>
            <input type='hidden' name='user' value='".$u."'/>
            <button class='rf_xoop'>".$ts."</button></div>
            <div class='rf_erx'>
            <div class='rf_tdrbtn'><i class='extx fas fa-ellipsis-v'></i>
            </div>
            <div class='axop' style='display: none;'>
            <div class='rf_view'><a href='/students_connect/user/".$ed['user']."'>View Profile</a></div>
            <div class='rf_msg'>
            <form method='post' action='/students_connect/messages/'>
            <input type='hidden' name='name' value='".$u."'>
            <input type='hidden' name='fname' value='".$ed['user']."'/>
            <button type='submit' style='background: transparent; border: none; color: inherit;'>
            Message </button></form>
            </div>
            </div>
            </div>
            </div>
            <div class='fr_each'>
            <a href='/students_connect/user/".$gfl['user']."'>
            <div class='r_img' style='background-image: url(\"".$img."\")'></div>
            <div class='r_fullnm'>
            <div class='r_name'>
            ".$ed['firstname']." ".$ed['surname']."</div>
            <div class='r_user'><i class='fas fa-at'></i>".$ed['user']."</a></div>
            </div></div>
            $mx
            </div>
            ";
        }
    }
        echo "</div>";
    }
    if(isset($_GET['rviewing']) && isset($_GET['rviewer'])){
        $v = sanitizeString($_GET['rviewing']);
        $u = sanitizeString($_GET['rviewer']);
        $fl = queryMysql("SELECT * FROM followstatus WHERE user='$v'");
        if($fl->num_rows == 1){
            $io = mysqli_num_rows($fl)." person";
        }
        elseif($fl->num_rows == 0){
            $io = 'No follower';
        }
        else {
            $io = mysqli_num_rows($fl)." persons";
        }
        echo "<div class='tfolpage'>
        <div class='f_nbprs'>Following: ".$io."</div>";
        $efl = queryMysql("SELECT * FROM followstatus WHERE friend='$u' AND user='$v'");
        if($efl->num_rows){
            $cme =mysqli_fetch_array($efl);
            echo "<div class='theusrinf'>
            <div class='fr_each'>
            <a href='/students_connect/user/".$u."'>
            <div class='r_fullnm'>
            <div class='r_name'>
            You</div>
            <div class='r_user'><i class='fas fa-at'></i>".$u."</a></div>
            </div></div>
            </div>";
        }
        while($gfl = mysqli_fetch_array($fl)){
            $fu = $gfl['friend'];
            $tt = queryMysql("SELECT * FROM blocked WHERE user='$u' AND touser = '$fu'");
            $ed = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$fu'"));
            $uver = queryMysql("SELECT * FROM followstatus WHERE user='$u' AND friend='$fu'");
            if($ed['user'] !== $u){
                $tt = queryMysql("SELECT * FROM blocked WHERE user='$u' AND touser = '$fu'");
                if($tt->num_rows==0){
            if($uver->num_rows){
                $ts = 'Unfollow';
            }
            else {
                $ts = 'Follow';
            }
        }
        else {
            $ts = 'Blocked';
        }
            $cver = queryMysql("SELECT * FROM followstatus WHERE user='$fu' AND friend='$u'");
            if($cver->num_rows){
                $mx = '<div class="flws_you">Follows you</div>';
            }
            else {
                $mx = "";
            }
            $td = getcwd();
            chdir("../../students_connect_hidden/users_profile_upload/".$ed['user'].'/');
            if(file_exists($ed['user'].".png")){ 
              $img =  '/students_connect_hidden/users_profile_upload/'.$ed['user'].'/'.$ed['user'].'.png';  
            }
              else {
                chdir($td);
                  $img =  '/students_connect/user.png';
              }
            chdir($td);
            echo "
            <div class='theusrinf'>
            <div class='rf_touch' style='float: right;'>
            <div class='flwxfrm'>
            <input type='hidden' name='fuser' value='".$ed['user']."'/>
            <input type='hidden' name='user' value='".$u."'/>
            <button class='rf_xoop'>".$ts."</button></div>
            <div class='rf_erx'>
            <div class='rf_tdrbtn'><i class='extx fas fa-ellipsis-v'></i>
            </div>
            <div class='axop' style='display: none;'>
            <div class='rf_view'><a href='/students_connect/user/".$ed['user']."'>View Profile</a></div>
            <div class='rf_msg'>
            <form method='post' action='/students_connect/messages/'>
            <input type='hidden' name='name' value='".$u."'>
            <input type='hidden' name='fname' value='".$ed['user']."'/>
            <button type='submit' style='background: transparent; border: none; color: inherit;'>
            Message </button></form>
            </div>
            </div>
            </div>
            </div>
            <div class='fr_each'>
            <a href='/students_connect/user/".$gfl['friend']."'>
            <div class='r_img' style='background-image: url(\"".$img."\")'></div>
            <div class='r_fullnm'>
            <div class='r_name'>
            ".$ed['firstname']." ".$ed['surname']."</div>
            <div class='r_user'><i class='fas fa-at'></i>".$ed['user']."</a></div>
            </div></div>
            $mx
            </div>
            ";
        }
        echo "</div>";
    }
}
?>