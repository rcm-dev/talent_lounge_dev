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

<div id="content" class="<?php if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>">

	
<div id="contentContainer" >


		<div class="heading">
			<h1 class="heading_title">Career Fair</h1>
		</div>


<link rel="stylesheet" href="css/slidorion1.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/jquery.easing.js"></script>
<script src="js/jquery.slidorion.min.js"></script>


<div class="left cnscontainerPlain" style="margin-top:20px; width:700px !important;">
<div id="slidorion" >
	<div id="slider">
		<div class="slide"><img src="images/3.jpg" width="300" height="400"></div>
		<div class="slide"><img src="images/1.jpg" width="300" height="400"></div>
		<div class="slide"><img src="images/2.jpg" width="300" height="400"></div>
	</div>

	<div id="accordion">
		<div class="link-header"><strong> Job Fair  2013</strong></div>
		<div class="link-content">
		<p>&nbsp;</p>
		<p>With an objective to complement JobsDB online interactive recruitment network as well as the government's initiative to tackle the issue on unemployment, it has provided students with information on relevant courses available nationwide, aiding them in selecting right courses to pursue.</p>	
		<!-- content -->
	  </div>
		<div class="link-header"><strong>Spring Career Fair 2013</strong></div>
		<div class="link-content">
			 <p>It looks like this Sunday's BBQ is going to be one huge party! With our major partner Twilight Actiongirl filling the Sunday evening atmosphere with tunes of reminisce, street wear designs by Bazarro, Unity and Loaded, and also joining us a quaint corner featuring vinyl records for sale. <br>
			 </p>
			 <p>With such an amazing line-up, we're predicting a full house this Sunday. So come join in the fun from 5-10PM this 24 February. It's the perfect end to the weekend by gathering friends and family for a laid-back evening of catching up.</p>
			 <!-- content -->
	  </div>
		<div class="link-header"><strong>Career and Summer 2013</strong></div>
		<div class="link-content">
		
      <p>	<!-- content -->
        </p></div>
	</div>
</div> 
<!-- comment of slidorian -->

</div> 
<!-- end of ContentContainer -->


	<?php include 'sidebar_exhibition.php'; ?>
			


			<div class="clear"></div>
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