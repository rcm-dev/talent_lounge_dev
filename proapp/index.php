<?php 

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Jawab Semua Soalan | ProApp
		</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="css/proapp_style.css">
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include 'header-sc.php'; ?>
		<div id="wrapper_app" class="ui-window">
			<h1>Penilaian Peribadi</h1>
			<p>
					<span class="label label-important">Arahan:</span> Tekan "Mula Sekarang!" butang untuk mula menjawab.</p>
			
			<p>
				<img src="img/landing.png" alt="landing">
			</p>
			<p align="center">
				<input type="button" id="btnStart" class="btn btn-success" value="Mula Sekarang!" />
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