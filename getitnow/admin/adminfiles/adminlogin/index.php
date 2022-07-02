<?php
error_reporting(E_WARNING | E_ERROR);
session_start();
require_once "../adminfunc.php";  
    if(isset($_POST['email']) && isset($_POST['password'])){
         $email= sanitizeString($_POST['email']);
        $password = sanitizeString($_POST['password']);
        //check if email and password exist in database
        $ch= queryMysql("SELECT * FROM studentsconnectadmin WHERE email='$email' AND password='$password'");
        if($ch->num_rows == 0 ){
            $error = "Non Authorized User";
        }
        else {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            die('<script>
            function Redirect() {
                window.location="../admindashboard/";
            }
            setTimeout("Redirect()", 10)</script>');
            
        }
    }
?>
<head>
<style>
    input[type=text], input[type=password] {
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 1px solid black;
        box-sizing: border-box;
        width: 300px;
        outline: none;
}
</style>
</head>
<body>
<form method='post' action='index.php' autocomplete='off'><?php echo $error ?>
    <label for='email'></label>
    <input type='text' name='email' value='<?php $email ?>' placeholder='Email Address'><br><br>
    <label for='password'></label>
    <input type='password' name='password' value='<?php $password ?>' placeholder='Password'>
    <br><br>      <button type="submit" class="submit_reg2" name="submit_reg" id="submit_regid">Log In</button>
</form>