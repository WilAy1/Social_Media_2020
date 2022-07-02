<?php
    require_once "/Users/wilay/students_connect/connect.php";
    session_start();
    if(isset($_GET['tuz'])){
        $user = sanitizeString($_GET['tuz']);
        $muser = $_SESSION['user'];
        $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $gn = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
        $set = mysqli_fetch_array(queryMysql("SELECT * FROM settings WHERE user='".$gn['user']."'"));
        $user = $gn['user'];
        $k = queryMysql("SELECT * FROM followstatus WHERE user='$user' AND friend='".$row['user']."'");
        $fname = $gn['firstname']." ".$gn['middlename']." ".$gn['surname'];
        if($gn['pnumber'] == '0' || $gn['pnumber'] == ""){
            $xnmb = "<i>empty</i>";
        }
        else {
            $xnmb = "<a href='tel:".$gn['pnumber']."'>".$gn['pnumber']."</a>";
        }
        if($gn['status'] == '1'){
            $mix =  "Aspiring ";
        }
        elseif($gn['status'] == '2'){
            $mix = 'Studying ';
        }
        else {
            $mix = "";
        }
        $oi = 'Undisclosed';
        if($gn['sex'] == 1){
            $oi = 'Male';
        }
        elseif($gn['sex'] == 2){
            $oi = 'Female';
        }
        echo "
        <div class='f_fe'>
        <div class='cat_F'>
        <div class='f_nm t_fx'>
        <div class='le_x b_x'>Name</div>
        <div class='xel_x be_x'>".$fname."</div>
        <div class='ex_l b_x'>Username</div>
        <div class='be_x'><i class='fas fa-at'></i>".$user."</div>
        </div>
        <div class='ol_x t_fx'>
        <div class='ix_o'>
        ";
        if($set['email'] == 1 || ($set['email'] == 2 && $k->num_rows)){
        echo "<div class='mix_a'>
        <div class='ee_l b_x'>
        <label for='email' id='la_em'>Email</label>
        </div>
        <span class='piop be_x'>
        <a href='mailto:".$gn['email']."'>".$gn['email']."</a></span>
        </div>";
        }
        if($set['number'] == 1 || ($set['number'] == 2 && $k->num_rows)){
        echo "
        <div class='mix_a'>
        <div class='nx_l b_x'>
        <label for='pnmbre' id='la_em'>Phone Number</label>
        </label>
        </div>
        <span class='piop be_x'>".$xnmb."</span>
        </div>
        </div>";
        }
        if($set['dateofbirth'] == 1 || ($set['dateofbirth'] == 2 && $k->num_rows)){
        echo "<div class='xup_ex t_fx'>
        <div class='e_dob b_x'>
        Date of Birth
        </div>
        <div class='rxlips be_x'>
        ".$gn['bd_day']."/".ucfirst($gn['bd_month'])."/".$gn['bd_year']."
        </div>
        </div>";
        }
        if($set['sex'] == 1 || ($set['sex'] == 2 && $k->num_rows)){
        echo "<div class='t_fx'>
        <div class='ep_x'>Sex</div>
        <div class='be_x'>".$oi."</div>
        </div>
        ";
        }
        /*if($gn['course'] != "" && $gn['institution'] != ""){
        echo "
        <div class='tx_o t_fx'>
        <div class='ep_x b_x'>
        Others
        </div>
        <div class='ol_t'>
        <div class='ce_x'>
        <div class='b_x'>Institution</div>
        <div class='be_x'>".$gn['institution']."</div>
        </div>
        <div class='ce_x'>
        <div class='b_x'>Course</div>
        <div class='be_x'>".$mix.$gn['course']."</div>
        </div>
        </div>";
        }*/
        echo "
        </div>
        </div>
        
        </div>
        ";
    }
?>