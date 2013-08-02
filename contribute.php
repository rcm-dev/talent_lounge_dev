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
			<h1 class="heading_title bebasTitle">Your Contribution</h1>
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
					<div id="loadContainer">
						<strong class="dashboard_color">Dashboard Summaries</strong>
						<div id="usual1" class="usual" style="margin-top:20px"> 
						  <ul> 
						    <li><a href="#tab1" class="selected">Buy &amp; Sell Goods</a></li> 
						    <li><a href="#tab2">Invent &amp; Influence</a></li> 
						    <li><a href="#tab3">Portfolio Showcase</a></li> 
						  </ul> 
						  <div id="tab1" style="display: block;">
						  	
						  	<div style="text-align:center; margin-top:40px" class="summary">
						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalMarketUpload FROM mj_market_post WHERE mrket_usr_id_fk = '$usr_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style=" float:left; border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalMarketUpload; ?></strong></h1>
						  			<small>Ads uploaded</small>
						  		</section><!-- /totalUpload -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalMarketUpload FROM mj_market_post WHERE mrket_usr_id_fk = '$usr_id' AND mrket_post_published = 1");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalMarketUpload; ?></strong></h1>
						  			<small>Published</small>
						  		</section><!-- total published -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalMarketUpload FROM mj_market_post WHERE mrket_usr_id_fk = '$usr_id' AND mrket_post_published = 0");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalMarketUpload; ?></strong></h1>
						  			<small>UnPublished</small>
						  		</section><!-- totalUnPublished -->
						  		<div class="clear"></div>	
						  	</div>

						  	<!-- validate data -->
						  	<table id="tallChart" class="none">
								<caption>Summary Your Product Visitor Counter</caption>
								<thead>
									<tr>
										<td></td>
										<th scope="col">Visitor</th>
									</tr>
								</thead>
								<tbody>
									<?php  

									// ==================================================================
									//
									// Counter each Product Submit by User
									//
									// ------------------------------------------------------------------
									
									$CounTer = "SELECT
											  mj_market_post.mrket_post_title,
											  mj_market_post.market_view
											From
											  mj_market_post
											Where
											  mj_market_post.mrket_usr_id_fk = '$usr_id' And
											  mj_market_post.mrket_post_published = 1";

									$resultCounter = mysql_query($CounTer);


										while ($rowCounter = mysql_fetch_object($resultCounter)) {
									
									?>
									<tr>
										<th scope="row"><?php echo $rowCounter->mrket_post_title; ?></th>
										<td><?php echo $rowCounter->market_view; ?></td>
									</tr>	
									<?php  
										}
									?>							
								</tbody>
							</table>
						  	<!-- /validate data -->
						  </div> 
						  <div id="tab2" style="display: none; ">
						  	<div style="text-align:center; margin-top:40px" class="summary">

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalSubmission FROM mj_idea_post WHERE id_usr_id_fk = '$usr_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style=" float:left; border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalSubmission; ?></strong></h1>
						  			<small>Submission(s)</small>
						  		</section><!-- /totalUpload -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalSubmission FROM mj_idea_post WHERE id_usr_id_fk = '$usr_id' AND id_post_published = 1");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalSubmission; ?></strong></h1>
						  			<small>Approved</small>
						  		</section><!-- total published -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalSubmission FROM mj_idea_post WHERE id_usr_id_fk = '$usr_id' AND id_post_published = 0");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalSubmission; ?></strong></h1>
						  			<small>Waiting for approval</small>
						  		</section><!-- totalUnPublished -->
						  		<div class="clear"></div>	
						  	</div>
						  </div> 
						  <div id="tab3" style="display: none; ">
						  	<div style="text-align:center; margin-top:40px" class="summary">

						  		<strong style="color:#aaa;">Total Expenditures</strong>

						  		<div id="totalSpending" class="">
						  			<?php 


						  			// checking
						  			$sqlCheckingPledge = "SELECT * FROM mj_fund_pledged WHERE fund_usr_id_fk = '$usr_id'";
						  			$checkingResult = mysql_query($sqlCheckingPledge);
						  			$numrowChecking = mysql_num_rows($checkingResult);

						  			if ($numrowChecking == 0) {
						  				echo 'You dont have any contribution yet';
						  			} else {

						  			// ==================================================================
						  			//
						  			// Display total spending
						  			//
						  			// ------------------------------------------------------------------
						  			

						  			$sqlTotalSpending = "SELECT SUM(fund_money) AS TotalPledge FROM mj_fund_pledged WHERE fund_usr_id_fk = '$usr_id'";
						  			$resultTotalSpending = mysql_query($sqlTotalSpending);
						  			$rowobjectTotalSpending = mysql_fetch_object($resultTotalSpending);

						  			$totalCurrSPending = $rowobjectTotalSpending->TotalPledge;


						  			// ==================================================================
						  			//
						  			// Get total spending for failed project
						  			//
						  			// ------------------------------------------------------------------
						  			
						  			$sqlFailedSpending = "SELECT
									  Sum(mj_fund_pledged.fund_money) As totalFailedSpending
									From
									  mj_fund_post Inner Join
									  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
									Where
									  mj_fund_pledged.fund_usr_id_fk = '$usr_id' And
									  mj_fund_post.fund_post_failed = 1";
						  			$resultFailedSpending = mysql_query($sqlFailedSpending);
						  			$rowObjectFailedSpending = mysql_fetch_object($resultFailedSpending);

						  			$totalCurrFailedSpending = $rowObjectFailedSpending->totalFailedSpending;

						  			$totalUpSpending = $totalCurrSPending - $totalCurrFailedSpending;


						  			?>
						  			<strong><h4><?php echo number_format($rowobjectTotalSpending->TotalPledge); ?> - <?php echo number_format($totalCurrFailedSpending); ?></h4>
						  				<h1 style="font-size:50px; font-weight:bold; color:green"><?php echo number_format($totalUpSpending); ?></h1>
						  			</strong>

						  			
						  		</div><!-- /totalSpending -->
						  		<div id="" class="">
						  			<strong style="color:#aaa;">Contributed Showcase</strong>
						  			<?php 

						  			// ==================================================================
						  			//
						  			// Display total spending
						  			//
						  			// ------------------------------------------------------------------
						  			

						  			$sqlProject = "SELECT
									  mj_fund_pledged.fund_money As fMoney,
									  mj_fund_post.fund_post_title fTitle,
									  mj_fund_post.fund_post_id fID,
									  mj_fund_pledged.fund_usr_id_fk
									From
									  mj_fund_post Inner Join
									  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
									Where
									  mj_fund_pledged.fund_usr_id_fk = '$usr_id' And
									  mj_fund_post.fund_post_failed = 0 And
									  mj_fund_post.fund_post_success = 0";
						  			$resultProject = mysql_query($sqlProject);
						  			$numrowResultProject = mysql_num_rows($resultProject);

						  			if ($numrowResultProject == 0) {
						  				echo '<br/><br/>There\'s no current project you has been spend.';
						  			}
						  			else {
						  			

						  			// fetch data
						  			echo '<br/><br/><table style="text-align:left;" width="580px">';
						  			while ($rowProject = mysql_fetch_object($resultProject)) {
						  			?>
						  			
						  			<tr>
						  			<td><?php echo $rowProject->fTitle;?></td>
						  			<td><strong style="color:green"><?php echo number_format($rowProject->fMoney);?></strong></td>
						  			<td><a href="funding-details.php?id=<?php echo $rowProject->fID;?>" title="View Project <?php echo $rowProject->fTitle;?>">View</a></td>
						  			</tr>

						  			<?php 
						  			} // while

						  			echo '</table>';

						  			} // else

						  			?>
						  			<?php 
						  				} // else display result
						  			?>
						  			<div class="clear"></div>
						  		</div><!-- /spending list -->


						  		<div id="projectSuccess" class="">
						  			<strong style="color:#aaa;">Successful Showcase</strong>
						  			<?php

						  			// ==================================================================
						  			//
						  			// Display total spending in Success project
						  			//
						  			// ------------------------------------------------------------------
						  			

						  			$sqlProjectSuccess = "SELECT
									  mj_fund_pledged.fund_money As fMoney,
									  mj_fund_post.fund_post_title fTitle,
									  mj_fund_post.fund_post_id fID,
									  mj_fund_pledged.fund_usr_id_fk
									From
									  mj_fund_post Inner Join
									  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
									Where
									  mj_fund_pledged.fund_usr_id_fk = '$usr_id' And
  									  mj_fund_post.fund_post_success = 1";

						  			$resultProjectSuccess = mysql_query($sqlProjectSuccess);
						  			$resultSuccessNumRow = mysql_num_rows($resultProjectSuccess);

						  			if ($resultSuccessNumRow == NULL) {
						  				echo '<br/><br/>There\'s no Success project that you has been spending';
						  			}
						  			else {


						  			echo '<br/><br/><table style="text-align:left;" width="580px">';
						  			while ($rowProjectSuccess = mysql_fetch_object($resultProjectSuccess)) {
						  			?>

						  			<tr>
						  			<td width="330"><?php echo $rowProjectSuccess->fTitle;?></td>
						  			<td><strong style="color:green"><?php echo number_format($rowProjectSuccess->fMoney);?></strong></td>
						  			<td><a href="success-funding-details.php?id=<?php echo $rowProjectSuccess->fID;?>" title="View Project <?php echo $rowProjectSuccess->fTitle;?>">View</a></td>
						  			</tr>

						  			
						  			<?php  
						  			} // while
						  			echo '</table>';

							  		} // esle
						  			?>
						  			<div class="clear"></div>
						  		</div><!-- /#projectSuccess --><br><br>


						  		<div id="projectFailed" class="">
						  			<strong style="color:#aaa;">Failed Showcase</strong>
						  			<?php

						  			// ==================================================================
						  			//
						  			// Display total spending in failed project
						  			//
						  			// ------------------------------------------------------------------
						  			

						  			$sqlProjectFailed = "SELECT
									  mj_fund_pledged.fund_money As fMoney,
									  mj_fund_post.fund_post_title fTitle,
									  mj_fund_post.fund_post_id fID,
									  mj_fund_pledged.fund_usr_id_fk
									From
									  mj_fund_post Inner Join
									  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
									Where
									  mj_fund_pledged.fund_usr_id_fk = '$usr_id' And
  									  mj_fund_post.fund_post_failed = 1";

						  			$resultProjectFailed = mysql_query($sqlProjectFailed);
						  			$resultFailedNumRow = mysql_num_rows($resultProjectFailed);

						  			if ($resultFailedNumRow == NULL) {
						  				echo '<br/><br/>No failed showcase';
						  			}
						  			else {


						  			echo '<br/><br/><table style="text-align:left;" width="580px">';
						  			while ($rowProjectFailed = mysql_fetch_object($resultProjectFailed)) {
						  			?>

						  			<tr>
						  			<td width="330"><?php echo $rowProjectFailed->fTitle;?></td>
						  			<td><strong style="color:red">RM<?php echo number_format($rowProjectFailed->fMoney);?></strong></td>
						  			<td><a href="failed-funding-details.php?id=<?php echo $rowProjectFailed->fID;?>" title="View Project <?php echo $rowProjectFailed->fTitle;?>">View</a></td>
						  			</tr>

						  			
						  			<?php  
						  			} // while
						  			echo '</table>';

							  		} // esle
						  			?>
						  			<div class="clear"></div>
						  		</div><!-- /projectFailed --><br><br>

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalProject FROM mj_fund_post WHERE fund_usr_id_fk = '$usr_id'");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style=" float:left; border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalProject; ?></strong></h1>
						  			<small>Project Submitted</small>
						  		</section><!-- /totalUpload -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalProject FROM mj_fund_post WHERE fund_usr_id_fk = '$usr_id' AND fund_post_published = 1");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalProject; ?></strong></h1>
						  			<small>Online Projects</small>
						  		</section><!-- total published -->

						  		<?php  

						  		// ==================================================================
						  		//
						  		// Total Upload
						  		//
						  		// ------------------------------------------------------------------
						  		$sqlTotalUpload = mysql_query("SELECT COUNT(*) As totalProject FROM mj_fund_post WHERE fund_usr_id_fk = '$usr_id' AND fund_post_published = 0");
						  		$rowTotalUpload = mysql_fetch_object($sqlTotalUpload);
						  		?>
						  		<section class="left" style="border:0px solid red;">
						  			<h1><strong><?php echo $rowTotalUpload->totalProject; ?></strong></h1>
						  			<small>Pending projects</small>
						  		</section><!-- totalUnPublished -->
						  		<div class="clear"></div>	
						  	</div>
						  </div> 
						</div> 
					</div>
				</div>

				<!-- /CHange Action -->


			</div>


		</div><!-- /orange left -->

		<div id="quickToolDashboard" class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong id="yourAction" class="heading_title_two bebasTitle">Your Actions</strong>
			<?php  

				/****************************
				 *
				 * Record Set for CheckJSorEmp 
				 * MySQL Info 
				 * Table Used CheckJSorEmp
				 *
				 ***************************/
				
				$query_rsCheckJSorEmp = "SELECT * FROM mj_users WHERE users_id = " . $usr_id;
				$result_rsCheckJSorEmp = mysql_query($query_rsCheckJSorEmp);
				$row_rsCheckJSorEmp = mysql_fetch_object($result_rsCheckJSorEmp);

				?>
			<div class="recomAction">
				<a href="contribute.php" title="Dashboard" class="dashboard_color">Dashboard</a>
				<a href="recruitment/sessionGateway.php" title="Recruitment" class="dashboard_recruit" style="display:none">Recruitment</a>
				<a href="#" title="Insert Free Ads" class="store_market_stall_color" id="insert-free-ads" rel="<?php echo $usr_id; ?>">Buy &amp; Sell Goods</a>
				<a href="#" title="Invent &amp; Influence" class="light_bulb_color" style="display:none" id="s-idea" rel="<?php echo $usr_id; ?>">Idea Section</a>
				<?php 
				
				if ($row_rsCheckJSorEmp->users_type == 2) { ?>
				<a href="#" title="Freelance" class="light_bulb_color" id="s-freelance" rel="<?php echo $usr_id; ?>">Freelance</a>
				<?php 

				}

				?>
				<?php 
				
				if ($row_rsCheckJSorEmp->users_type == 1) { ?>
				<a href="#" title="Showcase" class="zone_money_color" id="s-project" rel="<?php echo $usr_id; ?>" data-name="<?php echo $usr_name; ?>">Showcase</a>
				<?php 

				}

				?>
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