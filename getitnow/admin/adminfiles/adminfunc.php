<?php
 $dbhost  = 'localhost'; 
 $dbname  = 'students_connect';
 $dbuser  = 'root';
 $dbpass  = 'ibunkunoluwa';  

 $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
 if ($connection->connect_error) die($connection->connect_error);

 function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }
  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }
  function destroySession()
  {
    $_SESSION=array();
    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time() + (86400 * 30), '/' , 'samesite=strict');

    session_destroy();
  }
?>