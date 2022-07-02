<?php
    define("le", "/Users/wilay/students_connect/");
    require_once le."connect.php";
    require_once le."header2.php";
    $usr = $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
    $id = '';
    if(isset($mid)){
        $id = $mid;
    }
    $x = queryMysql("SELECT * FROM discover WHERE id='$id'");
    $kx = mysqli_fetch_array($x);
    
echo <<<_END
  <div class='dis_cvr'>
  <div class='d_we43fd'>
  <div class='c_Aadiscover'><span class='c_oolii'>Grint</span> Discover</div>
  <div class='c_Aapgae d_xc_po'><i class='fas fa-bars'></i></div>
_END;
if($kx['startedby'] !== $user){
    echo "
    <div class='d_bisho'>
    <div class='d_subbtn'>Subscribe</div>
    <!--<span class='d_awtg d_last'>Get New Posts on Mail</span>--></div>
    ";
    $qox = "
    <div class='d_wepxlo'>
    <div class='d_mnaxl'>
    <div class='d_oklde'></div>
    </div>
    </div>
    ";
}
else {
    $qox = "
    <div class='d_wepxlo'>
    <div class='d_mnaxl'>
    <div class='d_oklde'></div>
    </div>
    </div>
    ";
}
echo "
  </div>";
$kox = $kx['numberofposts'] == 1 ? $kx['numberofposts'].' Article' : $kx['numberofposts'].' Articles';
echo "
<div class='d_do'>
<div class='d_pxging'>
<div class='d_oalx'>
<div class='d_pnmdx'>".$kx['discovername']."</div>
<div class='d_shneem'><i class='fas fa-at'></i>".$kx['discoverusername']."</div>";
echo "
</div>
</div>
<div class='d_pts_a_hd'>
<span class='d_pg_inf'><i class='fas fa-caret-down d_oksb'></i> Page Info</span>
<div class='d_sh_pgi'>
<span class=''></span>
<span class=''></span>
</div>
</div>
<div class='d_no_arcls'>".$kox."</div>
</div>
</div>";
#"<div class=''></div>";
?>
<script>
window.addEventListener('load', function(){
  if(document.getElementsByClassName('d_awtg')[0]){
      setTimeout(function(){
        document.getElementsByClassName('d_awtg')[0].style.display = 'none';
      }, 3000)
  }  
})
if(document.getElementsByClassName('d_xc_po')[0]){
    var t = document.getElementsByClassName('d_xc_po')[0];
    t.addEventListener('click', function(){

    })
}
</script>