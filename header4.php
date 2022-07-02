<?php 
require_once "connect.php";


?>
<!DOCTYPE html>
<html lang="en-ng">
<head>
<title>Sign Up / Log In - StudCo</title>
<meta charset="UTF-8">
<meta name="keywords" content="HTML, CSS,Javascript, PHP">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.botstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapix.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="student_connect.js" type="javascript">
</script>
<style>
   #navbar_list {
       list-style-type: none;
       margin: 0;
       padding: 0;
       overflow: hidden;
       background-color:#555;
   }
   #studco {
       float: left;
       width: 10%;
       font-size:30px;
   }
   #signup, #login {
       float:right;
       font-size:20px;
   }
   li#studco a {
       display:block;
       color:white;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#login a {
       display:block;
       color:green;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li#signup a {
       display:block;
       color:lightgreen;
       text-align: center;
       padding: 14px 16px;
       text-decoration: none;
   }
   li a:hover {
       background-color: black;
   }
   .active {
       background-color:green;
   }

</style>
</head>
<body>
<div class="navbar">
<ul id="navbar_list">
<li id="studco"><a href="/students_connect/home.php">StudCo</a></li>
<li id="signup"><a href="/students_connect/signup.php">Sign Up</a></li>
<li id="login"><a href="/students_connect/login.php">Login</a></li>
</ul>   
</div>

