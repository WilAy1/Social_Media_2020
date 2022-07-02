<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $db = queryMysql("SELECT * FROM eduposts");
    while($gdb = mysqli_fetch_assoc($db)){
      if(isset($_SESSION['user'])){  
      $id = $gdb['id'];
        $ssu = $_SESSION['user'];
        $gu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ssu'"));
        $user = $gu['user'];
      }
      $user = '';
      $id = $gdb['id'];
        echo "
        $('#cntl$id').ready(function(){
            setInterval(function(){
            upvote();
            }, 60000*30);
            function upvote(){
            $.ajax({
              url:'/students_connect/posts/updates.php?id=$id',
              method:'GET',
              success:function(data){
                $('#cntl$id').html(data);
              }
            })
            }
            });
                $('#cntc$id').ready(function(){
                    setInterval(function(){
                    comment();
                    }, 60000*30);
                    function comment(){
                    $.ajax({
                      url:'/students_connect/posts/updates.php?cid=$id',
                      method:'GET',
                      success:function(data){
                        $('#cntc$id').html(data);
                      }
                    })
                    }
                    });
                    $('#cmtedu".$gdb['id']."').ready(function(){
                      setInterval(function(){
                        upcmt();
                      }, 60000*30);
                      function upcmt(){
                      $.ajax({
                        url:'/students_connect/posts/reactions.php?ec&user=$user&postid=".$gdb['id']."',
                        method:'GET',
                        success:function(data){
                          $('#cmtedu".$gdb['id']."').html(data);
                        }
                      })
                      }
                      })
                      ";
    }
    $soc = queryMysql("SELECT * FROM socposts");
    while($msoc = mysqli_fetch_assoc($soc)){
      if(isset($_SESSION['user'])){
      $ssu = $_SESSION['user'];
      $gu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$ssu'"));
      $user = $gu['user'];
      }
      $user = '';
      echo "
      
  $('.lkdcnt".$msoc['id']."').ready(function(){
    setInterval(function(){
      uplk();
    }, 60000*30);
    function uplk(){
    $.ajax({
      url:'/students_connect/posts/reactions.php?user=$user&lid=".$msoc['id']."',
      method:'GET',
      success:function(data){
        $('.lkdcnt".$msoc['id']."').html(data);
      }
    })
    }
    })
      $('.cmnt".$msoc['id']."').ready(function(){
        setInterval(function(){
          upcmt();
        }, 60000*30);
        function upcmt(){
        $.ajax({
          url:'/students_connect/posts/reactions.php?user=$user&cmtid=".$msoc['id']."',
          method:'GET',
          success:function(data){
            $('.cmnt".$msoc['id']."').html(data);
          }
        })
        }
        })
      
      $('#cmt_sec".$msoc['id']."').ready(function(){
        setInterval(function(){
          upcmt();
        }, 60000*30);
        function upcmt(){
        $.ajax({
          url:'/students_connect/posts/reactions.php?c&user=$user&postid=".$msoc['id']."',
          method:'GET',
          success:function(data){
            $('#cmt_sec".$msoc['id']."').html(data);
          }
        })
        }
        })
        
      ";
    }
    echo <<<_END
    document.onclick = function(){
      if(document.getElementsByClassName('cntfl')){
            var all = document.getElementsByClassName('cntfl');
            var mlarray = [];
            for(var i = 0; i < all.length; i++){
              var mxe = all[i].id;
                var red = mxe.length;
                var tid = mxe.substring(4, red);
                mlarray.push(tid);
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('cntl'+tid).innerHTML = xmlhttp.responseText;
                }
                };
                xmlhttp.open('GET', '/students_connect/posts/updates.php?id='+tid);
                xmlhttp.send();
              }
            }
          }
    _END;
?>