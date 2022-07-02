<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "submitposts.php";
    $usr = $_SESSION['user'];
    $mbi = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $mbi['user'];
    $flname = $mbi['firstname']." ".$mbi['surname'];
    $forum = mysqli_fetch_array(queryMysql("SELECT * FROM forums WHERE id='$fid'"));
    $forumname = $forum['nameofforum'];
    $fmotto = $forum['motto'];
    $fabout = $forum['about'];
    $fcb = $forum['createdby'];
    $fcbx = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$fcb."'"));
    $fcby = $fcbx['firstname'].' '.$fcbx['surname'];
    $fcbyt = date('Y M d h:i', $forum['created']);
    $cbn = $fcbx['user'];
    $uinf = queryMysql("SELECT * FROM forummembers WHERE user='$user' AND forumid='$fid' AND isacknoledged='1'");
    $ed = mysqli_fetch_array($uinf);
    if($uinf->num_rows){
        if($ed['positioninforum'] == 0){
            $x = "";
            $y = "";
            $z = "";
            $w = "";
            $gb = "";
            $fl = "float: right;";
        }
        else {
        $x = "
        <div class='fsts' title='Forum Members'>
        <i class='fas fa-cog foic'></i>
        <div class='npfforum eptx'>Forum settings</div>
        </div>";
        $y = "
        <div class='fsts' title='Change Forum DP'>
        <i class='fas fa-camera foic'></i>
        <div class='npfforum eptx'>Change DP</div>
        </div>";
        $z = "
        <div class='fsts' title='Change Forum Name'>
        <i class='fas fa-pen'></i><div class='npfforum eptx'>Change Forum Name</div>
        </div>";
        $w = "<div class='fsts' title='Verify Pending Members' 
        onclick='fvmbs(\"".$forum['id']."\")'>
        <i class='fas fa-user-plus'></i><div class='advrmbs eptx'>Verify Members</div>
        </div>";
        $gb='(Admin)';
        $fl = "";
    }

    echo <<<_END
            <div class='upifnm' id='tupifnm'>
            <div class='wmsg'>
            <div class='nwnlw'>
            $flname $gb,
            </div>
            </div>
            <div class='tgmn tfjgrp' style='border: none;' id='tfjgrp' onclick='ofmenu()'>
            <i class='fas fa-ellipsis-v'></i>
            </div>
            </div>
            <div class='ofmenu' id='ofmenu' style='display: none;'>
            <div class='mlsrt'>
            <div class='apinf' title='Add Post' onclick='nfpsh()'>
            <a href='#quest'><i class='fas fa-pen foic xpen'></i>
            <i class='fas fa-plus xplus'></i></a>
            <div class='npfforum eptx'>New Post</div>
            </div>
            <div class='vfpst eptx' title='View Post'>
            View Forum Posts
            </div>
            $z
            $y
            <div class='vfmbs' title='View Members'>
            <i class='fas fa-users foic'></i>
            <div class='npfforum eptx'>View Forum Members</div>
            </div>
            $x
            $w
            <div class='xoncli' onclick='forMenu()' style='$fl'>☰</div>
            </div>
            </div>
            <div class='fnpst' id='cfnpst' style='display: none'>
            <form action='' method='POST'>
            <div class='ftextpart'>
            <textarea class='tpsmt' name='forumpost'></textarea>
            </div>
            <div class='frmpt'>
            <label for='fileinp'><i class='fas fa-camera'></i></label>
            <input type='file' style='display:none' name='fimgs[]' multiple>
            <label for='tfpst'>Tag Post</label>
            </div>
            <div class='fosubm'>
            <input type='hidden' name='psby' value='$user'>
            <input type='hidden' name='tfid' value='$fid'>
            <button type='submit' name='sbtn'>Submit</button>
            </div>
            </form>
            </div>
            <div class='fsmenu' id='fsMenu' style='display: none; color: white;'>
            <div class='naoffthef' style='text-align: center; 
            margin-top: auto; margin-bottom: auto;'>$forumname</div>
            <hr>
            <div class='crclasop' onclick='classOp()'>Class
            <i class='far fa-caret-down xleep' style='float: right;'></i></div>
            <div class='oxex'><i class='fas fa-plus clplus'></i>
            Create Class
            </div>
            _END;
            $xlep = queryMysql("SELECT * FROM classes WHERE fid='$fid'");
            while($gx = mysqli_fetch_array($xlep)){
            echo "
            <div class='oxex'>".$xlep['nameofclass']."</div>";
            }
            echo '
            </div>';
        $dcd = getcwd();
    chdir("C:/Apache24/htdocs/students_connect_hidden/forum_profile_upload");
    if(file_exists($forum['id'].".png")){
        $fimg = $forum['id'].".png";
    }
    else {
        $fimg = "/students_connect/user.png";
    }
    chdir($dcd);
    $fstat = queryMysql("SELECT * FROM forummembers WHERE forumid='$fid' AND isacknoledged='1'");
    $nif = mysqli_num_rows($fstat);
    if($nif == 0){
        $nfm = "";
    }
    elseif($nif > 0 && $nif < 1000){
        $nfm = $nif." members";
    }
    elseif($nif > 1000 && $nif < 10000){
        $nfm = substr($nif, 0, 1)."k members";
    }
    elseif($nif > 10000 && $nif < 100000){
        $nfm = substr($nif, 0, 2)."k members";
    }
    elseif($nif > 100000 && $nif < 1000000){
        $nfm = substr($nif, 0, 3)."k members";
    }
    elseif($nif > 1000000 && $nif < 10000000){
        $nfm = substr($nif, 0, 1)."M members";
    }
    $pstats = queryMysql("SELECT * FROM forumposts WHERE forumid='$fid'");
    $nof = mysqli_num_rows($pstats);
    if($nof == 0){
        $nfp = "";
    }
    elseif($nof > 0 && $nof < 1000){
        $nfp = $nof." posts";
    }
    elseif($nof > 1000 && $nof < 10000){
        $nfp = substr($nof, 0, 1)."k posts";
    }
    elseif($nof > 10000 && $nof < 100000){
        $nfp = substr($nof, 0, 2)."k posts";
    }
    elseif($nof > 100000 && $nof < 1000000){
        $nfp = substr($nof, 0, 3)."k posts";
    }
    elseif($nof > 1000000 && $nof < 10000000){
        $nfp = substr($nof, 0, 1)."M posts";
    }
    echo <<<_END
        <div class='tfobdy' id='tfobdy'>
        <div class='tfprpt'>
        <div class='frimg' style='background-image: url("$fimg")'></div>
        <div class='frmname'>$forumname</div>
        <div class='frmmotto'>$fmotto</div>
        <div class='frmabt'>$fabout</div>
        </div>
        <div class='fstats'>
        <div class='fcrby'>Created By <a href='/students_connect/user/$cbn'>$fcby</a> on $fcbyt</div>
        <div class='separator'>
        <i class='fas fa-dot-circle'></i>
        </div>
        <div class='nffmbs'>$nfm</div><div class='separator'>
        <i class='fas fa-dot-circle'></i>
        </div>
        <div class='nfffpst'>$nfp</div>
        </div>
        <div class='fpsts'>
_END;
if(!isset($_GET['pid'])){
    require_once "posts.php";
    }
        echo '</div></div>';
}
else {
    $eaxy = queryMysql("SELECT * FROM forummembers WHERE user='$user' AND forumid='$fid' AND isacknoledged='0'");
    if($eaxy->num_rows){
        echo <<<_END
            <div class='upifnm' id='tupifnm'>
            <div class='wmsg'>
            <div class='nwnlw'>
            Welcome $flname,
            </div>
            </div>
            <div class='tfjgrp' id='tfjgrp'>
            Request Sent...
            </div>
            </div>
        _END;
    }
    else {
        echo <<<_END
            <div class='upifnm' id='tupifnm'>
            <div class='wmsg'>
            <div class='nwnlw'>
            Welcome $flname,
            </div>
            </div>
            <div class='tfjgrp' id='tfjgrp' onclick='jcforum("$fid", "$user")'>
            Request to Join
            </div>
            </div>
        _END;
    }
    $dcd = getcwd();
chdir("C:/Apache24/htdocs/students_connect_hidden/forum_profile_upload");
if(file_exists($forum['id'].".png")){
    $fimg = $forum['id'].".png";
}
else {
    $fimg = "/students_connect/user.png";
}
chdir($dcd);
    echo <<<_END
    <div class='tfobdy'>
    <div class='tfprpt'>
    <div class='frimg' style='background-image: url("$fimg")'></div>
    <div class='frmname'>$forumname</div>
    <div class='frmmotto'>$fmotto</div>
    <div class='frmabt'>$fabout</div>
    </div>
    _END;
    if($eaxy->num_rows){
        echo "<div class='intro'>
        <div class='tiacf' id='flisp'>Your request to join this forum has been sent.
         You will receive a notiification if you have been approved.
        </div>
        </div>";
    }
    else {
    echo "<div class='intro'>
    <div class='tiacf' id='flisp'>This is a closed school forum, click request to join.
    </div>
    </div>";
    }
}
if(isset($_POST['fid']) && isset($_POST['user'])){
    $id = 0;
    $fid = sanitizeString($_POST['fid']);
    $time = time();
    $tfuser = sanitizeString($_POST['user']);
    queryMysql("INSERT INTO forummembers VALUES('$id', '$fid', '$tfuser', 
               '0', '$time', '0')");
}
?>