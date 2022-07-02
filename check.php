<?php
    require_once "connect.php";
    if(isset($_POST['w'])){
        function guess($try){
            $o = queryMysql("SELECT * FROM members WHERE user='$try'");
            if($o->num_rows){
                return FALSE;
            }
            else {
                return true;
            }
        }
        $w = sanitizeString($_POST['w']);
        $mat = queryMysql("SELECT * FROM members WHERE user='$w'");
        if($mat->num_rows){
            $ot = array();
            $fn = sanitizeString($_POST['fn']);
            $ln = sanitizeString($_POST['ln']);
            $ty = $fn.$ln;
            if($ty != ''){
            $ty = str_replace(" ", '', $ty);
            $ty = strlen($ty) < 19 ? $ty : substr($ty, 0, 18);
            if(guess($ty) == TRUE){
                array_push($ot, strtolower($ty));
            }
        }
        $ty = $ln.$fn;
            if($ty != ''){
            $ty = str_replace(" ", '', $ty);
            $ty = strlen($ty) < 19 ? $ty : substr($ty, 0, 18);
            if(guess($ty) == TRUE){
                    array_push($ot, strtolower($ty));
                    $ot = array_unique($ot);
                    $ot = array_values($ot);   
            }
        }
            $i = 1;
            while($i > 0){
                if(count($ot) == 4){
                break;
                }
                $num = rand(1, 10000);
                $ty = $w.$num;
                if(guess($ty) == TRUE){
                        array_push($ot, strtolower($ty));   
                        $ot = array_unique($ot);
                    $ot = array_values($ot);
                }           
            }
            echo json_encode($ot);
        }
    }
if(isset($_POST['e'])){
    $u = sanitizeString($_POST['e']);
    $ma = queryMysql("SELECT * FROM members WHERE email='$u'");
    if($ma->num_rows){
        echo '0';
    }
    else {
        echo '1';
    }
}
if(isset($_POST['u'])){
    $u = sanitizeString($_POST['u']);
    $ma = queryMysql("SELECT * FROM members WHERE user='$u'");
    if($ma->num_rows){
        echo 0;
    }
    else {
        echo '1';
    }
}
?>