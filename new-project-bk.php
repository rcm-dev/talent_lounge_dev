<h4>We're thrilled that you're interested in using Kickstarter, and we can't wait to hear about your project. Please take a few minutes to tell us about what you're raising funds to create. Thanks!</h4>

						<label>Project Title</label>
						<small>Give us your project title</small>
						<input type="text" name="pro_title" id="pro_title" class="title" /><br/>

						<label>Project Descriptions</label>
						<small>Describe your project</small>
						<textarea name="pro_desc" id="pro_desc"></textarea><br />

						<label>Product Category</label>
						<small>Which category that suitable with your project</small>
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

						<label>Budget</label>
						<small>What budget you want to start or continue</small>
						<input type="text" name="pro_budget" id="pro_budget" class="title" /><br/>

						<label>Cover of the Project</label>
						<small>Get Visual of your project</small>
						<input type="file" name="pro_cover_img" id="pro_cover_img" /><br/><br/>


						<label>Got video?</label>
						<small>Expose your project with video</small>
						<strong>*MP4/H.264, Baseline profile, 480x360 or 640x480, WebM or Ogg</strong><br/>
						<input type="file" name="pro_cover_vid" id="pro_cover_vid" /><br/>

						<p>
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
							<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
							<br/>
							<input type="submit" name="" value="SUBMIT YOUR PROPOSAL" />
						</p>