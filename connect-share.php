<?php  


include 'header.php';
include 'db/db-connect.php';
include 'class/short.php';

function shortUpdate($text) { 

    // Change to the number of characters you want to display 
    $chars = 90; 

    $text = $text." "; 
    $text = substr($text,0,$chars); 
    $text = substr($text,0,strrpos($text,' '));

    if ($chars > 90) {
    	$text = $text."...";
    }
    else {
    	$text = $text."";
    }

     

    return $text; 

}

// display rand project by category
$randProject	=	"SELECT
  mj_users.usr_name As proBy,
  mj_fund_post.fund_post_id As proId,
  mj_fund_post.fund_post_title As proTitle,
  mj_fund_post.fund_post_business_model proDesc,
  mj_fund_category.fund_cat_name As catName,
  mj_fund_post.fund_post_image As proImg,
  mj_fund_post.fund_post_short_brief As shortBrief,
  mj_fund_post.fund_post_published
From
  mj_fund_post Inner Join
  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
  Inner Join
  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
Where
  mj_fund_post.fund_post_published = 1
ORDER BY RAND()
LIMIT 0, 10";

$rrandProject	= mysql_query($randProject);

?>

<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="heading_title bebasTitle">Connect &amp; Share</h1>
		</div>

		<div id="" class="left" style="border:0px solid red; width: 480px;">
			<div id="latestupdatecns" class="left ui-window" style="width: 450px;">
						<h3 style="margin-bottom:30px;" class="ui-users-black32 bebasTitle">CONNECT &amp; SHARE</h3>

						<div id="intervalStream">
							<ul>
							<?php  

							// Get second
							function realtime($timestap) {
							        
							    $realtime = strtotime($timestap);

							    return $realtime;
							}

							// 12 min ago..
							function time_since($time) {


							    $original = realtime($time);

							    // array of time period chunks
							    $chunks = array(
							    array(60 * 60 * 24 * 365 , 'year'),
							    array(60 * 60 * 24 * 30 , 'month'),
							    array(60 * 60 * 24 * 7, 'week'),
							    array(60 * 60 * 24 , 'day'),
							    array(60 * 60 , 'hour'),
							    array(60 , 'min'),
							    array(1 , 'sec'),
							    );
							 
							    $today = time(); /* Current unix time  */
							    $since = $today - $original;
							 
							    // $j saves performing the count function each time around the loop
							    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
							 
							    $seconds = $chunks[$i][0];
							    $name = $chunks[$i][1];
							 
							    // finding the biggest chunk (if the chunk fits, break)
							    if (($count = floor($since / $seconds)) != 0) {
							        break;
							    }
							    }
							 
							    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
							 
							    if ($i + 1 < $j) {
							    // now getting the second item
							    $seconds2 = $chunks[$i + 1][0];
							    $name2 = $chunks[$i + 1][1];
							 
							    // add second item if its greater than 0
							    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
							        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s ago";
							    }
							    }
							    return $print;
							}
							//include '../db/db-connect.php';

							$cns = "SELECT mj_users.usr_name As pName,
							status_usr_id_fk,
							status_body AS pStatus,
							status_date AS pStatTime,
							mj_users.usr_id AS uid,
							  mj_users.usr_workat As pwAt,
							  mj_users.user_pic As ppic 
							  FROM 
							  mj_status Inner Join
								  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
								  where status_date 
								  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by status_date desc limit 12";


							$rcns = mysql_query($cns);

							while ($rowcns = mysql_fetch_object($rcns)) { ?>

							<li>
							<div id="<?php echo $rowcns->uid; ?>" style="border-top:1px dotted #f1f1f1; width:450px; padding: 10px 0px;">
								
								<div class="left" style="margin-right: 20px">
									<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
									<div class="profile-pic" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
										
									</div><!-- /profile-pic48 -->
									</a>

								</div><!-- /profile-pic48 -->

								<div class="personame left" style="width:300px;">
										<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo $rowcns->pName; ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
										<p class="pstatus"><?php echo shortUpdate($rowcns->pStatus); ?>
											<br><?php echo time_since($rowcns->pStatTime); ?></p>
								</div><!-- /personame -->

								<div class="clear"></div>
							</div><!-- /uid -->
							</li>


							<?php 

							}

							?>
							<div class="clear"></div>
							</ul>
						</div><!-- /intervalStream -->

						<div class="none">
						<?php  

						$cns = "SELECT mj_users.usr_name As pName,status_usr_id_fk,status_body AS pStatus,mj_users.usr_id AS uid,
						  mj_users.usr_workat As pwAt,
						  mj_users.user_pic As ppic 
						  FROM 
						  mj_status Inner Join
 						  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
 						  where status_date 
 						  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by `status_date` desc limit 5";


						$rcns = mysql_query($cns);

						while ($rowcns = mysql_fetch_object($rcns)) { ?>
						
						<div id="<?php echo $rowcns->uid; ?>" style="border-top:1px dotted #f1f1f1; width:450px; padding: 10px 0px;">
							
							<div class="left" style="margin-right: 20px">
								<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
								<div class="profile-pic" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
									
								</div><!-- /profile-pic48 -->
								</a>

							</div><!-- /profile-pic48 -->

							<div class="personame left" style="width:300px;">
									<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo $rowcns->pName; ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
									<p class="pstatus"><?php echo shortUpdate($rowcns->pStatus); ?></p>
							</div><!-- /personame -->

							<div class="clear"></div>
						</div><!-- /uid -->
						


						<?php 

						}

						?>
						</div><!-- /none -->

						<?php  

						// tracking session
						if (!isset($usr_email)) {

						?>
						<div style="margin-top: 30px;">
							<a href="public.php" title="Join Network Now" style="float:right" class="public btn btn-success">Join Network Now</a>
						</div><!-- /join network -->

						<?php } ?>


					</div><!-- /latestupdatecns -->
		</div><!-- / -->

		<div id="" class="right" style="border:0px solid red; width: 480px;">
			<div id="lastestupdatearticle" class="right ui-window" style="width:440px;">
						<h3 style="margin-bottom:30px;" class="ic_bookmark-black32 bebasTitle">LATEST ARTICLE</h3>

						<h3>How to</h3>
						<ul class="book-ui" original-title="Testing">

							<?php

							/*----------------------------------------------------*/
							/**
							 * Recent Article
							 */

							 $sqlRecentArticle = "SELECT
								  mj_learn_article.*,
								  mj_learn_article_category.la_cat_name,
								  mj_learn_article.la_id,
								  mj_learn_article.la_visual As ArticleCover,
								  mj_learn_article.la_title As la_title1
								FROM
								  mj_learn_article INNER JOIN
								  mj_learn_article_category ON mj_learn_article.la_cat_id_fk =
								    mj_learn_article_category.la_cat_id
								WHERE mj_learn_article_category.la_cat_id = 4
								ORDER BY
								  mj_learn_article.la_id DESC LIMIT 5";
							 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

							 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
						 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
						 		//.short($rowRecentArticle->la_body).'</p></li>';
						 		echo '<li>';
						 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
						 		//echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'">';
						 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
						 		//echo '</a>';
						 		echo '</div>';
						 		echo '</li>';
							 }

							?>
							<div class="clear"></div>
						</ul>
						<br/>
						<h3>Recent Articles</h3>
						<ul class="book-ui" original-title="Testing">

							<?php

							/*----------------------------------------------------*/
							/**
							 * Recent Article
							 */

							 $sqlRecentArticle = "SELECT
								  mj_learn_article.*,
								  mj_learn_article_category.la_cat_name,
								  mj_learn_article.la_id,
								  mj_learn_article.la_visual As ArticleCover,
								  mj_learn_article.la_title As la_title1
								FROM
								  mj_learn_article INNER JOIN
								  mj_learn_article_category ON mj_learn_article.la_cat_id_fk =
								    mj_learn_article_category.la_cat_id
								ORDER BY
								  mj_learn_article.la_id DESC LIMIT 10";
							 $sqlRecentResult	 = mysql_query($sqlRecentArticle);

							 while ($rowRecentArticle = mysql_fetch_object($sqlRecentResult)) {
						 		//echo '<li><a href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'" class="viewOver">'.ucwords($rowRecentArticle->la_title).'</a> ('.$rowRecentArticle->la_dateposted.')<p>'
						 		//.short($rowRecentArticle->la_body).'</p></li>';
						 		echo '<li>';
						 		echo '<div style="width:75px; height:100px; overflow:hidden;">';
						 		//echo '<a class="viewOver" href="article-view-plain.php?aid='.$rowRecentArticle->la_id.'">';
						 		echo '<img src="'.$rowRecentArticle->ArticleCover.'" width="75" original-title="'.$rowRecentArticle->la_title1.'" />';
						 		//echo '</a>';
						 		echo '</div>';
						 		echo '</li>';
							 }

							?>
							<div class="clear"></div>
						</ul>

						<?php  

						// tracking session
						//if (!isset($usr_email)) {

						?>
						<div id="" style="text-align:right; padding: 10px 0px; margin-top:15px;">
							<!-- <a href="public.php" title="Entrepreneur Library" style="float:right" class="public button green">Entrepreneur Library</a> -->
							<a href="entrepreneur-library.php" title="Entrepreneur Library" style="float:right" class="btn btn-success">Entrepreneur Library</a>
						</div><!-- /join network -->
						<?php //} ?>


					</div><!-- /lastestupdatearticle -->
		</div><!-- / -->

		<div class="clear"></div>

		<div id="topUsers" style="margin-top:20px;" class="ui-window">
			<h3 class="heading_title bebasTitle" style="margin:0; padding:0">Community</h3>

			<div id="listTopUsers" class="">
				<ul id="ULlistTopUsers" style="margin-top:10px;">
				<?php  

				$sqlTopUser = "SELECT
								  mj_users.usr_id As topID,
								  mj_users.usr_name As topName,
								  mj_users.user_pic As topPic,
								  mj_users.usr_workat As topWork,
								  mj_users.usr_rating As topRat
								From
								  mj_users
								Order By
								  mj_users.usr_rating Desc
								LIMIT 0, 16";
				$resultTopUser = mysql_query($sqlTopUser);

				while ($rowTopUser = mysql_fetch_object($resultTopUser)) { ?>
				
				<li>
					<a href="users.php?uid=<?php echo $rowTopUser->topID; ?>" class="topListUserLI">
						<div class="profile-pic" original-title="<?php echo $rowTopUser->topName; ?>" style="background-image:url('<?php echo $rowTopUser->topPic; ?>');">
						</div><!-- /profile-pic48 -->
					</a>
					<div style="text-align:center; margin-top: 5px; display:none">
						<span class="thumb-up_color"></span><?php echo $rowTopUser->topRat; ?></div>
				</li>

				<?php 

				}

				?>
				<div class="clear"></div>
				</ul><!-- /ULlistTopUsers -->
			</div><!-- /listTopUsers -->
		</div><!-- /topUsers -->


	</div><!-- /contentContainer -->

</div><!-- /content -->
<input type="hidden" name="page_title" value="Connect &amp; Share" id="page_title" />

<!-- Tip Content -->
<ol id="joyRideTipContent">
  <li data-id="searchNetwork" data-text="Next" class="custom">
    <h4>Search Funders</h4>
    <p>You can search featured funder</p>
  </li>
  <li data-id="projectByCat" data-text="Next">
    <h4>Browse By Category</h4>
    <p>Browse project by category</p>
  </li>
  <li data-id="projDesc" data-text="Next">
    <h4>Listed Project</h4>
    <p>Browse preview project and short details</p>
  </li>
  <li data-id="projectDetailsInfo" data-text="Close">
    <h4>Short preview</h4>
    <p>% of total pledge and day left</p>
  </li>
</ol>

<!-- js start here -->
<script type="text/javascript">
$(document).ready(function(){

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
      			console.log('Run disable tour!');
      			$("html, body").animate({ scrollTop: 0 }, "slow");
      		}      
		});
	});


	/* vertical ticker */
	$('#intervalStream').totemticker({
		row_height	:	'85px',
	});
   /*-------------------------------------------------------------------*/


   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

	$('.book-ui').find('li img').tipsy({gravity: 's'});

	$('.ideaMisc').find('div .ic_attachment_grey').tipsy({gravity: 's'});

	$('#ULlistTopUsers').find('li div').tipsy({gravity: 's'});

});
</script>
<!-- /end js -->
<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>