<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Welcome to Jobsperak Portal</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection" />
</head>

<body>



	<header id="header">

    <div class="center">
       <div id="logo" class="left" style="margin:10px 0px 0px 0px;">
          <a href="index.php" title="Home">
            <img src="../images/logo.png" alt="logo.png" border="0">
          </a>
          
        </div><!-- /left -->

      <div class="right">
            <?php include 'session_checking_panel.php'; ?>
        </div>
      <div class="clear"></div>
    </div><!-- .center -->
    
    <?php include("main_menu.php"); ?>
  </header><!-- #header-->

	<div id="wrapper">
	
	<section id="middle">

<div>
        <br>
        <div id="content_full" style="text-align: center;">
          <h1 class="bebasTitle">
            Opss! Same we got mis page. <a href="http://beta.talentlounge.my">Home</a>
          </h1>
        </div>
      </div>

		  <div id="content" style="display:none">
<h2>Login Failed</h2>
<div class="master_details">
  <p><a href="login.php">Log In Again</a></p>
</div>

          </div><!-- #content-->
			<!-- aside -->
			<!-- #sideRight -->

		

	</section><!-- #middle-->

	</div><!-- #wrapper-->

	<footer id="footer">
		<div class="center">
			<?php include("footer.php"); ?>
		</div><!-- .center -->
	</footer><!-- #footer -->



</body>
</html>