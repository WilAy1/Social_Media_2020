<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $user = $_SESSION['user'];
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $row['user'];
    if(isset($_GET['pid'])){
        $id = $mysp =  sanitizeString($_GET['pid']);
        if(isset($_GET['ck'])){
            $lo='socposts';
        }
        elseif(isset($_GET['ek'])){
            $lo = 'eduposts';
        }
        $rrtt = queryMysql("SELECT * FROM $lo WHERE id='$id'");
        if($rrtt->num_rows){
        $medu = mysqli_fetch_array(queryMysql("SELECT * FROM $lo WHERE id='$id'"));
        $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
        if(isset($_GET['ck'])){
        $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' AND user='".$row['user']."' ORDER BY timeofcomment DESC");
        $getsoccomment = mysqli_fetch_array($soccomment);
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
         ";
        global $vpns;
      }
      $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
         AND postid='".$mysp."'
         AND commentid='".$getsoccomment['id']."'"));
        $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
        AND postid='".$mysp."'
        AND commentid='".$getsoccomment['id']."'");
           if($pa->num_rows){
          $clrr = 'color: pink';
         }
         else {
           $clrr = '';
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
      <div class='fet' style='display: flex;'>
      <div class='phead imgapstr' style='
      background-image: url(\"".$pimg."\");'></div>
      <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$getsoccomment['id']."'>
      <a href='/students_connect/user/".$upc['user']."'><i></i>
      <div class='xk_nm'>".$geucd['surname']." ".$geucd['firstname']."</div>
      <div class='sk_un'><i class='fas fa-at'></i>".$geucd['user']."</div></a></div>
      <div class='comcnt'>".rhash(wordwrap($getsoccomment['cmt'], 60, "<br />"))."</div>
      ";
      $arr = [];
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists('../../../students_connect_hidden/comments/'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png')){
                        $files[$i] = '../../../students_connect_hidden/comments/'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png';
                        array_push($arr, $files[$i]);
                      }
                    }
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.'; margin-left: 3px; width: 90%;"><div class="aimg">';
                  $td = getcwd();
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists('../../../students_connect_hidden/comments/'.$getsoccomment['id'].'/'.$getsoccomment['id'].'('.$i.').png')){
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Trq' style='background-image: url(\"/students_connect_hidden/comments/".$getsoccomment['id']."/".$getsoccomment['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/comments/".$getsoccomment['id'].'/'.$getsoccomment['id']."(".$i.").png'></div>";
                    }
                  }
    echo "</div></div>";
      echo "<div class='posted i_posted'>".date('Y M d h:i a', $getsoccomment['timeofcomment'])."</div>
      <div class='cmtbtn'><div class='cupv ccmn cdwn scbtn'
     style='$clrr' onclick='lvec(\"".$medu['id']."\", 
    \"".$getsoccomment['id']."\", \"".$mbse['user']."\")' id='tclfh".$getsoccomment['id']."'>
    <span><i class='far fa-heart'></i></span>
    </div>
    <div class='cshr ccmn cdwn scbtn' id='reply".$getsoccomment['id']."'>
    <input type='hidden' name='pid' value='".$medu['id']."'>
    <input type='hidden' name='cid' value='".$getsoccomment['id']."'>
    <button type='button' onclick='opensReply(\"".$getsoccomment['id']."\")' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
    <div class='cupv ccmn cdwn scbtn report'>Report</div>
    </div></div>
      <div class='adrep' id='rep".$getsoccomment['id']."' style=' display: none;'>
      <form action='#".$getsoccomment['id']."' method='post' name='ecsom'>
      <div class='why_now'>
      <div class='fto'>
      <textarea class='ikanimi' id='replypst".$getsoccomment['id']."' name='cmtreplysocpst' placeholder='Replying @".$upc['user']."' value='' title='Input Reply'  rows='2' style='margin: 0px; border: none; resize: none;' wrap: hard;'></textarea></div>
      <div class='gee' style='vertical-align: middle; padding-left: 5px;
      '><label for='senrepdbutton".$getsoccomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
      </div>
      <input type='hidden' name='postid' value='".$getsoccomment['postid']."'>
      <input type='hidden' name='cmtid' value='".$getsoccomment['id']."'>
      <input type='submit' id='senrepdbutton".$getsoccomment["id"]."' style='display: none !important'/>
      </div></div>
      </form>
      </div>
      ".$vpns."<div id='dsplrp".$getsoccomment['id']."' class='dsplrp'></div>";
    }
    elseif(isset($_GET['ek'])){
        $educomment = queryMysql("SELECT * FROM educomments WHERE postid='$id' AND user='$user' ORDER BY timeofcomment DESC");
                    $geteducomment = mysqli_fetch_array($educomment);
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
                     ";
                    global $vpns;
                  }
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
                     if(file_exists("../../../students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/'.$geteducomment['user'].".png")){ 
                      $pimg =  '/students_connect_hidden/users_profile_upload/'.$geteducomment['user'].'/'.$geteducomment['user'].'.png';
                      }
                      else {
                          $pimg =  '/students_connect/user.png';
                      }
                  $plswrk = $geteducomment['id'];
                  $geucd = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$geteducomment['user']."'"));  
                  echo "
                  <div class='fet' style='display: flex;'>
                  <div class='phead imgapstr' style='
                  background-image: url(\"".$pimg."\");'></div>
                  <div class='commt_cont mddrt' id='awx' style='border-radius: 25px; width: 100%;'><div class='uswc' id='uswc".$geteducomment['id']."'>
                  <a href='/students_connect/user/".$upc['user']."'><i></i>
                  <div class='xk_nm'>".$geucd['surname']." ".$geucd['firstname']."</div>
                  <div class='sk_un'><i class='fas fa-at'></i>".$geucd['user']."</div>
                  </a></div>
                  <div class='comcnt'>".rhash(wordwrap($geteducomment['cmt'], 60, "<br />"))."</div>";
                  $arr = [];
                    for($i = 0; $i < 2; $i++){ 
                      if(file_exists('../../../students_connect_hidden/comments/s'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png')){
                        $files[$i] = '../../../students_connect_hidden/comments/s'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png';
                        array_push($arr, $files[$i]);
                      }
                    }
                $data = count($arr);
              if($data == 1){
                $da = 1;
              }
              else {
                $da = 2;
              }
                  echo '<div class="allimgposted" style="column-count: '.(int) $da.'; margin-left: 3px; width: 90%;"><div class="aimg">';
                  $td = getcwd();
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists('../../../students_connect_hidden/comments/s'.$geteducomment['id'].'/'.$geteducomment['id'].'('.$i.').png')){
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Trq' style='background-image: url(\"/students_connect_hidden/comments/s".$geteducomment['id']."/".$geteducomment['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/comments/s".$geteducomment['id'].'/'.$geteducomment['id']."(".$i.").png'></div>";
                    }
                  }
                echo "</div></div>";
                  echo "
                  <div class='posted i_posted'>".date('Y M d h:i a', $geteducomment['timeofcomment'])."</div>
                  <div class='cmtbtn'><div class='cupv ccmn cdwn'>
                    <span onclick='ducm(\"".$medu['id']."\",
                    \"".$geteducomment['id']."\", \"".$mbs['user']."\")'><i class='fas fa-caret-up'
                     style='$clrr' id='ror".$geteducomment['id']."'></i><span class='tccnt' id='utcnt".$geteducomment['id']."'>
                     ".$geteducomment['tun']."</span></span>
                    </div><div class='cdv ccmn cdwn'><span 
                    onclick='ddcm(\"".$medu['id']."\",
                    \"".$geteducomment['id']."\", \"".$mbs['user']."\")'><i class='fas fa-caret-down'
                     style='$clerr' id='dror".$geteducomment['id']."'></i><span class='tccnt' id='dutcnt".$geteducomment['id']."'
                     >".$geteducomment['tdn']."</span></span></div>
                    <div class='cshr ccmn cdwn'  onclick='openReply(".$geteducomment['id'].");' id='reply".$geteducomment['id']."'>
                    <input type='hidden' name='pid' value='".$medu['id']."'>
                    <input type='hidden' name='cid' value='".$geteducomment['id']."'>
                    <button type='submit' class='sbm'><span><i class='fas fa-reply'></i></span></button></div>
                    <div class='cupv ccmn cdwn report'>Report</div>
                    </div></div></div>
                    <div class='adrep' id='rep".$geteducomment['id']."' style=' display: none;'>
                    <form action='#".$geteducomment['id']."' method='post' name='eccom'>
                    <div class='why_now'>
                    <div class='fto'>
                    <textarea class='ikanimi' id='replypst".$geteducomment['id']."' name='cmtreplyedupst' placeholder='Replying @".$upc['user']."' value='' title='Input Reply'  rows='2' style='margin: 0px; border: none; resize: none;' wrap: hard;'></textarea></div>
                    <div class='gee' style='vertical-align: middle; padding-left: 5px;
                    '><label for='senrepdbutton".$geteducomment["id"]."'><span><i class='fas fa-arrow-up' id='cmtar'></i></span></label>
                    </div>
                    <input type='hidden' name='postid' value='".$geteducomment['postid']."'>
                    <input type='hidden' name='cmtid' value='".$geteducomment['id']."'>
                    <input type='submit' id='senrepdbutton".$geteducomment["id"]."' style='display: none !important'/>
                    </div>
                    </form>
                  </div>
                  ".$vpns."<div id='dsplrp".$geteducomment['id']."' class='dsplrp'></div>";
    }
}
}
?>