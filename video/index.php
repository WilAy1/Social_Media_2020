<?php
    if(isset($_GET['crvid'])){
        $vlink = $_GET['crvid'];

        echo "<video  class='pvideo' width='200' height ='200' controls>
        <source src='/students_connect_hidden/".$vlink."' type='video/mp4' >
        </video>";
    }
?>
