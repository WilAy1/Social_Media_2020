<?php
define('ROOT' , "/Users/wilay/students_connect/");
require_once ROOT."connect.php";
require_once ROOT."header2.php";
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
echo <<<_END
<link rel='stylesheet' href='/students_connect/cssf/stories.css'>
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
  <div class='spg'>
  <div class='re_Ss'>
  <div class='freth'><i class='far fa-bookmark'></i><span class='s_ert'>SAVED</span></div>
  </div>
_END;
$ret = queryMysql("SELECT * FROM saved WHERE user='$user' ORDER BY timeofsave DESC");
while($g = mysqli_fetch_array($ret)){
  if($g['type'] == 0 || $g['type'] == 1){
  if($g['type'] == 0){
    $r = 'eduposts';
    $rt = 'Educational';
    $c = 'c(\''.$g['saveid'].'\', \''.$row['user'].'\')';
  } 
  else if($g['type'] == 1){
    $r = 'socposts';
    $rt = 'Social';
    $c = 'sc(\''.$g['saveid'].'\', \''.$row['user'].'\')';
    }
  $medu = mysqli_fetch_array(queryMysql("SELECT * FROM $r WHERE id='".$g['saveid']."'"));
              $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
                
  $ti = date("D M Y h:i a", $g['timeofsave']);
  echo "<div class='pss_et' style='margin-bottom: 10px;'>
  <div class='loeer'>
  <div class='lo_Re'>".$ti."</div>
  <div class='mmcd'>
  ";
  if(!empty($g['caption'])){
  echo "<div class='av_cap'>".$g['caption']."</div>";
  }
  echo <<<PSTS
         <div class='camp' style='border: 1px solid #bebebe; padding: 0px;'>
         PSTS;
         if($medu['pstst'] == 0){
         if($medu['pinterest'] != '0' || !empty($medu['pinterest']) || $medu['pinterest'] == NULL){
          echo "<div class='phonetags' style='display: flex; padding: 0px;'>";
          $tg = explode(",",$medu['pinterest']);
        sort($tg);
        if(count($tg) <=4){
        for($i = 0; $i < count($tg); $i++){
        echo "
        <div class='ttags' style='padding: 5px; dipslay: none; margin-right:6px;'>
        <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
        }
      }
      else {
        for($i = 0; $i < 4; $i++){
          echo "
          <div class='ttags' style='padding: 5px; margin-right:6px;'>
          <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
          }
          echo "<div class='ttags phown' id='trtags' style='padding: 5px; margin-right:6px;' onclick='disptOths()'>...</div>";
      }
      echo "<div class='smoretags' 
        id='moretags' style='display: none;'>";
      for($i = 4; $i < count($tg); $i++){
        echo "
        <div class='ttags' style='padding: 5px; margin-right:6px;'>
        <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
        ";
        
    echo "</div>";
      }
      echo "</div></div>";
    }
  }
        
        $sid = $medu['id'];
        
  echo <<<PSTS
          <div class='amps' style='padding: 4px;' id='soc
         PSTS;
         $xet = "";
                     $xot = "<div class='tb_y cotx'>
                     <input type='hidden' value='1'>
                     <input type='hidden' value='".$medu['id']."'>
                     <input type='hidden' value='".$row['user']."'>
                     <i class='fas fa-comment'></i></div>";
                     $xzt = "<div class='tb_y repop'>Report Post</div>";
                     $xyt = "<div class='tb_y blusr'>Block User</div>";
                     if($medu['user'] == $row['user']){
                       $xet = "<div class='tb_y tr_ash'>
                       <input type='hidden' value='".$medu['id']."'/>
                       <input type='hidden' value='".$row['user']."'/>
                       <input type='hidden' value='1'>
                       <i class='fas fa-trash' style='color:red;'></i>
                       </div>";
                       $xyt = '';
                       $xzt = '';
                     }
         echo $medu['id']."'>";
         echo <<<PSTS
              <div class='ipt'></div><div class='namp'>
         PSTS;
         $td = getcwd();
                     chdir("../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
         if(file_exists($medu['user'].".png")){ 
             $img =  '/students_connect_hidden/users_profile_upload/'.$medu['user'].'/'.$medu['user'].'.png';
             chdir($td);
           }
         else {
           chdir($td);
            $img =  '/students_connect/user.png';
               }
             chdir($td);
         echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'
         ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
         <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
         <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
         echo '<div class="mpst" id="mpsts'.$medu['id'].'">';
         $content = strip_tags($medu['pstcont']);
         $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
         <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
         Read Full Post <i class="fas fa-angle-double-down"></i></div>' : $content;
         $pstcut = rhash($pstcut);
         echo nl2br($pstcut).'</div></div>
         <div class="qwicy">
         <div class="maatt">
         <div class="cmn go_to" onclick="'.$c.'"><i class="fas fa-external-link-alt"></i></div>
         <div class="cmn del_li">
         <input type="hidden" value="'.$g['id'].'">
         <i class="fas fa-trash" style="color:red;"></i></div>
         <div class="cmn co_ppy">
         <input type="text" style="width: 1px; opacity:0;" value="'.$_SERVER['HTTP_HOST']."/students_connect/v/".$g['splink'].'">
         <i class="fas fa-link"></i></div>
         <div class="cmn sh_rrr"><i class="fas fa-share-square"></i></div>
         ';
         echo "<div class='giatyp' style='font-size: 13px; right: 0; position: absolute; 
         margin-right: 10px; color: gray;'>".$rt."</div>";
         echo '
         </div>
         </div>
         </div>';
  echo "</div>
  </div>
  </div>";
}
else if($g['type'] == 2){
  $medu = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE messageid='".$g['saveid']."'"));
  $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['sender']."'"));
  $ti = date("D M Y h:i a", $g['timeofsave']);
  echo "<div class='pss_et' style='margin-bottom: 10px;'>
  <div class='loeer'>
  <div class='lo_Re'>".$ti."</div>
  <div class='mmcd'>
  ";
  if(!empty($g['caption'])){
  echo "<div class='av_cap'>".$g['caption']."</div>";
  }
  echo <<<PSTS
         <div class='camp' style='border: 1px solid #bebebe; padding: 0px;'>
         PSTS;
    $sid = $medu['messageid'];
        
  echo <<<PSTS
          <div class='amps' style='padding: 4px;' id='soc
         PSTS;
         
         echo $medu['messageid']."'>";
         echo <<<PSTS
              <div class='ipt'></div><div class='namp'>
         PSTS;
         $td = getcwd();
                     chdir("../../students_connect_hidden/users_profile_upload/".$medu['sender'].'/');
         if(file_exists($medu['sender'].".png")){ 
             $img =  '/students_connect_hidden/users_profile_upload/'.$medu['sender'].'/'.$medu['sender'].'.png';
             chdir($td);
           }
         else {
           chdir($td);
            $img =  '/students_connect/user.png';
               }
             chdir($td);
         echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'
         ><div class='imgfpstr' style='background-image: url(\"$img\");'></div>
         <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
         <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
         echo '<div class="mpst" id="mpsts'.$medu['messageid'].'">';
         $pstcut = $content = strip_tags($medu['message']);
         $pstcut = rhash($pstcut);
         echo nl2br($pstcut).'</div></div>
         <div class="qwicy">
         <div class="maatt">
         <div class="cmn go_to" onclick="window.location.href=\'/students_connect/v/'.$g['splink'].'\'"><i class="fas fa-external-link-alt"></i></div>
         <div class="cmn del_li">
         <input type="hidden" value="'.$g['id'].'">
         <i class="fas fa-trash" style="color:red;"></i></div>
         <div class="cmn co_ppy">
         <input type="text" style="width: 1px; opacity:0;" value="'.$_SERVER['HTTP_HOST']."/students_connect/v/".$g['splink'].'">
         <i class="fas fa-link"></i></div>
         <div class="cmn sh_rrr"><i class="fas fa-share-square"></i></div>
         ';
         echo "<div class='giatyp' style='font-size: 13px; right: 0; position: absolute; 
         margin-right: 10px; color: gray;'>".$rt."</div>";
         echo '
         </div>
         </div>
         </div>';
  echo "</div>
  </div>
  </div>";
}
}
echo <<<_END
  </div>
_END;
echo <<<_END
  </div></div>
_END;
echo <<<_END
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
if(document.getElementsByClassName('co_ppy')){
var co = document.getElementsByClassName('co_ppy');
for(var i = 0; i < co.length; i++){
  co[i].onclick = function(){
    var val = this.children[0];
    val.select();
    val.setSelectionRange(0, 99999);
    document.execCommand("copy");
  }
}
}
if(document.getElementsByClassName('del_li')){
  var del = document.getElementsByClassName('del_li');
  for(var i = 0; i < del.length; i++){
    del[i].onclick = function(){
      this.parentElement.parentElement.parentElement.parentElement.parentElement.style.display = 'none';
      if(window.FormData){
        fl =  new FormData();
        }
        fl.append('i', this.children[0].value)
        $.ajax({
        url: '/students_connect/save/index.php',
        type:"POST",
        data:fl,
        processData: false,
        contentType: false,
        success: function(){
        var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Successfully deleted.';
        qx.style.fontSize = '13px';
        document.body.append(qx);
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
        }})
    }
  }
}
if(document.getElementsByClassName('sh_rrr')){
  var ffg = document.getElementsByClassName('sh_rrr');
  for(var i = 0; i < ffg.length; i++){
    ffg[i].onclick = function(){
      var oq = document.createElement('div');
      oq.className = 'i_m_oq';
      oq.innerHTML = "<div class='shr_sav'><div class='shr_sav_hd'>SHARE</div>"+
      "<div class='ssw_lo'>"+
      "<div class='frrone'><i class='fas fa-link'></i><span class='ccpo'>Copy Link</span></div>"+
      "<div class='frrtwo'><i class='fas fa-pen'></i>Create as New Post</div>"+
      "<div class='frrthree'><i class='fas fa-times'></i>Close</div></div></div></div>";
      document.body.style.position = 'fixed'
      document.body.append(oq);
    }
  }
}
</script>
<script src='/students_connect/jsf/filescript.js'></script>
<script>
document.getElementsByClassName('re_Ss')[0].style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor
</script>
_END;
?>