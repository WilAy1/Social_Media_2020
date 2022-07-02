<?php
session_start();
 require_once 'connect.php';
 if (isset($_SESSION['user']))
  {
    if(isset($_POST['anul'])){
      echo 'a';
      $user = $_SESSION['user'];
      $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
      $user = $row['user'];
      $psdhd =$row['psdhd'];
      $ste = $row['user'];
      $ttime = time() + 3600 * 24 * 30*12;
      if(isset($_COOKIE['t'])){
        $qe = json_decode($_COOKIE['t'], TRUE);
      }
      else {
        $qe = array();
      }
        array_push($qe, array($row['id'], $ste, $psdhd));
        setcookie('t', json_encode($qe), $ttime);
    }
    if(isset($_POST['sw'])){
      $ox = dec($_POST['sw']);
      $ol = queryMysql("SELECT * FROM members WHERE user='$ox'");
      if($ol->num_rows){
        setcookie('tid', '', $ttime);
        setcookie('tuname', '', $ttime);
        setcookie('auth_t', '', $ttime);
        destroySession();
        $row = mysqli_fetch_array($ol);
        $user = $row['user'];
        $lastlogin = time();
            $loginip = $_SERVER['REMOTE_ADDR'];
            $lgxptime = time() + (86400 *30*12);
            $update_time = queryMysql("UPDATE members SET lastlogin='$lastlogin' WHERE user='$user'");
            $_SESSION['user'] = $user;
            $ttime = time() + 3600 * 24 * 30*12;
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
            header("Location: profile.php");
        exit;
          }
    }
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $row['user'];
    $lastlogout = time();
    $update_time = queryMysql("UPDATE members SET lastlogout='$lastlogout' where user='$user'");
    $ttime = time() - 3600 * 24*30;
    setcookie('tid', '', $ttime);
    setcookie('tuname', '', $ttime);
    setcookie('auth_t', '', $ttime);
    destroySession();
    $err = '';
    if(isset($_GET['err'])){
      $err = '&err=1';
    }
    header("Location: login.php?utm".$err."");
    exit;
  }
  else 
  {
    header("Location: login.php?utm");
    exit;
  }
?>

    <br><br></div>
  </body>
</html>
