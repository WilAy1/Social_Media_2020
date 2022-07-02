<?php
require_once "login_header.php";
$error = $user = $pass = "";
$msg = "";
if (isset($_POST['user'])) 
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if(isset($_POST['action'])){
        $action = '&action='.sanitizeString($_POST['action']);
    }
    else {
        $action = '';
    }
    if (empty($user && $pass))
    $error = "<span class='error'> *Input all fields</span><br>";
    else 
    {
        $result = queryMySQL("SELECT user, pass FROM members
        WHERE user = '$user' AND pass = '$pass'");
        $aed = mysqli_fetch_array($result);
        if ($result->num_rows == 0 || $aed['pass'] != $pass)
        {
            $error = "<span class='error'>Invalid username/password</span><br><br>";
        }
        else {
        $result = queryMysql("SELECT active FROM members WHERE active=0 AND user='$user'");
        if ($result ->num_rows){
                $error = "<span class='error'>*Please verify your email address</span><br>";
                $msg = "<br><div class='verify'>Check your inbox for verification message. If message not found in inbox check spam messages.</div>";
            }
        else {
            $lastlogin = time();
            $loginip = $_SERVER['REMOTE_ADDR'];
            $lgxptime = time() + (86400 *30*12);
            $update_time = queryMysql("UPDATE members SET lastlogin='$lastlogin' WHERE user='$user'");
            $_SESSION['user'] = $user;
            $ttime = time() + 3600 * 24 * 30*12;
            $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
            $psdhd =$row['psdhd'];
            $ste = $row['user'];
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryptionkey = "t/h/i/s/i/s/@/q/u/e/s/t";
            $encryption = openssl_encrypt($ste, $ciphering, $encryptionkey, $options,
                        $encryption_iv);
            setcookie('tid', $row['id'], $ttime);
            setcookie('tuname', $encryption, $ttime);
            setcookie('auth_t', $psdhd, $ttime);
            queryMysql("UPDATE members SET psdhd='$psdhd' WHERE user='$user'");
                if(isset($_POST['utm']) && !empty($_POST['utm'])){
                header("Location: ".$_POST['utm'].'?'.$action);
            }
            else {
                header("Location: h/index.php");
            }
            exit;
            }
        }       
        
        }           
    } 
    
$utm = "";
if(isset($_GET['utm'])){
    $utm = "<input type='hidden' name='utm' value='".$_GET['utm']."'>";
}
elseif(isset($_SERVER['HTTP_REFERER']) && ($_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF'])){
    $utm = "<input type='hidden' name='utm' value='".$_SERVER['HTTP_REFERER']."'>";
}
$username = "";
if(isset($_POST['user'])){
    $username = $_POST['user'];
}
$year = date("Y");
$ctz = enc('Cookie is working');
$tok = md5(rand(0, 99999));
if(isset($_GET['err'])){
    if($_GET['err'] == '1'){
        $error = '<div class="error">Account is not active. <a href="/students_connect/help/account">Learn more</a></div>';
    }
}
echo <<<_END
<div onload="" class="dark-mode" id='darkmd' style="min-height:650px;">
<div class="lgbdy">
<div class="login">
<div id="login_1" class='xfm_Hd' style='text-align: center;'>Login</div>
<div id='cookenable'></div>
<div class='login_frm'>
<form method='post' action='login.php' autocomplete="off">$error    
<div class='frus'>
    <!--<div class='uninlb'><label class='fieldname'>Username: </label></div>--><div class='unin'><input type='text'
      max='40' class="inputtext1" name='user' placeholder='username' value='$username' autocomplete="off"></div>
      </div><!--<div class="pwinlb"><label class='fieldname'> Password: </label></div>--> <div class="pwin"><input type='password'
      max='20' placeholder='password' id="ypass" class="inputtext1 ylpass" name='pass' value='' autocomplete="false" spellcheck="false"></div>
          <button type="button" id="showPassword3"><i class="far fa-eye-slash" onclick="showPass()" aria-hidden="true"></i></button>
        <button type="button" id="showPassword4" display="none"><i class="far fa-eye" onclick="showPass()" aria-hidden="true"></i></button>
        <div class="login_submit_button" id='sm_bt'>
        $utm
        <input type='hidden' name='token' value='$tok'>    
        <button type="submit" class="submit_reg2" id="submit_regid">Log In</button>
      </div>
      <div class='forgot_pass'><a href='forgotpass/?start&c=0'>Forgot Password?</a></div>
      $msg
      </form>
      </div>
          </div>
          </div>
          <footer class='ffooter' style='bottom: 0; position: relative;'>
<div class='ffooterb'>
<div class='help'><a href=''>Help</a></div>
<div class='stngs'><a href=''>Settings</a></div>
<div class='pvcy'><a href=''>Privacy</a></div>
<div class='siup'><a href='/students_connect/signup.php'>Sign Up</a></div>
</div>
<div class='ffooterx'>
<div class='sinoff'><a href='/students_connect/'>Quest</a> <span style='font-size: 15px;'>&copy;</span>$year</div>
</div>
</div>
          </footer>
<script>

    var c = navigator.cookieEnabled;
    if(c==false){
        document.getElementById('cookenable').innerHTML = '<div class=\'error\'>Cookies not enabled. Enable cookies to continue</div>';
        document.getElementsByClassName('submit_reg2')[0].setAttribute('disabled', 'disabled');
    }
    var q = new Date();
    document.cookie = 'cxtst=$ctz; expires='+q.constructor().substring(0, 3)+', '+q.getDate()+' '+q.getFullYear()+' 12:00:00; path=/';
    /*var et = document.cookie;
    var xet = et.split(";");
    var name = 'cxtst=';
    for(var i =0; i<xet.length; i++){
        var tc = xet[i];
        while (tc.charAt(0)==' ') tc = tc.substring(1);
        if (tc.indexOf(name) == 0){
            // don't do anything
        }
        else {
            document.getElementById('cookenable').innerHTML = '<div class=\'error\'>Failed to set cookies, cookies not enabled</div>';
        document.getElementsByClassName('submit_reg2')[0].setAttribute('disabled', 'disabled');    
        }
    }*/

window.onload = function(){
    window.history.replaceState("","", location.href);
  }
</script>
_END;
?>
