<?php  


include 'header.php';
include 'db/db-connect.php';


$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">Groups</h1>
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

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					
					<?php  


					/**
					 * User network View
					 */

					$selectGroupJoin = "SELECT
					  mj_network.mn_name As NetworkJoinName,
					  mj_network_relation.mn_id_fk As NetID
					From
					  mj_network Inner Join
					  mj_network_relation On mj_network_relation.mn_id_fk = mj_network.mn_id
					  Inner Join
					  mj_users On mj_network_relation.usr_id_fk = mj_users.usr_id
					Where
					  mj_network_relation.usr_id_fk = '$usr_id' And
					  mj_network_relation.mnr_status = 1";

					$resultSelectGroup = mysql_query($selectGroupJoin);


					?>
					<div id="cnetwork-container">
						
						<div id="new-net">

							<span class="network-hub_color">New Network</span>
						</div>
						<div class="new-network none">
							<form method="post" action="#">
							<table>
								<tr>
									<td>Network Name
									</td>
									<td>:
									</td>
									<td><input type="text" name="networkname" id="networkname" class="title" />
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td>Description
									</td>
									<td>:
									</td>
									<td><textarea id="groupDes" name="groupDes" rows="6" cols="60"></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;
									</td>
									<td>&nbsp;
									</td>
									<td>
									<input type="submit" name="subnetwork" class="button green" id="subnetwork" value="New Network" />
									<input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id; ?>" />
									</td>
								</tr>
							</table>
							</form>
						</div>

						
						<br/>
						<div id="networkviewmain">
							<ul id="networkList">
								<?php while($rowGroupJoin = mysql_fetch_object($resultSelectGroup)) { ?>
								<li>
								<a href="viewgroup.php?nid=<?php echo $rowGroupJoin->NetID; ?>&currid=<?php echo $usr_id; ?>" class="networkview"><?php echo $rowGroupJoin->NetworkJoinName; ?></a>
								</li>
								<?php } ?>
							</ul>
						</div>

						<div id="network-view-container">

						</div>

					</div>

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

	
	$('#subnetwork').click(function(){

		var networkName = $('#networkname').val();
		var usr_id		= $('#usr_id').val();
		
		if (networkName == '') {
		
			$.jnotify("Enter network name", "error");
			
		} else {
			
			$.ajax({
		

				type: "POST",
				url: "ajax/ajax-create-network.php",
				data: 'networkName=' + networkName + '&usr_id=' + usr_id,
				cache: false,

				success: function(){


					$('#networkname').val("");
					console.log('perfect');
					$('#networkviewmain').load('#networkviewmain ul#networkList');
					$.jnotify("New Network Created!");
				}

			});
		}

		return false;

	});


	$('#new-net').click(function(){

		$('.new-network').toggle();

	});




});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>