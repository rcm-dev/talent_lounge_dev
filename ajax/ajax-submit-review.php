
<form action="#" method="post" id="formReview" accept-charset="utf-8">

	<table width="350">
		<tbody>
			<tr>
				<td >Name</td>
				<td>:</td>
				<td>
					<span id="currusrid"></span>
					<span id="dataName"></span></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>Review</td>
				<td>:</td>
				<td><textarea name="reviewBody" id="reviewBody" placeholder="Your review..." cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
				<input type="hidden" name="marketIdFK" id="marketIdFK" value="" />
				<input type="submit" name="submitReview" id="submitReview" value="Submit" /></td>
			</tr>
		</tbody>
	</table>

</form>	

<div id="succReview" class="none">
	Thanks you.
</div><!-- / -->


<script type="text/javascript">

$(document).ready(function(){


	var usr_id         = $('#submitReview').attr('rel');
	var usr_name       = $('#submitReview').attr('name');
	var marketID       = $('#submitReview').attr('market-id');
	
	var currusrid      = $('#currusrid').append('<input type="hidden" name="currusrid" value="'+usr_id+'">');
	var dataName       = $('#dataName').append(usr_name);
	var marketIdFK	   = $('#marketIdFK').val(marketID);


	/* submit review */
	$('input#submitReview').click(function(){

		var revName    = $('#reviewName').val();
		var revBody    = $('#reviewBody').val();

		if (revBody == '') {

			alert('Enter your review..');

		} else {

			var dataString = $('form#formReview').serialize();

			$.ajax({

				url: 'ajax/ajax-review-submited.php',
				type: 'POST',
				data: dataString,

				success: function(){

					$('#formReview').hide();
					$('#succReview').fadeIn();
					$.jnotify("Your Review has been Submitted");
				}

			});

		}

		//console.log('clicked');
		//console.log(dataString);
		return false;

	});

});


</script>