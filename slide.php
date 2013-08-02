<?php  


include 'header.php';
include 'db/db-connect.php';
?>

<style>
#slidorion{
	margin: 30px;
	width: 600px;
	height: 600px;
}

</style>

<?php include 'quickpost.php'; ?>

<body>
<!-- background="img/band.jpg" -->

<div id="contentContainer" >
<div class="heading">
			<h1 class="heading_title bebasTitle">Performances &amp; Live Shows</h1>
		</div>


<link rel="stylesheet" href="css/slidorion.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/jquery.easing.js"></script>
<script src="js/jquery.slidorion.min.js"></script>



<div id="slidorion" >
	<div id="slider">
		<div class="slide"><img src="images/advertise/image_a.jpg" width="482" height="395" align="middle"></div>
		<div class="slide"><img src="images/advertise/image_b.jpg" width="458" height="346" align="middle"></div>
		<div class="slide"><img src="images/advertise/image_e.jpg" width="475" height="356" align="middle"></div>
	</div>

	<div id="accordion">
		<div class="link-header"><strong>#BeOutThere - Grimes contest!</strong></div>
		<div class="link-content">
		<p>We're gonna have some FUN at Upfront presents Grimes this 12 March!  Our team is setting up a photo wall for you guys to pose at. All you gotta do is come dressed in your fiercest, craziest, most creative outfit. Drop by the photo wall (open from 6.30pm - 8pm on event day) and have your picture taken.</p>
		<p>We'll be picking 3 winners and will be rewarding them with exclusive merchandise and some mystery swag. So remember to dress up, have fun and #BeOutThere!</p>
		<p>*Open to ticketholders only, sorry!</p>	
		<!-- content -->
	  </div>
		<div class="link-header"><strong>BBQ Sundays</strong></div>
		<div class="link-content">
			 <p>It looks like this Sunday's BBQ is going to be one huge party! With our major partner Twilight Actiongirl filling the Sunday evening atmosphere with tunes of reminisce, street wear designs by Bazarro, Unity and Loaded, and also joining us a quaint corner featuring vinyl records for sale. <br>
			 </p>
			 <p>With such an amazing line-up, we're predicting a full house this Sunday. So come join in the fun from 5-10PM this 24 February. It's the perfect end to the weekend by gathering friends and family for a laid-back evening of catching up.</p>
			 <!-- content -->
	  </div>
		<div class="link-header"><strong>Who's Next</strong></div>
		<div class="link-content">
			<p>
                                        <strong>We've already confirmed our next Upfront act for April. They're a dream pop band from Sweden. Any guesses who it may be?</strong></p>
			<strong><!-- content -->
        </strong></div>
	</div>
</div> 
<!-- comment of slidorian -->

</div> 
<!-- end of ContentContainer -->



</body>
<!-- performance application form -->


<script>
$(document).ready(function(){
	$('#slidorion').slidorion({
		speed: 1000,
		interval: 4000,
		effect: 'slideLeft'
	});
});


</script>