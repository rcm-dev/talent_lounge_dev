<?php  

/**
 * 
 */
#include everything
include 'header-plain.php';
include 'class/time.php';

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
	mysql_real_escape_string(trim(htmlentities(htmlspecialchars($seoname))));

	return $seoname;
}

#get msgID
$msgID    		= (int) sqlInjectString($_GET['msgid']);
$threadID 		= (int) sqlInjectString($_GET['threadID']);
$cuid 	  		= (int) sqlInjectString($_GET['cuid']);

// ==================================================================
//
// set notification to 0 and read msg to 0
//
// ------------------------------------------------------------------
$action	  		= $_GET['action'];

$setRead  		= "UPDATE mj_message SET msg_status = 0 WHERE msg_thread_id = '$threadID'";
$resultSetRead	= mysql_query($setRead);

$setZeroNoti	= "UPDATE mj_notification SET noti_status = 0 WHERE noti_type_id_fk = 1 AND mj_type_id_id_fk = '$msgID' AND noti_to_usr_id = '$cuid'";
$resultSetRead 	= mysql_query($setZeroNoti) ;


// ==================================================================
//
// View message
//
// ------------------------------------------------------------------



#view message
$viewMessage = "SELECT
  mj_users.usr_name As senderName,
  mj_users.user_pic As senderPicture,
  mj_message.msg_recieved_date As msgReceived,
  mj_message.msg_body As MessageBody,
  mj_message.msg_recieved_date,
  mj_message.msg_id,
  mj_message.msg_by_usr_id_fk As messageBy,
  mj_message.msg_thread_id As threadviewId
From
  mj_message Inner Join
  mj_users On mj_message.msg_by_usr_id_fk = mj_users.usr_id
Where
  mj_message.msg_thread_id = '$threadID'
Group By
  mj_message.msg_recieved_date, mj_message.msg_thread_id = '$threadID',
  mj_message.msg_recieved_date, mj_message.msg_to, mj_message.msg_id
Order By
  mj_message.msg_recieved_date ASC";

$resultviewMessage  = mysql_query($viewMessage);



// ==================================================================
//
// Get 1st row message sender id
//
// ------------------------------------------------------------------
$firstRow = "SELECT
  mj_message.msg_by_usr_id_fk As messageBySenderID,
  mj_message.msg_to As messageReceivedID
From
  mj_message Inner Join
  mj_users On mj_message.msg_by_usr_id_fk = mj_users.usr_id
Where
  mj_message.msg_thread_id = '$threadID'
Group By
  mj_message.msg_recieved_date, mj_message.msg_id, mj_message.msg_thread_id =
  '$threadID', mj_message.msg_to
Order By
  mj_message.msg_recieved_date ASC
Limit 1";

$resultFirstRow           = mysql_query($firstRow);
$firstRowobject           = mysql_fetch_object($resultFirstRow);
$firstRowobjectID         = $firstRowobject->messageBySenderID;
$firstRowobjectReceivedID = $firstRowobject->messageReceivedID;


// ==================================================================
//
// HTML
//
// ------------------------------------------------------------------


echo '<div id="msgThreadContainer">';
echo "<ul>";

while ($rowmsgThread = mysql_fetch_object($resultviewMessage)) {
	
?>

<li>
<div style="border-bottom:1px solid #eee; width: 530px;">

	<div style="border:0px solid green; float:left; padding:5px;">
		<div class="profile-pic48" style="background-image: url('<?php echo $rowmsgThread->senderPicture; ?>'); background-position: top center; background-size: 100% auto; width:48px; height:48px; background-repeat: no-repeat;">
		<!-- <img src="<?php echo $rowmsgThread->senderPicture; ?>"> -->
		</div>
	</div>

	<div style="border:0px solid green; float:left; width:400px; padding:5px;">
		<div><strong><?php echo $rowmsgThread->senderName; ?></strong>
		<span style="text-align:right"><?php echo time_since($rowmsgThread->msgReceived); ?></span>
		</div>
		<div><?php echo $rowmsgThread->MessageBody; ?></div>
	</div>
	<div style="clear:both"></div>
</div>
</li>

<?php  

}

echo "</ul>";
echo '</div>';

?>
<div id="replay-message" style="background-color:#f1f1f1; padding: 10px;margin-top:20px;">
<form method="post">
	<label>Replay</label><br/>
	<textarea name="replaybody" id="replaybody" style="height: 80px;"></textarea><br/>
	<input type="submit" name="replaysubmitbtn" class="button green" id="replaysubmitbtn" value="Send Message" />

	<!-- MEssage ID --><input type="hidden" name="msgviewid" class="msgviewid" value="<?php echo $msgID; ?>">
	<!-- CurrentUserId --><input type="hidden" name="curUserId" class="curUserId" value="<?php echo $cuid; ?>" /><br/>

	<?php if ($firstRowobjectID == $cuid){ ?>
		<!-- Replay To --><input type="hidden" name="messageby" class="messageby" value="<?php echo $firstRowobjectReceivedID; ?>" /><br/>
	<?php } else { ?>

		<!-- Replay To --><input type="hidden" name="messageby" class="messageby" value="<?php echo $firstRowobjectID; ?>" /><br/>

	<?php } ?>

	<!-- Threading ID --><input type="hidden" name="threadviewId" class="threadviewId" value="<?php echo $threadID; ?>" /><br/>
</form>
</div>


<script type="text/javascript">
$(document).ready(function(){
	
	$('body').addClass('newWidth');
	$('body').addClass('white');

	

	$('#replaysubmitbtn').live('click', function(){
		
		var msgreply = $('#replaybody').val();

		if (msgreply == '') {
			
			alert('Enter some message..');

		} else {
			
			//console.log('run ajax');

			var replaybody  	= 	$('#replaybody').val();
			var messageby   	= 	$('.messageby').val();
			var curUserId   	= 	$('.curUserId').val();
			var threadviewId	= 	$('.threadviewId').val();
			var msgviewid		=	$('.msgviewid').val();

			//alert(replaybody + messageby + curUserId);

			$.ajax({
				
				type: "POST",
				url: "ajax/send-message-inbox.php",
				data: 'replaybody=' + replaybody + '&messageby=' + messageby + '&curUserId=' + curUserId + '&threadviewId=' + threadviewId,
				cache: false,

				success: function(){

					var url_to_load = 'readmessage.php?msgid='+msgviewid+'&threadID='+threadviewId+'&cuid='+curUserId;
						
					$('#replaybody').val("");
					$('#msgThreadContainer').load(url_to_load+' #msgThreadContainer');
					console.log('OK + '+url_to_load);
				
			}

		});

		}

		return false;

	});


	/* min-body */
	$('body').css('min-width','20%');


});

</script>


<?php  

#footer
include 'footer-plain.php';

?>