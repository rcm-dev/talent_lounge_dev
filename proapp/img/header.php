<?php  

session_start();
//include 'session_checking.php';
include 'class/api.php';

?>
<!doctype html>
<head>
	<title>Beta Version Release</title>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/mojo-default.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
	<link type="text/css" href="css/smoothness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/buttons.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- end-css -->
	
	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/jquery.raty.min.js"></script>
	<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
	<script type="text/javascript" src="js/jquery.anchorCloud.js"></script>
	<script type="text/javascript" src="js/mocha.js"></script>
	<!-- end js -->

	<!-- VIdeo Js -->
	<!-- <link href="/css/video-js.css" rel="stylesheet"> -->
	<!-- <script src="/js/video.js"></script> -->
	<!-- /video js -->

	<!-- fancy -->
	<script type="text/javascript" src="plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<!-- /fancy -->

	<!-- tipsy -->
	<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<!-- /tipsy -->

	<!-- jNotify -->
	<link type="text/css" href="css/jquery.jnotify.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="js/jquery.jnotify.min.js"></script>
	<!-- jNotify -->

	<!-- vticker -->
	<script type="text/javascript" src="js/jquery.totemticker.min.js"></script>
	<!-- /vticker -->

	<!-- joyride -->
	<script type="text/javascript" src="js/jquery.joyride-1.0.2.js"></script>
	<link rel="stylesheet" type="text/css" href="css/joyride-1.0.2.css">
	<!-- /joyride -->

	<!-- hovercard -->
	<script type="text/javascript" src="js/jquery.hovercard.min.js"></script>
	<!-- /hovercard -->

	<!-- marquee -->
	<link type="text/css" href="css/jquery.marquee.min.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="js/jquery.marquee.min.js"></script>
	<!-- /marquee -->

	<!-- enhance -->
	<script type="text/javascript" src="js/enhance.js"></script>
	<script type="text/javascript" src="js/excanvas.js"></script>
	<script type="text/javascript" src="js/visualize.jQuery.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/visualize-light.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/visualize-dark.css"> -->
	<link rel="stylesheet" type="text/css" href="css/visualize.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/basic.css"> -->
	<!-- /enhance -->
</head>
<body class="lightGrey">
	<div style="padding:6px; background-color:#EDF823; font-weight:bold;" class="none">
		<div style="width:900px; margin:0 auto; text-align:center">
			<img src="images/icon_color/ear-listen.png" />
			We are conducting a survey, and your response would be appreciated <a href="http://www.surveymonkey.com/s.aspx?sm=2I5dUbZIiuIFH_2fjKvUIfrA_3d_3d" title="Survey" target="_blank" style="color:red;">Click here</a>. Found a bug? submit <a href="http://support.richcoremedia.com/index.php" title="here" target="_blank" style="color:red;">here</a>.
		</div>
	</div>
		<div id="top" class="">
			
			<div id="topContainer" class="">
				
				<div id="logo" class="left">
					<a href="index.php" title="Home">
						<img src="images/logo.png" alt="logo.png" border="0">
					</a>
					
				</div><!-- /left -->

				


				<!-- Tracking User -->

				<?php include 'session_checking.php'; ?>

				<div class="clear"></div><!-- /clear -->

				<!-- /Tracking User -->

			</div><!-- /topContainer -->

		</div><!-- /top -->


		<div id="navigation" class="">
			
			<div id="navContainer" class="">

				<div class="left">

					<input type="hidden" name="currEmailSession" id="currEmailSession" value="<?php echo $usr_email; ?>" />

					<?php  

					// tracking session
					if (!isset($usr_email)) { ?>


					<ul id="navmenu" class="">
						<li><a href="index.php" title="Buy &amp; Sell Goods">Utama</a></li>
						<!-- <li><a href="search-market.php?sp=DESC" title="Buy &amp; Sell Goods">Buy &amp; Sell Goods</a></li> -->
						<li><a href="connect-share.php" title="Connect &amp; Share">Laman Sosial</a></li>
						<li><a href="roadshow.php">Jelajah NCIA</a></li>
						<li><a href="video.php" title="How to video">How-to Visual</a></li>
					</ul><!-- /navmenu -->


						
					<?php } else { ?>
						
					

					<ul id="navmenu" class="">
						<li><a href="index.php" title="Buy &amp; Sell Goods">Utama</a></li>
						<li><a href="connect.php" title="Connect &amp; Share">Laman Sosial</a></li>
						<li><a href="roadshow.php">Jelajah NCIA</a></li>
						<li><a href="video.php" title="How to Video">How-to Visual</a></li>
						<li><a href="contribute.php" title="Dashboard">Paparan Utama</a></li>
					</ul><!-- /navmenu -->


					<?php } ?>

				</div><!-- /left -->


				<div class="right">
					
					<form action="" method="POST" class="none" accept-charset="utf-8" style="margin-top: 5px;">
						
						<input type="text" name="search" id="search" placeholder="Search..." />
						
					</form><!-- /search form -->

					<div style="margin-top:6px; color:#fff;">
						
						<?php //if(!isset($usr_email)) { ?>
							<a href="takethetour.php" title="Learn More" class="topLeft" style="color:#A0A0A0; margin-right:20px;">Lebih Lanjut</a>
						<?php //} ?>
						
						<img src="images/Apps-help-browser-icon.png" style="position:absolute; margin-left:-10px" />
						<a href="1-Help+and+Support.html" title="Service &amp; Support" class="topLeft" style="color:#A0A0A0;">Bantuan Talian</a>

<a href="contactus.php" title="Contact Us" class="topLeft" style="color:#A0A0A0;">Hubungi Kami</a>
					</div>

				</div><!-- /right -->

				<div class="clear"></div><!-- /clear -->

			</div><!-- /navContainer -->

		</div><!-- /navigation -->