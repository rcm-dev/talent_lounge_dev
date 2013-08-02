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
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsJobAlertAds = sprintf("Select   jp_ads.* From   jp_ads Where   (jp_ads.ads_location = %s Or   jp_ads.ads_salary <= %s Or   jp_ads.ads_industry_id_fk = %s) And jp_ads.ads_enable_view = 1", GetSQLValueString($colLoc_rsJobAlertAds, "int"),GetSQLValueString($colSal_rsJobAlertAds, "int"),GetSQLValueString($colInd_rsJobAlertAds, "int"));
$rsJobAlertAds = mysql_query($query_rsJobAlertAds, $conJobsPerak) or die(mysql_error());
$row_rsJobAlertAds = mysql_fetch_assoc($rsJobAlertAds);
$totalRows_rsJobAlertAds = mysql_num_rows($rsJobAlertAds);

$colname_rsIsActive = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_rsIsActive = $_SESSION['MM_UserID'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIsActive = sprintf("SELECT user_active FROM mj_users WHERE users_id = %s", GetSQLValueString($colname_rsIsActive, "int"));
$rsIsActive = mysql_query($query_rsIsActive, $conJobsPerak) or die(mysql_error());
$row_rsIsActive = mysql_fetch_assoc($rsIsActive);
$totalRows_rsIsActive = mysql_num_rows($rsIsActive);
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
    
		  <div id="content">
<h2>JobSeeker Dashboard</h2>
<div class="master_details">
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>
  <?php include("jobSeekerMenu.php"); ?>
  <?php } else { ?>
  	<span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo $_SESSION['MM_Username']; ?>">resend activation link</a>.</span>
  <?php } ?>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>  
    
    <div class="resumebox">
    	<strong>Registered :</strong> <?php echo $row_rsUserDashboard['users_register']; ?> &middot;
		<strong>Last Login :</strong> <?php echo $row_rsUserDashboard['users_last_login']; ?>
    </div>
    
    <img src="../images/alert-header.png" alt="">

    <div class="resumebox">
        <?php if ($totalRows_rsJobAlertAds == 0) { // Show if recordset empty ?>
  <p>No Job Alert from your setting.</p>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_rsJobAlertAds > 0) { // Show if recordset not empty ?>
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <th width="250">Job Title</th>
      <th>Salary (MYR-Malaysia Ringgit)</th>
      <th>&nbsp;</th>
    </tr>
    <?php do { ?>
      <tr>
        <td align="left" valign="middle"><a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobAlertAds['ads_id']; ?>">
          <?php echo ucfirst($row_rsJobAlertAds['ads_title']); ?></a></td>
        <td align="right" valign="middle">MYR&nbsp;<?php echo $row_rsJobAlertAds['ads_salary']; ?></td>
        <td align="center" valign="middle"><a href="jobsAdsDetails.php?jobAdsId=<?php echo $row_rsJobAlertAds['ads_id']; ?>" class="btn btn-success btn-mini">View</a></td>
      </tr>
      <?php } while ($row_rsJobAlertAds = mysql_fetch_assoc($rsJobAlertAds)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
 
    </div>
    
     <?php } // if not active?>
</div>


<div class="resumeBox">
  <?php  

$query_check_type = "SELECT * FROM mj_users WHERE users_type = 2 AND usr_id = " . $_SESSION['usr_id'];
$result_check_type = mysql_query($query_check_type);
$totalRow_check_type = mysql_num_rows($result_check_type);

?>
<?php if ($totalRow_check_type == 1) { ?>
  <strong>Employer Tool</strong><br><br>
  <p>Now you can filter through this tool.</p>
  <br>
  <div>
    <form action="result_filter.php" method="get" target="_blank">
      <table width="400px" border="0" cellpadding="2" cellspacing="2" style="border-collapse:collapse">
        <tr>
          <td>APSC</td>
          <td><input type="checkbox" name="a" value="true"> A</td>
          <td><input type="checkbox" name="p" value="true"> P</td>
          <td><input type="checkbox" name="s" value="true"> S</td>
          <td><input type="checkbox" name="c" value="true"> C</td>
        </tr>
        <tr style="color:#eaeaea">
          <td>FICE</td>
          <td><input type="checkbox" disabled="disabled" name="f" value="true"> F</td>
          <td><input type="checkbox" disabled="disabled" name="i" value="true"> I</td>
          <td><input type="checkbox" disabled="disabled" name="c" value="true"> C</td>
          <td><input type="checkbox" disabled="disabled" name="e" value="true"> E</td>
        </tr>
        <tr style="color:#eaeaea">
          <td>HSD</td>
          <td><input type="radio" disabled="disabled" name="h" value="true"> H</td>
          <td><input type="radio" disabled="disabled" name="s" value="true"> S</td>
          <td><input type="radio" disabled="disabled" name="d" value="true"> D</td>
          <td>&nbsp;</td>
        </tr>
        <tr style="color:#eaeaea">
          <td>FSIR</td>
          <td><input type="checkbox" disabled="disabled" name="f" value="true"> F</td>
          <td><input type="checkbox" disabled="disabled" name="s" value="true"> S</td>
          <td><input type="checkbox" disabled="disabled" name="i" value="true"> I</td>
          <td><input type="checkbox" disabled="disabled" name="e" value="true"> R</td>
        </tr>
      </table>
      <br>
      <input type="submit" name="filterTrue" value="Browse Select">
    </form>
  </div>
<?php } else { ?>


<img src="../images/profiling-header.png" alt="">

<div class="resumebox">
<p>
  <?php  


  $query_check = "SELECT * FROM profile_filter WHERE user_id_fk = " . $_SESSION['usr_id'];
  $result_check = mysql_query($query_check);
  $totalRow_check = mysql_num_rows($result_check);

  if ($totalRow_check == 1) { ?>

  <strong>Looks like you know your personality. See your report below.</strong>

  <table width="100%">
    <tr>
      <td align="center" valign="middle">
        <img src="../images/book-Reader-icon.png" alt="Report Profiling">
      </td>
      <td align="center" valign="middle">
        <img src="../images/graduated-icon.png" alt="Report Profiling">
      </td>
    </tr>
    <tr>
      <td align="center" valign="middle">
        <a href="../proapp/profile_report.php?uid='.$_SESSION['usr_id'].'" title="Profile Report">Profile Report</a>
      </td>
      <td align="center" valign="middle">
        <a href="../proapp/career.php?uid='.$_SESSION['usr_id'].'" title="Career Profiling">Career Profiling</a>
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="middle" colspan="2">
        <a href="../proapp/" title="Take a Test" class="tl-btn-green">Take a Test / Re-Take</a>
      </td>
    </tr>
  </table>
  <?php 

  } else { ?>
    
    <a href="../proapp/" title="Take a Test">Take a Test</a>


  <?php 

  }

  ?>
</p>
</div>

<?php } ?>
</div>

          </div><!-- #content-->
	
		  <aside id="sideRight">
          	  <?php include('sidebar_candidate.php'); ?>
          </aside>
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

mysql_free_result($rsJobAlertAds);

mysql_free_result($rsIsActive);
?>
