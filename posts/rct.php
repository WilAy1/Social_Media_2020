<?php
     if(isset($_GET['i']) && isset($_GET['1'])){
        $id = $_GET['i'];
      $get = queryMysql("SELECT * FROM votes WHERE id='$id'");
      $user = $_SESSION['user'];
      $chus = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
        $id = $_GET['i'];
        $chpst = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        $chmnou = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
          $chmnouf = mysqli_fetch_array($chmnou);
          $a = $chmnouf['voted'];
      if($a == 'upvote'){
        // do nothing
      }
      elseif ($a == 'downvote'){
        $upvote = 'upvote';
        $time = time();
        queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
        $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        $tun = ++$new['tun'];
        $tdn = --$new['tdn'];
        $pnl = $tun + $tdn;
        queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
      }
      else {
        $voted = 'upvote';
        $time = time();
        queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
        $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        $tun = (int) ++$new['tun'];
        $tdn = (int) $new['tdn'];
        $pnl = $tun + $tdn;
        queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
      }
        }
        
      
    if (isset($_GET['d']) && isset($_GET['2'])){
      $id = $_GET['d'];
      $user = $_SESSION['user'];
      $chmnod = queryMysql("SELECT * FROM votes WHERE user='$user' AND id='$id'");
      $chmnodf = mysqli_fetch_array($chmnod);
      $a = 'downvote';
      if($chmnodf['voted'] == $a){
        // do nothing
      }
      elseif($chmnodf['voted'] == 'upvote'){
        $upvote = 'downvote';
        $time= time();
        queryMysql("UPDATE votes SET user='$user', voted='$upvote', timeofvote='$time' WHERE id='$id' AND user='$user'");
        $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        $tun = --$new['tun'];
        $tdn = ++$new['tdn'];
        $pnl = $tun + $tdn;
        queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
      }
      else {
        $voted = 'downvote';
        $time = time();
        queryMysql("INSERT INTO votes  VALUES('$user', '$voted', '$id', '$time')");
        $new = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts WHERE id='$id'"));
        $tun = $new['tun'];
        $tdn = ++$new['tdn'];
        $pnl = $tun + $tdn;
        queryMysql("UPDATE eduposts SET pnl='$pnl', tun='$tun', tdn='$tdn' WHERE id='$id'");
      }
      }
    
    
    
      if(isset($_GET['de']) && isset($_GET['e'])) {
        $id = $_GET['de'];
        $user = $_SESSION['user'];
        queryMysql("DELETE FROM eduposts WHERE id='$id'");
        queryMysql("DELETE FROM votes WHERE id='$id'");
        queryMysql("DELETE FROM educomments WHERE postid='$id'");
      }
      if(isset($_GET['de']) && isset($_GET['s'])) {
        $id = $_GET['de'];
        $user = $_SESSION['user'];
        queryMysql("DELETE FROM socposts WHERE id='$id'");
        
      }
      if(isset($_POST['upeducommentid']) && 
      isset($_POST['upedupostid']) && isset($_POST['user'])){
        $ctid = $_POST['upeducommentid'];
        $ptid = $_POST['upedupostid'];
        $uuser = sanitizeString($_POST['user']);
        $ot = 0;
        $tm = time();
        $id = 0;
        $cfc = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='$uuser' AND postid='$ptid'
         AND commentid='$ctid'"));
        if($cfc['voted'] == 'upvote'){
    
         }
        elseif($cfc['voted'] == 'downvote'){
          $uv = 'upvote';
          $tm = time();
          queryMysql("UPDATE commentvotes SET voted='$uv',
          timeofcommentvote='$tm' WHERE user='$uuser' AND commentid='$ctid' AND postid='$ptid'");
          $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
              $tun = ++$cmc['tun'];
              $tdn = --$cmc['tdn'];
              queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$ctid'");  
      }
        else {
        queryMysql("INSERT INTO commentvotes VALUES ('$id', '$uuser', 
        'upvote', '$ptid', '$ctid', '$ot', '$ot', '$tm'
        )");
         $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$ctid'"));
         $tun = (int) ++$cmc['tun'];
         $tdn = (int) $cmc['tdn'];
         queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$ctid'");
        }
      }
      if(isset($_POST['dwneducommentid']) && isset($_POST['dwnedupostid'])
       && isset($_POST['user'])){
        $dctid = $_POST['dwneducommentid'];
        $dptid = $_POST['dwnedupostid'];
        $uuser = sanitizeString($_POST['user']);
        $ot = 0;
        $tm = time();
        $id = 0;
        $cfc = mysqli_fetch_array(queryMysql("SELECT * FROM commentvotes WHERE user='$uuser' AND postid='$dptid'
         AND commentid='$dctid'"));
        if($cfc['voted'] == 'downvote'){
    
         }
        elseif($cfc['voted'] == 'upvote'){
          $uv = 'downvote';
          $tm = time();
          queryMysql("UPDATE commentvotes SET voted='$uv',
          timeofcommentvote='$tm' WHERE user='$uuser' AND commentid='$dctid' AND postid='$dptid'");
          $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
              $tun = --$cmc['tun'];
              $tdn = ++$cmc['tdn'];
              queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");  
      }
        else {
        queryMysql("INSERT INTO commentvotes VALUES ('$id', '$uuser', 
        'downvote', '$dptid', '$dctid', '$ot', '$ot', '$tm'
        )");
         $cmc = mysqli_fetch_array(queryMysql("SELECT * FROM educomments WHERE id='$dctid'"));
         $tun = (int) $cmc['tun'];
         $tdn = (int) ++$cmc['tdn'];
         queryMysql("UPDATE educomments SET tun='$tun', tdn='$tdn' WHERE id='$dctid'");
        }
       }
?>