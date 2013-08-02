<?php  


include 'header.php';

$agreed = mysql_real_escape_string($_GET['agreed']);

if ($agreed != 'Continue') {
	header("location: submit-project.php");
}

?>


<div id="mojo-container">


	<div class="container_24">
		<div class="home_container">
			<div class="home_box">
				<h1 class="title bottom-gap">Submit New Proposal</h1>
				<div>
					<div>

						<form method="post" action="project-submited.php" enctype="multipart/form-data">

						<div id="accordion">
							<h3><a href="#">Section 01 :: Business Model & Commercial Viability</a></h3>
							<div>
								<p>(Please detail out the Business Model for the idea, i.e. revenue sources, real need for the products and/or services and a ready market for it, why the customer would pay for it, what helps to sustain the business model and potential scalability or scope expansion of the business, etc.)</p>
								<p>
								<label>Project / Business Idea</label><br/>
								<input type="text" class="tfull" name="projectIdea" /><br/>
								<label>Short Brief</label><br/>
								<textarea name="shortBrief" class="tfull"></textarea><br/>
								<label>Category</label>
								<small>Which category is suitable with your project</small>
								<select name="pro_cat">
									<?php

									include 'db/db-connect.php'; 

									$q_idea_cat = "SELECT * FROM mj_fund_category";
									$rslt_idea = mysql_query($q_idea_cat);

									while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
										
										echo '<option value="'.$rowIdCat->fund_cat_id.'">'.ucwords($rowIdCat->fund_cat_name).'</option>';
									}

									?>
								</select><br/>
								<textarea name="businessModel" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 02 :: Customer & Market</a></h3>
							<div>
								<p>(Please detail out the value proposition to the customer, target industry, marketing strategy, the benefit relative to the price, estimated size of customer market, current customer base (if any) and/or examples of ready customers for the idea)</p>
								<p>
								<textarea name="customerMarket" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 03 :: Market Access & Timing</a></h3>
							<div>
								<p>(Please detail out the estimated market acceptance and access, current customer practice, potential or existing competitors and analysis, current or potential substitutes to the product/services, competing or emerging technologies, and why you think that this is the correct time to launch the idea.)</p>
								<p>
								<textarea name="accessTiming" class="full"></textarea>
								</p>

							</div>
							<h3><a href="#">Section 04 :: Economic trends</a></h3>
							<div>
								<p>(Please detail out the relevant economic trends that would affect the commercial viability of the idea locally, regionally and internationally, i.e consumer market trends, economic growth, disposable income of customers, spending patterns of the customer base, etc.)</p>
								<p>
								<textarea name="economicTrends" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 05 :: Technology Development & Innovation</a></h3>
							<div>
								<p>(Please detail out and highlight what technology you will be creating / adapting / innovating / inventing with the funding, and list out all the technical modules/sections/parts for your product / service that will be developed/delivered as well as the relevant technology trends that would affect the viability of the idea, i.e new competing technology, new research findings, technology investment focus, etc.)</p>
								<p>
								<textarea name="techDevinnovation" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 06 :: Intellectual Property & Regulation</a></h3>
							<div>
								<p>(Please detail out, as far as you know, any rules, regulations, licensing, incentives, monopolies, governing bodies and laws that impact the idea. Specify if there's any Intellectual Property advantage or barriers, patents, copyright, trademarks, standards, certifications that can be applied to your idea.)</p>
								<p>
								<textarea name="ipRegulation" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 07 :: Stage of the Industry & Future Plans</a></h3>
							<div>
								<p>(Please detail out the stage of the Industry, i.e. whether it is still growing or shrinking, estimated acceptance of industry and market to the idea within the next 3-5 years (with reasons to support your belief), and suitability of timing for exploitation of opportunity.)
								</p>
								<p>
								<textarea name="industryFuture" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 08 :: Deliverables for Idea Development</a></h3>
							<div>
								<p>(Please specify what the deliverables are for the development of the idea (i.e. Proof of Concept, Business Plan) in relation to the size of the funding requested and within a duration of 3 to 6 months, and then set out the milestones (not more than 3) involved, together with KPIs)
								</p>
								<p>
								<textarea name="ideaDevelopment" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 09 :: Size of Funding and Milestones</a></h3>
							<div>
								<p>(Please detail out size of funding required and a simple cash flow breakdown for the utilization of funding.)</p>
								<p>
								<label>Project Budget</label><br/>
								<input type="text" class="title" name="project_budget" /><br/>
								<label>Cash Flow Breakdown</label><br/>
								<textarea name="FundingMilestones" class="full"></textarea>
								</p>
							</div>
							<h3><a href="#">Section 10 :: Prototype / Visualization / Video / Photo</a></h3>
							<div>
								<strong>*MP4/H.264, Baseline profile, 480x360 or 640x480, WebM or Ogg</strong><br/>
						<input type="file" name="pro_cover_vid" id="pro_cover_vid" /><br/><br/>

						<p>
						<strong>Picture(s) for more visual</strong><br/>
						<input type="file" name="pro_cover_img" id="pro_cover_img" /><br/>
						</p>

						<p>
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
							<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
							</div>
						</div>

						<p>
							<h2>Have everything clear?</h2>
							<input type="submit" name="submitProposal" value="Get funding now" />
						</p>

						</form>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="mojo-copyright">
		<div class="mojo-footer-subcontainer container_24">
			<div class="grid_4">
				<p>Mojo &copy; <?php echo date('Y'); ?></p>
			</div>
			<div class="mj-footer-link grid_20 omega">
				<p><a href="#">Privacy</a> &middot; <a href="#">Term</a> &middot; <a href="#">Help</a></p>
			</div>
			<div class="clear"></div>
		</div>
</div><!-- /copyright -->

<script type="text/javascript">
$(document).ready(function(){
	

	// Accordian
	$( "#accordion" ).accordion({

			collapsible: true

	});


});
</script>
</body>
</html>