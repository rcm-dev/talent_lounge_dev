// MOJO LOGIN
$(document).ready(function(){
	

	/* Submit login button
	-------------------------------------------------------------------*/
	$('input#mojo-login').click(function(){
		

		// var login
		var loginemail 	= $('input#email').val();
		var loginpwd 	= $('input#password').val();
		var dataString	= 'email=' + loginemail + '&password=' + loginpwd;

		// checking 
		if (loginemail == '' || loginpwd == '') {
			
			
			// error display
			$('#loginstatus.error').fadeOut(400).show();
			$('#loginstatus.error').delay(3000).fadeOut('slow');


		} else {
			
			console.log(dataString);

			// submit login
			$.ajax({
				
				type: "POST",
				url: "ajaxlogin.php",
				data: dataString,

				success:function(response){
					
					if (response == 'success') {
						
						alert('success');

					} else {
						
						alert('error');

					}
				}

			});


		}

		return false;

	});


	/*-------------------------------------------------------------------*/
	/* profile window */


	$('#view-view-profile').hover(function(){
		
		$('#profile-window').fadeIn();

	}, function(){

		$('#profile-window').fadeOut();

	});


	/*-------------------------------------------------------------------*/







	/*-------------------------------------------------------------------*/
	/* Ajax Load */

	// Message Ajax Call
	$.ajaxSetup ({
		cache: false
	});

	var ajax_load = "<img src='images/ajax-loader.gif' alt='loading..' />";

	// Load Message function
	/*var msg_url	  = "ajax/user-message.php";
	$('#call-message').click(function(){
		var currid		  = $(this).attr('rel');
		$('#connect-container').html(ajax_load).load(msg_url+'?id='+currid);
	});



	// Load friends function
	var friends_url	  = "ajax/user-friends.php";
	$('#call-friends').click(function(){
		var currid		  = $(this).attr('rel');
		$('#connect-container').html(ajax_load).load(friends_url+'?id='+currid);
	});


	// Load network function
	var network_url	  = "ajax/user-network.php";
	$('#call-network').click(function(){
		var currid		  = $(this).attr('rel');
		$('#connect-container').html(ajax_load).load(network_url+'?id='+currid);
		console.log('clicked');
	});

	// Load setting function
	var setting_url	  = "ajax/user-setting.php";
	$('#psetting').click(function(){
		var currid		  = $(this).attr('rel');
		$('#connect-container').html(ajax_load).load(setting_url+'?id='+currid);
	});

	// Load stream function
	var nstream_url	  = "ajax/ajax-stream.php";
	$('#nstream').click(function(){
		var currid		  = $(this).attr('rel');
		$('#connect-container').html(ajax_load).load(nstream_url+'?id='+currid);
	});


	// Load stream function
	var snetwork_url	  = "ajax/ajax-search-network.php";
	$('#s-network').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(snetwork_url+'?id='+currid+'&currname='+currname);
		console.log(snetwork_url);
	});*/


	/*-------------------------------------------------------------------*/












	/*-------------------------------------------------------------------*/


	// Load Notification
	var loadnoti_url	  = "ajax/ajax-user-notification.php";
	$('#load-notification').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(loadnoti_url+'?id='+currid+'&currname='+currname);
		console.log(loadnoti_url);
	});

	// Load submitIdea
	var sidea_url	  = "ajax/ajax-submitidea.php";
	$('#s-idea').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(sidea_url+'?id='+currid+'&currname='+currname);
		console.log(sidea_url);
	});

	// Load Freelance
	var sidea_url	  = "ajax/ajax-submit-freelance.php";
	$('#s-freelance').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(sidea_url+'?id='+currid+'&currname='+currname);
		console.log(sidea_url);
	});

	// Load submit Project
	var sproj_url	  = "ajax/ajax-submitproject.php";
	$('#s-project').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(sproj_url+'?id='+currid+'&currname='+currname);
		console.log(sproj_url);
	});

	// Load insert free ads
	var insertads_url	  = "ajax/ajax-submitads.php";
	$('#insert-free-ads').click(function(){
		var currid		  = $(this).attr('rel');
		var currname	  = $(this).attr('data-name');
		$('#connect-container').html(ajax_load).load(insertads_url+'?id='+currid+'&currname='+currname);
		console.log(insertads_url);
	});


	/*-------------------------------------------------------------------*/


	




	/*------------ mojo default logout -------------------*/
	$('.logout').hover(function(){
		
		//alert('Are you sure you want to logout?');

		$(this).find('img.normal').fadeOut(200);

	}, function(){
		
		$(this).find('img.normal').fadeIn(200);

	});

	/* ---------------------------------------------------*/







	/* Edit profile fancy box */
	$('#editProfile').fancybox({
	    'titlePosition'   : 'inside',

	    'transitionIn'    : 'none',

	    'transitionOut'   : 'none',

	    'type'				: 'iframe'
	  });



	/* Register */
	$("#iregister").fancybox({


		'autoScale'			: false,

		'height'			: '70%',

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});


	/* login */
	$("#ilogin").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});

	/* login */
	$("#flogin").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});

	/* login */
	$("#fregister").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});


	/* login */
	$("#fregisterEmp").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});

	/* login */
	$("#iloginEmp").fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});


	/* public figure */
	$('.public').fancybox({

		'height'			: '70%',

		'autoScale'			: true,

		'transitionIn'		: 'none',

		'transitionOut'		: 'none',

		'titlePosition'   : 'none',

		'type'				: 'iframe'

	});




	/*submit quick update*/
	$('#submitPost').click(function(){

		var value = $('#updatestatus').val();

		if (value == "") {
			
			//alert('What\'s going on..?');
			$.jnotify("What's going on?", "error");

		} else {


			var statusupdate = $('#updatestatus').val();
			var currID 		 = $('#onlineUsrID').val();
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

					//$('#statusupdate').val("");
					//$('#connect-container #loadstream').html(ajax_load).load('ajax/ajax-stream.php?id='+currID);
					// $('.nw-contribbute-'+currentWallID).load(urlclass);
					// console.log(urlclass);
					$.jnotify("Your status has been updated");
					$('#updatestatus').val("");
					//console.log(dataString);
				}

			});

		}
		
		//alert('clicked!');
		return false;
	});


	/*quick live stream*/
	$('#quickPostUI').marquee({yScroll: "bottom"});



	/*send quick message*/
	$('.send-msg-btn').fancybox({
		'opacity'		: true,
		'overlayShow'	: true,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'none'

	});


	/* hovercard user profile */
	var hoverHTMLDemoAjax = '<div id="demo-cb-tweets"></div>';

    $("#quickuser").hovercard({
        detailsHTML: hoverHTMLDemoAjax,
        width: 350,
        //cardImgSrc: 'http://ejohn.org/files/short.sm.jpg',
        onHoverIn: function () {

        	// user value
            var uid = $('#quickuser').attr('data-hovercard');

            $.ajax({
                url: 'datauser.php?id='+uid,
                type: 'GET',
                dataType: 'html',
                beforeSend: function () {
                    $("#demo-cb-tweets").prepend('<p class="loading-text">Loading latest tweets...</p>');
                },
                success: function (data) {
                    $("#demo-cb-tweets").empty();
                    $("#demo-cb-tweets").append(data);
                },
                complete: function () {
                    $('.loading-text').remove();
                }
            });

        }
    });

    /* // hovercard user profile */


    // overwrite page title
    var page_title = $('#page_title').val();
    if (page_title == undefined) {
    	document.title = "Social Recruitment (Beta)";
    }
    else {
    	document.title = page_title + " - Social Recruitment (Beta)";
    }

    
});