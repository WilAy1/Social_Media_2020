<?php
require_once "/Users/wilay/students_connect/connect.php";
if(isset($_GET['sug'])){
    $sug = sanitizeString($_GET['sug']);
    $user = sanitizeString($_GET['user']);
        $ex = queryMysql("SELECT * FROM forums WHERE nameofforum LIKE '%$sug%' LIMIT 0, 5");
        if($ex->num_rows){
        while($gex = mysqli_fetch_array($ex)){
            $fid = $gex['id'];
            $mx = queryMysql("SELECT * FROM forummembers WHERE forumid='$fid'");
            $number = mysqli_num_rows($mx);
            $xb = array();
            while($nbx = mysqli_fetch_array($mx)){
                array_push($xb, $nbx['user']);
            }
            $win = "'".implode("','",$xb)."'";
            $ed= queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend in ($win) ORDER BY RAND() LIMIT 1");
            if($gex['typeofforum'] == 0){
                $flag = '<i class="fas fa-globe foflag"></i>';
                if($number ==  1){
                $nfmbs = $number." member";
                }
                else {
                $nfmbs = $number." members";
                if($ed->num_rows){
                        $nfmbs .= ' including';
                    } 
                    while($ged = mysqli_fetch_array($ed)){
                        $nfmbs .= " ".$ged['friend'];
                    }
                    
                }
            }
            elseif($gex['typeofforum'] == 1){
                $flag = '<i class="foflag">P</i>';
                $nfmbs = '';
            }
            elseif($gex['typeofforum'] == 2){
                $flag = '<i class="foflag">S</i>';
                $nfmbs = '';
            }
            echo '<div class="srslt">
            <a href="/students_connect/f/'.$fid.'">
            <div class="fsone">
            <div class="sfnm">
            '.$gex['nameofforum'].'
            </div>
            <div class="mbsinf" style="display: block !important;">'.$nfmbs.'</div>
            </div>
            <div class="fstwo">'.$flag.'</div>
            </a></div><hr style="width: 90%">';
        }
        echo '
        <div class="fvmorecap">
        <div class="fvmore">View More</div></div>';
    }
    else {
        echo '<div class="shwmich" style="display: block; width: 100%;">
         <div class="pxdef" style="width: 15%; display: block; padding-top: 20px;
         margin-left: auto; margin-right: auto;">No Suggestion</div></div>';
    }
}
?>