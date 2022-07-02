<?php
define("le", "/Users/wilay/students_connect/");
    require_once le."connect.php";
    require_once le."header2.php";
    $usr = $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    echo <<<_END
  <div class='dis_cvr'>
  <div class='d_we43fd'>
  <div class='c_Aadiscover'><a href='/students_connect/discover'><span class='c_oolii'>Grint</span> Discover</a></div>
  <div class='c_Aapgae'><a href='/students_connect/discover/createpage'>Create a Page</a></div>
  </div>
  <div class='d_pppse'>
  <div class='d_oepodp'>
  <div class='d_osss1e'>Create a Page</div>
_END;
if(isset($_POST['cpge'])){
  $name = sanitizeString($_POST["dname"]);
  $about  = sanitizeString($_POST['dbout']);
  $c = $_POST['category'];
  $snm = sanitizeString($_POST['shnm']);
  $ox = '';
  for($i = 0;$i<count($c); $i++){
    $ox = $ox.$c[$i].",";
  }
  $ox = $ox.sanitizeString($_POST['ot_cat']);
  $time = time();
  $id = 0;
  $sl = gen();
  queryMysql("INSERT INTO discover VALUES('$id','$user' ,'$name','$snm', '$about', '0', '0', '$time', '0', '$ox', '$sl')");
  $lo = queryMysql("SELECT * FROM discover WHERE startedby='$user' AND sl='$sl'");
  if($lo->num_rows){
    $k = mysqli_fetch_array($lo);
    $qx = getcwd();
    chdir("../");
    mkdir($sl);
    $f = fopen($sl.'/index.php', "w");
    $myid = '$mid';
       fwrite($f, "
       <?php
       ".$myid." = '".$k['id']."';
       define('rool', '/Users/wilay/students_connect/');
       require_once rool.'discover/dl.php';
    ?>");
       fclose($f);
    echo "<script>
    window.location.href='/students_connect/discover/".$sl."'
    </script>";
      }
  echo 'Page Created';
}
echo <<<_END
  <div class='d_afmnths'>
  <form action='' method='post'>
  <div class='d_pg_c_name meaxxl'>
  <div class='d_pg_c_name_sbt meaxxls'>Page Name</div>
  <div class='d_pg_c_name_adn meaxxld'>
  <input type='text' autocomplete='off' name='dname' placeholder="Page Name"/>  
  </div></div>
  <div class='d_pg_snm meaxxl'>
  <div class='d_pg_snm_sbt meaxxls'>Short Name</div>
  <div class='d_pg_snm_adn meaxxld'>
  <input name='shnm' autocomplete='off' placeholder='Short Name'type='text'>
  </div>
  </div>
  <div class='d_pg_abt meaxxl'>
  <div class='d_pg_abt_sbt meaxxls'>About Page</div>
  <div class='d_pg_abt_adn meaxxld'>
  <textarea name='dbout' placeholder='About Page'></textarea>
  </div>
  </div>
  <div class='d_rlt_to meaxxl'>
  <div class='d_rlt_to_sbt meaxxls'>Category</div>
  <div class='d_rtl_to_adn meaxxld'>
  <select name='category[]' multiple>
  _END;

$cat = ["News", "Politics", "Entertainment", "Business", "Food", "Travel", "Fashion and Beauty", "Lifestyle", "Religion", "Others"];
for($i = 0; $i < count($cat); $i++){
  echo "<option value='".$cat[$i]."'>".$cat[$i]."</option>";
}
echo "
  </select>
  <div class='meaxxlde'>
  <div class='mea_s_oths'>Specify Others</div>
  <input type='text' autocomplete='off' name='ot_cat' placeholder='Eg. lifestyle,religion'/>
  </div>
  </div></div>
  <div class='d_fl_fm' style='width: fit-content; margin: auto;'>
  <button type='submit' class='d_cpge' name='cpge'>Create</button>
  </div></form>
  </div>
  </div>
  </div>
  ";
  echo "</div>";
?>