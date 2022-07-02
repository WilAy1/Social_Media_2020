<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once "connect.php";
require_once "header.php";
if(isset($_GET['code']) && !empty($_GET['code'])){
    $verifycode = sanitizeString($_GET['code']);
    $search = queryMysql("SELECT verifycode, active FROM members WHERE
     verifycode='".$verifycode."' AND active='0'");
    $match = $search ->num_rows;

if($match > 0){
  $ch = queryMysql("SELECT activatetime, activatexpiretime FROM members"); 
    if($ch->num_rows == 0){
        echo "No valid account";
    }
        else {
          $che = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE verifycode='$verifycode' AND active='0'"));
    if($che['activatexpiretime'] >= time()) {
    queryMysql("UPDATE members SET active='1' WHERE verifycode='".$verifycode."' AND active='0'");
    $fresh = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE verifycode='$verifycode'"));
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
    queryMysql("DELETE FROM members where id='$id'");
        }
        }


}
else {
echo <<<_END
    <div class='ver_heading'> Account already created</div><div class='can_login_now'>Account has been previously activated. You can now login</div>

    <div class="login ver_side">
      <h2 id="login_1">Login</h2>

    <form method='post' action='login.php'>$error
    <label class='fieldname'>Username: </label><input type='text'
      maxlength='40' class="inputtext1" name='user' value='$user' autocomplete="true"><br><br>
    <label class='fieldname'> Password: </label> <input type='password'
      maxlength='100' class="inputtext1" name='pass' value='$pass'><br>
      <br>
      <div class="login_submit_button">
      <button type="submit" class="submit_reg2" name="submit_reg" id="submit_regid">Log In</button>
      </div>
      $msg
      </form>
          </div>
          
_END;
}
  }
else {
    echo "<div class='failed'>Verification code is not valid. Use the back button to go to previous page and retry</div>";
}
  ?>