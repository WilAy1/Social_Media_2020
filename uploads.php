<?php
require_once 'header2.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (!$loggedin) die();
else {
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $user= sanitizeString('user');
if(isset($_POST['submit'])){
    if(substr($_FILES['fileToUpload']['type'], 0, 5) == "image"){
    $target_dir = "../students_connect_hidden/users_profile_upload/";
    $target_file = $target_dir.$row['user'].'/' . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
                rename($target_dir.$row['user'].'/'.$_FILES['fileToUpload']['name'],
                 $target_dir.$row['user'].'/'.$row['user'].'.png');
}
}
if(isset($_POST['cover_submit'])){
    if(substr($_FILES['cover']['type'], 0, 5) == "image"){
        $target_dir = "../students_connect_hidden/users_profile_upload/".$row['user'].'/cover/';
        if(is_dir($target_dir)){
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);
        move_uploaded_file($_FILES['cover']['tmp_name'], $target_file);
                    rename($target_dir.$_FILES['cover']['name'],
                     $target_dir.'cover.png');
    }
    else {
        $oq = getcwd();
        chdir("../students_connect_hidden/users_profile_upload/".$row['user']."/");
        mkdir("cover");
        chdir($oq);
        $target_dir = "../students_connect_hidden/users_profile_upload/".$row['user'].'/cover/';
        if(is_dir($target_dir)){
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);
        move_uploaded_file($_FILES['cover']['tmp_name'], $target_file);
                    rename($target_dir.$_FILES['cover']['name'],
                     $target_dir.'cover.png');
    }
}
}
}
echo '<script>
window.location.href = "user_view.php";
</script>';
}

?>