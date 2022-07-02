<?php
require_once 'header.php';
require_once 'connect.php';
if(!$loggedin){
echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        O('info').innerHTML = ''
        return
      }

      params  = "user=" + user.value
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length", params.length)
      request.setRequestHeader("Connection", "close")

      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              O('info').innerHTML = this.responseText
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }

  function checkEmail(email)
    {
      if (email.value == '')
      {
        O('info').innerHTML = ''
        return
      }

      params  = "email=" + email.value
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length", params.length)
      request.setRequestHeader("Connection", "close")

      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              O('info').innerHTML = this.responseText
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }
  </script>

_END;
$error = $user = $pass = "";
if (isset($_POST['user']) && !empty($_POST['user'])
AND isset($_POST['firstname']) && !empty($_POST['firstname']) AND 
isset($_POST['surname']) && !empty($_POST['surname']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pass']) && !empty($_POST['pass']))
{
  $ipaddress= $_SERVER['REMOTE_ADDR'];  
  $loginip;
  $datetimeofcreation = date("Y-m-d H:i:s");
  $lastlogin = 0;
  $loginexpire = 0;
  $lastlogout = 0;
  $aboutdate = 0;
  $activatetime = time();
  $activatexpiretime = $activatetime + (1800);
  $user = sanitizeString($_POST['user']);
  $firstname = sanitizeString($_POST['firstname']);
  $surname = sanitizeString($_POST['surname']);
  $middlename = sanitizeString($_POST['middlename']);
  $pass = sanitizeString($_POST['pass']);
  $email = sanitizeString($_POST['email']);
  $pnumber = sanitizeString($_POST['pnumber']);
  $bd_day = sanitizeString($_POST['bd_day']);
  $bd_month = sanitizeString($_POST['bd_month']);
  $bd_year = sanitizeString($_POST['bd_year']);
  $course = "";
  $sex = sanitizeString($_POST['sex']);
  $institution = "";
  $status = sanitizeString($_POST['status']);
  $group1 = 0;
  $country = sanitizeString($_POST['country']);
  $datetimeofcreation = sanitizeString($_POST['datetimeofcreation']);
  $browser = sanitizeString($_POST['browsertype']);
  $devicetype = sanitizeString($_POST['devicetype']);
  $active = 0;
  $about = sanitizeString($_POST['about']);
  $userprofilecode = sanitizeString($_POST['userprofilecode']);
  $psdhd=0;
  $id = 0;
  $fgtpasscode = 0;
  $interests = 0;
  $loginip = 0;
  if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
    $error = "<span class='error'>Invalid Email address entered</span>";
  }
  $hash =md5(rand(0,1000));
  $verifycode = rand(100000, 999000);
  $userprofilecode = md5(rand(0,1000));
  $lastactivitytime = 0;

  $username = queryMySQL("SELECT * FROM members WHERE user='$user'");
  $ch_email = queryMySQL("SELECT * FROM members WHERE email='$email'");
  if ($username->num_rows)
        $error = "<span class='error'>That username already exists</span><br><br>";
  elseif($ch_email ->num_rows){
    $error = "<span class='error'>The email address already exists</span>";
  }
  elseif($username ->num_rows AND $ch_email ->num_rows){
    $error = "<span class='error'>The username or email address already exists</span>";
  }
      else
{
    $datetimeofcreation=date('Y-m-d H:i:s');
  queryMySQL("INSERT INTO members VALUES('$id', '$firstname', '$surname', '$middlename','$email', 
  '$pnumber'='0', '$user' ,'$pass', '$bd_day', '$bd_month' , '$bd_year' , 
  '$institution', '$status', '$course' , '$group1'='1', 
  '$sex', '$hash','$verifycode', '$country', '$ipaddress','$loginip' , '$datetimeofcreation',
   '$browser'=NULL, '$devicetype'=NULL, '$active', '$activatetime', '$activatexpiretime',
    '$lastactivitytime', '$lastlogin','$lastlogout' , '$about' , '$aboutdate',
     '$userprofilecode', '$psdhd', '$fgtpasscode', '$interests')");
    $memb = fopen("../students_connect_hidden/list/members.xml", 'a');
    $usr = $user."\n";
    fwrite($memb, $usr);
    fclose($memb);
  ini_set('SMTP', 'ssl://smtp.gmail.com');
  ini_set('smtp_port', 465);
  ini_set('auth', TRUE);
  ini_set('username', 'wilayakintade@gmail.com');
  ini_set('password', 'ibunkunoluwa');

  $to = $email;
  $subject = 'Studco - Signup | Verification';
  $message = '
  Hello $user!  
  Thanks for signing up with StudCo.

  Please click the link to activate your account:
  http://localhost:8080/students_connect/verify.php?email='.$email.'&hash='.$hash.' <br> OR <br> Use the code below ' .$verifycode. '.';
  $headers = 'From:wilayakintade@gmail.com' . "\r\n";
  
  $sent = mail($to, $subject, $message, $headers);

    
   if(isset($_GET['code']) && !empty($_GET['code'])){
    $verifycode = sanitizeString($_GET['code']);
    $search = queryMysql("SELECT  verifycode, active FROM members WHERE verifycode='".$verifycode."' AND active='0'");
    $match = $search ->num_rows;

if($match > 0){
    queryMysql("UPDATE members SET active='1' WHERE verifycode='".$verifycode."' AND active='0'");
    echo "Account has been activated";
}
else {
    echo "Failed";
}
  }
else {
    echo "Failed";
}

  $check_code = queryMysql('SELECT verifycode FROM members WHERE verifycode="$verifycode"');
  if(!$check_code ->num_rows){
      $verify_error = '<span class="error">Verification code not valid</span>';
  }
  die(
    $message . "<?php

  echo '<div class='verification'>
  <div class='verification_container'>
  <form method='GET' action='verifybycode.php?code='.$verifycode>
  <div class='verification_input_area'>
  <input type='text' name='code' placeholder='Enter Verification Code' size='6' id='code_box' required>
  </div>
  <div class='submit'>
<button type='submit' class='submit_reg'id='submit_regid'>Sign Up</button>
</div>
</form>
  </div></div>'
  ");

}
}




$year = Date("Y");
echo <<<_END
<script>
window.onload = function(){
  var input = document.getElementById('inttxt').focus();
}
</script>
<div class="bx_ded">
<div class="whole_body below_nav">
<div class="body_1">
<h1 id="heading1" class='xfm_Hd'>Studco | Signup</h1>
<p class='ba_s_p'>The basic and simple process</p>
</div>
<div class="body_2">
<div class="reg-form">
<form method="post" action="signup.php" autocomplete="off" onsubmit = "validate();">$error
<div class="input_area">
<div class="name-inputtext">
<div class='is_errx'></div>
<div class='inpx1'>
<input type="text" class="inputtext" id='inttxt' spellcheck="false" name="firstname" placeholder="First Name" min="2" max="16" title="Input your name" required="true">
</div>
</div><div class="name-inputtext">
<input type="hidden" name="middlename">
<div class='inpx2'>
<input type="text" class="inputtext" spellcheck="false" name="surname" placeholder="Surname" required="true" min="2" max="16" title="Input your name">
</div>
</div>
<div class="email">
<div class='is_emer'></div>
<div class='inpx3'>
<input type="email" class="inputtext_email" spellcheck="false" name="email" placeholder="Email Address" title="Input your email address" required="true">
</div>
</div>
<div class="pn" style="display:none">
<input type="hidden" name="pnumber">
</div>
<div class="username-inputtext">
<div id='thiserr'></div>
<div id='thiserr2' style='font-size: 12px; color: red;'></div>
<div class='inpx4'>
<input type="text" class="inputtext_username" spellcheck="false" name="user" placeholder="Choose Username" min="5" max="18" title="Input your username" required="true"><span id='info'></span>
</div>
<div class='user_suggestion'></div>
</div>
<div class="pass-inputtext">
<div id='xerror'></div>
<div class='inpx5'>
<input type="password" id="ypass" spellcheck="false" class="inputtext_password" name="pass" placeholder="Password" min="6" max="15" required="true" title="Input your password">
<button type="button" id="showPassword"><i class="far fa-eye-slash" onclick="showPass()" aria-hidden="true"></i></button>
<button type="button" id="showPassword1"><i class="far fa-eye" onclick="showPass()" aria-hidden="true" display="none"></i></button>
</div></div>
<div class='al_b_bir'>
<div class="birthday">Birthday</div>
<div id='derror'></div>
<div class='bd all_bd'>
<div class="choose_day">
<select name="bd_day" id="day" title="Day" class="bd_day" value="bd_day" required>
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select> 
<select name="bd_month" id="month" title="Month" class="bd_month" value="bd_month" required>
<option value="month">Month</option>
<option value="jan" selected>Jan</option>
<option value="feb">Feb</option>
<option value="mar">Mar</option>
<option value="apr">Apr</option>
<option value="may">May</option>
<option value="jun">Jun</option>
<option value="jul">Jul</option>
<option value="aug">Aug</option>
<option value="sept">Sep</option>
<option value="oct">Oct</option>
<option value="nov">Nov</option>
<option value="dec">Dec</option>
</select>
<select name="bd_year" id="year" title="Year" class="bd_year" value="bd_year" required>
<option value="0">Year</option>
_END;
for($i = 1940; $i < (date('Y') -10); $i++){
  $st = "";
  if($i == 2000){
    $st = 'selected';
  }
  echo '<option value="'.$i.'" '.$st.'>'.$i.'</option>';
}
echo <<<_END
</select>
</div>
</div>
</div>
<div class='alins' id="alins">
<div class="institution">Institution</div>
<div class="choose_institution">
<select name="institution" onchange='nas()' id="institution" title="Institution" class="choose_institution1">
<option value="Cho_in" selected>Choose Institution</option>
<option value='nas'>Not a Student</option>
<option value="UI">University of Ibadan</option>
<option value="OAU">Obafemi Awolowo University</option>
<option value="UNILAG">University of Lagos</option>
<option value="UIL">University of Ilorin</option>
</select>
</div></div>
<div class='instst'>
<div class="institution_status">Status <i class='fas fa-question-circle xmap'></i></div>
<div class="choose_in_status">
<input type="radio" class="in_status" name="status" value="1" id="status_1" title="Are you a student?" required>
<label class="student" for="status_1">Student</label>
<input type="radio" class="in_status" name="status" value="2" id="status_2" title="Are you an aspiring student?" required>
<label class="aspiring" for="status_2">Aspiring</label>
<input type="radio" class="in_status" name="status" value="3" id="status_3" title="Not a student?" required>
<label class="aspiring" for="status_3">Not a student</label>
</div></div>
<div class="alco">
<div class="course">Course</div>
<div class="choose_course">
<select name="course" id="course" title="Course" class="choose_course1">
<option value='nas'>Not a Student</option>
<option value="acct">Accountancy</option>
<option value="law">Law</option>
<option value="mbbs">Medicine and Surgery</option>
<option value="csm">Commputer Science with Maths</option>
<option value="cse">Commputer Science with Economics</option>
<option value="phm">Pharmacy</option>
</select> 
</div></div>
<div class='xyz_yz'>
<div class="gender">Gender</div>
<div class="choose_gender">
<input type="radio" class="gender" name="sex" value="1" id="gender_1" required>
<label class="male" for="gender_1">Male</label>
<input type="radio" class="gender" name="sex" value="2" id="gender_2" required>
<label class="female" for="gender_2">Female</label>
</div>
</div>
<input type="hidden" name="country">
<input type="hidden" name="browsertype">
<input type="hidden" name="datetimeofcreation">
<input type="hidden" name="timestamp">
<input type="hidden" name="devicetype"> 
<input type="hidden" name="lastlogin">
<input type="hidden" name="about">
<input type="hidden" name="aboutdate">
<input type="hidden" name="image">
<input type="hidden" name="darkmode">
<input type="hidden" name="userprofilecode"><div class="submit">
<div class='bag_sup'>
By signing up, you are agreeing to our <a href='/students_connect/terms?ref=signup' target='_blank'>terms and conditions</a>
</div>
<button type="submit" class="submit_reg" name="submit_reg" id="submit_regid">Sign Up</button>
</div>
</form>
</div></div></div>
<hr id='ofF_hr' style='width: 90%; margin: auto'>
</div>
<footer class='ffooter' style='bottom: 0; position: relative;'>
<div class='ffooterb'>
<div class='help'><a href=''>Help</a></div>
<div class='stngs'><a href=''>Settings</a></div>
<div class='pvcy'><a href=''>Privacy</a></div>
<div class='logn'><a href='/students_connect/login.php'>Login</a></div>
</div>
<div class='ffooterx'>
<div class='sinoff'><a href='/students_connect/'>Quest</a> <span style='font-size: 15px;'>&copy;</span>$year</div>
</div>
</div>
          </footer>
</div>
</div>
<script>
var ed = document.getElementsByClassName('inputtext_username')[0];
ed.addEventListener('blur', function(){
  var oo = this;
  var w = this.value;
  var nm = document.getElementsByClassName('inputtext')[0].value;
  var ln = document.getElementsByClassName('inputtext')[1].value;  
  $.ajax({
      url: '/students_connect/check.php',
      type: 'post',
      data: 'w='+w+'&fn='+nm+'&ln='+ln,
      success: function(rep){
        document.getElementsByClassName('user_suggestion')[0].innerHTML = '';
        if(rep.length > 0){
        document.getElementsByClassName('user_suggestion')[0].innerHTML = "<div class='is_errr'>Username already exists</div>"
        var r = JSON.parse(rep);
        for(var i = 0; i < r.length; i++){
            var mi = document.createElement('div');
            mi.className = 'c_guessed';   
            mi.innerHTML = r[i];
            document.getElementsByClassName('user_suggestion')[0].append(mi);
            mi.onclick = function(){
              console.log(this.innerHTML)
              oo.value = this.innerHTML;
            }
          }
      }
      }
    })
    var y = this.value;
  if(y.includes(' ') == true){
    document.getElementsByClassName('inputtext_username')[0].value = document.getElementsByClassName('inputtext_username')[0].value.replace(/ /g, '_')
  }
  if(y.length > 18){
    document.getElementById('thiserr2').innerHTML = 'Reduce username length!';
  }
  else {
    document.getElementById('thiserr2').innerHTML = '';
  }
  var normal = /^[a-zA-Z0-9_]*$/
  var x = normal.test(this.value);
  if(x == false){
    document.getElementById('thiserr').innerHTML = "<div class='error'>Username contains invalid characters</div>";
  }
  else {
    document.getElementById('thiserr').innerHTML = "";
  }
})
ed.addEventListener('input', function(){
  var y = this.value;
  if(y.includes(' ') == true){
    document.getElementsByClassName('inputtext_username')[0].value = document.getElementsByClassName('inputtext_username')[0].value.replace(/ /g, '_')
  }
  if(y.length > 18){
    document.getElementById('thiserr2').innerHTML = 'Reduce username length!';
  }
  else {
    document.getElementById('thiserr2').innerHTML = '';
  }
  var normal = /^[a-zA-Z0-9_]*$/
  var x = normal.test(this.value);
  if(x == false){
    document.getElementById('thiserr').innerHTML = "<div class='error'>Username contains invalid characters</div>";
  }
  else {
    document.getElementById('thiserr').innerHTML = "";
  }
})
function mch(t, v){
    $.ajax({
      url: '/students_connect/check.php',
      type: 'post',
      data: t+'='+v,
      success: function(r){
        if(t == 'e' && r == '0'){
          document.getElementsByClassName('is_emer')[0].innerHTML = 'Email has been used by another user';
        }
        else if(t == 'e' && r == '1'){
          document.getElementsByClassName('is_emer')[0].innerHTML = '';
        }
        return r;
      }
    })
}
document.getElementsByClassName('inputtext_email')[0].addEventListener('blur', function(){
  mch('e', this.value)
});
var xform = document.getElementsByTagName('FORM')[0];
xform.onsubmit = function(){
  var g2g = {
    'firstname':0,
    'email':0,
    'username':0,
    'password':0,
    'birthday':0,
    'status':0,
    'gender':0,
  }
  var mnhs = {
    "jan":"31",
    "feb":"29",
    "mar":"31",
    "apr":"30",
    "may":"31",
    "jun":"30",
    "jul":"31",
    "aug":"31",
    "sep":"30",
    "oct":"31",
    "nov":"30",
    "dec":"30"
  }
  var d = document.getElementById('day').value;
  var e = document.getElementById('month').value;
  var f = document.getElementsByClassName('inputtext_username')[0].value;
  var g = document.getElementsByClassName('inputtext_password')[0].value;
  var t = document.getElementsByClassName('inputtext_email')[0].value;
  var f =   document.getElementsByClassName('inputtext')[0].value;
  if(mch('e', t) == 0){
    document.write('a')
    g2g.email = 0;
  }
  else {
    g2g.email = 1;
  }
  if(mch('u', f) == 0){
    g2g.username = 0;
  }
  else {
    g2g.username = 1;
  }
  if(parseInt(d) > parseInt(mnhs[e])){
      document.getElementById('derror').innerHTML = '<div class="error">Day of birth exceeds days in month.</div>';
      g2g.birthday = 0;
    }
    else {
      document.getElementById('derror').innerHTML = '';
      g2g.birthday = 1;
    }
    var f = document.getElementsByClassName('inputtext_username')[0].value;
    if(f.length < 6){
      document.getElementById('thiserr').innerHTML = '<div class="error">Username shouldn\'t be less than 6 characters.</div>'
    }
    else {
      document.getElementById('thiserr').innerHTML = '';
    }
    if(g.length < 8){
      g2g.password = 0;
      document.getElementById('xerror').innerHTML = '<div class="error">Password shouldn\'t be less than 8 characters.</div>'
    }
    else {
      g2g.password = 1;
      document.getElementById('xerror').innerHTML = '';
    }
    if(f.length>0){
      g2g.firstname = 1;
    }
    else {
      document.getElementsByClassName('is_errx')[0].innerHTML = 'Fill in your firstname';
      g2g.firstname = 0;
    }
    console.log(g2g);
    if(g2g.firstname == 1 && g2g.email == 1 && g2g.username == 1 && g2g.password == 1 && g2g.birthday == 1){
      return true;
    }
    else {
      return false;
    }
}
document.getElementsByClassName('xamp')[0].addEventListener('click', function(){
    console.log('clicked');
})
</script>
</body></html>
_END;
}
else {
header("Location:profile.php");
exit;
}
?>