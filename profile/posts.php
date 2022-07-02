<?php
define("prr", "/Users/wilay/students_connect/");
require_once prr."connect.php";
require_once "addnotification.php";
require_once "comment.php";
if(!$loggedin) die();
else {
  
  $user = $_SESSION['user'];
  if(isset($_GET['i']) && isset($_GET['1'])){
    $id = $_GET['i'];
  $get = queryMysql("SELECT * FROM votes WHERE id='$id'");
  $chus = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");  
  $id = $_GET['i'];
    $chpst = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $chmnou = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
      $chmnouf = mysqli_fetch_array($chmnou);
      $a = $chmnouf['voted'];
  if($a == 'upvote'){
    // do nothing
  }
  elseif ($a == 'downvote'){
    $upvote = 'upvote';
    $time = time();
    queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = ++$new['tun'];
    $tdn = --$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  else {
    $voted = 'upvote';
    $time = time();
    queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = (int) ++$new['tun'];
    $tdn = (int) $new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
    }
    
  
if (isset($_GET['d']) && isset($_GET['2'])){
  $id = $_GET['d'];
  $user = $_SESSION['user'];
  $chmnod = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
  $chmnodf = mysqli_fetch_array($chmnod);
  $a = 'downvote';
  if($chmnodf['voted'] == $a){
    // do nothing
  }
  elseif($chmnodf['voted'] == 'upvote'){
    $upvote = 'downvote';
    $time= time();
    queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = --$new['tun'];
    $tdn = ++$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  else {
    $voted = 'downvote';
    $time = time();
    queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
    $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
    $tun = $new['tun'];
    $tdn = ++$new['tdn'];
    $pnl = $tun + $tdn;
    queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
  }
  }



  if(isset($_GET['de']) && isset($_GET['e'])) {
    $id = $_GET['de'];
    $user = $_SESSION['user'];
    queryMysql("DELETE FROM eduposts WHERE id='$id'");
    queryMysql("DELETE FROM votes WHERE id='$id'");
    queryMysql("DELETE FROM educomments WHERE postid='$id'");
  }
  if(isset($_GET['de']) && isset($_GET['s'])) {
    $id = $_GET['de'];
    $user = $_SESSION['user'];
    queryMysql("DELETE FROM socposts WHERE id='$id'");
  }
  if(isset($_POST['dwneducommentid']) && isset($_POST['dwnedupostid'])
   && isset($_POST['user'])){
    $dctid = $_POST['dwneducommentid'];
    $dptid = $_POST['dwnedupostid'];
    $uuser = sanitizeString($_POST['user']);
    $ot = 0;
    $tm = time();
    $id = 0;
    $cfc = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='$uuser' AND postid='$dptid'
     AND commentid='$dctid'"));
    if($cfc['voted'] == 'downvote'){

     }
    elseif($cfc['voted'] == 'upvote'){
      $uv = 'downvote';
      $tm = time();
      queryMysql("UPDATE commentvotes SET voted='$uv',
      timeofcommentvote='$tm' WHERE user='$uuser' AND commentid='$dctid' AND postid='$dptid'");
      $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
          $tun = --$cmc['tun'];
          $tdn = ++$cmc['tdn'];
          queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");  
  }
    else {
    queryMysql("INSERT INTO commentvotes VALUES ('$id', '$uuser', 
    'downvote', '$dptid', '$dctid', '$ot', '$ot', '$tm'
    )");
     $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
     $tun = (int) $cmc['tun'];
     $tdn = (int) ++$cmc['tdn'];
     queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");
    }
   }
   if(isset($_GET['u'])){
    $abc = $_GET['u'];
    $abcd = "userprofilecode='$abc'";
    echo $abcd;  
  }
    else {
        $abcd = "user = '$iam'";
    }
     $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE $abcd"));
       $user = $upc['user'];
    $abc = queryMysql("SELECT * FROM eduposts WHERE user='$user' OR sharedby='$user'");
    $def = queryMysql("SELECT * FROM socposts WHERE user='$user' OR sharedby='$user'");
    if($row['status'] == '1' || $row['status']== '2'){
    if (mysqli_num_rows($abc) > 0 || mysqli_num_rows($def) > 0) {
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
                 $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
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
                     <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                     }
                   }
                   else {
                     for($i = 0; $i < 4; $i++){
                       echo "
                       <div class='ttags' style='padding: 5px; margin-right:6px;'>
                       <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                       }
                       echo "<div class='ttags phown' id='trtags' style='padding: 5px; margin-right:6px;' onclick='disptOths()'>...</div>";
                   }
                   echo "<div class='smoretags' 
                     id='moretags' style='display: none;'>";
                   for($i = 4; $i < count($tg); $i++){
                     echo "
                     <div class='ttags' padding: 5px; margin-right:6px;'>
                     <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
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
                     $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='0'>
                  <input type='hidden' value='".$medu['id']."'>
                  <input type='hidden' value='".$row['user']."'>
                  <i class='fas fa-comment'></i></div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($medu['user'] == $row['user']){
                    $xet = "<div class='tb_y tr_ash'>
                    <input type='hidden' value='".$medu['id']."'/>
                    <input type='hidden' value='".$row['user']."'/>
                    <input type='hidden' value='0'>
                    <i class='fas fa-trash' style='color:red;'></i>
                    </div>";
                    $xyt = '';
                    $xzt = '';
                  }
                     echo <<<PSTS
                         <div class='ipt'></div><div class='namp'>
                         <div class='esign' style='float: right; cursor: pointer;'>
                          <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                          <div id="myDropdown$sid" class="std_yx">
                          $xot
                          $xyt
                          $xzt
                          $xet
                          <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                          <div class='yxclose'>Close</div>
                          </div>
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
                     <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                     }
                   }
                   else {
                     for($i = 0; $i < 4; $i++){
                       echo "
                       <div class='ttags' style='padding: 5px; margin-right:6px;'>
                       <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                       }
                       echo "<div class='ttags' id='zymbxs' style='padding: 5px; margin-right:6px;' onclick='dispOths()'>...</div>";
                   }
                   for($i = 4; $i < count($tg); $i++){
                     echo "<div class='ttags own' 
                     id='moretags' style='display: none; padding: 5px; margin-right:6px;'>
                     <a href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
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
                     $content = strip_tags($medu['pstcont']);
                    $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  $pstcut = str_replace("search=\r\n", "", $pstcut);            
                     echo nl2br($pstcut).'</div>';
                     $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
                  if($polc->num_rows){
                    $gpo = mysqli_fetch_array($polc);
                    $xuser = $row['user'];
                    $clc = queryMysql("SELECT * FROM pollbase WHERE user='$xuser' AND pid='$tpeid' AND pstst='0'");
                    $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='0'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      
                      $sfo = "<i class='far fa-circle c_y'></i>";
                    $fto = "<i class='far fa-circle c_y'></i>";
                    $ftho = "<i class='far fa-circle c_y'></i>";
                    $ffour = "<i class='far fa-circle c_y'></i>";
                    $buttons = '';
                    $tBg = $sbg = $fbg = $obg = '';
                    $vct = '';
                    $uct = '';
                    $xct = '';
                    $oct = '';
                    if($clc->num_rows){
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = 0; 
                        }
                      $buttons = 'disabled';
                      $clck = mysqli_fetch_array($clc);
                      if($clck['clicked'] == 1){
                       $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                       $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                            background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 2){
                        $fto = "<i class='fas fa-check-circle c_x'></i>";
                        $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 3){
                        $ftho = "<i class='fas fa-check-circle c_x'></i>";
                        $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 4){
                        $ffour = "<i class='fas fa-check-circle c_x'></i>";
                        $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                  }
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
                    <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                    ".$sfo."".$gpo['opt1']."
                    <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                    <input type='hidden' id='usr1' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='0'>
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                    .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                    <input type='hidden' id='usr2' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='0'>
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                    .$ftho."".$gpo['opt3']."
                    <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                    <input type='hidden' id='usr3' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='0'>
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                    .$ffour."".$gpo['opt4']."
                    <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                    <input type='hidden' id='usr4' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='0'>
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                    </div>";
                  }
                  else {
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
                          }$vct = '<label id="xc_1">'.$x1v.'%</label>';
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
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                    </div>";
                    } 
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
                         <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['id']."(".$i.").png\")'></div>
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
                     <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                   }
                   else {
                     if($medu['sharedby'] == $mbs['user']){
                       $shrus = 'You';
                     }
                     else {
                         $shrus  = "<i class='fas fa-at'></i>".$mbse['user'];
                     }
                     $shr = $shrus." shared <a href='/students_connect/user/".$mbse['user']."'>
                     <i class='fas fa-at'></i>".$mbse['user']."</a>'s post";
                     echo <<<PSTS
                     <div class='camp'>
                     PSTS;
                     echo <<<PSTS
                      <div class='amps' id='
                     PSTS;
                     echo $medu['id']."'>";
                     $xet = "";
                     $sid = $medu['id'];
                     $xot = "<div class='tb_y cotx'>
                     <input type='hidden' value='0'>
                     <input type='hidden' value='".$medu['id']."'>
                     <input type='hidden' value='".$row['user']."'>
                     <i class='fas fa-comment'></i></div>";
                     $xzt = "<div class='tb_y repop'>Report Post</div>";
                     $xyt = "<div class='tb_y blusr'>Block User</div>";
                     if($medu['sharedby'] == $row['user']){
                       $xet = "<div class='tb_y tr_ash'>
                       <input type='hidden' value='".$medu['id']."'/>
                       <input type='hidden' value='".$row['user']."'/>
                       <input type='hidden' value='0'>
                       <i class='fas fa-trash' style='color:red;'></i>
                       </div>";
                       $xyt = '';
                       $xzt = '';
                     }
                     echo <<<PSTS
                         <div class='ipt'></div><div class='namp'>
                         <div class='esign' style='float: right; cursor: pointer;'>
                     <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                     <div id="myDropdown$sid" class="std_yx">
                     $xot
                     $xyt
                     $xzt
                     $xet
                     <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                     <div class='yxclose'>Close</div>
                     </div>
                     </div>
                     PSTS;
                     //echo <<<PSTS
                     //    <div class='ipt'></div><div class='namp'>
                   //PSTS;
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
                     $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
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
                     echo '<div class="mpst" id="mpst'.$medu['sharedpostid'].'">';
                     $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
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
                         <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png\")'></div>
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
                         <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
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
                       <audio  class='paudio'>
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
                     elseif($nov >= 1000 && $nov < 10000){
                       $nofv = substr($nov, 0, 1)."k views";
                     }
                     elseif($nov >= 10000 && $nov < 100000){
                       $nofv = substr($nov, 0, 2)."k views";
                     }
                     elseif($nov >= 100000 && $nov < 1000000){
                       $nofv = substr($nov, 0, 3)."k views";
                     }
                     elseif($nov >= 1000000 && $nov < 10000000){
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
                     elseif($cmmnt >= 1000 && $cmmnt < 10000){
                       $ans = substr($cmmnt, 0, 1)."k answers";
                     }
                     elseif($cmmnt >= 10000 && $cmmnt < 100000){
                       $ans = substr($cmmnt, 0, 2)."k answers";
                     }
                     elseif($cmmnt >= 100000 && $cmmnt < 1000000){
                       $ans = substr($cmmnt, 0, 3)."k answers";
                     }
                     elseif($cmmnt >= 1000000 && $cmmnt < 10000000){
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
                     $dvs = queryMysql("SELECT *  FROM votes WHERE user='".$row['user']."' AND id='".$medu['id']."'");
                     if($dvs->num_rows){
                       $dcolor = mysqli_fetch_array($dvs);
                       if($dcolor['voted'] == 'upvote'){
                         $mcolor = 'color: green';
                       }
                       else {
                         $mcolor = "";
                       }
                       if($dcolor['voted'] == 'downvote'){
                         $scolor = 'color: red';
                       }
                       else {
                         $scolor = "";
                       } 
                     }
                     else {
                       $mcolor = "";
                       $scolor = "";
                     }
                     echo '</div>
                     <div class="undbtn"><div class="upv cmn dwn" id="upv'.$medu['id'].'" 
                     style="'.$mcolor.'" onclick="upvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="cntl'.$medu['id'].'"
                      style="color: inherit !important;">'.red($medu['tun']).'</div>
                     </div><div class="lwv cmn dwn" style="'.$scolor.'" id="dwn'.$medu['id'].'" onclick="downvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span style="vertical-align: sub"><i class="fas fa-caret-down ycd"></i></span></div>
                     <div class="cmt cmn dwn" id="commt" onclick="c(\''.$medu['id'].'\', \''.$row['user'].'\')">
                     <button type="button" class="sbm">
                     <span><i class="far fa-comment dwtwc"></i></span>
                     <div class="cnt cmn xod xess" id="cntc'.$medu['id'].'">'.red($medu['pnc']).'</div></button></div>
                     <div class="shr cmn dwn" style="padding: 10px;">
                     <span id="sh'.$medu['id'].'"><i class="fas fa-share"></i></span></div>
                     <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' close"><i class="fas fa-arrow-left"></i></span>
                     <div class="sfff"><div class="shrtpst">Share Post</div>
                     <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="0">
                     Share</button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                     <div class="sam">Share as message</div>
                     <div class="rcntt"><input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                     $gser = $row['user'];
                     $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$gser' OR ftwo='$gser' order by lasttimeofmessage desc limit 5");
                     if($mffs->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmffs = mysqli_fetch_assoc($mffs)){
                         if($row['user'] == $gmffs['fone']){
                           $nof = $gmffs['ftwo'];
                         }
                         else {
                           $nof = $gmffs['fone'];
                         }
                         echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$medu['id']."' onchange='gin(\"".$medu['id']."\")'>".$nof."</div>";
                       }
                     }
                     echo '<div class="orrsb"><div class="orrs">Others</div>';
                     $xerw = $row['user'];
                     $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$xerw' AND type='following'");
                     if($mfss->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmfss = mysqli_fetch_assoc($mfss)){
                         echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                       }
                     }
                     echo'</div></div><div id="countsend'.$medu['id'].'">
                     </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</button>
                     </div>
                     </div></div></div>
                     ';
                     if(mysqli_num_rows($educomment) == 0){  
                       //leave space blank
                       echo "
                       <div class='comment_section' id='cmtedu".$medu['id']."'></div>";
                     }
                     else {
                       $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$geteducomment['id']."'"));
                        $pa = queryMysql("SELECT * FROM commentvotes WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$geteducomment['id']."'");
                        if($pa->num_rows){
                        if($dpa['voted'] == 'upvote'){
                         $clrr = 'color: green';
                        }
                        else {
                          $clrr = '';
                        }
                        if($dpa['voted'] == 'downvote'){
                         $clerr = 'color: red';
                        }
                        else {
                          $clerr = '';
                        }
                      }
                      else {
                        $clrr = $clerr = '';
                      }
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
                       <div class='comment_section' id='cmtedu".$medu['id']."' style='background-color: rgba(245, 245, 245, 0.4);'>
                       <div class='commt_cont'>
                       <div class='uswc' style='display: flex;'>
                       <div class='fet'>
                       <div class='phead imgapstr' style='
                       background-image: url(\"".$pimg."\");'></div></div>
                       <div class='tcmtn' style='color: blue; top: 10px; position: relative;'>".$upc['surname']." ".$upc['firstname']."</div></div>
                       <div class='comcnt'>".wordwrap($geteducomment['cmt'], 60, "<br />")."</div>
                       <div class='posted'>".date('M d h:i a', $geteducomment['timeofcomment'])."</div>
                       <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                       <span onclick='ucm(\"".$medu['id']."\",
                        \"".$geteducomment['id']."\", \"".$mbs['user']."\")'>
                        <i class='fas fa-caret-up' style='$clrr' id='ror".$geteducomment['id']."'></i></span>
                       </div><div class='cdv ccmn cdwn'><span onclick='dcm(\"".$medu['id']."\",
                       \"".$geteducomment['id']."\", \"".$mbs['user']."\")'>
                       <i class='fas fa-caret-down' style='$clerr'
                        id='dror".$geteducomment['id']."'></i></span></div>
                       <div class='cshr ccmn cdwn' id='reply".$geteducomment['id']."'>
                       <button type='button' class='sbm' onclick='r(\"".$medu['id']."\", \"".$geteducomment['id']."\", \"".$row['user']."\")'><span><i class='fas fa-reply'></i></span></button></div>
                       <div class='cupv ccmn cdwn report'>Report</div>
                       </div>
                       </div></div>";
                     }
                     echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                       <textarea name="cmtedupst"  onkeyup="getkVal(event, \''.$mbs['user'].'\', this.value, 
                       \''.$medu['id'].'\')" class="albts" id="ecmttextarea'.$medu['id'].'" placeholder="Comment..."" value="" title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                       </div><div class="sndbtn"><label for="esendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                       <input type="hidden" name="postid" value="'.$medu['id'].'">
                       <input type="button" id="esendbutton'.$medu['id'].'" style="display: none !important;" onclick="sndEdu(\''.$mbs['user'].'\', document.getElementById(\'ecmttextarea'.$medu['id'].'\').value, 
                        \''.$medu['id'].'\')"/></div>
                       </div></div>';          
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
           $eusr = $row['user'];
           $lvd = queryMysql("SELECT * FROM loves WHERE user='$eusr'
            AND loved='liked' AND id='".$medu['id']."'");
            $dlkd = queryMysql("SELECT * FROM loves WHERE user='$eusr'
            AND loved='disliked' AND id='".$medu['id']."'");
         if(($medu['user']==$user && $medu['sharedby'] == $user)
         || ($medu['user'] != $user && $medu['sharedby'] == $user)){
          $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
          if($medu['isshare'] == 0){
         echo <<<PSTS
         <div class='camp'>
         <div class='amps' id='soc
         PSTS;
         echo $medu['id']."'>";
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
                  $sid = $medu['id'];
         echo <<<PSTS
              <div class='ipt'></div><div class='namp'>
              <div class='esign' style='float: right; cursor: pointer;'>
                  <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                  <div id="myDropdown$sid" class="std_yx">
                  $xot
                  $xyt
                  $xzt
                  $xet
                  <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                  <div class='yxclose'>Close</div>
                  </div>
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
         echo '<div class="mpst" id="mpsts'.$medu['id'].'">';
         $content = strip_tags($medu['pstcont']);
         $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
         <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
         Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
         $pstcut = rhash($pstcut);
         echo nl2br($pstcut).'</div>';
                   $tpeid = $medu['id'];
                $etime = time();
                $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                  if($polc->num_rows){
                    $gpo = mysqli_fetch_array($polc);
                    $xuser = $row['user'];
                    $clc = queryMysql("SELECT * FROM pollbase WHERE user='$xuser' AND pid='$tpeid' AND pstst='1'");
                    $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                      $x1 = (int) $xed['o1clicks'];
                      $x2 = (int) $xed['o2clicks'];
                      $x3 = (int) $xed['o3clicks'];
                      $x4 = (int) $xed['o4clicks'];
                      
                      $sfo = "<i class='far fa-circle c_y'></i>";
                    $fto = "<i class='far fa-circle c_y'></i>";
                    $ftho = "<i class='far fa-circle c_y'></i>";
                    $ffour = "<i class='far fa-circle c_y'></i>";
                    $buttons = '';
                    $tBg = $sbg = $fbg = $obg = '';
                    $vct = '';
                    $uct = '';
                    $xct = '';
                    $oct = '';
                    if($clc->num_rows){
                      if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        }
                        else {
                          $x1v = $x2v = $x3v = $x4v = 0; 
                        }
                      $buttons = 'disabled';
                      $clck = mysqli_fetch_array($clc);
                      if($clck['clicked'] == 1){
                       $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                       $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                            background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 2){
                        $fto = "<i class='fas fa-check-circle c_x'></i>";
                        $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 3){
                        $ftho = "<i class='fas fa-check-circle c_x'></i>";
                        $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      elseif($clck['clicked'] == 4){
                        $ffour = "<i class='fas fa-check-circle c_x'></i>";
                        $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                        background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                      }
                      $vct = '<label id="xc_1">'.$x1v.'%</label>';
                      $uct = '<label id="xc_2">'.$x2v.'%</label>';
                      $xct = '<label id="xc_3">'.$x3v.'%</label>';
                      $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                  }
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
                    <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                    ".$sfo."".$gpo['opt1']."
                    <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                    <input type='hidden' id='usr1' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls1'>".$vct."</span>
                    </button>
                    </div>
                    <div class='tfsect mopts'>
                    <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                    .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                    <input type='hidden' id='usr2' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls2'>".$uct."</span>
                    </button>
                    </div>
                    <div class='tthrpt mopts' $for>
                    <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                    .$ftho."".$gpo['opt3']."
                    <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                    <input type='hidden' id='usr3' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls3'>".$xct."</span>
                    </button>
                    </div>
                    <div class='tforpt mopts' $ffr>
                    <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                    .$ffour."".$gpo['opt4']."
                    <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                    <input type='hidden' id='usr4' value='".$row['user']."'>
                    <input type='hidden' value='".$medu['id']."'>
                    <input type='hidden' value='1'>
                    <span id='ls4'>".$oct."</span>
                    </button>
                    </div>
                    </div>
                    <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                    </div>";
                  }
                  else {
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
                     $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                    </div>";
                    } 
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
                         <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['id']."(".$i.").png\")'></div>
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
                   <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                 }
                 else {
                   if($medu['sharedby'] == $mbs['user']){
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
                     $xet = "";
                     $sid = $medu['id'];
                     $xot = "<div class='tb_y cotx'>
                     <input type='hidden' value='1'>
                     <input type='hidden' value='".$medu['id']."'>
                     <input type='hidden' value='".$row['user']."'>
                     <i class='fas fa-comment'></i></div>";
                     $xzt = "<div class='tb_y repop'>Report Post</div>";
                     $xyt = "<div class='tb_y blusr'>Block User</div>";
                     if($medu['sharedby'] == $row['user']){
                       $xet = "<div class='tb_y tr_ash'>
                       <input type='hidden' value='".$medu['id']."'/>
                       <input type='hidden' value='".$row['user']."'/>
                       <input type='hidden' value='1'>
                       <i class='fas fa-trash' style='color:red;'></i>
                       </div>";
                       $xyt = '';
                       $xzt = '';
                     }
                     echo <<<PSTS
                         <div class='ipt'></div><div class='namp'>
                         <div class='esign' style='float: right; cursor: pointer;'>
                     <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                     <div id="myDropdown$sid" class="std_yx">
                     $xot
                     $xyt
                     $xzt
                     $xet
                     <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                     <div class='yxclose'>Close</div>
                     </div>
                     </div>
                     PSTS;
                     //echo <<<PSTS
                     //    <div class='ipt'></div><div class='namp'>
                   //PSTS;
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
                     echo '<div class="mpst" id="mpsts'.$medu['id'].'" style="min-height: 30px;">';
                     $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
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
                     echo '<div class="mpst" id="mpsts'.$medu['sharedpostid'].'">';
                     $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
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
                         <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png\")'></div>
                         <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(".$i.").png'></div>";
                   }
                       else {
                         echo "";                     }
                       }
                       echo '</div></div>';
                       echo '<div class="allimgposted"><div class="aimg">';
                       if(file_exists($medu['sharedpostid']."(0).mp4")){
                         echo "
                         <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                         <source src='/students_connect_hidden/postuploads/s/".$medu['sharedpostid']."(0).mp4' type='video/mp4'>
                         </video></div>
                         ";                      
                     }
                     echo "</div></div>";
                   echo '<div class="allimgposted"><div class="aimg">';
                     if(file_exists($medu['sharedpostid']."(0).mp3")){
                       echo "
                       <div class='postaudio'>
                       
                       <audio  class='paudio'>
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
                     if($lov->num_rows){
                   if($chlov['user'] == $row['user']){
                    $chlov['user'] = 'You';
                    if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                   }
                 }
                 else {
                   if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                   }
                 }
                }
                 if($lvd->num_rows){
                  $clr = 'color: rgb(255, 136, 156);';
                  $far = 'fas';
                }
                else {
                  $clr = 'color: inherit';
                  $far = 'far';
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
                   <div class="undbtn sundbtn"><div class="lkd cmn dwn" onclick="love(\''.$medu['id'].'\', \''.$mbs['user'].'\')">
                   <span id="love'.$medu['id'].'" style="'.$clr.'"><i class="'.$far.' fa-heart"></i></span><div class="cnt cmn lkdcnt'.$medu['id'].'" id="lkdcnt'.$medu['id'].'">
                   '.red($msoc['tln']).'</div>
                   </div>
                   <div class="cmt cmn dwn" id="commt" onclick="sc(\''.$medu['id'].'\', \''.$row['user'].'\')">
                   <input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="scid" value="">
                     <button type="submit" class="sbm">
                   <span><i class="far fa-comment dwtwc"></i></span>
                   <div class="cnt cmn cmnt'.$medu['id'].'"><div class="cnmb">'.red($medu['pnc']).'</div></div></button>
                   </div><div class="shr cmn dwn" style="padding: 10px;">
                   <span><i class="fas fa-share"></i></span></div>
                   <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' close"><i class="fas fa-arrow-left"></i></span>
                     <div class="sfff"><div class="shrtpst">Share Post</div>
                     <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$medu['id'].'">
                     <input type="hidden" value="1">Share
                     </button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                     <div class="sam">Share as message</div>
                     <div class="rcntt"><input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                     $gser = $row['user'];
                     $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$gser' OR ftwo='$gser' order by lasttimeofmessage desc limit 5");
                     if($mffs->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmffs = mysqli_fetch_assoc($mffs)){
                         if($row['user'] == $gmffs['fone']){
                           $nof = $gmffs['ftwo'];
                         }
                         else {
                           $nof = $gmffs['fone'];
                         }
                         echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$medu['id']."' onchange='gin(\"".$medu['id']."\")'>".$nof."</div>";
                       }
                     }
                     echo '<div class="orrsb"><div class="orrs">Others</div>';
                     $xerw = $row['user'];
                     $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$xerw' AND type='following'");
                     if($mfss->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmfss = mysqli_fetch_assoc($mfss)){
                         echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                       }
                     }
                     echo'</div></div><div id="countsend'.$medu['id'].'">
                     </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</button>
                     </div></div></div>
                   </div>
                   ';
                   if(mysqli_num_rows($soccomment) == 0){  
                     //leave space blank
                     echo "<div class='comment_section' id='cmt_sec".$medu['id']."'></div>";
                   }
                   else {
                     $aus = $getsoccomment['user'];
                     $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                     $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$getsoccomment['id']."'"));
                        $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$getsoccomment['id']."'");
                           if($pa->num_rows){
                         $clrr = 'color: pink';
                        }
                        else {
                          $clrr = '';
                        }
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
                      style='$clrr' onclick='lvec(\"".$medu['id']."\", 
                     \"".$getsoccomment['id']."\", \"".$mbs['user']."\")' id='tclfh".$getsoccomment['id']."'>
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
                   echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                     <textarea name="socedupst" class="albts" id="cmttextarea'.$medu['id'].'" placeholder="Comment..."" value="" 
                     title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                     </div><div class="sndbtn"><label for="sendbutton'.$medu['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                     <input type="hidden" name="postid" value="'.$medu['id'].'">
                     <input type="" id="sendbutton'.$medu['id'].'" style="display: none !important;"
                     onclick="sndSoc(\''.$mbs['user'].'\', document.getElementById(\'cmttextarea'.$medu['id'].'\').value, 
                     \''.$medu['id'].'\')"/></div>
                     </div></div>';          
                   echo '</div></div>';
       }
     }
                 }
                             
               }
     else {
       echo "<div class='npst' style='display: block;'>No post available!</div>";
     }
   }
   else {
    echo "<div class='npst' style='display: block;'>No post available!</div>";
  }
    }
   elseif($row['status'] == '3'){
     $xerw = $row['user'];
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
                 $ftime = date("D", $ttime)." at ".date("h:i a", $ttime);
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
            $eusr = $row['user'];
            $lvd = queryMysql("SELECT * FROM loves WHERE user='$eusr'
             AND loved='liked' AND id='".$msoc['id']."'");
             $dlkd = queryMysql("SELECT * FROM loves WHERE user='$eusr'
             AND loved='disliked' AND id='".$msoc['id']."'");
          if(($msoc['user']==$user && $msoc['sharedby'] == $user)
          || ($msoc['user'] != $user && $msoc['sharedby'] == $user)){
           $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$msoc['user']."'"));
           
           if($msoc['isshare'] == 0){
          echo <<<PSTS
          <div class='camp'>
          <div class='amps' id='soc
          PSTS;
          echo $msoc['id']."'>";
          $xet = "";
                   $xot = "<div class='tb_y cotx'>
                   <input type='hidden' value='1'>
                   <input type='hidden' value='".$msoc['id']."'>
                   <input type='hidden' value='".$row['user']."'>
                   <i class='fas fa-comment'></i></div>";
                   $xzt = "<div class='tb_y repop'>Report Post</div>";
                   $xyt = "<div class='tb_y blusr'>Block User</div>";
                   if($msoc['user'] == $row['user']){
                     $xet = "<div class='tb_y tr_ash'>
                     <input type='hidden' value='".$msoc['id']."'/>
                     <input type='hidden' value='".$row['user']."'/>
                     <input type='hidden' value='1'>
                     <i class='fas fa-trash' style='color:red;'></i>
                     </div>";
                     $xyt = '';
                     $xzt = '';
                   }
                   $sid = $msoc['id'];
          echo <<<PSTS
               <div class='ipt'></div><div class='namp'>
               <div class='esign' style='float: right; cursor: pointer;'>
                   <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                   <div id="myDropdown$sid" class="std_yx">
                   $xot
                   $xyt
                   $xzt
                   $xet
                   <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                   <div class='yxclose'>Close</div>
                   </div>
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
          echo '<div class="mpst" id="mpsts'.$msoc['id'].'">';
          $content = strip_tags($msoc['pstcont']);
          $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
          <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$msoc['id'].'">
          Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
          $pstcut = rhash($pstcut);
          echo nl2br($pstcut).'</div>';
                    $tpeid = $msoc['id'];
                 $etime = time();
                 $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                   if($polc->num_rows){
                     $gpo = mysqli_fetch_array($polc);
                     $xuser = $row['user'];
                     $clc = queryMysql("SELECT * FROM pollbase WHERE user='$xuser' AND pid='$tpeid' AND pstst='1'");
                     $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='1'"));
                       $x1 = (int) $xed['o1clicks'];
                       $x2 = (int) $xed['o2clicks'];
                       $x3 = (int) $xed['o3clicks'];
                       $x4 = (int) $xed['o4clicks'];
                       
                       $sfo = "<i class='far fa-circle c_y'></i>";
                     $fto = "<i class='far fa-circle c_y'></i>";
                     $ftho = "<i class='far fa-circle c_y'></i>";
                     $ffour = "<i class='far fa-circle c_y'></i>";
                     $buttons = '';
                     $tBg = $sbg = $fbg = $obg = '';
                     $vct = '';
                     $uct = '';
                     $xct = '';
                     $oct = '';
                     if($clc->num_rows){
                       if ($x1 != 0 || $x2 != 0 || $x3 != 0 || $x4 != 0) {
                         $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                         $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                         $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                         $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                         }
                         else {
                           $x1v = $x2v = $x3v = $x4v = 0; 
                         }
                       $buttons = 'disabled';
                       $clck = mysqli_fetch_array($clc);
                       if($clck['clicked'] == 1){
                        $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                        $tBg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                             background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                       }
                       elseif($clck['clicked'] == 2){
                         $fto = "<i class='fas fa-check-circle c_x'></i>";
                         $sbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                         background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                       }
                       elseif($clck['clicked'] == 3){
                         $ftho = "<i class='fas fa-check-circle c_x'></i>";
                         $fbg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                         background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                       }
                       elseif($clck['clicked'] == 4){
                         $ffour = "<i class='fas fa-check-circle c_x'></i>";
                         $obg = 'style=\'background: linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8)); 
                         background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                       }
                       $vct = '<label id="xc_1">'.$x1v.'%</label>';
                       $uct = '<label id="xc_2">'.$x2v.'%</label>';
                       $xct = '<label id="xc_3">'.$x3v.'%</label>';
                       $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                   }
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
                     <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                     ".$sfo."".$gpo['opt1']."
                     <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                     <input type='hidden' id='usr1' value='".$row['user']."'>
                     <input type='hidden' value='".$msoc['id']."'>
                     <input type='hidden' value='1'>
                     <span id='ls1'>".$vct."</span>
                     </button>
                     </div>
                     <div class='tfsect mopts'>
                     <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                     .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                     <input type='hidden' id='usr2' value='".$row['user']."'>
                     <input type='hidden' value='".$msoc['id']."'>
                     <input type='hidden' value='1'>
                     <span id='ls2'>".$uct."</span>
                     </button>
                     </div>
                     <div class='tthrpt mopts' $for>
                     <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                     .$ftho."".$gpo['opt3']."
                     <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                     <input type='hidden' id='usr3' value='".$row['user']."'>
                     <input type='hidden' value='".$msoc['id']."'>
                     <input type='hidden' value='1'>
                     <span id='ls3'>".$xct."</span>
                     </button>
                     </div>
                     <div class='tforpt mopts' $ffr>
                     <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                     .$ffour."".$gpo['opt4']."
                     <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                     <input type='hidden' id='usr4' value='".$row['user']."'>
                     <input type='hidden' value='".$msoc['id']."'>
                     <input type='hidden' value='1'>
                     <span id='ls4'>".$oct."</span>
                     </button>
                     </div>
                     </div>
                     <div class='nmbfclicks'>".sumcl($gpo['o1clicks'], $gpo['o2clicks'],
                      $gpo['o3clicks'], $gpo['o4clicks'])." votes</div>
                     </div>";
                   }
                   else {
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
                      $gpo['o3clicks'], $gpo['o4clicks'])." votes . Closed</div>
                     </div>";
                     } 
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
                          <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$msoc['id']."(".$i.").png\")'></div>
                          <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$msoc['id']."(".$i.").png'></div>";
                    }
                        else {
                          echo "";                     }
                        }
                        echo '</div></div>';
                        echo '<div class="allimgposted"><div class="aimg">';
    
                        if(file_exists($msoc['id']."(0).mp4")){
                          echo "
                          <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
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
                        
                        <audio  class='paudio'>
                        <source src='/students_connect_hidden/postuploads/s/".$msoc['id']."(0).mp3' type='video/mp4'>
                        </video></div>
                        ";                      
                    }
                      chdir($td);
                    echo '</div></div>
                    <div class="posted" id="posted'.$msoc['id'].'">'.$ftime.'</div>';
                  }
                  else {
                    if($msoc['sharedby'] == $mbs['user']){
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
                      echo $msoc['id']."'>";
                      $xet = "";
                      $sid = $msoc['id'];
                      $xot = "<div class='tb_y cotx'>
                      <input type='hidden' value='1'>
                      <input type='hidden' value='".$msoc['id']."'>
                      <input type='hidden' value='".$row['user']."'>
                      <i class='fas fa-comment'></i></div>";
                      $xzt = "<div class='tb_y repop'>Report Post</div>";
                      $xyt = "<div class='tb_y blusr'>Block User</div>";
                      if($msoc['sharedby'] == $row['user']){
                        $xet = "<div class='tb_y tr_ash'>
                        <input type='hidden' value='".$msoc['id']."'/>
                        <input type='hidden' value='".$row['user']."'/>
                        <input type='hidden' value='1'>
                        <i class='fas fa-trash' style='color:red;'></i>
                        </div>";
                        $xyt = '';
                        $xzt = '';
                      }
                      echo <<<PSTS
                          <div class='ipt'></div><div class='namp'>
                          <div class='esign' style='float: right; cursor: pointer;'>
                      <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                      <div id="myDropdown$sid" class="std_yx">
                      $xot
                      $xyt
                      $xzt
                      $xet
                      <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                      <div class='yxclose'>Close</div>
                      </div>
                      </div>
                      PSTS;
                      //echo <<<PSTS
                       //   <div class='ipt'></div><div class='namp'>
                    //PSTS;
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
                      echo '<div class="mpst" id="mpsts'.$msoc['id'].'" style="min-height: 30px;">';
                      $content = strip_tags($msoc['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$msoc['id'].'"><input type="hidden" value="1"/><input type="hidden" value="'.$msoc['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
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
                      echo '<div class="mpst" id="mpsts'.$msoc['sharedpostid'].'">';
                      $content = strip_tags($msoc['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$msoc['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
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
                          <div class='postimages'><div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(".$i.").png\")'></div>
                          <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(".$i.").png'></div>";
                    }
                        else {
                          echo "";                     }
                        }
                        echo '</div></div>';
                        echo '<div class="allimgposted"><div class="aimg">';
                        if(file_exists($msoc['sharedpostid']."(0).mp4")){
                          echo "
                          <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                          <source src='/students_connect_hidden/postuploads/s/".$msoc['sharedpostid']."(0).mp4' type='video/mp4'>
                          </video></div>
                          ";                      
                      }
                      echo "</div></div>";
                    echo '<div class="allimgposted"><div class="aimg">';
                      if(file_exists($msoc['sharedpostid']."(0).mp3")){
                        echo "
                        <div class='postaudio'>
                        
                        <audio  class='paudio'>
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
                      if($lov->num_rows){
                    if($chlov['user'] == $row['user']){
                     $chlov['user'] = 'You';
                     if($rwlov == 1){
                      echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="svl" value="'.$msoc["id"].'">
                      <button type="submit" id="lbn">
                      <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                    }
                    elseif($rwlov > 1){
                      echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="svl" value="'.$msoc["id"].'">
                      <button type="submit" id="lbn">
                      <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                    }
                  }
                  else {
                    if($rwlov == 1){
                      echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="svl" value="'.$msoc["id"].'">
                      <button type="submit" id="lbn">
                      <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                    }
                    elseif($rwlov > 1){
                      echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="svl" value="'.$msoc["id"].'">
                      <button type="submit" id="lbn">
                      <i class="fas fa-heart" style="color: pink"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                    }
                  }
                }
                  if($lvd->num_rows){
                    $clr = 'color: rgb(255, 136, 156);';
                    $far = 'fas';
                  }
                  else {
                    $clr = 'color: inherit';
                    $far = 'far';
                  }
                  if($dlkd->num_rows){
                    $color = 'color: red;';
                  }
                  else {
                    $color = 'color: inherit';
                  }
                  echo "
      
                ";
                  $msoc = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='".$msoc['id']."'"));
                $getsoccomment = mysqli_fetch_array($soccomment);
                    echo '</div>
                    <div class="undbtn sundbtn"><div class="lkd cmn dwn" onclick="love(\''.$msoc['id'].'\', \''.$mbs['user'].'\')">
                    <span id="love'.$msoc['id'].'" style="'.$clr.'"><i class="'.$far.' fa-heart"></i></span><div class="cnt cmn lkdcnt'.$msoc['id'].'" id="lkdcnt'.$msoc['id'].'">
                    '.red($msoc['tln']).'</div>
                    </div>
                    <div class="cmt cmn dwn" id="commt" onclick="sc(\''.$msoc['id'].'\', \''.$row['user'].'\')">
                    <input type="hidden" name="spid" value="'.$msoc["id"].'">
                      <input type="hidden" name="scid" value="">
                      <button type="submit" class="sbm">
                    <span><i class="far fa-comment dwtwc"></i></span>
                    <div class="cnt cmn cmnt'.$msoc['id'].'"><div class="cnmb">'.red($msoc['pnc']).'</div></div></button>
                    </div><div class="shr cmn dwn" style="padding: 10px;">
                    <span><i class="fas fa-share"></i></span></div>
                    <div id="oe'.$msoc['id'].'" class="oe" style="display: none;"><span class="close'.$msoc['id'].' close"><i class="fas fa-arrow-left"></i></span>
                      <div class="sfff"><div class="shrtpst">Share Post</div>
                      <div class="s_laa_p">
                     <div class="s_oooee_e">
                     <div class=""></div>
                     <textarea class="sp_teext" cols="90" rows="20"></textarea>
                     <button class="share">
                     <input type="hidden" value="'.$msoc['id'].'">
                     <input type="hidden" value="1">
                     Share</button>
                     <button class="pplex">
                     Share as Message
                     </button>
                     </div>
                     </div>
                     <div class="ploxx">
                      <div class="sam">Share as message</div>
                      <div class="rcntt"><input type="checkbox" class="selectall'.$msoc['id'].'" onclick="sall(\''.$msoc['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                      $gser = $row['user'];
                      $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$gser' OR ftwo='$gser' order by lasttimeofmessage desc limit 5");
                      if($mffs->num_rows==0){
                        echo 'No recently messaged user';
                      }
                      else {
                        while($gmffs = mysqli_fetch_assoc($mffs)){
                          if($row['user'] == $gmffs['fone']){
                            $nof = $gmffs['ftwo'];
                          }
                          else {
                            $nof = $gmffs['fone'];
                          }
                          echo "<div class='selectefformessage'><input type='checkbox' value='".$nof."' class='arsltd".$msoc['id']."' onchange='gin(\"".$msoc['id']."\")'>".$nof."</div>";
                        }
                      }
                      echo '<div class="orrsb"><div class="orrs">Others</div>';
                      $xerw = $row['user'];
                      $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$xerw' AND type='following'");
                      if($mfss->num_rows==0){
                        echo 'No recently messaged user';
                      }
                      else {
                        while($gmfss = mysqli_fetch_assoc($mfss)){
                          echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$msoc['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$msoc['id']."\")'>".$gmfss['friend']."</div>";
                        }
                      }
                      echo'</div></div><div id="countsend'.$msoc['id'].'">
                      </div><button onclick="sendShare(\''.$row['user'].'\', \''.$msoc['pstcont'].'\', \''.$msoc['id'].'\')">Send</button>
                      </div></div></div>
                    </div>
                    ';
                    if(mysqli_num_rows($soccomment) == 0){  
                      //leave space blank
                      echo "<div class='comment_section' id='cmt_sec".$msoc['id']."'></div>";
                    }
                    else {
                      $aus = $getsoccomment['user'];
                      $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                      $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                         AND postid='".$msoc['id']."'
                         AND commentid='".$getsoccomment['id']."'"));
                         $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                         AND postid='".$msoc['id']."'
                         AND commentid='".$getsoccomment['id']."'");
                            if($pa->num_rows){
                          $clrr = 'color: pink';
                         }
                         else {
                           $clrr = '';
                         }
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
                       style='$clrr' onclick='lvec(\"".$msoc['id']."\", 
                      \"".$getsoccomment['id']."\", \"".$mbs['user']."\")' id='tclfh".$getsoccomment['id']."'>
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
                    echo '<div class="addcom haddcom" id="addcom"><div class="wcb"><div class="cmttxt">
                      <textarea name="socedupst" class="albts" id="cmttextarea'.$msoc['id'].'" placeholder="Comment..."" value="" 
                      title="Input Comment"  rows="2" cols="72" style="margin: 0px; border-radius:10px; resize: none;" wrap="hard"></textarea>
                      </div><div class="sndbtn"><label for="sendbutton'.$msoc['id'].'"><span><i class="fas fa-arrow-up" id="cmtar"></i></span></label>
                      <input type="hidden" name="postid" value="'.$msoc['id'].'">
                      <input type="" id="sendbutton'.$msoc['id'].'" style="display: none !important;"
                      onclick="sndSoc(\''.$mbs['user'].'\', document.getElementById(\'cmttextarea'.$msoc['id'].'\').value, 
                      \''.$msoc['id'].'\')"/></div>
                      </div></div>';          
                    echo '</div></div>';
        }
      }
                  }
                  else {
                    echo "<div class='npst' style='display: block;'>No post available!</div>";            
                  }
                }
      else {
        echo "<div class='npst' style='display: block;'>No post available!</div>";
      }
    }
   }
   /*echo "
   <script>
   if(document.getElementsByClassName('lastpl')){
     var g = document.getElementsByClassName('lastpl');
     for(var i = 0; i < g.length; i++){
       var xe = g[i];
       xe.onclick = function(){
         var crar = [];
         var value= this.value;
         var pid = this.children[3].value;
         var user = this.children[2].value;
         var pstst = this.children[4].value;
         a = this.firstElementChild.className;
       this.firstElementChild.className = a.replace('far fa-circle c_y', 'fas fa-check-circle c_x');
       this.style.background = 'linear-gradient(90deg, rgba(73, 73, 204, 0.8), rgba(73, 73, 204, 0.8))';
       this.style.backgroundRepeat = 'no-repeat';
       var x = this.parentElement;
         var xy = x.parentElement;
         var ex = xy.parentElement;
         var kxy = ex.children;
         for(var e = 0; e < kxy.length; e++){ 
         var k = kxy[e].children;
         for(var d = 0; d < k.length; d++){
           var l = k[d].children;
           for(var t = 0; t < l.length; t++){
           l[t].setAttribute('disabled', 'disabled');
           crar.push(l[t]);
         }
         }
       }
       var ls1 = crar[0].children[5];
       var ls2 = crar[1].children[5];
       var ls3 = crar[2].children[5];
       var ls4 = crar[3].children[5];
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           var db = xmlhttp.responseText;
           var p1 = db.indexOf('P');
           var p2 = parseInt(db.indexOf('K')+1);
           var p3 = parseInt(db.indexOf('A')+1);
           var p4 = db.indexOf('T');
           ls1.innerHTML = db.substring(0, p1);
           ls2.innerHTML = db.substring(p1+1, parseInt(p2-1));
           ls3.innerHTML = db.substring(p2, p3-1);
           ls4.innerHTML = db.substring(p3, p4);
           crar[0].style.backgroundSize = db.substring(0, p1)+'% 100%';
           crar[1].style.backgroundSize = db.substring(p1+1, parseInt(p2-1))+'% 100%';
           crar[2].style.backgroundSize = db.substring(p2, p3-1)+'% 100%';
           crar[3].style.backgroundSize = db.substring(p3, p4)+'% 100%';
         }
     };
     xmlhttp.open('GET', '/students_connect/polls/?id='+pid+'&vote='+value+'&user='+user+'&pstst='+pstst);
     xmlhttp.send();
     }
     }
   }
   var iks = document.getElementsByTagName('IMG');
  console.log(iks.length);
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
if(document.getElementsByClassName('shr') && (window.innerWidth < 799)){
  var q, w, e,r ,t,y,u;
  var q = document.getElementsByClassName('shr');
  for(w = 0; w < q.length; w++){
    q[w].onclick = function(){
      e = this.parentElement;
      r = e.children[4];
      r.style.display = 'block';
      
    }
  } 
}
   </script>";*/
?>