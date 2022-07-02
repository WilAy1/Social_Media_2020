<?php
  error_reporting(E_WARNING || E_NOTICE);
  ini_set("date.timezone",  "Africa/Lagos");
  $dbhost  = 'localhost'; 
  $dbname  = 'students_connect';
  $dbuser  = '';
  $dbpass  = '';
  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die($connection->connect_error);

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }
function enc($smt){
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryptionkey = "t/h/i/s/m/y/b/a/q/i/s/@/q/u/e/s/t";
        $smt = openssl_encrypt($smt, $ciphering, $encryptionkey, $options, $encryption_iv);
        return $smt;
          }
function dec($smt){
    $ciphering = "AES-128-CTR";
    $decryption_iv = '1234567891011121';
    $decryptionkey = "t/h/i/s/m/y/b/a/q/i/s/@/q/u/e/s/t";
    $options = 0;
    $smt = openssl_decrypt($smt, $ciphering, $decryptionkey, $options, $decryption_iv);
    return $smt;
  }
  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }

  function destroySession()
  {
    $_SESSION=array();
    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time() + (86400 * 30));

    session_destroy();
  }
  
  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }
  function sanitize($var)
  {
    global $connection;
    $var = strip_tags($var);
    return $connection->real_escape_string($var);
  }
  function andcorrect($var){
    global $connection;
    nl2br($var);
    $var = str_replace('/ampersandsymbol/', '&', $var);
    return $connection->real_escape_string($var);
  }
  function andfcorrect($var){
    global $connection;
    $var = str_replace('/ampersandsymbol/', '&', $var);
    return $connection->real_escape_string($var);
  }
  function allposts($var){
    global $connection;
    nl2br($var);
    return $connection->real_escape_string($var);
  }
  function createcookie(){
    #nothing is here
      }
  function symbols($var) {
    global $connection;
    nl2br($var);
    $var = stripslashes($var);
    $var = str_replace('/{', '<u>', $var);
    $var = str_replace('}/', '</u>', $var);
    $var = str_replace('/b', '<b>', $var);
    $var = str_replace('b/', '</b>', $var);
    $var = str_replace('/i', '<i>', $var);
    $var = str_replace('i/', '</i>', $var);
    $var = str_replace('/su', '<sup>', $var);
    $var = str_replace('su/', '</sup>', $var);
    $var = str_replace('/-', '<sub>', $var);
    $var = str_replace('-/', '</sub>', $var);
      return $connection->real_escape_string($var);
  }
  function sumcl(int ...$int){
                    
    return array_sum($int);
  }
  function red($tint){
    if($tint == 0){
      $tint = "0";
    }
    elseif($tint == 1){
      $tint = '1';
    }
    elseif($tint > 1 && $tint < 1000){
      $tint = $tint;
    }
    elseif($tint >= 1000 && $tint < 10000){
      $tint = substr($tint, 0, 1)."k";
    }
    elseif($tint >= 10000 && $tint < 100000){
      $tint = substr($tint, 0, 2)."k";
    }
    elseif($tint >= 100000 && $tint < 1000000){
      $tint = substr($tint, 0, 3)."k";
    }
    elseif($tint >= 1000000 && $tint < 10000000){
      $tint = substr($tint, 0, 1).".".substr($tint, 1, 1)."M";
    }
    return $tint;
  }
  function linkk($tlink){
    $lkcharacters = array("a", "b", "c", "d", "e", "f", "g", "h", "i",
                "j","k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
                "y", "z","_", "-",'#', "%", ".", "/", ":",'?', '=', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
              'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '');
    $possible = array("com", "us", "uk", "co", "org", "me", "ng", "tv", "xyz", "ly", "ch");
    $pstcont = $tlink;
    $nsp = explode("\n", $pstcont);
    $alh = array();
    $poo = array();
    $nal = array();
    for($y = 0; $y < count($nsp); $y++){
      $new = explode(" ",$nsp[$y]);
      for($i = 0; $i < count($new); $i++){
      if(strpos($new[$i], "#") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "#");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        $mns = substr($new[$i], 0, 1);
        if($mns == '#'){
          array_push($alh, $ns);
        }
      }
      }
      if(strpos($new[$i], "@") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "@");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);;
        $tto = queryMysql("SELECT * FROM members WHERE user='".substr($ns, 1, strlen($ns))."'");
        if($tto->num_rows){
        array_push($poo, $ns);
        }
        }
      }
      if(strpos($new[$i], ".") !== false){
        $len = strlen($new[$i]);
        $gpod = strpos($new[$i], ".");
        $bf = substr($new[$i], 0, $gpod);
        $af = substr($new[$i], $gpod+1, $len);
        $sbf = str_split($bf);
        $errx = array();
        $serr = array();
        for($a = 0; $a < count($sbf); $a++){
          if(in_array($sbf[$a], $lkcharacters)){
            array_push($errx, 1);
          }
          else {
            array_push($errx, 0);
          }
        }
        $uaf = array_unique($errx);
        $pass = false;
        if(count($uaf) == 1 && ($uaf[0] == 1)){
          $pass = true;
        }
        if(strpos($new[$i], "/") !== FALSE){
          $af = str_replace(" ", "", $af);
          $af = urldecode(str_replace("%0D","", urlencode($af)));
          $ch_all = explode('/', $af);
          for($d = 0; $d < count($ch_all); $d++){
          $erro = str_split($ch_all[$d]);
          for($r = 0; $r < count($erro); $r++){
            if(in_array($erro[$r], $lkcharacters)){
              array_push($serr, 1);
            }
            else {
              array_push($serr, $erro[$r]);
              array_push($serr, 0);
            }
          }
          }
        }
        else {
          if(in_array($af, $possible)){
            array_push($serr, 1);
          }
          else {
            array_push($serr, 0);
          }
        }
        $maf = array_unique($serr);
        $move = false;
        if(count($maf) == 1 && ($maf[0] == 1)){
          $move = true;
        }
        if($move && $pass){
          array_push($nal, $new[$i]);
        }
      }
    }
    }
    for($p = 0; $p < count($alh); $p++){
      $ns = $alh[$p];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/search/?search=%23$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($w = 0; $w < count($poo); $w++){
      $ns = $poo[$w];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/user/$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($l = 0; $l < count($nal); $l++){
      $ns = $nal[$l];
      $ns = urldecode(str_replace("%0D","", urlencode($ns)));
      if((strpos($ns, "http://") !== FALSE) || (strpos($ns, "https://") !== FALSE)){
        $pstcont = str_replace($ns, "<a target='_blank' href=".htmlspecialchars("$ns").">"
        .$ns."</a>", $pstcont);
      }
      else {
        $pstcont = str_replace($ns, "<a target='_blank' href=".htmlspecialchars("http://$ns").">"
        .$ns."</a>", $pstcont);
    }
    }
    return $pstcont;
}
  function rhash($text){
    return linkk($text);
    $lkcharacters = array("a", "b", "c", "d", "e", "f", "g", "h", "i",
                "j","k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
                "y", "z","_", "-", "%", ".", "/", ":", '?', '=', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
              'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $possible = array("com", "us", "uk", "co", "org", "me", "ng", "tv");
    $pstcont = $text;
    $nsp = explode("\r\n", $pstcont);
    $alh = array();
    $poo = array();
    $nal = array();
    for($y = 0; $y < count($nsp); $y++){
      $new = explode(" ",$nsp[$y]);
      for($i = 0; $i < count($new); $i++){
      if(strpos($new[$i], "#") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "#");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        array_push($alh, $ns);
        }
      }
      if(strpos($new[$i], "@") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "@");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);;
        $tto = queryMysql("SELECT * FROM members WHERE user='".substr($ns, 1, strlen($ns))."'");
        if($tto->num_rows){
        array_push($poo, $ns);
        }
        }
      }
      if(strpos($new[$i], ".") !== false){
        $len = strlen($new[$i]);
        $gpod = strpos($new[$i], ".");
        $bf = substr($new[$i], 0, $gpod);
        $af = substr($new[$i], $gpod+1, $len);
        $sbf = str_split($bf);
        $errx = array();
        $serr = array();
        for($a = 0; $a < count($sbf); $a++){
          if(in_array($sbf[$a], $lkcharacters)){
            array_push($errx, 1);
          }
          else {
            array_push($errx, 0);
          }
        }
        $uaf = array_unique($errx);
        $pass = false;
        if(count($uaf) == 1 && ($uaf[0] == 1)){
          $pass = true;
        }
        if(strpos($new[$i], "/") !== FALSE){
          $af = str_replace(" ", "", $af);
          $ch_all = explode('/', $af);
          for($d = 0; $d < count($ch_all); $d++){
          $erro = str_split($ch_all[$d]);
          for($r = 0; $r < count($erro); $r++){
            if(in_array($erro[$r], $lkcharacters)){
              array_push($serr, 1);
            }
            else {
              array_push($serr, $erro[$r]);
              array_push($serr, 0);
            }
          }
          }
        }
        else {
          if(in_array($af, $possible)){
            array_push($serr, 1);
          }
          else {
            array_push($serr, 0);
          }
        }
        $maf = array_unique($serr);
        $move = false;
        if(count($maf) == 1 && ($maf[0] == 1)){
          $move = true;
        }
        if($move && $pass){
          array_push($nal, $new[$i]);
        }
      }
    }
    }
    for($p = 0; $p < count($alh); $p++){
      $ns = $alh[$p];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/search/?search=%23$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($w = 0; $w < count($poo); $w++){
      $ns = $poo[$w];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/user/$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($l = 0; $l < count($nal); $l++){
      $ns = $nal[$l];
      if((strpos($ns, "http://") !== FALSE) || (strpos($ns, "https://") !== FALSE)){
        $pstcont = str_replace($ns, "<a href=".htmlspecialchars("$ns").">"
        .$ns."</a>", $pstcont);
      }
      else {
        $pstcont = str_replace($ns, "<a href=".htmlspecialchars("https://$ns").">"
        .$ns."</a>", $pstcont);
    }
  }
    return $pstcont;
  }
  function lhash($text){
    $lkcharacters = array("a", "b", "c", "d", "e", "f", "g", "h", "i",
                "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
                "y", "z","_", "-", "%", ".", "/", ":", '?', '=','1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
              'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $possible = array("com", "us", "uk", "co", "org", "me", "ng", "tv", "net");
    $pstcont = $text;
    $nsp = explode("\n", $pstcont);
    $alh = array();
    $poo = array();
    $nal = array();
    for($y = 0; $y < count($nsp); $y++){
      $new = explode(" ",$nsp[$y]);
      for($i = 0; $i < count($new); $i++){
      if(strpos($new[$i], "#") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "#");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);
        array_push($alh, $ns);
        }
      }
      if(strpos($new[$i], "@") !== false){
        $len = strlen($new[$i]);
        $gpoh = strpos($new[$i], "@");
        if(substr($new[$i], 2) != ''){
        $st = $new[$i];
        $id = 0;
        $ns = substr($new[$i], 0);;
        $tto = queryMysql("SELECT * FROM members WHERE user='".substr($ns, 1, strlen($ns))."'");
        if($tto->num_rows){
        array_push($poo, $ns);
        }
        }
      }
      if(strpos($new[$i], ".") !== false){
        $len = strlen($new[$i]);
        $gpod = strpos($new[$i], ".");
        $bf = substr($new[$i], 0, $gpod);
        $af = substr($new[$i], $gpod+1, $len);
        $sbf = str_split($bf);
        $errx = array();
        $serr = array();
        for($a = 0; $a < count($sbf); $a++){
          if(in_array($sbf[$a], $lkcharacters)){
            array_push($errx, 1);
          }
          else {
            array_push($errx, 0);
          }
        }
        $uaf = array_unique($errx);
        $pass = false;
        if(count($uaf) == 1 && ($uaf[0] == 1)){
          $pass = true;
        }
        if(strpos($new[$i], "/") !== FALSE){
          $af = str_replace(" ", "", $af);
          $ch_all = explode('/', $af);
          for($d = 0; $d < count($ch_all); $d++){
          $erro = str_split($ch_all[$d]);
          for($r = 0; $r < count($erro); $r++){
            if(in_array($erro[$r], $lkcharacters)){
              array_push($serr, 1);
            }
            else {
              array_push($serr, $erro[$r]);
              array_push($serr, 0);
            }
          }
          }
        }
        else {
          if(in_array($af, $possible)){
            array_push($serr, 1);
          }
          else {
            array_push($serr, 0);
          }
        }
        $maf = array_unique($serr);
        $move = false;
        if(count($maf) == 1 && ($maf[0] == 1)){
          $move = true;
        }
        if($move && $pass){
          array_push($nal, $new[$i]);
        }
      }
    }
    }
    for($p = 0; $p < count($alh); $p++){
      $ns = $alh[$p];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/search/?search=%23$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($w = 0; $w < count($poo); $w++){
      $ns = $poo[$w];
      $sns = substr($ns, 1, strlen($ns));
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("/students_connect/user/$sns").">"
        .$ns."</a>", $pstcont);
    }
    for($l = 0; $l < count($nal); $l++){
      $ns = $nal[$l];
          $pstcont = str_replace($ns, "<a href=".htmlspecialchars("https://$ns").">"
        .$ns."</a>", $pstcont);
    }
    return $pstcont;
  }
  function gen(){
    $po = array("a", "b", "c", "d", "e", "f", "g", "h", "i",
    "j","k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
    "y", "z","_", "-", '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
    'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'k');
    $li = '';
    for($i = 0; $i <= 12; $i++){
        if(strlen($li)  < 13){
        $gh = rand(0, count($po));
        $li .= $po[$gh];
        }
    } 
    return  $li;
}
?>
