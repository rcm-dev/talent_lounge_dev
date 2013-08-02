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



$usr_id = (int) sqlInjectString($_GET['id']);




?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">My Inbox</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div class="post-status none">
						
					<form action="#" method="get" accept-charset="utf-8">

						<div>
							<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
						</div>	

					</form><!-- post-status-form -->
					
				</div><!-- /.post-status -->

				

			</div>

			<strong>My Inbox</strong>
			<div class="white" style="border-top:0px solid #cccccc; padding:10px; margin-top:10px;">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<?php  


					/**
					 * User MEssage View
					 */


					$sMsg = "SELECT
					  mj_message.msg_thread_id As threadingID,
					  mj_message.msg_body As Msg,
					  mj_message.msg_status As msgStatus,
					  mj_message.msg_recieved_date As msgTime,
					  mj_message.msg_id As msgID,
					  mj_users.usr_name As Sender,
					  mj_users.user_pic As SenderPic
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
						<div class="left" style="margin-right: 10px;">
							<div class="profile-pic48">
								<img src="<?php echo $rowsMsg->SenderPic; ?>" width="48px" />
							</div>
						</div>
						<div class="msg-sender left" style="border:0px solid red; width: 480px;">
							<strong><?php echo ucwords($rowsMsg->Sender); ?></strong><br/>
							<?php echo shortMsg($rowsMsg->Msg); ?>
						</div>
						<div class="left">
							<span style="font-size:11px; color:#8E8C8D"><?php echo time_since($rowsMsg->msgTime); ?></span>
						</div>
						<div class="clear"></div>
					</div>
					</a>

					<?php  

						}

						echo "</div>";

						echo '<input type="hidden" name="server" id="server" value="'.$server.'">';


					}

					?>
				</div>

				<!-- /CHange Action -->

			</div>


		</div><!-- /orange left -->

		<!-- sidebar-connect n share -->

		<?php include 'sidebar-social.php'; ?>

		<!-- /sidebar-connect n share -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />
<!-- /get current email -->

<script type="text/javascript">
$(document).ready(function(){

	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
	/* /current email */


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

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>