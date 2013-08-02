<?php  


require_once('Connections/conJobsPerak.php');

$bookDate			=	$_POST['dbook'];
$bookTime			=	$_POST['tbook'];
$bookRoom			= $_POST['rbook'];	
$currID				=	$_POST['uid'];
$no_of_part   = $_POST['no_of_part'];
$note = htmlentities($_POST['note']);



$updatebooking	="INSERT INTO status_booking(status_id, 
											employer_id_fk, 
											booking_date_made,
											date_booking,
											booking_time_made,
											time_booking,
											booking_room_type,
										    note,
                        no_of_part)
					VALUES (NULL,
							'$currID',
							NOW(),
							'$bookDate',
							'',
							'$bookTime',
							'$bookRoom',
							'$note',
              '$no_of_part')";



$resultUpdatebooking = mysql_query($updatebooking);

$colname_rsBooking = "-1";
if (isset($_GET['cuid'])) {
  $colname_rsBooking = $_GET['cuid'];
}
mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsBooking = "SELECT * FROM status_booking WHERE employer_id_fk = '$currID' ";
$rsBooking = mysql_query($query_rsBooking, $conJobsPerak) or die(mysql_error());
$row_rsBooking = mysql_fetch_object($rsBooking);
$totalRows_rsBooking = mysql_num_rows($rsBooking);



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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE jp_employer SET emp_name=%s, emp_desc=%s, emp_industry_id_fk=%s, emp_address=%s, emp_tel=%s, emp_email=%s, emp_web=%s, emp_featured=%s, users_id_fk=%s WHERE emp_id=%s",
                       GetSQLValueString($_POST['emp_name'], "text"),
                       GetSQLValueString($_POST['emp_desc'], "text"),
                       GetSQLValueString($_POST['emp_industry_id_fk'], "int"),
                       GetSQLValueString($_POST['emp_address'], "text"),
                       GetSQLValueString($_POST['emp_tel'], "text"),
                       GetSQLValueString($_POST['emp_email'], "text"),
                       GetSQLValueString($_POST['emp_web'], "text"),
                       GetSQLValueString($_POST['emp_featured'], "int"),
                       GetSQLValueString($_POST['users_id_fk'], "int"),
                       GetSQLValueString($_POST['emp_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "employerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE mj_users SET users_fname=%s, users_lname=%s WHERE users_id=%s",
                       GetSQLValueString($_POST['users_fname'], "text"),
                       GetSQLValueString($_POST['users_lname'], "text"),
                       GetSQLValueString($_POST['users_id'], "int"));

  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  $Result1 = mysql_query($updateSQL, $conJobsPerak) or die(mysql_error());

  $updateGoTo = "employerDashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

function sqlInjectString($string) 
{

  $seoname = preg_replace('/\%/',' percentage',$string); 
  $seoname = preg_replace('/\@/',' at ',$seoname); 
  $seoname = preg_replace('/\&/',' and ',$seoname);
  $seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
  $seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
  $seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
  $seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens  
  //$seoname = trim(str_replace(range(0,9),'',$seoname));
  $seoname = strtolower($seoname);
  mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

  return $seoname;



}


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <title>Welcome to talent lounge</title>
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
 <h1 class="heading_title bebasTitle">Interview Room Booking </h1>
<div class="master_details_full">
  <p>Welcome <?php echo $_SESSION['MM_Username']; ?>  | <a href="<?php echo $logoutAction ?>">Log Out</a></p>
  <?php include("employer_menu.php"); ?><br/>
  
          <br/>
            <!-- <h1 class="heading_title bebasTitle">Booking Form</h1> -->
      

        <div class="left cnscontainer">
                <div class ="reserved">
  					<?php   	
					if ($resultUpdatebooking) {
	
					$usr_name = $_SESSION['curr_username'];
					echo "<h2 align='center'>Your room reservation was completed!!</h2>";
					echo"<br/>";
					echo "<h4>thank you</h4>";
					

					}
						?> 
			</div>
						
		</div>
        </div><!-- /orange left -->

          </div><!-- /contentContainer -->
  </section><!-- #middle-->
       

        <div class="clear"></div>


   

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


</section><!-- #middle-->

  </div><!-- #wrapper-->

  <footer id="footer">
    <div class="center">
      <?php include("footer.php"); ?>
    </div><!-- .center -->
  </footer><!-- #footer -->



</body>
</html>    
