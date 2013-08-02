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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO jp_shortlisted (shortlisted_id, ads_id_fk, joseeker_id_fk, employer_id_fk, `time`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['shortlisted_id'], "int"),
                       GetSQLValueString($_POST['ads_id_fk'], "int"),
                       GetSQLValueString($_POST['joseeker_id_fk'], "int"),
                       GetSQLValueString($_POST['employer_id_fk'], "int"),
                       GetSQLValueString($_POST['time'], "date"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($insertSQL, $conJobsPerak) or die(mysql_error());
  
  
  // update shortlisted
  $ads_id_fk = $_POST['ads_id_fk'];
  $js_id_fk = $_POST['joseeker_id_fk'];
  $sqlUpdate = "UPDATE jp_application SET is_shortlisted = '1' WHERE ads_id_fk = '$ads_id_fk' AND js_id_fk = '$js_id_fk'";
  $sqlUpdateResult = mysql_query($sqlUpdate);
  // ==================================

  $insertGoTo = "employerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



$colname_rsEmployed = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsEmployed = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsEmployed = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsEmployed, "int"));
$rsEmployed = mysql_query($query_rsEmployed, $conJobsPerak) or die(mysql_error());
$row_rsEmployed = mysql_fetch_assoc($rsEmployed);
$totalRows_rsEmployed = mysql_num_rows($rsEmployed);

$colname_rsComDetail = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsComDetail = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsComDetail = sprintf("SELECT * FROM jp_employer WHERE users_id_fk = %s", GetSQLValueString($colname_rsComDetail, "int"));
$rsComDetail = mysql_query($query_rsComDetail, $conJobsPerak) or die(mysql_error());
$row_rsComDetail = mysql_fetch_assoc($rsComDetail);
$totalRows_rsComDetail = mysql_num_rows($rsComDetail);

$maxRows_rsJobAds = 30;
$pageNum_rsJobAds = 0;
if (isset($_GET['pageNum_rsJobAds'])) {
  $pageNum_rsJobAds = $_GET['pageNum_rsJobAds'];
}
$startRow_rsJobAds = $pageNum_rsJobAds * $maxRows_rsJobAds;

$colname_rsJobAds = $row_rsEmployed['emp_id'];
if (isset($row_rsEmployed['emp_id'])) {
  $colname_rsJobAds = $row_rsEmployed['emp_id'];
}

$colname_rsJobAds = $row_rsEmployed['emp_id'];

$colname_rsJobAds = "-1";
if (isset($_GET['adsId'])) {
  $colname_rsJobAds = $_GET['adsId'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobAds = sprintf("SELECT * FROM jp_ads WHERE ads_id = %s", GetSQLValueString($colname_rsJobAds, "int"));
$rsJobAds = mysql_query($query_rsJobAds, $conJobsPerak) or die(mysql_error());
$row_rsJobAds = mysql_fetch_assoc($rsJobAds);
$totalRows_rsJobAds = mysql_num_rows($rsJobAds);

$currentJobAdsId = 7;
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCandidateApplied = "Select   Count(jp_application.ads_id_fk) From   jp_application Where   jp_application.ads_id_fk = $currentJobAdsId";
$rsCandidateApplied = mysql_query($query_rsCandidateApplied, $conJobsPerak) or die(mysql_error());
$row_rsCandidateApplied = mysql_fetch_assoc($rsCandidateApplied);
$totalRows_rsCandidateApplied = mysql_num_rows($rsCandidateApplied);

$colname_rsIsActive = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsIsActive = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIsActive = sprintf("SELECT user_active FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsIsActive, "int"));
$rsIsActive = mysql_query($query_rsIsActive, $conJobsPerak) or die(mysql_error());
$row_rsIsActive = mysql_fetch_assoc($rsIsActive);
$totalRows_rsIsActive = mysql_num_rows($rsIsActive);

$colname_rsCandidate = "-1";
if (isset($_GET['candidateID'])) {
  $colname_rsCandidate = $_GET['candidateID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsCandidate = sprintf("Select   mj_users.users_fname,   mj_users.users_lname,   jp_jobseeker.jobseeker_id From   jp_jobseeker Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id Where   jp_jobseeker.jobseeker_id = %s", GetSQLValueString($colname_rsCandidate, "int"));
$rsCandidate = mysql_query($query_rsCandidate, $conJobsPerak) or die(mysql_error());
$row_rsCandidate = mysql_fetch_assoc($rsCandidate);
$totalRows_rsCandidate = mysql_num_rows($rsCandidate);

$currentEmployedId = $row_rsEmployed['emp_id'];
mysql_select_db($database_conJobsPerak, $conJobsPerak);


// check premium 0 and package 0
// Free Package which is package 0
if ($row_rsComDetail['emp_featured'] == 0 && $row_rsComDetail['emp_package'] == 0) {
 
  $query_rsShortlistedCandidate = "SELECT jp_ads.ads_title,   jp_jobseeker.users_id_fk,   mj_users.users_fname,   mj_users.users_lname,   mj_users.users_email,   jp_shortlisted.employer_id_fk, jp_shortlisted.joseeker_id_fk, jp_shortlisted.ads_id_fk, jp_shortlisted.shortlisted_id, jp_shortlisted.is_approve FROM jp_shortlisted Inner Join   jp_ads On jp_shortlisted.ads_id_fk = jp_ads.ads_id Inner Join   jp_jobseeker On jp_shortlisted.joseeker_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted.employer_id_fk = $currentEmployedId And   jp_shortlisted.is_reject = 0 ORDER BY jp_ads.ads_title LIMIT 10";

  $limit = 'Your package is Free Package which is Limited to 10 shortlisted';

}

// check premium 1 and package 1
// Basic Package which is package 1
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 1) {
 
  $query_rsShortlistedCandidate = "SELECT jp_ads.ads_title,   jp_jobseeker.users_id_fk,   mj_users.users_fname,   mj_users.users_lname,   mj_users.users_email,   jp_shortlisted.employer_id_fk, jp_shortlisted.joseeker_id_fk, jp_shortlisted.ads_id_fk, jp_shortlisted.shortlisted_id, jp_shortlisted.is_approve FROM jp_shortlisted Inner Join   jp_ads On jp_shortlisted.ads_id_fk = jp_ads.ads_id Inner Join   jp_jobseeker On jp_shortlisted.joseeker_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted.employer_id_fk = $currentEmployedId And   jp_shortlisted.is_reject = 0 ORDER BY jp_ads.ads_title LIMIT 10";

  $limit = 'Your package is Basic Package which is unlimited';

}

// check premium 1 and package 2
// Premium Package which is package 2
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 2) {

  $query_rsShortlistedCandidate = "SELECT jp_ads.ads_title,   jp_jobseeker.users_id_fk,   mj_users.users_fname,   mj_users.users_lname,   mj_users.users_email,   jp_shortlisted.employer_id_fk, jp_shortlisted.joseeker_id_fk, jp_shortlisted.ads_id_fk, jp_shortlisted.shortlisted_id, jp_shortlisted.is_approve FROM jp_shortlisted Inner Join   jp_ads On jp_shortlisted.ads_id_fk = jp_ads.ads_id Inner Join   jp_jobseeker On jp_shortlisted.joseeker_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted.employer_id_fk = $currentEmployedId And   jp_shortlisted.is_reject = 0 ORDER BY jp_ads.ads_title";

  $limit = 'Your package is Basic Package which is unlimited';

}

// check premium 1 and package 3
// Premium Package which is package 3
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 3) {

  $query_rsShortlistedCandidate = "SELECT jp_ads.ads_title,   jp_jobseeker.users_id_fk,   mj_users.users_fname,   mj_users.users_lname,   mj_users.users_email,   jp_shortlisted.employer_id_fk, jp_shortlisted.joseeker_id_fk, jp_shortlisted.ads_id_fk, jp_shortlisted.shortlisted_id, jp_shortlisted.is_approve FROM jp_shortlisted Inner Join   jp_ads On jp_shortlisted.ads_id_fk = jp_ads.ads_id Inner Join   jp_jobseeker On jp_shortlisted.joseeker_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted.employer_id_fk = $currentEmployedId And   jp_shortlisted.is_reject = 0 ORDER BY jp_ads.ads_title";

  $limit = 'Your package is Basic Package which is unlimited';

}

$rsShortlistedCandidate = mysql_query($query_rsShortlistedCandidate, $conJobsPerak) or die(mysql_error());
$row_rsShortlistedCandidate = mysql_fetch_assoc($rsShortlistedCandidate);
$totalRows_rsShortlistedCandidate = mysql_num_rows($rsShortlistedCandidate);

$colname_rsDirectShorlisted = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsDirectShorlisted = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);

// check premium 0 and package 0
// Free Package which is package 0
if ($row_rsComDetail['emp_featured'] == 0 && $row_rsComDetail['emp_package'] == 0) {
  
  $query_rsDirectShorlisted = sprintf("SELECT mj_users.users_email,   mj_users.users_fname,   mj_users.users_lname,   jp_shortlisted_by_emp.jp_id_fk,   jp_shortlisted_by_emp.jp_emp_id_fk, jp_shortlisted_by_emp.sbemp_id, jp_jobseeker.users_id_fk FROM jp_shortlisted_by_emp Inner Join   jp_jobseeker On jp_shortlisted_by_emp.jp_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted_by_emp.jp_emp_id_fk = %s LIMIT 10", GetSQLValueString($colname_rsDirectShorlisted, "int"));

  $limit = 'Your package is Free Package. You should upgrade to Basic or best value package to make shortlisted';

}


// check premium 1 and package 1
// Basic Package which is package 1
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 1) {
  
  $query_rsDirectShorlisted = sprintf("SELECT mj_users.users_email,   mj_users.users_fname,   mj_users.users_lname,   jp_shortlisted_by_emp.jp_id_fk,   jp_shortlisted_by_emp.jp_emp_id_fk, jp_shortlisted_by_emp.sbemp_id, jp_jobseeker.users_id_fk FROM jp_shortlisted_by_emp Inner Join   jp_jobseeker On jp_shortlisted_by_emp.jp_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted_by_emp.jp_emp_id_fk = %s LIMIT 10", GetSQLValueString($colname_rsDirectShorlisted, "int"));

  $limit = 'Your package is Basic Package which is shortlisted limited to 10';

}

// check premium 1 and package 2
// Premium Package which is package 2
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 2) {
  
  $query_rsDirectShorlisted = sprintf("SELECT mj_users.users_email,   mj_users.users_fname,   mj_users.users_lname,   jp_shortlisted_by_emp.jp_id_fk,   jp_shortlisted_by_emp.jp_emp_id_fk, jp_shortlisted_by_emp.sbemp_id, jp_jobseeker.users_id_fk FROM jp_shortlisted_by_emp Inner Join   jp_jobseeker On jp_shortlisted_by_emp.jp_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted_by_emp.jp_emp_id_fk = %s", GetSQLValueString($colname_rsDirectShorlisted, "int"));

  $limit = 'Your package is Premium Package which is unlimited to shortlisted jobseekers';
}

// check premium 1 and package 3
// Platinum Package which is package 3
if ($row_rsComDetail['emp_featured'] == 1 && $row_rsComDetail['emp_package'] == 3) {
  
  $query_rsDirectShorlisted = sprintf("SELECT mj_users.users_email,   mj_users.users_fname,   mj_users.users_lname,   jp_shortlisted_by_emp.jp_id_fk,   jp_shortlisted_by_emp.jp_emp_id_fk, jp_shortlisted_by_emp.sbemp_id, jp_jobseeker.users_id_fk FROM jp_shortlisted_by_emp Inner Join   jp_jobseeker On jp_shortlisted_by_emp.jp_id_fk = jp_jobseeker.jobseeker_id   Inner Join   mj_users On jp_jobseeker.users_id_fk = mj_users.users_id WHERE jp_shortlisted_by_emp.jp_emp_id_fk = %s", GetSQLValueString($colname_rsDirectShorlisted, "int"));

  $limit = 'Your package is Premium Package which is unlimited to shortlisted jobseekers';
}


$rsDirectShorlisted = mysql_query($query_rsDirectShorlisted, $conJobsPerak) or die(mysql_error());
// $row_rsDirectShorlisted = mysql_fetch_assoc($rsDirectShorlisted);
$totalRows_rsDirectShorlisted = mysql_num_rows($rsDirectShorlisted);
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
<h2>Employer Dashboard</h2>
<div class="master_details_full">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php //echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>
  
  <?php include("employer_menu.php"); ?>
  

<?php if ($totalRows_rsDirectShorlisted > 0) { // Show if recordset not empty ?>
  <br/>

  Direct Shorlisted Lists <strong><?php echo $limit; ?></strong>

  
  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
    <tr>
      <th>Candidate Name</th>
      <th>Resume</th>
      <th>Action</th>
      <th>Assign Test</th>
      </tr>


    <?php while ($rowdetail_rsDirectShorlisted = mysql_fetch_array($rsDirectShorlisted)) { ?>
      
      
    <tr>
      <td>
        <?php echo $rowdetail_rsDirectShorlisted['users_fname']; ?> <?php echo $rowdetail_rsDirectShorlisted['users_lname']; ?>
        </td>
        <?php 
        // premium
        if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
      <td align="center" valign="middle"><a href="jobSeekerResume.php?js_id=<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>">View Resume</a></td>
        <?php } else { ?>
        <td align="center" valign="middle">
          <a href="jobSeekerResume.php?js_id=<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>">View Resume</a>
        </td>
        <?php } ?>
      <td align="center" valign="middle"><a href="deleteDirectShorlisted.php?sbemp_id=<?php echo $rowdetail_rsDirectShorlisted['sbemp_id']; ?>" id="deleteDirect">Delete</a></td>
        <td align="center" valign="middle">
          <?php if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
            
              <?php  

              /****************************
               *
               * Record Set for AssessmentTest 
               * MySQL Info 
               * Table Used AssessmentTest
               *
               ***************************/
              
              $query_rsAssessmentTest = "SELECT * FROM test_name WHERE user_id_fk = " . $_SESSION['MM_UserID'];
              $result_rsAssessmentTest = mysql_query($query_rsAssessmentTest);
              $total_rows_rsAssessmentTest = mysql_num_rows($result_rsAssessmentTest);
              
              ?>

              <?php if ($total_rows_rsAssessmentTest > 0): ?>


                <?php  

                /****************************
                 *
                 * Record Set for CheckAlreadyAssignTest 
                 * MySQL Info 
                 * Table Used CheckAlreadyAssignTest
                 *
                 ***************************/
                
                $query_rsCheckAlreadyAssignTest = "SELECT * FROM test_to_jobseeker WHERE emp_user_id_fk = ". $_SESSION['MM_UserID'] ." AND js_id_fk = " . $rowdetail_rsDirectShorlisted['users_id_fk'];
                $result_rsCheckAlreadyAssignTest = mysql_query($query_rsCheckAlreadyAssignTest);
                $total_rows_rsCheckAlreadyAssignTest = mysql_num_rows($result_rsCheckAlreadyAssignTest);
                $row_rsCheckAlreadyAssignTest = mysql_fetch_object($result_rsCheckAlreadyAssignTest);
                
                ?>
                
                <?php if ($total_rows_rsCheckAlreadyAssignTest == 0): ?>
                  
                  <form action="ajax/post_asses_to_jobseeker.php" method="post" id="form_assign_<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>" data-id="<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>">

                    <select name="assign_test" id="assign_test" style="width:100px">
                      <option value="0">Choose Test</option>
                      <?php while ($row_rsAssessmentTest = mysql_fetch_object($result_rsAssessmentTest)) { ?>
                        
                        <option value="<?php echo $row_rsAssessmentTest->tid; ?>"><?php echo $row_rsAssessmentTest->test_name; ?></option>

                      <?php } ?>
                    </select>
                    <input type="hidden" name="to_jobseeker" value="<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>">
                    <input type="hidden" name="emp_user_id_fk" value="<?php echo $_SESSION['MM_UserID'] ?>">
                    <button type="submit" style="padding:3px;" class="submit_test" id="<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>" data-id="<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>">Assign</button>
                  </form>
                  <span class="message_assign_<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>"></span>
                <?php endif ?>


                <?php if ($total_rows_rsCheckAlreadyAssignTest != 0): ?>

                  <?php  

                  /****************************
                   *
                   * Record Set for DisplayTestName 
                   * MySQL Info 
                   * Table Used DisplayTestName
                   *
                   ***************************/
                  
                  $query_rsDisplayTestName = "SELECT * FROM test_name WHERE tid = " . $row_rsCheckAlreadyAssignTest->test_id_fk;
                  $result_rsDisplayTestName = mysql_query($query_rsDisplayTestName);
                  $row_rsDisplayTestName = mysql_fetch_object($result_rsDisplayTestName);

                  ?>
                  Current Test: <strong style="font-weight:bold; color:green"><?php echo $row_rsDisplayTestName->test_name; ?></strong> &middot; <span><a href="#" id="delete_test" data-id="<?php echo $row_rsDisplayTestName->tid; ?>" data-jsid="<?php echo $rowdetail_rsDirectShorlisted['users_id_fk']; ?>" data-empid="<?php echo $_SESSION['MM_UserID'] ?>">Delete</a></span>
                  
                <?php endif ?>
                

              <?php endif ?>
              



              <?php if ($total_rows_rsAssessmentTest == 0): ?>
                
                  <a href="asses-landing.php">Create a Test</a>

              <?php endif ?>





          <?php } else { ?>
            <strong class="upgrade_premium">[UPGRADE TO PREMIUM]</strong>
          <?php } ?>




        </td>
      </tr>
  

       <?php } ?>

  </table>
  <br/><br/><br/>
  <?php } // Show if recordset not empty ?>

  
<?php if ($totalRows_rsShortlistedCandidate > 0) { // Show if recordset not empty ?><br/>
<p>Your Shortlisted Candidate based on job ad <strong><?php echo $limit; ?></strong></p>
  
  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
    <tr>
      <th>Candidate Name</th>
      <th>Jobs</th>
      <th>Resume</th>
      <th>Action</th>
      <th>
        Assign Test
      </th>
    </tr>
    <?php do { ?>
      <tr>
        <td>
          <?php echo $row_rsShortlistedCandidate['users_fname']; ?> <?php echo $row_rsShortlistedCandidate['users_lname']; ?>
        </td>
        <td align="center" valign="middle"><?php echo $row_rsShortlistedCandidate['ads_title']; ?></td>
        <td align="center" valign="middle"><a href="jobSeekerResume.php?js_id=<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>">View Resume</a></td>
        <td align="center" valign="middle"> 
        <?php if($row_rsShortlistedCandidate['is_approve'] == 2){ ?>
         pending for approval
        <?php } elseif($row_rsShortlistedCandidate['is_approve'] == 0) { ?>
        <a href="employerApplicationReject.php?candidateID=<?php echo $row_rsShortlistedCandidate['joseeker_id_fk']; ?>&adsId=<?php echo $row_rsShortlistedCandidate['ads_id_fk']; ?>&action=reject">
          <img src="img/Delete-icon.png" alt="reject" width="16" height="16" border="0" title="Reject this Candidate"></a> 

        <?php 
        // premium
        if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>

        &middot; <a href="jobSeekerResume.php?js_id=<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>" title="View Details"><img src="img/Document-Write-icon.png" width="16" height="16"></a> 

        <?php } else { ?>
        
        &middot; <strong class="upgrade_premium">[UPGRADE PREMUIM TO SHORTLISTED]</strong>

        <?php } ?>

        &middot;
        
        <a href="employerApplicationShorlistedAccepted.php?adsIdFk=<?php echo $row_rsShortlistedCandidate['ads_id_fk']; ?>&jbSkerIdFk=<?php echo $row_rsShortlistedCandidate['joseeker_id_fk']; ?>&empIdFk=<?php echo $row_rsShortlistedCandidate['employer_id_fk']; ?>&shortId=<?php echo $row_rsShortlistedCandidate['shortlisted_id']; ?>"><img src="img/Ok-icon.png" width="16" height="16" alt="accepted"></a>
        <?php } elseif($row_rsShortlistedCandidate['is_approve'] == 1) { ?>
        Approve as a staff
        <?php } ?>
        </td>
        <td align="center" valign="middle">
          <?php if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
            
              <?php  

              /****************************
               *
               * Record Set for AssessmentTest 
               * MySQL Info 
               * Table Used AssessmentTest
               *
               ***************************/
              
              $query_rsAssessmentTest = "SELECT * FROM test_name WHERE user_id_fk = " . $_SESSION['MM_UserID'];
              $result_rsAssessmentTest = mysql_query($query_rsAssessmentTest);
              $total_rows_rsAssessmentTest = mysql_num_rows($result_rsAssessmentTest);
              
              ?>

              <?php if ($total_rows_rsAssessmentTest > 0): ?>


                <?php  

                /****************************
                 *
                 * Record Set for CheckAlreadyAssignTest 
                 * MySQL Info 
                 * Table Used CheckAlreadyAssignTest
                 *
                 ***************************/
                
                $query_rsCheckAlreadyAssignTest = "SELECT * FROM test_to_jobseeker WHERE emp_user_id_fk = ". $_SESSION['MM_UserID'] ." AND js_id_fk = " . $row_rsShortlistedCandidate['users_id_fk'];
                $result_rsCheckAlreadyAssignTest = mysql_query($query_rsCheckAlreadyAssignTest);
                $total_rows_rsCheckAlreadyAssignTest = mysql_num_rows($result_rsCheckAlreadyAssignTest);
                $row_rsCheckAlreadyAssignTest = mysql_fetch_object($result_rsCheckAlreadyAssignTest);
                
                ?>
                
                <?php if ($total_rows_rsCheckAlreadyAssignTest == 0): ?>
                  
                  <form action="ajax/post_asses_to_jobseeker.php" method="post" id="form_assign_<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>" data-id="<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>">

                    <select name="assign_test" id="assign_test" style="width:100px">
                      <option value="0">Choose Test</option>
                      <?php while ($row_rsAssessmentTest = mysql_fetch_object($result_rsAssessmentTest)) { ?>
                        
                        <option value="<?php echo $row_rsAssessmentTest->tid; ?>"><?php echo $row_rsAssessmentTest->test_name; ?></option>

                      <?php } ?>
                    </select>
                    <input type="hidden" name="to_jobseeker" value="<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>">
                    <input type="hidden" name="emp_user_id_fk" value="<?php echo $_SESSION['MM_UserID'] ?>">
                    <button type="submit" style="padding:3px;" class="submit_test" id="<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>" data-id="<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>">Assign</button>
                  </form>
                  <span class="message_assign_<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>"></span>
                <?php endif ?>


                <?php if ($total_rows_rsCheckAlreadyAssignTest != 0): ?>

                  <?php  

                  /****************************
                   *
                   * Record Set for DisplayTestName 
                   * MySQL Info 
                   * Table Used DisplayTestName
                   *
                   ***************************/
                  
                  $query_rsDisplayTestName = "SELECT * FROM test_name WHERE tid = " . $row_rsCheckAlreadyAssignTest->test_id_fk;
                  $result_rsDisplayTestName = mysql_query($query_rsDisplayTestName);
                  $row_rsDisplayTestName = mysql_fetch_object($result_rsDisplayTestName);

                  ?>
                  Current Test: <strong style="font-weight:bold; color:green"><?php echo $row_rsDisplayTestName->test_name; ?></strong> &middot; <span><a href="#" id="delete_test" data-id="<?php echo $row_rsDisplayTestName->tid; ?>" data-jsid="<?php echo $row_rsShortlistedCandidate['users_id_fk']; ?>" data-empid="<?php echo $_SESSION['MM_UserID'] ?>">Delete</a></span>
                  
                <?php endif ?>
                

              <?php endif ?>
              



              <?php if ($total_rows_rsAssessmentTest == 0): ?>
                
                  <a href="asses-landing.php">Create a Test</a>

              <?php endif ?>





          <?php } else { ?>
            <strong class="upgrade_premium">[UPGRADE TO PREMIUM]</strong>
          <?php } ?>
        </td>
      </tr>
      <?php } while ($row_rsShortlistedCandidate = mysql_fetch_assoc($rsShortlistedCandidate)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  
  
  <?php if ($totalRows_rsShortlistedCandidate == 0) { // Show if recordset empty ?>
  	<p>There's no shortlisted candidate yet. <strong><?php echo $limit; ?></strong></p>
  <?php } // Show if recordset empty ?>
  
<?php } // Show if recordset not empty ?>
</div>

          </div><!-- #content-->
	
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
<script>
$(document).ready(function(){
	
	$('a#deleteDirect').live('click', function(){
			var answer = confirm('Are you sure you want to delete this?');
			
			if(answer){
				return true;
			} else {
				return false;
			}
			
			
		});

  // Submit Assign Test
  $('button.submit_test').click(function(){

    var button_id = $(this).attr('id');

    var assign_test_id = $('form#form_assign_'+button_id).attr('data-id');
    var to_url = $('form#form_assign_'+button_id).attr('action');
    var serializeData = $('form#form_assign_'+button_id).serialize();

      $.ajax({
        data: serializeData,
        url: to_url,

        success:function(data){
          
          $('span.message_assign_'+button_id).html(data);
          $('form#form_assign_'+button_id).hide();

          window.location = 'employerApplicationShorlistedList.php';
          console.log(data);
        }
      });

    console.log('FORM: '+button_id+' '+to_url+' '+serializeData);
    return false;

  });


  $('a#delete_test').click(function(){

    var test_id = $(this).attr('data-id');
    var js_id = $(this).attr('data-jsid');
    var emp_id = $(this).attr('data-empid');

    var param = 'test_id=' + test_id + '&js_id=' + js_id + '&emp_id=' + emp_id;


    $.ajax({
      data: param,
      url: "ajax/delete_test_jobseeker.php",
      method: "POST",

      success:function(data){

        window.location = 'employerApplicationShorlistedList.php';
        console.log(data);
      }
    });

    console.log('Clicked Delete');
    return false;
  });


});
</script>
</html>
<?php
mysql_free_result($rsJobAds);

mysql_free_result($rsCandidateApplied);

mysql_free_result($rsIsActive);

mysql_free_result($rsCandidate);

mysql_free_result($rsShortlistedCandidate);

mysql_free_result($rsDirectShorlisted);

mysql_free_result($rsEmployed);

mysql_free_result($rsComDetail);
?>
