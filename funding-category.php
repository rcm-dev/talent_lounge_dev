<?php  


include 'header.php';
include 'db/db-connect.php';
include 'class/short.php';

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
	mysql_real_escape_string(trim(htmlentities($seoname)));

	return $seoname;
}


$catProjectId	=	sqlInjectString($_GET['id']);

// display rand project by category
$randProject	=	"SELECT
  mj_users.usr_name As proBy,
  mj_fund_post.fund_post_id As proId,
  mj_fund_post.fund_post_title As proTitle,
  mj_fund_post.fund_post_business_model proDesc,
  mj_fund_category.fund_cat_name As catName,
  mj_fund_post.fund_post_image As proImg,
  mj_fund_post.fund_post_short_brief As shortBrief,
  mj_fund_post.fund_post_published,
  mj_fund_post.fund_cat_id_fk
From
  mj_fund_post Inner Join
  mj_fund_category On mj_fund_post.fund_cat_id_fk = mj_fund_category.fund_cat_id
  Inner Join
  mj_users On mj_fund_post.fund_usr_id_fk = mj_users.usr_id
Where
  mj_fund_post.fund_post_published = 1 And
  mj_fund_post.fund_cat_id_fk = '$catProjectId'
Order By
  RAND()
Limit 0, 10";

$rrandProject	= mysql_query($randProject);


$singleCat = "SELECT
		  mj_fund_category.fund_cat_name As singleCatName
		From
		  mj_fund_category
		WHERE mj_fund_category.fund_cat_id = '$catProjectId'";

$rsingleCat = mysql_query($singleCat);
$singleRowObject = mysql_fetch_object($rsingleCat);

?>


<!-- <div id="content" class="<?php //if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>"> -->
<div id="content">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer">
				<div class="heading">
					<h1 class="heading_title bebasTitle">Category <?php echo ucwords($singleRowObject->singleCatName); ?></h1>
				</div><br><br>

				<div class="top-grid" style="margin-bottom:30px;">
					<h4><strong class="heading_title_two bebasTitle">Project / Proposal Categories</strong></h4>
					
					<ul id="fundingCat">
						<?php  
						/**
						 * 
						 * View by category
						 */

						 $pCat = "SELECT
							  mj_fund_category.fund_cat_name As CatNameBottom,
							  mj_fund_category.fund_cat_id As catIdBottom
							From
							  mj_fund_category";

						 $rpCat = mysql_query($pCat);

						 while ($rowpCat = mysql_fetch_object($rpCat)) {
						 	

						?>

						<li>
						<a href="funding-category.php?id=<?php echo $rowpCat->catIdBottom; ?>">
						<?php echo ucwords($rowpCat->CatNameBottom); ?></a>
						</li>

						<?php } ?>
						<div class="clear"></div>
					</ul>
				</div><!-- /project category -->
				

				<!-- View -->

				<?php  


				/**
				 * 
				 *
				 * If 0 return no project
				 */

				 $norandProject = mysql_num_rows($rrandProject);

				 if ($norandProject == 0) {
				 	
				 	echo "No project / proposal in this category.";

				 } else { 

				 ?>
				 	
				 	<div class="pro-container">
				 	<ul>


				 		<?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
				 			
				 			<li>
								<div class="project-item">
									<div class="project-visual">

										<div class="project-visual-container">
										<div class="project-visual-top">
										<a href="funding-details.php?id=<?php echo $rowrandProject->proId; ?>">
										<div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('<?php echo $rowrandProject->proImg; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
												<!-- <img src="<?php echo $rowrandProject->proImg; ?>" width="190"> -->
											</div><!-- /imgFunding -->
										</a>
										<br/>
										<a href="funding-details.php?id=<?php echo $rowrandProject->proId; ?>">
										<strong style="color:#1F4864"><?php echo ucwords($rowrandProject->proTitle); ?></strong>
										</a>
										<br/>
										<small style="color:#999;">by <?php echo ucwords($rowrandProject->proBy); ?></small>
										<br/>
										<p style="color:#999; font-size: 12px; line-height: 15px; margin-top:10px">
											<?php echo shortBrief(ucfirst($rowrandProject->shortBrief)); ?>
										</p>
										</div>


										<div class="project-pledge-info">
										<?php  

										/**
										 * 
										 * 
										 * Pledge Information
										 * 
										 */

										 $projectId = $rowrandProject->proId;

										 $sPledge = "SELECT
										  SUM(mj_fund_pledged.fund_money) As TotalPledge,
										  mj_fund_post.fund_post_title,
										  mj_fund_post.fund_post_project_budget As Budget,
										  mj_fund_pledged.fund_post_id_fk
										From
										  mj_fund_post Inner Join
										  mj_fund_pledged On mj_fund_pledged.fund_post_id_fk = mj_fund_post.fund_post_id
										Where
										  mj_fund_pledged.fund_post_id_fk = '$projectId'
										Group By
										  mj_fund_post.fund_post_title, mj_fund_post.fund_post_project_budget,
										  mj_fund_pledged.fund_post_id_fk";

										  $rsPledge = mysql_query($sPledge);
										  $rowsPledge = mysql_fetch_object($rsPledge);
										  $numrowrsPledge = mysql_num_rows($rsPledge);



										?>
										<?php  
										/**
										 * 
										 * If nothing pledge display 0
										 * 
										 */
										if ($numrowrsPledge == 0) { ?>

										<div class="pledge-bar">
												<div class="pledge-bar-value" style="width:0%"></div>
											</div>

										<?php  } else {

										$projectBudget 	= $rowsPledge->Budget;
										$totalGet	   	= $rowsPledge->TotalPledge;
										$projectPercent	= ($totalGet/$projectBudget)*100; 

										?>


											<div class="pledge-bar">
												<div class="pledge-bar-value" style="width:<?php echo $projectPercent; ?>%"></div>
											</div>
										<?php } ?>

											<div style="color:#999">
												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * If nothing pledge display 0
												 * 
												 */
												if ($numrowrsPledge == 0) { ?>

												<small><strong style="color:#666">0%</strong>
												FUNDED</small>

												<?php  } else {

												$projectBudget 	= $rowsPledge->Budget;
												$totalGet	   	= $rowsPledge->TotalPledge;
												$projectPercent	= ($totalGet/$projectBudget)*100; 

												?>
												<small>
												<strong style="color:#666">
												<?php echo $projectPercent ?>%</strong>
												FUNDED</small>
												<?php } ?>
												</div>

												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * If nothing pledge display 0
												 * 
												 */
												if ($numrowrsPledge == 0) { ?>

												<small><strong style="color:#666">RM 0</strong>
												PLEDGED</small>

												<?php  } else { ?>

												<small>
												<strong style="color:#666">RM<?php echo number_format($rowsPledge->TotalPledge); ?></strong>
												PLEDGED</small>

												<?php } ?>

												</div>

												<div class="pledge-item">
												<?php  
												/**
												 * 
												 * Calculate DAYLEFT
												 *
												 */
												 $qDayLeft = "SELECT DATEDIFF( fund_post_ended, NOW( ) ) AS DAYLEFT FROM mj_fund_post WHERE fund_post_id = '$projectId'";
												 $rqDayLeft = mysql_query($qDayLeft);
												 $rowqDayLeft = mysql_fetch_object($rqDayLeft);

												?>
												<small>
												<strong style="color:#666"><?php echo $rowqDayLeft->DAYLEFT; ?></strong><br/>
												DAYS LEFT</small></div>

												<div class="clear"></div>
											</div>
										</div>
										</div>

									</div>
									<div class="project-details">
										<p><h4><strong><?php echo strtoupper($rowrandProject->proTitle); ?></strong></h4></p>
										<p style="font-size: 13px; color: #666;"><?php echo short($rowrandProject->proDesc); ?></p>
									</div>
									<div class="clear"></div>
								</div>
							</li>

				 		<?php } ?>
						
					<div class="clear"></div>
					</ul>
					</div>

				 <?php } ?>

				<!-- /view -->

			</div>
	</div><!-- /contentContainer -->

</div><!-- /content -->


<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>