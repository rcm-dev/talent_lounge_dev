<?php  


/**
 * User network View
 */



echo "<h2 class=\"title\">Account Setting</h2><br/><br/>";

include '../db/db-connect.php';
//include '../session_checking.php';
include '../class/short.php';

$usr_id = $_GET['id'];

$settingSQL = "SELECT
  mj_users.usr_name As setusername,
  mj_users.usr_pwd As setpassword,
  mj_users.usr_email As setemail,
  mj_users.user_pic,
  mj_users.usr_last_login AS setLastlogin,
  mj_users.usr_workat,
  mj_users.usr_tel As setTel,
  mj_users.usr_general_info As setGeneralInFo,
  _company.comp_name As setcompanyName,
  mj_users.usr_id
From
  mj_users Inner Join
  _company On mj_users.usr_workat = _company.comp_co_num
Where
  mj_users.usr_id = '$usr_id'";


$resultSetting = mysql_query($settingSQL);
$rowSetting = mysql_fetch_object($resultSetting);

?>

<div>

<div>
<table width="590" border="0" cellpadding="3" cellspacing="3">
  <tr>
    <td>Username</td>
    <td>&nbsp;</td>
    <td><?php echo ucwords($rowSetting->setusername); ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td>&nbsp;</td>
    <td><?php echo $rowSetting->setemail; ?></td>
  </tr>
  <tr>
    <td>Last Login</td>
    <td>&nbsp;</td>
    <td><?php echo $rowSetting->setLastlogin; ?></td>
  </tr>
  <tr>
    <td>Phone No</td>
    <td>&nbsp;</td>
    <td><?php echo $rowSetting->setTel; ?></td>
  </tr>
  <tr>
    <td>General Info</td>
    <td>&nbsp;</td>
    <td><?php echo $rowSetting->setGeneralInFo; ?></td>
  </tr>
  <tr>
    <td>Work at</td>
    <td>&nbsp;</td>
    <td><?php echo $rowSetting->setcompanyName; ?></td>
  </tr>
</table>

</div>


<div>
<br/>
<br/>
<a href="#edit-profile-container" id="editProfile">Edit</a>
</div>


<script type="text/javascript">
$(document).ready(function(){


  $('#editProfile').fancybox({
    'titlePosition'   : 'inside',

    'transitionIn'    : 'none',

    'transitionOut'   : 'none'
  });

});
</script>