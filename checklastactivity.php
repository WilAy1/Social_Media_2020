<?php
include('connect.php');

session_start();
$upd = queryMysql("UPDATE members SET last_activity = now() WHERE user='".$_SESSION["user"]."'");

$statement = $connect->prepare($upd);
$statement->execute(); 


?>