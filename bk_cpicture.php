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
			<h1>Your Contribute</h1>
		</div>

		<div class="left cnscontainer">

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<form action="upload_preview.php" method="post" accept-charset="utf-8">
						<strong>Change Picture</strong><br>
						
						<input id="file_upload" type="file" name="file_upload" />

						<input type="hidden" name="currUserID" id="currUserID" value="<?php echo $usr_id; ?>" /><br><br>

					</form>


					<p>



					<div id="mediaview">

					</div>
				</div>

				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<strong>Clear Step</strong><br><br>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div><!-- /orange right -->

		<div class="clear"></div>


	</div><!-- /contentContainer -->

</div><!-- /content -->
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("a#example1").fancybox({
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9

	});


	$('#editProfile').fancybox({
		'titlePosition'		: 'inside',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none'
	});

	$('label').css('display', 'block');


	/*$('.network-left').hover(function(){
		
		$('#user-settings').fadeIn();

	}, function(){
		
		$('#user-settings').fadeOut();

	});*/

	/* Change services */
	$('#currSector').change(function(){

		var sectorID = $(this).val();
	

		$('#currServices').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


	$('#file_upload').uploadify({
		'fileTypeDesc'	: 'Image Files',
		'fileTypeExts'	: '*.gif; *.jpg; *.png',
	    'swf'  			: 'uploadify/uploadify.swf',
	    'uploader'    	: 'uploadify/uploadify.php',
	    'folder'    	: 'uploads/avatar',
	    'multi'		: false,
	    'auto'      : true,

	    'onQueueFull': function(event, queueSizeLimit) {
			//alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},

		'onComplete': function(event, ID, fileObj, response, data) {
			// you can use here jQuery AJAX method to send info at server-side.
			$.post("ajax/picture-changed.php", { name: fileObj.name, currUserID: $('#currUserID').val() }, function(info) {
				//alert(info); // alert UPLOADED FILE NAME
			});
		},

	    'onAllComplete' : function(event,data) {
	      $('#mediaview').html('loading..').load('currentProfilePicture.php?id='+$('#currUserID').val());
	    }

	  });

	$('#mediaview').load('currentProfilePicture.php?id='+$('#currUserID').val());

});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>