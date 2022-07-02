<?php
    require_once "/Users/wilay/students_connect/connect.php";
    $fposts = queryMysql("SELECT * FROM forumposts WHERE forumid='$fid' ORDER BY dateofpost DESC");
while($gp = mysqli_fetch_array($fposts)){   
    $pusr = $gp['user'];
    $tui = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$pusr'")); 
    $ttime = $gp['dateofpost'];
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
          $xet = "";
                  $xot = "<div class='tb_y cotx'>
                  <input type='hidden' value='0'>
                  <input type='hidden' value='".$gp['id']."'>
                  <input type='hidden' value='".$user."'>
                  Open Comments</div>";
                  $xzt = "<div class='tb_y repop'>Report Post</div>";
                  $xyt = "<div class='tb_y blusr'>Block User</div>";
                  if($gp['user'] == $user){
                    $xet = "<div class='tb_y'>Delete Post</div>";
                    $xyt = '';
                    $xzt = '';
                  }
    echo '<div class="camp">      
    <div class="amps" id="f'.$gp['id'].'">
    <div class="esign" style="float: right; cursor: pointer;">
    <div class="tesmby"><i class="fas fa-ellipsis-v vert"></i></div>
    <div id="myDropdown$sid" class="std_yx">
            '.$xot.'
            '.$xyt.'
            '.$xzt.'
            '.$xet.'
            </div>
            </div>
            <div class="namp">';
                $td = getcwd();
                chdir("../../students_connect_hidden/users_profile_upload/".$gp['user'].'/');
                if(file_exists($gp['user'].".png")){ 
                  $img =  '/students_connect_hidden/users_profile_upload/'.$gp['user'].'/'.$gp['user'].'.png';  
                }
                  else {
                    chdir($td);
                      $img =  '/students_connect/user.png';
                  }
                  chdir($td);
                  echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$gp['user']."'>
                  <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                  <div class='name'>".$tui['surname']." ".$tui['firstname']."</a></div></div>
          </div>";
          echo '<div class="mpst" id="mpst'.$gp['id'].'">';
                  $pstcut = strlen($gp['contentofpost']) > 250 ? substr($gp['contentofpost'], 0, 150).'&hellip;
                  <div class="readmore" onclick="rdmore(\''.$gp['id'].'\')" id="readmr" style="font-size:12px;">Read More</div>' : $gp['contentofpost'];
                  $pstcut = str_replace("search=\r\n", "", $pstcut);            
                  echo nl2br($pstcut).'</div>';
                  $tpeid = $gp['id'];
                  $etime = time();
                  $polc = queryMysql("SELECT * FROM forumpolls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
                    if($polc->num_rows){
                      $gpo = mysqli_fetch_array($polc);
                      $clc = queryMysql("SELECT * FROM forumpollbase WHERE user='$user' AND pid='$tpeid' AND pstst='0'");
                      $xed = mysqli_fetch_array(queryMysql("SELECT * FROM forumpolls WHERE pid='$id' AND pstst='0'"));
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
                            $x1v = $x2v = $x3v = $x4v = ''; 
                          }
                        $buttons = 'disabled';
                        $clck = mysqli_fetch_array($clc);
                        if($clck['clicked'] == 1){
                         $sfo = "<i class='fas fa-check-circle c_x'></i>";  
                         $tBg = 'style=\'background: linear-gradient(90deg, rgb(73, 73, 204, 0.8), rgb(73, 73, 204, 0.8)); 
                              background-size: '.$x1v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 2){
                          $fto = "<i class='fas fa-check-circle c_x'></i>";
                          $sbg = 'style=\'background: linear-gradient(90deg, rgb(73, 73, 204, 0.8), rgb(73, 73, 204, 0.8)); 
                          background-size: '.$x2v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 3){
                          $ftho = "<i class='fas fa-check-circle c_x'></i>";
                          $fbg = 'style=\'background: linear-gradient(90deg, rgb(73, 73, 204, 0.8), rgb(73, 73, 204, 0.8)); 
                          background-size: '.$x3v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        elseif($clck['clicked'] == 4){
                          $ffour = "<i class='fas fa-check-circle c_x'></i>";
                          $obg = 'style=\'background: linear-gradient(90deg, rgb(73, 73, 204, 0.8), rgb(73, 73, 204, 0.8)); 
                          background-size: '.$x4v.'% 100%; background-repeat: no-repeat;\'';
                        }
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                                    }
                      echo "<div class='shpollpost'>
                      <div class='thopts'>
                      <div class='tfopt mopts'>
                      <button class='lastpl p-1' id='p_1' $buttons value='1' $tBg>
                      ".$sfo."".$gpo['opt1']."
                      <input type='hidden' id='cli1' value='".$gpo['o1clicks']."'/>
                      <input type='hidden' id='usr1' value='".$row['user']."'>
                      <input type='hidden' value='".$gp['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls1'>".$vct."</span>
                      </button>
                      </div>
                      <div class='tfsect mopts'>
                      <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                      .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                      <input type='hidden' id='usr2' value='".$row['user']."'>
                      <input type='hidden' value='".$gp['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls2'>".$uct."</span>
                      </button>
                      </div>
                      <div class='tthrpt mopts'>
                      <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                      .$ftho."".$gpo['opt3']."
                      <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                      <input type='hidden' id='usr3' value='".$row['user']."'>
                      <input type='hidden' value='".$gp['id']."'>
                      <input type='hidden' value='0'>
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts'>
                      <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                      .$ffour."".$gpo['opt4']."
                      <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                      <input type='hidden' id='usr4' value='".$row['user']."'>
                      <input type='hidden' value='".$gp['id']."'>
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
                      $polc = queryMysql("SELECT * FROM forumpolls WHERE pid='$tpeid' AND pstst='0'");
                      if($polc->num_rows){
                        $gpo = mysqli_fetch_array($polc);
                        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM forumpolls WHERE pid='$id' AND pstst='0'"));
                        $x1 = (int) $xed['o1clicks'];
                        $x2 = (int) $xed['o2clicks'];
                        $x3 = (int) $xed['o3clicks'];
                        $x4 = (int) $xed['o4clicks'];
                        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
                        $vct = '<label id="xc_1">'.$x1v.'%</label>';
                        $uct = '<label id="xc_2">'.$x2v.'%</label>';
                        $xct = '<label id="xc_3">'.$x3v.'%</label>';
                        $oct = '<label id="xc_4">'.$x4v.'%</label>';
                        $buttons = 'disabled';
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
                      <div class='tthrpt mopts'>
                      <button class='lastpl p-3' id='p_3' $buttons value='3'>"
                      .$gpo['opt3']."
                      <span id='ls3'>".$xct."</span>
                      </button>
                      </div>
                      <div class='tforpt mopts'>
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
                    chdir("../../students_connect_hidden/postuploads/f/");
                    for($i = 0; $i < 2; $i++){ 
                        if(file_exists($gp['id']."(".$i.").png")){
                          $files[$i] = "/Students_connect_hidden/postuploads/f/".$gp['id']."(".$i.").png";
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
                      chdir("../../students_connect_hidden/postuploads/f/");
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists($gp['id']."(".$i.").png")){  
                        echo "
                        <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/f/".$gp['id']."(".$i.").png'></div>";
                  }
                      else {
                        echo "";                     }
                      }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($gp['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/f/".$gp['id']."(0).mp4' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  echo "</div></div>";
                  echo '<div class="allimgposted"><div class="aimg">';
                    if(file_exists($gp['id']."(0).mp3")){
                      echo "
                      <div class='postaudio'>
                      
                      <audio controls class='paudio'>
                      <source src='/students_connect_hidden/postuploads/f/".$gp['id']."(0).mp3' type='video/mp4'>
                      </video></div>
                      ";                      
                  }
                  chdir($td);
                  echo '</div></div>
                  <div class="posted">'.$ftime.'</div>';
                  echo '
                  <div class="pwl"> ';
                  $nc = mysqli_fetch_array(queryMysql("SELECT * FROM forumpostviews WHERE id='".$gp['id']."'"));
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
                  $cmmnt = $gp['tncomments'];
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
                  $fl = $gp['tnuvotes'];
                  if($fl == 1){
                    $other  = 'other';
                    global $other;
                  }
                  else {
                    $other = 'others';
                    global $other;
                  } 
                  $rwvot = $gp['tnuvotes'];
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
                  $pid = $gp['id'];
                  $dvs = queryMysql("SELECT *  FROM forumpostsvotes WHERE user='$user' AND postid='$pid'");
                  if($dvs->num_rows){
                    $dcolor = mysqli_fetch_array($dvs);
                    if($dcolor['tov'] == 'upvote'){
                      $mcolor = 'color: green';
                    }
                    else {
                      $mcolor = "";
                    }
                    if($dcolor['tov'] == 'downvote'){
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
                echo "<div class='nfans tviews'><i class='fas fa-caret-up teyefig'
                 style='color: green; font-size: 15px !important; padding-top: 0px !important;'></i>
                <div class='nmbcfcnt nofviews'>".$tvoc."</div></div>
                <div class='separator'><i class='fas fa-dot-circle'></i></div>
                <div class='nfans tviews'><i class='far fa-comment teyefig'></i>
                <div class='nmbcfcnt nofviews'>".$ans."</div></div>
                <div class='separator'><i class='fas fa-dot-circle'>
                </i></div><div class='tviews'><i class='fas fa-eye teyefig'></i>
                <div class='nofviews'>".$nofv."</div></div>";
                echo '</div>
                <br><div class="undbtn"><div class="upv cmn dwn" id="fupv'.$gp['id'].'" 
                 onclick="fupvote(\''.$user.'\', \''.$gp['id'].'\', \''.$gp['forumid'].'\')"><span id="titg'.$gp['id'].'"
                 style="'.$mcolor.'"><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="fcntl'.$gp['id'].'"
                 style="color: inherit !important;">'.$gp['tnuvotes'].'</div>
                </div><div class="lwv cmn dwn" style="'.$scolor.'" id="fdwn'.$gp['id'].'" onclick="fdownvote(\''.$user.'\', \''.$gp['id'].'\', \''.$gp['forumid'].'\')"><span ><i class="fas fa-caret-down ycd" style="vertical-align: sub"></i></span></div>
                <div class="cmt cmn dwn" id="fcommt">
                <input type="hidden" value="'.$gp['id'].'">
                <input type="hidden" value="'.$gp['forumid'].'">
                <button type="button" class="sbm">
                <span><i class="far fa-comment dwtuc"></i></span>
                <div class="cnt cmn" id="fcntc'.$gp['id'].'">'.$gp['tncomments'].'</div></button></div>
                </div></div></div>';
            }
?>
<script>
       if(x =document.getElementsByClassName('cmt')){
    var a,b,c,d,e,f, pid;
    for(f = 0; f < x.length; f++){
      a = x[f];
      a.onclick = function(){
          pid = this.children[0].value;
          fid = this.children[1].value;
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById('quest').innerHTML = xmlhttp.responseText;
            window.history.pushState('', '', '/students_connect/f/'+parseInt(fid)+'/'+pid)
        }
     };
     xmlhttp.open('GET', '/students_connect/f/fposts.php?pid='+pid+'&fid='+fid);
     xmlhttp.send();       
      }
    }
}
</script>