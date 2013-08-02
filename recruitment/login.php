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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=md5($_POST['password']);
  $MM_fldUserAuthorization = "users_type";
  $MM_redirectLoginSuccess = "sessionGateway.php";
  $MM_redirectLoginFailed = "loginFailed.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conJobsPerak, $conJobsPerak);
  	
  $LoginRS__query=sprintf("SELECT users_id, users_email, users_pass, users_type FROM jp_users WHERE users_email=%s AND users_pass=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conJobsPerak) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'users_type');
    // get userID
	$query_user_id 			= "SELECT * FROM jp_users WHERE users_email = '$loginUsername'";
	$query_user_id_result 	= mysql_query($query_user_id);
	$c_users 				= mysql_fetch_object($query_user_id_result);
	$cuid    				= $c_users->users_id;
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['MM_UserID'] = $cuid;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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

      <div>
        <br>
        <div id="content_full" style="text-align: center;">
          <h1 class="bebasTitle">
            Opss! Same we got mis page. <a href="http://beta.talentlounge.my">Home</a>
          </h1>
        </div>
      </div>
		  <div id="content_full" class="search_container" style="padding-top:10px;margin-top:30px; display:none">
<h2>Portal Login</h2>
<div class="master_details_full">
	<p>Please fill up your Email and Password.</p>
	<form action="<?php echo $loginFormAction; ?>" method="POST" enctype="application/x-www-form-urlencoded" name="portalLogin">
    <table width="600" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr>
    <td align="right" valign="middle">Email <span class="req">*</span></td>
    <td>:</td>
    <td><input name="email" placeholder="Your Registered Email" type="text"></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Password <span class="req">*</span></td>
    <td>:</td>
    <td><input name="password" placeholder="Password" type="password"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="login" type="submit" value="Log In"> <input name="clear" type="reset" value="Clear"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Not a member? <a href="registerJobSeeker.php">Sign Up now</a><br/>
      <a href="forgot-password.php">Forgot Password</a></td>
  </tr>
</table>

    </form>
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