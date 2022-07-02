<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_GET['id']) && isset($_GET['vote'])){
        $id = $_GET['id'];
        $vote = $_GET['vote'];
        $user = sanitizeString($_GET['user']);
        $pstst = $_GET['pstst'];
        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='$pstst'"));
        if($vote == '1'){
            $typ = 'o1clicks';
            $new = ++$xed['o1clicks'];
        }
        elseif($vote == '2'){
            $typ = 'o2clicks';
            $new = ++$xed['o2clicks'];
        }
        elseif($vote == '3'){
            $typ = 'o3clicks';
            $new = ++$xed['o3clicks'];
        }
        elseif($vote == '4'){
            $typ = 'o4clicks';
            $new = ++$xed['o4clicks'];
        }
        
        $xid = 0;
        $dex = queryMysql("SELECT * FROM pollbase WHERE user='$user' AND pid='$id' AND pstst='$pstst'");
        if($dex->num_rows == 0){
        queryMysql("UPDATE polls SET $typ='$new' WHERE pid='$id' AND pstst='$pstst'");
        queryMysql("INSERT INTO pollbase VALUES('$xid', '$user', '$vote', '$id', '$pstst')");
        }
        $xed = mysqli_fetch_array(queryMysql("SELECT * FROM polls WHERE pid='$id' AND pstst='$pstst'"));
        $x1 = (int) $xed['o1clicks'];
        $x2 = (int) $xed['o2clicks'];
        $x3 = (int) $xed['o3clicks'];
        $x4 = (int) $xed['o4clicks'];
        $x1v = round($x1/sumcl($x1, $x2, $x3, $x4), 2)*100;
        $x2v = round($x2/sumcl($x1, $x2, $x3, $x4), 2)*100;
        $x3v = round($x3/sumcl($x1, $x2, $x3, $x4), 2)*100;
        $x4v = round($x4/sumcl($x1, $x2, $x3, $x4), 2)*100;
        echo '<label id="xc_1">'.$x1v.'%</label>P
        <label id="xc_2">'.$x2v.'%</label>K
        <label id="xc_3">'.$x3v.'%</label>A
        <label id="xc_4">'.$x4v.'%</label>T';
    }
?>