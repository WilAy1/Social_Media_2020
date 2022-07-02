<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    $medu = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
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
    elseif(($ctime - $ttime) > 86000 && ($ctime - $ttime) < 604800){
      $x = (int)(($ctime - $ttime));
      if($x < (86000 * 2)){
        $ftime = 'Yesterday at '.date("h:i a", $ttime);
      }
      else {
        $ftime = date("D", $ttime)." at ".date("h:i", $ttime);
      }
    }
    else {
      $ftime = date("M d h:i a", $ttime);
    }
    echo $ftime;
}
?>