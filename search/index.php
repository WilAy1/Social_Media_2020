<?php
require_once "/Users/wilay/students_connect/header2.php";
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
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
  _END;
if(isset($_GET['search'])){
  $sr = $_GET['search'];
  $auto = "";
}
else {
  $sr = "";
  $auto = "autofocus";
}
echo <<<_END
  <div class='srch'>
  <div class='loowa'>
  <div class='srchbx'>
  <div class='srchqst'>Search <span class='q'>
  <a href='/students_connect/h/'>Quest</a></span></div>
  <div class='sbx' id='sbx'>
  <div class='shrinpt'>
  <form action=''>
  <span class='fasear'><i class='fas fa-search'></i></span>
  <input type='hidden' value='$user' id='idde'>
  <input name='search' type='text' id='evsrch' placeholder='
  Search Quest'
  autocomplete='off' value='$sr' $auto/>
  <span class='clsearch' onclick='clrs()' style='display: none;'>x</span>
  <button type='submit' class='peeoo_rr'><i class='fas fa-search'></i></button>
  </form>
  </div>
  <div class='alsatsu'>
  <div class='rfsearch' id='rfsearch'>
  </div>
  <div class='converttps'
   onclick='chpstsearch(document.getElementById("evsrch").value)'>
   </div>
  <div class='tsearches'></div></div>
  </div>
  </div></div>
  <div>
  <div class='searchresult'>
  _END;
  if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = sanitizeString($_GET['search']);
    if(strpos($search, '@') !== FALSE){
      $search = substr($search, 1);
    }
    $id = 0;
    $timosearch = time();
    queryMysql("INSERT INTO recentsearches VALUES('$id', '$user', '$search', '$timosearch')");
    $xex = $_GET['search'];
    $act = '';
    $ma = '';
    $la = '';
    if(strpos($search, "#")==0 && strpos($search, "#") !== FALSE){
      $act = 'sacti';
    }
    elseif(strpos($xex, "p") == 0 && strpos($xex, "\\") == 1){
      $la = 'sacti';
    }
    else {
      $ma = 'sacti';
    }
    echo "<div class='a_me_n'>
          <div class='s fo_pep $ma'>People</div>
          <div class='s fo_pos $la'>Posts</div>
          <div class='s fo_tag $act'>Hashtags</div>
          ";
          //<div class='s fo_dis'>Discover</div>"
          echo "</div>";
if(strpos($search, "#")==0 && strpos($search, "#") !== FALSE) {
  $hide = 'none';
  $sh = 'none';
}
else {
  $hide = 'block';
  $sh = '';
}

  echo "<div class='srrfusrs' style='display: $hide'>
    <div class='towithusers' style='text-align: center; font-size: 15px;'>Related people with '<b>".$search."</b>'</div>
    ";
    $xyz = queryMysql("SELECT * FROM members WHERE (user LIKE '%$search%' OR
     firstname LIKE '%$search%' OR surname LIKE '%$search%' OR middlename LIKE '%$search%' OR
      email LIKE '%$search%' OR pnumber LIKE '%$search%' OR CONCAT(firstname, ' ', surname) 
      LIKE '%$search%' OR CONCAT(surname,' ', firstname) 
      LIKE '%$search%')  AND user!='$user'");
    if($xyz->num_rows){
    echo "<div class='seaurlsts'>";
      while($gxyz = mysqli_fetch_array($xyz)){
      $resultuser = $gxyz['user'];
      $ex = queryMysql("SELECT * FROM members WHERE user='$resultuser'");
      while($gex = mysqli_fetch_array($ex)){
      if(file_exists('../../students_connect_hidden/users_profile_upload/'.$gex['user'].'/'.$gex['user'].'.png'))
        {
          $usimg = '../../students_connect_hidden/users_profile_upload/'.$gex['user'].'/'.$gex['user'].'.png';
        }
        else {
          $usimg = '../user.png';
        }
    echo "
    <a href='/students_connect/user/".$gex['user']."'>
    <div class='xsrchrs'>
    <div class='tseuspic' style='background-image:url(\"".$usimg."\");'></div>
    <div class='s_rm_two'>
    <div class='shwmethsrrst' style='text-align: left;'>".$gex['surname']." ".$gex['firstname']."</div>
    <div class='S_mn_urs'><i class='fas fa-at'></i>".$gex['user']."</div>
    <div class='S_ur_abt'>".substr($gex['about'],0, 70)."</div>
    </div>
    <div class='oo_la_a'><i class='fas fa-caret-right'></i></div></div>
    </a>
    ";
}
}

    }
    else {
      echo '<div class="nosugws">No user suggestion relating to '.$search."</div>";
    }
    echo "
    </div></div>
    ";
    if(strpos($search, "#")==0 && strpos($search, "#") !== FALSE) {
      $mlt = 'block';
      $ht = $search;
    }
    elseif(strpos($xex, "p") == 0 && strpos($xex, "\\") == 1){
      $mlt = 'none';
      $ht = '#'.$search;
    }
    else {
      $mlt = 'none';
      $ht = '#'.$search;
    }
      $hasht = queryMysql("SELECT * FROM eduposts WHERE pstcont LIKE '%".$ht."%'
                UNION ALL
                SELECT * FROM socposts WHERE pstcont LIKE '%".$ht."%' ORDER BY timeofupdate, pnc DESC LIMIT 15");
      echo "<div class='srrfhash' style='display: $mlt'>
      <div class='towithhash' style='text-align: center; font-size: 15px;'>'".$ht."', ".mysqli_num_rows($hasht)." Suggestions</div><div class='altsrslt'>";
      if($hasht->num_rows > 0){
      while($ghash =mysqli_fetch_array($hasht)){
        $tu = $ghash['user'];
        if(file_exists('../../students_connect_hidden/users_profile_upload/'.$tu.'/'.$tu.'.png'))
        {
          $usimg = '../../students_connect_hidden/users_profile_upload/'.$tu.'/'.$tu.'.png';
        }
        else {
          $usimg = '../user.png';
        }
        $guinf = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$tu'"));
        $posfh = strpos($ghash['pstcont'], $ht);
        echo "<div class='tpstsmt amps'>
          <div class='tpusp'>
          <div class='picotpstr' style='background-image: url(\"".$usimg."\")'></div>
          <div class='x_po_ltt'>
          <div class='psttrpstr'>".$guinf['surname']." ".$guinf['surname']."</div>
          <div class='c_x_p'><i class='fas fa-at'></i>".$guinf['user']."</div>
          </div></div>";
        if($posfh < 250){
          $npst = substr($ghash['pstcont'], 0, $posfh+100);
          $x = sanitize($npst);
          $xe = str_replace("\\r\\n","<br/>",$x)."<br/>";
          $nxe = str_replace($ht, "<b>".$ht."</b>", $xe);
          echo "
          <div class='tpcntl'>
          ".$nxe."
          </div>";
        }
        else{
          $npst = substr($ghash['pstcont'], $posfh - 100, $posfh+100);
          $x = sanitize($npst);
          $xe = str_replace("\\r\\n","<br/>",$x)."<br/>";
          $nxe = str_replace($ht, "<b>".$ht."</b>", $xe);
          echo "
          <div class='tpcntl'>
          ...".$nxe."...
          </div>";
        }

        $tpeid = $ghash['id'];
            $pst = $ghash['pstst'];
            
            $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='$pst'");
            if($polc->num_rows){
              echo "<div class='p_available' style='width: fit-content; margin: auto; padding-top: 3px;'>Poll Available, Click to Vote.</div>";
            }

            if($pst == 1){
              $d = 's/';
            }
            else {
              $d = '';
            }
            $arr = array();
                  $td = getcwd();
                  for($i = 0; $i < 2; $i++){
                      if(file_exists("../../students_connect_hidden/postuploads/".$d.$ghash['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/$d".$ghash['id']."(".$i.").png";
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
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists("../../students_connect_hidden/postuploads/$d".$ghash['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/$d".$ghash['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/$d".$ghash['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';

                    if(file_exists("../../students_connect_hidden/postuploads/$d".$ghash['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/$d".$ghash['id']."(0).mp4' type='video/mp4'>
                      </video>
                      </div>
                      ";              
                              
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists("../../students_connect_hidden/postuploads/$d".$ghash['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/$d".$ghash['id']."(0).mp3' type='audio/mp3'></audio></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>';
                
        echo "<div class='posted'>".date("Y M d h:i a", $ghash['timeofupdate'])."</div>";
        if($ghash['pstst'] == 0){
          $on = "c('".$ghash['id']."', '".$row['user']."')";
        }else {
          $on = "sc('".$ghash['id']."', '".$row['user']."')";
        }
        echo "<div class='vwflpst' onclick=\"$on\">View full post</div>";
        echo "</div>"; 
      }
    }
    else {
      $time = strtotime('24 hours');
      $l = queryMySql("SELECT * FROM hashtagsbase WHERE started > $time ORDER BY `started`, `numberofusages` DESC");
      echo mysqli_num_rows($l)."<br/><br/>";
      if($l->num_rows){
        echo "Top hashtags";
      }
      else {
      echo '<div class="nosugws">No hashtag suggestion relating to \'<b>'.$search.'</b>\'</div>';
      }
    }
      echo '</div></div>';
    
      if(strpos($xex, "p") == 0 && strpos($xex, "\\") == 1){
        $stdw = 'block';
      }
      else {
        $stdw = 'none';
      }
        echo "<div class='towifrms' style='display: $stdw;'>
        <div class='shk_fix'>

        <div class='shk_all sacti'>All</div>
        <div class='shk_phts'>Photos</div>
        <div class='shk_vids'>Videos</div>
        <div class='shk_filt' title='Filter'>Filter</div>
        </div>
        <div class='towithforums' style='text-align: center; font-size: 15px;'>Related Posts with '<b>".substr($search, 0,strlen($search))."</b>'</div>";
        $newsearch  = substr($search, 0, strlen($search));
        $opee = explode(" ", $newsearch);
        $neww = '';
        for($i = 0; $i < count($opee); $i++){
          $neww  .= "pstcont LIKE '%".$opee[$i]."%' AND ";
        }
        $exz = queryMysql("SELECT * FROM eduposts WHERE $neww pstcont != ''
          UNION ALL
          SELECT * FROM socposts WHERE $neww pstcont != '' ORDER BY timeofupdate, pnc LIMIT 15");
          if($exz->num_rows != 0){
          if(!empty($newsearch))
            while($gexz = mysqli_fetch_array($exz)){
            $tu = $gexz['user'];
            if(file_exists('../../students_connect_hidden/users_profile_upload/'.$tu.'/'.$tu.'.png'))
            {
              $usimg = '../../students_connect_hidden/users_profile_upload/'.$tu.'/'.$tu.'.png';
            }
            else {
              $usimg = '../user.png';
            }
            $guinf = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$tu'"));
            echo "<div class='tpstsmt amps'>
              <div class='tpusp'>
              <div class='picotpstr' style='background-image: url(\"".$usimg."\")'></div>
              <div class='x_po_ltt'>
              <div class='psttrpstr'>".$guinf['surname']." ".$guinf['surname']."</div>
              <div class='c_x_p'><i class='fas fa-at'></i>".$guinf['user']."</div>
              </div></div>";
            $posfh = strpos($gexz['pstcont'], $newsearch);
            if($posfh < 250){
              $npst = substr($gexz['pstcont'], 0, $posfh+50);
              $x = sanitize($npst);
              $xe = str_replace("\\r\\n","<br/>",$x)."<br/>";
              $nxe = str_replace($newsearch, "<b>".$newsearch."</b>", $xe);
              echo "
              <div class='tpcntl'>
              ".$nxe."
              </div>";
            }
            else{
              $npst = substr($gexz['pstcont'], $posfh - 200, $posfh+200);
              $x = sanitize($npst);
              $xe = str_replace("\\r\\n","<br/>",$x)."<br/>";
              $nxe = str_replace($newsearch, "<b>".$newsearch."</b>", $xe);
              echo "
              <div class='tpcntl'>
              ...".$nxe."...
              </div>";
            }
            $tpeid = $gexz['id'];
            $pst = $gexz['pstst'];
            
            $polc = queryMysql("SELECT * FROM polls WHERE pid='$tpeid' AND pstst='$pst'");
            if($polc->num_rows){
              echo "<div class='p_available' style='width: fit-content; margin: auto; padding-top: 3px;'>Poll Available, Click to Vote.</div>";
            }

            if($pst == 1){
              $d = 's/';
            }
            else {
              $d = '';
            }
            $arr = array();
                  $td = getcwd();
                  for($i = 0; $i < 2; $i++){
                      if(file_exists("../../students_connect_hidden/postuploads/".$d.$gexz['id']."(".$i.").png")){
                        $files[$i] = "/Students_connect_hidden/postuploads/$d".$gexz['id']."(".$i.").png";
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
                    for($i = 0; $i < 2; $i++){ 
                    if(file_exists("../../students_connect_hidden/postuploads/$d".$gexz['id']."(".$i.").png")){  
                      echo "
                      <div class='postimages'>
                      <div class='p_es_Tr' style='background-image: url(\"/students_connect_hidden/postuploads/$d".$gexz['id']."(".$i.").png\")'></div>
                      <img alt='Images' class='postedimages' src='/students_connect_hidden/postuploads/$d".$gexz['id']."(".$i.").png'></div>";
                }
                    else {
                      echo "";                     }
                    }
                    echo '</div></div>';
                    echo '<div class="allimgposted"><div class="aimg">';

                    if(file_exists("../../students_connect_hidden/postuploads/$d".$gexz['id']."(0).mp4")){
                      echo "
                      <div class='postvideos'><video  class='pvideo' width='200' height = '100'>
                      <source src='/students_connect_hidden/postuploads/$d".$gexz['id']."(0).mp4' type='video/mp4'>
                      </video>
                      </div>
                      ";              
                              
                  }
                  echo "</div></div>";
                echo '<div class="allimgposted"><div class="aimg">';
                  if(file_exists("../../students_connect_hidden/postuploads/$d".$gexz['id']."(0).mp3")){
                    echo "
                    <div class='postaudio'>
                    
                    <audio  class='paudio'>
                    <source src='/students_connect_hidden/postuploads/$d".$gexz['id']."(0).mp3' type='audio/mp3'></audio></div>
                    ";                      
                }
                  chdir($td);
                echo '</div></div>';



            echo "<div class='posted'>".date("Y M d h:i a", $gexz['timeofupdate'])."</div>";
            if($gexz['pstst'] == 0){
              $on = "c('".$gexz['id']."', '".$row['user']."')";
            }else {
              $on = "sc('".$gexz['id']."', '".$row['user']."')";
            }
            echo "<div class='vwflpst' style='color: rgb(65, 191, 241)' onclick=\"$on\">View full post</div>";
            echo "</div>"; 
          }
        }
        else {
          echo '<div class="nosugws">No post suggestion relating to \'<b>'.$newsearch.'</b>\'</div>';
        }
 /*         echo <<<_END
  </div>
  <div class='towifrms' style='display: none;'>
  <div class='towithforums'>Related Forums with '<b>$search</b>'</div>
  <div class='xlux'>
_END;
  $yz = queryMysql("SELECT * FROM forums WHERE nameofforum LIKE '%$search%' ORDER BY numberofmembers");
  if($yz->num_rows){
    while($gyz = mysqli_fetch_array($yz)){
      if(file_exists("")){
        $forimg = "";
      }
      else {
        $forimg = '../user.png';
      }
      $fid = $gyz['id'];
            $mx = queryMysql("SELECT * FROM forummembers WHERE forumid='$fid'");
            $number = mysqli_num_rows($mx);
            $xb = array();
            while($nbx = mysqli_fetch_array($mx)){
                array_push($xb, $nbx['user']);
            }
            $win = "'".implode("','",$xb)."'";
            $ed= queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend in ($win) ORDER BY RAND() LIMIT 1");
            if($gyz['typeofforum'] == 0){
                $flag = '<i class="fas fa-globe foflag"></i>';
                if($number ==  1){
                $nfmbs = $number." member";
                }
                else {
                $nfmbs = $number." members";
                if($ed->num_rows){
                        $nfmbs .= ' including';
                    } 
                    while($ged = mysqli_fetch_array($ed)){
                        $nfmbs .= " ".$ged['friend'];
                    }
                    
                }
            }
            elseif($gyz['typeofforum'] == 1){
                $flag = '<i class="foflag">P</i>';
                $nfmbs = '';
            }
            elseif($gyz['typeofforum'] == 2){
                $flag = '<i class="foflag">S</i>';
                $nfmbs = '';
            }
      echo "
      <div class='eofthm'>
      <a href='/students_connect/f/".$gyz['id']."'>
      <div class='peofthm' style='background-image:url(\"".$forimg."\")'></div>
      <div class='neofthm'>".$gyz['nameofforum']."</div>
      </a>
      <div class='totfeat'>
      <div class='srflttr'>".$nfmbs."</div>
      <div class='sftyp'>".$flag."</div>
      </div>
      </div>";
    }
  }
  else {
    echo '<div class="nosugws">No forum relating '.$search."</div>";
  }*/
}
echo <<<_END

<script>

var loops = document.getElementById('evsrch');
loops.oninput = function(){
  var clo = document.getElementsByClassName('clsearch')[0];
  if(this.value == ''){
    clo.style.display = 'none';  
    document.getElementsByClassName('converttps')[0].style.display = 'none';
  }
  else {
    clo.style.display = 'block';
  }
  var search = document.getElementById('evsrch').value;
  var user = document.getElementById('idde').value;
  var sp = document.getElementById('evsrch').value;
  if(search.includes('#') == true){
    search = search.replace(/#/g, '%23');
  }
  if(search.includes('&') == true){
    search = search.replace(/&/g, '%26');
  }
  if(search == null || search == "" || search == " " || search == "  "){
    document.getElementById('sbx').style.border = 'none';
    document.getElementById('rfsearch').innerHTML = "";
  }
  else {
    if((search.indexOf('p') !== 0) && (search.indexOf('\\\') !== 1)){
      //document.getElementsByClassName('converttps')[0].style.display = 'block';
      //document.getElementsByClassName('converttps')[0].innerHTML = 'Change to Post Search';
    }
  }
  $('.searchresult').ready(function(){
    $.ajax({
      url:"search.php?user="+user+"&search="+search,
      method:"GET",
      success:function(data){
        $('.tsearches').html(data);
      }
    })
    })
}
function clrs(){
  document.getElementsByClassName('clsearch')[0].style.display = 'none';
  document.getElementById('evsrch').value='';
  document.getElementById('evsrch').focus();
  document.getElementsByClassName('tsearches')[0].innerHTML = '';
  document.getElementsByClassName('converttps')[0].style.display = 'none';
}
function chpstsearch(tval){
  document.getElementsByClassName('converttps')[0].style.display = 'none';
  document.getElementById('evsrch').value= "p\\\"+tval;
}
var etl = document.getElementById('evsrch');
etl.onclick = function(){
  if(this.value != ''){

  }
}
if(document.getElementsByClassName('fo_pos')[0]){
var pt = document.getElementsByClassName('fo_pos')[0];
pt.addEventListener('click', 
function(){  
document.getElementsByClassName('srrfusrs')[0].style.display = 'none';
document.getElementsByClassName('srrfhash')[0].style.display = 'none';
document.getElementsByClassName('towifrms')[0].style.display = 'block';
var am = document.getElementsByClassName('a_me_n')[0].children;
for(var i = 0; i < am.length; i++){
  am[i].className = am[i].className.replace('sacti', '');
}
this.classList.add('sacti');
  })
}
if(document.getElementsByClassName('fo_tag')[0]){
  var pt = document.getElementsByClassName('fo_tag')[0];
  pt.addEventListener('click', 
  function(){  
  document.getElementsByClassName('srrfusrs')[0].style.display = 'none';
  document.getElementsByClassName('srrfhash')[0].style.display = 'block';
  document.getElementsByClassName('towifrms')[0].style.display = 'none';
  var am = document.getElementsByClassName('a_me_n')[0].children;
  for(var i = 0; i < am.length; i++){
    am[i].className = am[i].className.replace('sacti', '');
  }
  this.classList.add('sacti');
    })
  }
  if(document.getElementsByClassName('fo_pep')[0]){
    var pt = document.getElementsByClassName('fo_pep')[0];
    pt.addEventListener('click', 
    function(){  
    document.getElementsByClassName('srrfusrs')[0].style.display = 'block';
    document.getElementsByClassName('srrfhash')[0].style.display = 'none';
    document.getElementsByClassName('towifrms')[0].style.display = 'none';
    var am = document.getElementsByClassName('a_me_n')[0].children;
    for(var i = 0; i < am.length; i++){
      am[i].className = am[i].className.replace('sacti', '');
    }
    this.classList.add('sacti');
      })
    }
    $(window).scroll(function(){
      if($(window).scrollTop() == ($(document).height() - $(window).height())){
          lmore();
        }
  })
function lmore(){
    var r = document.getElementById('r_round').value;
    var pel = document.getElementById('tpe'+r).value;
    var pell = document.getElementById('tpel'+r).value;
    var lp = document.getElementById('bthm').value;
    var p = document.getElementById('pnum').value;
    $.post("lmore.php",
    {
        su:pel,
        ssu: pell,
        end:p,
        la:p,
        r:r
    },
    function(data){
      document.getElementById('pnum').value = parseInt(p) + 10;
      document.getElementById('bthm').value = parseInt(lp) + 4;
      document.getElementById('r_round').value = parseInt(r) + 1;
      $(data).insertBefore($('#more'));
      for(var i =0; i < document.scripts.length; i++){
        if(document.scripts[i].src.includes('tckreader.js')){
          var oxe = document.createElement('script');
          oxe.src = '/students_connect/jsf/tckreader.js';
          document.scripts[i].replaceWith(oxe);
      }
      }
  })
}
</script>
<script src='/students_connect/jsf/filescript.js'></script>
_END;
?>