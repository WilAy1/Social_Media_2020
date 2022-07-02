<?php
define('ROOT' , "/Users/wilay/students_connect/");
require_once ROOT."connect.php";
require_once ROOT."header2.php";
if (!$loggedin) die();
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
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
  </i></a></li>  <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
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
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:695px;">
_END;
echo <<<GODMAKEMYWORKPROSPER
<div class='hbdy'>
<div class='sc_up' style='display: none;' title='Back to Top' onclick='window.scrollTo(0,0)'><div class='sc_up_o' style='display: flex;'><svg class='msvg' width='15' height='15'>
<path d='M7.5 4 L1 14 Z' stroke='black'/>
<path d='M7.5 4 L14 14 Z' stroke='black'/>
</svg></div></div>
<div class='adpost'><div class='adpsticon' title='New Post'><i id='pbtn' class='fas fa-pen'></i></div></div>
<div id='tbck_o_btn' style='display: none;'><i class='fas fa-arrow-left lxop'></i></div>
<div id='dispst' class='xjdsm' style='display: none;'><span class='fc_clo close'>x</span><div class='dtff'>
<div class='hp_quicky'>
<div class='hp_quicky_list'>
<div class='hp_all'><div class='hp_newps hp_xall' title='New Post'><i class='fas fa-pen'></i></div></div>
<div class='hp_all'><div class='hp_mges hp_xall' title='Quick Messaging'><i class='far fa-envelope'></i></div></div>
<div class='hp_all'><div class='hp_srch hp_xall' title='Quick Search'><i class='fas fa-search'></i></div></div>
<div class='hp_all'><div class='hp_notf hp_xall' title='Quick Notifications'><i class='fas fa-bell'></i></div></div>
</div>
</div>
<div class='pbg'>
<div class='scto'>
<div class='wbotop'>
<!--
<div class='mypside'>
<div class='srchside'>
<form action='/students_connect/search'>
<input type='text' placeholder='Search...' class='srchtb' name='search'><button type='submit' class='hsearchbtn'><i class='fas fa-search'></i></button></form></div></div>-->
</div></div>
<form action='' onsubmit='return vsmiw();' method='post' enctype="multipart/form-data">
<div class='gian'>New Post</div>
<div class='err' id='err'></div>
<style>
@media (max-width: 799px){
  .charea {
    padding-bottom: 100px;
  }
}
</style>
<div class='charea'>
<div class='ifimg_shw'>
<img id='img2bu' alt='Image To Be Uploaded' width='100%' style='display: none; padding-bottom: 20px; margin-left: auto; margin-right: auto; '/>
<img id='img3bu' alt='Image To Be Uploaded' width='100%' style='display: none; padding-bottom: 20px; margin-left: auto; margin-right: auto; '/>
</div>
<div class='txtbx'>
GODMAKEMYWORKPROSPER;
  if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){ 
  $xmg = "/students_connect_hidden/users_profile_upload/$user/$user.png";
  }
  else {
      $xmg = "/students_connect/user.png";
  }
echo <<<GODMAKEMYWORKPROSPER
<div class='t_np_mg' style='background-image:url("$xmg")'></div>
<div class='t_np_tbx'><textarea cols='90' placeholder='New Post' name='sendposts' rows='20' id='pstabc'></textarea>
</div></div>
<div class='addcont xr_esa' style='display: flex'>
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
GODMAKEMYWORKPROSPER;
    $tagpostoptions = array("Arts", "Science", "Computer", 
  "Programming", "Mathematics", "Physics", "Literature", "Chemistry", "Biology", "English", 
  "Book Keeping", "Languages", "Data Science");
  $sthag = sort($tagpostoptions);
  for($i = 0; $i < count($tagpostoptions); $i++){
    echo '<input type="checkbox" onchange="plyt(this.value)"  value="'.$tagpostoptions[$i].'"><label for="'.$tagpostoptions[$i].'">'.$tagpostoptions[$i].'</label><br/>';
  }
echo <<<_END
         </select>
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
    echo "<option value='".date('D', strtotime($i-date("d")." day"))."'>".date('D', strtotime($i-date("d")." day"))."</option>";
  }
  echo "</select>";
  echo "<select name='hour' id='th_h'>
  <option value='hour'>Hour</option>";
  for($i = 1; $i < 13; $i++){
    echo "<option value='".$i."'>".$i."</option>";
  }
  echo "</select>";
  echo "<select name='minute' id='th_m'>
  <option value='min'>Minute</option>";
  for($i = 0; $i < 60; $i++){
    $con = $i;
    if(strlen($i) == 1){
      $con = '0'.$i;
    }
    echo "<option value='".$con."'>".$con."</option>";
  }
  echo "</select>";
  echo "<select name='period' id='th_p'>
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
   <div class="chtype x_ch_t">
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
echo "
<input type='submit' name='subpost' value='Submit'>
  </div>
  </div>
  </form>
  <hr style='width: 90%'>
    </div>
    <div class='pbdd_mg' style='display: none'>
    <div class='hp_hommade'>
    <div class='hp_loading'></div>
    <div class='hp_caution'>Only text messages can be sent and received</div>
    </div>
    <div class='hp_tmgcnts'>
    <div class='hp_tmgsr'>
    <input type='text' placeholder='Search Friend' class='hp_msfs'/>
    </div>
    <div class='hp_mgsrc'></div>
    <div class='hp_mginxx' style='background-color: lightgrey;'></div>
    </div>
    </div>
    <div class='pbdd_sr' style='display: none'>
    <div class='hp_loading'></div>
    </div>
    <div class='pbdd_nt' style='display: none'>
    <div class='hp_loading'></div>
    </div>
";

$today = strtotime("today");
  $tomorrow = strtotime("tomorrow");
  $trd = queryMysql("SELECT * FROM hashtagsbase WHERE numberofusages > 10 
   AND started BETWEEN $today and $tomorrow ORDER BY numberofusages
   DESC LIMIT 5");
  if($trd->num_rows){
    echo "<div class='trendingtoday'><div class='ttdyh'>Trending Today</div>
    <div class='ttdylst tlspw'>";
  while($ftrd = mysqli_fetch_array($trd)){
    $colorrange = array('lightgreen', 'red', 'lightblue', 'maroon', 'turquoise');
    $rp = str_replace("#", "%23", $ftrd['tagname']);
    $c = $colorrange[array_rand($colorrange, 1)];
    if($ftrd['numberofusages'] >= 1000 && $ftrd['numberofusages'] < 10000){
      $ntg = $ftrd['numberofusages'];
      $vn = $ntg[0]."k";
    }
    elseif($ftrd['numberofusages'] >= 10000 && $ftrd['numberofusages'] < 100000){
      $ntg = $ftrd['numberofusages'];
      $vn = substr($ntg , 0, 2)."k";
    }
    elseif($ftrd['numberofusages'] >= 100000 && $ftrd['numberofusages'] < 1000000){
      $ntg = $ftrd['numberofusages'];
      $vn = substr($ntg , 0, 3)."k";
    }
    elseif($ftrd['numberofusages'] >= 1000000 && $ftrd['numberofusages'] < 10000000){
      $ntg = $ftrd['numberofusages'];
      $vn = substr($ntg , 0, 1)."M";
    }
    else {
      $vn = $ftrd['numberofusages'];
    }
    echo "<a href='/students_connect/search/?sea  rch=".$rp."'><div class='tcontainer'>
    <div class='h_h_nm'>  
    <div class='hname'
      style='background-color: ".$c."; 
      box-shadow: 2px 2px 2px 2px ".$c.";'><div class='htnm' 
       style>".$ftrd['tagname']."</div></div>
      <div class='nfp'>".$vn." tagged</div></div>
      <div class='ta_rl_t'><i class='fas fa-caret-right'></i></div>
      </div></a>
      ";
  }
  echo '
  <div class="t_fck_S_mr">See More</div>
  <div class="ld_i_c"></div>
  </div>
  </div>';
}
echo <<<_END
  </div>
_END;
  
  /* $trd = queryMysql("SELECT * FROM hashtags WHERE timefh BETWEEN $today AND $tomorrow");
  $ftrd = array();
  while($gtrd = mysqli_fetch_array($trd)){
    array_push($ftrd, $gtrd['hashtag']);
  }
  $utrd = array_unique($ftrd);
  $cv = array();
  foreach($utrd as $uq){
    $pe = array_keys($ftrd, $uq);
    array_push($cv, count($pe));
  }
  $su = array_merge($utrd);
  $final = array();
  for($x = 0; $x < count($su); $x++){
    array_push($final, array($cv[$x], $su[$x]));
  }
  $colorrange = array('lightgreen', 'red', 'lightblue', 'maroon', 'turquoise');
  for($r = 0; $r < count($final); $r++){
    for($x = 0; $x < 1; $x++){
      if(strlen($final[$r][$x + 1]) > 7){
        $ll = strlen($final[$r][$x+1]);
        $st = "margin: ". $ll."px !important";
      }
      else {
        $st ="";
      }
      $rp = str_replace("#", "%23", $final[$r][$x + 1]);
      $c = $colorrange[array_rand($colorrange, 1)];
      echo "<a href='/students_connect/search/?search=".$rp."'><div class='tcontainer'>
      <div class='hname'
      style='background-color: ".$c."; 
      box-shadow: 2px 2px 2px 2px ".$c.";'><div class='htnm' 
       style='".$st."'>".$final[$r][$x + 1]."</div></div>
      <div class='nfp'>".$final[$r][$x]." tagged</div>
      </div></a>";
    }
  }*/
  echo '</div><div class="dfp_A">';
  require_once "hc.php";

echo "</div></div></div></div>";
?>
<script>
  if(document.getElementsByClassName('hp_all')){
  var mges = document.getElementsByClassName('hp_mges')[0];
  mges.onclick = function(){
    document.getElementsByClassName('pbg')[0].style.display = 'none';
    document.getElementsByClassName('pbdd_sr')[0].style.display = 'none';
    document.getElementsByClassName('pbdd_nt')[0].style.display = 'none';
    document.getElementsByClassName('pbdd_mg')[0].style.display = 'block';
    $.ajax({
      url: '/students_connect/h/quick.php',
      method: 'POST',
      data: 'qmg',
      success: function(o){
        document.getElementsByClassName('hp_hommade')[0].style.display = 'none';
        document.getElementsByClassName('hp_mginxx')[0].innerHTML = o;
      }
    })
  }
  document.getElementsByClassName('hp_msfs')[0].oninput = function(){
    var m = this.value;
    if(m.length > 0){
      document.getElementsByClassName('hp_mgsrc')[0].style.display = 'block';
      $.ajax({
      url:"/students_connect/h/quick.php?usr=&val="+m,
      method:"GET",
      success:function(data){
          document.getElementsByClassName('hp_mgsrc')[0].innerHTML = data;
      }
      })
    }
    else {
      document.getElementsByClassName('hp_mgsrc')[0].style.display = 'none';
    }
  }
}
</script>