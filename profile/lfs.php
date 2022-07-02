<?php
session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $user = $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user =  $row['user'];
    if(isset($_GET['all'])){
        $all = queryMysql("SELECT * FROM eduposts WHERE user='$user' OR sharedby='$user'
        UNION ALL
        SELECT * FROM socposts WHERE user='user' OR sharedby='$user'");
        $td = getcwd();
        chdir("../../students_connect_hidden/postuploads/");
        echo "<div class='crl_al' style='margin-top: 5px; margin-bottom: 15px; display: inline-block;'>";
        echo "<div class='cr_i_p' style='font-size: 15px; padding: 7px; font-weight: 700;'>Posts</div>";
        while($x = mysqli_fetch_array($all)){
            $q = '';
            if($x['pstst'] == 1){
                $q = 's/';
            }
            for($i = 0; $i < 2; $i++){ 
                if(file_exists($q.$x['id']."(".$i.").png")){  
                  echo "
                  <img alt='Images' class='crl_tbd' src='/students_connect_hidden/postuploads/".$q.$x['id']."(".$i.").png' style='width: 30%;  float: left; margin: 5px;'>";
            }
            
        }
    }
    echo "</div>";
        chdir($td);
        echo "<div class='cr_mg' style='margin-top: 5px; margin-bottom: 15px; display: inline-block;'>";
        echo "<div class='cr_i_p' style='font-size: 15px; padding: 7px; font-weight: 700;'>Profile</div>";
            if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){
                echo "<img alt='Images' class='crl_tbd' src='/students_connect_hidden/users_profile_upload/$user/$user.png' style='width: 30%;  float: left; margin: 5px;'>";
            }
            if(file_exists("../../students_connect_hidden/users_profile_upload/$user/cover/cover.png")){
                echo "<img alt='Images' class='crl_tbd' src='/students_connect_hidden/users_profile_upload/$user/cover/cover.png' style='width: 30%;  float: left; margin: 5px;'>";
            }
        echo "</div>";
    echo "<div class='cr_mg' style='margin-top: 5px; margin-bottom: 15px; display: inline-block;'>";
    echo "<div class='cr_i_p' style='font-size: 15px; padding: 7px; font-weight: 700;'>Messages</div>";
    $ty = queryMysql("SELECT * FROM messages WHERE hasfile='1' AND sender='$user'");
    while($kt = mysqli_fetch_array($ty)){
        if(file_exists("../../students_connect_hidden/messages_uploads/".$kt['messageid'])){
            $m = "../../students_connect_hidden/messages_uploads/".$kt['messageid'];
            $oa = scandir($m);
            unset($oa[0]);
            unset($oa[1]);
            if(!empty($oa)){
                $oqx = array_values($oa);
                for($i = 0; $i < count($oqx); $i++){
                    if(is_file($m."/".$oqx[$i])){
                        if(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'png'){
            echo"                            
            <img alt='Images' class='crl_tbd' src='/students_connect_hidden/messages_uploads/".$kt['messageid']."/".$oqx[$i]."' style='width: 30%;  float: left; margin: 5px;'>
                ";
                        }
                    elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp4'){
                    echo "
                    <video style='opacity: 1' width='200' height='200' controls>
                    <source src='/students_connect_hidden/messages_uploads/".$kt['messageid']."/".$oqx[$i]."'>
                    </video>
                            ";
                        }
                        elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp3'){
                            echo "
                ";
                        }
                        else {
                            echo "
                            ";
                        }
                    }
                    }
        }
    }
}
    echo "</div>";
    }
    if(isset($_GET['pr'])){
        echo "<div class='cr_mg'>";
    echo "<div class='cr_i_p' style='font-size: 15px; padding: 7px; font-weight: 700;'>Profile</div>";
        if(file_exists("../../students_connect_hidden/users_profile_upload/$user/$user.png")){
            echo "<img alt='Images' class='crl_tbd' src='/students_connect_hidden/users_profile_upload/$user/$user.png' style='width: 30%;  float: left; margin: 5px;'>";
        }
        if(file_exists("../../students_connect_hidden/users_profile_upload/$user/cover/cover.png")){
            echo "<img alt='Images' class='crl_tbd' src='/students_connect_hidden/users_profile_upload/$user/cover/cover.png' style='width: 30%;  float: left; margin: 5px;'>";
        }
    echo "</div>";
    }
    if(isset($_GET['ph'])){
        
    }
    if(isset($_GET['vd'])){
        
    }
    if(isset($_GET['au'])){
        
    }
    if(isset($_GET['mg'])){
        echo "<div class='cr_mg'>";
    echo "<div class='cr_i_p' style='font-size: 15px; padding: 7px; font-weight: 700;'>Messages</div>";
    $ty = queryMysql("SELECT * FROM messages WHERE hasfile='1' AND sender='$user'");
    while($kt = mysqli_fetch_array($ty)){
        if(file_exists("../../students_connect_hidden/messages_uploads/".$kt['messageid'])){
            $m = "../../students_connect_hidden/messages_uploads/".$kt['messageid'];
            $oa = scandir($m);
            unset($oa[0]);
            unset($oa[1]);
            if(!empty($oa)){
                $oqx = array_values($oa);
                for($i = 0; $i < count($oqx); $i++){
                    if(is_file($m."/".$oqx[$i])){
                        if(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'png'){
            echo"                            
            <img alt='Images' class='crl_tbd' src='/students_connect_hidden/messages_uploads/".$kt['messageid']."/".$oqx[$i]."' style='width: 30%;  float: left; margin: 5px;'>
                ";
                        }
                    elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp4'){
                    echo "
                    <video style='opacity: 1' width='200' height='200' controls>
                    <source src='/students_connect_hidden/messages_uploads/".$kt['messageid']."/".$oqx[$i]."'>
                    </video>
                            ";
                        }
                        elseif(pathinfo($oqx[$i], PATHINFO_EXTENSION) == 'mp3'){
                            echo "
                ";
                        }
                        else {
                            echo "
                            ";
                        }
                    }
                }
            }
        }
    }      
    }
    if(isset($_GET['svd'])){
        
    }    
?>