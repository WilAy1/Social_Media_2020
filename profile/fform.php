 <?php
if(!isset($_SESSION)){
session_start();
}
    define("rexl", "/Users/wilay/students_connect/");
    require_once rexl."connect.php";
    if(isset($_POST['subfol'])){
        $usr = $_SESSION['user'];
        $ms = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
        $user = $ms['user'];
        $fried = $_POST['fuser'];
        $f = queryMysql("SELECT * FROM members WHERE user='$fried'");
        if($f->num_rows){
        $xf = mysqli_fetch_array($f);
        $friend = $xf['user'];
        $ve = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$friend'");
        if($ve->num_rows){
            queryMysql("DELETE FROM followstatus WHERE user='$user' AND friend='$friend'");
            echo "<i class='fas fa-user-plus icf'></i> Follow";
        }
        else{
        $type = "Following";
        $time = time();
        queryMysql("INSERT INTO followstatus VALUES('$user', '$type', '$friend', '$time')");
        $notlink = '/students_connect/user/'.$user;
        $hidenot = 0;
        $timeofnot = time();
        $notheading = '<b>New Follower</b>';
        $notcontent = '@'.$user.' started following you.';
        $id = 0;
        $i = 0;
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$friend', '$i', '$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')");
        echo "<i class='fas fa-user-plus icf'></i> ".$type;    
    }
}
else {
    echo "Follow";
}
}
?>