<?php require_once('Connections/conJobsPerak.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['MM_UserID'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['MM_UserID']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "sessionGateway.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsJobSeekerInfo = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsJobSeekerInfo = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobSeekerInfo = sprintf("Select   jp_nationality.national_name,   jp_jobseeker.*,   jp_jobseeker.users_id_fk As users_id_fk1 From   jp_jobseeker Inner Join   jp_nationality On jp_jobseeker.jobseeker_nationality =     jp_nationality.national_id Where   jp_jobseeker.users_id_fk = %s", GetSQLValueString($colname_rsJobSeekerInfo, "int"));
$rsJobSeekerInfo = mysql_query($query_rsJobSeekerInfo, $conJobsPerak) or die(mysql_error());
$row_rsJobSeekerInfo = mysql_fetch_assoc($rsJobSeekerInfo);
$totalRows_rsJobSeekerInfo = mysql_num_rows($rsJobSeekerInfo);

$colname_rsCurrentUsers = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsCurrentUsers = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCurrentUsers = sprintf("SELECT * FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsCurrentUsers, "int"));
$rsCurrentUsers = mysql_query($query_rsCurrentUsers, $conJobsPerak) or die(mysql_error());
$row_rsCurrentUsers = mysql_fetch_assoc($rsCurrentUsers);
$totalRows_rsCurrentUsers = mysql_num_rows($rsCurrentUsers);

$colname_rsUserResume = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserResume = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserResume = sprintf("SELECT * FROM jp_resume WHERE users_id_fk = %s ORDER BY resume_id DESC LIMIT 1", GetSQLValueString($colname_rsUserResume, "int"));
$rsUserResume = mysql_query($query_rsUserResume, $conJobsPerak) or die(mysql_error());
$row_rsUserResume = mysql_fetch_assoc($rsUserResume);
$totalRows_rsUserResume = mysql_num_rows($rsUserResume);



//video resume 
$colname_rsUserResume = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsVideoResume = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsVideoResume = sprintf("SELECT * FROM mj_videoResume WHERE user_id_fk = %s ORDER BY id_videoResume DESC LIMIT 1", GetSQLValueString($colname_rsVideoResume, "int"));
$rsVideoResume = mysql_query($query_rsVideoResume, $conJobsPerak) or die(mysql_error());
$row_rsVideoResume = mysql_fetch_assoc($rsVideoResume);
$totalRows_rsVideoResume = mysql_num_rows($rsVideoResume);



$colname_rsUserEmpHistory = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserEmpHistory = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserEmpHistory = sprintf("Select   jp_experience.*,   jp_industry.indus_name,   jp_specialize.specialize_name,   jp_level.level_position From   jp_experience Inner Join   jp_industry On jp_experience.industry_id_fk = jp_industry.indus_id Inner Join   jp_specialize On jp_experience.exp_specialize = jp_specialize.specialize_id   Inner Join   jp_level On jp_experience.exp_pos_level = jp_level.level_id Where   jp_experience.users_id_fk = %s", GetSQLValueString($colname_rsUserEmpHistory, "int"));
$rsUserEmpHistory = mysql_query($query_rsUserEmpHistory, $conJobsPerak) or die(mysql_error());
$row_rsUserEmpHistory = mysql_fetch_assoc($rsUserEmpHistory);
$totalRows_rsUserEmpHistory = mysql_num_rows($rsUserEmpHistory);

$colname_rsUserQualification = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserQualification = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserQualification = sprintf("Select   jp_edu_lists.edu_name,   jp_field_list.field_name,   jp_education.*,   jp_grade_list.grade_name,   jp_nationality.national_name From   jp_education Inner Join   jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id   Inner Join   jp_field_list On jp_education.edu_fieldStudy = jp_field_list.field_id   Inner Join   jp_grade_list On jp_education.edu_grade = jp_grade_list.grade_id Inner Join   jp_nationality On jp_education.edu_located = jp_nationality.national_id Where   jp_education.user_id_fk = %s", GetSQLValueString($colname_rsUserQualification, "int"));
$rsUserQualification = mysql_query($query_rsUserQualification, $conJobsPerak) or die(mysql_error());
$row_rsUserQualification = mysql_fetch_assoc($rsUserQualification);
$totalRows_rsUserQualification = mysql_num_rows($rsUserQualification);

$colname_rsUserSkill = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserSkill = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserSkill = sprintf("SELECT * FROM jp_skills WHERE user_id_fk = %s", GetSQLValueString($colname_rsUserSkill, "int"));
$rsUserSkill = mysql_query($query_rsUserSkill, $conJobsPerak) or die(mysql_error());
$row_rsUserSkill = mysql_fetch_assoc($rsUserSkill);
$totalRows_rsUserSkill = mysql_num_rows($rsUserSkill);

$colname_rsUserLanguage = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserLanguage = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserLanguage = sprintf("Select   jp_language_list.languList_name,   jp_language.* From   jp_language Inner Join   jp_language_list On jp_language.lang_name = jp_language_list.languList_id Where   jp_language.user_id_fk = %s", GetSQLValueString($colname_rsUserLanguage, "int"));
$rsUserLanguage = mysql_query($query_rsUserLanguage, $conJobsPerak) or die(mysql_error());
$row_rsUserLanguage = mysql_fetch_assoc($rsUserLanguage);
$totalRows_rsUserLanguage = mysql_num_rows($rsUserLanguage);

$colname_rsUserJobPrefer = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserJobPrefer = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserJobPrefer = sprintf("Select   jp_location.location_name,   jp_jobpreferences.*,   jp_industry.indus_name From   jp_jobpreferences Inner Join   jp_location On jp_jobpreferences.jobP_1 = jp_location.location_id Inner Join   jp_industry On jp_jobpreferences.jobP_2 = jp_industry.indus_id Where   jp_jobpreferences.user_id_fk = %s", GetSQLValueString($colname_rsUserJobPrefer, "int"));
$rsUserJobPrefer = mysql_query($query_rsUserJobPrefer, $conJobsPerak) or die(mysql_error());
$row_rsUserJobPrefer = mysql_fetch_assoc($rsUserJobPrefer);
$totalRows_rsUserJobPrefer = mysql_num_rows($rsUserJobPrefer);

$colname_rsUserRefer = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserRefer = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserRefer = sprintf("SELECT * FROM jp_references WHERE user_id_fk = %s", GetSQLValueString($colname_rsUserRefer, "int"));
$rsUserRefer = mysql_query($query_rsUserRefer, $conJobsPerak) or die(mysql_error());
$row_rsUserRefer = mysql_fetch_assoc($rsUserRefer);
$totalRows_rsUserRefer = mysql_num_rows($rsUserRefer);

$colname_rsJsSPM = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsJsSPM = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJsSPM = sprintf("SELECT jp_spm_subject.subject_name,   jp_spm.* FROM jp_spm Inner Join   jp_spm_subject On jp_spm.spm_subject_id_fk = jp_spm_subject.subject_id WHERE jp_spm.user_id_fk = %s", GetSQLValueString($colname_rsJsSPM, "int"));
$rsJsSPM = mysql_query($query_rsJsSPM, $conJobsPerak) or die(mysql_error());
$row_rsJsSPM = mysql_fetch_assoc($rsJsSPM);
$totalRows_rsJsSPM = mysql_num_rows($rsJsSPM);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Jobsperak Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
  <link href="http://vjs.zencdn.net/4.1/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.1/video.js"></script>
</head>
<style type="text/css">

  
  .addInfo{
    padding:20px;


  }

</style>
<body>





  <header id="header">

    <div class="center">
       <div id="logo" class="left" style="margin:10px 0px 0px 0px;">
          <a href="index.php" title="Home">
            <img src="../images/logo.png" alt="logo.png" border="0">
          </a>
          
        </div><!-- /left -->

      <div class="right">
            <?php include 'session_checking_panel.php'; ?>
        </div>
      <div class="clear"></div>
    </div><!-- .center -->
    
    <?php include("main_menu.php"); ?>
  </header><!-- #header-->

  <div id="wrapper">
  
  <section id="middle">

      <div id="content_full">
<h2>JobSeeker Dashboard</h2>
<div class="master_details_full">
  
  <?php include("jobSeekerMenu.php"); ?>
    
    <!-- start diplaynone if not ic filled it. -->

    <?php if ($row_rsCurrentUsers['users_ic'] == NULL || $row_rsCurrentUsers['users_ic'] == 0){ ?>
      <div style="text-align:center; color:red"><h3>Opps! Please fill up / Update your ic number at <a href="jobSeekerEditProfile.php?email=<?php echo $row_rsCurrentUsers['users_email']; ?>" title="here">here</a> to adding / editing your resume.</h3></div>
      <div style="display:none">
    <?php } else { ?>
      <div>
    <?php } ?>
    
      
    <div style="margin: 20px 0px;">
      <table>
        <tr>
          <td>
            <img src="../images/flat/64/book.png" alt="Resume">
          </td>
          <td>
            <h3>My Resume</h3>
          </td>
        </tr>
      </table>
      </div>
        
    <div class="box resumebox">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="121"><img src="<?php echo $row_rsJobSeekerInfo['jobseeker_pic']; ?>" height="120px" /></td>
    <td width="279" align="left" valign="middle"><h3><?php echo $row_rsCurrentUsers['users_fname']; ?> <?php echo $row_rsCurrentUsers['users_lname']; ?></h3></td>
    </tr>
  <tr>
    <td>
    <?php if ($row_rsJobSeekerInfo['users_id_fk']== $_SESSION['MM_UserID']){ ?>
    
  <?php if ($row_rsJobSeekerInfo['jobseeker_pic'] == "media/jobseeker/default_jobseeker.png"){ ?>
    <a href="jobSeekerUploadPicture.php" class="btn btn-warning btn-mini">Upload Picture</a>
    <?php } else { ?>
    <a href="jobSeekerUploadPicture.php" class="btn btn-warning btn-mini">Change Picture</a>
    <?php } ?>
    
    <?php } else { // else display update your resume 1st  ?>
      Update your resume 1st to upload your picture
    <?php } ?>
    </td>
    <td>&nbsp;</td>
    </tr>
</table>

    </div>
        
    <div class="box resumebox">
      <strong>My Resume</strong> &middot;
        <?php if ($totalRows_rsUserResume == 0) { // Show if recordset empty ?>
          <a href="resumeUpload.php" class="btn btn-warning btn-mini">Upload</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsUserResume > 0) { // Show if recordset not empty ?>
          <a href="resumeUpload.php" class="btn btn-warning btn-mini">Upload new resume</a>
          <?php } // Show if recordset not empty ?>

       
<?php if ($totalRows_rsUserResume > 0) { // Show if recordset not empty ?>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="32">&nbsp;</td>  
      <td class="def_width_box_3">File name</td>
      <td width="22">:</td>
      <td><a href="media/resume_candidate/<?php echo $row_rsUserResume['resume_path']; ?>" ><?php echo $row_rsUserResume['resume_title']; ?></a></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Uploaded On</td>
      <td width="22">:</td>
      <td><?php echo date('l, d/m/Y',strtotime($row_rsUserResume['resume_upload_on'])); ?></td>
      </tr>
    
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
        
<!-- video resume -->
         <div class="box resumebox">
      <strong>My Video Resume</strong> &middot;
        <?php if ($totalRows_rsVideoResume == 0) { // Show if recordset empty ?>
          <a href="videoUpload.php" class="btn btn-warning btn-mini">Upload</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsVideoResume > 0) { // Show if recordset not empty ?>
          <a href="videoUpload.php" class="btn btn-warning btn-mini">Upload new video resume</a>
          <?php } // Show if recordset not empty ?>

       
<?php if ($totalRows_rsVideoResume > 0) { // Show if recordset not empty ?>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="32">&nbsp;</td>  
      <td class="def_width_box_3">File name</td>
      <td width="22">:</td>

      <td><video id="my_video_1" class="video-js vjs-default-skin" controls
          preload="auto" width="300" height="204" poster="<?php echo $row_rsJobSeekerInfo['jobseeker_pic']; ?>"
          data-setup="{}">
 <source src="media/video_candidate/<?php echo $row_rsVideoResume['video_path']; ?>" type='video/mp4'>

</video></td>


        <!-- <a href="media/video_candidate/<?php echo $row_rsVideoResume['video_path']; ?>">video resume</a></td> -->
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Uploaded On</td>
      <td width="22">:</td>
      <td><?php echo date('l, d/m/Y',strtotime($row_rsVideoResume['video_upload_on'])); ?></td>
      </tr>
     
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
    <div class="box resumebox">
      <strong>Personal Particulars</strong> &middot;
        <?php if ($totalRows_rsJobSeekerInfo == 0) { // Show if recordset empty ?>
          <a href="particularAdd.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Add</a>
    <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsJobSeekerInfo > 0) { // Show if recordset not empty ?>
          <a href="particularEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsCurrentUsers > 0) { // Show if recordset not empty ?>
            <table width="500" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="def_width_box">Name</td>
                <td width="22">:</td>
                <td><?php echo $row_rsCurrentUsers['users_fname']; ?> <?php echo $row_rsCurrentUsers['users_lname']; ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td width="22">:</td>
                <td><?php echo $row_rsCurrentUsers['users_email']; ?></td>
              </tr>
              <tr>
                <td>IC</td>
                <td>:</td>
                <td><?php if($row_rsCurrentUsers['users_ic']==NULL){echo "Not Provided";} else {echo "************";} ?></td>
              </tr>
              <tr>
                <td>Telephone No.</td>
                <td width="22">:</td>
                <td><?php  if($row_rsJobSeekerInfo['jobseeker_tel']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_tel'];} ?></td>
              </tr>
              <tr>
                <td>Mobile No.</td>
                <td width="22">:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_mobile']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_mobile'];} ?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td width="22">:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_address']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_address'];} ?></td>
              </tr>
              <tr>
                <td>Poscode</td>
                <td>:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_address_poscode']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['jobseeker_address_poscode'];} ?></td>
              </tr>
              <tr>
                <td>State</td>
                <td>:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_address_state']==NULL){echo "Not Provided";} else {
          
          $sql_display_state = mysql_fetch_object(mysql_query("SELECT * FROM jp_location WHERE location_id = ".$row_rsJobSeekerInfo['jobseeker_address_state']));
          echo ucfirst($sql_display_state->location_name);
          
          } ?></td>
              </tr>
              <tr>
                <td>District</td>
                <td>:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_address_district']==NULL || $row_rsJobSeekerInfo['jobseeker_address_district']== 0){echo "Not Provided";} else {
                  
                  $add_dist = $row_rsJobSeekerInfo['jobseeker_address_district'];

                  /**
                   *
                   * Record Set for district
                   * Retrieve via object 
                   * 
                   */
                  $query_district     = "SELECT * FROM jp_district WHERE dist_id = $add_dist";
                  $rs_district        = mysql_query($query_district) or die(mysql_error());
                  $row_district       = mysql_fetch_object($rs_district);
                  $totalRows_district = mysql_num_rows($rs_district);
                  
                  echo ucwords(strtolower($row_district->dist_name));

                } ?></td>
              </tr>
              <tr>
                <td>Subdistrict</td>
                <td>:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_address_subdistrict']==NULL || $row_rsJobSeekerInfo['jobseeker_address_subdistrict']==0){echo "Not Provided";} else {

                  $add_subdist = $row_rsJobSeekerInfo['jobseeker_address_subdistrict'];

                  /**
                   *
                   * Record Set for subdistrict
                   * Retrieve via object 
                   * 
                   */
                  $query_subdistrict     = "SELECT * FROM jp_subdistrict WHERE subdis_id = $add_subdist";
                  $rs_subdistrict        = mysql_query($query_subdistrict) or die(mysql_error());
                  $row_subdistrict       = mysql_fetch_object($rs_subdistrict);
                  $totalRows_subdistrict = mysql_num_rows($rs_subdistrict);
                  
                  echo ucwords(strtolower($row_subdistrict->subdist_name));


                } ?></td>
              </tr>
            </table>
            <table width="500" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="def_width_box">Date of Birth</td>
                <td width="22">:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_dob_d'] == NULL && $row_rsJobSeekerInfo['jobseeker_dob_m'] == NULL){echo "Not Provided";} else { echo $row_rsJobSeekerInfo['jobseeker_dob_d']." ".$row_rsJobSeekerInfo['jobseeker_dob_m']." ".$row_rsJobSeekerInfo['jobseeker_dob_y'];} ?></td>
              </tr>
              <tr>
                <td>Gender</td>
                <td width="22">:</td>
                <td><?php if($row_rsJobSeekerInfo['jobseeker_gender'] == 1){echo "Female";}else{echo"Male";} ?></td>
              </tr>
              <tr>
                <td>Marital Status</td>
                <td width="22">:</td>
                <td><?php if($row_rsJobSeekerInfo['marital_status'] == NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['marital_status'];} ?></td>
              </tr>
              <tr>
                <td>Nationality</td>
                <td width="22">:</td>
                <td><?php if ($row_rsJobSeekerInfo['national_name']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['national_name'];} ?></td>
              </tr>
              <tr>
                <td>Employment Status</td>
                <td>:</td>
                <td><?php if($row_rsJobSeekerInfo['employment_status']==NULL){echo "Not Provided";} else {echo ucwords(strtolower($row_rsJobSeekerInfo['employment_status']));} ?></td>
              </tr>
          </table>
            <?php } // Show if recordset not empty ?>
    </div>

    <div class="box resumebox">
      <strong>Licenses</strong>
      <?php 



      /**
       *
       * Record Set for licenses
       * Retrieve via object 
       * 
       */
      $query_licenses     = "SELECT * FROM jp_licenses WHERE user_id_fk = " . mysql_real_escape_string($row_rsCurrentUsers['users_id']);
      $rs_licenses        = mysql_query($query_licenses) or die(mysql_error());
      $totalRows_licenses = mysql_num_rows($rs_licenses);

      if ($totalRows_licenses == 0 || $totalRows_licenses != 0) {
              echo " &middot; <a href=\"licenseAdd.php\" title=\"Add Licenses\" class=\"btn btn-warning btn-mini\">Add Licenses</a>";
      }      

      ?>
      <table width="500" border="0" cellspacing="0" cellpadding="2">
        <tbody>
          <tr>
            <td width="10">Type</td>
            <td width="10"> : </td>
            <td width="10">
              <?php if ($totalRows_licenses != 0){ ?>
                <?php  

                while ($row_licenses       = mysql_fetch_object($rs_licenses)) {
                  echo $row_licenses->license_type;
                  echo ', ';
                }
                ?>
              <?php } else { ?>
                Not Provided
              <?php } ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
        
    <div class="box resumebox">
      <strong>Experience</strong> &middot;
        <?php if ($totalRows_rsUserEmpHistory == 0) { // Show if recordset empty ?>
          <a href="experienceAdd.php" class="btn btn-warning btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsUserEmpHistory > 0) { // Show if recordset not empty ?>
          <a href="experienceEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
        <br/><br/>
        
        <?php if ($totalRows_rsUserEmpHistory > 0) { // Show if recordset not empty ?>
        <strong>Employment History</strong><br/><br/>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    
    <?php do { ?>
      <tr>
        <td width="10"><?php //echo $i; ?></td>
        <td class="def_width_box_2">Company Name</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_co_name']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Position Title</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_pos_title']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Specialization</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['specialize_name']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Role</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_role']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Monthly Salary</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_monthlysalary']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Work Description</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_word_desc']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>From / To</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['exp_from_to']; ?> / <?php echo $row_rsUserEmpHistory['exp_from_to_y']; ?> - <?php echo $row_rsUserEmpHistory['exp_to_m']; ?> / <?php echo $row_rsUserEmpHistory['exp_to_y']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Position Level</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserEmpHistory['level_position']; ?></td>
      </tr>
      <tr><td colspan="4">&nbsp;</td></tr>
      <?php } while ($row_rsUserEmpHistory = mysql_fetch_assoc($rsUserEmpHistory)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
        
    <div class="box resumebox">
      <strong>Qualification</strong> &middot;
        <?php if ($totalRows_rsUserQualification == 0) { // Show if recordset empty ?>
          <a href="qualificationAdd.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsUserQualification > 0) { // Show if recordset not empty ?>
          <a href="qualificationEdit.php?cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
        <?php if ($totalRows_rsUserQualification > 0) { // Show if recordset not empty ?>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    <?php do { ?>
      <tr>
        <td width="10">&nbsp;</td>
        <td class="def_width_box_2">Qualification</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['edu_name']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>CGPA</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['edu_cgpa']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Field of Study</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['field_name']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Major</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['edu_major']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Institute / University</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['edu_university']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Graduated</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['edu_date_graduate_month']; ?> <?php echo $row_rsUserQualification['edu_date_graduate_year']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Located in</td>
        <td width="22">:</td>
        <td><?php echo $row_rsUserQualification['national_name']; ?></td>
      </tr>
      <tr>
      <td colspan="4">&nbsp;</td>
        <?php } while ($row_rsUserQualification = mysql_fetch_assoc($rsUserQualification)); ?>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
    
    
    <div class="box resumebox">
      <strong>SPM</strong> &middot;
          <a href="spmAdd.php" class="btn btn-success btn-mini">Add Subject</a> &middot; 
        <?php if ($totalRows_rsJsSPM > 0) { // Show if recordset not empty ?>
          <a href="spmEdit.php" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
        <?php if ($totalRows_rsJsSPM > 0) { // Show if recordset not empty ?>
  <table width="600" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <th>Subject</th>
      <th class="def_width_box_2">Grade</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsJsSPM['subject_name']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsJsSPM['spm_grade']; ?></td>
      </tr>
      <?php } while ($row_rsJsSPM = mysql_fetch_assoc($rsJsSPM)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
        
    <div class="box resumebox">
      <strong>Skills</strong> &middot;
        <?php if ($totalRows_rsUserSkill == 0) { // Show if recordset empty ?>
          <a href="skillsAdd.php" class="btn btn-success btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsUserSkill > 0) { // Show if recordset not empty ?>
          <a href="skillsEdit.php" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsUserSkill > 0) { // Show if recordset not empty ?>
<br/><br/>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <th>Skill</th>
      <th>Years of Experience</th>
      <th>Proficiency</th>
      </tr>
    <?php do { ?>
      <tr>
        <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_name']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_y_exp']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_proficiency']; ?></td>
      </tr>
      <?php } while ($row_rsUserSkill = mysql_fetch_assoc($rsUserSkill)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
    </div>
        
        
     <div class="box resumebox">
      <strong>Languages</strong> &middot; 
        <?php if ($totalRows_rsUserLanguage == 0) { // Show if recordset empty ?>
          <a href="languageAdd.php" class="btn btn-success btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsUserLanguage > 0) { // Show if recordset not empty ?>
          <a href="languageEdit.php" class="btn btn-warning btn-mini">Edit</a>
          <?php } // Show if recordset not empty ?>
        <?php if ($totalRows_rsUserLanguage > 0) { // Show if recordset not empty ?>
        <span style="text-align:center"><strong><br/><br/>Proficiency</strong> (0=Poor - 10=Excellent)</span><br/><br/>
  <table width="500" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <th align="left">Language</th>
      <th>Written</th>
      <th>Spoken</th>
      </tr>
    <?php do { ?>
      <tr>
        <td align="left" valign="middle"><?php echo $row_rsUserLanguage['languList_name']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsUserLanguage['lang_written']; ?></td>
        <td align="center" valign="middle"><?php echo $row_rsUserLanguage['lang_spoken']; ?></td>
      </tr>
      <?php } while ($row_rsUserLanguage = mysql_fetch_assoc($rsUserLanguage)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
     </div>
        
     <div class="box resumebox">
      <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
      <strong>Interpersonal Skills</strong><br/><br/></td></tr>
      <tr>
       <td class="addInfo"><?php if($row_rsJobSeekerInfo['jobseeker_moreinfo']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['jobseeker_moreinfo']; } ?></td>
      </tr></table></div>
        
     <div class="box resumebox">
      <strong>Job Preferences</strong> &middot;
        <?php if ($totalRows_rsUserJobPrefer == 0) { // Show if recordset empty ?>
          <a href="jobPreferAdd.php" class="btn btn-success btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsUserJobPrefer > 0) { // Show if recordset not empty ?>
              <?php 
        $maxJobPrefer = (3-$totalRows_rsUserJobPrefer);
        
        if($maxJobPrefer < 3) {
          echo "You can add up to ".$maxJobPrefer." more(s)";
        
        if($maxJobPrefer != 0){
          echo " <a href=\"jobPreferAdd.php\" class=\"btn btn-success btn-mini\">Add New</a>";
        } 
        
              }
        
              ?>
              
<?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsUserJobPrefer > 0) { // Show if recordset not empty ?><br/><br/>
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <?php do { ?>
      <tr>
        <td>
          <table width="500" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="def_width_box">Preferred Work Location(s)</td>
              <td width="22">:</td>
              <td><?php echo $row_rsUserJobPrefer['location_name']; ?></td>
              </tr>
            <tr>
              <td>Preferred Job Industry(s)</td>
              <td width="22">:</td>
              <td><?php echo $row_rsUserJobPrefer['indus_name']; ?></td>
              </tr>
            <tr>
              <td>Expected Monthly Salary</td>
              <td width="22">:</td>
              <td><?php echo $row_rsUserJobPrefer['jobP_salary']; ?></td>
              </tr>
            <tr>
              <td colspan="3"><a href="jobPreferEditDetails.php?jobP_id=<?php echo $row_rsUserJobPrefer['jobP_id']; ?>&cuid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Edit</a></td>
              </tr>
            
          </table>
        </td>
      </tr>
      <?php } while ($row_rsUserJobPrefer = mysql_fetch_assoc($rsUserJobPrefer)); ?>
  </table>

  <?php } // Show if recordset not empty ?>
     </div>
        
     <div class="box resumebox">
      <strong>References</strong> &middot;
        <?php if ($totalRows_rsUserRefer == 0) { // Show if recordset empty ?>
          <a href="referencesAdd.php" class="btn btn-success btn-mini">Add</a>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_rsUserRefer > 0) { // Show if recordset not empty ?>
            <a href="referencesEditDetails.php?ref_id=<?php echo $row_rsUserRefer['ref_id']; ?>&uid=<?php echo $_SESSION['MM_UserID']; ?>" class="btn btn-warning btn-mini">Edit</a>
            <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsUserRefer > 0) { // Show if recordset not empty ?>
            <table width="500" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="def_width_box">Name</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_name']; ?></td>
              </tr>
              <tr>
                <td>Relationship </td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_relationship']; ?></td>
              </tr>
              <tr>
                <td>Email </td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_email']; ?></td>
              </tr>
              <tr>
                <td>Telephone </td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_phone']; ?></td>
              </tr>
              <tr>
                <td>Position Title</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_pos_title']; ?></td>
              </tr>
              <tr>
                <td>Company Name</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserRefer['ref_comp_name']; ?></td>
              </tr>
            </table>
            <?php } // Show if recordset not empty ?>
     </div>

    
</div>

</div><!-- /displaynone for none ic filled it. -->

          </div><!-- #content-->
  
      <!-- <aside id="sideRight"> -->
              <?php //include('full_content_sidebar.php'); ?>
          <!-- </aside> -->
      <!-- aside -->
      <!-- #sideRight -->
    

  </section><!-- #middle-->

  </div><!-- #wrapper-->

  <footer id="footer">
    <div class="center">
      <?php include("footer.php"); ?>
    </div><!-- .center -->
  </footer><!-- #footer -->



</body>
</html>
<?php
mysql_free_result($rsJobSeekerInfo);

mysql_free_result($rsCurrentUsers);

mysql_free_result($rsUserResume);

mysql_free_result($rsUserEmpHistory);

mysql_free_result($rsUserQualification);

mysql_free_result($rsUserSkill);

mysql_free_result($rsUserLanguage);

mysql_free_result($rsUserJobPrefer);

mysql_free_result($rsUserRefer);

mysql_free_result($rsJsSPM);
?>
