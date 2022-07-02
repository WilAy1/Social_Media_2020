<?php
require_once "/Users/wilay/students_connect/header2.php";
if (!$loggedin) die();
else{
  $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
  $groupname = array(
    "Medicine And Surgery (General)",
    "Pharmacy (General)",
    "Computer Science With Maths (General)",
    "Computer Science With Economics (General)",
    "Microbiology (General)");
    if($row['course'] == 'mbbs'){
      $groupname = $groupname[0];
    }
    elseif($row['course'] == 'csm'){
      $groupname = $groupname[2];
    }
    elseif($row['course'] == 'cse'){
      $groupname = $groupname[3];
    }elseif($row['course'] == 'phm'){
      $groupname = $groupname[1];
    }
    $cus = $row['user'];
    $nmg = $row['course'];
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
    echo <<<_END
    <div class="navbar2">
    <ul id="navbar_list">
    <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home">
    <span class='h_shn12w'><i class='fas fa-circle'></i></span>
    </i>
    </a>
    </li>
    <li id="hmic" style=''><a href="/students_connect/trend"><i class="fas fa-bolt"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="far fa-envelope">
    _END;
if($cntnm>0){
echo "<span class='h_shn12w s_thmiw'><span>".$cntnm."</span></span>";
}
echo <<<_END
</i></a></li>
  <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="far fa-bell">
_END;
if($eeex>0){
  echo "<span class='h_shn12w s_thmiw'><span>".$eeex."</span></span>";
  }
echo <<<_END
  </i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
    if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    echo <<<_END
      </ul>   
      </div>
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
  _END;
echo <<<_END
  <div class='amib' id='amib'>
  <div class='tprt'>
  <div class='bsimg' style="background-image: url(
  _END;
  if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){ 
    echo "'../../../../../students_connect_hidden/users_profile_upload/$user/$user.png');";
    }
    else {
        echo "'../user.png');";
    }
  echo <<<_END
  background-repeat: no-repeat;
  height: 50px; width: 50px; border-radius: 50px;
   background-size: 100%;"></div>
   <div class='msgname'><a href='/students_connect/user/
_END;
  $apc = $row['course'];
  
    $lfive = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' or ftwo='$user' ORDER BY numberofmessages DESC LIMIT 4");
  echo $row['user']."'>".$row['firstname']." ".$row['surname']."</a></div>";
    echo "
  <div class='frquently' style='padding-left: 50px; display: flex;'>";
  if($lfive ->num_rows != 0){
  while($glfive = mysqli_fetch_assoc($lfive)){
    if($glfive['fone'] == $row['user']){
      $aunm = $glfive['ftwo'];
    }
    else {
      $aunm = $glfive['fone'];
    }
    if(file_exists("../../students_connect_hidden/users_profile_upload/".$aunm.'/'.$aunm.".png")){
        $lastfive = "../../students_connect_hidden/users_profile_upload/".$aunm.'/'.$aunm.".png";
    }
    else {
      $lastfive = "../../students_connect/user.png";  
    }
    echo "<div class='warrdy' title='$aunm' style='padding-left: 20px; cursor: pointer;'
     onclick='openfMsg(\"".$row['user']."\", \"$aunm\", ".$glfive['lasttimeofmessage'].")'><div class='fcnt' style='background-image:url(\"$lastfive\")'></div>
     <i class='udsg'> </i>
    <div class='eabcd' style='text-align: center;'><i class='fas fa-at'></i>".$aunm."</div></div>";
  }
}
  echo "</div>
    <div class='srchmg'>
  <input type='text' placeholder='Search Messages' id='srcmgtb' onkeyup='showResult(\"$user\", this.value)'/>
  </div>
  <div id='livesearch'></div>
  </div>";
  echo "<div id='lom'></div><div id='lofm'>";
  echo "<div class='t_peer1st'>";  
  $flst = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' OR ftwo='$user' ORDER BY lasttimeofmessage DESC");
    $fmst = queryMysql("SELECT * FROM messages WHERE sender='$user'");
  while($gflst = mysqli_fetch_assoc($flst)){
    if($gflst['fone'] == $user){
      $oq = queryMysql("SELECT * FROM messages WHERE (receiver='".$gflst['fone']."' AND sender='".$gflst['ftwo']."') AND hasread='0'");
    }
    else {
      $oq = queryMysql("SELECT * FROM messages WHERE (sender='".$gflst['fone']."' AND receiver='".$gflst['ftwo']."') AND hasread='0'");
    }
    if($user==$gflst['fone']){
      $mnm = $gflst['ftwo'];
    }
    else {
      $mnm = $gflst['fone'];
    }
    if(file_exists("../../students_connect_hidden/users_profile_upload/".$mnm.'/'.$mnm.".png")){ 
      $fimg =  '../../../../../students_connect_hidden/users_profile_upload/'.$mnm.'/'.$mnm.'.png';
      }
      else {
          $fimg =  '../user.png';
      }
    $nmf = $mnm;
    $fnme = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nmf'"));
    $ffn = $fnme['firstname'];
    $fln = $fnme['surname'];
    $mf = queryMysql("SELECT * FROM messages WHERE sender='$user' AND receiver='$nmf' OR receiver='$user' AND sender='$nmf' ORDER BY timeofmessage DESC");
    $mff = mysqli_fetch_array($mf);
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
      $fmsg = strlen($gaaag) > 30 ? substr($gaaag, 0, 40)
      .'&hellip;' : $gaaag;
      $ftom = date("h:i a", $mff['timeofmessage']);
      $padding = 'style=\'padding-left: 5px;\'';
      $bpadding = "";
      $oaf = strip_tags($fmsg);
          if(strip_tags($fmsg) == ''){
            $oaf = 'Shared Message';
          }
      if($mff['sender'] == $user){
        $sndr = "You: ";
        $mabt = $mff['receiver'];
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
        $mabt = $mff['sender'];
      }
    }
    $moq = mysqli_num_rows($oq);
    $mxx = $moq == '0' ? " " : $moq;
    if(isset($mff['messageid'])){
    $id = $mff['messageid'];
    $mtme = $mff['timeofmessage'];
    }
    else {
      $id = '';
      $mtme = '';
      $mabt = '';
      $oaf  = "You are following $nmf. Start a message";
    }
      if(file_exists("../../students_connect_hidden/messages_uploads/".$id."/0.png") ||
      file_exists("../../students_connect_hidden/messages_uploads/".$id."/0.mp4") || 
      file_exists("../../students_connect_hidden/messages_uploads/".$id."/0.mp3")){
        $fmsg = '<i class="fas fa-file"></i> File';
      }
      $gtfi = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$fnme['user']."'"));
        $ctm = strtotime(date("Y-m-d H:i:s")."-50 second");
        if($gtfi['lastactivitytime'] > $ctm){
          $oox = "style='display: block;'";
        }
        else {
        $oox = "style='display: none;'";
    }
        echo "<script>/*
    $('.lii$id').ready(function(){
      setInterval(function(){
        upms();
      }, 5000);
      function upms(){
      $.ajax({
        url:'/students_connect/messages/glm.php?nmus=$user&nmf=$nmf',
        method:'GET',
        success:function(data){
          $('.lii$id').html(data);
        }
      })
      }
      })*/
    </script><div class='flist' id='frnd".$gflst['id']."'>
    <div class='fcontr' onclick='openfMsg(\"$user\", \"$nmf\", ".$mtme.");' 
    onmouseover='displayprop(\"".$gflst['id']."\");' onmouseout='hideprop(\"".$gflst['id']."\");'
    title='$nmf'>
    <div id='prop".$gflst['id']."' class='prop' style='display: none;'>
      <button class='messageprop' title='Pin Message'
       onclick='pinfMessage(\"".$gflst['id']."\")'>Pin Message</button>
      <button class='messageprop' title='Mark as Read'
       onclick='mrfmsg(\"".$gflst['id']."\")'>Mark As Read</button>
       <button class='messageprop' title='Clear Message'
       onclick='clearfMessage(\"$user\", \"".$gflst['id']."\")'>Clear Message</button>
     <button class='messageprop' onclick='deletemsg(\"".$gflst['id']."\")'><i class='fas fa-trash' style='color: red;'
     title='Delete Message'></i>
    </button></div>
    <div class='flcn'>
    <div class='fic'>
    <div class='fimg imgfsnd' style='background-image: url(\"$fimg\");'></div>
    <span class='onornot' $oox></span>
    <div class='som_others'>
    <div class='fnme'>$ffn $fln</div>
    <div class='lii$id qwwe $mabt' style='width: 95%; position: relative;'>
    <div class='datg'>
    <div class='tick'>$btck</div>
    <div class='sndnm' $padding>$sndr </div>
    <div class='fmg' $bpadding>".$oaf."</div></div>
    <div class='ftom'>$ftom</div><div class='mg_moq'>".$mxx."</div></div></div>
    </div></div></div></div>";
  }
  echo "</div>";
  $ngrp = queryMysql("SELECT * FROM groupmembership WHERE user='".$row['user']."' order by lastmessageongroup DESC");
  echo "<div class='t_grp1st'>";
  if($ngrp->num_rows == 0){
  }
  else {
  while($gngrp = mysqli_fetch_assoc($ngrp)){
    $id = $gngrp['groupid'];
    $dths = queryMysql("SELECT * FROM selfgroups WHERE id='$id'");
    while($ddths = mysqli_fetch_assoc($dths)){
      $nid = $ddths['id'];
      $xdd = mysqli_fetch_array(queryMysql("SELECT * FROM groupmessages WHERE groupid='$nid' ORDER BY timeofmessage DESC"));
      if($xdd['user'] == $user){
        $sndr = "You: ";
          $btck = "<i class='fas fa-check'></i>";
      }
      elseif($xdd['user'] == 'sp'){
        $sndr = '';
        $btck = '';
      }
      else {
        $sndr = "<i class='fas fa-at'></i>".$xdd['user'].": ";
        $btck = "";
      }
      $gaaag = $xdd['message'];
      $gmsg = strlen($gaaag) > 30 ? substr($gaaag, 0, 90)
      .'&hellip;' : $gaaag;
      $padding = 'style=\'padding-left: 0px;\'';
      $bpadding = '';
      if(file_exists("../../students_connect_hidden/group_uploads/group-images/".$nid.".png")){
        $gimg = "/students_connect_hidden/group_uploads/group-images/".$nid.".png";
      }
      else {
        $gimg = '/students_connect/user.png';
      }
    echo "
    <div class='flist' id='group".$nid."'>
    <div class='fcontr' onclick='opengroup(\"$user\", \"".$ddths['id']."\");'>
    <div class='flcn'>
    <div class='fic'>
    <div class='fimg imgfsnd' style='background-image: url(\"".$gimg."\");'></div>
    <div class='som_others'>
    <div class='fnme'>".$ddths['nameofgroup']."</div>
    <div class='leii'>
    <div class='datg'>
    <div class='tick'>$btck</div>
    <div class='sndnm'>$sndr</div>
    <div class='g_mg'>".strip_tags($gmsg)."</div></div>
    <div class='ftom'>".date('h:i a', $ddths['lastmessagetime'])."</div></div>
    </div></div></div></div></div>";
    }
  }
}
echo "</div>";
  echo "</div>
  <div class='m_own12w' id='pnflws'>
  <div class='o_groups'>
  <div class='o_peer1mu isactive' title='Friends'><i class='fas fa-user-friends'></i> Friends</div>
  <div class='o_group1mu' title='Groups'><i class='fas fa-users'></i> Groups</div>
  </div>
  <div class='btnfmsg' onclick='openFlw(\"$user\");';><i class='fas fa-plus'></i></div>
  </div>
  </div>
  <div id='wcws' style='display: none;'>
  </div>
  <div class='dinf' id='dinf'></div>
  <div id='crtgrpst'></div>
  <div id='rpns'></div>
  <div id='loading' style='display: none;'>Loading</div>
  </div>
  </div>
";
if((isset($_POST['name']) && isset($_POST['fname'])) || (isset(($_GET['n'])) && !empty($_GET['n']))){
  if(isset($_GET['n'])){
   $ndname = $row['user'];
   $ndfname = sanitizeString($_GET['n']); 
  }
  else {
  $ndname = sanitizeString($_POST['name']);
  $ndfname = sanitizeString($_POST['fname']);
  }
  $rp = queryMysql("SELECT * FROM messages WHERE sender='$ndname' AND receiver='$ndfname' OR receiver='$ndfname' AND sender='$ndfname' ORDER BY timeofmessage DESC");
  if($rp->num_rows){
    $gerp = mysqli_fetch_array($rp);
    $lttm = $gerp['timeofmessage'];
  }
  else {
    $lttm = '0';
  }
  echo <<<_NERD
    <script>
    openfMsg("$ndname","$ndfname", "$lttm");
    
                      
                      </script>
_NERD; 
}
if(isset($_GET['group'])){
  $grp = sanitizeString($_GET['group']);
  $username = $row['user'];
  $chk = queryMysql("SELECT grouplinkhash FROM selfgroups WHERE grouplinkhash='$grp'");
  if($chk->num_rows){
  $gdtls = mysqli_fetch_array(queryMySql("SELECT * FROM selfgroups WHERE grouplinkhash='$grp'"));
  $groupid = sanitizeString($gdtls['id']);
  $username = sanitizeString($row['user']);
  echo "
    <script>
    opengroup('$username', '$groupid');
    
                  </script>
  ";
}
}
echo <<<_END
    <script>
    var gtx = document.getElementsByClassName('o_group1mu')[0];
    var mtx = document.getElementsByClassName('o_peer1mu')[0];
    var eb = document.getElementsByClassName('o_groups')[0];
    var lob = document.getElementsByClassName('t_grp1st')[0];
    var bloo = document.getElementsByClassName('t_peer1st')[0];
    var mll = eb.children;
    gtx.onclick = function(){
      bloo.style.display = 'none';
      lob.style.display = 'block';
        for(var i =0; i < mll.length; i++){
          mll[i].className = mll[i].className.replace('isactive', '');
        }
        this.classList.add('isactive');
    }
    mtx.onclick = function(){
      bloo.style.display = 'block';
      lob.style.display = 'none';
        for(var i =0; i < mll.length; i++){
          mll[i].className = mll[i].className.replace('isactive', '');
        }
        this.classList.add('isactive');
    } 
    </script>
      <script src='/students_connect/jsf/messagingscript.js'>
  </script>
_END;
echo "
  <script>
  var lar = [];
  var qqq = setInterval(
    function(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          //if(lar[0][8] != document.getElementsByClassName('qwwe')[0].classList[2]){
          if(lar != JSON.parse(xmlhttp.responseText)){
          lar = JSON.parse(xmlhttp.responseText)
          var ar = JSON.parse(xmlhttp.responseText).reverse();
          for(var i = 0; i < ar.length; i++){
              var matb = ar[i][8];
            if(document.getElementsByClassName(matb)[0]){
            document.getElementsByClassName(matb)[0].innerHTML = \"<div class='datg'><div class='tick'>\"+ar[i][5]+\"</div>\"+
              \"<div class='sndnm' \"+ar[i][6]+\">\"+ar[i][1]+\" </div>\"+
              \"<div class='fmg'> \"+ar[i][3]+\"</div></div>\"+
              \"<div class='ftom'>\"+ar[i][4]+\"</div><div class='mg_moq'>\"+ar[i][7]+\"</div></div>\"
              var qeex = document.getElementsByClassName(matb)[0].parentElement.parentElement.parentElement.parentElement.parentElement;
              document.getElementsByClassName('t_peer1st')[0].insertBefore(qeex, document.getElementsByClassName('t_peer1st')[0].childNodes[0]); 
            }
            else {
              var flist = document.createElement('DIV');
              flist.className = 'flist';
              if(ar[i][10] == '1'){
                var imrl = '/students_connect_hidden/users_profile_upload/'+ar[i][8]+'/'+ar[i][8]+'.png';
              }
              else {
                var imrl = '/students_connect/user.png';
              }
              flist.id = '".$user."';
              flist.title = \"+ar[i][8]+\";
              flist.innerHTML = \"<div class='fcontr' onclick='openfMsg(\"+flist.id+\", \"+flist.title+\", \"+ar[i][9]+\");'\"+ 
              \"onmouseover='displayprop('');' onmouseout='hideprop('');'\"+
              \"title=\"+ar[i][8]+\">\"+
              \"<div id='prop' class='prop' style='display: none;'>\"+
              \"<button class='messageprop' title='Pin Message'\"+
                \"onclick='pinfMessage()'>Pin Message</button>\"+
                 \"<button class='messageprop' title='Mark as Read'\"+
                \"onclick='mrfmsg()'>Mark As Read</button>\"+
                 \"<button class='messageprop' title='Clear Message'\"+
                 \"onclick='clearfMessage()'>Clear Message</button>\"+
                 \"<button class='messageprop' onclick='deletemsg()'><i class='fas fa-trash' style='color: red;'\"+
               \"title='Delete Message'></i>\"+
               \"</button></div>\"+
              \"<div class='flcn'>\"+
              \"<div class='fic'>\"+
              \"<div class='fimg imgfsnd' style='background-image: url(\"+imrl+\");'></div>\"+
              \"<span class='onornot'></span>\"+
              \"<div class='som_others'>\"+
              \"<div class='fnme'>\"+ar[i][11]+\"</div>\"+
              \"<div class='lii qwwe \"+ar[i][8]+\"' style='width: 95%; position: relative;'>\"+
              \"<div class='datg'><div class='tick'>\"+ar[i][5]+\"</div>\"+
              \"<div class='sndnm' \"+ar[i][6]+\">\"+ar[i][1]+\" </div>\"+
              \"<div class='fmg'> \"+ar[i][3]+\"</div></div>\"+
              \"<div class='ftom'>\"+ar[i][4]+\"</div><div class='mg_moq'>\"+ar[i][7]+\"</div></div>\"+
              \"</div></div></div>\";
              document.getElementsByClassName('t_peer1st')[0].insertBefore(flist, document.getElementsByClassName('t_peer1st')[0].childNodes[0]); 
            }
        }
      }
       }
      }
      xmlhttp.open('POST','/students_connect/messages/glm.php');
      xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
      xmlhttp.send('u=".enc($row['user'])."');
    }, 1000)
  </script>
  <link rel='stylesheet' type='text/css' href='/students_connect/cssf/stories.css'></link>";
}
?>