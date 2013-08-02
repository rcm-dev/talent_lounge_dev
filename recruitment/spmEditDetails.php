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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE jp_spm SET user_id_fk=%s, spm_subject_id_fk=%s, spm_grade=%s WHERE spm_id=%s",
                       GetSQLValueString($_POST['user_id_fk'], "int"),
                       GetSQLValueString($_POST['spm_subject_id_fk'], "int"),
                       GetSQLValueString($_POST['spm_grade'], "text"),
                       GetSQLValueString($_POST['spm_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "spmEdit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustryList = "SELECT * FROM jp_industry";
$rsIndustryList = mysql_query($query_rsIndustryList, $conJobsPerak) or die(mysql_error());
$row_rsIndustryList = mysql_fetch_assoc($rsIndustryList);
$totalRows_rsIndustryList = mysql_num_rows($rsIndustryList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsSpecializeList = "SELECT * FROM jp_specialize";
$rsSpecializeList = mysql_query($query_rsSpecializeList, $conJobsPerak) or die(mysql_error());
$row_rsSpecializeList = mysql_fetch_assoc($rsSpecializeList);
$totalRows_rsSpecializeList = mysql_num_rows($rsSpecializeList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsLevelList = "SELECT * FROM jp_level";
$rsLevelList = mysql_query($query_rsLevelList, $conJobsPerak) or die(mysql_error());
$row_rsLevelList = mysql_fetch_assoc($rsLevelList);
$totalRows_rsLevelList = mysql_num_rows($rsLevelList);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsSubject = "SELECT * FROM jp_spm_subject";
$rsSubject = mysql_query($query_rsSubject, $conJobsPerak) or die(mysql_error());
$row_rsSubject = mysql_fetch_assoc($rsSubject);
$totalRows_rsSubject = mysql_num_rows($rsSubject);

$colname_rsSPMJsID = "-1";
if (isset($_GET['spmid'])) {
  $colname_rsSPMJsID = $_GET['spmid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsSPMJsID = sprintf("SELECT jp_spm_subject.subject_name,   jp_spm.* FROM jp_spm Inner Join   jp_spm_subject On jp_spm.spm_subject_id_fk = jp_spm_subject.subject_id WHERE jp_spm.spm_id = %s", GetSQLValueString($colname_rsSPMJsID, "int"));
$rsSPMJsID = mysql_query($query_rsSPMJsID, $conJobsPerak) or die(mysql_error());
$row_rsSPMJsID = mysql_fetch_assoc($rsSPMJsID);
$totalRows_rsSPMJsID = mysql_num_rows($rsSPMJsID);
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

		<div id="container" class="full">
		  <div id="content_full">
<h2>Update</h2>
<div class="master_details">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?> <?php echo $_SESSION['MM_UserID']; ?> | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  
  <div class="master_details boxcenter">
	<h3>Add SPM Subject</h3><br/>
	<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
	  <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Subject</td>
          <td><select name="spm_subject_id_fk" class="date">
            <?php
do {  
?>
            <option value="<?php echo $row_rsSubject['subject_id']?>"<?php if (!(strcmp($row_rsSubject['subject_id'], $row_rsSPMJsID['spm_subject_id_fk']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSubject['subject_name']?></option>
            <?php
} while ($row_rsSubject = mysql_fetch_assoc($rsSubject));
  $rows = mysql_num_rows($rsSubject);
  if($rows > 0) {
      mysql_data_seek($rsSubject, 0);
	  $row_rsSubject = mysql_fetch_assoc($rsSubject);
  }
?>
          </select></td>
        <tr>
        <tr valign="baseline">
          <td nowrap align="right">Grade</td>
          <td><label for="spm_grade"></label>
            <select name="spm_grade" class="date" id="spm_grade">
              <option value="A1" <?php if (!(strcmp("A1", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>A1</option>
              <option value="A2" <?php if (!(strcmp("A2", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>A2</option>
              <option value="B3" <?php if (!(strcmp("B3", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>B3</option>
              <option value="B4" <?php if (!(strcmp("B4", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>B4</option>
              <option value="C5" <?php if (!(strcmp("C5", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>C5</option>
              <option value="C6" <?php if (!(strcmp("C6", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>C6</option>
              <option value="D7" <?php if (!(strcmp("D7", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>D7</option>
              <option value="E8" <?php if (!(strcmp("E8", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>E8</option>
             
              <option value="G9" <?php if (!(strcmp("G9", $row_rsSPMJsID['spm_grade']))) {echo "selected=\"selected\"";} ?>>G9</option>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Update Subject"></td>
        </tr>
      </table>
      <input type="hidden" name="spm_id" value="<?php echo $row_rsSPMJsID['spm_id']; ?>">
      <input type="hidden" name="user_id_fk" value="<?php echo $_SESSION['MM_UserID']; ?>">
      <input type="hidden" name="MM_update" value="form1">
    </form>
    <p>&nbsp;</p>
  </div>
</div>

          </div><!-- #content-->
	
		  <aside id="sideRight" class="hide">
          	  <div class="sidebarBox">
              	<strong>How-to</strong>
            	<div class="sidebar_howto">
                	<ul>
                    	<li><a href="#">Register</a></li>
                        <li><a href="#">Post a Job</a></li>
                    </ul>
	            </div><!-- .sidebar_recentjob -->
              </div><!-- .sidebarBox -->
              
			  <div class="sidebarBox hide">
              	<strong>Recent Jobs</strong>
            	<div class="sidebar_recentjob">
                	<ul>
                      <li><a></a></li>
                    </ul>
	            </div><!-- .sidebar_recentjob -->
              </div><!-- .sidebarBox -->
              
              <div class="sidebarBox hide">
           	  <strong>Jobs Posted under </strong>
              	<ul>
                  <li><a></a></li>
                </ul>
              </div><!-- .sidebarBox -->
              
              <div class="sidebarBox hide">
           	  <strong>Get Connected</strong><br />
              	Facebook | Twitter | RSS
              </div><!-- .sidebarBox -->
            </aside>
			<!-- aside -->
			<!-- #sideRight -->

		</div><!-- #container-->
		

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
mysql_free_result($rsIndustryList);

mysql_free_result($rsSpecializeList);

mysql_free_result($rsLevelList);

mysql_free_result($rsSubject);

mysql_free_result($rsSPMJsID);
?>
