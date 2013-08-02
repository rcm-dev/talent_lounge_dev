<html>
<head>
	<title>Talent Lounge &middot; Providing your the right talent for the right job role at the right time.</title>
	<style>
	* {
		margin:0;
		padding:0;
	}
	body {
		color: #400121;
		font-family: "Arial";
		font-size: 12px;
	}
	.center {
		margin: 0 auto;
		width: 1000px;
	}
	#topCoffe {
		background-image: url('images/coffee.jpg');
		background-repeat: no-repeat;
		background-position: top center;
		height: 870px;
	}
	#cafe {
		background-image: url('images/cafe.jpg');
		background-repeat: no-repeat;
		background-position: top center;
		height: 832px;
	}
	a {
		color: #400121;
		text-decoration: none;
	}
	a:hover {
		text-decoration: underline;
	}
	#footer {
		line-height: 20px;
		padding: 20px;
	}
	#footer li {
		list-style: none;
	}
	#footer h2 {
		font-weight: normal;
	}
	.welcometext {
		background-image: url('images/welcome-text.png');
		background-repeat: no-repeat;
		background-position: top center;
		width: 550px;
		height: 320px;
	}
	.float-btn {
		display: block;
		position: absolute;
	}
	#btn-showcase {
		padding-top: 530px;
		padding-left: 600px;
	}
	#btn-talent {
		padding-top: 700px;
		padding-left: 390px;
	}
	#btn-companies {
		padding-top: 450px;
		padding-left: 920px;
	}
	#btn-jobs {
		padding-top: 480px;
		padding-left: 420px;
	}
	#btn-chalk {
		padding-top: 400px;
		padding-left: 330px;
		z-index: 1;
	}
	#btn-training {
		padding-top: 430px;
		padding-left: 650px;
	}
	</style>
</head>
<body>
<div id="topCoffe">
	<div class="center">
		<div class="welcometext">
			
		</div>
		<p style="color:orange">Quick tour for Talent Lounge or <a href="#second" style="color: orange; font-weight: bold">explore more &rarr;</a></p>
		<div>
			<iframe width="420" height="345" src="http://www.youtube.com/embed/Q6geHhXE4bE" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
</div>
<div id="cafe">
	<div class="center">
		<div id="second" style="display:block; position:absolute; border:0px solid red; margin-top: 150px;"></div>
		<div id="btn-showcase" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
		<div id="btn-talent" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
		<div id="btn-companies" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
		<div id="btn-jobs" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
		<div id="btn-chalk" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
		<div id="btn-training" class="float-btn">
			<a href="creative-idea.php" style="color: white;">
				<div style="width: 80px; border:0px solid red; text-align: center">
					<img src="images/marker.png" alt="Showcase"><br>
				</div>
			</a>
		</div>
	</div>
</div>
<div id="footer">
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
</div>
</body>
</html>