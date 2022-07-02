<?php
require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
require_once "../../classes//months.php";
$a = queryMysql("SELECT * FROM members");
if (!$loggedin) die();
$usr = $_SESSION['user'];
$row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$usr'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
echo <<<_END
<style>
input, textarea, button {
     border: 1px solid #bebebe;
}
button:hover {
     background-color: skyblue;
     color: white;
}
</style>
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
if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../user.png'\")'; class='mypimg'></div></a></li>";
    $tmg = '../../user.png';
  }
  else{
  echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
    $tmg = '../../../students_connect_hidden/users_profile_upload/'.$row['user'].'/'.$row['user'].'.png';
  }
echo <<<_END
  </ul>   
  </div>
  <div class='pycl'>
  <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
_END;
  $user = $row['user'];
  $fname = $row['firstname'];
  $sname = $row['surname'];
  $mname = $row['middlename'];
  $email = $row['email'];
  $about = ($row['about']);
  $una = enc($user);
  if($row['pnumber'] == 0){
    $pnumber = "";
  }
  else {
    $pnumber = $row['pnumber'];
  }
  $inst = $row['institution'];
  $crse = $row['course'];
  $ml = $fl = $dd = "";
  if($row['sex'] == 1){
    $ml = 'checked';
  }
  elseif($row['sex'] == 2){
    $fl = 'checked';
  }
  elseif($row['sex'] == 3){
    $dd = 'checked';
  }
echo <<<_END
  <div class='wlbdy'>
  <div class='pfsec'>
  <div class='totsrs'>
  <div class='mktdsgn'>
  <div class='wsupngga xoper'>My Profile</div>
  <div class='towtbb altent'><a href='#primg'>Profile Image</a></div>
  <div class='tfonewis altent'><a href='#name'>Name</a></div>
  <div class='tsecwis altent'><a href='#dob'>Date of Birth</a></div>
  <div class='tthirwis altent'><a href='#contact'>Contact</a></div>
  <div class='tfrtwis altent'><a href='#others'>Others</a></div>
  <div class='mahrule'>
  <hr style='width: 80%'></div>
  <div class='stwsupngga xoper'><a href='/students_connect/settings/'>Settings</a></div>
  <div class='tsxtone altent'><a href='/students_connect/settings/updatepassword/'>Password</a></div>
  <div class='tsbthwas altent'><a href='/students_connect/settings/privacy'>Privacy Settings</a></div>
  <div class='tsvthone altent'><a href='/students_connect/settings/manage'>Block Users</a></div>
  <div class='tsvthone altent'><a href='/students_connect/settings/deactivate'>Deactivate Account</a></div>
  </div>
  </div>  
  <div class='tprtgetit'>
  <div class='wmsfgtit'>
  <div class='mnofthst'>Update Profile</div>
  <div class='fparler'>
  <div class='bfrchngimg'>
  <div class='ki tnmsmt' id='primg'>Profile Image</div>
  <div class='chpmig' style='background-image: url("$tmg")'>
  <div class='supx'>
  <a href='/students_connect/user_view.php'><i class='fas fa-pen tcpen'></i></a></div>
  </div>
  </div>
  <div class='cnmfrst'>
  <div class='tnmsmt' id='name'>Name</div>
  <div class='ualoths'>
  <div class='tufnme'><input type='text' id='fname' class='dnma' placeholder='Firstname' value='$fname'>
  </div>
  <div class='tusnme'>
  <input type='text' class='dnma' id='sname' placeholder='Surname' value='$sname'>
  </div>
  <div class='tumnme'>
  <input type='text' class='dnma' id='mname' placeholder='Middle Name' value='$mname'>
  </div>
  <div class='uall'>
  <button type='button' class='uallb'
   onclick='ename("$user", document.getElementById("fname").value, 
   document.getElementById("sname").value, document.getElementById("mname").value)'>
  Update</button>
  </div>
  </div>
  </div>
  <div class='cnmfrst'>
  <div class='tnmsmt' id='about'>About</div>
  <div class='ualoths'>
  <textarea id='tnma' style='
  height: 100px;  
  resize: none;
  width: 60%;' class='dnma' maxlength='150' rows='3'>$about</textarea>
  </div>
  <div class='uall'>
  <input type='hidden' value='$una'>
  <button type='button' class='uallb spuallb'>
  Update</button>
  </div>
  </div>
  <div class='chndob' id='dob'>
  <div class='tnmsmt'>Date of Birth</div>
  <div class='tuddob cch'>
  <div class='ddh'>
  <label for='day'>Day</label>
  </div>
  <select class='ssh' id='day'>
  _END;
  for($i = 1; $i< 32; $i++){
    $st = "";
    if($i == $row['bd_day']){
      $st = 'selected';
    }
    echo "<option value='".$i."' $st>".$i."</option>";
  }
  echo <<<_END
  </select>
  </div>
  <div class='tumdob cch'>
  <div class='ddh'>
  <label for='month'>Month</label>
  </div>
  <select class='ssh' id='month'>
  _END;
  $m = array(
    array('Jan', 'January'),
    array('Feb', 'February'),
    array('Mar', 'March'),
    array('Apr', 'April'),
    array('May', 'May'),
    array('Jun', 'June'),
    array('Jul', 'July'),
    array('Aug', 'August'),
    array('Sep', 'September'),
    array('Oct', 'October'),
    array('Nov', 'November'),
    array('Dec', 'December')
);
  for($x = 0; $x < 12; $x++){
    $st = "";
    if(ucfirst($row['bd_month']) == $m[$x][0]){
      $st = "selected";
    }
      echo '<option value="'.$m[$x][0].'" '.$st.'>'.$m[$x][1].'</option>';
  }
  echo <<<_END
  </select>
  </div>
  <div class='tuydob cch'>
  <div class='ddh'>
  <label for='year'>Year</label>
  </div>
  <select class='ssh' id='year'>
  _END;
    for($i = 1940; $i < (date('Y') -5); $i++){
      $st = "";
      if($i == $row['bd_year']){
        $st = 'selected';
      }
      echo '<option value="'.$i.'" '.$st.'>'.$i.'</option>';
    }
  echo <<<_END
  </select>
  </div>
  <div class='uall'>
  <button type='button' class='uallb'
  onclick='edob("$user", document.getElementById("day").value, 
  document.getElementById("month").value, document.getElementById("year").value)'>Update</button>
  </div>
  </div>
  <div class='chncont' id='contact'>
  <div class='tnmsmt'>Contact</div>
  <div class='temailon'>
  <div class='ddh cch'>
    <label for='email'>Email</div>
  </div>
  <div class='ptpemail'>
  <input type='email' value='$email' class='dnma' id='temail' placeholder='Email'>
  </div>
  </div>
  <div class='tnumberone'>
  <div class='ddh cch'>
    <label for='number'>Phone Number</div>
  <div class='ptpnumber'>
  <input type='text' value='$pnumber' id='tpnumber' class='dnma' placeholder='Phone Number'>
  </div>
  </div>
  </div>
  <div class='uall'>
  <button type='button' class='uallb' 
  onclick='econt("$user", document.getElementById("temail").value,
  document.getElementById("tpnumber").value)'>Update</button>
  </div>
  </div>
  <div class='dodoths' id='others'>
  <div class='tnmsmt'>Others</div>
_END;
/*
  "<div class='addinstu'>
  <div class='tlbfadinst cch'>Institution</div>
  <div class='addinststff'>
  <input type='text' class='dnma' id='inst' value='$inst' placeholder='Add Institution'>
  </div>
  </div>
  <div class='addcrse'>
  <div class='tlbfadinst cch'>Course of Study</div>
  <div class='addcssfstff'>
  <input type='text' class='dnma' id='course' value='$crse' placeholder='Add Course of Study'>
  </div>
  </div>"*/
echo <<<_END
  <div class='chgsx'>
  <div class='chngxs cch'>Sex</div>
  <div class='sysx'>
  <input type='radio' id='male' name='tsx' value='1' $ml>
  <label for='male'>Male</label>
  <input type='radio' id='female' name='tsx' value='2' $fl>
  <label for='female'>Female</label>
  <input type='radio' id='ddndis' name='tsx' value='3' $dd>
  <label for='ddndis'>Prefer not to disclose</label>
  </div>
  <div class='uall'>
  <button type='button' class='uallb' 
  onclick='eoth("$user", 
  "", "")'>Update</button>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
_END;
if(isset($_POST['fname']) && isset($_POST['sname'])){
  $user = $row['user'];
  $fname= $_POST['fname'];
  $sname = $_POST['sname'];
  $mname = $_POST['mname'];
  queryMysql('UPDATE members SET firstname="'.$fname.'", surname="'.$sname.'", 
        middlename="'.$mname.'" WHERE user="'.$user.'"');
}
if(isset($_POST['day']) && isset($_POST['month'])){
  $user = $row['user'];
  $day = $_POST['day'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  queryMysql("UPDATE members SET bd_day='".$day."', bd_month='".$month."',
   bd_year='".$year."' WHERE user='".$user."'");
}
if(isset($_POST['email']) && isset($_POST['number'])){
  $user= $row['user'];
  $email = sanitizeString($_POST['email']);
  $number = sanitizeString($_POST['number']);
  queryMysql("UPDATE members SET email='".$email."', pnumber='".$number."' 
      WHERE user='".$user."'");
}
if(isset($_POST['inst']) && isset($_POST['course'])){
  $user = $row['user'];
  $inst = sanitizeString($_POST['inst']);
  $course = sanitizeString($_POST['course']);
  $sex = $_POST['sex'];
  queryMysql("UPDATE members SET institution='".$inst."', course='".$course."'
  , sex='".$sex."' WHERE user='".$user."'");
}
if(isset($_POST['about'])){
  $user = $row['user'];
  $about = sanitizeString($_POST['about']);
  queryMysql("UPDATE members SET about='$about' WHERE user='$user'");
}
?>
<script>
  var iks = document.getElementsByTagName('IMG');
  console.log(iks.length);
  for(var x = 0; x < iks.length; x++){
    var mn = document.getElementsByTagName('IMG')[x];
    mn.onclick = function(){
    var y = this.src;
    var z = document.getElementById('thimgv');
    var q = z.innerHTML;
    if(q.includes('img')){
      document.getElementsByClassName('imgsmall')[0].src = y;
    document.getElementsByClassName('timgbsys')[0].style.display = 'block';
    document.getElementsByClassName('imgsmall')[0].onload = function(){
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('imgsmall')[0].onerror = function(){
      document.getElementById('timgerror').innerHTML = 'Error Loading Picture';
      document.getElementById('plding').style.display = 'none';
    }
  }
    else {
    var a = document.createElement('IMG');
    a.className= 'imgsmall';
    a.src = y;
    document.getElementById('plding').style.display = 'block';
    z.append(a);
    document.getElementsByClassName('imgsmall')[0].onload = function(){
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('imgsmall')[0].onerror = function(){
      document.getElementById('timgerror').innerHTML = 'Error Loading Picture';
      document.getElementById('plding').style.display = 'none';
    }
    document.getElementsByClassName('timgbsys')[0].style.display = 'block';
  }
  }
  }
  var mod = document.getElementById('thimgv');
  window.onclick = function(event) {
    if (event.target == mod) {
      document.getElementsByClassName('timgbsys')[0].style.display = 'none';
    }
}
var cl = document.getElementById('clview');
cl.onclick = function(){
  document.getElementsByClassName('timgbsys')[0].style.display = 'none';
}
document.getElementsByClassName('spuallb')[0].onclick = function(){
  var about = document.getElementById('tnma').value;
  var xmlhttp = new XMLHttpRequest();
  var qx = document.createElement('div');
        qx.className = 'savewcap';
        qx.style.position = 'fixed';
        qx.style.bottom = '0';
        qx.style.width = '100%';
        qx.style.minHeight = '40px';
        qx.style.border = '1px solid #bebebe';
        qx.style.backgroundColor = 'black';
        qx.style.color = 'white';
        qx.style.padding = '6px';
        qx.style.paddingLeft = '15px';
        qx.innerHTML = 'Updating...';
        qx.style.fontSize = '17px';
        document.body.append(qx);
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      qx.innerHTML = 'Updated.';
        setTimeout(function(){
          qx.style.display = 'none';
        }, 1500);
    }
};
xmlhttp.onerror = function(){
  qx.innerHTML = 'Failed to update.';
  setTimeout(function(){
    qx.style.display = 'none';
  }, 1500);
}
xmlhttp.open('POST', '/students_connect/profile/fprofile/index.php');
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("about="+encodeURIComponent(about));
}
</script>
</body></html>
