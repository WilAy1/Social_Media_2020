<form action='#' method='post'>
<select name='color'>
<option value="Red">Red</option>
<option value="green">Green</option>
<option value="blue">Blue</option>
</select>
<input type="submit" name="submit" value="Get selected value"/>
</form>
<?php
if(isset($_POST['submit'])){
    $selected_val = $_POST['color'];
    echo "You have selected :" .$selected_val;
}

echo "<div class='body'>".
           "<h1 id='heading1'>Create Your Account</h1>".
           "<form method='post' action='#'>$error".
           "<label for='course'>Course</label><br><select id='course' name='course'>".
           "<option value='choose'>Choose</option>".
           "<option value='mbbs'>Medicine and Surgery</option>".
           "<option value='law'>Law</option>".
           "<option value='$acct'>Accountancy</option>".
           "</select>".
           "<br><br>".
           "<input type='submit' name='submit'>><br><br><br><br>".
           "</form>".
           "<hr>";
           if(isset($_POST['submit'])){
            $course= $_POST['course'];
           echo "You chose" .$course;
           }
?>





echo "<div class='body'>".
           "<h1 id='heading1'>Create Your Account</h1>".
           "<form method='post' action='signup.php'>$error".
           "<label for='course'>Course</label><br><select id='course' name='course' value='$course'>".
           "<option value='$choose'>Choose</option>".
           "<option value='$mbbs'>Medicine and Surgery</option>".
           "<option value='$law'>Law</option>".
           "<option value='$acct'>Accountancy</option>".
           "</select>".
           "<br><br>".
           "<button>Next</button><br><br><br><br>".
           "</form>".
           "<hr>";
           echo "You chose" .$course;





echo <<<_END
<div class="body">
<p id="welcome_address">Welcome to Studco!<p/>
<p id="welcome_address">Try joining StudCo today!</p>
<h1 id="heading1">Create Your Account</h1>
<form method='post' action='signup.php'>$error
<div class="label">
<input type='text' maxlength='40' name='firstname' placeholder="FirstName" value='$firstname' required>
<input type='text' maxlength='40' name='lastname' placeholder="LastName" value='$lastname' required>
<br><select id='course' name='course' value='$course'>
<option value='$choose'>Choose</option>
<option value='$mbbs'>Medicine and Surgery</option>
<option value='$law'>Law</option>
<option value='$acct'>Accountancy</option>
</select>
<br><br>
<button>Next</button><br><br><br><br>
</form>
_END;
