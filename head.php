
<?php
require_once 'connect.php';
    session_start();

    echo "";
    require_once 'connect.php';
    
    if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  if ($loggedin)
  {
      echo '';
  }
  else ("<a>Balls</a>");

  ?>
