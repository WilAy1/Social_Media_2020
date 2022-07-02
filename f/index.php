<?php
    define('f', "/Users/wilay/students_connect/");
    require_once f."connect.php";
    require_once f."header2.php";
    $tus = $_SESSION['user'];
    $gus = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$tus'"));
    $user = $gus['user'];
    echo <<<_END
  <div class="navbar2">
  <ul id="navbar_list">
  <li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home"></i></a></li>
  <li id="hmic" style=''><a href="/students_connect/trend"><i class="fas fa-bolt"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="fas fa-bell"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="fas fa-envelope"></i></a></li>
    <li id="hmic" class='tbstr' style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
    <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
if(!file_exists("../../students_connect_hidden/users_profile_upload/".$user."/".$user.".png")){
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
}
else{
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$user."/".$user.".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
    </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
 _END;   
  if(isset($_GET['start'])){
        // create forum
        echo "<div class='sfocr'>
        <div class='fhd'>Create Forum</div>
        <div class='sfoc'>
        <form action='/students_connect/f/' name='fform' method='post' autocomplete='off' onsubmit='return vlf()'>
        <div class='fatgd egb'>
        <div class='nffor'>
        <div class='fforlab'>
        <label for='namffor'>
        Name of Forum:
        </label>
        <label for='help' id='thlep'><i class='fas fa-question-circle' title='Help'></i></label></div>
        <div id='nerror'></div>
        <div class='fninp'>
        <input type='text' id='namffor' class='inpfforum' name='forumname' placeholder='Name'>
        </div>
        </div>
        <div class='abfrm'>
        <div class='fforlab'>
        <label for='aboutfrm'>About Forum:</label>
        <label for='help' id='ahlep'><i class='fas fa-question-circle' title='Help'></i></label></div>
        <div id='aerror'></div>
        <div class='fninp'>
        <textarea name='forumabout' id='aboutfrm' class='forumatext xyzf'></textarea>
        </div>
        </div>
        <div class='ppffrm'>
        <div class='fforlab'>
        <label for='pfforum'>Purpose of Forum</label>
        <label for='help' id='phlep'><i class='fas fa-question-circle' title='Help'></i>
        </div>
        <div id='perror'></div>
        <div class='fpinpt'>
        <textarea name='purposeofforum' id='pfforum' class='tmpof xyzf'></textarea>
        </div>
        </div>
        <div class='typeffrm'>
        <div class='fforlab'>
        <label for='ftype'>Type of Forum</label>
        <label for='help' id='thelp' title='Help'><i class='fas fa-question-circle'></i>
        </div>
        <div class='ipftyp'>
        <label for='pub'>Public</label>
        <input type='radio' name='tof' value='0' id='pub' required>
        <label for='priv'>Private</label>
        <input type='radio' name='tof' value='1' id='priv' required>
        <label for='schl'>School</label>
        <input type='radio' name='tof' value='2' id='schl' required>
        </div>
        </div>
        <div class='motto'>
        <div class='fforlab'>
        <label for='mtto'>Motto</label>
        <label for='help' id='mhlep'><i class='fas fa-question-circle' title='Help'></i></div>
        <div class='tmtinp'>
        <textarea name='motto' id='mtto' class='tfmto xyzf'></textarea>
        </div>
        </div>
        <input type='hidden' name='user' value='".$user."'>
        <div>
        <div class='fsbbtn'>
        <button type='submit' name='fisub' class='tfsbtn'>Create Forum</button>
        </div>
        </form>
        </div>
        </div>";
    }
    if(isset($_POST['forumname']) && isset($_POST['forumabout'])){
        $fname = sanitizeString($_POST['forumname']);
        $fabout = sanitizeString($_POST['forumabout']);
        $fpurpose = sanitizeString($_POST['purposeofforum']);
        $tuser = sanitizeString($_POST['user']);
        $mtto = sanitizeString($_POST['motto']);
        $timefc = time();
        $lck = 0;
        $tof = $_POST['tof'];
        $id = 0;
        queryMysql("INSERT INTO forums VALUES('$id', '$fname','$mtto', '$fabout', 
                '$fpurpose', '$tof', '0', '$tuser', '$timefc', '1')");
        $a = mysqli_fetch_array(queryMysql("SELECT * FROM forums WHERE createdby='$tuser'
         AND created='$timefc'"));
         $fid = $a['id'];
         queryMysql("INSERT INTO forummembers VALUES('$id', '$fid', '$tuser', '1', '$timefc', '1')");
        $gcd = getcwd();
        mkdir($a['id']);
        $f = fopen($a['id'].'/index.php', "w");
        fwrite($f, "
        <?php
        define('op', '/Users/wilay/students_connect/');
       require_once op.'/connect.php';
       require_once op.'/header2.php';
       require_once op.'/f/submitposts.php';
        echo \"<script>
        var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {  
            var a = xmlhttp.responseText;
                document.getElementById('quest').innerHTML = a;
                var f = document.createElement('script');
               f.src = '/students_connect/jsf/forumscript.js';
               f.type = 'text/javascript';
               var e = document.getElementsByTagName('HEAD')[0];
                e.append(f);
            }
                    };
                    xmlhttp.open('GET', '/students_connect/f/index.php?fid=".$a['id']."');
                    xmlhttp.send();       
     </script>\"
     ?>");
        fclose($f);
        die("<script>
        function Redirect() {
            window.location='/students_connect/f/".$a['id']."';
        }
        setTimeout('Redirect()', 1)</script>
        ");   
}

    if(isset($_GET['fid'])){
        $fid = $_GET['fid'];
        global $fid;
        $cf = queryMysql("SELECT * FROM forums WHERE id='$fid'");
        $ed = mysqli_fetch_array($cf);
        if($cf->num_rows){
            //check if user in forum
            $uinf = queryMysql("SELECT * FROM forummembers WHERE user='$user' AND forumid='$fid' AND isacknoledged='1'");
            if($uinf->num_rows){
                // ability to view 
                if($ed['typeofforum'] == 0){
                    // able to view forum info
                    require_once "openforum.php";   
                }
                elseif($ed['typeofforum'] == 1){
                    // request to join forum
                    require_once "closedforum.php";
                }             
                elseif($ed['typeofforum'] == 2){
                    // request to join school forunm
                    require_once "schoolforum.php";
                }
            }
            else {
                // check type of forum and act based on the type
                if($ed['typeofforum'] == 0){
                    // able to view forum info
                    require_once "openforum.php";   
                }
                elseif($ed['typeofforum'] == 1){
                    // request to join forum
                    require_once "closedforum.php";
                }             
                elseif($ed['typeofforum'] == 2){
                    // request to join school forunm
                    require_once "schoolforum.php";
                }
            }
        }
        else {
            echo "Forum doesn't exist<br/><a href='/students_connect/h'>Go Home</a>";
        }
    }
    elseif(isset($_GET['start']) || isset($_POST['fisub']) || isset($_GET['s']) || isset($_GET['sug'])) {
    }
    else{
       echo "<a href='/students_connect/h'>Go to home</a>";
       echo "<div class='lakeside'>
       <div class='xebs'>
       <div class='sform'>Forums</div>
       <div class='forumsrch'>
       <form action='' method='get' autocomplete='off'>
       <input type='text' onkeyup='fsrch(\"".$user."\", this.value)' placeholder='Search Forums' name='s' id='forumsearch'>
       <button type='submit' class='sf'><i class='fas fa-search'></i></button>
       </form>
       <div class='fsugst' id='fsugst' style='display: none;'></div>
       <div>
       </div>
       </div>
       </div>
       <div class='ycnvnv'>
       <div class='cranfo'>Create a new forum, 
       <a href='/students_connect/f?start'>click here</a> now.</div>
       </div>
       <div class='foryourevis'>
       <div class='tohdng'>Forums You Are</div>
       <div class='xeabcd'>
       ";
       $bcx = queryMysql("SELECT * FROM forummembers WHERE user='$user'");
       if($bcx->num_rows){
       while($gcx = mysqli_fetch_array($bcx)){
        $ck = $gcx['forumid'];
        $xcb = mysqli_fetch_array(queryMysql("SELECT * FROM forums WHERE id='$ck'"));
        echo "<div class='bboffyao'>
        <a href='/students_connect/f/".$xcb['id']."'><div class='ftfori'></div>
        <div class='tforname'>".$xcb['nameofforum']."</div></a>
        <div class='nopinform'></div>
        </div>";
       }
    }
        else {
            echo "You aren't on any forum";
    }
    echo "</div>";
    echo "<div class='foyrvst'>Forums You Recently Visited</div>";
       echo "
       </div>";
    }
    if(isset($_GET['s'])){
        $sug = sanitizeString($_GET['s']);
        $ex = queryMysql("SELECT * FROM forums WHERE nameofforum LIKE '%$sug%' LIMIT 0, 5");
        if($ex->num_rows){
        while($gex = mysqli_fetch_array($ex)){
            $fid = $gex['id'];
            $mx = queryMysql("SELECT * FROM forummembers WHERE forumid='$fid'");
            $number = mysqli_num_rows($mx);
            $xb = array();
            while($nbx = mysqli_fetch_array($mx)){
                array_push($xb, $nbx['user']);
            }
            $win = "'".implode("','",$xb)."'";
            $ed= queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend in ($win) ORDER BY RAND() LIMIT 1");
            if($gex['typeofforum'] == 0){
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
                        $nfmbs .= " ".$ged['user'];
                    }
                    
                }
            }
            elseif($gex['typeofforum'] == 1){
                $flag = '<i class="foflag">P</i>';
                $nfmbs = '';
            }
            elseif($gex['typeofforum'] == 2){
                $flag = '<i class="foflag">S</i>';
                $nfmbs = '';
            }
            echo '<div class="srslt">
            <div class="fsone">
            <div class="sfnm">
            '.$gex['nameofforum'].'
            </div>
            <div class="mbsinf" style="display: block !important;">'.$nfmbs.'</div>
            </div>
            <div class="fstwo">'.$flag.'</div>
            </div><hr style="width: 90%">';
        }
        echo '
        <div class="fvmorecap">
        <div class="fvmore">View More</div></div>';
    }
    else {
        echo '<div class="shwmich" style="display: block; width: 100%;">
         <div class="pxdef" style="width: 15%; display: block; padding-top: 20px;
         margin-left: auto; margin-right: auto;">No Suggestion</div></div>';
    }
    }
    echo "</div></div>";
?>