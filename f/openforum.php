<?php
define("fe", "/Users/wilay/students_connect/");
    require_once fe."connect.php";
    require_once fe."f/submitposts.php";
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
            $gb = "";
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
        $gb= '(Admin)';
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
            <div class='tfjgrp' id='tfjgrp' onclick='joforum("$fid", "$user")'>
            Join Forum
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
        <div class='tfobdy'>
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
    echo "
        </div>
        </div>";
    if(isset($_POST['fid']) && isset($_POST['user'])){
        $id = 0;
        $fid = sanitizeString($_POST['fid']);
        $time = time();
        $tfuser = sanitizeString($_POST['user']);
        $x = mysqli_fetch_array(querymysql("SELECT * FROM forums WHERE id='$fid'"));
        $px = (int) ++$x['numberofmembers'];
        queryMysql("UPDATE forums SET numberofmembers='$px' WHERE id='$fid'");
        queryMysql("INSERT INTO forummembers VALUES('$id', '$fid', '$tfuser', 
                   '0', '$time', '1')");
    }
?>
