<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['fid']) && isset($_POST['ap'])){
        $x = $_SERVER['HTTP_REFERER'];
        echo "<div class='gback'><a href='".$x."'>
        Go Back</a>
        </div>";
        $fid = $_POST['fid'];
        $fetch = queryMysql("SELECT * FROM forummembers WHERE forumid='$fid' AND isacknoledged='0'");
        if($fetch->num_rows){
            echo '<table><tr><td>User</td>
            <td>Requested to Join</td><td>Add</td></tr>';
            while($gf = mysqli_fetch_array($fetch)){
                $user = $gf['user'];
                $mbrs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
                echo '<tr><td>'.$mbrs['firstname'].' '.$mbrs['surname'].'</td>
                <td>'.date('Y M\' d h:i a', $gf['datejoined']).'</td>
                <td id="xez'.$gf['id'].'" onclick="adtfo(\''.$mbrs['user'].'\', \''.$fid.'\', \''.$gf['id'].'\')">Add</td></tr>';
            }
            echo '</table>';
        }
        else {
            echo '<div class="nsg">No Present Request</div>';
        }
    }
    if(isset($_POST['ffid']) && isset($_POST['user'])){
        $fid = sanitizeString($_POST['ffid']);
        $user = sanitizeString($_POST['user']);
        $x = mysqli_fetch_array(querymysql("SELECT * FROM forums WHERE id='$fid'"));
        $px = (int) ++$x['numberofmembers'];
        queryMysql("UPDATE forums SET numberofmembers='$px' WHERE id='$fid'");
        queryMySQL("UPDATE forummembers SET isacknoledged='1' where user='$user'"); 
        $id = 0;
        $usertobenotified = $user;
        $notlink = "/students_connect/f/".$fid;
        $hidenot = 0;
        $timeofnot = time();
        $notheading = sanitizeString('<b>Your request to join '.$x['nameofforum'].' has been granted</b>');
        $notcontent = sanitizeString('You have been added to the forum. Click to view forum.');
        queryMysql("INSERT INTO notifications VALUE('$id',
         '$user', '$usertobenotified','0','$notheading', '$notcontent', '$hidenot', '$notlink','0', '$timeofnot')"); 
    }
?>