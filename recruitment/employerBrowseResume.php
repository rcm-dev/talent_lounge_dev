<?php require_once('Connections/conJobsPerak.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

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

$colname_rsEmployerProfile = "-1";
if (isset($_GET['cuid'])) {
  $colname_rsEmployerProfile = $_GET['cuid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployerProfile = sprintf("SELECT * FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsEmployerProfile, "int"));
$rsEmployerProfile = mysql_query($query_rsEmployerProfile, $conJobsPerak) or die(mysql_error());
$row_rsEmployerProfile = mysql_fetch_assoc($rsEmployerProfile);
$totalRows_rsEmployerProfile = mysql_num_rows($rsEmployerProfile);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0";
$rsIndustry = mysql_query($query_rsIndustry, $conJobsPerak) or die(mysql_error());
$row_rsIndustry = mysql_fetch_assoc($rsIndustry);
$totalRows_rsIndustry = mysql_num_rows($rsIndustry);

$colname_rsCompanyInfoDetail = "-1";
if (isset($_GET['cuid'])) {
  $colname_rsCompanyInfoDetail = $_GET['cuid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCompanyInfoDetail = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsCompanyInfoDetail, "int"));
$rsCompanyInfoDetail = mysql_query($query_rsCompanyInfoDetail, $conJobsPerak) or die(mysql_error());
$row_rsCompanyInfoDetail = mysql_fetch_assoc($rsCompanyInfoDetail);
$totalRows_rsCompanyInfoDetail = mysql_num_rows($rsCompanyInfoDetail);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsLoc = "SELECT * FROM jp_location WHERE location_parent = 0";
$rsLoc = mysql_query($query_rsLoc, $conJobsPerak) or die(mysql_error());
$row_rsLoc = mysql_fetch_assoc($rsLoc);
$totalRows_rsLoc = mysql_num_rows($rsLoc);

//$colname_rsEmployerId = $_SESSION['MM_UserID'];
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsEmployerId = $_SESSION['MM_UserID'];
}
$colname_rsEmployerId = "-1";
if (isset($_GET['emp_id'])) {
  $colname_rsEmployerId = $_GET['emp_id'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployerId = sprintf("SELECT emp_id FROM jp_employer WHERE emp_id = %s", GetSQLValueString($colname_rsEmployerId, "int"));
$rsEmployerId = mysql_query($query_rsEmployerId, $conJobsPerak) or die(mysql_error());
$row_rsEmployerId = mysql_fetch_assoc($rsEmployerId);
$totalRows_rsEmployerId = mysql_num_rows($rsEmployerId);

$maxRows_rsJobSeekerList = 20;
$pageNum_rsJobSeekerList = 0;
if (isset($_GET['pageNum_rsJobSeekerList'])) {
  $pageNum_rsJobSeekerList = $_GET['pageNum_rsJobSeekerList'];
}
$startRow_rsJobSeekerList = $pageNum_rsJobSeekerList * $maxRows_rsJobSeekerList;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobSeekerList = "Select   mj_users.*,   jp_jobseeker.*,   mj_users.users_type As users_type1 From   mj_users Inner Join   jp_jobseeker On mj_users.users_id = jp_jobseeker.users_id_fk Where   mj_users.user_active = 1 And   mj_users.users_type = 1";
$query_limit_rsJobSeekerList = sprintf("%s LIMIT %d, %d", $query_rsJobSeekerList, $startRow_rsJobSeekerList, $maxRows_rsJobSeekerList);
$rsJobSeekerList = mysql_query($query_limit_rsJobSeekerList, $conJobsPerak) or die(mysql_error());
$row_rsJobSeekerList = mysql_fetch_assoc($rsJobSeekerList);

if (isset($_GET['totalRows_rsJobSeekerList'])) {
  $totalRows_rsJobSeekerList = $_GET['totalRows_rsJobSeekerList'];
} else {
  $all_rsJobSeekerList = mysql_query($query_rsJobSeekerList);
  $totalRows_rsJobSeekerList = mysql_num_rows($all_rsJobSeekerList);
}
$totalPages_rsJobSeekerList = ceil($totalRows_rsJobSeekerList/$maxRows_rsJobSeekerList)-1;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsLocation = "SELECT * FROM jp_location WHERE location_parent = 0";
$rsLocation = mysql_query($query_rsLocation, $conJobsPerak) or die(mysql_error());
$row_rsLocation = mysql_fetch_assoc($rsLocation);
$totalRows_rsLocation = mysql_num_rows($rsLocation);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsNationality = "SELECT * FROM jp_nationality";
$rsNationality = mysql_query($query_rsNationality, $conJobsPerak) or die(mysql_error());
$row_rsNationality = mysql_fetch_assoc($rsNationality);
$totalRows_rsNationality = mysql_num_rows($rsNationality);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_spmSubjectList = "SELECT * FROM jp_spm_subject";
$spmSubjectList = mysql_query($query_spmSubjectList, $conJobsPerak) or die(mysql_error());
$row_spmSubjectList = mysql_fetch_assoc($spmSubjectList);
$totalRows_spmSubjectList = mysql_num_rows($spmSubjectList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsQualification = "SELECT * FROM jp_edu_lists";
$rsQualification = mysql_query($query_rsQualification, $conJobsPerak) or die(mysql_error());
$row_rsQualification = mysql_fetch_assoc($rsQualification);
$totalRows_rsQualification = mysql_num_rows($rsQualification);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsFieldList = "SELECT * FROM jp_field_list";
$rsFieldList = mysql_query($query_rsFieldList, $conJobsPerak) or die(mysql_error());
$row_rsFieldList = mysql_fetch_assoc($rsFieldList);
$totalRows_rsFieldList = mysql_num_rows($rsFieldList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsMajorList = "SELECT * FROM jp_specialize";
$rsMajorList = mysql_query($query_rsMajorList, $conJobsPerak) or die(mysql_error());
$row_rsMajorList = mysql_fetch_assoc($rsMajorList);
$totalRows_rsMajorList = mysql_num_rows($rsMajorList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsLangList = "SELECT * FROM jp_language_list";
$rsLangList = mysql_query($query_rsLangList, $conJobsPerak) or die(mysql_error());
$row_rsLangList = mysql_fetch_assoc($rsLangList);
$totalRows_rsLangList = mysql_num_rows($rsLangList);

$queryString_rsJobSeekerList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsJobSeekerList") == false && 
        stristr($param, "totalRows_rsJobSeekerList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsJobSeekerList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsJobSeekerList = sprintf("&totalRows_rsJobSeekerList=%d%s", $totalRows_rsJobSeekerList, $queryString_rsJobSeekerList);
?>
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Jobsperak Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
    <script language="javascript" src="js/jquery-1.7.1.min.js"></script>

    <link rel="stylesheet" href="../images/foundation_icons_social/stylesheets/social_foundicons.css">
    <!-- <link rel="stylesheet" href="../images/foundation_icons_general_enclosed/stylesheets/general_enclosed_foundicons.css"> -->
    <!-- <link rel="stylesheet" href="../images/foundation_icons_general/stylesheets/general_foundicons.css"> -->
    <!-- <link rel="stylesheet" href="../images/foundation_icons_accessibility/stylesheets/accessibility_foundicons.css"> -->

<style type="text/css">
#wrapper #middle #content .master_details h1 {
	color: #F00;
}
[class*="foundicon-"]:after { position: relative; top: -8px; left: 10px; color: #888; font-size: 60%; font-style: normal; }
</style>
</head>

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
<h2>Employer Profile</h2>
<div class="master_details_full">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  <?php include("employer_menu.php"); ?><br/> 
<strong>Browse Resume by Filtering</strong><br/><br/>
<p>



<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    	     

          <?php  

            /****************************
             *
             * Record Set for PackageCheck 
             * MySQL Info 
             * Table Used PackageCheck
             *
             ***************************/
            
            $query_rsPackageCheck = "SELECT * FROM jp_employer WHERE users_id_fk = " . mysql_real_escape_string($_SESSION['MM_UserID']);
            $result_rsPackageCheck = mysql_query($query_rsPackageCheck);
            $total_rows_rsPackageCheck = mysql_num_rows($result_rsPackageCheck);
            $row_rsPackageCheck = mysql_fetch_object($result_rsPackageCheck)

          ?>

          <?php 

          /**
           * FREE PACKAGE
           * @var [type]
           */ 
          if ($row_rsPackageCheck->emp_featured == 0 && $row_rsPackageCheck->emp_package == 0): ?>
            <input name="filtering" id="filtering" type="radio" value="general" checked> General
            <strong class="upgrade_premium">[UPGRADE PREMIUM TO FILTER BY SPM, EDUCATION, LANGUAGE, &amp; JOB PREFERENCE]</strong>
          <?php endif ?>


          <?php 

          /**
           * BASIC PACKAGE
           * @var [type]
           */ 
          if ($row_rsPackageCheck->emp_featured == 1 && $row_rsPackageCheck->emp_package == 1): ?>

            <input name="filtering" id="filtering" type="radio" value="general" checked> General
            <strong class="upgrade_premium">[UPGRADE PREMIUM TO FILTER BY SPM, EDUCATION, LANGUAGE, &amp; JOB PREFERENCE]</strong>
            
          <?php endif ?>

          <?php 

          /**
           * PREMIUM PACKAGE
           * @var [type]
           */ 
          if ($row_rsPackageCheck->emp_featured == 1 && $row_rsPackageCheck->emp_package == 2): ?>

           
            <input name="filtering" id="filtering" type="radio" value="general" checked> General
            <input name="filtering" id="filtering" type="radio" value="spm"> SPM
            <input name="filtering" id="filtering" type="radio" value="edu"> Education
            <input name="filtering" id="filtering" type="radio" value="lang"> Language
            <input name="filtering" id="filtering" type="radio" value="skill" style="display:none">
            <input name="filtering" id="filtering" type="radio" value="prefer"> Preference

          <?php endif ?>

          <?php 

          /**
           * PLATINUM PACKAGE
           * @var [type]
           */ 
          if ($row_rsPackageCheck->emp_featured == 1 && $row_rsPackageCheck->emp_package == 3): ?>

          
            <input name="filtering" id="filtering" type="radio" value="general" checked> General
            <input name="filtering" id="filtering" type="radio" value="spm"> SPM
            <input name="filtering" id="filtering" type="radio" value="edu"> Education
            <input name="filtering" id="filtering" type="radio" value="lang"> Language
            <input name="filtering" id="filtering" type="radio" value="skill" style="display:none">
            <input name="filtering" id="filtering" type="radio" value="prefer"> Preference

          <?php endif ?>
    </td>
  </tr>
  <tr>
    <td>
    	<div id="generalFilter">
	        <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
        	<table width="580" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>Nationality</td>
    <td><select name="nationality" class="date" id="nationality">
    <option value="0">Nationality</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsNationality['national_id']?>"><?php echo $row_rsNationality['national_name']?></option>
      <?php
} while ($row_rsNationality = mysql_fetch_assoc($rsNationality));
  $rows = mysql_num_rows($rsNationality);
  if($rows > 0) {
      mysql_data_seek($rsNationality, 0);
	  $row_rsNationality = mysql_fetch_assoc($rsNationality);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>State</td>
    <td>
      <select name="state" id="state" style="width:130px">
        <option value="0">State</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>Date of Birth </td>
    <td>
    <select name="dob_month" class="date">
        <option value="0">Month</option>
        <?php 
		for($i = 1; $i <= 12; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
        </select>
    
    <select name="dob_year" class="date">
        <option value="0">Year</option>
        <?php 
		for($i = 1970; $i <= date('Y'); $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
        </select></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td><input name="submitGeneral" type="submit" value="Search" class="button green"></td>
  </tr>
</table>
			</form>
        </div>
        <div id="spmFilter" style="display:none">
        <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
        	<table width="580" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td>Subject</td>
                <td><select name="spm_subject" class="date">
                <option value="0">Choose Subject</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_spmSubjectList['subject_id']?>"><?php echo $row_spmSubjectList['subject_name']?></option>
                  <?php
} while ($row_spmSubjectList = mysql_fetch_assoc($spmSubjectList));
  $rows = mysql_num_rows($spmSubjectList);
  if($rows > 0) {
      mysql_data_seek($spmSubjectList, 0);
	  $row_spmSubjectList = mysql_fetch_assoc($spmSubjectList);
  }
?>
                </select></td>
              </tr>
              <tr>
                <td>Grade</td>
                <td><select name="spm_subject_grade" class="date">
                	<option value="0">Choose Grade</option>
                    <option value="A+">A+</option>
                    <option value="A">A</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="G">G</option>
                </select></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="submitSPM" type="submit" value="Search" class="button green"></td>
              </tr>
            </table>
		</form>
        </div>
        <div id="eduFilter" style="display:none">
        <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
        	<table width="580" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="100">Graduate (Year)</td>
                <td align="left" valign="middle"><select name="graduate_year" class="date">
        <option value="0">Year</option>
        <?php 
		for($i = 2000; $i <= date('Y'); $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
        </select></td>
              </tr>
              <tr>
                <td>Qualification</td>
                <td><select name="qualification" class="date">
                  <option value="0">All Qualification</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rsQualification['edu_id']?>"><?php echo $row_rsQualification['edu_name']?></option>
                  <?php
} while ($row_rsQualification = mysql_fetch_assoc($rsQualification));
  $rows = mysql_num_rows($rsQualification);
  if($rows > 0) {
      mysql_data_seek($rsQualification, 0);
	  $row_rsQualification = mysql_fetch_assoc($rsQualification);
  }
?>
                </select></td>
              </tr>
              <tr>
                <td>Field of Study</td>
                <td><select name="field_of_study" class="date">
                  <option value="0">All Fields</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rsFieldList['field_id']?>"><?php echo $row_rsFieldList['field_name']?></option>
                  <?php
} while ($row_rsFieldList = mysql_fetch_assoc($rsFieldList));
  $rows = mysql_num_rows($rsFieldList);
  if($rows > 0) {
      mysql_data_seek($rsFieldList, 0);
	  $row_rsFieldList = mysql_fetch_assoc($rsFieldList);
  }
?>
                </select></td>
              </tr>
              <tr>
                <td>CGPA</td>
                <td>
                <select name="cgpa" class="date">
	                <option value="0">Choose CGPA</option>
                	<option value="3.5">3.50 and Above</option>
                    <option value="3.49">3.49 and below</option>
                </select>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="submitEdu" type="submit" value="Search" class="button green"></td>
              </tr>
            </table>
            </form>
        </div>
        <div id="langFilter" style="display:none">
        <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
        <table width="580" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="80">Language</td>
            <td><select name="language" class="date">
              <option value="0">Choose Language</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsLangList['languList_id']?>"><?php echo $row_rsLangList['languList_name']?></option>
              <?php
} while ($row_rsLangList = mysql_fetch_assoc($rsLangList));
  $rows = mysql_num_rows($rsLangList);
  if($rows > 0) {
      mysql_data_seek($rsLangList, 0);
	  $row_rsLangList = mysql_fetch_assoc($rsLangList);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td>Spoken</td>
            <td><select name="lang_spoken" class="date">
            <option value="0">Spoken Rating</option>
            <?php 
				for($i = 10; $i >= 1; $i--) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
            </select></td>
          </tr>
          <tr>
            <td>Written</td>
            <td><select name="lang_written" class="date">
            <option value="0">Written Rating</option>
            <?php 
				for($i = 10; $i >= 1; $i--) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
            </select></td>
          </tr>
          <tr>
                <td>&nbsp;</td>
                <td><input name="submitLang" type="submit" value="Search" class="button green"></td>
              </tr>
        </table>
		</form>
        </div>
        <div id="skillFilter" style="display:none">Content for  id "skillFilter" Goes Here</div>
        <div id="preferFilter" style="display:none">
        <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
        	<table width="580" border="0" cellspacing="0" cellpadding="2">
                <tr>
                	<td width="80">Location</td>
                	<td><select name="prefer_location" class="date">
                	  <option value="0">Choose Location</option>
                	  <?php
						do {  
						?>
											  <option value="<?php echo $row_rsLocation['location_id']?>"><?php echo $row_rsLocation['location_name']?></option>
											  <?php
						} while ($row_rsLocation = mysql_fetch_assoc($rsLocation));
						  $rows = mysql_num_rows($rsLocation);
						  if($rows > 0) {
							  mysql_data_seek($rsLocation, 0);
							  $row_rsLocation = mysql_fetch_assoc($rsLocation);
						  }
						?>
                    </select></td>
                </tr>
                <tr>
                	<td>Industry</td>
                	<td><select name="industry" class="date">
                	  <option value="0">Choose Industry</option>
                	  <?php
do {  
?>
                	  <option value="<?php echo $row_rsIndustry['indus_id']?>"><?php echo $row_rsIndustry['indus_name']?></option>
                	  <?php
} while ($row_rsIndustry = mysql_fetch_assoc($rsIndustry));
  $rows = mysql_num_rows($rsIndustry);
  if($rows > 0) {
      mysql_data_seek($rsIndustry, 0);
	  $row_rsIndustry = mysql_fetch_assoc($rsIndustry);
  }
?>
                    </select></td>
                </tr>
                <tr>
                	<td>Salary</td>
                	<td><select name="salary" class="date">
                      <option value="0">All Salaries</option>
                      <option value="1000">RM1,000 and Below</option>
                      <option value="2000">RM2,000 and Below</option>
                      <option value="3000">RM3,000 and Below</option>
                      <option value="10000">RM10,000 and Below</option>
                    </select></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                	<td><input name="submitPrefer" type="submit" value="Search" class="button green"></td>
              </tr>
            </table>
		</form>
        </div></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
</table>



</p>
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

<table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
  <tr>
    <th>Name</th>
    <th>Resume</th>
    <th>Picture</th>
    <?php if ($package != 'free'): ?>
      <th>Action</th>
    <?php endif ?>
  </tr>
  <?php do { ?>
    <tr>
      <td align="left" valign="middle"><?php echo $row_rsJobSeekerList['users_fname']; ?> <?php echo $row_rsJobSeekerList['users_lname']; ?></td>
      <td align="center" valign="middle">
        <?php 
        // basic
        if ($row_rsPremiumCheck['usr_lvl'] == 0) { ?>
          <a href="jobSeekerResume.php?js_id=<?php echo $row_rsJobSeekerList['users_id']; ?>">View Resume</a>
        <?php } ?>

        <?php 
        // premium
        if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
        <a href="jobSeekerResume.php?js_id=<?php echo $row_rsJobSeekerList['users_id']; ?>">View Resume</a>
        <?php } ?>
      </td>
      <td align="center" valign="middle"><img src="<?php echo $row_rsJobSeekerList['jobseeker_pic']; ?>" width="48"></td>
      <?php if ($package != 'free'): ?>
      <td align="center" valign="middle"><a href="employerApplicationShorlistedDirect.php?candidateID=<?php echo $row_rsJobSeekerList['jobseeker_id']; ?>&employer_id=<?php echo $_SESSION['MM_UserID']; ?>"><img src="img/Document-Write-icon.png" alt="shortlisted" width="16" height="16" border="0" title="Shorlist this Candidate"></a></td>
      <?php endif ?>
    </tr>
    <?php } while ($row_rsJobSeekerList = mysql_fetch_assoc($rsJobSeekerList)); ?>
</table>

<div class="paginate"><a href="<?php printf("%s?pageNum_rsJobSeekerList=%d%s", $currentPage, 0, $queryString_rsJobSeekerList); ?>">First</a> <a href="<?php printf("%s?pageNum_rsJobSeekerList=%d%s", $currentPage, max(0, $pageNum_rsJobSeekerList - 1), $queryString_rsJobSeekerList); ?>">Previous</a> <a href="<?php printf("%s?pageNum_rsJobSeekerList=%d%s", $currentPage, min($totalPages_rsJobSeekerList, $pageNum_rsJobSeekerList + 1), $queryString_rsJobSeekerList); ?>">Next</a> <a href="<?php printf("%s?pageNum_rsJobSeekerList=%d%s", $currentPage, $totalPages_rsJobSeekerList, $queryString_rsJobSeekerList); ?>">Last</a> | Records <?php echo ($startRow_rsJobSeekerList + 1) ?> to <?php echo min($startRow_rsJobSeekerList + $maxRows_rsJobSeekerList, $totalRows_rsJobSeekerList) ?> of <?php echo $totalRows_rsJobSeekerList ?></div>
</div>

          </div><!-- #content-->
	

			<!-- #sideRight -->


	</section><!-- #middle-->

	</div><!-- #wrapper-->

	<footer id="footer">
		<div class="center">
			<?php include("footer.php"); ?>
		</div><!-- .center -->
	</footer><!-- #footer -->



</body>
<script>
$(document).ready(function(){
	
		var generalFilter = $('div#generalFilter');
		var spmFilter = $('div#spmFilter');
		var eduFilter = $('div#eduFilter');
		var langFilter = $('div#langFilter');
		var skillFilter = $('div#skillFilter');
		var preferFilter = $('div#preferFilter');
		
		var filtering = $("input[type='radio']");
		
		filtering.change(function(){
			
			if($(this).val().toString() == 'general')
			{
				generalFilter.show();
				
				spmFilter.hide();
				eduFilter.hide();
				langFilter.hide();
				skillFilter.hide();
				preferFilter.hide();
				//console.log($(this).val());
			}
			
			if($(this).val().toString() == 'spm')
			{
				spmFilter.show();
				
				generalFilter.hide();
				eduFilter.hide();
				langFilter.hide();
				skillFilter.hide();
				preferFilter.hide();
				//console.log($(this).val());
			}
			
			if($(this).val().toString() == 'edu')
			{
				eduFilter.show();
				
				generalFilter.hide();
				spmFilter.hide();
				langFilter.hide();
				skillFilter.hide();
				preferFilter.hide();
				//console.log($(this).val());
			}
			
			if($(this).val().toString() == 'lang')
			{
				langFilter.show();
				
				generalFilter.hide();
				spmFilter.hide();
				eduFilter.hide();
				skillFilter.hide();
				preferFilter.hide();
				//console.log($(this).val());
			}
			
			if($(this).val().toString() == 'skill')
			{
				skillFilter.show();
				
				generalFilter.hide();
				spmFilter.hide();
				eduFilter.hide();
				langFilter.hide();
				preferFilter.hide();
				//console.log($(this).val());
			}
			
			if($(this).val().toString() == 'prefer')
			{
				preferFilter.show();
				
				generalFilter.hide();
				spmFilter.hide();
				eduFilter.hide();
				langFilter.hide();
				skillFilter.hide();
				//console.log($(this).val());
			}
			
		});
		
		/*filtering.change(function(){
			console.log($(this).val());
		});*/
		
});
</script>
</html>
<?php
mysql_free_result($rsEmployerProfile);

mysql_free_result($rsIndustry);

mysql_free_result($rsCompanyInfoDetail);

mysql_free_result($rsLoc);

mysql_free_result($rsEmployerId);

mysql_free_result($rsJobSeekerList);

mysql_free_result($rsLocation);

mysql_free_result($rsNationality);

mysql_free_result($spmSubjectList);

mysql_free_result($rsQualification);

mysql_free_result($rsFieldList);

mysql_free_result($rsMajorList);

mysql_free_result($rsLangList);
?>
