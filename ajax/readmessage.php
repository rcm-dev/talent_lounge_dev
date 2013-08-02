<?php  


#include everything
require '../db/db-connect.php';
include '../class/time.php';

#get msgID
$msgID = $_GET['msgid'];


#view message
$viewMessage = "SELECT
  mj_message.msg_body As MessageBody,
  mj_users.usr_name As senderName,
  mj_message.msg_recieved_date As msgReceived,
  mj_users.user_pic As senderPicture
From
  mj_message Inner Join
  mj_users On mj_message.msg_to = mj_users.usr_id
Where
  mj_message.msg_id = '$msgID'
Group By
  mj_message.msg_thread_id = 1, mj_message.msg_recieved_date
Order By
  mj_message.msg_recieved_date Desc";


$resultviewMessage = mysql_query($viewMessage);

echo '<ul>';

while ($rowmsgThread = mysql_fetch_object($resultviewMessage)) {
	
?>


<li>
<div style="border:1px solid blue">

	<div style="border:1px solid green; float:left">
		<?php echo $rowmsgThread->senderPicture; ?>
	</div>

	<div style="border:1px solid green; float:left">
		<div><strong><?php echo $rowmsgThread->senderName; ?></strong>
		<?php echo time_since($rowmsgThread->msgReceived); ?>
		</div>
		<div><?php echo $rowmsgThread->MessageBody; ?></div>
	</div>
	<div style="clear:both"></div>
</div>

</li>



<?php  

}

echo '</ul>';

?>