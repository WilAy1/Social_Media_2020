<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'header4.php';
require_once 'connect.php';
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
  </script>

_END;
$error = $user = $pass = "";
  if (isset($_SESSION['user'])) destroySession();

// username and password
$error = $user = $pass ="";
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']))
{
  $user = sanitizeString($_POST['user']);
  $firstname = sanitizeString($_POST['firstname']);
  $surname = sanitizeString($_POST['surname']);
  $pass = sanitizeString($_POST['pass']);
  $email = sanitizeString($_POST['email']);
  $bd_day = sanitizeString($_POST['bd_day']);
  $bd_month = sanitizeString($_POST['bd_month']);
  $bd_year = sanitizeString($_POST['bd_year']);
  $course = sanitizeString($_POST['course']);
  $sex = sanitizeString($_POST['sex']);
  


  if ($user == "" || $firstname == "" || $surname == ""  || $pass == "" ||  $email == "" || $course =="" || $sex=="")
  $error = "Input Available Fields<br><br>";
  else

  $result = queryMySQL("SELECT * FROM members WHERE user='$user'");

  if ($result-> user)
        $error = "That username already exists<br><br>";
      else
{
  queryMySQL("INSERT INTO members VALUES('$firstname', '$surname', '$email', '$user' ,'$pass', '$bd_day', '$bd_month' , '$bd_year' , '$course' , '$sex')");
  die('$_SESSION["user"] = $user;
  $_SESSION["pass"] = $pass;
  die("<script>
  function Redirect() {
      window.location="profile.php";
  }
  setTimeout("Redirect()", 1)</script>");');

}
}


echo <<<_END
<br>
<div class="whole_body">
<div class="body_1">
<h1 id="heading1">StudCo</h1>
<p>Join StudCo Today. Your experience will be awesome.</p>
<div class="login">
<h2 id="login_1">Login</h2>

<form method='post' action='login.php'>$error
    <label class='fieldname'>Username: </label><input type='text'
      maxlength='40' class="inputtext1" name='user' value='$user' autocomplete="true" required="true" title="Username" placeholder="Username"><br><br>
    <label class='fieldname'> Password: </label> <input type='password'
      maxlength='100' class="inputtext1" name='pass' value='$pass' required title="Password" placeholder="Password"><br>
      <br>
      <div class="login_submit_button">
      <button type="submit" class="submit_reg2" name="submit_reg" id="submit_regid">Log In</button>
      </div>
      </form>
          </div>
          </div>
<div class="body_2">
<div class="reg-form">
<form method="post" action="signup.php"> 
<div class="input_area">
<div class="name-inputtext">
<input type="text" class="inputtext" name="firstname" placeholder="First Name" required="true" value="$firstname">
<input type="text" class="inputtext" name="surname" placeholder="Surname" required="true" value="$surname">
</div><br>
<div class="email">
<input type="email" class="inputtext_email" name="email" value="$email" placeholder="Email Address" required="true"><br>
</div>
<div class="username-inputtext"><br>
<input type="text" class="inputtext_username" name="user" value="$user" placeholder="Choose Username" required="true">
</div><br>
<div input name="pass-inputtext">
<input type="password" class="inputtext_password" name="pass" placeholder="New Password" value="$pass" required="true">
</div><br>
<div class="birthday">Birthday</div>
<div class="choose_day">
<select name="bd_day" id="day" title="Day" class="bd_day" value="bd_day" required>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
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
<option value="2020">2020</option>
<option value="2019">2019</option>
<option value="2018">2018</option>
<option value="2017">2017</option>
<option value="2016">2016</option>
<option value="2015">2015</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000" selected>2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
</select>
</div><br>
<div class="course">Course</div>
<div class="choose_course">
<select name="course" id="course" title="Course" class="choose_course1">
<option value="acct">Accountancy</option>
<option value="law">Law</option>
<option value="mbbs">Medicine and Surgery</option>
</select><div class="join_group">
<input type="radio" class="group_add" name="group" value="group" id="join_group">
<label id="join_group">Do you wish to join the general course group</p>
</div> 
</div>
<div class="gender">Gender</div>
<input type="radio" class="gender" name="sex" value="1" id="gender_1" required>
<label class="male" for="gender_1">Male</label>
<input type="radio" class="gender" name="sex" value="2" id="gender_2" required>
<label class="female" for="gender_2">Female</label>
</div>
</div>
<div class="submit"><br>
<button type="submit" class="submit_reg" name="submit_reg" id="submit_regid">Sign Up</button>
</form>
</div>
</div>

</div>


<br><br<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><hr>   
</body></html>
_END;
$error = $user = $pass = "";

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if ($user == "" || $pass == "")
    $error = "Input all fields<br>";
    else 
    {
        $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

        if ($result->num_rows == 0)
        {
            $error = "Invalid username/password";
        }
        else {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("<script>
            function Redirect() {
                window.location='profile.php';
            }
            setTimeout('Redirect()', 1)</script>");
        }
        }
    }


?>

 