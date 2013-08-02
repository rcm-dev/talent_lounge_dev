<?php  


/**
 * User MEssage View
 */



include '../db/db-connect.php';
//include '../session_checking.php';
include '../class/short.php';

$usr_id = $_GET['id'];


echo "<h2 class=\"title\">inbox</h2>";




$sMsg = "SELECT
  mj_message.msg_thread_id As threadingID,
  mj_message.msg_body As Msg,
  mj_message.msg_status As msgStatus,
  mj_message.msg_id As msgID,
  mj_users.usr_name As Sender
From
  mj_message Inner Join
  mj_users On mj_message.msg_by_usr_id_fk = mj_users.usr_id
Where
  mj_message.msg_to = '$usr_id'
Group By
  mj_message.msg_thread_id
Order By
  mj_message.msg_id Desc";

$rsMsg = mysql_query($sMsg);
$norowsMsg = mysql_num_rows($rsMsg);



if ($norowsMsg == 0) {

	echo "You dont have any message yet.";

} else {


	echo '<div class="msg-container">';

	while ($rowsMsg = mysql_fetch_object($rsMsg)) {


	if ($rowsMsg->msgStatus != 0) {
		
		$status = 'unread';
	} else {
		$status = 'read';
	}
?>

<a href="readmessage.php?msgid=<?php echo $rowsMsg->msgID ?>&threadID=<?php echo $rowsMsg->threadingID; ?>&cuid=<?php echo $usr_id; ?>&action=read#replay-message" id="<?php echo $rowsMsg->msgID ?>" class="rowMsgView" id="<?php echo $rowsMsg->msgID; ?>">
<div class="msg-row <?php echo $status; ?>">
	<div class="msg-sender">
	<strong><?php echo ucwords($rowsMsg->Sender); ?></strong><br/>
	<?php echo shortMsg($rowsMsg->Msg); ?></div>
	<div class="clear"></div>
</div>
</a>

<?php  

	}

	echo "</div>";

	echo '<input type="hidden" name="server" id="server" value="'.$server.'">';


}

?>



<script type="text/javascript">
$(document).ready(function(){
	
	/*$('.rowMsgView').live('click', function(){
	
		var ID = $(this).attr("id");

		$(this).fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});

		return false;

	});*/

	$('.rowMsgView').fancybox({

		'width'				: '50%',

		'height'			: '75%',

		'autoScale'			: false,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'type'				: 'iframe'

	});


});
</script>