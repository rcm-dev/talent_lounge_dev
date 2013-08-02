<!doctype html>
<head>
	<title>Welcome to Mojo! Social Business</title>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/mojo-default.css">
	<link rel="stylesheet" type="text/css" href="css/typography.css">
	<link rel="stylesheet" type="text/css" href="css/960_24_col.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
	<!-- end-css -->

	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<!-- js -->

	<style type="text/css">
	label {
		display: block;
	}
	</style>
</head>
<body class="landing-home">
<div id="mojo-container" class="landing">
	
	<div id="mojo-topcontainer">
		<div class="container_24">
			<div id="mojo-logo" class="grid_4 omega"><h1>MOJO</h1></div>
			<div id="mojo-description" class="grid_12"><p><strong>Business Network</strong><br/>by Entrepreneurs for Entrepreneurs</p></div>
			<div id="mojo-signup" class="grid_8 omega">New at mojo? <a href="signup.php"><strong>Sign up now</strong></a>
			<a href="login.php" title="Log In Now" class="medium">LOG IN</a>
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

	
	<div id="mojo-showcase" class="front">
		<div id="mojo-showcase-subcontainer" class="container_24">
			<div id="mojo-showcase-container" class="grid_24">


				<div style="padding-left: 50px">
					<h1>Signup Now! It's Free</h1>

					<div id="checkMail" class="info none">
						Thank You for register, Activation link has been sent to your email.
					</div>

					<form action="#" method="post" id="signupform">

					<div id="basic-info">
						<h3>Basic Info</h3>
						<div id="invalidemail" class="error none">Email already taken</div>
						<div id="validemail" class="success none">Perfect! you can use this email</div>
						<div id="checking" class="info none"><img src="images/ajax-loader.gif">checking..</div>
						<label>Email</label>
						<input type="text" name="email" id="email" class="title" placeholder="your@email.com" /><br/>
						<label>Password</label>
						<input type="password" name="password" id="password" class="title" /><br/>
						<label>Re-type Password</label>
						<input type="password" name="password2" id="password2" class="title" /><br/>
						<label>Username</label>
						<input type="text" name="username" id="username" class="title" />
					</div>
					<!-- /1st step -->
					
					<div id="comp-verification">
						<h3>Verification</h3>
						<div id="invalidconum" class="error none">No Record for this number</div>
						<div id="validconum" class="success none">Perfect!</div>
						<label>Enter Company Number</label>
						<input type="text" name="conum" id="conum" class="title" placeholder="001988694-U" /><br/>

						<div id="invalidicdirector" class="error none">Not Match</div>
						<div id="validicdirector" class="success none">Valid</div>
						<label>IC of Director</label>
						<input type="text" name="icdirector" id="icdirector" class="title" placeholder="770922435553" />
					</div>
					<!-- /2nd step -->

					<div id="signup-Review">
						<input type="submit" name="third-step" id="third-step" value="Signup Now" />
					</div>
					<!-- /3rd step -->

					</form>

				</div>

			</div>
			<div class="clear"></div>
		</div>
	</div><!-- /showcase -->


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

</body>


<script type="text/javascript">
$(document).ready(function(){

	// disabled signup button
	$('#third-step').attr('disabled', 'disabled');
	
	// 1st step sign up
	$('input[type="submit"]#first-step').click(function(){
		//console.log('click');
		$('#basic-info').slideUp();
		return false;
	});

	// 2nd step sign up
	$('input[type="submit"]#second-step').click(function(){
		//console.log('click');
		$('#comp-verification').slideUp();
		return false;
	});


	// validation
	jQuery("#email").validate({
        expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
        message: "Should be a valid Email id"
    });

    jQuery("#password").validate({
        expression: "if (VAL.length > 5 && VAL) return true; else return false;",
        message: "Please enter a valid Password"
    });
    jQuery("#password2").validate({
        expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
        message: "Confirm password field doesn't match the password field"
    });
    jQuery("#icdirector").validate({
	    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
	    message: "Please enter a valid number"
	});

    var emailuser	=	$('#email').val();
    var passuser	=	$('#password').val();
    var pass2user	=	$('#password2').val();

    

    //-----------------------------------------------------------------------------

	$('#email').keyup(email_check);

	function email_check(){
		
		var email = $('#email').val();

		if (email == '') {
			
			alert('Fill your email');

		} else {
			
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-signup.php",
				data: 'email=' + email,
				cache: false,

				success: function(response){

					if (response == 1) {

						$('#invalidemail').fadeIn();
						$('#validemail').hide();

					} else {

						$('#validemail').fadeIn();
						$('#invalidemail').hide();
						
					}
						
				}

			});

		}

		

	}


	//------------------------------------------------------------------------------

	$('#conum').keyup(conum_check);

	function conum_check(){
		
		var conum = $('#conum').val();

		if (conum == '') {
			alert('Enter Company No.');
		} else {
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-conum.php",
				data: 'conum=' + conum,
				cache: false,

				success: function(response){

					if (response == 1) {


						$('#validconum').fadeIn();
						$('#invalidconum').hide();

					} else {

						$('#invalidconum').fadeIn();
						$('#validconum').hide();
						
					}
					
				}

			});



			
		}

	}

	//------------------------------------------------------------------------------

	$('#icdirector').keyup(icdirector_check);

	function icdirector_check(){
		
		var icdirector = $('#icdirector').val();

		var conum = $('#conum').val();


		if (icdirector == '') {
			alert('Enter IC Director of Your company');
		} else {
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-icdirector.php",
				data: 'icdirector=' + icdirector,
				cache: false,

				success: function(response){

					if (response == 1) {


						$('#validicdirector').fadeIn();
						$('#invalidicdirector').hide();

					} else {

						$('#invalidicdirector').fadeIn();
						$('#validicdirector').hide();
						
					}
					
				}

			});

			$.ajax({
				
				type: "POST",
				url: "ajax/verify-comp-director.php",
				data: 'icdirector=' + icdirector + '&conum=' + conum,
				cache: false,

				success: function(response){

					if (response == 1) {


						console.log('VALID');
						$('#third-step').removeAttr("disabled");

					} else {

						console.log('NOT VALID');
						
					}
					
				}

			});
		}

	}

	//------------------------------------------------------------------------------



	$('#third-step').click(function(){


		var email 		= $('#email').val();
		var password 	= $('#password').val();
		var conum 		= $('#conum').val();
		var username 	= $('#username').val();


		$.ajax({
				
			type: "POST",
			url: "ajax/signup-now.php",
			data: 'email=' + email + '&password=' + password + '&conum=' + conum + '&username=' + username,
			cache: false,

			success: function(response){

				if (response == 1) {


					console.log('Registered');
					
					$('#email').val("");
					$('#password').val("");
					$('#conum').val("");
					$('#username').val("");

					$('#signupform').hide();
					$('#checkMail').show();


				} else {

					console.log('Not registered');
					
				}
				
			}

		});

		return false;
		

	});
	
	
	

});
</script>


</html>