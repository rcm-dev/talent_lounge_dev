<?php  

session_start();
//include 'session_checking.php';
include 'class/api.php';

# sqlinjection
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
	mysql_real_escape_string(trim(htmlentities($seoname)));

	return $seoname;
}

?>
<!doctype html>
<head>
	<title>Home | Mojo</title>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/mojo-default.css">
	<link rel="stylesheet" type="text/css" href="css/typography.css">
	<link rel="stylesheet" type="text/css" href="css/960_24_col.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />

	<link type="text/css" href="css/smoothness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<!-- end-css -->
	
	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<!-- end js -->

	<!-- VIdeo Js -->
	<link href="css/video-js.css" rel="stylesheet">
	<script src="js/video.js"></script>
	<!-- /video js -->

	<!-- fancy -->
	<script type="text/javascript" src="plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

	<style type="text/css">
	label {
		display: block;
	}
	</style>
	<!-- /fancy -->
</head>
<body>
<?php  


/**
 * check login
 */

// inc db
include 'db/db-connect.php';

// get POST
$email = mysql_real_escape_string(htmlentities(@$_POST['email']));
$password = mysql_real_escape_string(htmlentities(@$_POST['password']));
$enc_pwd	= md5($password);



// ==================================================================
//
// 1st checking
//
// ------------------------------------------------------------------

$firstChecking = "SELECT * FROM mj_users WHERE usr_email = '$email'";
$resulfirst	   = mysql_query($firstChecking);
$firstnorow	   = mysql_num_rows($resulfirst);


if ($firstnorow == 0) {
	
	// redirect login error
	$url = 'notregister.php';
	
	?>

	<script type="text/javascript">

location.href = '<?php echo $url; ?>';

</script>

	<?php

}
else {
	
	// checking
	$sql = mysql_query("SELECT
  mj_users.usr_acct_status As isActivated,
  mj_users.usr_email,
  mj_users.usr_name,
  mj_users.usr_id,
  mj_users.users_type,
  mj_users.users_id
From
  mj_users
Where usr_email = '$email' AND usr_pwd = '$enc_pwd'");
	$sqlno = mysql_num_rows($sql);
	$row = mysql_fetch_object($sql);


	


	// redirect
	if ($sqlno == 1) {

		$rowactive = $row->isActivated;

		if ($rowactive == 0) {
			
			// send activation
			$url = 'sendactiviation.php';

			?>

	<script type="text/javascript">

location.href = '<?php echo $url; ?>';

</script>

	<?php


		} else {
		
			// register session
			//session_start();
			$usr_email = $_SESSION['usr_email'] = $row->usr_email;
			$usr_id = $_SESSION['usr_id'] = $row->usr_id;
			$usr_name = $_SESSION['usr_name'] = $row->usr_name;

			$_SESSION['MM_Username'] = $row->usr_name;
    		$_SESSION['MM_UserGroup'] = $row->users_type;
			$_SESSION['MM_UserID'] = $row->users_id;	  

			// redirect header;
			$url = 'recruitment/sessionGateway.php';

			?>

	<script type="text/javascript">

top.location.href = '<?php echo $url; ?>';

</script>

	<?php

		}


	} else {
		
		// redirect login error
		$url = 'resetorcheckmail.php';

		?>

	<script type="text/javascript">

location.href = '<?php echo $url; ?>';

</script>

	<?php

	}

}





?>
</body>
</html>