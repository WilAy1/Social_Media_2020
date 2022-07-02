<?php
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['email'])){
        $email = sanitizeString($_POST['email']);
        if(empty($_POST['email'])){
            echo "<div class='errorx'>Field can't be empty</div>";
        }
        else {
        // check if email in database
        $ch = queryMysql("SELECT * FROM members WHERE user='$email' OR 
        email='$email' OR pnumber='$email'");
       if($ch->num_rows){
            $thecode = rand(100000, 999999);
            queryMysql("UPDATE members SET fgtpasscode='$thecode' WHERE 
            user='$email' OR email='$email' OR pnumber='$email'");
            echo "";
            echo 
                $thecode
            ."
            <input type='hidden' name='eora' value='$email' id='eora'>
            <div class='error'></div>
            <div class='fgtpasslb'>
            <label for='code'>Code</label></div>
            <div class='fgtpassin'>
            <input type='text' name='code' class='frgplc inputtext1' id='code' autocomplete='off'>
            </div>
            <div class='fgtpasssb'>
            <button id='submitbtn' class='hih' onclick='pSub(document.getElementById(\"code\").value, 
            document.getElementById(\"eora\").value)'>Submit</button>
            </div>
            ";
        }
    else {
        echo '<div class="errorx">Detail provided not found</div>';
    }
    }
    }
    else {
        echo "";
    }
    if(isset($_POST['code'])){ 
        if(!empty($_POST['code'])){
        $nm = sanitizeString($_POST['eora']);
        $pc = sanitizeString($_POST['code']);
        $deb = queryMysql("SELECT * FROM members WHERE user='$nm' 
        AND fgtpasscode='$pc' OR email='$nm' AND fgtpasscode='$pc' 
        OR pnumber = '$nm' AND fgtpasscode='$pc'");
        if($deb->num_rows){
            echo '
            <div class="ifpisf">
            <div class="error"></div>
            <div class="athere">Almost there!</div>
            <div class="cyph">Change your password</div>
            <div class="cfpf"> 
            <input type="hidden" id="ttxt" name="ttxt" value="'.$nm.'">
            <div class="inpp">
            <label for="new_pass" class="fgtpasslb">New Password</label><br/>
            <input type="password"  class="frgplc inputtext1" name="normal" id="one">
            <br/><label for="repeatpass" class="fgtpasslb">Repeat Password</label>
            <br/><input type="password" class="frgplc inputtext1" name="repeat" id="two">
            </div><br/>
            <button type="button" onclick="final(document.getElementById(\'one\').value,
            document.getElementById(\'two\').value,
            document.getElementById(\'ttxt\').value)" class="hih">Submit</button>
            </div>
            </div>';
        }
        else {
            echo '<div class="errorx">Invalid Code</div>';
        }
    }
    else {
        echo '<div class="errorx">Field is empty.</div>';
    }
    }
    if(isset($_POST['normal']) && isset($_POST['repeat'])){
        if(empty($_POST['normal']) || empty($_POST['repeat'])){
           $err =  '<div class="errorx">One or more fields are empty.</div>';
        }
        else {
            $normal = sanitizeString($_POST['normal']);
            $repeat = sanitizeString($_POST['repeat']);
            $nmfs = sanitizeString($_POST['ttxt']);
            if(strlen($normal) < 6 || strlen($repeat) < 6){
                echo '<div class="errorx">Password takes a minimum of six characters.</div>';
            }
            else {
            if($normal === $repeat){
                $fud = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$nmfs' 
                OR email='$nmfs' OR pnumber='$nmfs'"));
                if($fud['pass'] === $normal){
                    echo "<div class='rstevy'>
                    <div class='pmatch'>Current password match new password</div>
                    <div class='yorn'>Return to <a href='/students_connect/login.php'>login</a></div>    
                    </div>";
                }
                else {                
                    queryMysql("UPDATE members SET pass='$normal' WHERE user='$nmfs' 
                    OR email='$nmfs' OR pnumber='$nmfs'");
                    echo "<div class='success'>Successfuly changed password. Return to  
                    <a href='/students_connect/login.php'>login</a></div>";
                }
            }
            else {
                echo '<div class="errorx">Password doesn\'t match</div>';
            }
        }
        }
    }
?>