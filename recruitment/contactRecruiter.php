<?php require_once('Connections/conJobsPerak.php'); ?>
<?php 



$rname = mysql_real_escape_string($_GET['rname']);
$rid = mysql_real_escape_string($_GET['rid']);

if ($rname == '' && $rid == '') {
	# code...
}



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
<h3>Contact Agent : <span style="color: #2260ab"><?php echo $rname ?></span></h3>
<br>
<form action="ajax/sendAppointer.php" method="get" id="sendAppointer">
	<table width="600px">
		<tr>
			<td width="145px"><strong>Role Title</strong></td>
			<td>:</td>
			<td><input type="text" name="ra_title"></td>
		</tr>
		<tr>
			<td><strong>Location of Role</strong></td>
			<td>:</td>
			<td><input type="text" name="ra_location"></td>
		</tr>
		<tr>
			<td><strong>Tell us about the role</strong></td>
			<td>:</td>
			<td><textarea name="about_the_role" id="about_the_role" cols="20" rows="10" style="width:400px"></textarea></td>
		</tr>
		<tr>
			<td><strong>Salary Range</strong></td>
			<td>:</td>
			<td><input type="text" name="ra_salary_range_1"> to <input type="text" name="ra_salary_range_2"></td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="hidden" name="ra_recruit_id_fk" value="<?php echo base64_decode($rid) ?>">
				<input type="hidden" name="ra_emp_id_fk" id="ra_emp_id_fk" value="<?php echo $_SESSION['MM_UserID']; ?>">
				<button id="sendAppointer" class="button green">Send Appointer</button>
			</td>
		</tr>
	</table>
</form>
<div style="display:none; color:green" class="successMessageSend">
	<p><strong>Your request has been send to <?php echo $rname ?></strong></p>
</div>

<script>
	$(document).ready(function() {

		$('button#sendAppointer').click(function(){

			var form_sendAppointer = $('form#sendAppointer');
			var url_sendAppointer = form_sendAppointer.attr('action');
			var data_sendAppointer = form_sendAppointer.serialize();

			$.ajax({
				url: url_sendAppointer+'?'+data_sendAppointer,
				method: "GET",

				success:function(data){
					if (data == 1) {
						console.log('Send!');
					} else {
						$('div.successMessageSend').show('slow');
						form_sendAppointer.hide();
						console.log('Send & Saved!');
					}
				}
			});

			// console.log(data_sendAppointer);
			return false;
		});

		console.log('RUN()');
	});
</script>

</body>
</html>