<?php
    define("le", "/Users/wilay/students_connect/");
    require_once le."connect.php";
    require_once le."header2.php";
    $usr = $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
    $cntnm = mysqli_num_rows($cnt);
    echo <<<_END
  <div class='dis_cvr'>
  <div class='d_we43fd'>
  <div class='c_Aadiscover'><span class='c_oolii'>Grint</span> Discover</div>
  <div class='c_Aapgae'><a href='/students_connect/discover/createpage'>Create a Page</a></div>
  </div>
  <div class='c_loopp'>
  <div class='C_pommove'>
  <div class='c_plxzze'>
  <div class='c_home c_pe_ace bgeactive'>Home</div>
  <div class='c_news c_pe_ace'>News</div>
  <div class='c_politics c_pe_ace'>Politics</div>
  <div class='c_politics c_pe_ace'>Entertainment</div>
  <div class='c_business c_pe_ace'>Business</div>
  <div class='c_food c_pe_ace'>Food</div>
  <div class='c_travel c_pe_ace'>Travel</div>
  <div class='c_fandb c_pe_ace'>Fashion and Beauty</div>
  <div class='c_lifestyle c_pe_ace'>Lifestyle</div>
  <div class='C_religion c_pe_ace'>Religion</div>
  <div class='c_others c_pe_ace'>Others</div>
  </div>
  </div>
  <div class='c_eomain'>
  <div class='c_eocont'>
  <dic class='c_melahead'>
  Most Visited
  </div>
  <dic class='c_melacont'>
  <div class='p_nneew'></div>
_END;
$rte = queryMysql("SELECT * FROM discoverposts ORDER BY numberofvisits, timeposted, rating DESC");
while($g = mysqli_fetch_array($rte)){
$myy = mysqli_fetch_array(queryMysql("SELECT * FROM discover WHERE id='".$g['discoverid']."'"));
if(file_exists("../../students_connect_hidden/discoverp/".$g['discoverid']."/".$g['id']."/0.png")){
  $bigmg = "../../students_connect_hidden/discoverp/".$g['discoverid']."/".$g['id']."/0.png";
}
$ert = strlen($g['postheading']) > 45 ? substr($g['postheading'], 0, 45).'&hellip;': $g['postheading'];
$conn = strlen($g['postcontent']) > 45 ? substr($g['postcontent'], 0, 45).'&hellip;': $g['postcontent'];
echo "
  <div class='c_pollet'>
  <div class='c_frell'>
  <div class='c_frpimg' style='background-image: url(\"".$bigmg."\")'></div>
  <div class='c_apfriim'>
  <div class='c_pohead'>".$ert."</div>
  <div class='c_olitcont'>".$conn."</div>
  <div class='c_itwby'>".$myy['discovername']." . ".ucfirst($g['tag'])." . ".date("M d h:i a",$g['timeposted'])."</div>
  </div>
  </div>
  </div></div>
";
}
echo <<<_END
  </div>
  _END;
  echo "
  <div class='c_undera'>
  <div class='pee_r leactive eoohome'><i class='fas fa-home'></i><div class='c_sbund'>Home</div></div>
  <div class='pee_r'><i class='fas fa-search'></i><div class='c_sbund'>Search</div></div>
  <div class='pee_r ellee'><div class='c_mmimg' style='background-image: url(\"/students_connect/user.png\")'></div><div class='c_sbund'>Me</div></div>
  <div class='pee_r'><i class='fas fa-rss'></i><div class='c_sbund'>Following</div></div>
  <div class='pee_r'><i class='far fa-bookmark'></i><div class='c_sbund'>Saved</div></div>";
echo <<<_END
  </div></div>
  <div class='c_mainf'></div>
  </div>
  </div>
  </div>
  _END;
  echo "<script>
  var tt = document.getElementsByClassName('ellee')[0];
  var ett = document.getElementsByClassName('c_loopp')[0];
  var et = document.getElementsByClassName('c_mainf')[0];
  tt.onclick = function(){
    for(var i = 0; i < tt.parentElement.children.length; i++){
      tt.parentElement.children[i].className = tt.parentElement.children[i].className.replace('leactive', '')
    }
    this.classList.add('leactive');
    ett.style.display = 'none';
    et.style.display = 'block';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
        et.innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('GET', '/students_connect/discover/myprofile.php');
    xmlhttp.send();
  }
  var tt = document.getElementsByClassName('eoohome')[0];
  tt.onclick = function(){
    for(var i = 0; i < tt.parentElement.children.length; i++){
      tt.parentElement.children[i].className = tt.parentElement.children[i].className.replace('leactive', '')
    }
    this.classList.add('leactive');
    ett.style.display = 'block';
    et.style.display = 'none';
    $.post('/students_connect/discover/update.php',{
      
    }, 
    function(data){
    $(data).insertBefore($('.p_nneew'));
    })
  }
  </script>";
?>