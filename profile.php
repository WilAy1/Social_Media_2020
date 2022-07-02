<?php
require_once 'header2.php';
$a = queryMysql("SELECT userprofilecode FROM members");
 
if (!$loggedin) die();
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= sanitizeString('user');
    $logindat = strtotime($row['lastlogin'], time());
    $logindate = date("M-d", $logindat);
    $logintim = strtotime($row['lastlogin'], time());
    $logintime = date("h:i a", $logintim);
    $result = queryMysql("SELECT * FROM members WHERE user='$user'");
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
  $eeex = mysqli_num_rows($mecc);
echo <<<_END
  <style>
  @media (max-width: 800px) {
  #hmic {
    width: 16% !important;
  }
  #hmip {
    display: none !important;
  }
  .xesx {
    display: block !important;
    font-weight: 900;
  }
  }
  </style>
  <div class="navbar2">
  <ul id="navbar_list">
  <li id="hmic" style=''><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
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
        <li id="hmic" class='tbstr' style=''><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
    <li id="hmic" style=''><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
    <li id="hmic" class='xesx' style='display: none;' onclick='disnav(event)'>
    <a><i class='fas fa-bars'></i></a></li>
_END;
if(!file_exists("../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  echo "<li id='hmip' class='vmxm'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
}
else{
  echo "<li id='hmip' class='vmxm'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
    </ul>   
  </div>
  <div class='pycl'>
  <div class="dark-mode" id='darkmd' style="min-height:650px;">
  <div class="stb"><div class='ttrdad'><div class="ttr">
  <div class="shto">
  <div class="myde">
  <div class="shwpr" style='display: flex;'>
_END;
if(!file_exists("../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  $mmg = '/students_connect/user.png';
  echo "<div class='dmyimg'><div class='myimg'  style='background-image: url(\"$mmg\"); background-size: cover; background-position: 50% 50%; 
  background-repeat: no-repeat; height:50px; width:50px'></div></div>";
}
else{
  $mmg = "/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png";
  echo "<div class='dmyimg'><div class='myimg'  style='background-image:url(\"$mmg\"); background-size: cover; background-position: 50% 50%;
  background-repeat: no-repeat; height:50px; width:50px'></div></div>";
}

echo 
  '<div class="shwname"><a href="/students_connect/profile.php" id="shwname">'.$row['firstname']. ' ' .$row['surname'].'</a><div class="xadd">
  <a href="/students_connect/ac_manage">Switch Account</a></div></div>
  </div>
  <div class="online" id="online" style="display:none"></div>
  <div class="offline" id="offline" style="display:none"></div>
  <div class="lstlogin" id="lstlogin">Last Login: '.$logindate. "  '".$logintime.'</div>
  </div>

  <hr style="width:100%; border-bottom:1px;">
  <div class="pt2">
  <div class="listls">
  <div class="chngdp tgd" id="chngdp">
  <i class="fas fa-camera icf"></i> <a href="user_view.php">Change DP</a></div>
  <div class="updp tgd" id="updp">
  <i class="fas fa-user-edit icf"></i><a href="/students_connect/profile/fprofile">Update Profile</a></div>
  <div class="shmf tgd" id="smf">
  <i class="fas fa-user-friends icf"></i><a href="/students_connect/friends/">Followers | Following</a></div>
  <div class="shmm tgd" id="smm">
  <i class="fas fa-envelope icf"></i><a href="/students_connect/messages/">Messages</a></div>
  ';
  if($row['status'] != 3){
  echo '<div class="shmp tgd" id="smp"><div class="smpbu txgd">
  <a href="/students_connect/f"><i class="fas fa-box icf"></i>Forums</a></div>
  </div>';
  }
  echo "<hr style='width: 95%; margin: 0px; margin-bottom: 3px;'>";
  echo "<div class='mnt_ev tgd'>
  <div class='smpbu txgd'>
  <i class='fas fa-search icf'></i>
  <a href='/students_connect/discover'>Discover</a></div>
  </div>
  <!--<div class='mnt_ev tgd'>
  <div class='smpbu txgd'><a href='/students_connect/trend'>
  <i class='fas fa-bolt icf'></i>Trending</a></div>
  </div>-->";
  echo "<hr style='width: 95%; margin: 0px; margin-bottom: 3px;'>";
  echo "<div class='mnt_ev tgd'>
  <div class='smpbu txgd'>
  <i class='fas fa-ad icf'></i>
  <a href='/students_connect/ads'>Advertise</a></div>
  </div>
  <div class='mnt_ev tgd'>
  <div class='smpbu txgd'><a href='/students_connect/donate'>
  <i class='fas fa-donate icf'></i>Donate</a></div>
  </div>";
  echo "<hr style='width: 95%; margin: 0px; margin-bottom: 3px;'>";
  echo '
  <div class="smse tgd">
  <div class="smse txgd smpbu" id="sms smp">
  <i class="fas fa-user-cog icf"></i><a href="/students_connect/settings/">Settings</a></div>
  </div>
  <div class="shmm tgd" id="smm">
  <i class="fas fa-power-off icf"></i> <a href="/students_connect/logout.php">Logout</a></div>
  <div class="s2d">
  <div class="askdkm">Toggle Between Light | Dark Mode</div>
  <div class="msw">
  <label class="switch">
  <input id="input" class="dchngr" type="checkbox" name="darkmode" onclick="storeDark()"><span class="slider round"></span></label></div>
  </div></div></div></div></div></div>';

  $bx = '';  
  if(file_exists("../students_connect_hidden/users_profile_upload/".$row['user']."/cover/cover.png")){
    $bx = 'background-image: url("/students_connect_hidden/users_profile_upload/'.$row['user'].'/cover/cover.png")';
  }
  if (file_exists("../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png"))
  {
    echo "<div class='ttl'><div class='cvrp'>
    <div class='tsap' id='tsap'>
    <div class='profileimg' style='width: 100%; height: 150px; background-color: brown; $bx; background-position: center; position: relative;'>
    <a href='user_view.php'>
    <label for='fille'>
    <i class='fas fa-camera o_fille' style='color: white; font-size: 18px; position: absolute; right:10px; bottom: 5px; cursor: pointer;'></i>
    </label>
    </a>
    </div>
    <div class='profile_side'><div id='img_link'>
    <div id='img_profile' style='background-image:url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\"); background-size: 100%;'></div>
    <img src='/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png' style='height: 180px; width: 180px;
     background-size: 100%; opacity: 0; position: absolute;'
     id='img_profile'></div></div>";
  }
  else {
    echo "<div class='ttl'><div class='cvrp'>
    <div class='tsap'>
    <div class='profileimg' style='width: 100%; height: 150px; background: brown; $bx; position: relative; background-position: center;'>
    <a href='user_view.php'>
    <label for='fille'>
    <i class='fas fa-camera o_fille' style='color: white; font-size: 18px; position: absolute; right:10px; bottom: 5px; cursor: pointer;'></i>
    </label>
    </a>
    </div>
    <div class='profile_side'>
    <div id='img_link'>
    <div id='img_profile' style='background-image:url(\"/students_connect/user.png\"); background-size: 100%;'></div>
    <img style='height: 180px; width: 180px;
    background-size: 100%; opacity: 0; position: absolute;'
    id='img_profile' src='/students_connect/user.png'></div></div>"; 
  }

 
  echo <<<_LAUGH

  <div class="users_name">

_LAUGH;


  
  echo "<div class='fix_name'><div class='f_s_name'>".$row['surname']. " " .$row['firstname']."</div>
  <div class='u_name'><i class='fas fa-at'></i>".$row['user']."</div>
  </div>";
    if(isset($_POST['sendposts'])){
   $sendposts = allposts($_POST['sendposts']);
    }
    $about = nl2br(lhash($row['about']));
    $foo = queryMysql("SELECT * FROM followstatus WHERE user='".$row['user']."'");
$bar = queryMysql("SELECT * FROM followstatus WHERE friend='".$row['user']."'");
$fn = mysqli_num_rows($foo);
$sn = mysqli_num_rows($bar);
$qx = $px = $kx = '';
if(isset($_GET['n'])){
  $ne = "style='display: block'";
  $fe = "style='display: none'"; $ye = "style='display: none'";
  $qx = 'mractive';
}
elseif(isset($_GET['f'])){
  $fe = "style='display: block'";
  $ne = "style='display: none'";
  $ye ="style='display: none'";
  $px = 'mractive';
}
else {
  $ye = "style='display: block'"; $ne = "style='display: none'";
   $fe = "style='display: none'";
  $kx = 'mractive';
  }
  echo <<<_END
  <div class='abouty'><div class='yabt'>$about</div></div>
  <div class='f_shh129w'>
  <span class='f_fflwers'>Followers <div class='f_shth123'>$sn</div></span><span class='f_fflwing'>Following <div class='f_shth123'>$fn</div></span>
  </div>
  </div></div></div>
  <div class='hr'></div>
  <div class='ma_li_mp'>
  <div class='pm_l $kx'><i class='fas fa-box ee'></i> <span class='m_y'>My Posts</span></div>
  <div class='pm_o $qx'><i class='fas fa-pen ee'></i> <span class='m_t'>New Post</span></div>
  <div class='pm_e $px'><i class='fas fa-image ee'></i> <span class='m_l'>Photos</span></div>
  </div><div class='view-posts' $ye>
_END;

    require_once "posts/index.php";

echo <<<_END
  </div>
  <div class='nps_et'>
  <div id='dtrt'></div>
  <div class="postarea" $ne>
  <form name='sndpst' id='profform' onsubmit='return vsmiw();' method='POST' action='/students_connect/upsts/' enctype="multipart/form-data">
  <div class='sltimg' id='sltimg'></div>
  <div class='err' id='err'></div>
  <div class='charea'>
  <div class='ifimg_shw'>
  <img id='img2bu' alt='Image To Be Uploaded' width='100%' style='display: none; padding-bottom: 20px; margin-left: auto; margin-right: auto; '/>
  <img id='img3bu' alt='Image To Be Uploaded' width='100%' style='display: none; padding-bottom: 20px; margin-left: auto; margin-right: auto; '/>
  </div>
  <div class='mil_an'>
  <div class='upd_td' style='background-image: url("$mmg")'></div>
  <div class='y_mlp'>
  <textarea id='dfun' class='xfun' name='sendposts' placeholder='Write Something...' title='Input Post' cols="50" rows="20" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
  </div></div></div>
  <div class='addcont' style='display: flex'>
  <div class='pstimg'>
  <label for='choose-img' title='Add Image'><span><i class="fas fa-camera apim"></i></span></label>
  <input type='file' style='display: none;' class='pstimgin' id='choose-img' name='pstimg[]' onchange='loadFile(event)' multiple 
  accept='image/*, video/*, audio/*'/>
  </div>
  <div class='taguser' style='width: 30px; height: 20px;' title='Tag Someone'
   onclick='displayTag()'><label for='tag_user'>
  <span><i class='fas fa-user-plus'></i></span></label></div>
  <div class='pollinpost taguser' id='pollipost' onclick='pollReq()' style='Poll in Post'><i class='fas fa-poll'></i></div>
  <div class='taguser tagpost' onclick='tagPost()'>
  <label for='tagpost'><span><i class='fas'>Tag Post</i></span></label></div>
  </div>
  <div id='itags' style='display: none;'><textarea title='Tag Someone' name='tagged' id='tsmne' placeholder="Tag People"></textarea>
  </div>
  <div class='tagthepost' id='tagthepost' style='display: none;'>
  <input type='checkbox' onchange='plyt(this.value)' value='adnw'><label for='adnw'>Customize Tag</label><br/>
_END;
    $tagpostoptions = array("Arts", "Science", "Computer", 
  "Programming", "Mathematics", "Physics", "Literature", "Chemistry", "Biology", "English", 
  "Book Keeping", "Languages", "Data Science");
  $sthag = sort($tagpostoptions);
  for($i = 0; $i < count($tagpostoptions); $i++){
    echo '<input type="checkbox" onchange="plyt(this.value)"  value="'.$tagpostoptions[$i].'"><label for="'.$tagpostoptions[$i].'">'.$tagpostoptions[$i].'</label><br/>';
  }
echo <<<_END
         <div id='tagmsg' style='display: none;'>Input tag and separate with comma</div>
         <input type='text' style='display: none;' name='tagpost' id='thetagtext'>
         </div>
         <div class='pollpost' style='display: none'>
         <div class='opt1 alopt'>
         <input type='text' id='tfpoll' class='topti' name='opt1' placeholder='Option One' maxlength='20'>
         <span class='c_ount'>0/20</span>
         </div>
         <div class='opt2 alopt'>
         <input type='text' id='tspoll' class='topti' name='opt2' placeholder='Option Two' maxlength='20'>
         <span class='sc_ount'>0/20</span>
         </div>
         <div class='opt3 alopt'>
         <input type='text' id='ttpoll' class='topti' name='opt3' placeholder='Option Three' maxlength='20'>
         <span class='tc_ount'>0/20</span>
         <span class='m_u_uu'><i class='fas fa-times'></i></span>
         </div>
         <div class='opt4 alopt'>
         <input type='text' id='tfopoll' class='topti' name='opt4' placeholder='Option Four' maxlength='20'>
         <span class='fc_ount'>0/20</span>
         <span class='m_u_uu'><i class='fas fa-times'></i></span>
         </div>
         <div class='plfpoll'>
         <i class='fas fa-plus'></i>
         </div>
_END;
      echo "<select name='day' id='th_d'>
      <option value='day'>Day</option>";
      for($i = date("d"); $i < (date("d")+7); $i++){
        if(date('D', strtotime($i - date("d")." day")) == date("D")){
          $vd = 'Today';
        }
        else {
          $vd = date('D', strtotime($i-date("d")." day"));
        }
        echo "<option value='".$vd."'>".$vd."</option>";
      }
      echo "</select>";
      echo "<select name='hour' id='th_h' >
      <option value='hour'>Hour</option>";
      for($i = 1; $i < 13; $i++){
        echo "<option value='".$i."'>".$i."</option>";
      }
      echo "</select>";
      echo "<select name='minute' id='th_m' >
      <option value='min'>Minute</option>";
      for($i = 0; $i < 60; $i++){
        $con = $i;
        if(strlen($i) == 1){
          $con = '0'.$i;
        }
        echo "<option value='".$con."'>".$con."</option>";
      }
      echo "</select>";
      echo "<select name='period' id='th_p' >
      <option value='period'>Period</option>
      <option value='am'>am</option>
      <option value='pm'>pm</option>
      </select>";
      $dy = date("M");
echo <<<_END
         <div class='d_l_poll'><i class='fas fa-trash'></i></div>
         <input type='hidden' name='finishdate' id='f_date' value='$dy'>
         <input type='hidden' name='hiddenone' id='thiddenone' value=''>
         <span class='poll_xp'></span>
         </div>
          <div class="chtype">
_END;
if($row['status'] != 3){
  echo <<<_END
    <input type='radio' class='postsub' name='ispost' value='0' required><label for="edu">Educational</label>
    <input type='radio' name='ispost' class="postsub" value='1' required><label for="soc">Social</label>
_END;
}
else {
 echo <<<_END
 <input type='radio' name='ispost' class="postsub" value='1' style='display: none' checked>
 _END;
}
echo <<<_END
  <input type='submit' name='subpost' value="Submit">
  </div>
  </div>
  </form>
  </div>
  </div>
_END;
$errt = queryMysql("SELECT * FROM eduposts WHERE user='$user' OR sharedby='$user'
                            UNION ALL
                          SELECT * FROM socposts WHERE user='$user' OR sharedby='$user' ORDER BY timeofupdate DESC");
$tt = getcwd();
chdir("../students_connect_hidden/postuploads/");
while($ger = mysqli_fetch_array($errt)){
  if($ger['pstst']==0){
  if(file_exists($ger['id']."(0).png")){
    $oee = '/students_connect_hidden/postuploads/'.$ger['id'].'(0).png';
    break;
  }
  }
  elseif($ger['pstst'] == 1){
    if(file_exists("s/".$ger['id']."(0).png")){
      $mop = getcwd();
      $oee = '/students_connect_hidden/postuploads/s/'.$ger['id'].'(0).png';
      break;
    }
  }
}
chdir($tt);
$tt = getcwd();
chdir("../students_connect_hidden/messages_uploads/");
$est = queryMysql("SELECT * FROM messages WHERE sender='$user' AND hasfile='1' ORDER BY timeofmessage DESC");
if($est->num_rows){
  $co = mysqli_num_rows($est);
  $ges = mysqli_fetch_array($est);
  for($i = 0; $i < 15; $i++){
  if(file_exists($ges['messageid'].'/'.$i.'.png')){  
    $flee = '/students_connect_hidden/messages_uploads/'.$i.'.png';
    break;
    }
  }
  }
else {
  $co = '0';
}
chdir($tt);
$tt = getcwd();
if(!isset($oee)){
  $oee = '';
}
if(!isset($flee)){
  $flee = '';
}
echo <<<_END
  <div class='mi_e_lan' $fe>
  <div class='media_categories'>
  <div class='md_al_oall'>
  <div class='md_al_fall'>All</div>
  <div class='md_al_pr'>Profile</div>
  <div class='md_f_ph'>Photos</div>
  <div class='md_f_vd'>Videos</div>
  <div class='md_f_au'>Audios</div>
  <div class='md_f_mg'>Messages</div>
  <div class='md_f_svd'>Saved</div>
  </div>
  <div class='m_each_cat'>
  <div class='all_media_category watgt'><div class='fr_all watgtext'>
  <span class='a_eePe'>All<span class='watgtext_count'> (29)</span></span>
  <div class='s_backgrr'></div></div></div>
  <div class='pr_media_category watgt' style='background-image: url("$mmg")'><div class='fr_profile watgtext'>
  <span class='a_eePe'>Profile<span class='watgtext_count'> (1)</span></span><div class='s_backgrr'></div></div></div>
  <div class='po_media_category watgt' style='background-image: url("$oee")'><div class='fr_posts watgtext'>
  <span class='a_eePe'>Posts <span class='watgtext_count'> (25)</span></span>
  <div class='s_backgrr'></div></div></div>
  <div class='mes_media_category watgt' style='background-image: url("$flee")'><div class='fr_messages watgtext'>
  <span class='a_eePe'>Messages<span class='watgtext_count'> ($co)</span></span><div class='s_backgrr'></div></div></div></div>
  </div>
  </div>
  </div>
  </div>
  </div>
_END;
echo 
  "
  <script>
  var lastp = ['']
  function disnav(event){
    if(window.innerWidth < 799){
    var a = document.getElementsByClassName('ttrdad')[0].style.display;
    if(a == 'none' || a == ''){
      document.documentElement.style.position = 'fixed';
      document.body.style.position = 'fixed';
    document.getElementsByClassName('ttrdad')[0].style.display = 'block';
    document.getElementsByClassName('ttr')[0].style.width = '50%';
    document.getElementsByClassName('ttr')[0].style.display = 'block';
    lastp[0] = parseInt(event.pageY)-27;
  }
    else {
      document.documentElement.style.position = 'relative';
      document.body.style.position = 'relative';
      document.getElementsByClassName('ttrdad')[0].style.display = 'none';   
      window.scrollTo(0, lastp[0])
      lastp[0] = '';
    }
  }
  window.onclick = function(event){
    var ot = document.getElementsByClassName('ttrdad')[0];
    if(event.target == ot){
      document.documentElement.style.position = 'relative';
      document.body.style.position = 'relative';
      ot.style.display = 'none';
      window.scrollTo(0, lastp[0])
      lastp[0] = '';
    }
  }
  var ot = document.getElementsByClassName('ttrdad')[0];
  ot.onclick = function(event){
    if(event.target == ot){
      document.documentElement.style.position = 'relative';
      document.body.style.position = 'relative';
      ot.style.display = 'none';
      window.scrollTo(0, lastp[0])
      console.log(lastp[0]);
    }
  }
  }
  var loadFile = function(event) {
    var output = document.getElementById('img2bu');
    var outputx = document.getElementById('img3bu');
      output.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('img2bu').style.display='block';
    if(event.target.files[1]){
      document.getElementById('img3bu').style.display='block';
    outputx.src = URL.createObjectURL(event.target.files[1]);
    outputx.onload = function () {
      URL.revokeObjectURL(outputx.src)
    }
  }
}
  if(window.innerWidth <= 799){
  var iks = document.getElementsByTagName('IMG');
  for(var x = 0; x < iks.length; x++){
    var mn = document.getElementsByTagName('IMG')[x];
    mn.onclick = function(){
    var y = this.src;
    var z = document.getElementById('thimgv');
    var q = z.innerHTML;
    if(q.includes('img')){
      document.getElementsByClassName('imgsmall')[0].src = y;
    document.getElementsByClassName('timgbsys')[0].style.display = 'block';
    document.getElementsByClassName('imgsmall')[0].onload = function(){
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('imgsmall')[0].onerror = function(){
      document.getElementById('timgerror').innerHTML = 'Error Loading Picture';
      document.getElementById('plding').style.display = 'none';
    }
  }
    else {
    var a = document.createElement('IMG');
    a.className= 'imgsmall';
    a.src = y;
    document.getElementById('plding').style.display = 'block';
    z.append(a);
    document.getElementsByClassName('imgsmall')[0].onload = function(){
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('imgsmall')[0].onerror = function(){
      document.getElementById('timgerror').innerHTML = 'Error Loading Picture';
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('timgbsys')[0].style.display = 'block';
  }
  }
  }
  var mod = document.getElementById('thimgv');
  window.onclick = function(event) {
    if (event.target == mod) {
      document.getElementsByClassName('timgbsys')[0].style.display = 'none';
    }
}
var cl = document.getElementById('clview');
cl.onclick = function(){
  document.getElementsByClassName('timgbsys')[0].style.display = 'none';
}
}
var e = document.getElementById('th_d');
var f = document.getElementById('th_h');
var g = document.getElementById('th_m');
var h = document.getElementById('th_p');
var p = document.getElementById('f_date');
e.onchange = function(){
  if(e.value != 'day'){
    p.value = p.value + ' ' +this.value+' ';
  }
}
f.onchange = function(){
  if(f.value != 'hour'){
    p.value = p.value + this.value + ':';
  }
}
g.onchange = function(){
  if(g.value != 'min'){
    p.value = p.value +''+this.value;
  }
}
h.onchange = function(){
  if(h.value != 'period'){
    p.value = p.value +' '+this.value;
  }
}
if(document.getElementsByClassName('tr_ash')){
  var x = document.getElementsByClassName('tr_ash');
  for(var i =0; i<x.length; i++){
    x[i].onclick = function(){
      var t = this.children[0].value;
      var p = this.children[1].value;
      var q = this.children[2].value;
      var tes = this.parentElement.parentElement.parentElement.parentElement.parentElement;
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            tes.style.display = 'none';
          }
      };
      xmlhttp.open('GET', '/students_connect/posts/regulator.php?id='+t+'&usr='+p+'&type='+q);
      xmlhttp.send();
    }
  }
}
if(document.getElementsByClassName('cotx')){
  k = document.getElementsByClassName('cotx')
  var p, q, r,s, t,u;
  for(var u =0; u < k.length; u++){
    p = k[u];
    p.onclick = function(){
      q = this.children[0].value;
    s = this.children[1].value;
    t = this.children[2].value;
      if(q == '0'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById('quest').innerHTML = xmlhttp.responseText;
              var f = document.createElement('script');
                 f.src = '/students_connect/jsf/filescript.js';
                 f.type = 'text/javascript';
                 var e = document.getElementsByTagName('HEAD')[0];
                  e.append(f);
              window.history.pushState('', y, '/students_connect/posts/'+s+'/');
          }
      };
      xmlhttp.open('GET', '/students_connect/posts/pst?pid='+s+'&cid=0');
      xmlhttp.send();
      }
      else if(q == '1'){
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('quest').innerHTML = xmlhttp.responseText;
          var f = document.createElement('script');
          f.src = '/students_connect/jsf/filescript.js';
          f.type = 'text/javascript';
          var e = document.getElementsByTagName('HEAD')[0];
           e.append(f);
          window.history.pushState('', t, '/students_connect/posts/s'+s+'/');

        }
  };
  xmlhttp.open('GET', '/students_connect/posts/pst?spid='+s);
  xmlhttp.send();
      }
    }
  }
}
if(document.getElementsByClassName('ma_li_mp')[0]){
  var e = document.getElementsByClassName('pm_l')[0];
  var f = document.getElementsByClassName('pm_o')[0];
  var g = document.getElementsByClassName('pm_e')[0];
  var u = document.getElementsByClassName('view-posts')[0];
  var v = document.getElementsByClassName('postarea')[0];
  var w = document.getElementsByClassName('mi_e_lan')[0];
  f.onclick = function(){
    u.style.display = 'none';
    w.style.display = 'none';
    v.style.display = 'block';
    var xe = this.parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[1].classList.add('mractive');
  }
  e.onclick = function(){
    u.style.display = 'block';
    w.style.display = 'none';
    v.style.display = 'none';
    var xe = this.parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[0].classList.add('mractive');
  }
  g.onclick = function(){
    u.style.display = 'none';
    w.style.display = 'block';
    v.style.display = 'none';
    var xe = this.parentElement.children;
    for(var i = 0; i< xe.length; i++){
      xe[i].className = xe[i].className.replace('mractive', '');
    }
    xe[2].classList.add('mractive');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      xmlhttp.onload = function(){
        w.innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('POST','/students_connect/profile/myimages.php');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send();
  }
}
if(document.getElementsByClassName('plfpoll')[0]){
  var l = document.getElementsByClassName('plfpoll')[0];
  var me = document.getElementsByClassName('opt3')[0];
  var ma = document.getElementsByClassName('opt4')[0];
  l.onclick = function(){
    if(me.style.display == '' || me.style.display == 'none'){
      me.style.display = 'block';
    }
    else {
      ma.style.display = 'block';
      this.style.display = 'none';
    }
  }
  var de = document.getElementsByClassName('m_u_uu')[0];
  var da = document.getElementsByClassName('m_u_uu')[1];
  de.onclick = function(){
    me.children[0].value = '';
    ma.children[0].value = '';
    document.getElementsByClassName('plfpoll')[0].style.display = 'block';
  }
  da.onclick = function(){
    ma.style.display = 'none';
    ma.children[0].value = '';
    document.getElementsByClassName('plfpoll')[0].style.display = 'block';
  }
}
/*var ii = document.getElementById('fille');
ii.onchange = function(event) {
  var output = document.getElementsByClassName('profileimg')[0];
  output.style.backgroundImage = 'url('+URL.createObjectURL(event.target.files[0])+')';
  output.style.backgroundSize = 'cover';
}

window.onkeypress = function(e){
  if(e.key == ' ' && window.innerWidth < 799){
    e.preventDefault();  
    disnav(event);
    }
  if(e.code == 'KeyN'){
    e.preventDefault();
    nfile(event);
  }
}
*/
</script>
<link rel='stylesheet' href='/students_connect/jquery.Jcrop.min.css' type='text/css' />
<script src='/students_connect/jquery.Jcrop.min.js'></script>
<script src='/students_connect/jsf/filescript.js'></script>
<script>

</script>
";
?>