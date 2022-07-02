<?php
define("X", "C:/Apache24/htdocs/students_connect");
require_once X."/Users/wilay/students_connect/connect.php";
require_once X."../header.php";
$year = date("Y");
echo <<<_END
<div class='fbdy' style='width: 99%;'>
<div class='cnme'><a href='/students_connect/'>Studco</a></div>
<div class='alwp'>
<div class='fryp'>Forgotten Your Password?</div>
</div>
<div class='fmwp'>
<div class='error'></div>
<div class='fgtpasslb'>
<label for='email'>Email, username or mobile number:</label></div>
<div class='fgtpassin'>
<input type='text' autocomplete='off' autofocus name='email' id='forgotinput' class='frgplc inputtext1'>
</div>
<div class='fgtpasssb'>
<a href='/students_connect/login.php'>
<button type='button' class='btnfcan hih'>Login</button></a>
<button type='button' 
onclick='dontmove(document.getElementById("forgotinput").value)' id='submitbtn' class='subthefor hih'>Submit</button>
</div>
<div class='canac'>
Can't remember any of these? <a href='/students_connect/signup.php'>Create a new account</a></div>
</div>
</div>
<div class='ffooter'>
<div class='ffooterb'>
<div class='help'><a href=''>Help</a></div>
<div class='stngs'><a href=''>Settings</a></div>
<div class='pvcy'><a href=''>Privacy</a></div>
<div class='logn'><a href='/students_connect/login.php'>Login</a></div>
<div class='siup'><a href='/students_connect/signup.php'>Sign Up</a></div>
</div>
<div class='ffooterx'>
<div class='sinoff'><a href='/students_connect/'>Quest</a> <span style='font-size: 15px;'>&copy;</span>$year</div>
</div>
</div>
_END;
?>
</body>
</html>