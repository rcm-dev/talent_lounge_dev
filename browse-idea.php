<?php  


include 'header.php';
include 'db/db-connect.php';

$qRandIdea		=	"SELECT
  mj_idea_post.id_pictures As Picture,
  mj_idea_post.id_post_id As picId,
   mj_idea_post.id_title As ideaTitle,
  mj_idea_post.id_desc
From
  mj_idea_post
Order By RAND()
LIMIT 12";

$rqRandIdea	=	mysql_query($qRandIdea);

//$rowqRandIdea = mysql_fetch_object($rqRandIdea);


?>


<div id="content" class="">
	
	<div id="contentContainer">

		<div class="heading">
			<h1 class="">Invent &amp; Influence</h1>
		</div>

		<div class="cnscontainer left">

			<div id="inventcontent" class="post-status" style="padding:10px">


				<div style="padding: 10px;">
					<h3>Current Submission</h3>
				</div>

				<div>
					<ul class="idea-new-ui">
					<?php while ($rowqRandIdea = mysql_fetch_object($rqRandIdea)) { ?>
						<li>
						<a class="call-inventcat" href="idea-details.php?id=<?php echo $rowqRandIdea->picId; ?>" rel="<?php echo $rowqRandIdea->picId; ?>">

							<div style="border:0px solid red; overflow: hidden; width: 150px; height:120px;">

								<img src="<?php echo $rowqRandIdea->Picture; ?>" width="150" original-title="<?php echo $rowqRandIdea->ideaTitle; ?>">
							</div>

						</a>

						</li>
					<?php } ?>
						<div class="clear"></div>
					</ul>
				</div>
				
				<div>
					<div class="idea-video none">
						<div class="idea-video-container">
						<a href="idea-details.php?id=<?php //echo $rowqRandIdea->picId; ?>"><img src="<?php //echo $rowqRandIdea->Picture; ?>"></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /cnscontainer -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Recommended for you</strong>
		</div><!-- /orange right -->

		<div class="clear"></div>
	</div><!-- /contentContainer -->

</div><!-- /content -->

<script type="text/javascript">
$(document).ready(function(){
	
	$('#star').raty({
	  click: function(score, evt) {
	    alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
	  }
	});


	/*-------------------------------------------------------------------*/
	/* Ajax Load */

	// Message Ajax Call
	$.ajaxSetup ({
		cache: false
	});

	var ajax_load = "<img src='images/ajax-loader.gif' alt='loading..' />";

	// Load invent cat function
	var inventcat_url	  = "ajax/ajax-inventcategory.php";
	$('#call-inventcat').click(function(){
		$('#inventcontent').html(ajax_load).load(inventcat_url);
	});

	// Load invent vote function
	var invote_url	  = "ajax/ajax-inventvote.php";
	$('#call-inventvote').click(function(){
		$('#inventcontent').html(ajax_load).load(invote_url);
	});

	// Load invent sub function
	var invsub_url	  = "ajax/ajax-inventsubmit.php";
	$('#call-inventsubmit').click(function(){
		$('#inventcontent').html(ajax_load).load(invsub_url);
	});


	/*-------------------------------------------------------------------*/




	/* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>