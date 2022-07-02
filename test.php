
</script>
<?php
print_r(explode("/", "Ayomikun.com/under9"));
print_r($_COOKIE);
?>






<audio id='player' controls></audio>
<video controls id='player2' height='500' width='500'>
<source />
</video>
<a id='download'>Download</a>
<script>
  const player = document.getElementById('player');
  const handleSuccess = function(stream) {
    if(window.URL){
      console.log(stream);
      player.srcObject = stream;
    }
    else {
      console.log(stream)
      player.src = stream;
    }
  }
  navigator.mediaDevices.getUserMedia({audio: true, video:false}).then(handleSuccess)
  const player2 = document.getElementById('player2');
  const handleSuccess2 = function(stream) {
    if(window.URL){
      console.log(stream);
      player2.srcObject = stream;
    }
    else {

      player2.src = stream;
    }
  }
  navigator.mediaDevices.getDisplayMedia().then(handleSuccess2)
  const download = document.getElementById('download');
  
</script>
<?php
session_start();
error_reporting(E_ALL);
print_r($_COOKIE);
echo sha1(rand(1, 10000000000))."<br/>";
echo md5(rand(1, 10000000000));
require_once "connect.php";
echo "<br/><br/>".enc((' AND messageid != "" AND messageid !="205"'))."<br/><br/>";
$xx = 'to.com';
echo "<br/>".linkk($xx)."<br/>";

$com = escapeshellcmd('python3 /pyfiles/search.py');
$x = shell_exec($com)."<br/><br/>";
echo $x;
print(count($_SESSION));
echo "<form method='POST' action=''>
<select name='datetime'>";
for($x = 0; $x < 12; $x  ){
  echo '<options val=></option>';

}
echo "
</select>
<input type='submit'>
</form>";
echo date("Y M D h:i a")."<br/><br/>";
echo strtotime("1969 Jan Mon 12:01 am")
."<BR/><BR/>";
  $abc = mysqli_fetch_array(queryMysql("SELECT * FROM eduposts"));
    echo ($abc['pstcont']);
  
echo date("Y M D h:i a", 1596723813)."<br/>";
echo date("Y M D h:i a", time())."<br/>";
echo date("Y M d  h:i a",strtotime("24 hours ago"));
    echo date("H:i:s", 1588275129);
    echo "<br>";
    echo date("H:i:s", 1588275189);
    if(1588275189 << 1588275129){
      print("<b>true</b>");
    }
    else {
      print("<b>FALSE</b>");
    }
    if(isset($_POST['file'])){
    if($_FILES['file']['name'] != "" )
    {
    copy( $_FILES['file']['name'], "/var/www/html" ) or
    die( "Could not copy file!");
    }
    else
    {
    die("No file specified!");
    }
  }

  echo substr($_FILES['file']['type'], 0 , 5);
  if(strpos($_FILES['file']['type'], "image/png") != false){
    echo 'Yes it is an image';
  }
  else {
    echo "Not an image";
  }
    ?>
  

<h2>Uploaded File Info:</h2>
<form action="" method="post"
enctype="multipart/form-data">
<input type="file" name="file" size="50" />
<br />
<input type="submit" value="Upload File" />
</form>
<ul>
<li>Sent file: <?php echo $_FILES['file']['name']; ?>
<li>File size: <?php echo $_FILES['file']['size']; ?> bytes
<li>File type: <?php echo $_FILES['file']['type']; ?>
</ul>

<?php
  echo basename($_FILES['file']['name']);
  echo pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION)."<br/><br/>";
  echo getimagesize($_FILES['file']['tmp_name'])."<br/>";
  print_r($_FILES['file']);
?>
<!DOCTYPE html>
<html>
<head>
<style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #f1f1f1}

.show {display:block;}
</style>
</head>
<body>

<h2>Clickable Dropdown</h2>
<p>Click on the button to open the dropdown menu.</p>

<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
  </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i  ) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_css_js_dropdown by HTTrack Website Copier/3.x [XR