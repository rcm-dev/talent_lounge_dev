<?php  


/**
 * User network View
 */



include '../db/db-connect.php';
//include '../session_checking.php';
$usr_id = $_GET['id'];

//echo "<h2 class=\"title\">Group</h2>";

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
	
	<div>

		<div id="groupHeading" class="">
			<div class="left"><strong>Group</strong></div>
			<div class="right">
				<a href="#" class="plusnetwork network-ethernet_color" title="Create Network">
					Create Group</a></div>
			<div class="clear"></div>
		</div><!-- /groupHeading -->

		<div class="new-network none">
			<form method="post" action="#">
			  <table width="600" border="0" align="center">
			    <tr>
			      <td width="23">Group Name </td>
			      <td width="13">:</td>
			      <td width="442"><input type="text" name="networkname" id="networkname" class="title" /></td>
			    </tr>
			    <tr>
			      <td>Description</td>
			      <td>:</td>
			      <td><label for="networkDes"></label>
			      <textarea name="networkDes" id="networkDes" cols="45" rows="5"></textarea></td>
			    </tr>
			    <tr>
			      <td>&nbsp;</td>
			      <td>&nbsp;</td>
			      <td><input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id; ?>" />
			        <input type="submit" name="subnetwork" id="subnetwork" class="button green" value="New Network" /></td>
			    </tr>
			  </table>
			</form>
		</div><!-- /new network -->

		<div id="" class="clear">
			
		</div><!-- / -->

	</div>
	<br/>
	

	<div style="border:0px solid red;">
		<?php  

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
		<div id="networkviewmain" class="left" style="border:0px solid red">
			<ul class="groupColumn">
				<?php while($rowGroupJoin = mysql_fetch_object($resultSelectGroup)) { ?>
				<li>
				<a id="<?php echo $rowGroupJoin->NetID; ?>" href="#" class="networkview" rel="<?php echo $usr_id; ?>"><?php echo $rowGroupJoin->NetworkJoinName; ?></a>
				</li>
				<?php } ?>
			</ul>
		</div>

		<div class="clear"></div>
		<div id="load-network">

			<h3 style="margin-top:10px; font-weight:bold;">Total Group Joined</h3>
		</div><!-- /load-network -->

	</div>

	<div class="clear"></div>

	<div id="network-view-container">

	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){

	
	$('#subnetwork').click(function(){

		var networkName = $('#networkname').val();
		var usr_id		= $('#usr_id').val();
		var netDesc		= $('#networkDes').val();
		
		if (networkName == '' && netDesc == '') {
		
			//alert('Enter New network name and Description');
			$.jnotify("Enter New network name and Description", "error");
			
		} else {
			
			$.ajax({
		

				type: "POST",
				url: "ajax/ajax-create-network.php",
				data: 'networkName=' + networkName + '&usr_id=' + usr_id + '&netDesc=' + netDesc,
				cache: false,

				success: function(response){

					// if (response == 1) {

						$('#networkname').val("");
						$('#networkDes').val("");
						$('.new-network').fadeOut(800);

						console.log('perfect');
						$('#networkviewmain').load('ajax/user-network.php?id='+usr_id+' #networkviewmain');
						$.jnotify("New Group Created");

					// } else {

					// 	console.log('error');
						
					// }
						
				}

			});
		}

		return false;

	});


	$('.plusnetwork').click(function(){
		
		$(this).css('cursor', 'pointer');
		$('.new-network').slideToggle(500);

		return false;

	});


	/* live click group */
	var ajax_load = "<img src='images/ajax-loader.gif' alt='loading..' />";

	$('.networkview').live('click', function(){

		var gid	    =	$(this).attr('id');
		var currid	=	$(this).attr('rel');
		console.log('click '+gid);

		$('#load-network').html(ajax_load).load('network.php?nid='+gid+'&currid='+currid);

		var link = 'network.php?nid='+gid+'&currid='+currid;
		console.log(link);
		return false;

	});

});
</script>