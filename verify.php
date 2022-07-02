<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once "connect.php";
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
$email = sanitizeString($_GET['email']);
$hash = sanitizeString($_GET['hash']);
$search = queryMysql("SELECT email, hash, active FROM members WHERE email='".$email."' AND hash='".$hash."'
   AND active='0'");
$match = $search ->num_rows;

if($search ->num_rows > 0){
    $ch = queryMysql("SELECT * FROM members WHERE  email='".$email."' AND hash='".$hash."'");
    if($ch->num_rows == 0){
        echo "No valid account";
    }
        else {
    $che = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE  email='".$email."' AND hash='".$hash."'"));
    $email = sanitizeString($_GET['email']);
    $hash = sanitizeString($_GET['hash']); 
    if($che['activatexpiretime'] >= time()) {
    queryMysql("UPDATE members SET active='1' WHERE email='".$email."'AND hash='".$hash."' AND active='0'");
    $fresh = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE email='$email'"));
    $user = $fresh['user'];
    $id = 0;
    queryMysql("INSERT INTO settings values('$id', '$user', '2', '1,0','1', '1', '1', '2', '1', '1,0', '1', '1', '1', '1', '1', '1', '1', '1', 'black')");
    $msg = "<h1>Welcome to ****</h1>
            <p>Hey there ".$user.", welcome to ****, 
            /-/ stories about the site.
            For more information click this
             <a href=\'/students_connect/help\' target=\'_blank\'>link</a></p>";
    $mtime = time();
    queryMysql("INSERT INTO messagesforusers VALUES('$user', '$msg', '$mtime')");
    $pc = $fresh['userprofilecode'];
    $gcd = getcwd();
        chdir($gcd."/user");
       mkdir($fresh['user']);
       $f = fopen($fresh['user'].'/index.php', "w");
       $iam = '$iam';
       fwrite($f, "
       <?php
       ".$iam." = '".$fresh['user']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'profile/index.php';
    ?>");
    fclose($f);
    chdir($gcd);
    chdir('../students_connect_hidden/users_profile_upload/');
    mkdir($fresh['user']);
    chdir($gcd);
    echo "<div class='registration_welcome'><div class='congrats'>Congratulations.</div>You have successfully joined Studco. We hope you enjoy your time with us</div>
    <div class='redirect notice'>You will be redirected to the main page in 10 seconds</div>
    <script>
            function Redirect() {
                window.location='login.php';
            }
            setTimeout('Redirect()', 10000)</script>";
}
else {
    echo "Link has expired, you have to signup again";
    queryMysql("DELETE FROM members where email='".$email."' AND hash='".$hash."'");
}
    }
}
else {
    echo "The url is invalid or account has already been activated";
}
}
else {
    echo "Use the link that has been sent to your email";
}
?>