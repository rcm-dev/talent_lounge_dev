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

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobAds = sprintf("SELECT * FROM jp_ads WHERE emp_id_fk = %s", GetSQLValueString($colname_rsJobAds, "int"));
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
$query_rsIsActive = sprintf("SELECT user_active, usr_lvl FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsIsActive, "int"));
$rsIsActive = mysql_query($query_rsIsActive, $conJobsPerak) or die(mysql_error());
$row_rsIsActive = mysql_fetch_assoc($rsIsActive);
$totalRows_rsIsActive = mysql_num_rows($rsIsActive);
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Jobsperak Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
  <script type="text/javascript" src="../js/jquery.idTabs.min.js"></script>
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
<h2>Recruiter Dashboard</h2>
<div class="master_details_full">
  <br>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>

  <?php include("recruiter_menu.php"); ?>

  <?php } else { ?>
  <span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo urlencode($_SESSION['MM_Username']); ?>">resend activation link</a>.</span>
  <?php } ?>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>


  <?php  

  /****************************
   *
   * Record Set for ShorlistedProjectRecruiter 
   * MySQL Info 
   * Table Used ShorlistedProjectRecruiter
   *
   ***************************/
  
  $query_rsShorlistedProjectRecruiter = "SELECT * FROM recruit_js_lists WHERE rjs_recruit_id_fk = ";
  $result_rsShorlistedProjectRecruiter = mysql_query($query_rsShorlistedProjectRecruiter);
  $total_rows_rsShorlistedProjectRecruiter = mysql_num_rows($result_rsShorlistedProjectRecruiter);
  

  ?>

  <table class="csstable2">
    <tr>
      <th>Jobseeker List</th>
    </tr>

    <tr>
      <td>
        
      </td>
    </tr>

  </table>
  

  <?php } // Show if recordset not empty ?>
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
</html>
<?php
mysql_free_result($rsJobAds);

mysql_free_result($rsCandidateApplied);

mysql_free_result($rsIsActive);

mysql_free_result($rsEmployed);

mysql_free_result($rsComDetail);
?>
