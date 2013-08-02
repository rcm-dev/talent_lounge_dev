<?php  


include 'header.php';
include 'db/db-connect.php';

# sqlinjection
function sqlInjectString($string) 
{

	$seoname = preg_replace('/\%/',' percentage',$string); 
	$seoname = preg_replace('/\@/',' at ',$seoname); 
	$seoname = preg_replace('/\&/',' and ',$seoname);
	$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
	$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
	$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
	$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens  
	//$seoname = trim(str_replace(range(0,9),'',$seoname));
	$seoname = strtolower($seoname);
	mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

	return $seoname;
}

$usr_id = (int) sqlInjectString($_GET['currid']);

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  _company.comp_name As WorkAt,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users Inner Join
  _company On mj_users.usr_workat = _company.comp_co_num
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>

<?php  

/**
 * File network view
 * get network id
 * and view on screen
 */
//include 'header-plain.php';
//include 'db/db-connect.php';
//include 'class/time.php';


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

<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title">Discussion Group</h1>
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
					
					<?php

// ==================================================================
//
// get network id at url and sql statement
//
// ------------------------------------------------------------------

$viewnetwork = sqlInjectString($_GET['nid']);


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
  mj_network_relation.mn_id_fk = '$viewnetwork' AND
  mj_network_relation.mnr_status = '1'";
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

				<div id="mainTopGroup" style="padding-bottom:30px">
					
					
					<div id="headingContainer" class="">
						<div id="groupTitle" class="l"><h2><?php echo $rowDisplayName->NetworkName; ?></h2></div>
						<div class="r">

							<?php if($rowDisplayName->creatorId == $usr_id) { ?>
							<a href="#" id="editGroup" title="Edit"><img src="images/icon_grey/ic_edit.png" title="Your is the owner and you can edit this group." />
							</a>
							<?php } ?>

						</div>
						<div class="clear"></div>
					</div><!-- /headingContainer -->

					<!-- editGroup -->
					<div id="editGroupContainer" class="none">
						<strong>Edit Group</strong>
						<form method="post" action="#" id="groupDataEdit">
						<table width="640px">
							<tr>
								<td>Network Name
								</td>
								<td>:
								</td>
								<td><input type="text" name="networkname" id="networkname" value="<?php echo $rowDisplayName->NetworkName; ?>" class="title" />
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>Description
								</td>
								<td>:
								</td>
								<td><textarea id="groupDes" name="groupDes" rows="6" cols="60"><?php echo $rowDisplayName->networkDesc ?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
								<td>&nbsp;
								</td>
								<td>
								<input type="submit" name="subEditNetwork" class="button green" id="subEditNetwork" value="Update Group" />
								<input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id; ?>" />
								<input type="hidden" name="nid" id="nid" value="<?php echo sqlInjectString($_GET['nid']); ?>" />
								</td>
							</tr>
						</table>
						<br><br>
						</form>
					</div><!-- /editGroupContainer -->

					<p><strong class="document-snippet_color">Group Description</strong></p>
					<p id="groupDesc">
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
						<div class="left"><strong class="users_color">Contributor</strong></div>
						<div class="right">
							<a href="#inviteF" id="invite">
								<img src="images/icon_color/user--plus.png" title="Add entreprenuer" />
							</a>
						</div>
						<div class="clear"></div>
					</div>

					<div id="userFriends" class="none">
						<div id="inviteF" style="width: 670px; height: 400px; margin:10px 0px; overflow: auto; border-bottom:1px solid #eaeaea">
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

								echo '<ul class="userFriends">';

								while ($rowqFriend = mysql_fetch_object($rqFriend)) { 

									$FriendID = $rowqFriend->fID;				

									$qAlreadyInsideTheNetwork = "SELECT
									  mj_network_relation.mnr_status As alreadyStatus,
									  mj_network_relation.mn_id_fk As networkID,
									  mj_network_relation.usr_id_fk As userIDAvailable
									From
									  mj_network_relation
									Where
									  mj_network_relation.mn_id_fk = '$viewnetwork' And
									  mj_network_relation.usr_id_fk = '$FriendID'";

									$rqAlreadyInsideTheNetwork     = mysql_query($qAlreadyInsideTheNetwork);
									$rowqAlreadyInsideTheNetwork   = mysql_num_rows($rqAlreadyInsideTheNetwork);
									$objectAlreadyInsideTheNetwork = mysql_fetch_object($rqAlreadyInsideTheNetwork);

									

								?>
									
								<li>
									<div class="namePic">
										<div class="profile-pic48" style="background-image: url('<?php echo $rowqFriend->usrPicture; ?>');">
											
										</div>
									</div>
									<div class="nameDesc"><strong><?php echo ucwords($rowqFriend->friendName); ?></strong>
									<br/>
									<span style="color:#aaa; font-size:11px;"><?php echo ucwords($rowqFriend->CompanyName); ?></span>
									<br/>
									
									<form method="post" class="forminvite" id="<?php echo $rowqFriend->fID; ?>" style="margin-top:5x;">
										<input type="hidden" name="fid" class="fid" value="<?php echo $rowqFriend->fID; ?>"  />

										<input type="hidden" name="vid" class="vid" value="<?php echo $viewnetwork; ?>"  />

										<?php if ($rowqAlreadyInsideTheNetwork != 1) { ?>

										<div class="inviteText" id="inviteText<?php echo $rowqFriend->fID; ?>">
										<input type="submit" id="<?php echo $rowqFriend->fID; ?>" data-fid="<?php echo $rowqFriend->fID; ?>" data-vid="<?php echo $viewnetwork; ?>" data-currUserId="<?php echo $usr_id; ?>" class="inviteJoin button green" value="Invite" />
										</div>

										<div class="inviteRespond none" id="inviteRespond<?php echo $rowqFriend->fID; ?>">
											<span style="color:#F0AE15; font-size:11px;">Waiting Confirmation</span>
										</div>
											

										<?php } else { ?>

										
											<?php if ($objectAlreadyInsideTheNetwork->alreadyStatus == 0){ ?>
												
												<span style="color:#F0AE15; font-size:11px;">Waiting Confirmation</span>

											<?php } else { ?>
												
												<span style="color:#7BDC10; font-size:11px; font-weight:bold" class="user-business-gray_color">Joined</span>

											<?php } ?>

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
					</div><!-- /friend list -->

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
					<table>
						<tbody>
							<tr>
								<td><input type="text" name="txtntwkwall" id="txtntwkwall" placeholder="Got News? Questions?" class="title" style="padding:5px; width:400px;" /></td>
								<td><input type="submit" value="post" id="ntwkwallpost" class="button green" name="ntwkwallpost" />
					<input type="hidden" name="viewnetwork" id="viewnetwork" value="<?php echo $viewnetwork; ?>" />
					<input type="hidden" name="currUserID" value="<?php echo $usr_id; ?>" id="currUserID" ></td>
							</tr>
						</tbody>
					</table>
					</form>

					<div class="resultWallPost" id="resultWallPostUI">
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

					echo '<div class="nw-wall" id="wallUI">';

					/* grab object table */
					while ($grabRowWallGroup = mysql_fetch_object($resultwallGroup)) {

					?>

						<div id="gap<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="gap">
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
								<div id="nwcontribbute<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="nw-contribbute">
									<ul id="nw-ui-new<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="nw-ui-new">
										<?php  
											$currentwallpostid = $grabRowWallGroup->CurrentWallIDPost;

											$displayCommentWallPost = "SELECT
											  mj_network_comment.nc_body As commentBody,
											  mj_users.usr_name As commentByName,
											  mj_users.user_pic As usrPic,
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
													echo '<div class="left">';
													echo '<div class="profile-pic32">';
													echo '<img src="'.$commentwallpostobject->usrPic.'" width="34" />';
													echo '</div>';
													echo '</div>';
													echo '<div class="left commentFixed" style="margin:0px 0px 0px 10px;">';
													echo '<a href="users.php?uid='.$commentwallpostobject->commentByNameID.'">';
													echo '<strong>'.$commentwallpostobject->commentByName.'</strong>';
													echo '</a>';
													echo '&nbsp;';
													echo ' <span>'.$commentwallpostobject->commentBody.'</span>';
													echo '<br/>';
													echo '<span class="nw-misc">'.$commentwallpostobject->commentDate.'</span>';
													echo '</div>';
													echo '<div class="clear"></div>';
													echo '</li>';

													//echo $commentwallpostobject->commentDate;

												}

											}
										?>
									</ul>
									<div id="contributeMsg<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributeMsg" style="background-color: #f1f1f1; padding:2px;">
										<form method="post">

										<div class="profile-pic32 left" style="margin:2px;">
											<img src="<?php echo $rowusrSQL->usrPicture; ?>" width="32" />
										</div>
										<!-- <input type="text" name="contributepost" id="contributepost<?php //echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:350px;" /> -->

										<div class="left" style="margin:2px 0px 0px 4px;">
											<textarea name="contributepost" id="contributepost<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="contributepost" style="width:400px; height:20px; padding:4px; font-family: Arial;" placeholder="Write your idea..."></textarea>
											<br/>
											<input type="submit" name="submitcomment" id="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="submitcomment" />

											<input type="hidden" name="currentUserComment" id="currentUserComment<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" class="currentUserComment" value="<?php echo $usr_id; ?>" />
											<input type="hidden" name="currentWallID" id="currentWallID<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" value="<?php echo $grabRowWallGroup->CurrentWallIDPost; ?>" />
										</div>
										<div class="clear"></div>
										</form>	
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	
						
					<?php 

							}
					?>
							
						
					<?php
						
						echo '</div>';


						} 


					?>

					<!-- /Discussion -->

					</div>

				</div>


				<div class="clear"></div>

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

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->

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

	

	/*edit group*/
	$('#editGroup').click(function(){

		$('#editGroupContainer').toggle('slow');

	});

	/*submiteditgroup*/
	$('#subEditNetwork').click(function(){


		var networkName = $('#networkname').val();
		var groupDes		= $('#groupDes').val();

		if (networkName == '' || groupDes == '') {

			$.jnotify("Enter name and Description", "error");
		}
		else {

			var dataUpdateGroup = $('form#groupDataEdit').serialize();

			$.ajax({
				url: "ajax/ajax-update-network.php",
				type: "POST",
				data: dataUpdateGroup,

				success:function(html){
					if (html == 1) {


						var url = 'viewgroup.php?nid='+$('#nid').val()+'&currid='+$('#usr_id').val();

						$.jnotify("Group Updated");
						$('#editGroupContainer').fadeOut();
						$('#groupTitle').load(url+' #groupTitle');
						$('#groupDesc').load(url+' #groupDesc');
					}
					else {
						$.jnotify("SQL Error", "error");
					}
				}
			});

			//console.log(dataUpdateGroup);
		}

		return false;
	});
	

	
	$('#subnetwork').click(function(){

		var networkName = $('#networkname').val();
		var usr_id		= $('#usr_id').val();
		
		if (networkName == '') {
		
			$.jnotify("Enter network name", "error");
			
		} else {
			
			$.ajax({
		

				type: "POST",
				url: "ajax/ajax-create-network.php",
				data: 'networkName=' + networkName + '&usr_id=' + usr_id,
				cache: false,

				success: function(){


					$('#networkname').val("");
					console.log('perfect');
					$('#networkviewmain').load('#networkviewmain ul#networkList');
					$.jnotify("New Network Created!");
				}

			});
		}

		return false;

	});


	$('#new-net').click(function(){

		$('.new-network').toggle();

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
		var currUserId = $(this).attr('data-currUserId');

		var datainvite = 'fid='+fid+'&vid='+vid+'&currUserId='+currUserId;

		//alert(datainvite);


		$.ajax({

			url: 'ajax/ajax-joingroup.php',
			type: 'POST',
			data: datainvite,
			cache: false,

			success: function(){

				
				//$('div#'+fid+'.inviteText').fadeOut();
				$('div#inviteRespond'+fid).fadeIn();
				$('div#inviteText'+fid).hide();
				console.log(datainvite);
				//console.log(datainvite);

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
			
			$.jnotify("Enter your topic", "error");

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

				success: function(html){

					var url 		= 'viewgroup.php?nid='+viewnetwork+'&currid='+currUserID;
					var urlclass	= url+' div#gap'+html;


					$('#txtntwkwall').val("");
					$('div#wallUI').prepend(html);
					console.log(urlclass);	
					$.jnotify("New topic posted");
				}

			});
		}

		return false;

	});

	//console.log($('#currUserID').val());



	/* click and open comment network wall post */
	/*$('.contributeMsg').hide();*/

	$('.contribute').live('click', function(){
		
		var conID = $(this).attr('id');

		//alert('Clicked '+conID);

		$('#nwcontribbute'+conID).toggle();
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
			
			$.jnotify("Enter your comment", "error");


		} else {
			
			//alert('Click btn '+currentWallID+' &contributepost=' +contributepost + '&currentUserComment=' +currentUserComment+'&currentWallID=' + currentWallID);

			var dataString = currentWallID+' &contributepost=' +contributepost + '&currentUserComment=' +currentUserComment+'&currentWallID=' + currentWallID;


			var currID = $('#currID').val();

			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-wallpostcomment.php",
				data: dataString,
				cache: false,

				success: function(){


					var url 		= 'viewgroup.php?nid='+viewnetwork+'&currid='+currID;
					var urlclass	= url+' ul#nw-ui-new'+currentWallID;

					$('#contributepost'+ID).val("");
					$('ul#nw-ui-new'+currentWallID).load(urlclass);
					console.log(urlclass);
					$.jnotify("Comment Posted");
				}

			});
		}
		

		return false;

	});


});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>