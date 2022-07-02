<?php
define('ROOT' , "/Users/wilay/students_connect/");
require_once ROOT."connect.php";
require_once ROOT."header2.php";
if (!$loggedin) die();
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$user= sanitizeString('user');
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
$dtopics = array("Arts", "Science", "Computer", 
"Programming", "Mathematics", "Physics", "Literature", "Chemistry", "Biology", "English", 
"Book Keeping", "Languages", "Data Science", "Animation", "Java", "PHP", "Javascript", "C++", "C", "C#",
"Python", "HTML", "Windows", "iOS");
$sval = '';
if(isset($_GET['search'])){
  $sval = substr(sanitizeString($_GET['search']), 1);
}
echo <<<_END
  </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:695px;">
  <div class='ttag_page'>
  <div class='tagbol'>
  <div class='tbdyheader'>
  <div class='barpart' onclick='displaytagnav(event)'><i class='fas fa-bars'></i></div>
    <div class='searchpart'>
    <input type='search' class='tagsearch' value='$sval' placeholder='Search'>
    </div>
    </div>
    <div class='ttrdad'><div class='tagttl'>
    <div class='l_o_d_topics'>
    <div class='feach'>
_END;
  for($i = 0; $i < count($dtopics); $i++){
    $jm = '';
    if(strtolower($sval) == strtolower($dtopics[$i])){
      $jm = 'tagctive'; 
    }
      echo "<div class='th_jam $jm'>".$dtopics[$i]."</div>";
    
  }
echo <<<_END
    </div>
    </div>
    </div></div>
    <div class='tagflb'>
    <div class='tagbcont'>
_END;
  if($sval !== ''){
    echo "<div class='thibdy'>
    ";
    echo "";
    echo "
    <div class='th_filter'>
    <div class='th_xfct'>
    <div class='th_fbl tagctive'>Latest</div>
    <div class='th_xpn'>Relevant</div>
    <div class='th_xvt'>Votes</div>
    <div class='th_xcmt'>Comments</div>
    </div>
    </div>
    <div class='thiimg'>
    <div class='thhrhd'>".ucfirst($sval)."</div>
    </div>
    <div class='th_xotb'>
    ";
    $tg = queryMysql("SELECT * FROM eduposts WHERE pinterest LIKE '%".$sval."%'");
    if($tg->num_rows){
      while($ttg = mysqli_fetch_array($tg)){
        echo "<div class='tcamp'>
        <div class='tamps'>
        <div class='pstname'>
        
        </div>
        </div>
        </div>";
      }
    }
    echo "
    </div>
    </div>";
    
  }
  else {

  }
echo <<<_END
  </div>
  </div>
  </div>
  </div>
_END;
echo "</div></div>";
?>
<script src='/students_connect/jsf/filescript.js'></script>
<script>
lastp = [];
function displaytagnav(event){
    if(window.innerWidth < 799){
    var a = document.getElementsByClassName('ttrdad')[0].style.display;
    if(a == 'none' || a == ''){
      document.documentElement.style.position = 'fixed';
      document.body.style.position = 'fixed';
    document.getElementsByClassName('ttrdad')[0].style.display = 'block';
    document.getElementsByClassName('tagttl')[0].style.width = '50%';
    document.getElementsByClassName('tagttl')[0].style.display = 'block';
    lastp[0] = parseInt(event.pageY)-80;
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
</script>