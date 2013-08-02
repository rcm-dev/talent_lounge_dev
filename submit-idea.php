<?php  


include 'header-plain.php';


?>


			<div style="width:600px">
				<h3>Submit New Idea</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
				<p>
					<form action="idea-submited.php" enctype="multipart/form-data" method="post">

					<label>Title</label>
					<small>Description of the title</small>
					<input type="text" name="idea_title" id="idea_title" class="title" />

					<label>Description</label>
					<small>Description of the title</small>
					<textarea name="idea_desc" id="idea_desc"></textarea>

					<label>Choose a Category</label>
					<small>Description of the title</small>
					<select name="idea_category">
						<?php

						include 'db/db-connect.php'; 

						$q_idea_cat = "SELECT * FROM mj_idea_category";
						$rslt_idea = mysql_query($q_idea_cat);

						while ($rowIdCat = mysql_fetch_object($rslt_idea)) {
							
							echo '<option value="'.$rowIdCat->id_cat_id.'">'.ucwords($rowIdCat->id_cat_name).'</option>';
						}

						?>
					</select>

					<label>The Problem</label>
					<small>Description of the title</small>
					<textarea name="idea_prob" id="idea_prob"></textarea>

					<label>The Solution</label>
					<small>Description of the title</small>
					<textarea name="idea_sol" id="idea_sol"></textarea>

					<label>Features</label>
					<small>Description of the title</small>
					<textarea name="idea_fea" id="idea_fea"></textarea>

					<label>Target Market / Customer / End User</label>
					<small>Description of the title</small>
					<textarea name="idea_target" id="idea_target"></textarea>


					<label>Similar Product</label>
					<small>Description of the title</small>
					<textarea name="idea_sp" id="idea_sp"></textarea>

					<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
					<label for="">Get Visuals</label>
					[Video onGoing]<br/>
					<input type="file" name="idea_file" id="idea_file" />

					<div clear></div>

					<input type="hidden" name="user_id" value="<?php echo $usr_id; ?>" />
					<input type="submit" name="idea_sub" id="idea_sub" class="right" />

					<div clear></div>
					
					</form>

				</p>
			</div>



<script type="text/javascript">

$(document).ready(function(){


	$('label, input, textarea, select').css('display', 'block');


});

</script>


<?php  

/**
 * Include Footer
 */

include 'footer-plain.php';


?>