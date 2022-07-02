<?php
session_start();
require_once "/Users/wilay/students_connect/connect.php";
    $pu = $_SESSION['user'];
    $st = (int) $_POST['end'];
    $surelyoccured = dec($_POST['su']);
    $ssurelyoccured = dec($_POST['ssu']);
    $end = $st+15;
    $dsm = $mbs = $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    $user = $dsm['user'];
    $myf = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
    $far = array();
    $puf = array();
    array_push($far, $user);
    while($f = mysqli_fetch_array($myf)){
      $trr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$f['friend']."') OR (user='".$f['friend']."' 
      AND touser='".$user."') OR (user='$user' AND touser='".$f['friend']."') OR 
      (user='".$f['friend']."' AND touser='".$user."')");
      if($trr->num_rows == 0){
      array_push($far, $f['friend']);
      array_push($puf, $f['friend']);
      }
    }
   $win = "'".implode("','",$far)."'";
   // from interests
   $myinterests = $dsm['interests'];
   $exc = explode(",",$myinterests);
   $nstr = '';
   $oea = '';
   $frre = '';
   $adq = '';
   for($i = 0; $i < count($exc); $i++){
     $nstr.= " OR pinterest LIKE '%".$exc[$i]."%'";
     $adq.= " OR sptags LIKE '%".$exc[$i]."%'";
     $oea.= " OR relatedto LIKE '%".$exc[$i]."%'";
     $frre.=" OR purpose LIKE '%".$exc[$i]."%' OR about LIKE '".$exc[$i]."'"; 
   }
   // from institution and course
   $mycourse = $dsm['course'];
   $myinstitution = $dsm['institution'];
   if($mycourse != '' || $myinstitution != ''){
   
   }
   $last = strtotime("5 day ago");
   $mlove = queryMysql("SELECT * FROM loves WHERE user='$user' AND timeoflike > $last ORDER BY timeoflike DESC");
   $isq = [];
   while($mlo = mysqli_fetch_array($mlove)){
     $mlov = number_format($mlo['id']);
     $llox = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$mlov'"));
     array_push($isq, $llox['user']);
   }
   $isq = array_values(array_unique($isq));
   $mow = explode(',', $win);
   for($i = 0; $i < count($isq); $i++){
     $mk = queryMysql("SELECT * FROM recommendations WHERE user='$user' AND rd='".$isq[$i]."'");
   if((!in_array("'".$isq[$i]."'", $mow)) && (mysqli_num_rows($mk) == 0)){
     $win.=",'".$isq[$i]."'";
   }
   }
   $mvote = queryMysql("SELECT * FROM votes WHERE user='$user' AND voted='upvote' AND timeofvote > $last");
   $isq = [];
   while($mlo = mysqli_fetch_array($mvote)){
     $mlov = number_format($mlo['id']);
     $llox = mysqli_fetch_array(queryMysql("SELECT * FROM socposts WHERE id='$mlov'"));
     array_push($isq, $llox['user']);
   }
   $isq = array_values(array_unique($isq));
   $mow = explode(',', $win);
   for($i = 0; $i < count($isq); $i++){
     $mk = queryMysql("SELECT * FROM recommendations WHERE user='$user' AND rd='".$isq[$i]."'");
   if((!in_array("'".$isq[$i]."'", $mow)) && (mysqli_num_rows($mk) == 0)){
     $win.=",'".$isq[$i]."'";
   }
   }
   $ptime = time();
   $lthidays = strtotime("".sanitizeString($_POST['la'])." month ago");
   if($myf->num_rows){
     
   $sltm = queryMysql("SELECT * FROM eduposts WHERE (user IN ($win) or sharedby IN ($win)$nstr )
   $surelyoccured 
   OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
           UNION ALL
       SELECT * FROM socposts WHERE (user IN ($win) OR sharedby IN ($win)$nstr) 
       $ssurelyoccured OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
       ORDER BY  
         RAND() DESC LIMIT 10");
         if($sltm->num_rows == 0){
          $sltm = queryMysql("SELECT * FROM eduposts where (id != '' $surelyoccured)
          AND timeofupdate BETWEEN $lthidays AND $ptime
          UNION ALL
            SELECT * FROM socposts WHERE (id != '' $ssurelyoccured)
            AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 10");      
            if($sltm->num_rows==0){
              
            } 
        }
   }
   else {$sltm = queryMysql("SELECT * FROM eduposts WHERE (id != '' $surelyoccured)
   AND timeofupdate BETWEEN $lthidays AND $ptime
     UNION ALL
       SELECT * FROM socposts where (id != '' $ssurelyoccured)
       AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 10");
   }
   // friends suggestion
   /*
     Getting friends suggestions,
     1. freinds of friends
     2. friends from institution
     3. friends in the perimeter of your surroundings
     4. people following you which you aren't following but friends are following
     5. category of people you follow
     6. ....
   */
   // list of friends in $nwin, friends of friends in $nwin in $suglist
   $nwin = "'".implode("','", $puf)."'";
     $suglist = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend != '$user'");
   $fl = array();
   while($gs = mysqli_fetch_array($suglist)){
     array_push($fl, $gs['friend']);
   }
   if($mycourse != '' & $myinstitution !=''){
     $lf = queryMysql("SELECT * FROM members WHERE course='$mycourse' AND institution='$myinstitution' AND user != '$user'");
     while($gl = mysqli_fetch_array($lf)){
       if(!in_array($gl['user'], $far)){
         array_push($fl, $gl['user']);
       }
     }
   }
   $mfl = array_unique($fl);
   $mfl = array_merge($mfl);
   $agg = array();
   for($i = 0; $i < count($mfl); $i++){
       $na = array($mfl[$i], count(array_keys($fl, $mfl[$i])));
       array_push($agg, $na);
   }
   for($r = 0; $r < count($agg); $r++){
     for($x = 0; $x < 1; $x++){
       //echo $agg[$r][$x].'=>'.$agg[$r][$x+1];
     }
   }
   $adsspace = array();
   for($i = 0; $i < 3; $i++){
       array_push($adsspace, rand(3, 15));
   }
   $forumspace = array();
   for($x = 0; $x < 6; $x++){
     array_push($forumspace, rand(1, 20));
   }
   $suggestedspace  = array();
   for($x = 0; $x<2; $x++){
     array_push($suggestedspace, rand(1, 10));
   }
   $discoveradspace = array();
   array_push($discoveradspace, rand(3, 15));
   $forumadspace = array(rand(3, 15));
   $e = 0;
   if($mbs['status'] == '1' || $mbs['status']== '2'){
   while(($medu = mysqli_fetch_array($sltm)) && $e < count($medu)){    
    $ttr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$medu['user']."') OR (user='".$medu['user']."' 
    AND touser='".$user."') OR (user='$user' AND touser='".$medu['sharedby']."') OR 
    (user='".$medu['sharedby']."' AND touser='".$user."')");
    if($ttr->num_rows==0){
    if($medu['pstst'] == 0){
      $surelyoccured.=" AND id != '".$medu['id']."'";
    }
    else {
      $ssurelyoccured.=" AND id != '".$medu['id']."'";
    }
    $studco_ad_images = array("/students_connect_hidden/ads/mesimg1.png", "/students_connect_hidden/ads/mesimg2.png", "/students_connect/ico/StudCo.png");
    for($x = 0; $x < count($adsspace); $x++){
      $qguess = queryMysql("SELECT * FROM ads WHERE expired='0' AND  (sptags != '' $adq) ORDER BY RAND()");
      if($adsspace[$x] == $e && $qguess->num_rows){
        $qg = mysqli_fetch_array($qguess);
        $ent = $qg['entity'];
        if($qg['adtype'] == '1'){
          $qgu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$ent."'"));
          if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png")){
            $umld = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png";
          }
          else {
            $umld = '/students_connect/user.png';
          }
          if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png")){
            $ucov = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png";
            $ywi = "<img src='".$ucov."' class='wilfad_cv_img'/>";
          }
          else {
            $ywi = '';
            $ucov = '';
          }
          echo "<div class='wilfad_sp'>
          <div class='wilfad_spfus'>
          <div class='wilfad_cont'>
          <div class='wilfad_mg'>
          <div class='wilfad_yaj'>
          <div class='wilfad_cv' style='background-image: url(\"".$ucov."\")'></div>
          ".$ywi."
          </div>
          <div class='wilfad_gam'>
          <div class='wilfad_dp' style='background-image: url(\"".$umld."\");'></div>
          <img src='".$umld."' class='wilfad_dp_img'/>
          </div></div>
          <div class='wilfad_info'>
          <div class='wilfad_name'>
          <a href='/students_connect/user/".$qgu['user']."'>
          <div class='wilfad_fname'>".$qgu['firstname']." ".$qgu['surname']."</div>
          <div class='wilfad_uname'><i class='fas fa-at'>".$qgu['user']."</i></div>
          </a></div>
          <div class='wilfad_abt'>".$qgu['about']."</div>
          </div>
          <div class='wilfad_btns'><button class=''>Follow</button></div>
          </div>
          </div>
          <div class='t_ad_tag'>Ad by StudCo</div>
          </div>";
        }
        elseif($qg['adtype'] == '2'){
          if($qg['ispostid'] == '0'){
            $mj = 'eduposts';
          }
          elseif($qg['ispostid'] == '1'){
            $mj = 'socposts';
          }
          $gm = queryMysql("SELECT * FROM $mj WHERE id='".$qg['extracontent']."'");
          if($gm->num_rows){
            $agm = mysqli_fetch_array($gm);
            echo "<div class='wilfad_sp'>
            <div class='wilfad_spfus'>
            <div class='wilfad_cont'>
            
            </div>
            <div class='t_ad_tag'>Ad by StudCo</div>
            </div></div>";
          }
          elseif($gm['adtype'] == '3'){
            //is special
            echo "<div class='wilfad_sp'>
            <div class='wilfad_spfus'>
            <div class='wilfad_cont'>
            
            </div>
            <div class='t_ad_tag'>Ad by StudCo</div>
            </div></div>";
          }
        }
  
        /*$tu = array_rand($studco_ad_images, 1);
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
        </div>";*/
      }
    }
    for($x = 0; $x < count($suggestedspace); $x++){
       if($suggestedspace[$x] == $e){
         $ts = '';
         $rs = '';
         for($r = 0; $r < count($agg); $r++){
           for($x = 0; $x < 1; $x++){
             /*echo $agg[$r][$x].'=>'.$agg[$r][$x+1]*/
             $ts.=" OR user = '".$agg[$r][$x]."'";
           }
         }
         for($i = 0; $i < count($mow); $i++){
          $q = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend=".$mow[$i]."");
          if(($mow[$i] != "'".$row['user']."'")&&($q->num_rows == 0)){
          $ts.=" OR user = ".$mow[$i]."";
        }
      }
         $rs = substr($rs, 3, strlen($rs));
         $nts = substr($ts ,3, strlen($ts));
         if(!isset($occr)){
           $occr ="user != ''";
           }
           $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      $lry = [];
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
            array_push($lry, $gfsg['user']);
        }
      }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      if((mysqli_num_rows($fsg) > 0) && (count($lry) > 0)){
      echo "<div class='wh_cant'>
      <div class='s_fo_you'>Suggested for you</div>
      <div class='th_li_st'>";
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
        $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/".$gfsg['user'].'/');
      if(file_exists($gfsg['user'].".png")){ 
        $cimg =  '/students_connect_hidden/users_profile_upload/'.$gfsg['user'].'/'.$gfsg['user'].'.png';  
      }
        else {
          chdir($td);
            $cimg =  '/students_connect/user.png';
        }
        if(file_exists('cover/cover.png')){
          $odma = "<div class='atbck' style=\"background-image: url('/students_connect_hidden/users_profile_upload/".$gfsg['user']."/cover/cover.png')\"></div>";
        }
        else {
          $odma = "<div class='atbck' style='background: brown;'></div>";
        }
        chdir($td);
        $eot = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend='".$gfsg['user']."' ORDER BY RAND()");
        $nae = mysqli_num_rows($eot)-1;
        $geot = mysqli_fetch_array($eot);
        echo "
           <div class='on_u_a_Tm'>
           <div class='p_l_atf'>
           <a  href='/students_connect/user/".$gfsg['user']."'>
           ".$odma."
           <div class='cna_aam'>
           <div class='na_aam' style='background-image:url(\"".$cimg."\")' title='".$gfsg['user']." suggested' width='96' height='96'></div>
           <div class='t_fna_m'>
           <div class='p_e_pep'>
           <div class='_m'>
           ".$gfsg['surname']." ".$gfsg['firstname']."
           </div>
           <div class='th_un_m'><i class='fas fa-at'></i>".$gfsg['user']."</div>
           </div>";
           if($eot->num_rows > 0){
           echo "<div class='s_fflw1b'><i class=''>followed by <i class='fas fa-at'></i><span class='s_norm1al'>".$geot['user']."</span></i></div>";
           }
           /*elseif($dsm['institution'] == $gfsg['institution']){
             $xatt = '';
             $att = '';
             if($dsm['status'] == 1){
               $xat = ' aspirant';
             }
             elseif ($dsm['status'] == 2){
               $att = 'attending ';
             }
             else {
               $att = 'attended ';
             }
             echo "<div class='s_fflw1b'><i class=''>$att
             <span class='s_knorm21l'>".$gfsg['institution']."$xat</span></i></div>";
           }*/
           echo "</div></a><div class='o_m_d s_trbt1s'>
           <div class='s_bt1rss h_f_taag'>
           <input type='hidden' value='".$gfsg['user']."'>
           <i class='fas fa-rss'></i>Follow</div>
           </div>
           </div>
           </div></div>";
           $occr .= " AND user != '".$gfsg['user']."'";
      }
    }
      echo "<div class='s_mm_re'>See More</div>";
      echo "</div></div>";
       }
      }
     }
     /*if($e ==  $discoveradspace[0]){
         $oea = substr($oea, 3, strlen($oea));
         $dm = queryMysql("SELECT * FROM discoverfollowers WHERE user='$user'");
         if($dm->num_rows){
           $ooel = '';
         while($dsm = mysqli_fetch_array($dm)){
           $did = $dsm['discoverid'];
           $eex = queryMysql("SELECT * FROM discover WHERE id='$did'");
           while($mex = mysqli_fetch_array($eex)){
             if(strpos($ooel, $mex['relatedto']) == false){
             $ooel .= "OR relatedto LIKE '%".$mex['relatedto']."%'";
           }
         }
         }
         }
         else {
           $ooel = '';
         }
         $d = queryMysql("SELECT * FROM discover WHERE $oea $ooel ORDER BY RAND()");
         if($d->num_rows==0){
             $d = queryMysql("SELECT * FROM discover ORDER BY RAND()");
         }
         echo "<div class='disc_o_vr_spa'>
         <div class='discoveR_rr'>Discover <i class='fas fa-globe s_e12wor' style='float: right;'></i></div>
         <div class='s_abab2y'>";
         while ($ged = mysqli_fetch_array($d)) {
           $mid = $ged['id'];
           $llx = queryMysql("SELECT * FROM discoverfollowers WHERE discoverid='$mid' AND user='$user'");
           if($llx->num_rows == 0){
           $dname = strlen($ged['discovername']) > 30 ? substr($ged['discovername'], 0, 30).'&hellip;
           ' : $ged['discovername'];
           $dabt = strlen($ged['discoverabout']) > 40 ? substr($ged['discoverabout'], 0, 40).'&hellip;
           ' : $ged['discoverabout'];
           $td = getcwd();
           chdir("../../students_connect_hidden/discover_profile/");
           if(file_exists($ged['id'].".png")){ 
              $dpimg =  '/students_connect_hidden/discover_profile/'.$ged['id'].'.png';  
           }
           else {
              chdir($td);
               $dpimg =  '/students_connect/user.png';
            }
           chdir($td);
           $nov = $ged['numberoffollowers'];
                     if($nov == 0){
                       $nofv = "0";
                     }
                     elseif($nov == 1){
                       $nofv = '1';
                     }
                     elseif($nov > 1 && $nov < 1000){
                       $nofv = $nov;
                     }
                     elseif($nov >= 1000 && $nov < 10000){
                       $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."k";
                     }
                     elseif($nov >= 10000 && $nov < 100000){
                       $nofv = substr($nov, 0, 2).".".substr($nov, 2, 1)."k";
                     }
                     elseif($nov >= 100000 && $nov < 1000000){
                       $nofv = substr($nov, 0, 3).".".substr($nov, 3, 1)."k";
                     }
                     elseif($nov >= 1000000 && $nov < 99999999){
                       $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."M";
                     }
           echo "<div class='s_cov11er' style='background-image:url(\"$dpimg\")'>
           <div class='s_ins09x'>
           <div class='s_img101x' style='background-image:url(\"$dpimg\")'></div>
           <div class='s_i1prop'>
           <div class='s_ea71sc'>".$dname."</div>
           <div class='s_ea72sc'>".$dabt."</div>
           </div>
           <div class='s_trbt1s'>
           <div class='s_bt1rss s_allgnr'>
           <span class='s_noo1xf'>".$nofv."</span><i class='fas fa-rss'></i> follow</div>
           <div class='s_bt1can s_allgnr'>
           <i class='fas fa-times'></i>
           </div>
           </div>
           </div>
           </div>";
           }
         }
         echo "</div>
         </div>";     
     }
     if($forumadspace[0] == $e){
       $frre = substr($frre, 3, strlen($frre));
       $eif = queryMysql("SELECT * FROM forummembers WHERE (user IN ($nwin) AND user != '$user')
                         OR (user = '$user' AND isacknoledged = '2')");
       $fla = '';
       while($oeif = mysqli_fetch_array($eif)){
         $fla.= "OR id = '".$oeif['forumid']."'";
       }
       $if = queryMysql("SELECT * FROM forums WHERE typeofforum != '1' AND $frre $fla");
       echo "<div class='disc_o_vr_spa'>
         <div class='discoveR_rr'>Suggested Forums <i class='fas fa-users s_e12wor' style='float: right;'></i></div>
         <div class='s_abab2y'>";
       if($if->num_rows == 0){
         $if = queryMysql("SELECT * FROM forums WHERE typeofforum != '1' ORDER BY RAND()");
       }
       while($gif = mysqli_fetch_array($if)){
         $feid = $gif['id'];
           $llx = queryMysql("SELECT * FROM forummembers WHERE forumid='$feid' AND user='$user'");
           if($llx->num_rows == 0){
           $dname = strlen($gif['nameofforum']) > 30 ? substr($gif['nameofforum'], 0, 30).'&hellip;
           ' : $gif['nameofforum'];
           $dabt = strlen($gif['about']) > 40 ? substr($gif['about'], 0, 40).'&hellip;
           ' : $gif['about'];
           $td = getcwd();
           chdir("../../students_connect_hidden/forum_profile_upload/");
           if(file_exists($gif['id'].".png")){ 
              $dpimg =  '/students_connect_hidden/forum_profile_upload/'.$gif['id'].'.png';  
           }
           else {
              chdir($td);
               $dpimg =  '/students_connect/user.png';
            }
           chdir($td);
           $nov = $gif['numberofmembers'];
                     if($nov == 0){
                       $nofv = "0";
                     }
                     elseif($nov == 1){
                       $nofv = '1';
                     }
                     elseif($nov > 1 && $nov < 1000){
                       $nofv = $nov;
                     }
                     elseif($nov > 1000 && $nov < 10000){
                       $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."k";
                     }
                     elseif($nov > 10000 && $nov < 100000){
                       $nofv = substr($nov, 0, 2).".".substr($nov, 2, 1)."k";
                     }
                     elseif($nov > 100000 && $nov < 1000000){
                       $nofv = substr($nov, 0, 3).".".substr($nov, 3, 1)."k";
                     }
                     elseif($nov > 1000000 && $nov < 99999999){
                       $nofv = substr($nov, 0, 1).".".substr($nov, 1, 2)."M";
                     }
           echo "<div class='s_cov11er' style='background-image:url(\"$dpimg\")'>
           <div class='s_ins09x'>
           <div class='s_img101x' style='background-image:url(\"$dpimg\")'></div>
           <div class='s_i1prop'>
           <div class='s_ea71sc'>".$dname."</div>
           <div class='s_ea72sc'>".$dabt."</div>
           </div>
           <div class='s_trbt1s'>
           <div class='s_bt1rss s_allgnr'>
           <span class='s_noo1xf'>".$nofv."</span><i class='fas fa-plus'></i> Join</div>
           <div class='s_bt1can s_allgnr'>
           <i class='fas fa-times'></i>
           </div>
           </div>
           </div>
           </div>";
         }
       }
       echo "</div></div>";
     }
     for($x = 0; $x < count($forumspace); $x ++){
       if($forumspace[$x] == $e){
         $mml = queryMysql("SELECT * FROM forummembers WHERE user='$user'");
         if($mml->num_rows > 0){
         $fss = '';
         if(!isset($alreadyoccured)){
         $alreadyoccured = "id != ''";
         }
         while($gnml = mysqli_fetch_array($mml)){
           $fss.=" OR forumid='".$gnml['forumid']."'";
         }
         $fss = substr($fss, 3, strlen($fss));
         $me = queryMysql("SELECT * FROM forumposts WHERE ($fss) AND ($alreadyoccured) ORDER BY RAND()");
         if($me->num_rows){
         $fme = mysqli_fetch_array($me);
         $moe = mysqli_fetch_array(queryMysql("SELECT * FROM forums WHERE id='".$fme['forumid']."'"));
         $alreadyoccured.= " AND id != '".$fme['id']."'";
       $pusr = $fme['user'];
       $tui = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$pusr'")); 
       $ttime = $fme['dateofpost'];
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
             $xet = "";
                     $xot = "<div class='tb_y cotx'>
                     <input type='hidden' value='0'>
                     <input type='hidden' value='".$fme['id']."'>
                     <input type='hidden' value='".$user."'>
                     Open Comments</div>";
                     $xzt = "<div class='tb_y repop'>Report Post</div>";
                     $xyt = "<div class='tb_y blusr'>Block User</div>";
                     if($fme['user'] == $user){
                       $xet = "<div class='tb_y'>Delete Post</div>";
                       $xyt = '';
                       $xzt = '';
                     }
       echo '<div class="camp macamps">      
       <div class="amps" id="f'.$fme['id'].'">
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
                   chdir("../../students_connect_hidden/users_profile_upload/".$fme['user'].'/');
                   if(file_exists($fme['user'].".png")){ 
                     $img =  '/students_connect_hidden/users_profile_upload/'.$fme['user'].'/'.$fme['user'].'.png';  
                   }
                     else {
                       chdir($td);
                         $img =  '/students_connect/user.png';
                     }
                     chdir($td);
                     echo "<div class='pstname' style='display: flex;'><a href='/students_connect/user/".$fme['user']."'>
                     <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                     <div class='name'>".$tui['surname']." ".$tui['firstname']."</a> <span class='f_n_am_ee'>
                     <a href='/students_connect/f/".$moe['id']."'>(".$moe['nameofforum'].")</a></span></div></div>
             </div>";
             echo '<div class="mpst" id="mpst'.$fme['id'].'">';
                     $pstcut = strlen($fme['contentofpost']) > 250 ? substr($fme['contentofpost'], 0, 250).'&hellip;
                     <div class="readmore" onclick="rdmore(\''.$fme['id'].'\')" id="readmr" style="font-size:12px;">Read More</div>' : $fme['contentofpost'];
                     $pstcut = str_replace("search=\r\n", "", $pstcut);            
                     echo nl2br($pstcut).'</div>';
                     $tpeid = $fme['id'];
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
                         <input type='hidden' value='".$fme['id']."'>
                         <input type='hidden' value='0'>
                         <span id='ls1'>".$vct."</span>
                         </button>
                         </div>
                         <div class='tfsect mopts'>
                         <button class='lastpl p-2' id='p_2' $buttons value='2' $sbg>"
                         .$fto."".$gpo['opt2']."<input type='hidden' id='cli2' value='".$gpo['o2clicks']."'/>
                         <input type='hidden' id='usr2' value='".$row['user']."'>
                         <input type='hidden' value='".$fme['id']."'>
                         <input type='hidden' value='0'>
                         <span id='ls2'>".$uct."</span>
                         </button>
                         </div>
                         <div class='tthrpt mopts'>
                         <button class='lastpl p-3' id='p_3' $buttons value='3' $fbg>"
                         .$ftho."".$gpo['opt3']."
                         <input type='hidden' id='cli3' value='".$gpo['o3clicks']."'/>
                         <input type='hidden' id='usr3' value='".$row['user']."'>
                         <input type='hidden' value='".$fme['id']."'>
                         <input type='hidden' value='0'>
                         <span id='ls3'>".$xct."</span>
                         </button>
                         </div>
                         <div class='tforpt mopts'>
                         <button class='lastpl p-4' id='p_4' $buttons value='4' $obg>"
                         .$ffour."".$gpo['opt4']."
                         <input type='hidden' id='cli4' value='".$gpo['o2clicks']."'>
                         <input type='hidden' id='usr4' value='".$row['user']."'>
                         <input type='hidden' value='".$fme['id']."'>
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
                           if(file_exists($fme['id']."(".$i.").png")){
                             $files[$i] = "/Students_connect_hidden/postuploads/f/".$fme['id']."(".$i.").png";
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
                         if(file_exists($fme['id']."(".$i.").png")){  
                           echo "
                           <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/f/".$fme['id']."(".$i.").png'></div>";
                     }
                         else {
                           echo "";                     }
                         }
                       echo '</div></div>';
                       echo '<div class="allimgposted"><div class="aimg">';
                       if(file_exists($fme['id']."(0).mp4")){
                         echo "
                         <div class='postvideos'><video controls class='pvideo' width='200' height = '100'>
                         <source src='/students_connect_hidden/postuploads/f/".$fme['id']."(0).mp4' type='video/mp4'>
                         </video></div>
                         ";                      
                     }
                     echo "</div></div>";
                     echo '<div class="allimgposted"><div class="aimg">';
                       if(file_exists($fme['id']."(0).mp3")){
                         echo "
                         <div class='postaudio'>
                         
                         <audio controls class='paudio'>
                         <source src='/students_connect_hidden/postuploads/f/".$fme['id']."(0).mp3' type='video/mp4'>
                         </video></div>
                         ";                      
                     }
                     chdir($td);
                     echo '</div></div>
                     <div class="posted">'.$ftime.'</div>';
                     echo '
                     <div class="pwl"> ';
                     $nc = mysqli_fetch_array(queryMysql("SELECT * FROM forumpostviews WHERE id='".$fme['id']."'"));
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
                     $cmmnt = $fme['tncomments'];
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
                     $fl = $fme['tnuvotes'];
                     if($fl == 1){
                       $other  = 'other';
                       global $other;
                     }
                     else {
                       $other = 'others';
                       global $other;
                     } 
                     $rwvot = $fme['tnuvotes'];
                     if($rwvot == 0){
                       $tvoc = "No reaction";
                     }
                     if($rwvot == 1){
                       /*echo '
                       <button type="submit" id="lbn">
                       <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reaction</button>';

                     $tvoc = "1 reaction";
                     }
                     elseif($rwvot > 1){
                       /*echo '
                       <button type="submit" id="lbn">
                       <i class="fas fa-caret-up" style="color: green"></i>'.$fl.' reactions</button>';

                     $tvoc = $fl." reactions";
                     }
                     $pid = $fme['id'];
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
                   <br><div class="undbtn"><div class="upv cmn dwn" id="fupv'.$fme['id'].'" 
                    onclick="fupvote(\''.$user.'\', \''.$fme['id'].'\', \''.$fme['forumid'].'\')"><span id="titg'.$fme['id'].'"
                    style="'.$mcolor.'"><i class="fas fa-caret-up"></i></span><div class="cnt cmn" id="fcntl'.$fme['id'].'"
                    style="color: inherit !important;">'.$fme['tnuvotes'].'</div>
                   </div><div class="lwv cmn dwn" style="'.$scolor.'" id="fdwn'.$fme['id'].'" onclick="fdownvote(\''.$user.'\', \''.$fme['id'].'\', \''.$fme['forumid'].'\')"><span ><i class="fas fa-caret-down ycd" style="vertical-align: sub"></i></span></div>
                   <div class="cmt cmn dwn" id="fcommt">
                   <input type="hidden" value="'.$fme['id'].'">
                   <input type="hidden" value="'.$fme['forumid'].'">
                   <button type="button" class="sbm">
                   <span><i class="far fa-comment dwtuc"></i></span>
                   <div class="cnt cmn" id="fcntc'.$fme['id'].'">'.$fme['tncomments'].'</div></button></div>
                   </div>';
                   $fooc = queryMysql("SELECT * FROM forumscomment WHERE pid='".$fme['id']."' AND fid='".$fme['forumid']."' ORDER BY timeofcomment, tnc DESC");
                     if($fooc->num_rows){
                   $gfooc = mysqli_fetch_array($fooc);
                     $mee = mysqli_fetch_arraY(queryMysql("SELECT * FROM members WHERE user='".$gfooc['user']."'"));
                     $ttime = $gfooc['timeofcomment'];
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
                     $td = getcwd();
                   chdir("../../students_connect_hidden/users_profile_upload/".$mee['user'].'/');
                   if(file_exists($mee['user'].".png")){ 
                     $fnimg =  '/students_connect_hidden/users_profile_upload/'.$mee['user'].'/'.$mee['user'].'.png';  
                   }
                     else {
                       chdir($td);
                         $fnimg =  '/students_connect/user.png';
                     }
                     chdir($td);
                     echo "<div class='v_al_l'>
                     <div class='id_knw'>
                     <div class='t_fc_na_mq'>
                     <div class='devi_sjonimg' style='background-image: url(\"$fnimg\");'></div>
                     <div class='devi_sjon'>
                     <div class='tm_fc_nam'>
                     ".$mee['surname']." ".$mee['firstname']."</div>
                     <div class='tm_fc_unam'><i class='fas fa-at'></i>".$mee['user']."
                     </div>
                     </div>
                     </div>
                     <div class='pe_qq'>
                     ".$gfooc['cmt']."</div>
                     <div class='tm_fcc_bott'>".$ftime."</div>
                     <div class='all_ccee'>
                     <div class='aaaaa'><i class='fas fa-caret-up'></i></div>
                     <div class='aaaaa'><i class='fas fa-caret-down'></i></div>
                     <div class='aaaaa'><span class=''>Report</span></div>
                     </div>";
                     if($fooc->num_rows > 1){
                     echo "<div class='vw_ff_more'>View all</div>";
                     }
                     echo "</div>
                     </div>";
                   }
                   echo "</div></div>";
                 }
                 }
               }
     }*/
     
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
             $my = queryMysql("SELECT * FROM followstatus WHERE user='$user'");
                $ok = [];
                while($m = mysqli_fetch_array($my)){
                  array_push($ok, $m['friend']);
                }
                if((!in_array($medu['user'], $ok)) && (!in_array($medu['sharedby'], $ok)) && ($medu['user'] != $row['user']) && ($medu['sharedby'] != $row['user'])){
            echo "<div class='r_rcor'><span class='r_quip'>Recommended</span> <span class='r_notint'><button class='rnotint_b' value='".$medu['id'].", ".$medu['pstst']."'>Not Interested</button></span></div>";
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
             $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
                 if($medu['isshare'] == 0){
                 echo <<<PSTS
                     <div class='camp macamps'>
                     PSTS;
                     if($medu['pinterest'] != '0' || !empty($medu['pinterest']) || $medu['pinterest'] == NULL){
                       echo "<div class='phonetags' style='display: flex;'>";
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
                     echo "<div class='ptags' style='float: right; display: flex;'>
                     ";
                     $tg = explode(",",$medu['pinterest']);
                     sort($tg);
                     if(count($tg) <=4){
                     for($i = 0; $i < count($tg); $i++){
                     echo "
                     <div class='ttags' style='padding: 5px; margin-right:6px;'>
                     <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                     }
                   }
                   else {
                     for($i = 0; $i < 4; $i++){
                       echo "
                       <div class='ttags' style='padding: 5px; margin-right:6px;'>
                       <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a></div>";
                       }
                       echo "<div class='ttags' id='zymbxs' style='padding: 5px; margin-right:6px;' onclick='dispOths()'>...</div>";
                   }
                   for($i = 4; $i < count($tg); $i++){
                     echo "<div class='ttags own' 
                     id='moretags' style='display: none; padding: 5px; margin-right:6px;'>
                     <a  href='/students_connect/tag?search=t\\".$tg[$i]."'>".$tg[$i]."</a>
                     </div>";
                 }
                 
                 echo "</div>";
               }
                   $td = getcwd();
                   chdir("../../students_connect_hidden/users_profile_upload/".$medu['user'].'/');
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
                     echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                     <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                     <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['id'].'">';
                     $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['id'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                     $tpeid = $medu['id'];
                     $etime = time();
                     $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='0'");
                       if($polc->num_rows){
                         $gpo = mysqli_fetch_array($polc);
                         $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='0'");
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
                               $x1v = $x2v = $x3v = $x4v = '0'; 
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
                     chdir("../../students_connect_hidden/postuploads/");
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
                       chdir("../../students_connect_hidden/postuploads/");
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
                     
                     echo <<<PSTS
                     <div class='camp macamps'>
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
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                   if(file_exists($mbss['user'].".png")){ 
                     $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                     chdir($td);  
                   }
                     else {
                       chdir($td);
                         $img =  '/students_connect/user.png';
                     }
                     chdir($td);
                     echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
                     <div class='imgfpstr' style='background-image: url(\"$img\");'></div>
                     <div class='name'>".$mbss['surname']." ".$mbss['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbss['user']."</div></a></div></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['id'].'" style="min-height: 30px;">';
                     $content = strip_tags($medu['sharedpstcont']);
                  $pstcute = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr'.$medu['id'].'"><input type="hidden" value="0"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcute = rhash($pstcute);
                  echo nl2br($pstcute).'</div>';
                     $td = getcwd();
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
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
                     <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
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
                     chdir("../../students_connect_hidden/postuploads/");
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
                       chdir("../../students_connect_hidden/postuploads/");
                     for($i = 0; $i < 2; $i++){ 
                       if(file_exists($medu['sharedpostid']."(".$i.").png")){  
                         echo "
                         <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/".$medu['sharedid']."(".$i.").png\")'></div>
                         <div class='postimages'><img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/".$medu['sharedpostid']."(".$i.").png'></div>";
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
                     elseif($cmmnt >= 1 && $cmmnt < 1000){
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
                     style="'.$mcolor.'" onclick="upvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span><i class="fas fa-caret-up"></i></span><div class="cnt cmn cntfl" id="cntl'.$medu['id'].'"
                      style="color: inherit !important;">'.red($medu['tun']).'</div>
                     </div><div class="lwv cmn dwn" style="'.$scolor.'" id="dwn'.$medu['id'].'" onclick="downvote(\''.$row['user'].'\', \''.$medu['id'].'\')"><span style="vertical-align: sub"><i class="fas fa-caret-down ycd"></i></span></div>
                     <div class="cmt cmn dwn" id="commt" onclick="c(\''.$medu['id'].'\', \''.$row['user'].'\')">
                     <button type="button" class="sbm">
                     <span><i class="far fa-comment dwtwc"></i></span>
                     <div class="cnt cmn xod xess" id="cntc'.$medu['id'].'">'.red($medu['pnc']).'</div></button></div>
                     <div class="shr cmn dwn" style="padding: 10px;">
                     <span id="sh'.$medu['id'].'"><i class="fas fa-share"></i></span></div>
                     <div id="oe'.$medu['id'].'" class="oe" style="display: none;"><span class="close'.$medu['id'].' closex"><i class="fas fa-arrow-left"></i></span>
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
                     <div class="rcntt">
                     <input type="checkbox" class="selectall'.$medu['id'].'" onclick="sall(\''.$medu['id'].'\')">Select All<div class="recently">Recently Messaged</div>';
                     $mffs = queryMysql("SELECT * FROM messagesbase WHERE fone='$user' OR ftwo='$user' order by lasttimeofmessage desc limit 5");
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
                     $mfss = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND type='following'");
                     if($mfss->num_rows==0){
                       echo 'No recently messaged user';
                     }
                     else {
                       while($gmfss = mysqli_fetch_assoc($mfss)){
                         echo "<div class='selectefformessage'><input type='checkbox' class='arsltd".$medu['id']."' value='".$gmfss["friend"]."' onchange='gin(\"".$medu['id']."\")'>".$gmfss['friend']."</div>";
                       }
                     }
                     echo'</div></div><div id="countsend'.$medu['id'].'">
                     </div><button onclick="sendShare(\''.$row['user'].'\', \''.$medu['pstst'].'\', \''.$medu['id'].'\')">Send</buton>
                     </div>
                     </div>
                     </div></div>
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
                        chdir("../../Students_connect_hidden/users_profile_upload/".$geteducomment['user'].'/');
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
                 else {
                   $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
           $id = $medu['id'];
           $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
           $chlov = mysqli_fetch_array($lov);
           $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
           $chdwn = mysqli_fetch_array($dwnp);
           $rwlov = (int) mysqli_num_rows($lov); 
           $fl = $rwlov - 1;
           $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
           $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
            AND loved='liked' AND id='".$medu['id']."'");
            $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
            AND loved='disliked' AND id='".$medu['id']."'");
          $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
          if($medu['isshare'] == 0){
         echo <<<PSTS
         <div class='camp macamps'>
         <div class='amps' id='soc
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
              <div class='esign' style='float: right; cursor: pointer;'>
                     <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                     <div id="myDropdown$id" class="std_yx">
                     $xot
                     $xyt
                     $xzt
                     $xet
                     <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                     <div class='yxclose'>Close</div>
                     </div></div>
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
         Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
         $pstcut = rhash($pstcut);
         echo nl2br($pstcut).'</div>';
                   $tpeid = $medu['id'];
                   $etime = time();
                   $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                     if($polc->num_rows){
                       $gpo = mysqli_fetch_array($polc);
                       $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='1'");
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
                     chdir("../../students_connect_hidden/postuploads/s/");
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
                       chdir("../../students_connect_hidden/postuploads/s/");
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
                   <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                 }
                 else {
                   
                     echo <<<PSTS
                     <div class='camp macamps'>
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
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                   if(file_exists($mbss['user'].".png")){ 
                     $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                     chdir($td);  
                   }
                     else {
                       chdir($td);
                         $img =  '/students_connect/user.png';
                     }
                     chdir($td);
                     echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
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
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
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
                     <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
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
                     chdir("../../students_connect_hidden/postuploads/s");
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
                       chdir("../../students_connect_hidden/postuploads/s");
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
                   if($chlov['user'] == $user){
                     $chlov['user'] = 'You';
                     if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                   }
                 }
                 else {
                   if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
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
                     <input type="hidden" value="1">
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
                        </div><div></div></div></div>
                   </div>
                   ';
                   if(mysqli_num_rows($soccomment) == 0){  
                     //leave space blank
                     echo "<div class='comment_section' id='cmt_sec".$medu['id']."'></div>";
                   }
                   else {
                     $aus = $getsoccomment['user'];
                     $dpa = mysqli_fetch_array(queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$getsoccomment['id']."'"));
                        $pa = queryMysql("SELECT * FROM commentloves WHERE user='".$row['user']."'
                        AND postid='".$medu['id']."'
                        AND commentid='".$getsoccomment['id']."'");
                        if($pa->num_rows){
                         $clrr = 'color: rgb(255, 136, 156)';
                        }
                        else {
                          $clrr = '';
                        }
                        $gd = getcwd();
                        $gd = getcwd();
                        chdir("../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
                        if(file_exists($getsoccomment['user'].".png")){ 
                         $pimg =  '/students_connect_hidden/users_profile_upload/'.$getsoccomment['user'].'/'.$getsoccomment['user'].'.png';
                         chdir($gd);  
                       }
                         else {
                             $pimg =  '/students_connect/user.png';
                             chdir($gd);
                           }
                           chdir($gd);
                           $upc = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$aus'"));
                     
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
     $e++;
                 }
                }
               }
               elseif($dsm['status'] == 3) {
                if($myf->num_rows){
                  $sltm = queryMysql("SELECT * FROM socposts WHERE (user IN ($win) OR sharedby IN ($win)$nstr $ssurelyoccured) 
                                   OR pstcont LIKE '%@".$row['user']."%' AND timeofupdate BETWEEN $lthidays AND $ptime
                                    ORDER BY  
                                    rand() DESC limit 10");
                        if($sltm->num_rows == 0){
                          $sltm = queryMysql("SELECT * FROM socposts WHERE (id != '' $ssurelyoccured)
                          AND timeofupdate BETWEEN $lthidays AND $ptime
                           ORDER BY RAND() LIMIT 10");
                            if($sltm->num_rows==0){
                              
                            } 
                        }
                  }
                  else {
                    $sltm = queryMysql("SELECT * FROM socposts WHERE (id !='' $ssurelyoccured)
                    AND timeofupdate BETWEEN $lthidays AND $ptime ORDER BY RAND() LIMIT 10");
                  }
                  $e = 0;
               while(($medu = mysqli_fetch_array($sltm)) && $e < count($medu)){      
             $ttr = queryMysql("SELECT * FROM blocked WHERE (user='$user' AND touser='".$medu['user']."') OR (user='".$medu['user']."' 
             AND touser='".$user."') OR (user='$user' AND touser='".$medu['sharedby']."') OR 
             (user='".$medu['sharedby']."' AND touser='".$user."')");
  if($ttr->num_rows==0){
                $studco_ad_images = array("/students_connect_hidden/ads/mesimg1.png", "/students_connect_hidden/ads/mesimg2.png", "/students_connect/ico/StudCo.png");
                for($x = 0; $x < count($adsspace); $x++){
                  $qguess = queryMysql("SELECT * FROM ads WHERE expired='0' AND  (sptags != '' $adq) ORDER BY RAND()");
                  if($adsspace[$x] == $e && $qguess->num_rows){
                    $qg = mysqli_fetch_array($qguess);
                    $ent = $qg['entity'];
                    if($qg['adtype'] == '1'){
                      $qgu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$ent."'"));
                      if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png")){
                        $umld = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/".$qgu['user'].".png";
                      }
                      else {
                        $umld = '/students_connect/user.png';
                      }
                      if(file_exists("../../students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png")){
                        $ucov = "/students_connect_hidden/users_profile_upload/".$qgu['user']."/cover/cover.png";
                        $ywi = "<img src='".$ucov."' class='wilfad_cv_img'/>";
                      }
                      else {
                        $ywi = '';
                        $ucov = '';
                      }
                      echo "<div class='wilfad_sp'>
                      <div class='wilfad_spfus'>
                      <div class='wilfad_cont'>
                      <div class='wilfad_mg'>
                      <div class='wilfad_yaj'>
                      <div class='wilfad_cv' style='background-image: url(\"".$ucov."\")'></div>
                      ".$ywi."
                      </div>
                      <div class='wilfad_gam'>
                      <div class='wilfad_dp' style='background-image: url(\"".$umld."\");'></div>
                      <img src='".$umld."' class='wilfad_dp_img'/>
                      </div></div>
                      <div class='wilfad_info'>
                      <div class='wilfad_name'>
                      <a href='/students_connect/user/".$qgu['user']."'>
                      <div class='wilfad_fname'>".$qgu['firstname']." ".$qgu['surname']."</div>
                      <div class='wilfad_uname'><i class='fas fa-at'>".$qgu['user']."</i></div>
                      </a></div>
                      <div class='wilfad_abt'>".$qgu['about']."</div>
                      </div>
                      <div class='wilfad_btns'><button class=''>Follow</button></div>
                      </div>
                      </div>
                      <div class='t_ad_tag'>Ad by StudCo</div>
                      </div>";
                    }
                    elseif($qg['adtype'] == '2'){
                      if($qg['ispostid'] == '0'){
                        $mj = 'eduposts';
                      }
                      elseif($qg['ispostid'] == '1'){
                        $mj = 'socposts';
                      }
                      $gm = queryMysql("SELECT * FROM $mj WHERE id='".$qg['extracontent']."'");
                      if($gm->num_rows){
                        $agm = mysqli_fetch_array($gm);
                        echo "<div class='wilfad_sp'>
                        <div class='wilfad_spfus'>
                        <div class='wilfad_cont'>
                        
                        </div>
                        <div class='t_ad_tag'>Ad by StudCo</div>
                        </div></div>";
                      }
                      elseif($gm['adtype'] == '3'){
                        //is special
                        echo "<div class='wilfad_sp'>
                        <div class='wilfad_spfus'>
                        <div class='wilfad_cont'>
                        
                        </div>
                        <div class='t_ad_tag'>Ad by StudCo</div>
                        </div></div>";
                      }
                    }
              
                    /*$tu = array_rand($studco_ad_images, 1);
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
                    </div>";*/
                  }
                }
  for($x = 0; $x < count($suggestedspace); $x++){
    if($suggestedspace[$x] == $e){
      $ts = '';
      $rs = '';
      for($r = 0; $r < count($agg); $r++){
        for($x = 0; $x < 1; $x++){
          /*echo $agg[$r][$x].'=>'.$agg[$r][$x+1]*/
          $ts.=" OR user = '".$agg[$r][$x]."'";;
        }
      }
      for($i = 0; $i < count($mow); $i++){
        $q = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend=".$mow[$i]."");
        if(($mow[$i] != "'".$row['user']."'")&&($q->num_rows == 0)){
        $ts.=" OR user = ".$mow[$i]."";
      }
    }
      $rs = substr($rs, 3, strlen($rs));
      $nts = substr($ts ,3, strlen($ts));
      if($nts == ''){
        $nts = "user != ''";
      }
      if(!isset($occr)){
        $occr ="user != ''";
        }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      $lry = [];
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
            array_push($lry, $gfsg['user']);
        }
      }
      $fsg = queryMysql("SELECT * FROM members WHERE $nts AND $occr AND user!='".$row['user']."' ORDER BY RAND() LIMIT 5");
      if((mysqli_num_rows($fsg) > 0) && (count($lry) > 0)){
      echo "<div class='wh_cant'>
      <div class='s_fo_you'>Suggested for you</div>
      <div class='th_li_st'>";
      while($gfsg = mysqli_fetch_array($fsg)){
        $ll = $gfsg['user'];
        $loo = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='$ll'");
        if($loo->num_rows == 0){
        $td = getcwd();
      chdir("../../students_connect_hidden/users_profile_upload/".$gfsg['user'].'/');
      if(file_exists($gfsg['user'].".png")){ 
        $cimg =  '/students_connect_hidden/users_profile_upload/'.$gfsg['user'].'/'.$gfsg['user'].'.png';  
      }
        else {
          chdir($td);
            $cimg =  '/students_connect/user.png';
        }
        if(file_exists('cover/cover.png')){
          $odma = "<div class='atbck' style=\"background-image: url('/students_connect_hidden/users_profile_upload/".$gfsg['user']."/cover/cover.png')\"></div>";
        }
        else {
          $odma = "<div class='atbck' style='background: brown;'></div>";
        }
        chdir($td);
        $eot = queryMysql("SELECT * FROM followstatus WHERE user IN ($nwin) AND friend='".$gfsg['user']."' ORDER BY RAND()");
        $nae = mysqli_num_rows($eot)-1;
        $geot = mysqli_fetch_array($eot);
        echo "
           <div class='on_u_a_Tm'>
           <div class='p_l_atf'>
           <a  href='/students_connect/user/".$gfsg['user']."'>
           ".$odma."
           <div class='cna_aam'>
           <div class='na_aam' style='background-image:url(\"".$cimg."\")' title='".$gfsg['user']." suggested' width='96' height='96'></div>
           <div class='t_fna_m'>
           <div class='p_e_pep'>
           <div class='_m'>
           ".$gfsg['surname']." ".$gfsg['firstname']."
           </div>
           <div class='th_un_m'><i class='fas fa-at'></i>".$gfsg['user']."</div>
           </div>";
           if($eot->num_rows > 0){
           echo "<div class='s_fflw1b'><i class=''>followed by <i class='fas fa-at'></i><span class='s_norm1al'>".$geot['user']."</span></i></div>";
           }
           /*elseif($dsm['institution'] == $gfsg['institution']){
             $xatt = '';
             $att = '';
             if($dsm['status'] == 1){
               $xat = ' aspirant';
             }
             elseif ($dsm['status'] == 2){
               $att = 'attending ';
             }
             else {
               $att = 'attended ';
             }
             echo "<div class='s_fflw1b'><i class=''>$att
             <span class='s_knorm21l'>".$gfsg['institution']."$xat</span></i></div>";
           }*/
           echo "</div></a><div class='o_m_d s_trbt1s'>
           <div class='s_bt1rss h_f_taag'>
           <input type='hidden' value='".$gfsg['user']."'>
           <i class='fas fa-rss'></i>Follow</div>
           </div>
           </div>
           </div></div>";
           $occr .= " AND user != '".$gfsg['user']."'";
      }
    }
      echo "<div class='s_mm_re'>See More</div>";
      echo "</div></div>";
  }
    }
  }
                $ssurelyoccured.=" AND id != '".$medu['id']."'"; 
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
                 $n = mysqli_num_rows(queryMysql("SELECT pstcont FROM socposts WHERE user='$user'"));
           $id = $medu['id'];
           $lov = queryMysql("SELECT * FROM loves WHERE id='$id' ORDER BY timeoflike DESC");
           $chlov = mysqli_fetch_array($lov);
           $dwnp = queryMysql("SELECT * FROM loves WHERE id='$id' AND loved='dislike'");
           $chdwn = mysqli_fetch_array($dwnp);
           $rwlov = (int) mysqli_num_rows($lov); 
           $fl = $rwlov - 1;
           $soccomment = queryMysql("SELECT * FROM soccomments WHERE postid='$id' ORDER BY timeofcomment, tnc OR tln DESC LIMIT 1");  
           $lvd = queryMysql("SELECT * FROM loves WHERE user='$user'
            AND loved='liked' AND id='".$medu['id']."'");
            $dlkd = queryMysql("SELECT * FROM loves WHERE user='$user'
            AND loved='disliked' AND id='".$medu['id']."'");
          $mbse = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$medu['user']."'"));
          if($medu['isshare'] == 0){
         echo <<<PSTS
         <div class='camp macamps'>
         <div class='amps' id='soc
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
              <div class='esign' style='float: right; cursor: pointer;'>
                     <div class='tesmby'><i class='fas fa-ellipsis-v vert'></i></div>
                     <div id="myDropdown$id" class="std_yx">
                     $xot
                     $xyt
                     $xzt
                     $xet
                     <div class='tb_y xia_o'><i class='fas fa-bookmark'></i></div>
                     <div class='yxclose'>Close</div>
                     </div></div>
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
         Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
         $pstcut = rhash($pstcut);
         echo nl2br($pstcut).'</div>';
                   $tpeid = $medu['id'];
                   $etime = time();
                   $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND timetoend > '$etime' AND pstst='1'");
                     if($polc->num_rows){
                       $gpo = mysqli_fetch_array($polc);
                       $clc = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$tpeid' AND pstst='1'");
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
                     chdir("../../students_connect_hidden/postuploads/s/");
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
                       chdir("../../students_connect_hidden/postuploads/s/");
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
                   <div class="posted" id="posted'.$medu['id'].'">'.$ftime.'</div>';
                 }
                 else {
                     echo <<<PSTS
                     <div class='camp macamps'>
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
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbss['user'].'/');
                   if(file_exists($mbss['user'].".png")){ 
                     $img =  '/students_connect_hidden/users_profile_upload/'.$mbss['user'].'/'.$mbss['user'].'.png';
                     chdir($td);  
                   }
                     else {
                       chdir($td);
                         $img =  '/students_connect/user.png';
                     }
                     chdir($td);
                     echo "<div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbss['user']."'>
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
                     chdir("../../students_connect_hidden/users_profile_upload/".$mbse['user'].'/');
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
                     <div class='pstname' style='display: flex;'><a  href='/students_connect/user/".$mbse['user']."'>
                     <div class='imgfpstr' style='background-image: url(\"$simg\");'></div>
                     <div class='name'>".$mbse['surname']." ".$mbse['firstname']."
                     <div class='unvme'><i class='fas fa-at'></i>".$mbse['user']."</div></a></div></div>";
                     echo '<div class="mpst" id="mpst'.$medu['sharedpostid'].'">';
                     $content = strip_tags($medu['pstcont']);
                  $pstcut = strlen($content) > 250 ? substr($content, 0, 250).'&hellip;
                  <div class="readmore" id="readmr"><input type="hidden" value="1"/><input type="hidden" value="'.$medu['sharedpostid'].'">
                  Read More <i class="fas fa-angle-double-down"></i></div>' : $content;
                  $pstcut = rhash($pstcut);
                  echo nl2br($pstcut).'</div>';
                     $arr = array();
                     $td = getcwd();
                     chdir("../../students_connect_hidden/postuploads/s");
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
                       chdir("../../students_connect_hidden/postuploads/s");
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
                   if($chlov['user'] == $user){
                     $chlov['user'] = 'You';
                     if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
                   }
                 }
                 else {
                   if($rwlov == 1){
                     echo '<form action="/students_connect/posts/pst" method="get"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' reacted</button></form>';
                   }
                   elseif($rwlov > 1){
                     echo '<form action="/students_connect/posts/pst"><input type="hidden" name="spid" value="'.$medu["id"].'">
                     <input type="hidden" name="svl" value="'.$medu["id"].'">
                     <button type="submit" id="lbn">
                     <i class="fas fa-heart" style="color: rgb(255, 136, 156)"></i>'.$dwns.' '.ucfirst($chlov['user']).' & '.$fl .' '.$other.' reacted</button></form>';
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
                     <input type="hidden" value="1">
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
                        </div><div></div></div></div>
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
                         $clrr = 'color: rgb(255, 136, 156)';
                        }
                        else {
                          $clrr = '';
                        }
                        $gd = getcwd();
                        $gd = getcwd();
                        chdir("../../Students_connect_hidden/users_profile_upload/".$getsoccomment['user'].'/');
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
                   $e++;
               }
              }
             }
             $changes = enc($surelyoccured);
             $schanges = enc($ssurelyoccured);
             $rr1 = sanitizeString($_POST['r']) + 1;
             echo "
             <input type='hidden' value='$changes' id='tpe".$rr1."'/>
             <input type='hidden' value='$schanges' id='tpel".$rr1."'/>
             ";
?>