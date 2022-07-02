<?php
//cc-create content->Akintade Ayomikun Williams
 require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
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
     <div onload="checkDark();" class="dark-mode" id='darkmd' style="min-height:650px;">
   _END;
   if(isset($_GET['p']) && isset($_GET['t'])){
    $id = sanitizeString($_GET['p']);
    $t = sanitizeString($_GET['t']);
    $type = $t == 0 ? 'eduposts' : 'socposts';
    $sp = queryMysql("SELECT * FROM $type WHERE id='$id' AND user='".$row['user']."'");
    if($sp->num_rows){
      
    }
   }