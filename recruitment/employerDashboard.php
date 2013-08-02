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

  <?php } else { ?>
  <span style="color:#FF0000">Please Activate your account. Check your mail or <a href="resent-activation.php?mail=<?php echo $_SESSION['MM_Username']; ?>">resend activation link</a>.</span>
  <?php } ?>
  
  <?php if ($row_rsIsActive['user_active'] != 0){ ?>
  <br/>


    <div>
      <?php  

$query_check_type = "SELECT * FROM mj_users WHERE users_type = 2 AND usr_id = " . $_SESSION['usr_id'];
$result_check_type = mysql_query($query_check_type);
$totalRow_check_type = mysql_num_rows($result_check_type);

?>
<?php if ($totalRow_check_type == 1) { ?>
  <strong>Filter DISC Profile</strong><br><br>
  <div>
    <form action="../result_filter.php" method="get" target="_blank">
      <table width="100%" border="0" cellpadding="2" cellspacing="2" style="border-collapse:collapse" class="csstable2">
        <tr>
          <th>Profile Type</th>
          <th colspan="4">Score Type</th>
        </tr>
        <tr>
          <td>APSC</td>
          <td><input type="checkbox" name="a" id="a" value="true"> A</td>
          <td><input type="checkbox" name="p" id="b" value="true"> P</td>
          <td><input type="checkbox" name="s" id="c" value="true"> S</td>
          <td><input type="checkbox" name="c" id="d" value="true"> C</td>
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
      <div style="text-align:right">
        <input type="submit" name="filterTrue" id="filterTrue" value="Browse Select" class="button green right">
      </div>
    </form>
  </div>
<?php }  ?>
    <?php  

    /**
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     * *
     */

    ?>
    <br><br>
    </div>


    <p><strong><?php echo $totalRows_rsJobAds ?> Job Ad(s) by <?php echo $row_rsEmployed['emp_name']; ?></strong>
    &middot;
    <?php if ($totalRows_rsComDetail == 0) { // Show if recordset empty ?>
  <a href="employerAddDetails.php">Add Company Details</a>
  <?php } else { // Show if recordset empty ?>

    <?php 
      // basic menu
      if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
    <a href="employerAddJobAds.php?emp_id=<?php echo $row_rsEmployed['emp_id']; ?>">Submit New Job Ads</a></p>
    <?php } else { ?>
    
      <?php if (($totalRows_rsJobAds == 1) && ($row_rsPremiumCheck['usr_lvl'] == 0)) { ?>
        
        <strong class="upgrade_premium">[1 JOB ONLY &middot; UPGRADE TO PREMIUM]</strong></p>

      <?php } else { ?>

        <a href="employerAddJobAds.php?emp_id=<?php echo $row_rsEmployed['emp_id']; ?>">Submit New Job Ads</a></p>

      <?php } ?>

    <?php } ?>

    <?php } ?><br/>
<?php if ($totalRows_rsJobAds > 0) { // Show if recordset not empty ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="csstable2">
    <tr>
      <th>Title</th>
      <th>Date Submitted</th>
      <th>Candidate(s)</th>
      <th>Status</th>
      <?php 
      // basic menu
      // if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
      <th>Hits</th>
      <th>Pool of Cool</th>
      <?php //} ?>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsJobAds['ads_title']; ?></td>
        <td align="center" valign="middle"><?php echo date('l, F d, Y',strtotime($row_rsJobAds['ads_date_posted'])); ?></td>
        <td align="center" valign="middle">
        <?php 
		
		$c_JobAdsId = $row_rsJobAds['ads_id'];
		$query_total = "Select
  Count(jp_application.ads_id_fk) As Candidate
From
  jp_application
Where ads_id_fk = $c_JobAdsId And is_shortlisted = 0";
  		$result_qt = mysql_query($query_total);
		$row_qt = mysql_fetch_object($result_qt);
		
		if ($row_qt->Candidate > 0) {
			echo "<a href=\"employerApplicationDashboard.php?appid=".$row_rsJobAds['ads_id']."\" title=\"View Candidate(s)\">".$row_qt->Candidate."</a>";
		} else {
			echo $row_qt->Candidate;
		}
		?>
        </td>
        <td align="center" valign="middle"><?php if ($row_rsJobAds['ads_enable_view']==0){echo "Pending";}else{echo "<a href=jobsAdsDetails.php?jobAdsId=".$row_rsJobAds['ads_id'].">"."Live"."</a>";} ?></td>
        <td align="center" valign="middle">
          <?php echo $row_rsJobAds['ads_view']; ?>
        </td>
        <?php 
        // basic menu
        if ($row_rsPremiumCheck['usr_lvl'] != 0) { ?>
        <td align="center" valign="middle">
          <?php if ($row_rsJobAds['ads_enable_view']!=0) { ?>

            <a href="poolOfCoolResult.php?industryID=<?php echo $row_rsJobAds['ads_industry_id_fk'] ?>&employer_id=<?php echo $_SESSION['MM_UserID']; ?>">Talent</a>

          <?php } ?>

          <?php if ($row_rsJobAds['ads_enable_view']==0) { ?>

            Waiting for approval

          <?php } ?>

        </td>
        <?php } else { ?>
        <td align="center" valign="middle">
          <strong class="upgrade_premium">[UPGRADE TO PREMIUM]</strong>
        </td>
        <?php } ?>
      </tr>
      <?php } while ($row_rsJobAds = mysql_fetch_assoc($rsJobAds)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  
   <?php } // if not active?>
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


<script>
  $(document).ready(function() {
    $('input#filterTrue').click(function(){

      if ($('input#a').is(':checked') || $('input#b').is(':checked') || $('input#c').is(':checked') || $('input#d').is(':checked')) {
        return true;
      } else {

        alert('Select your Score Type!')
        return false;
      }
    });
  });
</script>


</body>
</html>
<?php
mysql_free_result($rsJobAds);

mysql_free_result($rsCandidateApplied);

mysql_free_result($rsIsActive);

mysql_free_result($rsEmployed);

mysql_free_result($rsComDetail);
?>
