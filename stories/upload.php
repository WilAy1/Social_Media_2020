<?php
define('ROOT', "C:/apache24/htdocs/students_connect");
require_once ROOT."/header2.php";
if(isset($_POST['status'])){
$u = $_SESSION['user'];
$row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$u'"));
$user = $row['user'];
$id = 0;
$time = time();
if(!empty($_FILES['files']['name'][0])){
    chdir("../../students_connect_hidden/stories/");
    $nmf = count($_FILES['files']['name']);
    for($i=0; $i < $nmf; $i++){
      $caption = sanitizeString($_POST['captions'][$i]); 
      queryMysql("INSERT INTO stories VALUES('$user', '$id', '$caption','0', '$time')");
      $nnn = $_FILES['files']['name'][$i];
      move_uploaded_file($_FILES['files']['tmp_name'][$i],
      '../../students_connect_hidden/stories/'. $nnn);
      $ne = mysqli_fetch_array(queryMysql("SELECT * FROM stories WHERE user='$user' AND timeofupdate='$time' ORDER BY id DESC"));
      $newname = $ne['id'];
      if(substr($_FILES['files']['type'][$i], 0, 5) == "image"){
      rename('../../students_connect_hidden/stories/'.$_FILES['files']['name'][$i],
         '../../students_connect_hidden/stories/'.$newname.'.png');
      }
      elseif(substr($_FILES['files']['type'][$i], 0, 5) == "video"){
        rename('../../students_connect_hidden/stories/'.$_FILES['files']['name'][$i],
         '../../students_connect_hidden/stories/'.$newname.'.mp4');
      }
      else {
        rename('../../students_connect_hidden/stories/'.$_FILES['files']['name'][$i],
        '../../students_connect_hidden/stories/'.$newname.'.'.pathinfo($_FILES['files']['name'],PATHINFO_EXTENSION));
      }
    }
}
}
else {

}
?>