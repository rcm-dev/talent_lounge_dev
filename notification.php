<?php  


include 'header.php';
include 'db/db-connect.php';

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

// ==================================================================
//
// Set notification 0
//
// ------------------------------------------------------------------

$sqlSetNotification = "UPDATE mj_notification SET noti_status = 0 WHERE noti_to_usr_id = '$usr_id'";
$resultNoti = mysql_query($sqlSetNotification);


?>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
	<div id="contentContainer" >

		<div class="heading">
			<h1 class="heading_title bebasTitle">Notification Center</h1>
		</div>

		<div class="left cnscontainer">

			
			<div style="border:0px solid green;">
				
				<div>
						
					<input type="hidden" name="currID" id="currID" value="<?php echo $usr_id; ?>" />
					
				</div><!-- /.post-status -->

					
				<div class="connectTab none" style="text-align: left; border:0px solid red">
					<div id="tabmenu">
						<a href="#">
						Notification<span></span>
						</a>

						<a href="#">
						Idea Section<span></span>
						</a>

						<a href="#">
						Project Section<span></span>
						</a>

						<a href="#">
						Insert Free Ads<span></span>
						</a>

					</div>
				</div>

				

			</div>

			<div class="white" style="border-top:0px solid #cccccc; padding:10px">
				
				<!-- CHange Action -->

				<div id="connect-container">
					<div id="loadContainer">
						
					</div>
				</div>

				<!-- /CHange Action -->
			</div>


		</div><!-- /orange left -->

		<div class="right" style="border:0px solid orange; width: 240px; padding: 5px;">
			<div class="none">
				<strong id="mojoProcess">Clear Step</strong><br><br>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div><!-- / -->

			<!-- sidebar-connect n share -->

			<?php include 'sidebar-social.php'; ?>

			<!-- /sidebar-connect n share -->
			
		</div><!-- /orange right -->

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

	$('#tabmenu').find('> a#nstream').addClass('tabuiactive');

	$('#call-friends').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#psetting').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#nstream').click(function(){
		
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#call-message').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$('#s-network').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});

	$('#s-network').click(function(){
		
		$('#nstream').removeClass('tabuiactive');
		$('#call-network').removeClass('tabuiactive');
		$('#psetting').removeClass('tabuiactive');
		$('#call-message').removeClass('tabuiactive');
		$('#call-friends').removeClass('tabuiactive');
		$(this).addClass('tabuiactive');

	});


	/* Status update */
	$('#btnstatusupdate').click(function(){
		
		var value = $('#statusupdate').val();

		if (value == "") {
			
			alert('What\'s going on..?');

		} else {


			var statusupdate = $('#statusupdate').val();
			var currID 		 = $('#currID').val();
			var ajax_load    = "<img src='images/ajax-loader.gif' alt='loading..' />";

			dataString = 'statusupdate='+statusupdate+'&currID='+currID;

			
			/* post ajax */
			$.ajax({
			

				type: "POST",
				url: "ajax/ajax-statusupdate.php",
				data: dataString,
				cache: false,

				success: function(){


					// var url 		= 'network.php?nid='+viewnetwork;
					// var urlclass	= url+' .nw-contribbute-'+currentWallID;

					$('#statusupdate').val("");
					$('#connect-container #loadstream').html(ajax_load).load('ajax/ajax-stream.php?id='+currID);
					// $('.nw-contribbute-'+currentWallID).load(urlclass);
					// console.log(urlclass);
					console.log(dataString);
				}

			});

		}

		return false;

	});


	// load default notification
	var ajax_load    = "<img src='images/ajax-loader.gif' alt='loading..' />";
	var currID 		 = $('#currID').val();
	$('#loadContainer').html(ajax_load).load('ajax/ajax-user-notification.php?id='+currID);

	//$('body').anchorCloud();


	/*friend approved*/
	$('a.friendApproved').live('click', function(){

		var friendID   = $(this).attr('id');
		var approvedBy = $(this).attr('data-friend');

		$.ajax({

			url: "ajax/friend_approved.php",
			data: 'approveUsrID='+friendID+'&approvedBy='+approvedBy,
			type: "POST",

			success:function(html){

				var hideDiv = 'div#'+friendID+'.action';
				$(hideDiv).hide();
				//$('div.action').find('div#'+friendID+'.afterAction').fadeIn().append(html);
				$('span#'+friendID+'.fstatus').html(html);
				console.log(html);
				//console.log(hideDiv);
			}

		});

		return false;

		//console.log('friendID = '+friendID+' &approvedBy = '+approvedBy);

	});



	/*Group approved*/
	$('a.groupApproved').live('click', function(){

		var friendID   = $(this).attr('id');
		var approvedBy = $(this).attr('data-group');

		$.ajax({

			url: "ajax/group_approved.php",
			data: 'approvedBy='+friendID+'&groupidfk='+approvedBy,
			type: "POST",

			success:function(html){

				var hideDiv = 'div#'+friendID+'.action';
				$(hideDiv).hide();
				//$('div.action').find('div#'+friendID+'.afterAction').fadeIn().append(html);
				$('span#'+approvedBy+'.gstatus').html(html);
				console.log(html);
				//console.log(hideDiv);
			}

		});

		return false;

		//console.log('friendID = '+friendID+' &approvedBy = '+approvedBy);

	});





});
</script>

<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>