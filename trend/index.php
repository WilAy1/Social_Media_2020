<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
    function cvrt($str){
      $str = sanitizeString($str);
      $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
      $str = str_replace('\r\n', '', $str);
      return $str;
    }
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
     if(isset($_POST['thead']) && isset($_POST['tcont']) && !empty($_POST['thead'])){
        $id = 0;
        $hd = sanitizeString($_POST['thead']);
        $cn = sanitizeString($_POST['tcont']);
        if(strpos($cn, '[&quot;')  && strpos($cn, '&quot;]')){
          $mls = explode(" [", $cn);
          for($i =0; $i < count($mls); $i++){
            $mxl = strlen($mls[$i]);
            if(strpos($mls[$i], '&quot;]')){
              $poo = strpos($mls[$i], '&quot;]');
              $too = strpos($mls[$i], '[&quot;');
              $vl = substr($mls[$i], 6, ($poo-7));
              $cn = str_replace('['.$mls[$i], "<div class=\'tl_quote\'>
              <span class=\'mpiece\'>".$vl."</span></div>", $cn);
            }  
          }
        }
        $ot = '0';
        $tm = time();
        queryMysql("INSERT INTO trending VALUES('$id', '$user', '$hd', '$cn', '$ot', '$ot', '$tm') 
        ");
        $xty = mysqli_fetch_array(queryMysql("SELECT * FROM trending WHERE user='$user' AND timeofpost='$tm'"));
        $tid = $xty['id'];
        if(!empty($_FILES['timg']['name'][0])){
        $nmf = count($_FILES['timg']['name']);
        echo $nmf;
        for($i=0; $i < $nmf; $i++){
          $nnn = $_FILES['timg']['name'][$i];
          move_uploaded_file($_FILES['timg']['tmp_name'][$i],
          '../../students_connect_hidden/trend/'. $nnn);
          rename('../../students_connect_hidden/trend/'.$_FILES['timg']['name'][$i],
             '../../students_connect_hidden/trend/'.$tid['id'].'('.$i.').png');
        }
      }
    }
   
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
  </i></a></li><li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
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
  <div class='t_bbody'>
_END;
echo "<div class=top_on_lwk''>
<div class='tol_llw'>Last Week Top</div>
</div>";
$yday = strtotime("1 week ago");
$adspace = array();
for($i = 0; $i < 3; $i++){
  array_push($adspace, rand(1, 10));
}
if($row['status'] == 1 || $row['status'] == 2){
$ett = queryMysql("SELECT * FROM eduposts where timeofupdate > '".$yday."' 
                  UNION ALL
                  SELECT * FROM socposts where timeofupdate > '".$yday."' order by pnc, tun");
}
elseif($row['status'] == 3){
  $ett = queryMysql("SELECT * FROM socposts where timeofupdate > '".$yday."' order by pnc, tln");
}
$e = 0;
while(($gett = mysqli_fetch_array($ett)) && $e < count($gett)){
  $studco_ad_images = array("/students_connect_hidden/ads/mesimg1.png", "/students_connect_hidden/ads/mesimg2.png", "/students_connect/ico/StudCo.png");
  for($i =0; $i < 2; $i++){
    if($e == $adspace[$i]){
      $tu = array_rand($studco_ad_images, 1);
      $imgtu = $studco_ad_images[$tu];
      $ad_t = nl2br("At studco we work together to make the world a better place.
      Better for me, better for you, together we flow with studco.");
      echo "<div class='s_cus_ad'>
      <div class='ad_container'>
      <div class='t_ad_tag'>Ad by StudCo</div>
      <div class='ad_img' style='background-image: url(\"".$imgtu."\")'>
      </div>
      <div class='ad_text'><div class='main-ad-text'>".$ad_t."</div></div>
      </div>
      <div class='ad_go_tosite'>
      Go to site <i class='fas fa-external-link-alt ad_link_tag'></i>
      </div>
      </div>";
    }
  }
  $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$gett['user']."'"));
  $td = getcwd();
   chdir("../../students_connect_hidden/users_profile_upload/".$gett['user'].'/');
   if(file_exists($gett['user'].".png")){ 
     $img =  '/students_connect_hidden/users_profile_upload/'.$gett['user'].'/'.$gett['user'].'.png';  
   }
     else {
       chdir($td);
         $img =  '/students_connect/user.png';
     }
     chdir($td);
  echo <<<_END
    <div class='camp'>
    <div class='amps'>
    _END;
    echo "
    <div class='namp'><div class='pstname' style='display: flex;'><a href='/students_connect/user/".$mbse['user']."'>
    <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
    <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
    <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div>
    </a></div></div></div>
    <div class='mpst' id='mpst".$gett['id']."'>";
    $pstcut = strlen($gett['pstcont']) > 250 ? substr($gett['pstcont'], 0, 150).'&hellip;
    <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$gett['id'].'">
    Read More <i class="fas fa-angle-double-down"></i></div>' : $gett['pstcont'];
    $pstcut = str_replace("search=\r\n", "", $pstcut);            
    echo nl2br($pstcut);
    echo "</div>";
    $tpeid = $gett['id'];
    $etime = time();
    $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime'");
      if($polc->num_rows){
        echo "<div class='p_available' style='width: fit-content; margin: auto;'>Poll Available, Participate Now</div>";
      }
    echo "
    </div>
    </div>";
$e++;
  }
echo "</div></div></div>";
/*echo "<div class='t_trn_b'>
<div class='bl_st_fl'>
<div class='js_go_to_lf'>
<div class='bls_etfl'></div>
</div>
</div>
<div class='tee_trnd'>
<div class='b_lea_Te'>Trending</div>
<div class='alsec'>
<section class='tr_sec myr_pt ae_s'>
<div class='fl_T_lxst'>
<div class='ma_wn_l t_o_sx'>Your Recent Topics <i class='fas fa-clock mil_a_no'></i></div>
<div class='sut_rmnn ple_as_e'>";
$user = $row['user']; 
$lmxe = queryMysql("SELECT * FROM trending WHERE user='$user' 
 ORDER BY timeofpost DESC LIMIT 2");
 while($glxme = mysqli_fetch_array($lmxe)){
  $ttime = $glxme['timeofpost'];
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
      $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
    }
  }
  else {
    $ftime = date("M d h:i a", $ttime);
  }
  $ex = getcwd();
  chdir("../../students_connect_hidden/trend/");
  $med = getcwd();
  $lmig = '';
  if(file_exists($med."/".$glxme['id']."(0).png")){
    $lmig = "style='background-image: url(\"/students_connect_hidden/trend/".$glxme['id']."(0).png\")'";
  }
  chdir($ex);
  $heading = strlen($glxme['heading']) > 40 ? substr($glxme['heading'], 0, 40).'&hellip;':$glxme['heading'];
  $content = strlen($glxme['content']) > 80 ? substr($glxme['content'], 0, 80).'&hellip;':$glxme['content'];
  echo "<div class='bob_xb'>
  <a href='/students_connect/trend/".$glxme['id']."'>
  <div class='med_de'>
  <div class='lsa_tame'> 
 <div class='olo_sa_pe'>
  <div class='th_ade'>".$heading."</div>
  <div class='th_cnto'>".cvrt($content)."</div>
  </div>
  <div class='th_rirmg' $lmig></div>
  </div>
  <div class='so_E_th'><i class='fas fa-caret-right'></i></div>
  </div>
  <div class='tim_pstd'>".$ftime."</div>
  </a> 
  </div>";
 }
 $lmxe = queryMysql("SELECT * FROM trending WHERE user='$user' 
 ORDER BY timeofpost DESC");
 if($lmxe->num_rows > 2){
echo "<div class='lxbbabe'>See More</div>";
 }

echo "</div>
</div>
</section>
<section class='y_se_p2 ae_s'>
 <div class='sep1s'>
 <div class='rtm_wn_l t_o_sx'>Latest Topics</div>
 <div class='po_lp ple_as_e'>
 ";
 $mista = queryMysql("SELECT * FROM trending ORDER BY timeofpost DESC LIMIT 6");
 $maist = mysqli_fetch_array($mista);
 $emid = $maist['id'];
 while($gmist = mysqli_fetch_array($mista)){
  $bed = '';
  if($gmist['id'] == $emid){
    $bed = "style='border-bottom: none;'";
   }
  $ttime = $gmist['timeofpost'];
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
      $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
    }
  }
  else {
    $ftime = date("M d h:i a", $ttime);
  }
  $ex = getcwd();
  chdir("../../students_connect_hidden/trend/");
  $med = getcwd();
  $lmig = '';
  if(file_exists($med."/".$gmist['id']."(0).png")){
    $lmig = "style='background-image: url(\"/students_connect_hidden/trend/".$gmist['id']."(0).png\")'";
  }
  chdir($ex);
  $heading = strlen($gmist['heading']) > 40 ? substr($gmist['heading'], 0, 40).'&hellip;':$gmist['heading'];
  $content = strlen($gmist['content']) > 80 ? substr($gmist['content'], 0, 80).'&hellip;':$gmist['content'];
  echo "<div class='bob_xb'>
  <a href='/students_connect/trend/".$glxme['id']."'>
  <div class='med_de'>
  <div class='lsa_tame'> 
 <div class='olo_sa_pe'>
  <div class='th_ade'>".$heading."</div>
  <div class='th_cnto'>".cvrt($content)."</div>
  </div>
  <div class='th_rirmg' $lmig></div>
  </div>
  <div class='so_E_th'><i class='fas fa-caret-right'></i></div>
  </div>
  <div class='tim_pstd'>".$ftime."</div>
  </a>
   </div>";
  }
echo "<div class='lxbbabe'>See More</div>";
 echo "
 </div>
 </div>
</section>
</div>
</div>
<div class='t_trn_lg'>
<div class='nwrt_slp'>
<div class='tic_f_t'><i class='fas fa-bolt mxl_us'></i></div>
</div>
<div id='tbck_o_btn' style='display: none;'><i class='fas fa-arrow-left lxop'></i></div>
<div class='pre_pl'>
<form id='trfrm' method='POST' action='' enctype='multipart/form-data'>
<div class='mx_lr'>
<div class='nwa_b_te'>Create a Thread</div>
<div class='tx_subm_T'>
<button id='nx_sb' type='submit' name='trnp'>Create Post</button>
</div>
<div class='bt_epx'>
<div class='lb_f_sub'>
<label for='ttopic'>Topic</label>
<div class='xrz_ymt' id='ttopic'>
<input type='text' name='thead' id='xthd' class='tr_sub' name='sbj'>
</div>
</div>
<div class='lb_f_str'>
<label for='thstry'>Body</label>
<div class='xrz_cont' id='thstry'>
<div class='mlx_rt'>
<label for='amk_xy'><i class='fas fa-image'></i> Add Image</label>
<input id='amk_xy' type='file' name='timg' style='display: none;' multiple/>
<span class='x_quote'><i class='fas fa-quote-left'></i> <i class='fas fa-quote-right'></i></span>
</div>
<div class='lxc_pp'>
<textarea class='xtextarea' name='tcont' id='xtbdy' rows='20' placeholder='Body'></textarea>
</div>
<div class='dpa_mg'>
<div class='if1_gm' id='if1_gm'></div>
<div class='if2_gm' id='if2_gm'></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>";
echo "</div></div>";*/
?>
<script>
  var lz = document.getElementsByClassName('tic_f_t')[0];
  lz.onclick = function(){
    document.getElementsByClassName('tee_trnd')[0].style.display = 'none';
    document.getElementById('tbck_o_btn').style.display = 'block';
    document.getElementsByClassName('pre_pl')[0].style.display = 'block'; 
    document.getElementsByClassName('tic_f_t')[0].style.display = 'none';
    document.getElementsByClassName('tee_trnd')[0].style.display = 'none';
  }
  var f = document.getElementById('amk_xy');
  f.onchange = function(event){
    var p = document.getElementById('if1_gm');
    if(p.innerHTML == ''){
    var t = document.createElement('IMG');
    t.src = URL.createObjectURL(event.target.files[0]);
    t.onload = function(){
      URL.revokeObjectURL(t.src);
      t.style.width = '100%';
      p.append(t);
    }
  }
  else {
    var t = p.children[0];
    t.src = URL.createObjectURL(event.target.files[0]);
    t.onload = function(){
      URL.revokeObjectURL(t.src);
      p.append(t);
    }
  }
  var n = document.getElementById('if2_gm');
  if(n.innerHTML == ''){  
  if(event.target.files[1]){
      var y = document.createElement('IMG');
      y.src = URL.createObjectURL(event.target.files[1]);
      y.onload = function(){
        URL.revokeObjectURL(y.src);
        y.style.width = '100%';
        n.append(y);
      }
    }
  }
  else {
    var y = n.children[0];
    y.src = URL.createObjectURL(event.target.files[1]);
    y.onload = function(){
      URL.revokeObjectURL(y.src);
    }
  }
}
var mz = document.getElementById('tbck_o_btn');
mz.onclick = function(){
  document.getElementById('tbck_o_btn').style.display = 'none';
    document.getElementsByClassName('pre_pl')[0].style.display = 'none'; 
    document.getElementsByClassName('tic_f_t')[0].style.display = 'block';
    document.getElementsByClassName('tee_trnd')[0].style.display = 'block';
  }
var qj = document.getElementsByClassName('x_quote')[0];
qj.onclick = function(){
  var t = document.getElementsByClassName('xtextarea')[0].value;
  document.getElementsByClassName('xtextarea')[0].value = t + ' ["add quote"]';
}
document.getElementById('nx_sb').onclick = function(event){
  event.preventDefault();
var input  = document.getElementById('amk_xy');
var formdata = false;
  var reader;
  if(window.FormData){
    formdata = new FormData();
  }
if(formdata){
  if(document.getElementById('amk_xy').files != 0){
  var file;
  var len = document.getElementById('amk_xy').files.length;
  var i = 0;
  for(i=0; i< len;i++){
    file = document.getElementById('amk_xy').files[i];
  }
  }
  var thead = document.getElementById('xthd').value;
  var xtbdy = document.getElementById('xtbdy').value;
  formdata.append('timg[]', file);
  formdata.append('thead', thead);
  formdata.append('tcont', xtbdy)
  $.ajax({
    url: "/students_connect/trend/",
    type:"POST",
    data:formdata,
    processData: false,
    contentType: false,
    success: function(r){
      document.getElementById('xtbdy').value = '';
      document.getElementById('amk_xy').value = '';
      document.getElementById('xthd').value = '';
      if(document.getElementById('if1_gm').innerHTML !== ''){
        document.getElementById('if1_gm').children[0].src = '';
      }
      if(document.getElementById('if2_gm').innerHTML !== ''){
        document.getElementById('if2_gm').children[0].src = '';
      }
      
    },
    error: function(r){
      var tz = document.getElementById('pgerror').innerHTML;
      document.getElementById('pgerror').innerHTML = tx+", "+"post send failed."
      document.getElementById('pgerror').style.display = 'block';
    }
  })
}
}
window.onload = function(){
  sendReq({
    url:'/students_connect/trend/index.php',
    type:'POST',
    vals:"a=a&a=b",
    response: function(r){
    document.getElementsByClassName('js_go_to_lf')[0].innerHTML = this
  }
  });
}
  </script>
</body></html>