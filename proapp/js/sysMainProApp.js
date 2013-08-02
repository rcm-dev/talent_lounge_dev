$(document).ready(function(){


	function getTopDisc()
	{
		// COMPILE ALL DATA
		// =================================
		var data = $('form#APSC_DATA').serialize();

		
		// ALL DONE
		// SEND PROCESS VIA AJAX
		// ================================
		$.ajax({
			type: "POST",
			data: data,
			url: "profile_process.php",

			success:function(html){

				$('span#discResult').text(html);
				$('input#discResult_txt').val(html);
				console.log(html);
			}

		});
	}


	function getTopPLS()
	{
		// COMPILE ALL DATA
		// =================================
		var data = $('form#LITE_DATA').serialize();

		
		// ALL DONE
		// SEND PROCESS VIA AJAX
		// ================================
		$.ajax({
			type: "POST",
			data: data,
			url: "profile_process_pls.php",

			success:function(html){

				$('span#plsResult').text(html);
				$('input#plsResult_txt').val(html);
				console.log(html);
			}

		});
	}


	function getTopCLS()
	{
		// COMPILE ALL DATA
		// =================================
		var data = $('form#XYZ_DATA').serialize();

		
		// ALL DONE
		// SEND PROCESS VIA AJAX
		// ================================
		$.ajax({
			type: "POST",
			data: data,
			url: "profile_process_cls.php",

			success:function(html){

				$('span#clsResult').text(html);
				$('input#clsResult_txt').val(html);
				console.log(html);
			}

		});
	}


	function getTopLEPJ()
	{
		// COMPILE ALL DATA
		// =================================
		var data = $('form#testAllValue').serialize();

		
		// ALL DONE
		// SEND PROCESS VIA AJAX
		// ================================
		$.ajax({
			type: "POST",
			data: data,
			url: "profile_process_lepj.php",

			success:function(html){

				$('span#lepjResult').text(html);
				$('input#lepjResult_txt').val(html);
				console.log(html);
			}

		});
	}



	$('input#showReportBtn').live('click', function(){

		getTopDisc();

		getTopPLS();

		getTopCLS();

		getTopLEPJ();

		$('div#main_test_container').hide();
		$('div#result_show').delay(2000).show('slow').slide('down');



		// DEBUG!
		// =================================
		console.log('show data ' + data);

	});


	$('input#saveNreports').live('click', function(){

		var data = $('form#resultValue').serialize();

		var cuid = $('input#user_id_tester').val();

		// data value
		var data_apsc = $('form#APSC_DATA').serialize();
		var data_lite = $('form#LITE_DATA').serialize();
		var data_xyz = $('form#XYZ_DATA').serialize();
		var data_lepj = $('form#testAllValue').serialize();


		// combined all data
		var finalDatas = data + '&' + data_apsc + '&' + data_lite + '&' + data_xyz + '&' + data_lepj;


		$.ajax({
			type: "POST",
			data: finalDatas,
			url: "save_profile_filter.php",

			success:function(html){

				$('input#saveNreports').css('btn-success');
				$('input#saveNreports').val('Result has been saved..and you will be redirect to report page..');

				setTimeout(function() { 
				    window.location = "profile_report.php?uid=" + cuid; 
				 }, 2000);

				console.log(html);
			}

		});

		console.log(finalData);

	});


	$('input#showReportBtnMain').live('click', function(){
		
		var data_apsc = $('form#APSC_DATA').serialize();
		var data_lite = $('form#LITE_DATA').serialize();
		var data_xyz = $('form#XYZ_DATA').serialize();
		var data_lepj = $('form#testAllValue').serialize();

		console.log('CLICKED! ' + data_apsc + data_lite + data_xyz + data_lepj);

	});


});