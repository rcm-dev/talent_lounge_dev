<div style="text-align:left;">
			
			<div class="center">
				<div style="float:left; padding: 10px; width:360px;">
					<h2 style="color: white">Innovatis Sdn. Bhd</h2><br>
					<p>
						B201, Block B, Level 2, Phileo Damansara II, 15, <br>Jalan 16/11, 46350, <br>Petaling Jaya, Selangor Darul Ehsan. <br>
Tel: 603 - 7665 0607 <br>Fax: 603 - 7665 0610 
					</p>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2 style="color: white">Jobseeker</h2><br>
					<ul>
						<?php if (empty($_SESSION['MM_UserID'])): ?>
						<li><a href="../login.php" class="public">Log In</a></li>
						<li><a href="../register.php" class="public">Register</a></li>
						<?php endif ?>
						<li><a href="jobSeekerMyResume.php">My resume</a></li>
						<li><a href="jobsOpeningAll.php">View jobs</a></li>
						<li class="hide"><a href="#">Advance job search</a></li>
					</ul>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2 style="color: white">Employer</h2><br>
					<ul>
						<?php if (empty($_SESSION['MM_UserID'])): ?>
						<li><a href="../register.php" class="public">Employer Registration</a></li>
						<?php endif ?>
						<li><a href="../login.php" class="public">Employer Dashboard</a></li>
						<?php  

						/****************************
						 *
						 * Record Set for EmpID 
						 * MySQL Info 
						 * Table Used EmpID
						 *
						 ***************************/
						
						$query_rsEmpID = "SELECT * FROM jp_employer WHERE users_id_fk = " . $_SESSION['MM_UserID'];
						$result_rsEmpID = mysql_query($query_rsEmpID);
						
						if ($result_rsEmpID) {
							$row_rsEmpID = mysql_fetch_object($result_rsEmpID); ?>
						<li><a href="employerAddJobAds.php?emp_id=<?php echo $row_rsEmpID->emp_id ?>">Post Job Ad</a></li>

						<?php

						} else {

						?>
						<li><a href="../login.php" class="public">Post Job Ad</a></li>
						<?php } ?>
						<li><a href="../company_directory.php">Company Profile</a></li>
						<li><a href="jobsOpeningAll.php">View Current Jobs</a></li>
					</ul>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2 style="color: white">Resource</h2><br>
					<ul>
						<li><a href="../About_us.php">About Us</a></li>
						<li><a href="../contact-us.php">Contact Us</a></li>
						<li><a href="../advertise.php">Advertise</a></li>
						<li><a href="../our-team.php">Our Team</a></li>
						<li><a href="../send-feedback.php">Send Feedback</a></li>
					</ul>
				</div>
				<div style="clear:both"></div>
				<p style="margin:20px 0px;">
					&copy; 2012-2013 Talent Lounge, Manage by Innovatis Sdn. Bhd. All rights reserved.
				</p>
			</div>
		</div><!-- /footer -->

<div class="clear"></div>

<script type="text/javascript">
	$(document).ready(function(){
		
		// add to head css
		$('head').append('<link rel="stylesheet" href="../font/webfont_stylesheet.css" type="text/css" />');

		$('head').append('<link rel="shortcut icon" href="../favicon.ico" />');
		$(document).attr('title', 'Talent Lounge');

		$('header#header').addClass('header-top');

	$('<div class="tat"></div> <div class="contactTop"></div> <div class="topLogo"></div>').insertAfter('header#header > div.center > div#logo');

	$('<div class="peopleTop"></div>').insertAfter('nav#menu > div.center > div');

	$('head').append("<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>");
  $('head').append("<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>");

  $('<div id="tagline">Giving you the right Talent, right Job, right Time.</div>').insertAfter('header#header > div.center > div#logo');

  
	});
</script>