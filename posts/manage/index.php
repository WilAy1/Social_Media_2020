<?php
    require_once "/Users/wilay/students_connect/connect.php";
    require_once "/Users/wilay/students_connect/header2.php";
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
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
      <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="far fa-bell"></i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
    _END;
    if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    echo <<<_END
      </ul>   
      </div>
  <div class='pycl'>
  
  <div onload="checkDark()" class="dark-mode" id='darkmd'  style="min-height:650px;">
_END;
    if(isset($_GET['id']) && isset($_GET['t'])){
      $id = sanitizeString($_GET['id']);
      $t = sanitizeString($_GET['t']);
      if($t == '1'){
        $ix = 'socposts';
        $ms = 's';
        $comtype = 'sc';
      }
      else {
        $ix = 'eduposts';
        $ms = '';
        $comtype = 'c';
      }
      $ty = queryMysql("SELECT * FROM $ix WHERE (id='$id' AND isshare='0' AND user='".$row['user']."') OR (id='$id' AND sharedby='".$row['user']."')");
  if($ty->num_rows){
    $medu = mysqli_fetch_array($ty);
    if($medu['isshare'] == '1'){
      $postwas = $medu['sharedpstcont'];
      $isshare = 1; 
    }
    else {
      $postwas = $medu['pstcont'];
      $isshare = 0;
    }

    echo "<div class='mg_tboe'>
  <div class='mg_tbbec'><div class='mg_toyl'><i class='fas fa-cog'></i><span class='mg_kelmf'>Manage</span></div>
  <div class='mg_yked'>
  <div class='mg_smmty mteps mg_active'>Post</div>
  <div class='mg_smmty mtpls'>Polls</div>
  <div class='mg_smmty mtrmf'>Media</div>
  <div class='mg_smmty mtcnt'>Countdown</div>
  <div class='mg_smmty mttag'>Tags</div>
  <div class='mg_smmty mtprt'><a href='/students_connect/ads/pp.php?p=".$medu['id']."&t=".$medu['pstst']."'>Promote</a></div>
  </div>
  <div class='mg_trprj'>
  <div class='mg_ppx11 mg_inabx'>
  <div class='mg_ppx1hd mg_ged'>Edit Posts</div>
  <div class='mg_chpst'>
  <div class='mg_igtt'>
  <div class='mg_ohdc'>
  <div class='mg_sayorgg'>New Post</div>
  <textarea style='resize: none; width: 100%; margin: auto; border-radius: 5px; min-height: 150px' placeholder='Edit Post'>".strip_tags($postwas)."</textarea>
  </div>
  <div class='mg_mttps' onclick='document.getElementsByClassName(\"mg_igtt\")[0].style.display = \"none\";
   document.getElementsByClassName(\"mg_igtt2\")[0].style.display = \"flex\";'><i class='fas fa-arrow-right'></i></div>
  </div>
  <div class='mg_igtt2'>
  <div class='mg_mttps' onclick='document.getElementsByClassName(\"mg_igtt\")[0].style.display = \"flex\";
  document.getElementsByClassName(\"mg_igtt2\")[0].style.display = \"none\";'><i class='fas fa-arrow-left'></i></div>
  <div class='mg_orrgp'>
   <div class='mg_sayorgg'>Original Post</div>
   <div class='mg_jmobe'>".nl2br(rhash(strip_tags($postwas)))."</div>
   </div> 
  </div>
  <div class='mg_undbtn'>
  <div class='mg_ubbys ubbys1'>
  <input type='hidden' value='".$medu['id']."'/>
  <input type='hidden' value='".$row['user']."'/>
  <input type='hidden' value='".$comtype."'/>
  <i class='fas fa-upload'></i><span class='mg_compp'>Update</span></div>
  <div class='mg_ubbys ubbys2' onclick='".$comtype."(\"".$medu['id']."\", \"".$row['user']."\")'><i class='far fa-comment'></i><span class='mg_compp'>Comment</span></div>
  <div class='mg_ubbys ubbys3'>
  <input type='hidden' value='".$medu['id']."'/>
  <input type='hidden' value='".$row['user']."'/>
  <input type='hidden' value='1'/>
  <i class='fas fa-trash'></i><span class='mg_compp'>Delete</span></div>
  </div>
  </div>
  </div><div class='mg_blw'>
  <div class='mg_loek'>
  <div class='mg_ploox'><i class='fas fa-poll'></i> Poll</div> 
  </div>";
  $pav = queryMysql("SELECT * FROM polls WHERE pid='".$medu['id']."' AND pstst='$t'");
  if($pav->num_rows){
    $moaq = mysqli_fetch_array($pav);
    if(time() > $moaq['timetoend']){
      $st = 'Closed';
    }
    else {
      $st= 'Opened';
    }
    $tot = $moaq['o1clicks']+$moaq['o2clicks']+$moaq['o3clicks']+$moaq['o4clicks'];
    if($tot > 0){
    $opt1 = $moaq['o1clicks'].' clicks';
    $o1p = round(($moaq['o1clicks']/$tot) * 100, 2) .'%';
    $opt2 = $moaq['o2clicks'].' clicks';
    $o2p = round(($moaq['o2clicks']/$tot) * 100, 2) .'%';
    }
    else {
      $opt1 = $moaq['o1clicks'].' clicks';
    $o1p = '0%';
    $opt2 = $moaq['o2clicks'].' clicks';
    $o2p = '0%';
    }
    if($moaq['opt3'] != ''){
      $o3p = round(($moaq['o3clicks']/$tot) * 100, 2) .'%';
      $opt3 = $moaq['o3clicks'].' clicks';
      $fp3 = "<div class='mg_pd1fbk3'>".$moaq['opt3'].": ".$opt3.", ".$o3p."</div>";
      $m3 = "'".$moaq['opt3']."': ".(int) $moaq['o3clicks'].",";
    }
    else {
      $opt3 = '';
      $o3p = '';
      $fp3 = '';
      $m3 = '';
    }
    if($moaq['opt4'] != ''){
      $opt4 = $moaq['o4clicks'].' clicks';
      $o4p = round(($moaq['o4clicks']/$tot) * 100, 2) .'%';
      $fp4 = "<div class='mg_pd1fbk4'>".$moaq['opt4'].": ".$opt4.", ".$o4p."</div>";
      $m4 = "'".$moaq['opt4']."': ".(int) $moaq['o4clicks'].",";
    }
    else {
      $o4p = '';
    $opt4 = '';
    $fp4 = '';
    $m4 = '';
    }
    echo "<div class='mg_stdt'>
    <div class='mg_jkse'>Poll Details</div>
    <div class='mg_alpdts'>
    <div class='mg_lpd1b1'>
    <div class='mg_pd1'>
    <div class='mg_pd1vl'>Number of Clicks: ".$tot."</div>
    <div class='mg_pd1vx'>
    <div class='mg_pddbk'>Breakdown</div>
    <div class='mg_abval'>
    <div class='mg_pdcntcanv'><canvas id='mg_cvas'></div>
    <div class='mg_aldd'>
    <div class='mg_pd1fbk1'>".$moaq['opt1'].": ".$opt1.", ".$o1p."</div>
    <div class='mg_pd1fbk2'>".$moaq['opt2'].": ".$opt2.", ".$o2p."</div>
    ".$fp3."".$fp4."
    </div>
    </div>
    </div>
    </div>
    <div class='mg_pd2'>Start Time: ".date('d/m/Y h:i:s', $moaq['timestarted'])."</div>
    <div class='mg_pd3'>End Time: ".date('d/m/Y h:i:s', $moaq['timetoend'])."</div>
    <div class='mg_pd4'>Current Status: ".$st."</div>
    </div>
    <div class='mg_dlx' style='color: red;'><i class='fas fa-trash' style='padding-right: 4px;'></i> Delete Poll</div>
    </div>
    </div>
    <script>
    var mycanvas = document.getElementById('mg_cvas');
    mycanvas.width = 150;
    mycanvas.height = 150;
    var ctx = mycanvas.getContext('2d');
    function drawLine(ctx, startX, startY, endX, endY){
      ctx.beginPath();
      ctx.moveTo(startX, startY);
      ctx.lineTo(endX, endY);
      ctx.stroke();
    }
    function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
      ctx.beginPath()
      ctx.arc(centerX, centerY, radius, startAngle, endAngle);
      ctx.stroke();
}
function drawPieSlice(ctx, centerX, centerY, radius, startAngle, endAngle, color){
  ctx.fillStyle = color;
  ctx.beginPath();
  ctx.moveTo(centerX, centerY);
  ctx.arc(centerX, centerY, radius, startAngle, endAngle);
  ctx.closePath();
  ctx.fill();
}
var mdata = {
  '".$moaq['opt1']."': ".(int) $moaq['o1clicks'].",  
  '".$moaq['opt2']."': ".(int) $moaq['o2clicks'].",
  ".$m3."
  ".$m4."
};
var piechart = function(options){
  this.options = options;
  this.canvas = options.canvas;
  this.ctx = options.ctx;
  this.colors = options.colors;
  this.draw = function(){
    var total_value = 0;
    var color_index = 0;
    for(var categ in this.options.data){
      var val = this.options.data[categ];
      total_value += val;
    }
    var start_angle = 0;
    var x = 1;
    for(categ in this.options.data){
      val = this.options.data[categ];
      var slice_angle = 2 * Math.PI * val / total_value;
      var pieRadius = Math.min(this.canvas.width/2,this.canvas.height/2);
      var labelX = this.canvas.width/2 + (pieRadius/2)* Math.cos(start_angle + slice_angle/2);
      var labelY = this.canvas.height/2 + (pieRadius/2)* Math.sin(start_angle + slice_angle/2);
      var labelText = Math.round(100 * val / total_value);
      this.ctx.fillStyle = 'white';
      this.ctx.font = 'bold 11px Arial';
      this.ctx.fillText(labelText+'%', labelX, labelY);
      document.getElementsByClassName('mg_pd1fbk'+x)[0].style.whiteSpace = 'nowrap';
      document.getElementsByClassName('mg_pd1fbk'+x)[0].innerHTML = '<div class=\"mg_lee\" style=\"background-color:'+ this.colors[color_index%this.colors.length]+'; display: inline-block;\"></div>'+ document.getElementsByClassName('mg_pd1fbk'+x)[0].innerHTML;
      drawPieSlice(
        this.ctx,
        this.canvas.width/2,
        this.canvas.height/2,
        Math.min(this.canvas.width/2, this.canvas.height/2),
        start_angle,
        start_angle+slice_angle,
        this.colors[color_index%this.colors.length]
      );
      start_angle += slice_angle;
      color_index++;
      x++;
    }
  }
}
var mp = new piechart(
  {
    canvas: mycanvas,
    ctx: ctx,
    data: mdata,
    colors: ['#3c768c', '#201974', '#682047', '#9a6c1b'] 
  }
)
mp.draw();
    </script>
    ";
  }
  else {
    echo "This post doesn't have a poll.";
  }
  echo "</div><div class='mg_smed'>
  <div class='mg_sbcmd'>
  <div class='mg_cwmdm'><i class='fas fa-photo-video'></i>Media</div>
  <div class='mg_mdcprs'>
  ";
  if(file_exists('../../../students_connect_hidden/postuploads/'.$ms.'/'.$medu['id'].'(0)'.'.png') || file_exists('../../../students_connect_hidden/postuploads/'.$ms.'/'.$medu['id'].'(0)'.'.mp4')
  || file_exists('../../../students_connect_hidden/postuploads/'.$ms.'/'.$medu['id'].'(1)'.'.png') || file_exists('../../../students_connect_hidden/postuploads/'.$ms.'/'.$medu['id'].'(1)'.'.mp4')){
    echo "<div class='mg_dmd'>";
    $arr = [];
                  $td = getcwd();
                  chdir("../../../students_connect_hidden/postuploads/".$ms."/");
                  for($i = 0; $i < 2; $i++){ 
                      if(file_exists($medu['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/".$ms."/".$medu['id']."(".$i.").png";
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
                  echo '<div class="allimgposted mg_ppos" style="column-count: '.(int) $da.';"><div class="aimg">';
                  $td = getcwd();
                    chdir("../../../students_connect_hidden/postuploads/".$ms."/");
                  for($i = 0; $i < 2; $i++){
                    if(file_exists($medu['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$ms."/".$medu['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$ms."/".$medu['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     
                    }
                    }
                  echo '</div></div>';
                  echo '<div class="allimgposted mg_ppos"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp4")){
                    echo "
                    <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                    <source src='/students_connect_hidden/postuploads/".$ms."/".$medu['id']."(0).mp4' type='video/mp4'>
                    </video></div>
                    ";
                }
                echo "</div></div>";
                echo '<div class="allimgposted mg_ppos"><div class="aimg">';
                  if(file_exists($medu['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/".$ms."/".$medu['id']."(0).mp3' type='video/mp4'>
                    </video></div>
                    ";
                }
                chdir($td);
    
    echo "</div>
    <div class='mg_dlmed'><span class='mg_lldse' style='cursor: pointer; padding-right: 5px;'><i class='fas fa-trash'></i></span>Delete</div>";
  }
  else {
    echo 'Media not found';
  }
  echo "</div></div></div>";
  echo "<div class='mg_coudn'>
  <div class='mg_cdefs'>
  <div class='mg_cdoqm'><i class='far fa-clock'></i>Countdown</div>
  <div class='mg_lsjer'>";
  if(strpos($medu['pstcont'], "['countdown']:[") != FALSE && strpos($medu['pstcont'], "]']") !=  FALSE){
    $mk = explode(" ", $medu['pstcont']);
    for($i = 0; $i < count($mk); $i++){
      $s = $mk[$i];
      if(strpos($s, "['countdown']:[") != FALSE && strpos($s, "]']") != FALSE){
        $q = strpos($medu['pstcont'], "]']");
        $m = strpos($s, "['countdown']:[");
        $c = substr($s, $m+16, strlen($s)-30);
        $c = str_replace('-', ' ', $c);
      break;
      }
    }
    echo "<div class='mg_ssmse'>
    <div class='mg_swcto'>
    <div class='mg_kedx'>Countdown to $c found</div>
    <div class='mg_owcse'>
    <span class='mg_owcsex' style='color: red;'><i class='fas fa-trash'></i> Delete</span></div>
    </div></div>";
  }
  else {
    echo "No countdown in post";
  }
  echo "</div></div></div><div class='mg_tggs'>
  <div class='mg_tgex'>
  <div class='mg_cdoqm'><i class='fas fa-info'></i>Tags</div>
  <div class='mg_fnesa'>";
  $oq = explode(" ", $medu['pinterest']);
  if($oq[0] == ''){
    unset($oq[0]);
  }
  for($i = 0; $i < count($oq); $i++){
    echo "<div class='mg_eotag'>".$oq[$i]."</div>";
  }
  echo "<div class='mg_adntgs'>
  <div class='mg_tgpls'><span class='mg_gleto'><i class='fas fa-plus'></i> Add</span>";
  if(count($oq)>0){
  echo "<span class='mg_ttgdal' style='color: red;'><i class='fas fa-trash'></i> Delete All</span>";
  }
  echo "</div></div>";
  echo "</div>
  </div>";

  
  echo "</div>";
  echo "</div></div>";
  echo "
  </div>
  </div>
  ";
  
  

  echo "</div></div>";
      }
      else {
        echo "<div class='mg_ketd'>Post not Available.</div>";
      }
    }
    else {
      echo "<div class='mg_ketd'>Post not Available.</div>";
    }

  
  echo "</div></div><div class='o_success'></div>
  <script src='/students_connect/jsf/filescript.js'></script>
  <script>
document.getElementsByClassName('mg_toyl')[0].style.backgroundColor = document.getElementsByClassName('dark-mode')[0].style.backgroundColor
</script>";
?>