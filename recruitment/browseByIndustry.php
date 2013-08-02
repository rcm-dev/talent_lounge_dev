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
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
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

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsLocation = "SELECT * FROM jp_location WHERE location_parent = 0 ORDER BY location_name ASC LIMIT 0,8";
$rsLocation = mysql_query($query_rsLocation, $conJobsPerak) or die(mysql_error());
$row_rsLocation = mysql_fetch_assoc($rsLocation);
$totalRows_rsLocation = mysql_num_rows($rsLocation);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0 LIMIT 0,60"; // limit to 60
$rsIndustry = mysql_query($query_rsIndustry, $conJobsPerak) or die(mysql_error());
$row_rsIndustry = mysql_fetch_assoc($rsIndustry);
$totalRows_rsIndustry = mysql_num_rows($rsIndustry);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsIndustryAll = "SELECT * FROM jp_industry WHERE industry_parent = 0 LIMIT 0,60"; // limit to 60
$rsIndustryAll = mysql_query($query_rsIndustryAll, $conJobsPerak) or die(mysql_error());
$row_rsIndustryAll = mysql_fetch_assoc($rsIndustryAll);
$totalRows_rsIndustryAll = mysql_num_rows($rsIndustryAll);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $conJobsPerak) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$maxRows_rs14FeaturedEmployed = 14;
$pageNum_rs14FeaturedEmployed = 0;
if (isset($_GET['pageNum_rs14FeaturedEmployed'])) {
  $pageNum_rs14FeaturedEmployed = $_GET['pageNum_rs14FeaturedEmployed'];
}
$startRow_rs14FeaturedEmployed = $pageNum_rs14FeaturedEmployed * $maxRows_rs14FeaturedEmployed;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rs14FeaturedEmployed = "SELECT emp_id, emp_name, emp_featured FROM jp_employer WHERE emp_featured = 1";
$query_limit_rs14FeaturedEmployed = sprintf("%s LIMIT %d, %d", $query_rs14FeaturedEmployed, $startRow_rs14FeaturedEmployed, $maxRows_rs14FeaturedEmployed);
$rs14FeaturedEmployed = mysql_query($query_limit_rs14FeaturedEmployed, $conJobsPerak) or die(mysql_error());
$row_rs14FeaturedEmployed = mysql_fetch_assoc($rs14FeaturedEmployed);

if (isset($_GET['totalRows_rs14FeaturedEmployed'])) {
  $totalRows_rs14FeaturedEmployed = $_GET['totalRows_rs14FeaturedEmployed'];
} else {
  $all_rs14FeaturedEmployed = mysql_query($query_rs14FeaturedEmployed);
  $totalRows_rs14FeaturedEmployed = mysql_num_rows($all_rs14FeaturedEmployed);
}
$totalPages_rs14FeaturedEmployed = ceil($totalRows_rs14FeaturedEmployed/$maxRows_rs14FeaturedEmployed)-1;

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rs10FeaturedCandidate = "Select   jp_resume.users_id_fk,   jp_resume.resume_featured,   mj_users.users_fname,   mj_users.users_lname From   jp_resume Inner Join   mj_users On jp_resume.users_id_fk = mj_users.users_id Where   jp_resume.resume_featured = 1";
$rs10FeaturedCandidate = mysql_query($query_rs10FeaturedCandidate, $conJobsPerak) or die(mysql_error());
$row_rs10FeaturedCandidate = mysql_fetch_assoc($rs10FeaturedCandidate);
$totalRows_rs10FeaturedCandidate = mysql_num_rows($rs10FeaturedCandidate);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsAllindustries = "SELECT * FROM jp_industry LIMIT 0 , 60";
$rsAllindustries = mysql_query($query_rsAllindustries, $conJobsPerak) or die(mysql_error());
$row_rsAllindustries = mysql_fetch_assoc($rsAllindustries);
$totalRows_rsAllindustries = mysql_num_rows($rsAllindustries);

mysql_select_db($database_conJobsPerak, $conJobsPerak);
$query_rsTotalJobsOnline = "Select   Count(*) As totalOnline From   jp_ads Where   jp_ads.ads_enable_view = 1";
$rsTotalJobsOnline = mysql_query($query_rsTotalJobsOnline, $conJobsPerak) or die(mysql_error());
$row_rsTotalJobsOnline = mysql_fetch_assoc($rsTotalJobsOnline);
$totalRows_rsTotalJobsOnline = mysql_num_rows($rsTotalJobsOnline);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Talent Lounge Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="css/reveal.css">
	<script language="javascript" src="js/jquery-1.7.1.min.js"></script>
    <!-- Jquery modal -->
  <script src="js/jquery.reveal.js" type="text/javascript"></script>

</head>

<body>



	<header id="header">

		<div class="center">
			 <div id="logo" class="left" style="margin:10px 0px 0px 0px;">
          <a href="index.php" title="Home">
            <img src="../images/tl-logo.png" alt="logo.png" border="0">
          </a>
          
        </div><!-- /left -->

			<div class="right">
            <?php include 'session_checking_panel.php'; ?>
    		</div>
			<div class="clear"></div>
		</div><!-- .center -->
		
		<?php include("main_menu.php"); ?>
	</header><!-- #header-->
  <div id="jobs-landing" style="margin-top:5px; padding: 20px 0px">
    <div class="center">
      <div style="text-align:center; padding: 40px 0px;">
        <h1 class="title" style="font-size:40px; color: white;">Explore more by Job Industry</h1>
        <p>Almost 60 industries we have cover up.</p>
      </div>
      <div>
        <ul id="indus-icon">
          <?php while ($indusryView = mysql_fetch_object($rsIndustry)) { ?>
            <li class="resumebox">
              <a href="jobsByIndustry.php?ads_industry_id_fk=<?php echo $indusryView->indus_id; ?>&indus_name=<?php echo $indusryView->indus_name; ?>">
                <div>
                  <img src="../<?php echo $indusryView->industry_icon; ?>" alt="<?php echo $indusryView->indus_name; ?>" width="120px;">
                </div>
                <?php echo $indusryView->indus_name; ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>

    </div>



  </div><!-- #content-->
	
		  <aside id="sideRight" class="hide">
          	  <?php include('full_content_sidebar.php'); ?>
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
<script>
$(document).ready(function(){
	$('#search_job').live('click', function(){
		var q = $('#main_q').val();
		
		if(q == ''){
			alert('Fill Job Title / Job Description');
			return false;
		}

	});

  /* modal */
  $('#myButton').click(function(e) {
    e.preventDefault();
    $('#myModal').reveal();
  });


});
</script>
<?php
mysql_free_result($rsLocation);

mysql_free_result($rsIndustry);

mysql_free_result($rsTenLatestJob);

mysql_free_result($rs14FeaturedEmployed);

mysql_free_result($rs10FeaturedCandidate);

mysql_free_result($rsAllindustries);

mysql_free_result($rsTotalJobsOnline);
?>
