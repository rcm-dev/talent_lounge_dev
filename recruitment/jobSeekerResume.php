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
$MM_authorizedUsers = "2";
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
if (isset($_GET['js_id'])) {
  $colname_rsJobSeekerInfo = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobSeekerInfo = sprintf("SELECT jp_nationality.national_name,   jp_jobseeker.*,   jp_jobseeker.users_id_fk As users_id_fk1 FROM jp_jobseeker Inner Join   jp_nationality On jp_jobseeker.jobseeker_nationality =     jp_nationality.national_id WHERE jp_jobseeker.users_id_fk = %s", GetSQLValueString($colname_rsJobSeekerInfo, "int"));
$rsJobSeekerInfo = mysql_query($query_rsJobSeekerInfo, $conJobsPerak) or die(mysql_error());
$row_rsJobSeekerInfo = mysql_fetch_assoc($rsJobSeekerInfo);
$totalRows_rsJobSeekerInfo = mysql_num_rows($rsJobSeekerInfo);

$colname_rsCurrentUsers = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsCurrentUsers = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCurrentUsers = sprintf("SELECT * FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsCurrentUsers, "int"));
$rsCurrentUsers = mysql_query($query_rsCurrentUsers, $conJobsPerak) or die(mysql_error());
$row_rsCurrentUsers = mysql_fetch_assoc($rsCurrentUsers);
$totalRows_rsCurrentUsers = mysql_num_rows($rsCurrentUsers);

$colname_rsUserResume = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserResume = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserResume = sprintf("SELECT * FROM jp_resume WHERE users_id_fk = %s", GetSQLValueString($colname_rsUserResume, "int"));
$rsUserResume = mysql_query($query_rsUserResume, $conJobsPerak) or die(mysql_error());
$row_rsUserResume = mysql_fetch_assoc($rsUserResume);
$totalRows_rsUserResume = mysql_num_rows($rsUserResume);

$colname_rsUserEmpHistory = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserEmpHistory = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserEmpHistory = sprintf("SELECT jp_experience.*,   jp_industry.indus_name,   jp_specialize.specialize_name,   jp_level.level_position FROM jp_experience Inner Join   jp_industry On jp_experience.industry_id_fk = jp_industry.indus_id Inner Join   jp_specialize On jp_experience.exp_specialize = jp_specialize.specialize_id   Inner Join   jp_level On jp_experience.exp_pos_level = jp_level.level_id WHERE jp_experience.users_id_fk = %s", GetSQLValueString($colname_rsUserEmpHistory, "int"));
$rsUserEmpHistory = mysql_query($query_rsUserEmpHistory, $conJobsPerak) or die(mysql_error());
$row_rsUserEmpHistory = mysql_fetch_assoc($rsUserEmpHistory);
$totalRows_rsUserEmpHistory = mysql_num_rows($rsUserEmpHistory);

$colname_rsUserQualification = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserQualification = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserQualification = sprintf("SELECT jp_edu_lists.edu_name,   jp_field_list.field_name,   jp_education.*,   jp_grade_list.grade_name,   jp_nationality.national_name FROM jp_education Inner Join   jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id   Inner Join   jp_field_list On jp_education.edu_fieldStudy = jp_field_list.field_id   Inner Join   jp_grade_list On jp_education.edu_grade = jp_grade_list.grade_id Inner Join   jp_nationality On jp_education.edu_located = jp_nationality.national_id WHERE jp_education.user_id_fk = %s", GetSQLValueString($colname_rsUserQualification, "int"));
$rsUserQualification = mysql_query($query_rsUserQualification, $conJobsPerak) or die(mysql_error());
$row_rsUserQualification = mysql_fetch_assoc($rsUserQualification);
$totalRows_rsUserQualification = mysql_num_rows($rsUserQualification);

$colname_rsUserSkill = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserSkill = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserSkill = sprintf("SELECT * FROM jp_skills WHERE user_id_fk = %s", GetSQLValueString($colname_rsUserSkill, "int"));
$rsUserSkill = mysql_query($query_rsUserSkill, $conJobsPerak) or die(mysql_error());
$row_rsUserSkill = mysql_fetch_assoc($rsUserSkill);
$totalRows_rsUserSkill = mysql_num_rows($rsUserSkill);

$colname_rsUserLanguage = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserLanguage = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserLanguage = sprintf("SELECT jp_language_list.languList_name,   jp_language.* FROM jp_language Inner Join   jp_language_list On jp_language.lang_name = jp_language_list.languList_id WHERE jp_language.user_id_fk = %s", GetSQLValueString($colname_rsUserLanguage, "int"));
$rsUserLanguage = mysql_query($query_rsUserLanguage, $conJobsPerak) or die(mysql_error());
$row_rsUserLanguage = mysql_fetch_assoc($rsUserLanguage);
$totalRows_rsUserLanguage = mysql_num_rows($rsUserLanguage);

$colname_rsUserJobPrefer = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserJobPrefer = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserJobPrefer = sprintf("SELECT jp_location.location_name,   jp_jobpreferences.*,   jp_industry.indus_name FROM jp_jobpreferences Inner Join   jp_location On jp_jobpreferences.jobP_1 = jp_location.location_id Inner Join   jp_industry On jp_jobpreferences.jobP_2 = jp_industry.indus_id WHERE jp_jobpreferences.user_id_fk = %s", GetSQLValueString($colname_rsUserJobPrefer, "int"));
$rsUserJobPrefer = mysql_query($query_rsUserJobPrefer, $conJobsPerak) or die(mysql_error());
$row_rsUserJobPrefer = mysql_fetch_assoc($rsUserJobPrefer);
$totalRows_rsUserJobPrefer = mysql_num_rows($rsUserJobPrefer);

$colname_rsUserRefer = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsUserRefer = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserRefer = sprintf("SELECT * FROM jp_references WHERE user_id_fk = %s", GetSQLValueString($colname_rsUserRefer, "int"));
$rsUserRefer = mysql_query($query_rsUserRefer, $conJobsPerak) or die(mysql_error());
$row_rsUserRefer = mysql_fetch_assoc($rsUserRefer);
$totalRows_rsUserRefer = mysql_num_rows($rsUserRefer);

$colname_rsJobSeekerCheck = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsJobSeekerCheck = $_GET['js_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobSeekerCheck = sprintf("SELECT * FROM jp_jobseeker WHERE users_id_fk = %s", GetSQLValueString($colname_rsJobSeekerCheck, "int"));
$rsJobSeekerCheck = mysql_query($query_rsJobSeekerCheck, $conJobsPerak) or die(mysql_error());
$row_rsJobSeekerCheck = mysql_fetch_assoc($rsJobSeekerCheck);
$totalRows_rsJobSeekerCheck = mysql_num_rows($rsJobSeekerCheck);

$colname_rsJsSPM = "-1";
if (isset($_GET['js_id'])) {
  $colname_rsJsSPM = $_GET['js_id'];
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
</head>
<style>
  .contact{
    padding:0px 0px 0px 150px;
  }
  .title1{
    padding:0px 0px 0px 230px;
    background-color:#adfbdc;
    font-size: 15px;
  }
   .title2{
    padding:0px 0px 0px 270px;
    background-color:#adfbdc;
    font-size: 15px;
  }
.addInfo{
    padding:20px;


  }
  .resumeTitle{
    font-size: 25px;
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
	    <h2>JobSeeker Resume</h2>
	    <div class="master_details_full">
	      <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
	      <?php include("employer_menu.php"); ?>
	      <br/>
	     <div class="resumeTitle"><strong>Candidate Resume</strong></div><br/>
        <br/>
         <div>
      <?php  

      /****************************
       *
       * Record Set for CheckPackage 
       * MySQL Info 
       * Table Used CheckPackage
       *
       ***************************/
      
      $query_rsCheckPackage = "SELECT * FROM jp_employer WHERE users_id_fk = " . $_SESSION['MM_UserID'];
      $result_rsCheckPackage = mysql_query($query_rsCheckPackage);
      $total_rows_rsCheckPackage = mysql_num_rows($result_rsCheckPackage);
      $row_rsCheckPackage = mysql_fetch_object($result_rsCheckPackage);


      if ($row_rsCheckPackage->emp_featured == 0 && $row_rsCheckPackage->emp_package == 0) {
        $package = 'free';
      }
      if ($row_rsCheckPackage->emp_featured == 1 && $row_rsCheckPackage->emp_package == 1) {
        $package = 'basic';
      }
      if ($row_rsCheckPackage->emp_featured == 1 && $row_rsCheckPackage->emp_package == 2) {
        $package = 'premium';
      }
      if ($row_rsCheckPackage->emp_featured == 1 && $row_rsCheckPackage->emp_package == 3) {
        $package = 'platinum';
      }

      ?>
    </div>
          
          <?php if ($totalRows_rsJobSeekerCheck == 0) { // Show if recordset empty ?>
  <p>Ops..There no resume details here. <a href="employerBrowseResume.php">Back</a></p>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_rsJobSeekerCheck > 0) { // Show if recordset not empty ?>
          <div id="resume_details_container">
         
          
          <div class="box resumebox">
    <table align ="center" width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center"><img src="<?php echo $row_rsJobSeekerInfo['jobseeker_pic']; ?>" width="100" /><br/>      <br/><br/><h3><?php echo $row_rsCurrentUsers['users_fname']; ?>&nbsp;<?php echo $row_rsCurrentUsers['users_lname']; ?></h3><br/>
      <?php if($row_rsJobSeekerInfo['jobseeker_address']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_address'];} ?></td>
      </tr>
 </table>
  <div class="contact">
 <table align ="center" width="306" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100" align="left"><b>Telephone No</b></td>
    <td width="22">:</td>
    <td width="207">
      <?php  
    if ($package != 'free' && $package != 'basic') { ?>
      <?php  if($row_rsJobSeekerInfo['jobseeker_tel']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_tel'];} ?>
   <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>


 
    </td>
  </tr>
            <tr>
              <td width="100" align="left"><b>Mobile No</b></td>
              <td width="22">:</td>
              <td width="207" >
               <?php  
              if ($package != 'free' && $package != 'basic') { ?>
                <?php if($row_rsJobSeekerInfo['jobseeker_mobile']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_mobile'];} ?>
<?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>

              </td>
              </tr>
           <tr>
              <td width="100" align="left"><b>Email</b></td>
              <td width="22">:</td>
               <td width="207">
 <?php  
              if ($package != 'free' && $package != 'basic') { ?>

                <?php echo $row_rsCurrentUsers['users_email']; ?>

              <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>
   </td>
              </tr>
          
          
</table>
</div>
</div>
  
          
	        <div class="box resumebox boxes"> <strong>Uploaded Resume</strong>
	          <?php if ($totalRows_rsUserResume > 0) { // Show if recordset not empty ?>
	            <table width="500" border="0" cellspacing="0" cellpadding="2">
	              <tr>
	                <td width="32">&nbsp;</td>
	                <td class="def_width_box_3">Resume</td>
	                <td width="22">:</td>
	                <td>
                    <?php 
                    // basic menu
                    if ($package != 'free' && $package != 'basic') { ?>
                      <a href="media/resume/<?php echo $row_rsUserResume['resume_path']; ?>"><?php echo $row_rsUserResume['resume_title']; ?></a>
                    <?php } else { ?>
                      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
                    <?php } ?>
                    </td>
                  </tr>
	             <!--  <tr>
	                <td>&nbsp;</td>
	                <td>Uploaded On</td>
	                <td width="22">:</td>
	                <td>
                    <?php 
                    // basic menu
                    if ($package != 'free'&& $package != 'basic') { ?>
                      <?php echo date('l, m/d/Y',strtotime($row_rsUserResume['resume_upload_on'])); ?>
                    <?php } else { ?>
                      <strong class="upgrade_premium">[UPGRADE TO PREMIUM]</strong>
                    <?php } ?>
                    </td>
                  </tr> -->
              </table>
	            <?php } // Show if recordset not empty ?>
          </div>
	        <div class="box resumebox boxes">
	        <div class="title1"><strong>Personal Particulars</strong></div>
          
	        <?php if ($totalRows_rsCurrentUsers > 0) { // Show if recordset not empty ?>
	         <table width="500" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="def_width_box">Date of Birth</td>
              <td width="22">:</td>
              <td><?php if($row_rsJobSeekerInfo['jobseeker_dob_d'] == NULL && $row_rsJobSeekerInfo['jobseeker_dob_m'] == NULL){echo "Not Provided";} else { echo $row_rsJobSeekerInfo['jobseeker_dob_d']." ".$row_rsJobSeekerInfo['jobseeker_dob_m']." ".$row_rsJobSeekerInfo['jobseeker_dob_y'];} ?></td>
              </tr>
            <tr>
              <td>Gender</td>
              <td width="22">:</td>
              <td><?php if($row_rsJobSeekerInfo['jobseeker_gender'] == 1){echo "Female";}else{echo"Male";} ?>
              </td>
              
              </tr>
              
            <tr>
              <td>Nationality</td>
              <td width="22">:</td>
              <td><?php if ($row_rsJobSeekerInfo['national_name']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['national_name'];} ?></td>
              </tr>
              <tr>
              <td>Marital Status</td>
              <td width="22">:</td>
              <td><?php if ($row_rsJobSeekerInfo['marital_status']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['marital_status'];} ?></td>
              </tr>
          </table>
	        
	        <?php } // Show if recordset not empty ?>
        </div>
        <div class="box resumebox"><div class="title1"><strong>Qualification</strong></div>
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
       


        <div class="box resumebox"><div class="title2"><strong>Skills</strong></div>
        <?php  
              if ($package != 'free' && $package != 'basic') { ?>
        <?php if ($totalRows_rsUserSkill > 0) { // Show if recordset not empty ?>
          <br/>
          <br/>
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

           <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>
        </div>

       

        <div class="box resumebox"><div class="title1"><strong>Languages</strong></div>
        <?php  
              if ($package != 'free' && $package != 'basic') { ?>
        <?php if ($totalRows_rsUserLanguage > 0) { // Show if recordset not empty ?>
          <span style="text-align:center"><strong>
            <br/>
            Proficiency</strong> (0=Poor - 10=Excellent)</span><br/>
          <br/>
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
           <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>
        </div>
         <div class="box resumebox"><div class="title1"><strong>Interpersonal Skills</strong><br/></div>
           <?php  
              if ($package != 'free' && $package != 'basic') { ?>
        <table width="500" border="0" cellspacing="0" cellpadding="2">
         <tr><td class="addInfo"><?php if($row_rsJobSeekerInfo['jobseeker_moreinfo']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['jobseeker_moreinfo']; } ?></td></tr>
       </table>
        <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>
        </div>
	       <div class="box resumebox"><div class="title1"><strong>Experience</strong></div><br/>
	      <br/>
          <?php  
              if ($package != 'free' && $package != 'basic') { ?>
	      <?php if ($totalRows_rsUserEmpHistory > 0) { // Show if recordset not empty ?>
	        <strong>Employment History</strong><br/>
	        <br/>
	        <table width="500" border="0" cellspacing="0" cellpadding="2">
	          <?php do { ?>
	            <tr>
	              <td width="10">&nbsp;</td>
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
                <td>Date Joined</td>
                <td width="22">:</td>
                <?php 
                    $fromJob = $row_rsUserEmpHistory['exp_from_to_y'];
                    $toJob = $row_rsUserEmpHistory['exp_to_y'];
                    $total = $toJob - $fromJob;
                 ?>
                 
                <td><?php echo "$total"; ?>&nbsp;years</td>
              </tr>
	            <tr>
	              <td></td>
	              <td>Position Level</td>
	              <td width="22">:</td>
	              <td><?php echo $row_rsUserEmpHistory['level_position']; ?></td>
              </tr>
	            <tr>
	              <td colspan="4">&nbsp;</td>
              </tr>
	            <?php } while ($row_rsUserEmpHistory = mysql_fetch_assoc($rsUserEmpHistory)); ?>
          </table>
	        <?php } // Show if recordset not empty ?>
          <?php } else {?>
      <strong class="upgrade_premium">[UPGRADE TO PEMIUM]</strong>
     <?php } ?>
        </div>
	  
	    
      </div>
	  <?php } // Show if recordset not empty ?>
	  <!-- #resume_details_container-->
</div>
    </div>
    <!-- #content-->
    
    <!-- #sideRight -->
    </section>
    <!-- #middle-->
    </div>
    <!-- #wrapper-->

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

mysql_free_result($rsJobSeekerCheck);

mysql_free_result($rsJsSPM);
?>