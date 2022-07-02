<?php
require_once '/Users/wilay/students_connect/header2.php';
$a = queryMysql("SELECT userprofilecode FROM members");
 
if (!$loggedin) die();
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= sanitizeString('user');
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    $mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
    $eeex = mysqli_num_rows($mecc);
    if(isset($_GET['text'])){
      $text = $_GET['text'];
    }
    else {
      $text = '';
    }
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
      </i></a></li>
      <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
      <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
    _END;
    if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../user.png'\")'; class='mypimg'></div></a></li>";
    }
    else{
    echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    }
    if(!file_exists("../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
        $mmg = '../students_connect/user.png';
       }
      else{
        $mmg = "../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png";
        }
    echo <<<_END
      </ul>   
      </div>
      <div class='pycl'>
      <div class="dark-mode" id='darkmd'>
      <div class='proq' style='padding: 10px 0px 0px 58px; font-size: 17px;
    color:rgb(69, 146, 240);'>Create a New Post</div>
    <div id='dtrt'></div>
  <div class="postarea" style='display: block'>
  <form name='sndpst' id='profform' onsubmit='return vsmiw();' method='POST' action='/students_connect/upsts/' enctype="multipart/form-data">
  <div class='sltimg' id='sltimg'></div>
  <div class='err' id='err'></div>
  <div class='charea'>
  <div class='mil_an' style='display: flex'>
  <div class='upd_td' style='background-image: url("$mmg"); margin-right: 10px;'></div>
  <div class='y_mlp'>
  <textarea value="$text" id='dfune' class='xfun' name='sendposts' placeholder='Write Something...' title='Input Post' cols="50" rows="20" style="margin: 0px; border-radius:10px; resize: none; width: 100%;
  font-size: 10px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;" wrap="hard">$text</textarea>
  </div></div>
  <div class='ifimg_shw' style='margin-bottom: 10px;
  width: 85%;
    margin-left: auto;border: 2px solid #afafee;
    border-radius: 5px; display: none;'>
  <div id='img2bu' width='100%' style='display: none; margin-left: auto; margin-right: auto; 
  height: 180px;
    background-repeat: no-repeat;
    background-size: cover; border: 0px;'/></div>
  <div id='img3bu' width='100%' style='display: none; margin-left: auto; margin-right: auto;
  height: 180px;
    background-repeat: no-repeat;
    background-size: cover; border: 0px;'/></div>
  </div>
  </div>
  <div class='addcont' style='display: flex'>
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
_END;
    $tagpostoptions = array("Arts", "Science", "Computer", 
  "Programming", "Mathematics", "Physics", "Literature", "Chemistry", "Biology", "English", 
  "Book Keeping", "Languages", "Data Science");
  $sthag = sort($tagpostoptions);
  for($i = 0; $i < count($tagpostoptions); $i++){
    echo '<input type="checkbox" onchange="plyt(this.value)"  value="'.$tagpostoptions[$i].'"><label for="'.$tagpostoptions[$i].'">'.$tagpostoptions[$i].'</label><br/>';
  }
echo <<<_END
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
        if(date('D', strtotime($i - date("d")." day")) == date("D")){
          $vd = 'Today';
        }
        else {
          $vd = date('D', strtotime($i-date("d")." day"));
        }
        echo "<option value='".$vd."'>".$vd."</option>";
      }
      echo "</select>";
      echo "<select name='hour' id='th_h' >
      <option value='hour'>Hour</option>";
      for($i = 1; $i < 13; $i++){
        echo "<option value='".$i."'>".$i."</option>";
      }
      echo "</select>";
      echo "<select name='minute' id='th_m' >
      <option value='min'>Minute</option>";
      for($i = 0; $i < 60; $i++){
        $con = $i;
        if(strlen($i) == 1){
          $con = '0'.$i;
        }
        echo "<option value='".$con."'>".$con."</option>";
      }
      echo "</select>";
      echo "<select name='period' id='th_p' >
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
          <div class="chtype">
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
echo <<<_END
  <input type='submit' name='subpost' value="Submit">
  </div>
  </div>
  </form>
  </div>
  </div></div></div>
  <script src='/students_connect/jsf/filescript.js'></script>
    <script>
        document.getElementById('darkmd').style.minHeight = window.innerHeight+'px';
        var loadFile = function(event) {
            document.getElementsByClassName('ifimg_shw')[0].style.display = 'block';
            var output = document.getElementById('img2bu');
            var outputx = document.getElementById('img3bu');
              output.style.backgroundImage = "url("+URL.createObjectURL(event.target.files[0])+")";
            document.getElementById('img2bu').style.display='block';
            if(event.target.files[1]){
              document.getElementById('img3bu').style.display='block';
            outputx.style.backgroundImage = "url("+URL.createObjectURL(event.target.files[1])+")";
            outputx.onload = function () {
              URL.revokeObjectURL(outputx.src)
            }
          }
        }
        </script>
_END;