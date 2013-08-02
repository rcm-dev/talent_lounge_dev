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
	<link rel="stylesheet" type="text/css" href="css/buttons.css">
	<!-- end-css -->

	<!-- js -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<!-- js -->

	<style type="text/css">

	label {
		display: block;
	}
	body {
		background-color: #f2f2f2;
	}

	</style>
</head>
<body>
					<div style="padding: 5px; background: none; border-bottom:0px solid #ddd;">
						<strong style="color:#291618; font-size:20px;">Get Connected</strong>
					</div>

					<div id="login-container" style="padding:10px; border-bottom:-px solid #ddd; background-color: none;">
						<form action="checklogin.php" method="post">

							<div>
								<div id="loginstatus" class="success none">Perfect</div>
								<div id="loginstatus" class="error none">Fill up the form</div>
								<div id="loginLogin" class="none"><img src="images/ajax-loader.gif" /></div>
								<label>Email</label>
								<input type="text" name="email" id="email" class="title" placeholder="your@email.com" />

								<label>Password</label>
								<input type="password" name="password" id="password" class="title" placeholder="password" /><br><br>
							</div>	

							<input type="submit" value="Log In" id="mojo-login" name="mojo-login" class="button green" />
							<a href="forgot-password.php" style="margin-left:10px;" class="none">forgot password</a>

						</form><br><br>
					</div>

<!-- javascript -->
<script type="text/javascript">
$(document).ready(function(){
	
	// validation
	jQuery("#email").validate({
        expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
        message: "Should be a valid Email id"
    });

    jQuery("#password").validate({
        expression: "if (VAL.length > 5 && VAL) return true; else return false;",
        message: "Please enter a valid Password"
    });

    /* min hwidth */
	$('body').css('min-width','200px');
    

});

</script>
</body>
</html>