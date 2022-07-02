<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
if(isset($_POST['type']) && isset($_POST['id'])){
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $type = sanitizeString($_POST['type']);
    $saveid = sanitizeString($_POST['id']);
    $cap = sanitizeString($_POST['cap']);
    $user  = $row['user'];
    $time = time();
    $id = 0;
    $splink = gen();
    $oe = queryMysql("SELECT * FROM saved WHERE splink='$splink'");
    if($oe->num_rows == 0){
        queryMysql("INSERT INTO saved VALUES('$id', '$user', '$type', '$saveid', '$cap', '$splink', '$time')");
        $gcd = getcwd();
       chdir("../\v");
       mkdir($splink);
       $f = fopen($splink.'/index.php', "w");
       if($type == 0 || $type == 1){
       if($type == 0){
        $ty = '';
       }
       elseif($type == 1) {
        $ty = 's';
       }
       fwrite($f, "
        <script>
        window.location.href = '../../posts/".$ty.$saveid."';
        </script>  
    ");
       }
       elseif($type == 2) {
        $le = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE messageid='".$saveid."'"));
        if($le['sender']==$user){
            $ko = $le['receiver'];
        }
        else {
            $ko = $le['sender'];
        }
        fwrite($f, "
        <script>
        window.location.href = '../../messages/?n=".$ko."';
        </script>  
    ");    
       }
       fclose($f);
    }
    else {
        $splink = gen();
        queryMysql("INSERT INTO saved VALUES('$id', '$user', '$type', '$saveid', '$cap', '$splink', '$time')");
    }
}
if(isset($_POST['i'])){
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $id = sanitizeString($_POST['i']);
    queryMysql("DELETE FROM saved WHERE id='$id'");
}
?>