<?php  

/**
 * File network view
 * get network id
 * and view on screen
 */
//include 'header-plain.php';
//include 'db/db-connect.php';
//include 'class/time.php';



$usr_id = $_GET['currid'];


// ==================================================================
//
// SQL select users
//
// ------------------------------------------------------------------

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);



// ==================================================================
//
// HTML VIEW
//
// ------------------------------------------------------------------

?>


<div id="mojo-container">
	
	<div class="container_24">
		<div class="home_container">
			<div class="mj-network-home" style="padding:10px;">
				
				<?php

// ==================================================================
//
// get network id at url and sql statement
//
// ------------------------------------------------------------------

$viewnetwork = $_GET['nid'];


$selectMemberOfThisGroup = "SELECT
  mj_network.mn_name As netWorkName,
  mj_network_relation.mn_id_fk As NetID,
  mj_users.usr_name As memberName,
   mj_users.user_pic As memberPic,
   mj_users.usr_id As viewUserID
From
  mj_network Inner Join
  mj_network_relation On mj_network_relation.mn_id_fk = mj_network.mn_id
  Inner Join
  mj_users On mj_network_relation.usr_id_fk = mj_users.usr_id
Where
  mj_network_relation.mn_id_fk = '$viewnetwork'
ORDER BY RAND()";
$resultSelectMember = mysql_query($selectMemberOfThisGroup);
//$rowResultSelect	=	mysql_fetch_object($resultSelectMember);



// ==================================================================
//
// sql network name and creator name
//
// ------------------------------------------------------------------

$displayName = "SELECT
  mj_network.mn_name As NetworkName,
  mj_network.mn_id,
  mj_users.usr_name As CreatorName,
  mj_users.usr_id As creatorId,
  mj_network.mn_desc As networkDesc,
  mj_users.user_pic As CreatorPic,
  mj_network.mn_date_created As networkCreated
From
  mj_network Inner Join
  mj_users On mj_network.mn_created_by = mj_users.usr_id
Where
  mj_network.mn_id = '$viewnetwork'";
$resulDisplayName = mysql_query($displayName);
$rowDisplayName	  = mysql_fetch_object($resulDisplayName);
 
?>

			<div id="groupWrapper">

				<div style="padding-bottom:30px">
					
					
					<div id="headingContainer" class="">
						<div class="l"><h2><?php echo $rowDisplayName->NetworkName; ?></h2></div>
						<div class="r">

							<?php if($rowDisplayName->creatorId == $usr_id) { ?>
							<a href="editGroup" title="Edit">Edit
							</a>
							<?php } ?>

						</div>
						<div class="clear"></div>
					</div><!-- /headingContainer -->

					<p><strong>Group Description</strong></p>
					<p>
					<?php  

					if ($rowDisplayName->networkDesc == '') {
						echo "no description yet..";
					} else {
						echo $rowDisplayName->networkDesc;
					}

					?></p>

				</div>

				<div id="networkMember">
					
					<div>
						<div class="left"><strong>Contributor</strong></div>
						<div class="right">
							<a href="#inviteF" id="invite">
								Invite Contributor</a>
						</div>
						<div class="clear"></div>
					</div>

					<div id="userFriends" class="none">
						<div id="inviteF" style="width: 523px; height: 400px; overflow: auto;">
							<strong>Invite Friend(s)</strong>

							<?php  
							
							// ==================================================================
							//
							// sql select friends list to invite into network
							//
							// ------------------------------------------------------------------
							
							 $qFriend = "SELECT
							  mj_users.usr_name As friendName,
							  mj_users.usr_id As fID,
							  mj_users.user_pic As usrPicture,
							  mj_users.usr_workat As CompanyName 
							From
							  mj_usr_network Inner Join
							  mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
							Where
							  mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
							  mj_usr_network.usr_network_friend_usr_id_fk != '$usr_id'";

							$rqFriend = mysql_query($qFriend);
							$numrowqFriend = mysql_num_rows($rqFriend);

							if ($numrowqFriend == 0) {
								
								echo "You dont have any friends yet.";

							} else {

								echo '<ul class="userFriends none">';

								while ($rowqFriend = mysql_fetch_object($rqFriend)) { 

									$FriendID = $rowqFriend->fID;				

									$qAlreadyInsideTheNetwork = "SELECT
									  mj_network_relation.*,
									  mj_network_relation.mn_id_fk As networkID,
									  mj_network_relation.usr_id_fk As userIDAvailable
									From
									  mj_network_relation
									Where
									  mj_network_relation.mn_id_fk = '$viewnetwork' And
									  mj_network_relation.usr_id_fk = '$FriendID'";

									$rqAlreadyInsideTheNetwork = mysql_query($qAlreadyInsideTheNetwork);
									$rowqAlreadyInsideTheNetwork = mysql_num_rows($rqAlreadyInsideTheNetwork);

									

								?>
									
								<li>
									<div class="namePic">
										<div class="profile-pic48" style="background-image: url('<?php echo $rowqFriend->usrPicture; ?>');">
											
										</div>
									</div>
									<div class="nameDesc"><strong><?php echo ucwords($rowqFriend->friendName); ?></strong>
									<br/>
									<span style="color:#aaa"><?php echo ucwords($rowqFriend->CompanyName); ?></span>
									<br/>
									
									<form method="post" class="forminvite" id="<?php echo $rowqFriend->fID; ?>">
										<input type="hidden" name="fid" class="fid" value="<?php echo $rowqFriend->fID; ?>"  />

										<input type="hidden" name="vid" class="vid" value="<?php echo $viewnetwork; ?>"  />

										<?php if ($rowqAlreadyInsideTheNetwork != 1) { ?>

										<input type="submit" data-fid="<?php echo $rowqFriend->fID; ?>" data-vid="<?php echo $viewnetwork; ?>" class="inviteJoin" value="Invite" />
											

										<?php } else { ?>

										Joined

										<?php } ?>
									</form>

									</div>
									<div class="clear"></div>
								</li>

							<?php

								}

								echo '</ul>';
								
							}

							?>
						</div>
					</div>

					<div class="group-member" style="border-bottom:1px dotted #e1e1e1; margin-top: 10px;">
					<ul id="picHoriUI">
						<?php while ($rowResultSelect = mysql_fetch_object($resultSelectMember)) { ?>
							<li>
								<a href="users.php?uid=<?php echo $rowResultSelect->viewUserID; ?>">
								<div class="profile-pic48" style="background-image: url('<?php echo $rowResultSelect->memberPic; ?>')">
									
								</div>
								</a>
							</li>
						<?php } ?>
						<div class="clear"></div>
					</ul>
					</div>
				</div><!-- /networkMember -->

				<div id="authorContainer">
					<div class="profile-pic48 l" style="background-image: url('<?php echo $rowDisplayName->CreatorPic; ?>');">
						
					</div><!-- /profile-pic48 -->

					<div class="l">
						<h4 class="title">Created by <?php echo ucwords($rowDisplayName->CreatorName); ?></h4>
						<span><?php echo $rowDisplayName->networkCreated; ?></span>
					</div><!-- /ll -->
					<div class="clear"></div>
				</div>

				<div style="border-top:1px solid #ddd; background-color:#f1f1f1; padding: 4px; margin: 50px 0px 20px 0px; font-weight: bold">
					Discussion
				</div><!-- / -->

				<div style="width: 530px;">

					<form method="post">
					
					<input type="text" name="txtntwkwall" id="txtntwkwall" placeholder="Got News? Questions?" class="title" />
					<input type="submit" value="post" id="ntwkwallpost" name="ntwkwallpost" />
					<input type="hidden" name="viewnetwork" id="viewnetwork" value="<?php echo $viewnetwork; ?>" />
					<input type="hidden" name="currUserID" value="<?php echo $usr_id; ?>" id="currUserID" >
					</form>

					<div class="resultWallPost">
					<?php //include 'ajax/ajax-loadnetworkwall.php'; ?>

					<!-- Discussion -->

					<?php 

					//require '../db/db-connect.php';
					//require '../class/time.php';


					//$viewnetwork = $_GET['viewnetwork'];

					// Wall
					/**
					 * display network post
					 * by network id
					 * at network view
					 */


					$wallGroup = "SELECT
					  mj_network_wall.nw_id As CurrentWallIDPost,
					  mj_network_wall.nw_post_title As NetworkTitle,
					  mj_network_wall.nw_date_posted As PostDate,
					  mj_users.usr_name As postByName,
					  mj_network_wall.nw_ntwrk_group_id_fk,
					  mj_users.user_pic As posterImage,
					  mj_users.usr_id As postUsrID
					From
					  mj_network_wall Inner Join
					  mj_users On mj_network_wall.nw_posted_by = mj_users.usr_id
					Where
					  mj_network_wall.nw_ntwrk_group_id_fk = '$viewnetwork'
					Order By nw_date_posted DESC";

					$resultwallGroup = mysql_query($wallGroup);
					$rowWallGroup	 = mysql_num_rows($resultwallGroup);

					if ($rowWallGroup == 0) {
						
						echo "No Network post yet.";

					} else {

					echo '<ul class="nw-wall">';

					/* grab object table */
					while ($grabRowWallGroup = mysql_fetch_object($resultwallGroup)) {

					?>

						<li class="gap">
							<div class="nw-users">
							<a href="users.php?uid=<?php echo $grabRowWallGroup->postUsrID; ?>">
							<div class="profile-pic48" style="background-image:url('<?php echo $grabRowWallGroup->posterImage; ?>')">
							
							</div>
							</a>
							</div>
							<div class="nw-details">
							<a href="users.php?uid=<?php echo $grabRowWallGroup->postUsrID; ?>"><strong><?php echo $grabRowWallGroup->postByName; ?></strong></a><br/>
							<?php echo $grabRowWallGroup->NetworkTitle; ?>
								<div class="nw-misc">
									<?php echo $grabRowWallGroup->PostDate; ?>
									<?php //echo realtime($grabRowWallGroup->PostDate); ?>
									| <a href="#" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contribute">Contibute</a>
								</div>
								<div class="nw-contribbute-<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>">
									<ul class="nw-ui-new">
										<?php  
											$currentwallpostid = $grabRowWallGroup->CurrentWallIDPost;

											$displayCommentWallPost = "SELECT
											  mj_network_comment.nc_body As commentBody,
											  mj_users.usr_name As commentByName,
											  mj_network_comment.nc_wall_id_fk,
											  mj_network_comment.nc_date_posted As commentDate,
											  mj_users.usr_id As commentByNameID
											From
											  mj_network_comment Inner Join
											  mj_users On mj_network_comment.nc_comment_by = mj_users.usr_id
											Where
											  mj_network_comment.nc_wall_id_fk = '$currentwallpostid'";

											$resultDisplayWallPost  = mysql_query($displayCommentWallPost);

											$numrowcommentpost		= mysql_num_rows($resultDisplayWallPost);

											if ($numrowcommentpost == 0) {
												//echo '<p style="padding:4px;">No Comment yet.</p>';
											} else {
												
												while ($commentwallpostobject = mysql_fetch_object($resultDisplayWallPost)) {
													
													echo '<li>';
													echo '<div>';
													echo '<a href="users.php?uid='.$commentwallpostobject->commentByNameID.'">';
													echo '<strong>'.$commentwallpostobject->commentByName.'</strong>';
													echo '</a>';
													echo '&nbsp;';
													echo $commentwallpostobject->commentBody;
													echo '<br/>';
													echo '<span class="nw-misc">'.$commentwallpostobject->commentDate.'</span>';
													echo '</div>';
													echo '</li>';

													//echo $commentwallpostobject->commentDate;

												}

											}
										?>
									</ul>
									<div id="contributeMsg<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributeMsg">
										<form method="post">
										<!-- <input type="text" name="contributepost" id="contributepost<?php //echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:350px;" /> -->

										<textarea name="contributepost" id="contributepost<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:400px; height:20px;" placeholder="Write your idea..."></textarea>
										<br/>
										<input type="submit" name="submitcomment" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="submitcomment" />

										<input type="hidden" name="currentUserComment" id="currentUserComment<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="currentUserComment" value="<?php echo $usr_id; ?>" />
										<input type="hidden" name="currentWallID" id="currentWallID<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" value="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" />
										</form>	
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</li>	
						
					<?php 

							}
					?>
							
						
					<?php
						
						echo '</ul>';


						} 


					?>

					<!-- /Discussion -->

					</div>

				</div>


				<div class="clear"></div>

			</div>

			
		</div>
	</div>

</div>



<script type="text/javascript">
$(document).ready(function(){
	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});

	//$('#invite').fancybox();
	$('#invite').click(function(){

		$('#userFriends').slideToggle('slow');

		return false;

	});


	$('input.inviteJoin').live('click', function(){
		
		//ar value = $('a.inviteJoin').attr('href');

		var fid   = $(this).attr('data-fid');
		var vid   = $(this).attr('data-vid');

		var datainvite = 'fid='+fid+'&vid='+vid;

		alert('fid = ' + fid + '&vid=' + vid);

		$.ajax({

			url: 'ajax/ajax-joingroup.php',
			type: 'POST',
			data: datainvite,

			success: function(html){

				$('form.forminvite').append(html);
				console.log('change');
				console.log(datainvite);

			}

		});

		return false;

	});

	//var viewnetwork = $('#viewnetwork').val();
	//var url_to_load = 'ajax/ajax-loadnetworkwall.php?viewnetwork='+viewnetwork;

	//console.log(url_to_load);
	//$('.resultWallPost').load(url_to_load);



	$('#ntwkwallpost').click(function(){
		

		var networkWall = $('#txtntwkwall').val();

		if (networkWall == '') {
			
			alert('Enter Topic');

		} else {

			var networkWall = $('#txtntwkwall').val();
			var viewnetwork = $('#viewnetwork').val();
			var currUserID  = $('#currUserID').val();

			//console.log(networkWall + viewnetwork + currUserID);
			
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-networkwallpost.php",
				data: 'networkWall=' + networkWall + '&currUserID=' + currUserID + '&viewnetwork=' + viewnetwork,
				cache: false,

				success: function(){

					var url 		= 'network.php?nid='+viewnetwork+'&currUserID='+currUserID;
					var urlclass	= url+' .mj-network-home';

					$('#txtntwkwall').val("");
					$('.mj-network-home').load(urlclass);
					console.log(urlclass);	
				}

			});
		}

		return false;

	});

	console.log($('#currUserID').val());



	/* click and open comment network wall post */
	$('.contributeMsg').hide();

	$('.contribute').live('click', function(){
		
		var conID = $(this).attr('id');

		//alert('Clicked '+conID);

		$('#contributeMsg'+conID).toggle();
		$('#contributepost'+conID).focus();

		return false;

	});


	/* clicked btn submited */
	/*$('.submitcomment').click(function(){
			
		var submitcommentID = $(this).attr('id');
			
		alert(submitcommentID);

	});*/


	/* Tracking comment box*/
	$('.contributeMsg').hover(function(){
		
		var contributeMsgID = $(this).attr('id');

		console.log(contributeMsgID);

	}, function(){
		
		console.log('Out');

	});




	/* Submit Comment */
	$('.submitcomment').click(function(){
		
		var ID 					= $(this).attr("id");
		var contributepost		= $('#contributepost'+ID).val();
		var currentUserComment  = $('#currentUserComment'+ID).val();
		var currentWallID		= ID;
		var viewnetwork 		= $('#viewnetwork').val();


		if (contributepost == '') {
			
			alert('Enter Some comment..');

		} else {
			
			//alert('Click btn '+currentWallID+' &contributepost=' +contributepost + '&currentUserComment=' +currentUserComment+'&currentWallID=' + currentWallID);

			var dataString = currentWallID+' &contributepost=' +contributepost + '&currentUserComment=' +currentUserComment+'&currentWallID=' + currentWallID;


			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-wallpostcomment.php",
				data: dataString,
				cache: false,

				success: function(){


					var url 		= 'network.php?nid='+viewnetwork;
					var urlclass	= url+' .nw-contribbute-'+currentWallID;

					$('#contributepost'+ID).val("");
					$('.nw-contribbute-'+currentWallID).load(urlclass);
					console.log(urlclass);
				}

			});
		}
		

		return false;

	});



});
</script>