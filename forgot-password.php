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
	<!-- / js -->
</head>
<body>

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
					<div class="success none">Check Your Email for temporary password</div>

				</div>

			</div>
			<div class="clear"></div>

<!-- javascript -->
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

						$('#login-container').hide();
						$('.success').fadeIn();
						$.jnotify("Thank you, we got your amount");
						console.log('SENT');

					} else {

						console.log('NOT SEND');
						
					}
					
				}

			});

		}

		return false;

	});


	/* min hwidth */
	$('body').css('min-width','500px');

});
</script>

</body>
</html>