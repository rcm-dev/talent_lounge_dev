<?php require_once('Connections/conJobsPerak.php'); ?>
<?php 


$emp_name = mysql_real_escape_string($_GET['emp_name']);
$apID = mysql_real_escape_string(base64_decode($_GET['apID']));
$ptitle = mysql_real_escape_string($_GET['ptitle']);
$range1 = mysql_real_escape_string($_GET['range1']);
$range2 = mysql_real_escape_string($_GET['range2']);
$loc = mysql_real_escape_string($_GET['loc']);
$about_the_role = mysql_real_escape_string($_GET['about_the_role']);

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
<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="../css/forms.css" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
<h3>Are you sure you want to take this project from <?php echo $emp_name ?>?</h3>
<br>
<table width="600px" id="projectDetails">
	<tr>
		<td><strong>Project</strong></td>
		<td>:</td>
		<td style="color:green"><?php echo $ptitle ?></td>
	</tr>
	<tr>
		<td><strong>Location</strong></td>
		<td>:</td>
		<td style="color:green"><?php echo $loc ?></td>
	</tr>
	<tr>
		<td><strong>Salary Range</strong></td>
		<td>:</td>
		<td style="color:green">RM <?php echo $range1 ?> <i>to</i> RM <?php echo $range2 ?></td>
	</tr>
	<tr>
		<td><strong>Description</strong></td>
		<td>:</td>
		<td style="color:green"><?php echo $about_the_role ?></td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<input type="hidden" id="projectID" value="<?php echo $apID ?>">
			<button class="button green" id="confirmTakeAjob">Confirm, Take this project.</button>
		</td>
	</tr>
</table>
<div class="successMessage" style="display:none; color:green; font-weight:bold;">
	<p>You got the project! Start hunting jobseekers.</p>
</div>
<br>


<script>
	$(document).ready(function() {

		$('button#confirmTakeAjob').click(function(){

			var pID = $('input#projectID').val();

			$.ajax({
				url: './ajax/confirmTakeAjobAsProject.php?projectID='+pID,
				method: 'GET',

				success:function(data){

					if (data == 1) {
						$('div.successMessage').show();
						$('table#projectDetails').hide();

						setTimeout(function(){
							window.location = 'recruiterMyProject.php';
						}, 2000);
					};
					// console.log(data);
				}
			});

			return false;
		});

		console.log('RUN()');
	});
</script>

</body>
</html>