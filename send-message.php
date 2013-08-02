<?php  

include 'header-plain.php';


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


$friendID = (int) sqlInjectString($_GET['fid']);

$sqlFID = "SELECT * FROM mj_users WHERE usr_id = '$friendID'";
$resultFID = mysql_query($sqlFID);
$rowFID = mysql_fetch_object($resultFID);

?>

<!-- send message -->
<div id="messageerror" class="error none">Enter your message</div>

<div id="send-msg-container">
	<div id="message-send" style="height: 200px;">
		<form id="form-message" method="post">
			<table>
				<tbody>
					<tr>
						<td>To</td>
						<td>:</td>
						<td><strong><?php echo ucfirst($rowFID->usr_name); ?></strong></td>
					</tr>
					<tr><td colspan="3">&nbsp;</td></tr>
					<tr>
						<td>Message</td>
						<td>:</td>
						<td><textarea name="sendmessagebody" id="sendmessagebody" style="height:90px;"></textarea></td>
					</tr>
					<tr><td colspan="3">&nbsp;</td></tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="submit" value="Send Message" id="sm-button" class="button green" />
						<input type="hidden" name="messageto" id="messageto" value="<?php echo $friendID; ?>" />
						<input type="hidden" name="messageby" id="messageby" value="<?php echo $_GET['messageby']; ?>" /></td>
					</tr>
				</tbody>
			</table>
		</form>
		<div id="messagesent" class="success none">Message Sent</div>
	</div>
</div>

<!-- /send message -->


<script>
$(document).ready(function(){

	$('body').addClass('minBody');

	$('#sm-button').click(function(){

		var messagebody = $('#sendmessagebody').val();

		if (messagebody == '') {
			$('#messageerror').fadeIn();
		}
		else {

			var dataString = $('form#form-message').serialize();


			$.ajax({

				url: "ajax/send-message.php",
				type: "POST",
				data: dataString,

				success: function(){

					$('form#form-message').hide();
					$('#messageerror').hide();
					$('#messagesent').fadeIn();

				}

			});

			//console.log(dataString);
		}

		return false;
	});

});

</script>


<?php  

include 'footer-plain.php';

?>