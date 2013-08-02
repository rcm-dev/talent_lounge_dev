<!doctype html>
<head>
	<title>Welcome to Mojo! Social Business</title>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/mojo-default.css">
	<link rel="stylesheet" type="text/css" href="css/typography.css">
	<link rel="stylesheet" type="text/css" href="css/960_24_col.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<link rel="stylesheet" href="webfonts/stylesheet.css" type="text/css" charset="utf-8" />
	<!-- end-css -->
	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<!-- js -->
</head>
<body class="landing-home">
<div id="mojo-container-landing" class="landing">
	
	<div id="mojo-topcontainer-landing">
		<div class="container_24">
			<div id="mojo-logo" class="grid_4 omega">
				<div><a href="index.php"><img src="images/logo.png" title="Home"></a></div>
			</div>
			<div id="mojo-description" class="grid_12"></div>
			<div id="mojo-signup-landing" class="grid_8 omega right">
			<a href="howmojowork.php">How Mojo work</a> &nbsp;&nbsp; | &nbsp;&nbsp;
			<a href="signup.php" class="none"><strong>Sign</strong></a>
			<a href="signin.php" title="Log In Now">Sign In</a>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- /topcontainer -->

	<div id="mojo-happening">
		<div class="container_24">
			<div class="grid_3"><p>Mojo Happening</p></div>
			<div class="grid_21 omega"><p>Ada line2 untuk dapat funding yang terbaik?</p></div>
			<div class="clear"></div>
		</div>
	</div>
	
	<div id="mojo-showcase-landing" class="front">
		<div id="mojo-showcase-subcontainer" class="container_24">
			<div class="signup-form-container">
					<h1>Reset Password</h1>

					<div id="login-container">
					<form action="#" method="post" id="resetpassword">

					<div>
						<div id="loginstatus" class="success none">Perfect</div>
						<div id="loginstatus" class="error none">Fill up the form</div>
						<div id="loginLogin" class="none"><img src="images/ajax-loader.gif" /></div>
						<label>Email</label>
						<input type="text" name="email" id="email" class="title" placeholder="your@email.com" />
					</div>	

					<input type="submit" value="Reset Password" id="resetpassword" name="resetpassword" />

					</form>
					</div>

				</div>
			<div class="clear"></div>
		</div>
	</div><!-- /showcase -->
	
	<div style="margin-top: 30px;">
		<div class="mjb-subcontainer-landing container_24">
			<div class="mjb-container grid_6 omega">
			<h4>Conect &amp; Share</h4>
			<p>with other entrepreneurs. This also provides a tracking  
        mechanism for entrepreneurs.</p></div>

			<div class="mjb-container grid_6">
			<h4>Invent &amp; Influence</h4>
			<p>A co-creation platform to invent, improve, influence and contribute in developing products and services</p></div>

			<div class="mjb-container grid_6 omega">
			<h4 style="margin:0px;">Indentify &amp; Secure Funding</h4>
			<p>among entrepreneurs, universities, funders and the private sector</p></div>

			<div class="mjb-container grid_6">
			<h4>Buy &amp; Sell Goods</h4>
			<p>A commercial trading hub to match-make on various technologies, tools and equipments</p></div>

			<div class="clear"></div>
		</div>
	</div><!-- /bottom -->
	<div id="">
	</div><!-- /footer -->

	<div id="mojo-copyright">
		<div class="container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- /copyright -->

</div><!-- /container -->

<script type="text/javascript">
$(document).ready(function(){


	// validation email
	jQuery("#email").validate({
        expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
        message: "Should be a valid Email id"
    });


	$('#resetpassword').click(function(){
		
		var email =	$('#email').val();

		if (email == '') {
			
			alert('Enter your email address');

		} else {
			
			$.ajax({
				
				type: "POST",
				url: "ajax/resetpassword.php",
				data: 'email=' + email,
				cache: false,

				success: function(response){

					if (response == 1) {


						console.log('SENT');

					} else {

						console.log('NOT SEND');
						
					}
					
				}

			});

		}

		return false;

	});

});
</script>

</body>
</html>