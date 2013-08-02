<?php 

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Answer All Question | ProApp
		</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="css/proapp_style.css">
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include 'header-sc.php'; ?>
		<div id="wrapper_app" class="ui-window">
			<h1>PERSONAL PROFILING</h1>
			<p>
					<span class="label label-important">Instructions:</span> Click "Let's Start Now" button to answer the questions.</p>
			
			<p>
				<img src="img/landing.png" alt="landing">
			</p>
			<p align="center">
				<input type="button" id="btnStart" class="btn btn-success" value="Let's Start now!" />
			</p>
		</div>

		<?php include 'footer-sc.php'; ?>
		<script type="text/javascript">
			$(document).ready(function(){

				$('#btnStart').click(function(){
					window.location = "profile_questions.php";
				});

			});
		</script>
	</body>
</html>