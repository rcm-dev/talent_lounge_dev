<div id="footNavi">
	<div class="center">
		<div style="float:left; width: 310px; border:0px solid red; margin-right:10px;">
			<strong class="bebasTitle">Jobseeker</strong>
			<ul>
				<li><a href="#">My Resume</a></li>
				<li><a href="#">My Personality</a></li>
				<li><a href="#">Search Job</a></li>
				<li><a href="#">Internships</a></li>
				<li><a href="#">Company Profile</a></li>
			</ul>
		</div>
		<div style="float:left; width: 310px; border:0px solid red; margin-right:10px;">
			<strong class="bebasTitle">Employer</strong>
			<ul>
				<li><a href="#">Employer Registration</a></li>
				<li><a href="#">Post a Job</a></li>
				<li><a href="#">Employer Dashboard</a></li>
				<li><a href="#">My Company Profile</a></li>
				<li><a href="#">Advance Resume Access</a></li>
			</ul>
		</div>
		<div style="float:left; width: 310px; border:0px solid red; margin-right:10px;">
			<strong class="bebasTitle">Connect</strong>
			<ul class="social_footer">
				<li>
					<a href="#"><img src="../images/facebook-icon.png" alt="Facebook"></a></li>
				<li>
					<a href="#"><img src="../images/twitter-icon.png" alt="Twitter"></a></li>
				<li>
					<a href="#"><img src="../images/youtube-icon.png" alt="You Tube"></a></li>
			</ul>
		</div>
		<div style="clear:both"></div>
	</div>
</div>
<div>
<h2 class="bebasTitle">Innovatis Sdn. Bhd.</h2><br>
			  B201, Block B, Level 2, Phileo Damansara II, 15, Jalan 16/11, 46350, Petaling Jaya, Selangor Darul Ehsan.<br>
			  Tel: 603 - 7665 0607 Fax: 603 - 7665 0610 <br>
		  All rights Reserved &copy; 2012 - 2013
		| <a href="privacy-policy.php">Privacy Policy</a> | <a href="terms-and-conditions.php">Terms and Conditions</a>
</div>
<div class="clear"></div>

<script language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/modernizr.custom.86080.js"></script>

<script type="text/javascript" src="../plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
	// add to head css
	$('head').append('<link rel="stylesheet" href="../font/webfont_stylesheet.css" type="text/css" />');

	$('head').append('<link rel="shortcut icon" href="../favicon.ico" />');
	$(document).attr('title', 'Talent Lounge');

	$('head').append('<link rel="stylesheet" type="text/css" href="../plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />');
	
	/* Edit profile fancy box */
	$('#editProfile').fancybox({
	    'titlePosition'   : 'inside',

	    'transitionIn'    : 'none',

	    'transitionOut'   : 'none',

	    'type'				: 'iframe'
	  });



	/* Register */
	$("#iregister").fancybox({


		'autoScale'			: false,

		'height'			: '70%',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});


	/* login */
	$("#ilogin").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});

	/* login */
	$("#loginFromJob").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});


	/* public figure */
	$('.public').fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});
	
	});
</script>