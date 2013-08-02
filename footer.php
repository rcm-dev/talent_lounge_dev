</div>
<!-- .pathStar -->
</div>
<!-- .middleStack -->
		
		<div id="footer" style="text-align:left;">
			
			<div class="center">
				<div style="float:left; padding: 10px; width:360px;">
					<h2>Talent Lounge Sdn. Bhd</h2><br>
					<p>
						B201, Block B, Level 2, Phileo Damansara II, 15, <br>Jalan 16/11, 46350, <br>Petaling Jaya, Selangor Darul Ehsan. <br>
Tel: 603 - 7665 0607 <br>Fax: 603 - 7665 0610 
					</p>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2>Jobseeker</h2><br>
					<ul>
						<?php if (empty($usr_email)) { ?>
							<li><a href="login.php" id="flogin">Log In</a></li>
							<li><a href="register.php" id="fregister">Register</a></li>
						<?php } ?>

						<?php if (!empty($usr_email)) { ?>

						<?php  

						/****************************
						 *
						 * Record Set for IsEmp 
						 * MySQL Info 
						 * Table Used IsEmp
						 *
						 ***************************/
						
						$query_rsIsEmp = "SELECT * FROM jp_employer WHERE users_id_fk = " . $usr_id;
						$result_rsIsEmp = mysql_query($query_rsIsEmp);
						$total_rows_rsIsEmp = mysql_num_rows($result_rsIsEmp);
						
						if ($total_rows_rsIsEmp == 0) { ?>
						<li><a href="recruitment/jobSeekerMyResume.php">My resume</a></li>
						<li><a href="recruitment/jobsOpeningAll.php">View jobs</a></li>
						<li class="none"><a href="#">Advance job search</a></li>
						<?php 

						} else { ?>

						<li><a href="recruitment/jobSeekerMyResume.php">My resume</a></li>
						<li><a href="recruitment/jobsOpeningAll.php">View jobs</a></li>

						<?php

						}

						?>
						<?php } ?>
					</ul>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2>Employer</h2><br>
					<ul>
						<?php if (empty($usr_email)) { ?>
						<li><a href="register.php" id="fregisterEmp">Employer Registration</a></li>
						<li><a href="login.php" class="public">Employer Dashboard</a></li>
						<li><a href="login.php" class="public">Post Job Ad</a></li>
						<?php } ?>
						<?php if (!empty($usr_email)) { ?>
						<li><a href="recruitment/employerDashboard.php">Employer Dashboard</a></li>
						<?php  

						/****************************
						 *
						 * Record Set for EmpID 
						 * MySQL Info 
						 * Table Used EmpID
						 *
						 ***************************/
						
						$query_rsEmpID = "SELECT * FROM jp_employer WHERE users_id_fk = " . $usr_id;
						$result_rsEmpID = mysql_query($query_rsEmpID);
						$total_rows_rsEmpID = mysql_num_rows($result_rsEmpID);
						
						if ($total_rows_rsEmpID != 0) {
							$row_rsEmpID = mysql_fetch_object($result_rsEmpID); ?>

						<li><a href="recruitment/employerAddJobAds.php?emp_id=<?php echo $row_rsEmpID->emp_id ?>">Post Job Ad</a></li>

						<?php 

							}
						
						?>

						<?php } ?>
						<li><a href="company_directory.php">Company Profile</a></li>
						<li><a href="recruitment/jobsOpeningAll.php">View Current Jobs</a></li>
					</ul>
				</div>
				<div style="float:left; padding: 10px; width:180px;">
					<h2>Resource</h2><br>
					<ul>
						<li><a href="About_us.php">About Us</a></li>
						<li><a href="contact-us.php">Contact Us</a></li>
						<li><a href="advertise.php">Advertise</a></li>
						<li><a href="our-team.php">Our Team</a></li>
						<li><a href="send-feedback.php">Send Feedback</a></li>
					</ul>
				</div>
				<div style="clear:both"></div>
				<p style="margin:20px 0px;">
					&copy; 2012-2013 Talent Lounge, Managed by Innovatis Sdn. Bhd. All rights reserved.
				</p>
			</div>
		</div><!-- /footer -->

		<script type="text/javascript" src="js/mojo-javascript.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	</body>
</html>
</body>