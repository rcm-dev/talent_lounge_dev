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
  $_SESSION['MM_UserID'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['MM_UserID']);
  unset($_SESSION['PrevUrl']);
	
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
<?php //$getJobAlertLoc = $row_rsUserJobAlert['jobP_1']; ?>
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

$colname_rsUserDashboard = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserDashboard = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserDashboard = sprintf("SELECT * FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsUserDashboard, "int"));
$rsUserDashboard = mysql_query($query_rsUserDashboard, $conJobsPerak) or die(mysql_error());
$row_rsUserDashboard = mysql_fetch_assoc($rsUserDashboard);
$totalRows_rsUserDashboard = mysql_num_rows($rsUserDashboard);

$colname_rsUserJobAlert = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsUserJobAlert = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsUserJobAlert = sprintf("SELECT * FROM jp_jobpreferences WHERE user_id_fk = %s", GetSQLValueString($colname_rsUserJobAlert, "int"));
$rsUserJobAlert = mysql_query($query_rsUserJobAlert, $conJobsPerak) or die(mysql_error());
$row_rsUserJobAlert = mysql_fetch_assoc($rsUserJobAlert);
$totalRows_rsUserJobAlert = mysql_num_rows($rsUserJobAlert);

$colname_rsJobAlertAds = $row_rsUserJobAlert['jobP_1'];
if (isset($row_rsUserJobAlert['jobP_1'])) {
  $colname_rsJobAlertAds = $row_rsUserJobAlert['jobP_1'];
}
$colLoc_rsJobAlertAds = $row_rsUserJobAlert['jobP_1'];
if (isset($colLoc_rsJobAlertAds)) {
  $colLoc_rsJobAlertAds = $row_rsUserJobAlert['jobP_1'];
}
$colSal_rsJobAlertAds = $row_rsUserJobAlert['jobP_salary'];
if (isset($colSal_rsJobAlertAds)) {
  $colSal_rsJobAlertAds = $row_rsUserJobAlert['jobP_salary'];
}
$colInd_rsJobAlertAds = $row_rsUserJobAlert['jobP_2'];
if (isset($colInd_rsJobAlertAds)) {
  $colInd_rsJobAlertAds = $row_rsUserJobAlert['jobP_2'];
}

$colname_rsJsID = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsJsID = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJsID = sprintf("SELECT * FROM jp_jobseeker WHERE users_id_fk = %s", GetSQLValueString($colname_rsJsID, "int"));
$rsJsID = mysql_query($query_rsJsID, $conJobsPerak) or die(mysql_error());
$row_rsJsID = mysql_fetch_assoc($rsJsID);
$totalRows_rsJsID = mysql_num_rows($rsJsID);

$maxRows_rsMyApplication = 20;
$pageNum_rsMyApplication = 0;
if (isset($_GET['pageNum_rsMyApplication'])) {
  $pageNum_rsMyApplication = $_GET['pageNum_rsMyApplication'];
}
$startRow_rsMyApplication = $pageNum_rsMyApplication * $maxRows_rsMyApplication;

$currentJsID = $row_rsJsID['jobseeker_id'];
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsMyApplication = "Select   jp_application.*,   jp_ads.*,   jp_application.js_id_fk As js_id_fk1,   jp_location.location_name From   jp_application Inner Join   jp_ads On jp_application.ads_id_fk = jp_ads.ads_id Inner Join   jp_location On jp_ads.ads_location = jp_location.location_id Where   jp_application.js_id_fk = '$currentJsID'";
$rsMyApplication = mysql_query($query_rsMyApplication, $conJobsPerak) or die(mysql_error());
$row_rsMyApplication = mysql_fetch_assoc($rsMyApplication);
$totalRows_rsMyApplication = mysql_num_rows($rsMyApplication);

$queryString_rsMyApplication = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMyApplication") == false && 
        stristr($param, "totalRows_rsMyApplication") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMyApplication = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMyApplication = sprintf("&totalRows_rsMyApplication=%d%s", $totalRows_rsMyApplication, $queryString_rsMyApplication);
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
  
  
<?php if ($totalRows_rsMyApplication > 0) { // Show if recordset not empty ?>
  <div>
    
    <table>
      <tr>
        <td><img src="../images/flat/64/briefcase.png" alt="Application"></td>
        <td>
          <h3>My Job Application(s)</h3>
        </td>
      </tr>
    </table>
    
    <?php if ($totalRows_rsMyApplication > 0) { // Show if recordset not empty ?>
      <table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
        <tr>
          <th>Job Title</th>
          <th>Location</th>
          <th align="right">Salary</th>
          <th>
            Status
          </th>
        </tr>
        <?php do { ?>
          <tr>
            <td align="left" valign="middle"><a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsMyApplication['ads_id']; ?>"><?php echo ucfirst($row_rsMyApplication['ads_title']); ?></a></td>
            <td align="center" valign="middle"><?php echo $row_rsMyApplication['location_name']; ?></td>
            <td align="right" valign="middle">MYR <?php echo $row_rsMyApplication['ads_salary']; ?></td>
            <td align="center">
              Status
            </td>
          </tr>
          <?php } while ($row_rsMyApplication = mysql_fetch_assoc($rsMyApplication)); ?>
      </table>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rsMyApplication > 0) { // Show if recordset not empty ?>
      <div class="paginate"><a href="<?php printf("%s?pageNum_rsMyApplication=%d%s", $currentPage, 0, $queryString_rsMyApplication); ?>">First</a> <a href="<?php printf("%s?pageNum_rsMyApplication=%d%s", $currentPage, max(0, $pageNum_rsMyApplication - 1), $queryString_rsMyApplication); ?>">Previous</a> <a href="<?php printf("%s?pageNum_rsMyApplication=%d%s", $currentPage, min($totalPages_rsMyApplication, $pageNum_rsMyApplication + 1), $queryString_rsMyApplication); ?>">Next</a> <a href="<?php printf("%s?pageNum_rsMyApplication=%d%s", $currentPage, $totalPages_rsMyApplication, $queryString_rsMyApplication); ?>">Last</a> | 
        Records <?php echo ($startRow_rsMyApplication + 1) ?> to <?php echo min($startRow_rsMyApplication + $maxRows_rsMyApplication, $totalRows_rsMyApplication) ?> of <?php echo $totalRows_rsMyApplication ?></div>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsMyApplication == 0) { // Show if recordset empty ?>
  <p>No job applied yet. <a href="index.php">Search and Apply now</a>
    <?php } // Show if recordset empty ?>
      </p>
  </div>
  <?php } else { // Show if recordset not empty ?>
<br/><br/>  Please update your profile and apply the job ads.
  <?php } ?>
  
  
  
</div>

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
mysql_free_result($rsUserDashboard);

mysql_free_result($rsUserJobAlert);

mysql_free_result($rsJsID);

mysql_free_result($rsMyApplication);
?>