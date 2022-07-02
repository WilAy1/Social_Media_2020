<?php
session_start();
    require_once "/Users/wilay/students_connect/connect.php";
    if(isset($_POST['user'])){
    $user = $_POST['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $ssu = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='".$_SESSION['user']."'"));
    echo "
    <div class='uprt1'>
    <div class='usbtn' onclick='gbtm(\"".$ssu['user']."\", \"$grpnme\");'><i class='fas fa-arrow-left'></i></div>
    </div>
    <div class='inmb'>
    <div class='inmn'>
        <div class='inmg' style='background-image: url(";
        $user = $row['user'];
            if(file_exists('../../students_connect_hidden/users_profile_upload/'.$user.'/'.$user.'.png')){ 
              echo '"../../../../../students_connect_hidden/users_profile_upload/'.$user.'/'.$user.'.png");';
              }
              else {
                  echo '"../user.png");';
              }
    echo "
            background-repeat: no-repeat;
            height: 200px; width: 200px; border-radius: 100px;
             background-size: 100%;'></div>
              <div class='infn'>".$row['firstname']." ".$row['surname']."</div>
              <div class='infun'><i class='fas fa-at'></i>".$row['user']."</div>
              </div>";
              if($row['user'] != $ssu['user']){
              echo "
              <div class='lops'>
              <div class='vfpr whsic'>Open Profile</div>
              <div class='smdgtu whsic'>Send Message</div>
              <div class='rpusr whsic'>Report User</div>
              <div class='bckusr whsic'>Block User</div> 
              </div>";
              }
              else {
                  echo "<div class='lops'>
                  <div class='vfpr whsic1'>Open My Profile</div>
                  <div class='vfpr whsic1'>Change Profile Picture</div>
                  <div class='smdgtu whsic1'>Start New Chat</div>
                  <div class='rpusr whsic1'>Create New Group</div>
                  <div class='bckusr whsic1'>Open Starred Messages</div> 
                  </div>";
              }

}
if(isset($_POST['cuser']) && isset($_POST['gid'])){
    $cuser = sanitizeString($_POST['cuser']); 
    $gid = sanitizeString($_POST['gid']);
    $cpp = mysqli_fetch_array(queryMysql("SELECT * FROM selfgroups WHERE id='$gid'"));
    if($cpp['creator'] === $cuser){
        $dlt = "<div class='dgs wrf'>
        <div class='dbg' onclick='grpD(\"".$cpp['id']."\", \"".$cuser."\")' title='Delete Group'>Delete Group</div>
        <div class='dltgrp' id='dltgrp'></div>
        </div>";
        $cpic = "<div class='gimgn wrf'>
        <div class='chgimg' title='Change Group Picture' id='gmg'>
        <label for='chggimg' class='cgimg' style='cursor: pointer'><i class='fas fa-camera'></i></label>
        <input type='file' id='chggimg' name='gimg' style='display: none'/></div>
        </div>";
    }
    else {
        $dlt ="";
        $cpic = "";
    }
    echo "<div class='uprt1' id='sameuprt1' style=''>
    <div class='usbtn' onclick='gbtgm(\"".$cuser."\", \"".$gid."\");'><i class='fas fa-arrow-left'></i></div>
    <div class='nfgrp' id='ng'>".$cpp['nameofgroup']."</div>
    </div>
    <div class='algts'>
    <div class='gstn'>Group Settings</div>
    $cpic
    <div class='chgnm wrf'>
    <div class='gnlb maersk' title='Change Group Name'>
    <input type='hidden' value='".$cpp['id']."'>
    <input type='hidden' value='".$cuser."'>
    Change Group Name <i class='fas fa-caret-right rw' id='cnc'></i></div>
    <div class='chngnmin' id='gnlb' style='display: flex;'></div>
    </div>
    <div class='cgrde wrf'>
    <input type='hidden' id='gd' value='".$cpp['description']."'/>
    <div class='cgrdenm' title='Change Group Description'>
    Change Group Description 
    <input type='hidden' value='".$cpp['id']."'>
    <input type='hidden' value='".$cuser."'>
    <i class='fas fa-caret-right rw' id='cdc'></i></div>
    <div class='cgrdein' id='gdnme' style='display: flex;'></div>
    </div>
    <div class='cgrln wrf'><div class='gplnk' title='Group Link' onclick='cGl(\"".$cpp['id']."\", \"".$cpp['grouplinkhash']."\" , \"".$cuser."\")'>
    Group Link <i class='fas fa-caret-right rw' id='clc'></i></div>
    <div class='glks' id='glnks' style='display: flex'></div>
    </div>
    <div class='cgradm wrf'>
    <div class='gadmin' title='Administrators' 
    onclick='gAdmins(\"".$cuser."\", \"".$cpp['id']."\")'>Administrators <i class='fas fa-caret-right rw' id='cac'></i></div>
    <div class='adminsts' id='lgad'></div>
    </div>
    <div class='cgradms wrf'>
    <div class='gadmins' onclick='adSt()'>Admin Settings <i class='fas fa-caret-right rw' id='cadc'></i></div>
    <div class='gasts' id='gasts'></div></div>
    <div class='cgmbs wrf'>
    <div class='mgmbs' title='Manage Members'>Manage Members <i class='fas fa-caret-right rw'></i></div>
    <div class='mblst'></div>
    </div>
    <div class='cgcht wrf'>
    <div class='chsts' title='Chat Settings'>Chat Settings <i class='fas fa-caret-right rw'></i></div>
    </div>
    $dlt
    </div>";
}
if(isset($_POST['username']) && isset($_POST['friendsname'])){
  $us = $_POST['username'];
  $fn = $_POST['friendsname'];
  $db = queryMysql("SELECT * FROM members WHERE user='$us'");
  $sb = queryMysql("SELECT * FROM members WHERE user='$fn'");
  $mff = mysqli_fetch_array(queryMysql("SELECT * FROM messages WHERE sender='$us' AND receiver='$fn' OR receiver='$us' AND sender='$fn' ORDER BY timeofmessage DESC"));
  $aab = mysqli_fetch_array($db);
  $xab = mysqli_fetch_array($sb);
  if($db->num_rows && $sb->num_rows){
    $tus = $aab['user'];
    $tfs = $xab['user'];
    echo "<div class='uprt1'>
    <div class='usbtn' onclick='openfMsg(\"".$tus."\", \"".$tfs."\", \"".$mff['timeofmessage']."\");'><i class='fas fa-arrow-left'></i></div>
    </div>
    <div class='inmb'>
    <div class='inmn'>
        <div class='inmg' style='background-image: url(";
            if(file_exists('../../students_connect_hidden/users_profile_upload/'.$tfs.'/'.$tfs.'.png')){ 
              echo '"../../../../../students_connect_hidden/users_profile_upload/'.$tfs.'/'.$tfs.'.png");';
              }
              else {
                  echo '"../user.png");';
              }
    echo "
            background-repeat: no-repeat;
            height: 200px; width: 200px; border-radius: 100px;
             background-size: 100%;'></div>
              <div class='infn'>".$xab['firstname']." ".$xab['surname']."</div>
              <div class='infun'><i class='fas fa-at'></i>".$xab['user']."</div>
              </div>";
}
  elseif($db->num_rows && ($sb->num_rows == 0)){

  }
  elseif($sb->num_rows && ($db->num_rows == 0)){
      
  }
  else {

  }
}
if(isset($_POST['aid'])){
    $user= $_SESSION['user'];
    $row = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
    $cuser = $row['user'];
    $id = sanitizeString($_POST['aid']);
    $o = queryMysql("SELECT * FROM groupmembership WHERE groupid='$id' ORDER BY joined DESC");
    echo "<div class='uprt1' id='sameuprt1' style='position: inherit;'>
    <div class='usbtn' onclick='gbtgm(\"".$cuser."\", \"".$id."\");'><i class='fas fa-arrow-left'></i></div>
    </div><div class='gp_not'><div class='gp_men_not'>Notifications</div>";
    while($oq = mysqli_fetch_array($o)){
        if($oq['membership'] == '1'){
            $ma = "<div class='gr_immb'>Joined Group</div>";
            $xoq = "joined the group";
            $ka = "";
        }
        elseif($oq['membership'] == '2'){
            $ma = "<div class='gr_immb'>Request to Join.</div>";
            $xoq = "requested to join the group";
            $ka = "<div class='gr_accp'><input type='hidden' value='".$oq['id']."'/>Accept</div><div class='gr_delet'><input type='hidden' value='".$oq['id']."'/>Delete</div>";
        }
        elseif($oq['membership'] == '3'){
            $ma = "<div class='gr_immb'>Banned User.</div>";
            $xoq = "was banned on this group";
            $ka = "<div class='gr_accp'><input type='hidden' value='".$oq['id']."'/>Unblock</div><div class='gr_delet'><input type='hidden' value='".$oq['id']."'/>Delete</div>";
        }
        if($oq['isadmin'] == '0'){

        }
        else {

        }
        echo "<div class='entf' id='".$oq['id']."'>
        <div class='nothd' style='font-size: 13px;'>".$ma."</div>
        <div class='notct' style='font-size: 12px;'><i class='fas fa-at'></i>".$oq['user']." ".$xoq."
        <div class='gr_ppeo'>".$ka."</div></div>
        <div class='notim' style='text-align: right; padding-right: 15px; font-size: 13px;'>".date('Y M\' d h:i a',$oq['joined'])."</div>
        </div>";
    }
    
    echo "</div>
    ";
}
?>