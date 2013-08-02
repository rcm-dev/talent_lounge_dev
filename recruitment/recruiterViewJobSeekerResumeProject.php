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
$MM_authorizedUsers = "3";
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

<body>
<?php 

/****************************
  *
  * Record Set for AGentID 
  * MySQL Info 
  * Table Used AGentID
  *
  ***************************/
 
 $query_rsAGentID = "SELECT * FROM recruit_profile WHERE user_id_fk = " . $_SESSION['MM_UserID'];
 $result_rsAGentID = mysql_query($query_rsAGentID);
 $rows_rsAGentID = mysql_fetch_object($result_rsAGentID);
 
 


/****************************
 *
 * Record Set for ProjectLists 
 * MySQL Info 
 * Table Used ProjectLists
 *
 ***************************/

$query_rsProjectLists = "SELECT * FROM recruit_apointed WHERE ra_status = 1 AND ra_recruit_id_fk = " . $rows_rsAGentID->rp_id;
$result_rsProjectLists = mysql_query($query_rsProjectLists);
$total_rows_rsProjectLists = mysql_num_rows($result_rsProjectLists);


?>
<div style="width:600px;">
  <h3><a href="ajax/requestJobSeekerProjectAgent.php?viewPID=<?php echo $_GET['PID'] ?>">&larr; Back to Lists</a></h3>
  <br>
</div>


<?php if ($totalRows_rsJobSeekerCheck > 0) { // Show if recordset not empty ?>
	        <div id="resume_details_container">
	        <div class="box">
	          <h3>Jobseeker Resume</h3>
          </div>
          
          <div class="box resumebox">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="121"><img src="<?php echo $row_rsJobSeekerInfo['jobseeker_pic']; ?>" width="80" /></td>
    <td width="279" align="left" valign="middle"><h3><?php echo $row_rsCurrentUsers['users_fname']; ?><?php echo $row_rsCurrentUsers['users_lname']; ?></h3></td>
    </tr>
  <tr>
    <td>&nbsp;
    
    </td>
    <td>&nbsp;</td>
    </tr>
</table>

    </div>
          
	        <div class="box resumebox"> <strong>Uploaded Resume</strong>
	          <?php if ($totalRows_rsUserResume > 0) { // Show if recordset not empty ?>
	            <table width="500" border="0" cellspacing="0" cellpadding="2">
	              <tr>
	                <td width="32">&nbsp;</td>
	                <td class="def_width_box_3">Resume</td>
	                <td width="22">:</td>
	                <td>
                      <a href="media/resume/<?php echo $row_rsUserResume['resume_path']; ?>"><?php echo $row_rsUserResume['resume_title']; ?></a>
                    </td>
                  </tr>
	              <tr>
	                <td>&nbsp;</td>
	                <td>Uploaded On</td>
	                <td width="22">:</td>
	                <td>
                      <?php echo date('l, m/d/Y',strtotime($row_rsUserResume['resume_upload_on'])); ?>
                    </td>
                  </tr>
              </table>
	            <?php } // Show if recordset not empty ?>
          </div>
	        <div class="box resumebox">
	        <strong>Personal Particulars</strong>
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
	            <td>
                  <?php echo $row_rsCurrentUsers['users_email']; ?>
                </td>
              </tr>
	          <tr>
	            <td>Telephone No.</td>
	            <td width="22">:</td>
	            <td>
                  <?php  if($row_rsJobSeekerInfo['jobseeker_tel']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_tel'];} ?>
              </td>
              </tr>
	          <tr>
	            <td>Mobile No.</td>
	            <td width="22">:</td>
	            <td>
                  <?php if($row_rsJobSeekerInfo['jobseeker_mobile']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_mobile'];} ?>
              </td>
              </tr>
	          <tr>
	            <td>Address</td>
	            <td width="22">:</td>
	            <td><?php if($row_rsJobSeekerInfo['jobseeker_address']==NULL){echo "Not Provided";}else{echo $row_rsJobSeekerInfo['jobseeker_address'];} ?></td>
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
	            <td><?php if($row_rsJobSeekerInfo['jobseeker_gender'] == 1){echo "Female";}else{echo"Male";} ?>
	            </td>
	            
	            </tr>
	            
	          <tr>
	            <td>Nationality</td>
	            <td width="22">:</td>
	            <td><?php if ($row_rsJobSeekerInfo['national_name']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['national_name'];} ?></td>
              </tr>
          </table>
	        <?php } // Show if recordset not empty ?>
        </div>
	    <div class="box resumebox"> <strong>Experience</strong> <br/>
	      <br/>
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
	            <tr>
	              <td colspan="4">&nbsp;</td>
              </tr>
	            <?php } while ($row_rsUserEmpHistory = mysql_fetch_assoc($rsUserEmpHistory)); ?>
          </table>
	        <?php } // Show if recordset not empty ?>
        </div>
	    <div class="box resumebox"> <strong>Qualification</strong>
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
    	<strong>SPM</strong><br/>
        <?php if ($totalRows_rsJsSPM == 0) { // Show if recordset empty ?>
          No Data
  <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsJsSPM > 0) { // Show if recordset not empty ?>
  <table width="560" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <th width="200">Subject</th>
      <th>Grade</th>
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
        
	    <div class="box resumebox"> <strong>Skills</strong>
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
        </div>
	    <div class="box resumebox"> <strong>Languages</strong>
	      <?php if ($totalRows_rsUserLanguage > 0) { // Show if recordset not empty ?>
	        <span style="text-align:center"><strong><br/>
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
        </div>
	    <div class="box resumebox"> <strong>Additional Info</strong><br/>
	      <br/>
	      <?php if($row_rsJobSeekerInfo['jobseeker_moreinfo']==NULL){echo "Not Provided";} else {echo $row_rsJobSeekerInfo['jobseeker_moreinfo']; } ?>
        </div>
	    <div class="box resumebox"> <strong>Job Preferences</strong>
	      <?php if ($totalRows_rsUserJobPrefer > 0) { // Show if recordset not empty ?>
	        <br/>
	        <br/>
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
          </table>
	        <?php } // Show if recordset not empty ?>
        </div>
	    <div class="box resumebox"> <strong>References</strong>
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
	  <?php } // Show if recordset not empty ?>
	  <!-- #resume_details_container-->
    <!-- #content-->

    <script src="../js/jquery.js"></script>
    <script>
    $(document).ready(function() {

      $('button#assignProjectBtn').click(function(){

        var form_assign = $('form#assignControlForm');
        var serializeData = form_assign.serialize();


        $.ajax({
          url: 'ajax/assignProjectAgent.php?'+serializeData,

          success:function(data){
            if (data == 1) {
              $('#mainControllerAssignProject').hide();
              $('.successMessage').show();
            };
            console.log(data);
          }
        });

        console.log(serializeData);

        return false;

      });


      console.log('RUN()');
    });
    </script>

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