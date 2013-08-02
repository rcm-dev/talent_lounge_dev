<?php  


include 'header.php';
include 'db/db-connect.php';


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">Connect &amp; Share</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div class="post-status none">
						
					<form action="#" method="get" accept-charset="utf-8">

						<div>
							<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
						</div>	

					</form><!-- post-status-form -->
					
				</div><!-- /.post-status -->

				

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<div id="loadstream">
						
					</div>
				</div>

				<!-- /CHange Action -->

			</div>


		</div><!-- /orange left -->

		<!-- sidebar-connect n share -->

		<?php include 'sidebar-social.php'; ?>

		<!-- /sidebar-connect n share -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="loadstream" data-text="Next" class="custom">
    <h4>Friend Stream</h4>
    <p>Browse stream from your network / friend</p>
  </li>
  <li data-id="yaction01" data-text="Next">
    <h4>Submenu action</h4>
    <p>Browse friend, find network, Build a group</p>
  </li>
  <li data-id="call-learn" data-text="Close">
    <h4>Browse Article</h4>
    <p>Looking business article? all inside this module.</p>
  </li>
</ol>

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->

<?php 

// var tours
$section = 2;
include 'check_tours.php'; 

?>

<script type="text/javascript">
$(document).ready(function(){

	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
	/* /current email */
	

	// get tour status
	var tour_status = $('input#tour_status').val();

	// if status run start tours
	if (tour_status == 'run') {
		// $('#tallChart').visualize();
		/*start joyride*/
		$(window).load(function() {
			$(this).joyride({
				'tipLocation': 'bottom',
		      		'scrollSpeed': 300,
		      		'nextButton': true,
		      		'tipAnimation': 'fade',
		      		'tipAnimationFadeSpeed': 500,
		      		'cookieMonster': false,
		      		'inline': true,
		      		'tipContent': '#joyRideTipContent',
		      		'postRideCallback': function(){
		      			disableTour();
		      			$("html, body").animate({ scrollTop: 0 }, "slow");
		      		}      
			});
		});
	};
	console.log(tour_status);

	// function disable tour
	function disableTour() {
		var disableTour = '<?php include 'disable_tours.php'; ?>';
		return disableTour;
	}
	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});


	$('#editProfile').fancybox({
		'titlePosition'		: 'inside',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none'
	});

	$('label').css('display', 'block');


	/*$('.network-left').hover(function(){
		
		$('#user-settings').fadeIn();

	}, function(){
		
		$('#user-settings').fadeOut();

	});*/

	/*$('#tabmenu').find('> a#nstream').addClass('tabuiactive');

	$('#call-friends').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#psetting').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#nstream').click(function(){
		
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-message').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#s-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});*/


	/* Status update */
	$('#btnstatusupdate').click(function(){
		
		var value = $('#statusupdate').val();

		if (value == "") {
			
			alert('What\'s going on..?');

		} else {


			var statusupdate = $('#statusupdate').val();
			var currID 		 = $('#currID').val();
			var ajax_load    = "<img src='images/ajax-loader.gif' alt='loading..' />";

			dataString = 'statusupdate='+statusupdate+'&currID='+currID;

			
			/* post ajax */
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-statusupdate.php",
				data: dataString,
				cache: false,

				success: function(){


					// var url 		= 'network.php?nid='+viewnetwork;
					// var urlclass	= url+' .nw-contribbute-'+currentWallID;

					$('#statusupdate').val("");
					$('#connect-container #loadstream').html(ajax_load).load('ajax/ajax-stream.php?id='+currID);
					// $('.nw-contribbute-'+currentWallID).load(urlclass);
					// console.log(urlclass);
					console.log(dataString);
				}

			});

		}

		return false;

	});


	// load default stream
	var ajax_load    = "<img src='images/ajax-loader.gif' alt='loading..' />";
	var currID 		 = $('#currID').val();
	$('#loadstream').html(ajax_load).load('ajax/ajax-stream.php?id='+currID);

	//$('body').anchorCloud();




});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>