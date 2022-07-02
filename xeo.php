<?php 
if(isset($_GET['time'])){
    ini_set("date.timezone",  $_GET['time']);
    echo $_GET['time'];
    }
?>