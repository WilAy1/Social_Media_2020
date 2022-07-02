<?php
    require_once "/Users/wilay/students_connect/connect.php";
    session_start();
    if (isset($_SESSION['user']))
      {
        $tuser = $_SESSION['user'];
        $ohl = mysqli_fetch_array(queryMysql("SELECT user FROM members WHERE user='$tuser'"));
        $user = $ohl['user'];
        $loggedin = TRUE;
        $userstr  = $user;
      }
      else $loggedin = FALSE;
    if(!$loggedin)
    { die("<script>
    function Redirect() {
        window.location='../students_connect/login.php';
    }
    setTimeout('Redirect()', 1)</script>");
    }
    else {
        if(!empty($_POST['pst']) && ($_SESSION['user'] == sanitizeString($_POST['usr']))){
            $pstcont = sanitizeString($_POST['pst']);
            $id = sanitizeString($_POST['id']);
            $ptype = sanitizeString($_POST['type']);
            $r = sanitizeString($_POST['r']);
            $mtk = mysqli_fetch_array(queryMysql("SELECT * from members WHERE user='".$_SESSION['user']."'"));
            $user = $mtk['user'];
            if($ptype == 'sc'){
                $ptype = 'socposts';
            }
            else if($ptype == 'c') {
                $ptype = 'eduposts';
            }
            $rp = mysqli_fetch_array(queryMysql("SELECT * FROM $ptype WHERE id='".$id."'"));
            if($rp['isshare'] == '0'){
                queryMysql("UPDATE $ptype SET pstcont='".$pstcont."' WHERE id='".$id."' AND user='".$user."'");
            }
            else if ($rp['isshare'] == '1'){
                queryMysql("UPDATE $ptype SET sharedpstcont='".$pstcont."' WHERE id='".$id."' AND sharedby='".$user."'");
            }

    }
    }
?>