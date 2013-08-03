<?php  

/**
 * User preview
 * get by user id
 * select statement
 * display as user view
 */
include 'header.php';
include 'db/db-connect.php';

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

$get_user_id	=	(int) sqlInjectString($_GET['uid']);

$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id As currID,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name,
  mj_state.state_name,
  mj_country.country_name
From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id
Where
  mj_users.usr_id = '$get_user_id'";

$rusrSQL = mysql_query($usrSQL);
$rowviewusrSQL = mysql_fetch_object($rusrSQL);

// ==================================================================
//
// HTML Goes here
//
// ------------------------------------------------------------------

?>


<div id="content" class="<?php if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>">

	<?php include 'quickpost.php'; ?>
	<div id="contentContainer"
	<div class="heading">
			<h1 class="heading_title">User Profile</h1>
		</div>
	</div>
	<div id="contentContainer" style="border:0px solid red;">

		<!-- <div class="heading">
			<h1 class="heading_title">User Profile</h1>
		</div> -->

		
			<!-- <div style="border:1px solid #f1f1f1; background-color:#fff;"> -->

				<div class="cnscontainerPlain2 left">
 

			<div id="inventcontent">


				

				<div class="main" style="border:0px solid blue; padding: 20px; margin:20px;">
					
					<div class="profile left" style="border:0px solid orange;  width: 200px;height:172px; ">
						
							<h2 class="title"><?php echo ucwords($rowviewusrSQL->currName); ?></h2>
							<div style="background-image:url('<?php echo $rowviewusrSQL->usrPicture; ?>'); width:130px; height:140px; background-repeat:no-repeat; background-position: top center; background-size: 100%; background-color:#f1f1f1">
										
										<!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->

										</div>

					</div>
				<div class="profile right" style="border:0px solid red;  width: 440px; ">
							<table border="0" cellpadding="3" cellspacing="3">
						  <tr>
						    <!-- <td colspan="3"><h2><?php echo ucwords($rowviewusrSQL->currName); ?></h2></td> -->
						  </tr>
						  <tr>
						  	<td colspan="3"><span class="card_address_color">Profile</span></td>
						  </tr>
						  <tr>
						    <td>Email</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->setemail; ?></td>
						  </tr>
						  <tr>
						    <td>Last Login</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->setLastlogin; ?></td>
						  </tr>
						  <tr>
						    <td>Phone No</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->currPhoneNo; ?></td>
						  </tr>
						  <tr>
						    <td>General Info</td>
						    <td>&nbsp;</td>
						    <td><?php echo $rowviewusrSQL->CurGenInfo; ?></td>
						  </tr>
						  <tr>
						    <td>Work at</td>
						    <td>&nbsp;
						    <td><?php echo $rowviewusrSQL->WorkAt; ?></td>
						  </tr>
						</table>

					</div>	
	<div class="clear"></div>
				</div>
				
				<div>
					<!-- skills -->
					<div class="main" style="border:0px solid blue; padding: 20px; margin:20px;">
					<?php  
							/**
							 * SHOW SKILLS
							 */
							$query_rsUserSkill = "SELECT * FROM jp_skills WHERE user_id_fk ='$get_user_id'";
							$rsUserSkill = mysql_query($query_rsUserSkill);
							$row_rsUserSkill = mysql_fetch_assoc($rsUserSkill);
						$totalRows_rsUserSkill = mysql_num_rows($rsUserSkill);

?>
					<h2>Skills</h2>
		 <div class="box resumebox" align="center">
        <?php if ($totalRows_rsUserSkill > 0) { // Show if recordset not empty ?>
          <br/>
          <br/>
          <table width="500" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <th>Skill</th>
              <th>Years of Experience</th>
              <th>Proficiency</th>
              </tr>
            <?php do { ?>
              <tr>
                <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_name']; ?></td>
                <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_y_exp']; ?></td>
                <td align="center" valign="middle"><?php echo $row_rsUserSkill['skills_proficiency']; ?></td>
              </tr>
              <?php } while ($row_rsUserSkill = mysql_fetch_assoc($rsUserSkill)); ?>
          </table>
          <?php } // Show if recordset not empty ?>
        </div>

					</div>
				
				</div>
				
				<div>
				</div>

			<!-- portfolio -->
					<div class="main" style="border:0px solid blue; padding: 20px; margin:20px;">
					<?php  
							/**
							 * SHOW SKILLS
							 */
							$query_rsUserSkill = "SELECT * FROM jp_skills WHERE user_id_fk ='$get_user_id'";
							$rsUserSkill = mysql_query($query_rsUserSkill);
							$row_rsUserSkill = mysql_fetch_assoc($rsUserSkill);
						$totalRows_rsUserSkill = mysql_num_rows($rsUserSkill);

?>
					<h2>Portfolio</h2>
		 <div id="listTopUsers" class="">
				<ul id="ULlistTopUsers" style="margin-top:10px;">
				<?php  

				$sSectorUser = "SELECT * FROM mj_fund_post WHERE mj_fund_post.fund_usr_id_fk ='$get_user_id'";
					  
					
					 $rISectorUser = mysql_query($sSectorUser);
					 
					 $numrowISectorUser = mysql_num_rows($rISectorUser);

				while ($rowISectorUser = mysql_fetch_object($rISectorUser)){ ?>
				
				<li>
					<div class="ideaContainer">
									<div class="ideaFrame2">
										<div class="ideaFrameImage2">
					  <a href="idea-details.php?id=<?php echo $rowISectorUser->fund_post_id; ?>" class="topListUserLI">
						<div class="profile-pic11" original-title="<?php echo $rowISectorUser->fund_post_title; ?>" style="background-image:url('<?php echo $rowISectorUser->fund_post_image; ?>');">
						</div><!-- /profile-pic48 -->
					</a>
					</div>
				</div>
			</div>
				</li>

				<?php 

				}

				?>
				<div class="clear"></div>
				</ul><!-- /ULlistTopUsers -->
			</div><!-- /listTopUsers -->
					</div>
				
				</div>
				
				<div>
				

				<div class="main" style="border:0px solid blue; padding: 20px; margin:20px;">
					<?php  
							/**
							 * SHOW education
							 */
							$query_rsUserQualification = "SELECT   jp_edu_lists.edu_name,   jp_field_list.field_name,   jp_education.*,   jp_grade_list.grade_name,   jp_nationality.national_name From   jp_education Inner Join   jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id   Inner Join   jp_field_list On jp_education.edu_fieldStudy = jp_field_list.field_id   Inner Join   jp_grade_list On jp_education.edu_grade = jp_grade_list.grade_id Inner Join   jp_nationality On jp_education.edu_located = jp_nationality.national_id WHERE jp_education.user_id_fk  ='$get_user_id' ORDER BY edu_date_graduate_year DESC LIMIT 1";
							$rsUserQualification = mysql_query($query_rsUserQualification);
							$row_rsUserQualification = mysql_fetch_assoc($rsUserQualification);
							$totalRows_rsUserQualification = mysql_num_rows($rsUserQualification);

?>
					<h2>Education</h2>
		  <div class="box resumebox">
        <?php if ($totalRows_rsUserQualification > 0) { // Show if recordset not empty ?>
          <table width="500" border="0" cellspacing="0" cellpadding="2">
            <?php do { ?>
              <tr>
                <td width="10">&nbsp;</td>
                <td class="def_width_box_2">Qualification</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['edu_name']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>CGPA</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['edu_cgpa']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>Field of Study</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['field_name']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>Major</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['edu_major']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>Institute / University</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['edu_university']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>Graduated</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['edu_date_graduate_month']; ?> <?php echo $row_rsUserQualification['edu_date_graduate_year']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>Located in</td>
                <td width="22">:</td>
                <td><?php echo $row_rsUserQualification['national_name']; ?></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
                <?php } while ($row_rsUserQualification = mysql_fetch_assoc($rsUserQualification)); ?>
              </tr>
              
          </table>
          <?php } // Show if recordset not empty ?>
        </div>

					</div>
				
				</div>
				
				<div>
				
				<!-- end -->
					<div class="idea-video none">
						<div class="idea-video-container">
						<a href="idea-details.php?id=<?php //echo $rowqRandIdea->picId; ?>"><img src="<?php //echo $rowqRandIdea->Picture; ?>"></a>
						</div>
					</div>
				</div>
			
		</div><!-- /cnscontainer -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">

			<div id="BrowseIdeaMore" style="margin-top:30px">
				<strong id="browseMore01" class="heading_title_two bebasTitle">Browse More</strong>
					<ul class="browseIdeaList" style="margin-top:20px;">
					<?php  


					/**
					 * 
					 * 
					 * 
					 * Browse idea sidebar
					 * Recent Submited
					 * Browse more
					 */

   

			$rcatIdea = "SELECT * FROM mj_fund_category ORDER BY fund_cat_name ASC";
						$qrIResult = mysql_query($rcatIdea);


					while ($rowqrI = mysql_fetch_object($qrIResult)) {
						
						$totalIdeainCat = "SELECT
						  Count(mj_fund_post.fund_post_id) As TotalIdea
						From
						  mj_fund_post
						Where
						  mj_fund_post.fund_cat_id_fk= '$rowqrI->fund_cat_id'";

						$resultTotalIdeainCat = mysql_query($totalIdeainCat);
						$rowTotalIdeainCat = mysql_fetch_object($resultTotalIdeainCat);

						$valueIdea = $rowTotalIdeainCat->TotalIdea;

						echo '<li><span class="miniCircle2">&nbsp;'.$valueIdea.'</span>
							<a href="browse-idea-category.php?id='.$rowqrI->fund_cat_id.'">'.ucwords($rowqrI->fund_cat_name).'</a>
						</li>';

					}

					?>
					</ul>
			</div><!-- /BrowseIdeaMore -->	

			<div style="margin-top:30px">
				<strong id="recomForYou" class="heading_title_two bebasTitle">Recommended for you</strong>

				<div style="margin-top:20px;">
					<?php  

					$recom		=	"SELECT
					  mj_fund_post.fund_post_image As Picture,
					  mj_fund_post.fund_post_id As picId,
					  mj_fund_post.fund_post_title As ideaTitle,
					  mj_fund_post.fund_post_short_brief,
					  mj_fund_post.fund_usr_id_fk As usrIdFK,
					  mj_users.usr_name As usrName,
					  mj_users.user_pic As usrPic,
					  mj_fund_post.fund_post_ratup As ideaLove
					From
					  mj_fund_post Inner Join
					  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
					Where
					  mj_fund_post.fund_post_published = 1
					Order By
					  RAND()
					Limit 3";

					$rrecom	=	mysql_query($recom);

					?>
					<ul id="loc-landing">
						<?php while($rowrcom = mysql_fetch_object($rrecom)){ ?>
						<li>
							<div>
								<div class="featured_emplyed_lists">
									<div>
										<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
										<img src="<?php echo $rowrcom->Picture; ?>" width="60px" />
										</a>
									</div>
								</div><!-- /leftPic -->
								<div class="left" style="width:160px">
									
									<a href="idea-details.php?id=<?php echo $rowrcom->picId; ?>" title="View this idea">
									<strong style="color:#3F3FA0"><?php echo $rowrcom->ideaTitle; ?></strong>
									</a><br><br>
									<span class="ic_favorite_grey" style="color:#aaa; margin-right:10px;"><?php echo number_format($rowrcom->ideaLove); ?></span>
									<span class="ic_chats_grey" style="color:#aaa">
										<?php  

										$qComment   = "SELECT
													  Count(mj_fund_comment.fund_usr_id_fk) As totalComment
													From
													  mj_fund_comment
													Where
													  mj_fund_comment.fund_post_id_fk = '$rowrcom->picId'";
										$rqComment  =mysql_query($qComment);
										$rowqComment=mysql_fetch_object($rqComment);

										echo number_format($rowqComment->totalComment);

										?>
									</span>
								</div><!-- /left -->
								<div class="clear"></div><!-- /clear -->
							</div><!-- /container -->

							</li>
							<br/>
						<?php } ?>
					</ul><!-- /browseIdeaList -->
				</div><!-- /recommend -->
			</div><!-- recommend for you -->
		</div><!-- /orange right -->

		<div class="clear"></div>
	</div><!-- /contentContainer -->

</div><!-- /content -->


<input type="hidden" name="page_title" value="<?php echo $rowviewusrSQL->currName; ?>" id="page_title" />


<script type="text/javascript">
$(document).ready(function(){
	
	/*$('.user-misc-view').hover(function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeIn();
		$('.user-misc-view .right-arrow .right-profile').fadeIn();

	},function(){
		
		$('.user-misc-view .left-arrow .left-profile').fadeOut();
		$('.user-misc-view .right-arrow .right-profile').fadeOut();

	});*/

	$('#send-msg-btn').fancybox({
		'opacity'		: true,
		'overlayShow'	: true,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'none'

	});


	$('#sm-button').click(function(){
		
		var sendmessagebody = $('#sendmessagebody').val();

		if (sendmessagebody == '') {
			alert('Enter your message');
		} else {

			var sendmessagebody = $('#sendmessagebody').val();
			var messageto   	= $('#messageto').val();
			var messageby   	= $('#currUsrId1').val();

			console.log('messageto=' + messageto + '&sendmessagebody=' + sendmessagebody + '&messageby=' + messageby);
			
			$.ajax({
				
				type: "POST",
				url: "ajax/send-message.php",
				data: 'messageto=' + messageto + '&sendmessagebody=' + sendmessagebody + '&messageby=' + messageby,
				cache: false,

				success: function(response){

					if (response == 1) {

						$('form#form-message').hide();
						//console.log('send');

						$('#messagesent').fadeIn();
						$('#message-send').css('height', '60px');

					} else {

						console.log('not send');						
					}
					
				}

			});

		}
		return false;
	});


	/* request friends */
	$('#send-request-friend').click(function(){
		
		var getuserviewid = $('#getviewuserid').val();
		var currUsrId	  = $('#currUsrId').val();

		$.ajax({
				
			type: "POST",
			url: "ajax/friend-requested.php",
			data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
			cache: false,

			success: function(html){

				var url_to_load = 'users.php?uid=';
				//$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
				$('#send-request-friend').hide();
				$('#followFriendBtn').fadeIn('slow').append(html);

				
				
			}

		});

	});


/* Unfriends */
	$('#unfriends').click(function(){
		
		var getuserviewid = $('#getviewuserid').val();
		var currUsrId	  = $('#currUsrId').val();

		$.ajax({
				
			type: "POST",
			url: "ajax/delete-friend.php",
			data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
			cache: false,

			success: function(html){

				var url_to_load = 'users.php?uid=';
				//$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
				$('#unfriends').hide();
				$('#followFriendBtn').fadeIn('slow').append(html);
				//console.log(url_to_load + 'DONE');
				
				console.log(url_to_load);
				
			}

		});

	});


	/* tipsy */
	$('.friendsUserView').find('li div.namePic').tipsy({gravity: 's'});


	/*rateup*/
	$('#ratUp').click(function(){

		var id = $('#currViewUsrID').val();

		$.ajax({

			url: "ajax/ajax-rate-up-user.php",
			type: "POST",
			data: "curruseridview="+id,

			success: function(html) {
				$('span#rateuptext').hide();
				$('span#rateupresult').fadeIn().append(html);
				//console.log(id);
			}

		});

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