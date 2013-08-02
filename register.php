<?php  

//include 'session_checking.php';
include 'class/api.php';

?>
<!doctype html>
<head>
	<title>Home | Mojo</title>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/mojo-default.css">
	<link rel="stylesheet" type="text/css" href="css/typography.css">
	<link rel="stylesheet" type="text/css" href="css/960_24_col.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
	<link rel="stylesheet" type="text/css" href="css/buttons.css">

	<link type="text/css" href="css/smoothness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<!-- end-css -->
	
	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<!-- end js -->

	<!-- VIdeo Js -->
	<link href="css/video-js.css" rel="stylesheet">
	<script src="js/video.js"></script>
	<!-- /video js -->

	<!-- fancy -->
	<script type="text/javascript" src="plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

	<style type="text/css">
	label {
		display: block;
	}
	body {
		background-color: #f2f2f2;
	}
	</style>
	<!-- /fancy -->
</head>
<body style="background-color:none;">

				<div style="padding: 5px; background: none; border-bottom:0px solid #ddd;">
					<strong style="color:#291618; font-size:20px;">Free to register</strong> &middot; 
					<span>It's free and always will be.</span>
				</div>

				<div id="checkMail" class="info none" style="background-color:none;">
						Thank You for register, Activation link has been sent to your email and check your spam too.
					</div>

					<form action="#" method="post" id="signupform" style="padding:10px">

					<div id="basic-info" style="background: none">
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
					
					<div id="comp-verification" class="none">
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
						<p>
							We have two type of registration which is Jobseeker and Employer. By default you will become to jobseeker if you as a employer, register first and <a href="1-Help+and+Support.html" target="_parent">Contact us</a> and we will upgrade your account. <br><br>By clicking Sign Up, you agree to our <a href="recruitment/terms-and-conditions.php" target="_parent">Terms</a> and that you have read our <a href="recruitment/privacy-policy.php" target="_parent">Data Use Policy</a> <br>
						</p>
						<!-- <input type="submit" name="third-step" id="third-step" value="Signup Now" /> -->
						<input type="submit" name="iregister" id="iregister" value="Signup Now" class="button green" />
					</div>
					<!-- /3rd step -->

					</form>

			</div>


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
						console.log('CO NO OK');

					} else {

						$('#invalidconum').fadeIn();
						$('#validconum').hide();
						console.log('CO NO NOT OK');
						
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
						console.log('DIRECTOR OK');

					} else {

						$('#invalidicdirector').fadeIn();
						$('#validicdirector').hide();
						console.log('DIRECTOR NOT OK');
						
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


						console.log('CO NO n IC VALID');
						$('#third-step').removeAttr("disabled");
						$('#invalidicdirector').hide();
						$('#validicdirector').fadeIn();

					} else {

						$('#third-step').attr("disabled", "disabled");
						$('#validicdirector').hide();
						$('#invalidicdirector').fadeIn();
						console.log('CO NO n IC NOT VALID');
						
					}
					
				}

			});
		}

	}

	//------------------------------------------------------------------------------



	$('#iregister').click(function(){


		var email 		= $('#email').val();
		var password 	= $('#password').val();
		var conum 		= $('#conum').val();
		var username 	= $('#username').val();


		if (email != '' && password != '' && username != '') {

			$.ajax({
				
				type: "POST",
				url: "ajax/signup-now.php",
				data: 'email=' + email + '&password=' + password + '&conum=' + conum + '&username=' + username,
				cache: false,

				success: function(){


						console.log('Registered');
						
						$('#email').val("");
						$('#password').val("");
						$('#conum').val("");
						$('#username').val("");

						$('#signupform').hide();
						$('#checkMail').show();

						console.log('Not registered');						
					
				}

			});

		} else {

			console.log('Fill up the form!');

		}

		return false;
		

	});
	
	
	/* min hwidth */
	$('body').css('min-width','500px');


	

});
</script>
</body>
</html>