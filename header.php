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


	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

	<link rel="stylesheet" href="font/webfont_stylesheet.css">
	<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="lightGrey">
	<div style="padding:6px; background-color:#EDF823; font-weight:bold;" class="none">
		<div style="width:900px; margin:0 auto; text-align:center">
			<img src="images/icon_color/ear-listen.png" />
			We are conducting a survey, and your response would be appreciated <a href="http://www.surveymonkey.com/s.aspx?sm=2I5dUbZIiuIFH_2fjKvUIfrA_3d_3d" title="Survey" target="_blank" style="color:red;">Click here</a>. Found a bug? submit <a href="http://support.richcoremedia.com/index.php" title="here" target="_blank" style="color:red;">here</a>.
		</div>
	</div>
	<div class="bgTop">
		<div id="top" class="navbar navbar-inverse navbar-fixed-top">
			<div id="topContainer" class="navbar navbar-inverse navbar-fixed-top">
				
				<!-- Tracking User -->

				<?php include 'session_checking.php'; ?>

				<div class="clear"></div><!-- /clear -->

				<!-- /Tracking User -->

			</div><!-- /topContainer -->

		</div><!-- /top -->


		<div id="navigation" class="navbar navbar-inverse navbar-fixed-top">
			
			<div id="navContainer" class="navbar">

				<div class="left">

					<input type="hidden" name="currEmailSession" id="currEmailSession" value="<?php echo $usr_email; ?>" />

					<?php  

					// tracking session
					if (!isset($usr_email)) { ?>


						<nav>
					<ul id="navmenu" class="">
						<li><a href="creative-idea.php" title="Showcase">Showcase</a></li>
						<li><a href="allUser.php" title="Talent">Talent</a></li>
						<li><a href="company_directory2.php" title="Companies">Companies</a></li>
						<li><a href="recruitment/jobsOpeningAll.php" title="Jobs">Jobs</a></li>
						<li><a href="#" title="Chalk Talk">Chalk Talk</a></li>
						<li><a href="training_list.php" title="Training">Training</a></li>
						<li style="display:none"><a href="recruitment/index.php" title="Recruitment">Recruitment</a>
							<ul style="display:none">
                                <li>
                                    <a href="company_directory.php">Company Directory</a>
                                </li>
                                <li><a href="funding.php" title="Talent Showcase">Talent Showcase</a></li>
                                <li class="none"><a href="creative-idea.php" title="Freelancer Platform">Freelancer</a></li>
                                <li><a href="freelance.php" title="Freelancer Platform">Freelancer</a></li>
                                <li><a href="recruitment/jobsByDisabled.php?ads_type=2" title="Disabled Careers">Disabled Careers</a></li>
                                <li><a href="recruitment/jobsByProfessional.php?ads_type=1" title="Encore Careers">Retirees Careers</a></li>
                            </ul>
						</li>
						<li style="display:none"><a href="connect-share.php" title="Social Network">Social Network</a>
							<ul>
								<li><a href="connect-share.php" title="Connect &amp; Share">Connect &amp; Share</a></li>
								<li><a href="search-market.php?sp=DESC" title="Buy &amp; Sell">Buy &amp; Sell</a></li>

						</ul></li>
						<li class="none"><a href="" title="Talent Launchpad">Talent Launchpad</a>
							<ul>
								<li><a href="news_Highlights.php" title="News &amp; Highlight">News &amp; Highlights</a></li>
								<li><a href="exhibition_entertainment.php" title="Exibitions &amp; Displays">Exhibitions &amp; Displays </a></li>
								<li><a href="slide.php" title="Performance &amp; Live Shows">Performances &amp; Live Shows</a></li>
								<li><a href="entrepreneur-library.php" title="Education &amp; Learning">Education &amp; Learning</a></li>
						</ul></li>
						<li class="none">
							<a href="takethetour.php">Take a Tour</a>
						</li>
						<li class="none">
							<a href="pricing.php">Pricing</a>
						</li>
						<li class="none">
                            <a href="login.php" id="iloginEmp" style="color: orange !important">Employer Login</a>
                        </li>
                        <li style="margin-top:1px !important;" class="none">
                        	<span style="color: white !important">Hiring Talent?</span> &nbsp; <a href="login.php" class="tl-btn-red public">Post a Job!</a>
                        	&nbsp; <span style="color: white">Employer Login: Call +603 7665 0607 Now!</span>
                        </li>
						
					</ul><!-- /navmenu -->
					</nav>


						
					<?php } else { ?>
						
					

					<nav >
					<ul id="navmenu" class="">
						<li><a href="showcase.php" title="Showcase">Showcase</a></li>
						<li><a href="talent.php" title="Talent">Talent</a></li>
						<li><a href="companies.php" title="Companies">Companies</a></li>
						<li><a href="jobs.php" title="Jobs">Jobs</a></li>
						<li><a href="chalk_talk.php" title="Chalk Talk">Chalk Talk</a></li>
						<li><a href="training_list.php" title="Training">Training</a></li>

						<li style="display:none"><a href="index.php" title="Back to Home">Home</a></li>
						<li style="display:none"><a href="recruitment/index.php" title="Recruitment">Recruitment</a>
							<ul>
                                <li>
                                    <a href="company_directory.php">Company Directory</a>
                                </li>
                                <li><a href="funding.php" title="Talent Showcase">Talent Showcase</a></li>
                                <li><a href="freelance.php" title="Freelancer Platform">Freelancer</a></li>
                                <li><a href="recruitment/jobsByDisabled.php?ads_type=2" title="Disabled Careers">Disabled Careers</a></li>
                                <li><a href="recruitment/jobsByProfessional.php?ads_type=1" title="Retirees Careers">Retirees Careers</a></li>
                            </ul>
						</li>
						<li style="display:none"><a href="connect.php" title="Social Network">Social Network</a>
							<ul>
								<li><a href="connect.php" title="Connect &amp; Share">Connect &amp; Share</a></li>
								<li><a href="search-market.php?sp=DESC" title="Buy &amp; Sell">Buy &amp; Sell</a></li>

						</ul></li>
						<li class="none"><a href="connect.php" title="Talent Launchpad">Talent Launchpad</a>
							<ul>
								<li><a href="news_Highlights.php" title="News &amp; Highlight">News &amp; Highlights</a></li>
								<li><a href="exhibition_entertainment.php" title="Exibitions &amp; Displays">Exhibitions &amp; Displays </a></li>
								<li><a href="slide.php" title="Performance &amp; Live Shows">Performances &amp; Live Shows</a></li>
								<li><a href="entrepreneur-library.php" title="Education &amp; Learning">Education &amp; Learning</a></li>


						</ul></li>
						<li class="none">
							<a href="takethetour.php">Take a Tour</a>
						</li>
						<li>
							<a href="contribute.php">My Lounge</a>
							<ul style="display:none">
								<li style="width:200px;">
									<a href="recruitment/sessionGateway.php" title="Dashboard">Recruitment</a>
								</li>
								<li>
									<a href="contribute.php" title="Dashboard">Contribution</a>
								</li>
							</ul>
						</li>
				         
					</ul><!-- /navmenu -->
				</nav>

					<?php } ?>

				</div><!-- /left -->


				<?php if (!isset($usr_email)) { ?>
				<!-- <div class="right" style="margin-right:-200px; margin-top:0px;"> -->
				<div class="right none">
				<?php } else { ?>
				<div class="right none">
				<?php } ?>
					
					<form action="" method="POST" class="none" accept-charset="utf-8" style="margin-top: 5px;">
						
						<input type="text" name="search" id="search" placeholder="Search..." />
						
					</form><!-- /search form -->

					<div style="margin-top:6px; color:#fff;">
						
						<?php //if(!isset($usr_email)) { ?>
							<!-- <a href="takethetour.php" title="Learn More" class="topLeft" style="color:#A0A0A0; margin-right:20px;">Learn More</a> -->
						<?php //} ?>
						
						<img src="images/Apps-help-browser-icon.png" style="position:absolute; margin-left:-10px" />
						<a href="1-Help+and+Support.html" title="Service &amp; Support" class="topLeft" style="color:#A0A0A0;">Service &amp; Support</a> &middot; <a href="pricing.php" style="color:#A0A0A0;">Pricing &amp; Package</a>

						

<!-- <a href="contactus.php" title="Contact Us" class="topLeft" style="color:#A0A0A0;">Contact Us</a> -->
					</div>

				</div><!-- /right -->

				<div class="clear"></div><!-- /clear -->

			</div><!-- /navContainer -->

		</div><!-- /navigation -->
	</div>
	<!-- bgTop -->
	<div class="middleStack">
		<div class="pathStar">
		