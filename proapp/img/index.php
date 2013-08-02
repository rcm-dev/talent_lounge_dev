<?php  

/* Include header */
include 'header.php';
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

// Function seo friendly
function seo_url($string) 
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

	echo $seoname;
}

?>
<div id="landingMain" class="frontLanding">
	<div id="landingContainer" class="">
		<!-- <div class="landingTitle"></div> -->
		<div id="featuredSlider" class="">
			<div id="featuredContainer">
			<div id="gallery">
				<a href="#" title="Title">
					<img src="img/featured/1.jpg" class="block"></a>
				<a href="#" title="Title">	
					<img src="img/featured/2.jpg" class="block"></a>
				<a href="#" title="Title">
					<img src="img/featured/3.jpg" class="block"></a>
				<a href="#" title="Title">
					<img src="img/featured/4.jpg" class="block"></a>
				<a href="#" title="Title">
					<img src="img/featured/5.jpg" class="block"></a>
				<a href="#" title="Title">
					<img src="img/featured/6.jpg" class="block"></a>
	        </div>
	        <div id="thumbs">
				<img src="img/featured/11.jpg" class="block">
				<img src="img/featured/22.jpg" class="block">
				<img src="img/featured/33.jpg" class="block">
				<img src="img/featured/44.jpg" class="block">
				<img src="img/featured/55.jpg" class="block">
				<img src="img/featured/66.jpg" class="block">    
	        </div>
	        <a href="#" id="next"></a>
	        <div style="clear:both"></div>
	        </div><!-- /featuredContainer --> 
		</div><!-- /featuredSlider -->
		<div class="takeAtour">
			<div class="tourBtn">
				<a href="takethetour.php" title="Take a Tour" class="button large yellow left"><strong>JELAJAHI NCIA</strong></a>
				<div class="clear"></div>
			</div><!-- / --><br>			
			<div class="clear"></div>
		</div><!-- / -->
		<div style="text-align:center; color:#E1E2DE">
			or <a href="register.php" title="or Join Now! It's Free" style="margin:10px 0px; color:#00deff; text-decoration:underline; font-weight:bold" class="public">Daftar Sekarang! Percuma</a>
		</div><!-- / -->
	</div><!-- /landingContainer -->
</div><!-- / -->
		<div id="content" class="">
			
			<div id="contentContainer" class="">

				<!-- iTrade Game Hero -->
				<div style="padding-top: 30px; margin-bottom:30px;" class="ui-window none">
					<h3 class="heading_title_two ic_favorite-black32"><?php echo strtoupper("Real-time simulated stock trading game") ?></h3>
					<br>
					<p>
						Professional simulation trading game offering you to obtain experience of investing through simulated stock trading game, explore risk management, decision making process, identification of opportunities, valuation and report writing.
					</p>
					<br>
					<p>
						<table border="0" width="100%">
				            <tbody><tr>
				              <td width="50%">
				                <strong>Top Performing Universities</strong>
				          <p>
				            </p>
				            <ul id="topU" style="display:none">
				            	<li>
				            		<img alt="" src="images/uni/1.jpg" original-title="Limkokwing" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/2.jpg" original-title="MAHSA" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/3.jpg" original-title="University Kebangsaan Malaysia" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/4.jpg" original-title="University Malaysia Kelantan" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/5.jpg" original-title="University Sains Malaysia" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/6.jpg" original-title="University Putra Malaysia" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/7.jpg" original-title="University Malaysia Sabah" />
				            	</li>
				            	<li>
				            		<img alt="" src="images/uni/8.jpg" original-title="University Tun Razak" />
				            	</li>
				            </ul>
				            <table width="400px">
				            	<tr>
				            		<td>University</td>
				            		<td align="right">Score</td>
				            	</tr>
				            	<tr>
				            		<td><img alt="" src="images/uni/1.jpg" original-title="Limkokwing" /></td>
				            		<td align="right"><strong>3812094</strong></td>
				            	</tr>
				            	<tr>
				            		<td><img alt="" src="images/uni/2.jpg" original-title="MAHSA" /></td>
				            		<td align="right"><strong>472344</strong></td>
				            	</tr>
				            	<tr>
				            		<td><img alt="" src="images/uni/3.jpg" original-title="University Kebangsaan Malaysia" /></td>
				            		<td align="right"><strong>83723</strong></td>
				            	</tr>
				            </table>
				          <p></p><br>

				         
				          <p></p>  
				              </td>
				              <td align="left" valign="top">
				                 <strong>Top Traders</strong>
				                <ul id="topPlayer">
						        	<li>
					            		<img alt="" src="images/player/1.jpg" original-title="Ain Allysa" />
					            		<strong style="color:green">P - 1.02</strong> &middot; <strong style="color:red">L -0.3</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/2.jpg" original-title="Azree" />
					            		<strong style="color:green">P - 3.02</strong> &middot; <strong style="color:red">L -1.3</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/3.jpg" original-title="Jieya" />
					            		<strong style="color:green">P - 1.32</strong> &middot; <strong style="color:red">L -0.13</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/4.jpg" original-title="Nur Syafiqa" />
					            		<strong style="color:green">P - 1.92</strong> &middot; <strong style="color:red">L -2.23</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/5.jpg" original-title="Gold Lan" />
					            		<strong style="color:green">P - 3.92</strong> &middot; <strong style="color:red">L -3.13</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/6.jpg" original-title="Aniq" />
					            		<strong style="color:green">P - 0.12</strong> &middot; <strong style="color:red">L -0.31</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/7.jpg" original-title="Shafqan" />
					            		<strong style="color:green">P - 3.22</strong> &middot; <strong style="color:red">L -2.9</strong>
					            	</li>
					            	<li>
					            		<img alt="" src="images/player/8.jpg" original-title="Luke Chaliff" />
					            		<strong style="color:green">P - 1.82</strong> &middot; <strong style="color:red">L -0.3</strong>
					            	</li>
						        </ul>
				              </td>
				            </tr>
				            <tr>
				            	<td align="center" valign="middle" colspan="2">
				            		<a href="http://localhost/scgenesis/itrade-landing.php" class="button green" style="width:65px">Learn more</a>
				            	</td>
				            </tr>
				          </tbody></table>
					</p>
				</div>

				<div id="cnshare" style="padding-top: 30px; margin-bottom:30px;">
					<div id="latestupdatecns" class="left ui-window" style="width: 450px;">
						<h3 style="margin-bottom:30px;" class="ui-users-black32 heading_title_two">
							LAMAN SOSIAL</h3>

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
										<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo htmlentities($rowcns->pName); ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
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
							<a href="public.php" title="Join Network Now" style="float:right" class="public button green">Join Network Now</a>
						</div><!-- /join network -->

						<?php } ?>


					</div><!-- /latestupdatecns -->

					<div id="lastestupdatearticle" class="right ui-window" style="width:440px; height:540px">
						<h3 style="margin-bottom:30px;" class="ic_bookmark-black32 heading_title_two"><?php echo strtoupper("LAMAN PENGETAHUAN"); ?></h3>

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
								  mj_learn_article.la_id DESC LIMIT 15";
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
						<?php  

						// tracking session
						//if (!isset($usr_email)) {

						?>
						<div id="" style="text-align:right; padding: 10px 0px; margin-top:15px;">
							<!-- <a href="public.php" title="Entrepreneur Library" style="float:right" class="public button green">Entrepreneur Library</a> -->
							<a href="entrepreneur-library.php" title="Browse More" style="float:right" class="button green">Browse More</a>
						</div><!-- /join network -->
						<?php //} ?>


					</div><!-- /lastestupdatearticle -->

					<div class="clear"></div>
				</div><!-- /cnshare -->

				<div class="ui-window">
					<h3 class="heading_title_two ic_tag-black32">
						JELAJAH NCIA
					</h3>
					<br>
					<p>
						Senarai Jelajah NCIA di setiap Sekolah seluruh Malaysia.
					</p>
					<br>
					<div>
						<img src="images/map.jpg" alt="map" title="Roadshow Coming Soon!">
					</div>
				</div>





				<div id="happening" style="margin-top: 60px; padding-top: 100px; border-top:0px dotted #d1d1d1;">
					
					<div>

					<!-- <h3 style="margin-left: 20px;" class="ic_favorite-black32 heading_title_two">IDEAS &amp; PRODUCT SUBMISSION</h3>
 -->
					
</div>
			</div><!-- /contentContainer -->

		</div><!-- /content -->
<input type="hidden" name="page_title" value="Home" id="page_title" />

<script>
$(document).ready(function(){

	/*$('#intervalStream').load('ajax/ajax-landing-stream.php');
    
   function test () {
   		console.log('RUN');
   		$('#intervalStream').load('ajax/ajax-landing-stream.php');
   		//$('#ImgOne').fadeOut(4000).fadeIn(4000);
   }

   var refreshId = setInterval(test, 5000);*/


   /* vertical ticker */
	$('#intervalStream').totemticker({
		row_height	:	'85px',
	});
   /*-------------------------------------------------------------------*/



   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

	$('.book-ui').find('li img').tipsy({gravity: 's'});

	$('#topU').find('li img').tipsy({gravity: 's'});

	$('#topPlayer').find('li img').tipsy({gravity: 's'});

	$('.ideaMisc').find('div .ic_attachment_grey').tipsy({gravity: 's'});




	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


});
</script>
<?php  

/* Include header */
include 'footer.php';

?>