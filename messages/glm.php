<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['nmus']) && isset($_GET['nmf'])){
      $nmf = $_GET['nmf'];
      $user = $_GET['nmus'];
      $fnme = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nmf'"));
      $ffn = $fnme['firstname'];
      $fln = $fnme['surname'];
      $mf = queryMysql("SELECT * FROM messages WHERE sender='$user' AND receiver='$nmf' OR receiver='$user' AND sender='$nmf' ORDER BY timeofmessage DESC");
      $oq = queryMysql("SELECT * FROM messages WHERE (sender='$user' AND receiver='$nmf' OR receiver='$user' AND sender='$nmf') AND hasread='0'");
      $moq = mysqli_num_rows($oq);$mff = mysqli_fetch_array($mf);
      if($mf->num_rows == 0){
        $fmsg  = "You are following $nmf. Start a message";
        $ftom = "";
        $sndr = "";
        $btck = "";
        $padding = 'style=\'padding-left: 0px;\'';
        $bpadding = 'style=\'padding-left: 0px;\'';
      }
      else {
        $gaaag = str_replace('/ampersandsymbol/', '&', $mff['message']);
        $fmsg = strlen($gaaag) > 30 ? substr($gaaag, 0, 30)
        .'&hellip;' : $gaaag;
        $ftom = date("h:i a", $mff['timeofmessage']);
        $padding = 'style=\'padding-left: 5px;\'';
        $bpadding = "";
        if($mff['sender'] == $user){
          $sndr = "You: ";
          if($mff['hasread'] != 0){
            $btck = "<i class='fas fa-check-double'></i>";
          }
          else{
            $btck = "<i class='fas fa-check'></i>";
          }
        }
        else {
          $sndr = "<i class='fas fa-at'></i>".$mff['sender'].": ";
          $btck = "";
        }
      }
          $id = $mff['messageid'];
       echo "<div class='datg'>
       <div class='tick'>$btck</div>
       <div class='sndnm' $padding>$sndr </div>
       <div class='fmg' $bpadding>".strip_tags($fmsg)."</div></div>
       <div class='ftom'>$ftom</div></div>";
    }
    if(isset($_POST['u'])){
      $user = dec(sanitizeString($_POST['u']));
      $l = array();
      $mfe = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' OR ftwo='$user' ORDER BY lasttimeofmessage DESC");
      $olx = array();
      while ($mffe = mysqli_fetch_array($mfe)) {
      if($mffe['fone'] == $user){
        $oq = queryMysql("SELECT * FROM messages WHERE (receiver='".$mffe['fone']."' AND sender='".$mffe['ftwo']."') AND hasread='0'");
      }
      else {
        $oq = queryMysql("SELECT * FROM messages WHERE (sender='".$mffe['fone']."' AND receiver='".$mffe['ftwo']."') AND hasread='0'");
      }
      $mf = queryMysql("SELECT * FROM messages WHERE sender='".$mffe['fone']."' AND receiver='".$mffe['ftwo']."' OR receiver='".$mffe['fone']."' AND sender='".$mffe['ftwo']."' ORDER BY timeofmessage DESC");
      $mff = mysqli_fetch_array($mf); 
      $xloq = mysqli_fetch_array($oq);
       $moq = mysqli_num_rows($oq);
      $gaaag = str_replace('/ampersandsymbol/', '&', $mff['message']);
          $fmsg = strlen($gaaag) > 30 ? substr($gaaag, 0, 30)
        .'&hellip;' : $gaaag;
          $ftom = date("h:i a", $mff['timeofmessage']);
          $padding = 'style=\'padding-left: 5px;\'';
          $bpadding = "";
          $mxx = $moq == '0' ? " " : $moq;
          $oaf = strip_tags($fmsg);
          if(strip_tags($fmsg) == ''){
            $oaf = 'Shared Message';
          }
          if($mff['sender'] == $user){
            $sndr = 'You: ';
             if($mff['hasread'] != 0){
              $btck = "<i class='fas fa-check-double'></i>";
            }
            else{
              $btck = "<i class='fas fa-check'></i>";
            }
            $lacok = $mff['receiver'];
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$lacok."/".$lacok.".png")){
              $try = 1;
            }
            else {
              $try = 0;
            }
          $mfee = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$lacok'"));
          $name = $mfee['firstname'].' '.$mfee['surname'];
          array_push($olx, array($mffe['fone'],$sndr, $mff['receiver'], $oaf, $ftom, $btck, $padding, $mxx, $lacok, $mffe['lasttimeofmessage'], $try, $name));
          }
          else {
            $sndr = "<i class='fas fa-at'></i>".$mff['sender'].": ";
            $btck = "";
            $lacok = $mff['sender'];
            if(file_exists("../../students_connect_hidden/users_profile_upload/".$lacok."/".$lacok.".png")){
              $try = 1;
            }
            else {
              $try = 0;
            }
            $mfee = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$lacok'"));
            $name = $mfee['firstname'].' '.$mfee['surname'];
            array_push($olx, array($mffe['fone'],$sndr, $mff['receiver'], $oaf, $ftom, $btck, $padding, $mxx, $lacok, $mffe['lasttimeofmessage'], $try, $name));
          }
        }
      echo json_encode($olx);
      /*for($i = 0; $i < count($olx); $i++){
        for($j = 0; $j < count($olx[$i]); $j++){
        echo $olx[$i][$j]."<br/>";
        }
      }*/
    }
?>