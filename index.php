<?php
require_once "header.php";
if(!$loggedin){
echo <<<_END
<div class='h_c'>
<div class='be_c'>
<div id='ho_w'>Studco</div>
</div>
<div class='hlgn'>
<div class='tlbx'>
<div class='mtc'>
<div class='lgtit'>Login</div>
<div id='err' style='color: red; font-size: 13px;
 padding: 4px; padding-left: 7px;'></div>
<div class='usrnmtbx mgar'><input id='usr' class='utbx tbx' type='text' name='user'
 autocomplete='off' placeholder='Username'></div>
<div class='pswdtbx mgar'><input id='pwd' type='password' class='ptbx tbx' name='password' placeholder='Password'></div>
<div class='lgnsbbx'><button class='hsbmt'
 onclick='login(document.getElementById("usr").value,document.getElementById("pwd").value)'>Login</button></div>
</div></div>
</div>
</div>
_END;
}
else {
  echo <<<_END
  <script>
            function Redirect() {
                window.location='profile.php';
            }
            setTimeout('Redirect()', 1)</script>

_END;
          }
?>