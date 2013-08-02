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
			<h1 class="heading_title bebasTitle">My Dashboard</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div>
						
					<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
					
				</div><!-- /.post-status -->

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					
				</div>

				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div id="quickToolDashboard" class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong id="yourAction" class="heading_title_two bebasTitle">Your Actions</strong>
			<div class="recomAction">
				<a href="employerDashboard2.php" title="Dashboard" class="dashboard_color">Dashboard</a>
				<a href="job_posting.php" title="" class="bell_color">Job Posting</a>
				<a href="talent_assessment.php" title="" class="clipboard_color" >Talent Assessments</a>
				<a href="talent_scope.php" title="Invent &amp; Influence" class="medal_color" id="s-idea" rel="<?php echo $usr_id; ?>">Talent Scope</a>
				<a href="interview_roo.php" title="Showcase" class="ballon_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Interview Room Booking</a>
				<a href="pool.php" title="Showcase" class="document-list_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Pool of Cool</a>
				<a href="employerBrowseResume.php" title="Showcase" class="magnifier_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Browse &amp; Filtering</a>
				<a href="employerProfileEdit.php" title="Showcase" class="book_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Company Profiling</a>
				<a href="directory_system.php" title="Showcase" class="map_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Directory System </a>

				<div id="listStoreName">
					<?php  

						$listStore = "SELECT * FROM mj_market_store WHERE mms_usr_id_fk = '$usr_id'";
						$resultStore = mysql_query($listStore);
						$numrow = mysql_num_rows($resultStore);
						

						if ($numrow != 0) {

					?>
					<br><strong class="store_label_color">My Store</strong>
					<ul id="listedStore">
							<?php while($rowObject = mysql_fetch_object($resultStore)){ ?>
								<li><a href="store-details.php?sid=<?php echo $rowObject->mms_id; ?>" title="">
									<?php echo $rowObject->mms_name; ?>
								</a></li>
							<?php } ?>

						<?php }
						?>
					</ul><!-- /listedStore -->
				</div><!-- /listStoreName -->
			</div><!-- / -->
			<br><br>
			<div style="display:none">
				<strong id="mojoProcess" class="heading_title_two">How-to Manual</strong><br>
				<span>Guides for Entreprenuers</span>
				<br><br>
				<ol style="margin-left:15px; font-size: 11px">
					<?php  

					// SQL Page
					//$q_page    = "SELECT * FROM mj_pages WHERE page_type = 'Listing'";
					//$exec_page = mysql_query($q_page);

					// Loop
					//while ($obj_page = mysql_fetch_object($exec_page)) {
					
					// assign object
					//$curr_page_id = $obj_page->page_id;
					//$curr_page_title = urlencode($obj_page->page_title);
					//$curr_page_Btitle = $obj_page->page_title;
					
					?>
					<!-- <li><a href="<?php //echo $curr_page_id.'-'.$curr_page_title; ?>.html" target="_blank" title="<?php //echo $curr_page_Btitle; ?>"><?php //echo ucwords($curr_page_Btitle); ?></a></li> -->
					<?php //} ?>
<li><a href="how-to-new-post.php" target="_blank">How-to submit a new post</a></li>
				</ol><!-- / -->
			</div><!-- / -->
		</div><!-- /orange right -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->


<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="user-panel" data-text="Next" class="custom">
    <h4>Take 1 minute to start</h4>
    <p>This is your personal stuff. Message, Notification and setting</p>
  </li>
  <li data-id="navContainer" data-text="Next">
    <h4>Main Section</h4>
    <p>Main navigation to playaround with mojo</p>
  </li>
  <li data-id="qPs" data-text="Next">
    <h4>Status Update</h4>
    <p>a quick post status update here.</p>
  </li>
  <li data-id="loadContainer" data-text="Next">
    <h4>Entreprenur Dashboard</h4>
    <p>Personal summary about you at mojo.</p>
  </li>
  <li data-id="yourAction" data-text="Next">
    <h4>Managing your activity</h4>
    <p>Create new, Edit content, Contribute, and Share with mojo world.</p>
  </li>
  <li data-id="mojoProcess" data-text="Close">
    <h4>Learn Each Core Modules</h4>
    <p>The process of each core modules for mojo site. Make you clearable about the process, function and usability to your needs.</p>
  </li>
</ol>


<?php 

// var tours
$section = 5;
include 'check_tours.php'; 

?>

<script type="text/javascript">
$(document).ready(function(){

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


	// fancybox
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

	$('#tabmenu').find('> a#nstream').addClass('tabuiactive');

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

	});


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



	/*dashboard summary*/
	 $("#usual1 ul").idTabs();


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

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>