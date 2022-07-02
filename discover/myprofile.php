<?php
    session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    $user = $_SESSION['user'];
    $wt = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user = $wt['user'];
    $opp = queryMysql("SELECT * FROM discover WHERE startedby='$user'");
    echo "<div class='p_roofile'>
    <div class='p_eexte'>
    <div class='p_upp'><i class='fas fa-bars'></i></div>
    <div class='p_llooe'>";
    while($r = mysqli_fetch_array($opp)){
        echo "
        <div class='p_tkfk'>
        ".$r['discovername']."
        </div>
        ";
    }
    $opp = queryMysql("SELECT * FROM discover WHERE startedby='$user'");
    $gal = mysqli_fetch_array($opp);
    $did = $gal['id'];
    echo "</div></div><div class='p_lloer'>
    <div class='p_propic' style='background-image: url(\"/students_connect/user.png\")'></div/>
    <div class='p_ettrmn'>
    <div class='p_oeert'>".$gal['discovername']."</div>
    <div class='p_lleir'><i class='fas fa-at'></i>".$gal['discovername']."</div>
    </div>
    </div>
    <div class='p_fttured'>
    <div class='p_epeet'>Featured Posts</div>
    <div class='p_eeool'>
    <div class='p_eeol'></div>
    <div class='p_ooeom'></div>
    <div class='p_ooepp'></div>
    </div>
    </div>
    <div class='p_loeef'>";
    $rte = queryMysql("SELECT * FROM discoverposts WHERE discoverid='".$did."' ORDER BY timeposted DESC");
    while($g = mysqli_fetch_array($rte)){
    $myy = mysqli_fetch_array(queryMysql("SELECT * FROM discover WHERE id='".$g['discoverid']."'"));
    if(file_exists("../../students_connect_hidden/discoverp/".$g['discoverid']."/".$g['id']."/0.png")){
      $bigmg = "../../students_connect_hidden/discoverp/".$g['discoverid']."/".$g['id']."/0.png";
    }
    $ert = strlen($g['postheading']) > 45 ? substr($g['postheading'], 0, 45).'&hellip;': $g['postheading'];
    $conn = strlen($g['postcontent']) > 45 ? substr($g['postcontent'], 0, 45).'&hellip;': $g['postcontent'];
    echo "
      <div class='c_pollet'>
      <div class='c_frell'>
      <div class='c_frpimg' style='background-image: url(\"".$bigmg."\")'></div>
      <div class='c_apfriim'>
      <div class='c_pohead'>".$ert."</div>
      <div class='c_olitcont'>".$conn."</div>
      <div class='c_itwby'>".$myy['discovername']." . ".ucfirst($g['tag'])." . ".date("M d h:i a",$g['timeposted'])."</div>
      </div>
      </div>
      </div></div>
    ";
}
    echo "</div>
    </div>
    </div>
    </div>";
?>
<link rel="stylesheet" href="/students_connect/cssf/fontawesome/css/all.css">
<style>
    .p_eexte {
        background-color: rgb(65, 191, 241);
        border-bottom: 1.5px solid rgb(65, 191, 241);
        width: 100%;
        white-space: nowrap;
        min-height: 40px;
        color: white;
        position: relative;
    }
    .p_upp {
        padding: 10px 12px;
        float: right;
        }
        .p_llooe {
            float: left;
            display: none;
        }
        .p_lloer {
            margin: 8px 2px;
        }
        .p_propic {
            height: 100px;
            width: 100px;
            background-size: 100%;
            background-position: center center;
            border-radius: 50%;
        }
        .p_lloer {
            display: flex;
        }
        .p_ettrmn {
            padding-left: 10px;
            margin: auto 3px;
        }
        .p_oeert {
            font-size: 14px;
        }
        .p_lleir {
            font-size: 12px;
            color: gray;
        }
        .p_fttured {
            font-size: 17px;
            padding: 15px;
        }
        .p_eeol {
            width: 10%;
            height: 2px;
            background: #ccc;
        }
        .p_ooeom {
            width: 10px;
            height: 10px;
            background: #ccc;
            border-radius: 50%;
            margin-top: -4px;
            margin-left: 3px;
            margin-right: 3px;
        }
        .p_eeool {
            position: relative;
            width: 100%;
            display: flex;
            padding: 5px 0px;
        }
        .p_ooepp {
            width: 85%;
            height: 2px;
            background: #ccc;
        }
</style>