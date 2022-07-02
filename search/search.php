<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['search'])){
        if(!empty($_GET['search'])){
            $search = sanitizeString($_GET['search']);
            $user = $_GET['user'];
            if(strpos($search, '@') !== FALSE){
              $search = substr($search, 1);
            }
            $xyz = queryMysql("SELECT * FROM members WHERE (user LIKE '%$search%' OR
            firstname LIKE '%$search%' OR surname LIKE '%$search%' OR middlename LIKE '%$search%' OR
             email LIKE '%$search%' OR pnumber LIKE '%$search%' OR CONCAT(firstname, ' ', surname) 
             LIKE '%$search%' OR CONCAT(surname,' ', firstname) 
             LIKE '%$search%')  AND user!='$user' LIMIT 5");
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
           <div class=''>
           <a href='/students_connect/user/".$gex['user']."'>
           <div class='xsrchrs wiiie'>
           <div class='tseuspic' style='background-image:url(\"".$usimg."\");'></div>
           <div class='s_rm_two'>
           <div class='shwmethsrrst'>".$gex['surname']." ".$gex['firstname']."</div>
           <div class='S_mn_urs'><i class='fas fa-at'></i>".$gex['user']."</div>
           </div></div>
           </a>
           <script>
           function src(){
           var search = document.getElementById('evsrch').value;
  var user = document.getElementById('idde').value;
  var sp = document.getElementById('evsrch').value;
  if(search.includes('#') == true){
    search = search.replace(/#/g, '%23');
  }
  if(search.includes('&') == true){
    search = search.replace(/&/g, '%26');
  }
  if(search == null || search == '' || search == ' ' || search == '  '){
    document.getElementById('sbx').style.border = 'none';
    document.getElementById('rfsearch').innerHTML = '';
  }
  else {
    if((search.indexOf('p') !== 0) && (search.indexOf('\\\') !== 1)){
      document.getElementsByClassName('converttps')[0].style.display = 'block';
      document.getElementsByClassName('converttps')[0].innerHTML = 'Change to Post Search';
    }
  }
           $('.searchresult').ready(function(){
            $.ajax({
              url:'search.php?user='+user+'&search='+search,
              method:'GET',
              success:function(data){
                $('.tsearches').html(data);
              }
            })
            })
          }
           </script>
           <div class='iinss_rt' onclick='document.getElementById(\"evsrch\").value = this.parentElement.children[0].children[0].children[1].children[0].innerHTML; src()'><i class='fas fa-arrow-up' style='float: right; top: -40px; position: relative; padding-right: 10px;'></i></div>
           </div>";
    }
}
           }
}
    }
else {

}
?>
