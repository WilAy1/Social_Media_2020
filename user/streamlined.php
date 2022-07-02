<!DOCTYPE html>
<html lang="en-ng" id='quest'>
<head>
<title>Sign Up / Log In - StudCo</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="/students_connect/cssf/style.css" type="text/css">
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
<div id='loginpop' style='display: none'>
<div class='lpopx' id='lpopx'></div>
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
if(isset($iam)){
$abc = $iam;
    $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$abc'"));
    echo <<<_END
    <div class='bd'>
    <div class='fp'>
    <div class='u_fp'>
    _END;
    if(file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user']."/cover/cover.png")){
      $bx = 'background-image: url("/students_connect_hidden/users_profile_upload/'.$upc['user'].'/cover/cover.png")';
    }
    else {
      $bx = '';
    }
    if (file_exists("../../../students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png"))
      {
        echo "<div class='cvrp'>
        <div class='tsap' id='tsap'>
        <div class='profileimg' style='width: 100%; height: 150px; background: brown; position: relative; $bx; background-position: center;'>
        <input type='file' id='fille' style='display: none;'>
        </div>
        <div class='profile_side'><div id='img_link'>
        <div id='img_profile' style='background-image:url(\"/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png\"); background-size: 100%;'></div>
        <img src='/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png' style='height: 180px; width: 180px;
         background-size: 100%; opacity: 0; position: absolute;'
         id='img_profile'></div></div>";
         $xell = "/students_connect_hidden/users_profile_upload/".$upc['user'].'/'.$upc['user'].".png";
      }
      else {
        echo "<div class='cvrp'>
        <div class='tsap'>
        <div class='profileimg' style='width: 100%; height: 150px; background: brown; position: relative; $bx; background-position: center;'>
        </div>
        <div class='profile_side'>
        <div id='img_link'>
        <div id='img_profile' style='background-image:url(\"/students_connect/user.png\"); background-size: 100%;'></div>
        <img style='height: 180px; width: 180px;
        background-size: 100%; opacity: 0; position: absolute;'
        id='img_profile' src='/students_connect/user.png'></div></div>"; 
        $xell = "/students_connect/user.png";
      }
    
     
      echo <<<_LAUGH
      <div class='bf_unme'>
      <div class="users_name">
    
    _LAUGH;
    
  echo <<<_LAUGH

  <div class="users_name">

_LAUGH;


  
  echo "<div class='fix_name'><div class='f_s_name'>".$upc['surname']. " " .$upc['firstname']."</div>
  <div class='u_name'><i class='fas fa-at'></i>".$upc['user']."</div>
  </div>";
    if(isset($_POST['sendposts'])){
   $sendposts = allposts($_POST['sendposts']);
    }
    $about = '';
  echo <<<_END
  <div class='abouty'><span class='tzabout'></span><div class='yabt'>$about</div></div>
  </div></div>
  _END;


$mus = $upc['user'];
$mownpab = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE (user='$mus' AND pstst=0 AND sharedby='$mus') OR
(user != '$mus' AND sharedby = '$mus' AND pstst=0)
 UNION ALL
 SELECT * FROM socposts WHERE (user='$mus' AND pstst=1 AND sharedby='$mus') OR
(user != '$mus' AND sharedby = '$mus' AND pstst=1)
ORDER BY timeofupdate DESC"));
echo "
</div>
<div class='smen'>
<div class='pes'>
<input type='hidden' name='try'/>
<button type='button' name='subfol' class='cbr xcbr'>
<input type='hidden' value='".$upc['user']."'>
<input type='hidden' value='".$xell."'>
<div class='flw'><i class='fas fa-user-plus icf'></i>Follow</div></button>
</div>
<div class='pes'>
<form method='post' class='edxd' action='/students_connect/messages/'>
<input type='hidden' value='".$upc['user']."'>
<input type='hidden' value='".$xell."'>
<button type='submit' class='cbr xcbr'>
<div class='msg'><i class='fas fa-envelope icf'></i> Message </div></button></form></div>
<div class='pes'>
<form method='post' action=''>
<button type='submit' class='cbr xcbr'>
<div class='chp'><i class='fas fa-camera icf'></i> Photos</div></button></form></div>
</div>
</div>
<div class='xyze' id='oopye'>
<div class='tnavtop xtnavtop'>
<input type='hidden' id='integhide' value='".$upc['user']."'>
<div class='xt_1 arrgaccdn practive'>Posts</div>
<div class='xt_2 arrgaccdn'>
<input type='hidden' value='".$upc['user']."'>
<input type='hidden' value='".$xell."'>
Profile</div>
<div class='xt_3 arrgaccdn'>
<input type='hidden' value='".$upc['user']."'>
<input type='hidden' value='".$xell."'>
Followers</div>
<div class='xt_4 arrgaccdn'>
<input type='hidden' value='".$upc['user']."'>
<input type='hidden' value='".$xell."'>
Following</div>
</div>
<div class='y_x' id='yx_x'>
<input type='hidden' value='' id='xyxlt'>
<div id='ldrfmp' style='display: none;'></div>
<div id='tnewptag' style='display: none;'>New Posts Available</div>
";
  $asd = $iam;
  $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$asd'"));
    $user = $upc['user'];
    $abc = queryMysql("SELECT * FROM eduposts WHERE user='$user' OR sharedby='$user'");
    $def = queryMysql("SELECT * FROM socposts WHERE user='$user' OR sharedby='$user'");
    if($upc['status'] == '1' || $upc['status']== '2'){
    if (mysqli_num_rows($abc) || mysqli_num_rows($def)) {
       $edu = (queryMysql("SELECT * FROM eduposts WHERE (user='$user' AND pstst=0 AND sharedby='$user') OR
        (user != '$user' AND sharedby = '$user' AND pstst=0)
         UNION ALL
         SELECT * FROM socposts WHERE (user='$user' AND pstst=1 AND sharedby='$user') OR
        (user != '$user' AND sharedby = '$user' AND pstst=1)
       ORDER BY timeofupdate DESC"));
         if(!empty($edu)){
           while($medu = mysqli_fetch_assoc($edu)) { 
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
             elseif(($ctime - $ttime) > 86000 && ($ctime - $ttime) < 604800){
               $x = (int)(($ctime - $ttime));
               if($x < (86000 * 2)){
                 $ftime = 'Yesterday at '.date("h:i a", $ttime);
               }
               else {
                 $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
               }
             }
             else {
               $ftime = date("M d h:i a", $ttime);
             }
             if($medu['pstst'] == 0){
             $n = (queryMysql("SELECT pstcont FROM eduposts WHERE user='$user' AND sharedby='$user'"));
             $id = $medu['id'];
             $vot = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='upvote' ORDER BY timeofvote DESC");
             $chvot = mysqli_fetch_array($vot);
             $dwnp = queryMysql("SELECT * FROM votes WHERE id='$id' AND voted='downvote'");
             $chdwn = mysqli_fetch_array($dwnp);
             $rwvot = (int) mysqli_num_rows($vot); 
             $fl = $rwvot;
             $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' ORDER BY
              tun or tnc desc LIMIT 1"); 
             if(($medu['user']==$user && $medu['sharedby'] == $user)
                || ($medu['user'] != $user && $medu['sharedby'] == $user)){
                 $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
                 if($medu['isshare'] == 0){
                 echo <<<PSTS
                     <div class='camp'>
                     PSTS;
                     if($medu['pinterest'] != '0' || !empty($medu['pinterest'])){
                      echo "<div class='phonetags' style='display: flex;'>
                      "; 
                      $tg = explode(",",$medu['pinterest']);
                     sort($tg);
                     if(count($tg) <=4){
                     for($i = 0; $i < count($tg); $i++){
                     echo "
                     <div class='ttags' style='padding: 5px; dipslay: none; margin-right:6px;'>
                     <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                     }
                   }
                   else {
                     for($i = 0; $i < 4; $i++){
                       echo "
                       <div class='ttags' style='padding: 5px; margin-right:6px;'>
                       <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                       }
                       echo "<div class='ttags phown' id='trtags' style='padding: 5px; margin-right:6px;' onclick='disptOths()'>...</div>";
                   }
                   echo "<div class='smoretags' 
                     id='moretags' style='display: none;'>";
                   for($i = 4; $i < count($tg); $i++){
                     echo "
                     <div class='ttags' padding: 5px; margin-right:6px;'>
                     <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
                     </div>";
                 }
                 echo "</div>";
                 echo "</div>"; 
                }
                     
                     $sid = $medu['id'];
                     echo <<<PSTS
                      <div class='amps' id='
                     PSTS;
                     echo $medu['id']."'>";
                     
                     echo <<<PSTS
                         <div class='ipt'></div><div class='namp'>
                         <div class='esign' style='float: right; cursor: pointer;'>
                          
                          </div>
                     
                     PSTS;
                     if($medu['pinterest'] != '0' || !empty($medu['pinterest'])){
                     echo "<div class='ptags' style='float: right; display: flex;'>";
                      $tg = explode(",",$medu['pinterest']);
                     sort($tg);
                     if(count($tg) <=4){
                     for($i = 0; $i < count($tg); $i++){
                     echo "
                     <div class='ttags' style='padding: 5px; margin-right:6px;'>
                     <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                     }
                   }
                   else {
                     for($i = 0; $i < 4; $i++){
                       echo "
                       <div class='ttags' style='padding: 5px; margin-right:6px;'>
                       <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                       }
                       echo "<div class='ttags' id='zymbxs' style='padding: 5px; margin-right:6px;' onclick='dispOths()'>...</div>";
                   }
                   for($i = 4; $i < count($tg); $i++){
                     echo "<div class='ttags own' 
                     id='moretags' style='display: none; padding: 5px; margin-right:6px;'>
                     <a href='/students_connect/search?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
                     </div>";
                 }
                 echo "</div>";
               }
                     
                   $td = getcwd();
                   chdir("../../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
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
                     <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                     $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                     <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                     $pstcut = str_replace("search=\r\n", "", $pstcut);            
                     echo nl2br($pstcut).'</div>';
                     $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
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
                         <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png\")'></div>
                         <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png'></div>";
                   }
                       else {
                         echo "";                     }
                       }
                     echo '</div></div>';
                     echo '<div class="allimgposted"><div class="aimg">';
                     if(file_exists($medu['id']."(0).mp4")){
                       echo "
                       <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                       <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp4' type='video/mp4'>
                       </video></div>
                       ";                      
                   }
                   echo "</div></div>";
                   echo '<div class="allimgposted"><div class="aimg">';
                     if(file_exists($medu['id']."(0).mp3")){
                       echo "
                       <div class='postaudio'>
                       
                       <audio controls class='paudio'>
                       <source src='/students_connect_hidden/postuploads/".$medu['id']."(0).mp3' type='video/mp4'>
                       </video></div>
                       ";                      
                   }
                   chdir($td);
                     echo '</div></div>
                     <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
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
                     <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
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
                     <div class='tsp' onclick='op(\"".$medu['sharedpostid']."\",\"".$medu['sharedby']."\")'
                      style='cursor: pointer; min-height: 120px;'>
                     <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                     <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                     <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                     $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                     <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                     echo nl2br($pstcut).'</div>';
                     $arr = array();
                     $td = getcwd();
                     chdir("../../../students_connect_hidden/postuploads/");
                     for($i = 0; $i < 2; $i++){ 
                         if(file_exists($medu['sharedpostid']."(".$i.").png")){
                           $files[$i] = "/Students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png";
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
                       if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                         echo "
                         <div class='postimages'>
                         <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png\")'></div>
                         <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png'></div>";
                   }
                       else {
                         echo "";                     }
                       }
                       echo '</div>
                     </div>';
                       echo '<div class="allimgposted"><div class="aimg">';
                       if(file_exists($medu['sharedpostid']."(0).mp4")){
                         echo "
                         <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                         <source src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                         </video></div>
                         ";                      
                     }
                     echo "</div></div>";
                   echo '<div class="allimgposted"><div class="aimg">';
                     if(file_exists($medu['sharedpostid']."(0).mp3")){
                       echo "
                       <div class='postaudio'>
                       <div class='audiops'>Audio</div>
                       <audio controls class='paudio'>
                       <source src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(0).mp3' type='video/mp4'>
                       </video></div>
                       ";                      
                   }
                     chdir($td);
                     echo '</div></div></div></div>';
                     echo '<div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
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
                     
                     echo '</div>
                     <div class="undbtn"><div class="upv cmn dwn" id="upv'.$medu['id'].'" 
                     ><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="cntl'.$medu['id'].'"
                      style="color: inherit !important;">'.$medu['tun'].'</div>
                     </div><div class="lwv cmn dwn" id="dwn'.$medu['id'].'"><span style="vertical-align: sub"><i class="fas fa-caret-down ycd"></i></span></div>
                     <div class="cmt cmn dwn" id="commt">
                     <button type="button" class="sbm">
                     <span><i class="far fa-comment dwtwc"></i></span>
                     <div class="cnt cmn xod xess" id="cntc'.$medu['id'].'">'.$medu['pnc'].'</div></button></div>
                     <div class="shr cmn dwn" style="padding: 10px;">
                     <span id="sh'.$medu['id'].'"><i class="fas fa-share"></i></span></div>
                     </div>
                     ';
                     if(mysqli_num_rows($educomment) == 0){  
                       //leave space blank
                       echo "
                       <div class='comment_section' id='cmtedu".$medu['id']."'></div>";
                     }
                     else {
                       
                        $gd = getcwd();
                        chdir("../../../Students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/');
                        if(file_exists($geteducomment['user'].".png")){ 
                         $pimg =  '/students_connect_hidden/users_profile_upload/'.$geteducomment['user'].'/'.$geteducomment['user'].'.png';
                         chdir($gd);  
                       }
                         else {
                             $pimg =  '/students_connect/user.png';
                             chdir($gd);
                           }
                           chdir($gd);
                       $aus = $geteducomment['user'];
                       $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                       echo "
                       <div class='comment_section' id='cmtedu".$medu['id']."' style='background-color: rgb(245, 245, 245, 0.4);'>
                       <div class='commt_cont'>
                       <div class='uswc' style='display: flex;'>
                       <div class='fet'>
                       <div class='phead imgapstr' style='
                       background-image: url(\"".$pimg."\");'></div></div>
                       <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                       <div class='comcnt'>".wordwrap($geteducomment['cmt'], 60, "<br />")."</div>
                       <div class='posted'>".date('M d h:i a', $geteducomment['timeofcomment'])."</div>
                       <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                       <span>
                        <i class='fas fa-caret-up' id='ror".$geteducomment['id']."'></i></span>
                       </div><div class='cdv ccmn cdwn'><span>
                       <i class='fas fa-caret-down'
                        id='dror".$geteducomment['id']."'></i></span></div>
                       <div class='cshr ccmn cdwn' id='reply".$geteducomment['id']."'>
                       <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                       <div class='cupv ccmn cdwn report'>Report</div>
                       </div>
                       </div></div>";
                     }
                               
                     echo '</div></div>';
                   }
                 }
                 else {
                  $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
           $id = $medu['id'];
           $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
           $chlov = mysqli_fetch_array($lov);
           $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
           $chdwn = mysqli_fetch_array($dwnp);
           $rwlov = (int) mysqli_num_rows($lov); 
           $fl = $rwlov;
           $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
           
         if(($medu['user']==$user && $medu['sharedby'] == $user)
         || ($medu['user'] != $user && $medu['sharedby'] == $user)){
          $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
          if($medu['isshare'] == 0){
         echo <<<PSTS
         <div class='camp'>
         <div class='amps' id='soc
         PSTS;
         echo $medu['id']."'>";
         
         echo <<<PSTS
              <div class='ipt'></div><div class='namp'>
              <div class='esign' style='float: right; cursor: pointer;'>
                  
                  </div>
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
         <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
         <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
         echo '<div class="mpst">';
                   $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                   <div class="readmore">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                   echo nl2br($pstcut).'</div>';
                   $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
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
                         <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
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
                       
                       <audio controls class='paudio'>
                       <source src='/students_connect_hidden/postuploads/s/".$medu['id']."(0).mp3' type='video/mp4'>
                       </video></div>
                       ";                      
                   }
                     chdir($td);
                   echo '</div></div>
                   <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
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
                     <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
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
                     <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                     $pstcut = strlen($medu['pstcont']) > 250 ? substr($medu['pstcont'], 0, 150).'&hellip;
                     <div class="readmore" onclick="rdmore(\''.$medu['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $medu['pstcont'];
                     echo nl2br($pstcut).'</div>';
                     $arr = array();
                     $td = getcwd();
                     chdir("../../../students_connect_hidden/postuploads/s");
                     for($i = 0; $i < 2; $i++){ 
                         if(file_exists($medu['sharedpostid']."(".$i.").png")){
                           $files[$i] = "/Students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png";
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
                       chdir("../../../students_connect_hidden/postuploads/s");
                     for($i = 0; $i < 2; $i++){ 
                       if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                         echo "
                         <div class='postimages'>
                         <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                         <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                   }
                       else {
                         echo "";                     }
                       }
                       echo '</div></div>';
                       echo '<div class="allimgposted"><div class="aimg">';
                       if(file_exists($medu['sharedpostid']."(0).mp4")){
                         echo "
                         <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                         <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                         </video></div>
                         ";                      
                     }
                     echo "</div></div>";
                   echo '<div class="allimgposted"><div class="aimg">';
                     if(file_exists($medu['sharedpostid']."(0).mp3")){
                       echo "
                       <div class='postaudio'>
                       
                       <audio controls class='paudio'>
                       <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp3' type='video/mp4'>
                       </video></div>
                       ";                      
                   }
                     chdir($td);
                     echo '</div></div></div>
                     </div>';
                     echo '<div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
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
                   
                   
                 echo "
     
               ";
                 $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$medu['id']."'"));
               $getsoccomment = mysqli_fetch_array($soccomment);
                   echo '</div>
                   <div class="undbtn sundbtn"><div class="lkd cmn dwn">
                   <span id="love'.$medu['id'].'"><i class="far fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                   '.$msoc['tln'].'</div>
                   </div>
                   <div class="cmt cmn dwn" id="commt">
                   <input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="scid" value="">
                     <button type="submit" class="sbm">
                   <span><i class="far fa-comment dwtwc"></i></span>
                   <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.$medu['pnc'].'</div></div></button>
                   </div><div class="shr cmn dwn" style="padding: 10px;">
                   <span><i class="fas fa-share"></i></span></div>
                   </div>
                   ';
                   if(mysqli_num_rows($soccomment) == 0){  
                     //leave space blank
                     echo "<div class='comment_section' id='cmt_sec".$medu['id']."'></div>";
                   }
                   else {
                     $aus = $getsoccomment['user'];
                     $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                     
                        $gd = getcwd();
                        $gd = getcwd();
                        chdir("../../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
                        if(file_exists($getsoccomment['user'].".png")){ 
                         $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                         chdir($gd);  
                       }
                         else {
                             $pimg =  '/students_connect/user.png';
                             chdir($gd);
                           }
                           chdir($gd);
                     echo "<div class='comment_section' id='cmt_sec".$medu['id']."'><div class='commt_cont'><div class='uswc' style='display: flex;'>
                     <div class='fet'>
                       <div class='phead imgapstr' style='
                       background-image: url(\"".$pimg."\");'></div></div>
                       <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                     <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                     <div class='posted'> ".date('M d h:i a', $getsoccomment['timeofcomment'])."</div>
                     <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                     id='tclfh".$getsoccomment['id']."'>
                     <span><i class='far fa-heart'></i></span>
                     </div>
                     <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                     <input type='hidden' name='pid' value='".$medu['id']."'>
                     <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                     <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                     <div class='cupv ccmn cdwn scbtn report'>Report</div>
                     </div>
                     </div></div>";
                   }
                             
                   echo '</div></div>';
       }
     }
                 }
               }
     else {
       echo "<div class='npst'>No post available!</div>";
     }
   }
    }
   elseif($upc['status'] == '3'){
    
     if (mysqli_num_rows($def)){
           $soc = queryMysql("SELECT * FROM socposts WHERE user='$user' AND pstst=1 ORDER BY timeofupdate DESC");
         if(mysqli_num_rows($soc) > 0){
           while($msoc = mysqli_fetch_assoc($soc)) {
            $ttime = $msoc['timeofupdate'];
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
             elseif(($ctime - $ttime) > 86000 && ($ctime - $ttime) < 604800){
               $x = (int)(($ctime - $ttime));
               if($x < (86000 * 2)){
                 $ftime = 'Yesterday at '.date("h:i a", $ttime);
               }
               else {
                 $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
               }
             }
             else {
               $ftime = date("M d h:i a", $ttime);
             }
            $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
            $id = $msoc['id'];
            $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
            $chlov = mysqli_fetch_array($lov);
            $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
            $chdwn = mysqli_fetch_array($dwnp);
            $rwlov = (int) mysqli_num_rows($lov); 
            $fl = $rwlov;
            $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
            if(($msoc['user']==$user && $msoc['sharedby'] == $user)
          || ($msoc['user'] != $user && $msoc['sharedby'] == $user)){
           $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$msoc['user']."'"));
           
           if($msoc['isshare'] == 0){
          echo <<<PSTS
          <div class='camp'>
          <div class='amps' id='soc
          PSTS;
          echo $msoc['id']."'>";
          
          echo <<<PSTS
               <div class='ipt'></div><div class='namp'>
               <div class='esign' style='float: right; cursor: pointer;'>
                   
                   </div>
          PSTS;
          $td = getcwd();
                      chdir("../../../students_connect_hidden/users_profile_upload/".$msoc['user'].'/');
          if(file_exists($msoc['user'].".png")){ 
              $img =  '/students_connect_hidden/users_profile_upload/'.$msoc['user'].'/'.$msoc['user'].'.png';
              chdir($td);
            }
          else {
            chdir($td);
             $img =  '/students_connect/user.png';
                }
              chdir($td);
          echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'
          ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
          <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
          <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
          echo '<div class="mpst">';
                    $pstcut = strlen($msoc['pstcont']) > 250 ? substr($msoc['pstcont'], 0, 150).'&hellip;
                    <div class="readmore">Read More <i class="fas fa-angle-double-down"></i></div>' : $msoc['pstcont'];
                    echo nl2br($pstcut).'</div>';
                    $tpeid = $msoc['id'];
                 $etime = time();
                 $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
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
                          if(file_exists($msoc['id']."(".$i.").png")){
                            $files[$i] = "/Students_connect_hidden/postuploads/s/".$msoc['id']."(".$i.").png";
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
                        if(file_exists($msoc['id']."(".$i.").png")){  
                          echo "
                          <div class='postimages'>
                          <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$msoc['id']."(".$i.").png\")'></div>
                          <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$msoc['id']."(".$i.").png'></div>";
                    }
                        else {
                          echo "";                     }
                        }
                        echo '</div></div>';
                        echo '<div class="allimgposted"><div class="aimg">';
    
                        if(file_exists($msoc['id']."(0).mp4")){
                          echo "
                          <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                          <source src='/students_connect_hidden/postuploads/s/".$msoc['id']."(0).mp4' type='video/mp4'>
                          </video>
                          </div>
                          ";              
                                  
                      }
                      echo "</div></div>";
                    echo '<div class="allimgposted"><div class="aimg">';
                      if(file_exists($msoc['id']."(0).mp3")){
                        echo "
                        <div class='postaudio'>
                        
                        <audio controls class='paudio'>
                        <source src='/students_connect_hidden/postuploads/s/".$msoc['id']."(0).mp3' type='video/mp4'>
                        </video></div>
                        ";                      
                    }
                      chdir($td);
                    echo '</div></div>
                    <div class="posted" id="posted'.$msoc['id'].'">'.$ftime.'</div>';
                  }
                  else {
                    $shr = $shrus." shared <a href='/students_connect/user".$mbse['user']."'>
                      <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                      echo <<<PSTS
                      <div class='camp'>
                      PSTS;
                      echo <<<PSTS
                       <div class='amps' id='
                      PSTS;
                      echo $msoc['id']."'>";
                      echo <<<PSTS
                          <div class='ipt'></div><div class='namp'>
                    PSTS;
                    $mbss = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$msoc['sharedby']."'"));
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
                      <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                      <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                      echo '<div class="mpst" id="mpst'.$msoc['id'].'" style="min-height: 30px;">';
                      $pstcute = strlen($msoc['sharedpstcont']) > 250 ? substr($msoc['sharedpstcont'], 0, 150).'&hellip;
                      <div class="readmore" onclick="rdmore(\''.$msoc['id'].'\')" id="readmr'.$msoc['id'].'">Read More <i class="fas fa-angle-double-down"></i></div>' : $msoc['sharedpstcont'];
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
                      <div class='tsp' onclick='ops(\"".$msoc['sharedpostid']."\",\"".$msoc['sharedby']."\")'
                       style='cursor: pointer; min-height: 120px;'>
                      <div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
                      <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                      <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                      <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                      echo '<div class="mpst" id="mpst'.$msoc['id'].'">';
                      $pstcut = strlen($msoc['pstcont']) > 250 ? substr($msoc['pstcont'], 0, 150).'&hellip;
                      <div class="readmore" onclick="rdmore(\''.$msoc['id'].'\')" id="readmr">Read More <i class="fas fa-angle-double-down"></i></div>' : $msoc['pstcont'];
                      echo nl2br($pstcut).'</div>';
                      $arr = array();
                      $td = getcwd();
                      chdir("../../../students_connect_hidden/postuploads/s");
                      for($i = 0; $i < 2; $i++){ 
                          if(file_exists($msoc['sharedpostid']."(".$i.").png")){
                            $files[$i] = "/Students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(".$i.").png";
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
                        chdir("../../../students_connect_hidden/postuploads/s");
                      for($i = 0; $i < 2; $i++){ 
                        if(file_exists($msoc['sharedpostid']."(".$i.").png")){  
                          echo "
                          <div class='postimages'>
                          <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(".$i.").png\")'></div>
                          <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(".$i.").png'></div>";
                    }
                        else {
                          echo "";                     }
                        }
                        echo '</div></div>';
                        echo '<div class="allimgposted"><div class="aimg">';
                        if(file_exists($msoc['sharedpostid']."(0).mp4")){
                          echo "
                          <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                          <source src='/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(0).mp4' type='video/mp4'>
                          </video></div>
                          ";                      
                      }
                      echo "</div></div>";
                    echo '<div class="allimgposted"><div class="aimg">';
                      if(file_exists($msoc['sharedpostid']."(0).mp3")){
                        echo "
                        <div class='postaudio'>
                        
                        <audio controls class='paudio'>
                        <source src='/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(0).mp3' type='video/mp4'>
                        </video></div>
                        ";                      
                    }
                      chdir($td);
                      echo '</div></div></div>
                      </div>';
                      echo '<div class="posted" id="posted'.$msoc['id'].'">'.$ftime.'</div>';
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
                    
                    
                  echo "
      
                ";
                  $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$msoc['id']."'"));
                $getsoccomment = mysqli_fetch_array($soccomment);
                    echo '</div>
                    <div class="undbtn sundbtn"><div class="lkd cmn dwn">
                    <span id="love'.$msoc['id'].'"><i class="far fa-heart"></i></span><div class="cnt cmn lkdcnt'.$msoc['id'].'" id="lkdcnt'.$msoc['id'].'">
                    '.$msoc['tln'].'</div>
                    </div>
                    <div class="cmt cmn dwn" id="commt">
                    <input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="scid" value="">
                      <button type="submit" class="sbm">
                    <span><i class="far fa-comment dwtwc"></i></span>
                    <div class="cnt cmn cmnt'.$msoc['id'].'"><div class="cnmb">'.$msoc['pnc'].'</div></div></button>
                    </div><div class="shr cmn dwn" style="padding: 10px;">
                    <span><i class="fas fa-share"></i></span></div>
                    </div>
                    ';
                    if(mysqli_num_rows($soccomment) == 0){  
                      //leave space blank
                      echo "<div class='comment_section' id='cmt_sec".$msoc['id']."'></div>";
                    }
                    else {
                      $aus = $getsoccomment['user'];
                      $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                      
                         $gd = getcwd();
                         $gd = getcwd();
                         chdir("../../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
                         if(file_exists($getsoccomment['user'].".png")){ 
                          $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                          chdir($gd);  
                        }
                          else {
                              $pimg =  '/students_connect/user.png';
                              chdir($gd);
                            }
                            chdir($gd);
                      echo "<div class='comment_section' id='cmt_sec".$msoc['id']."'><div class='commt_cont'><div class='uswc' style='display: flex;'>
                      <div class='fet'>
                        <div class='phead imgapstr' style='
                        background-image: url(\"".$pimg."\");'></div></div>
                        <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                      <div class='comcnt'>".wordwrap($getsoccomment['cmt'], 60, "<br />")."</div>
                      <div class='posted'> ".date('M d h:i a', $getsoccomment['timeofcomment'])."</div>
                      <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
                        id='tclfh".$getsoccomment['id']."'>
                      <span><i class='far fa-heart'></i></span>
                      </div>
                      <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
                      <input type='hidden' name='pid' value='".$msoc['id']."'>
                      <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
                      <button type='button' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                      <div class='cupv ccmn cdwn scbtn report'>Report</div>
                      </div>
                      </div></div>";
                    }
                          
                    echo '</div></div>';
        }
      }
                  }
                }
      else {
        echo "<div class='npst'>No post available!</div>";
      }
    }
echo "</div>
<div class='x_y' id='xy_y'></div>
<div class='t_x' id='xt_x'></div>
<div class='t_y' id='xt_y'></div>
</div></div></div>
<script src='/students_connect/jsf/filescript.js'></script>";
}
?>