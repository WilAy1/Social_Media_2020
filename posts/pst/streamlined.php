<!DOCTYPE html>
<html lang="en-ng" id='quest'>
<head>
<title>Sign Up / Log In - StudCo</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='icon' href='/students_connect/ico/favicon.ico' type="image/x-icon">
<link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
<link rel="shortcut icon" href="/students_connect/ico/favicon.ico" type="image/x-icon"/>
<script src="/students_connect/jsf/student_connect.js" type="text/javascript"></script>
<script src="/students_connect/jquerya-3.5.1.js"></script>
<script>
function showPass() {
    var x = document.getElementById("ypass");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showPassword1").style.display="inline-block";
      document.getElementById("showPassword").style.display="none";
    } else {
      x.type = "password";
      document.getElementById("showPassword1").style.display="none";
      document.getElementById("showPassword").style.display="inline-block";
    }
  }
function lessage(){
    document.getElementById('alins').style.display='block';
}
function nas(){
    if(document.getElementById('institution').value == 'nas'){
        document.getElementById('course').value = 'nas';
        document.getElementById('status_3').checked = true;
    }
    else {
        document.getElementById('course').value = 'acct';
        document.getElementById('status_3').checked = false;
    }
}
</script>
<style>
@media screen and (min-width:465px) {
    .navbar {
        min-width: 100%;
        padding:0px;
        overflow: hidden;
    }
   #navbar_list {
       list-style-type: none;
       margin: 0;
       padding: 0;
       overflow: hidden;
       background-color:#555;
       display: block;
   }
   #studco {
       float: left;
       width: 10%;
       font-size:20px;
   }
   #signup, #login {
       float:right;
       font-size:20px;
   }
   li#studco a {
       display:block;
       color:white;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#login a {
       display:block;
       color:green;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#signup a {
       display:block;
       color:lightgreen;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li a:hover {
       background-color: black;
   }
   .active {
       background-color:green;
   }
}

.navbar {
  top: 0;
  position: sticky;
  z-index: 10;
}
</style>
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<?php
echo <<<_END
<div class="studco_body">
<div class="navbar" class='mist_ic'>
<ul id="navbar_list">
<li id="studco"><a href="/students_connect/home.php">StudCo</a></li>
<li id="signup"><a href="/students_connect/signup.php">Sign Up</a></li>
<li id="login"><a href="/students_connect/login.php">Login</a></li>
</ul>   
</div>
<div class='timgbsys' style='display: none;'><div id='thimgv'>
  <span id='plding'></span>
  </div>
  <div id='timgerror'></div>
  <span class='clview' id='clview'>x</span></div>
  <div id='pgerror' style='width: 100%'>
<div class='x_l_abs'>No Internet Connection</div>
</div>
_END;
if(isset($mid)){
    $postid = $mid;
    $cmtid = 0;
    $request = queryMysql("SELECT * FROM eduposts WHERE id='$postid'");
    if($request->num_rows){
        $edu = (queryMysql("SELECT * FROM eduposts WHERE id='$postid'"));  
        $medu = mysqli_fetch_assoc($edu);
        $xuv = queryMysql("SELECT * FROM postviews WHERE id='$postid'");
        $uvs = mysqli_fetch_array($xuv);
        if($xuv->num_rows){
        $uvsv = (int) ++$uvs['views'];
        queryMysql("UPDATE postviews SET views='$uvsv' WHERE id='$postid'");
        }
        $ttime = $medu['timeofupdate'];
        $n = (queryMysql("SELECT pstcont FROM eduposts WHERE user='$user' AND sharedby='$user'"));
          $id = $medu['id'];
          $vot = queryMysql("SELECT * FROM votes WHERE id='$id' ORDER BY timeofvote DESC");
          $chvot = mysqli_fetch_array($vot);
          $rwvot = (int) mysqli_num_rows($vot); 
          $dwnp = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='downvote'");
          $chdwn = mysqli_fetch_array($dwnp);
          $fl = $rwvot - 1;
          $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC");         
          $geteducomment = mysqli_fetch_array($educomment);              
              $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
  $ctime = time();
  if(($ctime - $ttime) < 60){
    $ftime = (int) $ctime - $ttime;
    $ftime.="s";
  }
  elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
    $ftime = (int) (($ctime - $ttime)/60);
    $ftime.= "m";
  } 
  elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
    $ftime = (int) (($ctime - $ttime)/3600);
    $ftime .=  "h";
  }
  elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
    $x = (int)(($ctime - $ttime));
    if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
      $ftime = 'Yesterday at '.date("h:i a", $ttime);
    }
    else {
      $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
    }
  }
  else {
    $ftime = date("M d h:i a", $ttime);
  }
  if($medu['isshare'] == 0){
  echo <<<PSTS
                <div class='camp'>
                PSTS;
                
                echo <<<PSTS
                 <div class='amps' style='box-shadow: none;' id='
                PSTS;
                echo $medu['id']."'>";
                echo <<<PSTS
                    <div class='ipt'></div><div class='namp'>
              PSTS;
              $td = getcwd();
              CHDIR("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
              if(file_exists($medu['user'].".png")){ 
                $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';  
              }
                else {
                  chdir($td);
                    $img =  '/students_connect/user.png';
                }
                chdir($td);
                if($n->num_rows){
                  $en = ": ".mysqli_num_rows($n)." Post(s)";
                }
                else {
                  $en = "";
                }
                echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div><div class='typef' style='color: grey'>Educational</div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                $pstcut = $medu['pstcont'];
                echo nl2br($pstcut).'</div>';
                $tpeid = $medu['id'];
                  $etime = time();
                  
                      $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='0'");
                      if($polc->num_rows){
                        $gpo = mysqli_fetch_array($polc);
                        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                          $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                          }
                          else {
                            $x1v = $x2v = $x3v = $x4v = '0'; 
                          }
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                        $buttons = 'disabled';
                        $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                        echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1'>
                      ".$gpo['opt1']."
                      
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                      .$gpo['opt2']."
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts' $for>
                      <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                      .$gpo['opt3']."
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts' $ffr>
                      <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                      .$gpo['opt4']."
                      <span id='ls4'>".$oct."</span>
                      </button>
                      </div>
                      </div>
                      <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                       $gpo['o3clicks'], $gpo['o4clicks'])." votes . Login to vote</div>
                      </div>";
                      }
                  $arr = array();
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/".$medu['id']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/");
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                  echo '</div></div>';
                  echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp4")){
                    echo "
                    <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp4' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>
                <div class="posted">'.$ftime.'</div>';
              }
              else {
                
                
                echo <<<PSTS
                <div class='camp'>
                PSTS;
                echo <<<PSTS
                 <div class='amps' id='
                PSTS;
                echo $medu['id']."'>";
                echo <<<PSTS
                    <div class='ipt'></div><div class='namp'>
              PSTS;
              $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
              $td = getcwd();
                chdir("../../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
              if(file_exists($mbss['user'].".png")){ 
                $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                chdir($td);  
              }
                else {
                  chdir($td);
                    $img =  '/students_connect/user.png';
                }
                chdir($td);
                echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbss['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                <div class='name'>".$mbss['surname']." ".$mbss['firstname']."</a></div></div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                $pstcute = $medu['sharedpstcont'];
                echo nl2br($pstcute).'</div>';
                $td = getcwd();
                chdir("../../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
                if(file_exists($mbse['user'].".png")){ 
                  $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                  chdir($td);  
                }
                  else {
                    chdir($td);
                      $simg =  '/Students_connect/user.png';
                  }
                echo "<div class='eap' style='padding-bottom: 40px;'>
                <div class='tsp' onclick='op(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                 style='cursor: pointer; min-height: 120px;'>
                <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div>";
                echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                echo nl2br($pstcut).'</div>
                <div class="allimgposted"><div class="postimages">';
                $arr = array();
                $td = getcwd();
                chdir("../../../students_connect_hidden/postuploads/");
                for($i = 0; $i < 20; $i++){ 
                    if(file_exists($medu['sharedpostid']."(".$i.").png")){
                      $files[$i] = "/Students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png";
                      array_push($arr, $files[$i]);
                    }
                  }
                  chdir($td);
              $data = count($arr);
              $da = $data/2;
                echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/");
                for($i = 0; $i < 6; $i++){ 
                  if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                    echo "
                    <div class='postimages'>
                    <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png\")'></div>
                    <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png'></div>";
              }
                  else {
                    echo "";                     }
                  }
                chdir($td);
                echo '</div></div></div>
                </div></div>';
                echo '<div class="posted">'.$ftime.'</div>';
              }
                echo '
                <div class="pwl"> ';
                $nc = mysqli_fetch_array(queryMysql("SELECT * FROM postviews WHERE id='".$medu['id']."'"));
                $nov = $nc['views'];
                if($nov == 0){
                  $nofv = "No views";
                }
                elseif($nov == 1){
                  $nofv = '1 view';
                }
                elseif($nov > 1 && $nov < 1000){
                  $nofv = $nov."views";
                }
                elseif($nov > 1000 && $nov < 10000){
                  $nofv = substr($nov, 0, 1)."k views";
                }
                elseif($nov > 10000 && $nov < 100000){
                  $nofv = substr($nov, 0, 2)."k views";
                }
                elseif($nov > 100000 && $nov < 1000000){
                  $nofv = substr($nov, 0, 3)."k views";
                }
                elseif($nov > 1000000 && $nov < 10000000){
                  $nofv = substr($nov, 0, 1)."M views";
                }
                $cmmnt = $medu['pnc'];
                if($cmmnt == 0){
                  $ans = "No answers";
                }
                elseif($cmmnt == 1){
                  $ans = '1 answer';
                }
                elseif($cmmnt > 1 && $cmmnt < 1000){
                  $ans = $cmmnt."answers";
                }
                elseif($cmmnt > 1000 && $cmmnt < 10000){
                  $ans = substr($cmmnt, 0, 1)."k answers";
                }
                elseif($cmmnt > 10000 && $cmmnt < 100000){
                  $ans = substr($cmmnt, 0, 2)."k answers";
                }
                elseif($cmmnt > 100000 && $cmmnt < 1000000){
                  $ans = substr($cmmnt, 0, 3)."k answers";
                }
                elseif($cmmnt > 1000000 && $cmmnt < 10000000){
                  $ans = substr($cmmnt, 0, 1)."M answers";
                }
                if($fl == 1){
                  $other  = 'other';
                  global $other;
                }
                else {
                  $other = 'others';
                  global $other;
                }
                  $dwns = "";
                if($rwvot == 0){
                  $tvoc = "No reaction";
                }
                if($rwvot == 1){
                  /*echo '
                  <button type="submit" id="lbn">
                  <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reaction</button>';
                */
                $tvoc = "1 reaction";
                }
                elseif($rwvot > 1){
                  /*echo '
                  <button type="submit" id="lbn">
                  <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reactions</button>';
                */
                $tvoc = $fl." reactions";
                }
              echo "<div class='nfans tviews'><i class='fas fa-caret-up teyefig'
               style='color: green; font-size: 15px !important; padding-top: 0px !important;'></i>
              <div class='nmbcfcnt nofviews'>".$tvoc."</div></div>
              
              <div class='nfans tviews'><i class='far fa-comment teyefig'></i>
              <div class='nmbcfcnt nofviews'>".$ans."</div></div>
              <div class='tviews'><i class='fas fa-eye teyefig'></i>
              <div class='nofviews'>".$nofv."</div></div>";
              $geteducomment = mysqli_fetch_array($educomment);
              echo '</div><div class="undbtn"><div class="upv cmn dwn" id="upv'.$medu['id'].'" 
                ><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="cntl'.$medu['id'].'"
                 style="color: inherit !important;">'.$medu['tun'].'</div>
                </div><div class="lwv cmn dwn" id="dwn'.$medu['id'].'"><span style="vertical-align: sub"><i class="fas fa-caret-down"></i></span></div>
                <div class="cmt cmn dwn" id="commt">
                <button type="button" class="sbm">
                <span><i class="far fa-comment"></i></span>
                <div class="cnt cmn" id="cntc'.$medu['id'].'">'.$medu['pnc'].'</div></button></div>
                <div class="shr cmn dwn" style="padding: 10px;">
                <span id="sh'.$medu['id'].'"><i class="fas fa-share"></i></span></div>
                </div>';
                $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY timeofcomment DESC");
                    while($geteducomment = mysqli_fetch_array($educomment)){
                    $aus = $geteducomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    $getreplyn = queryMysql("SELECT * FROM replyeducomments WHERE postid='".$geteducomment['postid']."' AND cmtid='".$geteducomment['id']."'");
                    if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                      global $vpns;
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='openReplyContent(".$geteducomment['id'].", \"".$geteducomment['postid']."\")' id='dbsb".$geteducomment['id']."' 
                    >View ".$p."
                     ".$r."</button></div>
                     <div id='dsplrp".$geteducomment['id']."'></div>";
                    global $vpns;
                  }
                  if(file_exists("../../../students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/'.$geteducomment['user'].".png")){ 
                    $pimg =  '/students_connect_hidden/users_profile_upload/'.$geteducomment['user'].'/'.$geteducomment['user'].'.png';
                    }
                    else {
                        $pimg =  '/students_connect/user.png';
                    }
                $plswrk = $geteducomment['id'];
                  $geucd = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$geteducomment['user']."'"));  
                  echo "
                    <div class='comment_section1' id='a$cmtid' style='padding-top: 35px;'>
                    <div class='fet' style='display: flex;'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div>
                    <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$geteducomment['id']."'>
                    <a href='/students_connect/user/".$upc['user']."'><i></i>".$geucd['surname']." ".$geucd['firstname']."</a></div>
                    <div class='comcnt'>".wordwrap($geteducomment['cmt'], 60, "<br />")."</div>
                    <div class='posted'>".date('Y M d h:i a', $geteducomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                    <span><i class='fas fa-caret-up'
                      id='ror".$geteducomment['id']."'></i><span class='tccnt' id='utcnt".$geteducomment['id']."'>
                     ".$geteducomment['tun']."</span></span>
                    </div><div class='cdv ccmn cdwn'><span><i class='fas fa-caret-down' 
                     id='dror".$geteducomment['id']."'></i><span class='tccnt' id='dutcnt".$geteducomment['id']."'
                     >".$geteducomment['tdn']."</span></span></div>
                    <div class='cshr ccmn cdwn'  id='reply".$geteducomment['id']."'>
                    <input type='hidden' name='pid' value='".$medu['id']."'>
                    <input type='hidden' name='cid' value='".$geteducomment['id']."'>
                    <button type='submit' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                    <div class='cupv ccmn cdwn report'>Report</div>
                    </div></div></div>
                    ".$vpns."
                    </div>
                    ";
                    }
            }
            else {
                echo "Post doesn't exist";
            }
        }
        if(isset($myid)){
            $postid = $myid;
            $request = queryMysql("SELECT * FROM socposts WHERE id='$postid'");
            if($request->num_rows){
                $edu = (queryMysql("SELECT * FROM socposts WHERE id='$postid'"));  
          $medu = mysqli_fetch_assoc($edu);
          $ttime = $medu['timeofupdate'];
          $ctime = time();
          if(($ctime - $ttime) < 60){
            $ftime = (int) $ctime - $ttime;
            $ftime.="s";
          }
          elseif (($ctime - $ttime) > 60 && ($ctime - $ttime) < 3600){
            $ftime = (int) (($ctime - $ttime)/60);
            $ftime.= "m";
          } 
          elseif(($ctime - $ttime) > 3600 && ($ctime - $ttime) < 86400){
            $ftime = (int) (($ctime - $ttime)/3600);
            $ftime .=  "h";
          }
          elseif(($ctime - $ttime) > 86400 && ($ctime - $ttime) < 604800){
            $x = (int)(($ctime - $ttime));
            if($x > 86400 && $x < ($ttime-strtotime('24 hours ago'))){
              $ftime = 'Yesterday at '.date("h:i a", $ttime);
            }
            else {
              $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
            }
          }
          else {
            $ftime = date("M d h:i a", $ttime);
          }
          $us = $medu['user'];
          $usr = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$us'"));
      $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
        $id = $medu['id'];
        $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
        $chlov = mysqli_fetch_array($lov);
        $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
        $chdwn = mysqli_fetch_array($dwnp);
        $rwlov = (int) mysqli_num_rows($lov); 
        $fl = $rwlov - 1;
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC LIMIT 1");  
        $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
        $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='liked' AND id='".$medu['id']."'");
         $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
         AND loved='disliked' AND id='".$medu['id']."'");
      if($medu['isshare'] == 0){
        echo <<<PSTS
        <div class='camp'>
        <div class='amps' id='soc
        PSTS;
        echo $medu['id']."'>";
        echo <<<PSTS
             <div class='ipt'></div><div class='namp'>
        PSTS;
        $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
        if(file_exists($medu['user'].".png")){ 
            $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
            chdir($td);
          }
        else {
          chdir($td);
           $img =  '/students_connect/user.png';
              }
            chdir($td);
        echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'
        ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
        <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div></div>";
        echo '<div class="mpst">';
                  $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                  <div class="readmore">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                  echo nl2br($pstcut).'</div>';
                  $tpeid = $medu['id'];
                $etime = time();
                
                    $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='1'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = '0'; 
                        }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                      $buttons = 'disabled';
                      $for = "";
                                  $ffr = "";
                      if(empty($xed['opt3']) || $xed['opt3'] == NULL){
                        $for = "style='display: none;'";
                      }
                      if(empty($xed['opt4']) || $xed['opt4'] == NULL){
                        $ffr = "style='display: none;'";
                      }
                      echo "<div class='shpollpost'>
                    <div class='thopts'>
                    <div class='tfopt mopts'>
                    <button class='lastpl p-1' id='p_1' $buttons value='1'>
                    ".$gpo['opt1']."
                    
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2'>"
                    .$gpo['opt2']."
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                    .$gpo['opt3']."
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4'>"
                    .$gpo['opt4']."
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes . Login to vote</div>
                    </div>";
                    } 
                  
                  $arr = array();
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/s/");
                    
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png";
                        array_push($arr, $files[$i]);
                      }
                    }
                    chdir($td);
                $data = count($arr);
                if($data == 1){
                  $da = 1;
                }
                else {
                  $da = 2;
                }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/s/");
                    
                  for($i = 0; $i < 2; $i++){ 
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';

                    if(file_exists($medu['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp4' type='video/mp4'>
                      </video>
                      </div>
                      ";              
                              
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";                      
                  }
                    chdir($td);
                  echo '</div></div>
                  <div class="posted">'.$ftime.'</div>';
                }
                else {
                  if($medu['sharedby'] == $mbse['user']){
                      $shrus = 'You';
                    }
                    else {
                        $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                    }
                    $shr = $shrus." shared <a href='/students_connect/user".$mbse['user']."'>
                    <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                    echo <<<PSTS
                    <div class='camp'>
                    PSTS;
                    echo <<<PSTS
                     <div class='amps' id='
                    PSTS;
                    echo $medu['id']."'>";
                    echo <<<PSTS
                        <div class='ipt'></div><div class='namp'>
                  PSTS;
                  $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sharedby']."'"));
                  $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                  if(file_exists($mbss['user'].".png")){ 
                    $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                    chdir($td);  
                  }
                    else {
                      chdir($td);
                        $img =  '/students_connect/user.png';
                    }
                    chdir($td);
                    echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbss['user']."'>
                    <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                    <div class='name'>".$mbss['surname']." ".$mbss['firstname']."</a></div></div></div>";
                    echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                    $pstcute = strlen($medu['sharedpstcont']) > 250 ? substr($medu['sharedpstcont'], 0, 150).'&hellip;
                    <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr'.$medu['id'].'">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['sharedpstcont'];
                    echo nl2br($pstcute).'</div>';
                    $td = getcwd();
                    chdir("../../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
                    if(file_exists($mbse['user'].".png")){ 
                      $simg =  '/students_connect_hidden/users_profile_upload/'.$mbse['user'].'/'.$mbse['user'].'.png';
                      chdir($td);  
                    }
                      else {
                        chdir($td);
                          $simg =  '/Students_connect/user.png';
                      }
                    echo "<div class='eap' style='padding-bottom: 40px;'>
                    <div class='tsp' onclick='ops(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                     style='cursor: pointer; min-height: 120px;'>
                    <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                    <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                    <div class='name'>".$mbse['surname']." ".$mbse['firstname']."</a></div></div>";
                    echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                    $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                    <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                    echo nl2br($pstcut).'</div>
                    <div class="allimgposted"><div class="postimages">';
                    $arr = array();
                    $td = getcwd();
                    chdir("../../../students_connect_hidden/postuploads/s");
                    for($i = 0; $i < 20; $i++){ 
                        if(file_exists($medu['sharedpostid']."(".$i.").png")){
                          $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png";
                          array_push($arr, $files[$i]);
                        }
                      }
                      chdir($td);
                  $data = count($arr);
                  $da = $data/2;
                    echo '<div class="allimgposted" style="column-count: '.(int) $da.';"><div class="aimg">';
                    $td = getcwd();
                      chdir("../../../students_connect_hidden/postuploads/s");
                    for($i = 0; $i < 6; $i++){ 
                      if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                        echo "
                        <div class='postimages'>
                        <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                        <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                  }
                      else {
                        echo "";                     }
                      }
                    chdir($td);
                    echo '</div></div></div>
                    </div></div>';
                    echo '<div class="posted">'.$ftime.'</div>';
                }
                  echo '
                  <div class="pwl"> ';
                  if($fl == 1){
                    $other  = 'other';
                    global $other;
                  }
                  else {
                    $other = 'others';
                    global $other;
                  }
                    global $dwns;
                  
                  $chlov['user'] = 'You';
                  if($chlov['user'] == $user){
                  if($rwlov == 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="svl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="far fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                  }
                  elseif($rwlov > 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="svl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="far fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                  }
                }
                else {
                  if($rwlov == 1){
                    echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="svl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="far fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                  }
                  elseif($rwlov > 1){
                    echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="svl" value="'.$medu["id"].'">
                    <button type="submit" id="lbn">
                    <i class="far fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                  }
                }
                if($lvd->num_rows){
                  $clr = 'color: pink;';
                }
                else {
                  $clr = 'color: inherit';
                }
                if($dlkd->num_rows){
                  $color = 'color: red;';
                }
                else {
                  $color = 'color: inherit';
                }
                echo "
    
              ";
                $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$medu['id']."'"));
              $getsoccomment = mysqli_fetch_array($soccomment);
                  echo '</div>
                  <br><div class="undbtn sundbtn"><div class="lkd cmn dwn">
                  <span id="love'.$medu['id'].'" style="'.$clr.'"><i class="far fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                  '.$msoc['tln'].'</div>
                  </div>
                  <div class="cmt cmn dwn" id="commt">
                  <input type="hidden" name="spid" value="'.$medu["id"].'">
                    <input type="hidden" name="scid" value="'.$getsoccomment["id"].'">
                    <button type="submit" class="sbm">
                  <span><i class="far fa-comment"></i></span>
                  <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.$medu['pnc'].'</div></div></button>
                  </div><div class="shr cmn dwn" style="padding: 10px;">
                  <span><i class="fas fa-share"></i></span></div>
                  <div class="oth cmn dwn"><span><i class="fas fa-ellipsis-v" style="padding: 7px;"></i></span>
                  </div></div>
                  ';
                if(mysqli_num_rows($soccomment) == 0){  
                    //leave space blank
                  }
                  else {
                    $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment DESC");
                    while($getsoccomment = mysqli_fetch_array($soccomment)){
                    $aus = $getsoccomment['user'];
                    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                    $getreplyn = queryMysql("SELECT * FROM replysoccomments WHERE postid='".$getsoccomment['postid']."' AND cmtid='".$getsoccomment['id']."'");
                    if($getreplyn->num_rows == 0){
                      // kindly display nothing ❤
                      $vpns = "";
                      global $vpns;
                  }
                  else {
                    $p = mysqli_num_rows($getreplyn);
                    if($p == 1){
                      $r = "Reply";
                    }
                    else {
                        $r = "Replies";
                    }
                    $vpns = "               
                    <div class='repv'>
                    <div class='nmrp'></div><button class='dbsb' onclick='opensReplyContent(".$getsoccomment['id'].", \"".$getsoccomment['postid']."\")' id='dbsb".$getsoccomment['id']."' 
                    >View ".$p."
                     ".$r."</button></div>
                     <div id='dsplrp".$getsoccomment['id']."'></div>";
                    global $vpns;
                  }
                  
                     if(file_exists("../../../students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/'.$getsoccomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                      }
                      else {
                          $pimg =  '/students_connect/user.png';
                      }
                  $plswrk = $getsoccomment['id'];
                  $geucd = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$getsoccomment['user']."'"));  
                  echo "
                    <div class='comment_section1' id='s".$getsoccomment['id']."' style='padding-top: 35px;'>
                    <div class='fet' style='display: flex;'>
                    <div class='phead imgapstr' style='
                    background-image: url(\"".$pimg."\");'></div>
                    <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$getsoccomment['id']."'>
                    <a href='/students_connect/user/".$upc['user']."'><i></i>".$geucd['surname']." ".$geucd['firstname']."</a></div>
                    <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                    <div class='posted'>".date('Y M d h:i a', $getsoccomment['timeofcomment'])."</div>
                    <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                    id='tclfh".$getsoccomment['id']."'>
                  <span><i class='far fa-heart'></i></span>
                  </div>
                  <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                  <input type='hidden' name='pid' value='".$medu['id']."'>
                  <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                  <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                  <div class='cupv ccmn cdwn scbtn report'>Report</div>
                  </div></div></div>

                    ".$vpns."
                    </div>
                    ";
                  }
                }
              }
              else {
                echo "<div class='pdex' style='font-size: 25px; margin:auto;'>Post doesn't exist</div>
                    <div class='gb2hp'><a href='/students_connect/login.php'>Login</a></div>";
              }
        }  
?>