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
  $updateSQL = sprintf("UPDATE mj_users SET users_fname=%s, users_lname=%s, users_ic=%s WHERE users_id=%s",
                       GetSQLValueString($_POST['users_fname'], "text"),
                       GetSQLValueString($_POST['users_lname'], "text"),
                       GetSQLValueString($_POST['ic'], "text"),
                       GetSQLValueString($_POST['users_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "jobSeekerEditProfileSuccess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsProfile = "-1";
if (isset($_GET['users_email'])) {
  $colname_rsProfile = $_GET['users_email'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsProfile = sprintf("SELECT * FROM mj_users WHERE users_email = %s", GetSQLValueString($colname_rsProfile, "text"));
$rsProfile = mysql_query($query_rsProfile, $conJobsPerak) or die(mysql_error());
$row_rsProfile = mysql_fetch_assoc($rsProfile);
$totalRows_rsProfile = mysql_num_rows($rsProfile);$colname_rsProfile = "-1";
if (isset($_GET['email'])) {
  $colname_rsProfile = $_GET['email'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsProfile = sprintf("SELECT * FROM mj_users WHERE users_email = %s", GetSQLValueString($colname_rsProfile, "text"));
$rsProfile = mysql_query($query_rsProfile, $conJobsPerak) or die(mysql_error());
$row_rsProfile = mysql_fetch_assoc($rsProfile);
$totalRows_rsProfile = mysql_num_rows($rsProfile);
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
    
    <table>
      <tr>
        <td>
          <img src="../images/flat/64/gear.png" alt="Edit">
        </td>
        <td>
          <h3>Edit Profile</h3>
        </td>
      </tr>
    </table>

    <div>
    	<br/>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table align="center">
            <tr valign="baseline">
              <td nowrap align="right">Email:</td>
              <td><?php echo htmlentities($row_rsProfile['users_email'], ENT_COMPAT, 'utf-8'); ?></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Password:</td>
              <td><?php //echo htmlentities($row_rsProfile['users_pass'], ENT_COMPAT, 'utf-8'); ?>**************</td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">First Name:</td>
              <td><input type="text" name="users_fname" value="<?php echo htmlentities($row_rsProfile['users_fname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Last Name:</td>
              <td><input type="text" name="users_lname" value="<?php echo htmlentities($row_rsProfile['users_lname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr>
              <td nowrap align="right">IC:</td>
              <td>
                <?php  

                /**
                 *
                 * Record Set for select_ic
                 * Retrieve via object 
                 * 
                 */
                $query_select_ic     = "SELECT * FROM mj_users WHERE users_id = ".mysql_real_escape_string($row_rsProfile['users_id']);
                $rs_select_ic        = mysql_query($query_select_ic) or die(mysql_error());
                $row_select_ic       = mysql_fetch_object($rs_select_ic);
                $totalRows_select_ic = mysql_num_rows($rs_select_ic);
                
                $row_select_ic->users_ic;

                ?>
                <input type="text" name="ic" value="<?php if($totalRows_select_ic != NULL || $totalRows_select_ic != 0){ echo $row_select_ic->users_ic;} ?>" placeholder="without -"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Account Status:</td>
              <td><?php $account = htmlentities($row_rsProfile['user_active'], ENT_COMPAT, 'utf-8'); ?><?php if ($account == 1) {echo "Active";} else {echo "Not Active";} ?></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">&nbsp;</td>
              <td><input type="submit" value="Update Profile" class="button green"></td>
            </tr>
          </table>
          <input type="hidden" name="users_id" value="<?php echo $row_rsProfile['users_id']; ?>">
          <input type="hidden" name="users_register" value="<?php echo htmlentities($row_rsProfile['users_register'], ENT_COMPAT, 'utf-8'); ?>">
          <input type="hidden" name="users_last_login" value="<?php echo htmlentities($row_rsProfile['users_last_login'], ENT_COMPAT, 'utf-8'); ?>">
          <input type="hidden" name="users_type" value="<?php echo htmlentities($row_rsProfile['users_type'], ENT_COMPAT, 'utf-8'); ?>">
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="users_id" value="<?php echo $row_rsProfile['users_id']; ?>">
        </form>
        <p>&nbsp;</p>
    </div>
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
mysql_free_result($rsProfile);
?>
