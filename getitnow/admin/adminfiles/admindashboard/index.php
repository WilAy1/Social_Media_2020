<?php
session_start();
require_once "../adminfunc.php";
if (isset($_SESSION['email']))
{
  $email     = $_SESSION['email'];
  $loggedin = TRUE;
}
else { $loggedin = FALSE;}
if($loggedin) {
$row = mysqli_fetch_array(queryMysql("SELECT * FROM studentsconnectadmin WHERE email='$email'"));
$f = $row['fullname'];
echo <<<_END
<!DOCTYPE html>
<html><head>
<title>StudCo - ADMIN</title>
<style>
.hd {
    font-size: 25px;
    font-weight: bold;
    padding: 14px;
    color: darkgreen;
}
.wl {
    float: right;
    font-size: 25px;
}
</style>
</head>
<body>
_END;
echo "<div class='pg'><div class='adp'>Admin Page</div>";
echo <<<ADMIN
    <div class='wl'>Welcome Back,<br/> 
ADMIN;
echo $f."</div>";
$mem = mysqli_num_rows(queryMysql("SELECT * FROM members"));    
echo "<div class='cnm hd'>Number of Members</div><div class='lnm'>";
echo $mem ." Members</div>";
echo "<div class='spmtb hd'>Spam Table</div><br/>";
$spm = (queryMysql("SELECT * FROM spamlist"));
if($spm ->num_rows == 0){
    echo "<div class='ncr hd'>No Current Spam Report</div>";
}
else {
    echo "<style>
    table {
        border-collapse: collapse;
        width: 100%;

    }
    
    th, td {
        text-align: left;
        vertical-align: initial;
        padding: 5px;
    }
    th {
        width: 10%;
    }
    tr:nth-child(even){background-color: #f2f2f2}
    
    th {
        background-color: #4CAF50;
        color: white;
    }
    </style><div class='spmtb'><table style='width: 100%'><tr><th>User</th>
    <th>Reported User</th><th>Type of Spam</th><th>Description</th></tr>";
    while($result = mysqli_fetch_array($spm)){
    echo "<tr><td>".$result['user']."</td>
    <td>".$result['reporteduser']."</td><td>
    ".$result['typeofspam']."</td><td>".$result['description']."</td>
    </tr>";
}
}
echo "</table></div>
<br><div class='tnp hd'>Number of Posts on site</div><br/><div class='tnpt'>
<table style='width: 100%'><tr><th>Number of Social Posts</th><th>Number of Educational Posts</th><th>Total</th></tr>
";
$nsp = mysqli_num_rows(queryMysql("SELECT * FROM socposts"));
$nep = mysqli_num_rows(queryMysql("SELECT * FROM eduposts"));
$total = $nsp + $nep;
echo "<tr><td>".$nsp."</td><td>".$nep."</td><td>".$total."</td>";
echo"</table></div><br>
<div class='usnp hd'>User With Highest Number of Posts</div><br/><div class='usnpt'><table style='width:100%'><tr><th>Username</th><th>Fullname</th>
<th>Number of Social Posts</th><th>Number of Educational Posts</th><th>Total Number Of Posts</th><th>Badge Type</th></tr>";
echo"
</div>";
}
?>