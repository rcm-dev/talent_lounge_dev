$(document).ready(function(){


	// function selection
	// =======================================
	function rowcolumnselectionLite(rowNumber) {

		// ============================================= MAIN COLUMN 1 ================================================
		$('select#rowLITE'+rowNumber+'col1').live('change', function(){

			var rc1Value = $('select#rowLITE'+rowNumber+'col1').val();


			// ========================================== EMPAT ====================================
			// ========================================== EMPAT ====================================
			// ========================================== EMPAT ====================================
			// ========================================== EMPAT ====================================
			if (rc1Value == '4') {

				$('select#rowLITE'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


				$('select#rowLITE'+rowNumber+'col1 option[value="3"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="2"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="1"]').remove();



				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				$('select#rowLITE'+rowNumber+'col2').live('change', function(){

					var rc2Value = $('select#rowLITE'+rowNumber+'col2').val();


					if (rc2Value == '3' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '2' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '1' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
					};

				});



				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				$('select#rowLITE'+rowNumber+'col3').live('change', function(){

					var rc3Value = $('select#rowLITE'+rowNumber+'col3').val();

					if (rc3Value == '2' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();

					};

					if (rc3Value == '1' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();

					};

					if (rc3Value == '3' && rc1Value == '4') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();
					};

				});

			};





			// ========================================== TIGA ====================================
			// ========================================== TIGA ====================================
			// ========================================== TIGA ====================================
			// ========================================== TIGA ====================================
			if (rc1Value == '3') {

				$('select#rowLITE'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


				$('select#rowLITE'+rowNumber+'col1 option[value="4"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="2"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="1"]').remove();



				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				$('select#rowLITE'+rowNumber+'col2').live('change', function(){

					var rc2Value = $('select#rowLITE'+rowNumber+'col2').val();


					if (rc2Value == '4' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '2' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '1' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
					};

				});



				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				$('select#rowLITE'+rowNumber+'col3').live('change', function(){

					var rc3Value = $('select#rowLITE'+rowNumber+'col3').val();

					if (rc3Value == '2' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();

					};

					if (rc3Value == '1' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();

					};

					if (rc3Value == '4' && rc1Value == '3') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();
					};

				});

			};



			// ========================================== DUA ====================================
			// ========================================== DUA ====================================
			// ========================================== DUA ====================================
			// ========================================== DUA ====================================
			if (rc1Value == '2') {

				$('select#rowLITE'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


				$('select#rowLITE'+rowNumber+'col1 option[value="4"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="3"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="1"]').remove();



				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				$('select#rowLITE'+rowNumber+'col2').live('change', function(){

					var rc2Value = $('select#rowLITE'+rowNumber+'col2').val();


					if (rc2Value == '4' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '3' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '1' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
					};

				});



				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				$('select#rowLITE'+rowNumber+'col3').live('change', function(){

					var rc3Value = $('select#rowLITE'+rowNumber+'col3').val();

					if (rc3Value == '3' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();

					};

					if (rc3Value == '1' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();

					};

					if (rc3Value == '4' && rc1Value == '2') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();
					};

				});

			};




			// ========================================== SATU ====================================
			// ========================================== SATU ====================================
			// ========================================== SATU ====================================
			// ========================================== SATU ====================================
			if (rc1Value == '1') {

				$('select#rowLITE'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
				$('select#rowLITE'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


				$('select#rowLITE'+rowNumber+'col1 option[value="4"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="3"]').remove();
				$('select#rowLITE'+rowNumber+'col1 option[value="2"]').remove();



				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				// ============ SELECT COL2 =============================
				$('select#rowLITE'+rowNumber+'col2').live('change', function(){

					var rc2Value = $('select#rowLITE'+rowNumber+'col2').val();


					if (rc2Value == '4' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '3' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();

					};

					if (rc2Value == '2' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col2 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col2 option[value="1"]').remove();
					};

				});



				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				// ============ SELECT COL3 =============================
				$('select#rowLITE'+rowNumber+'col3').live('change', function(){

					var rc3Value = $('select#rowLITE'+rowNumber+'col3').val();

					if (rc3Value == '3' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();

					};

					if (rc3Value == '2' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="4"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();

					};

					if (rc3Value == '4' && rc1Value == '1') {

						$('select#rowLITE'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


						// remove
						$('select#rowLITE'+rowNumber+'col3 option[value="3"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="2"]').remove();
						$('select#rowLITE'+rowNumber+'col3 option[value="1"]').remove();
					};

				});

			};



			// ========================================== RESET ====================================
			// ========================================== RESET ====================================
			// ========================================== RESET ====================================
			// ========================================== RESET ====================================

			if (rc1Value == '0') {

				$('select#rowLITE'+rowNumber+'col1').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
				$('select#rowLITE'+rowNumber+'col2').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
				$('select#rowLITE'+rowNumber+'col3').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
				$('select#rowLITE'+rowNumber+'col4').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
			};

		});

	}




	// function sum all row at column 
	// =======================================
	function sumAllColLITE(columnNumber) {


		var row1  = parseInt($('select#rowLITE1col'+columnNumber).val());
		var row2  = parseInt($('select#rowLITE2col'+columnNumber).val());
		var row3  = parseInt($('select#rowLITE3col'+columnNumber).val());
		var row4  = parseInt($('select#rowLITE4col'+columnNumber).val());
		var row5  = parseInt($('select#rowLITE5col'+columnNumber).val());

		var row6  = parseInt($('select#rowLITE6col'+columnNumber).val());
		var row7  = parseInt($('select#rowLITE7col'+columnNumber).val());
		var row8  = parseInt($('select#rowLITE8col'+columnNumber).val());
		// var row9  = parseInt($('select#row9col'+columnNumber).val());
		// var row10 = parseInt($('select#row10col'+columnNumber).val());

		// var row11  = parseInt($('select#row11col'+columnNumber).val());
		// var row12  = parseInt($('select#row12col'+columnNumber).val());
		// var row13  = parseInt($('select#row13col'+columnNumber).val());
		// var row14  = parseInt($('select#row14col'+columnNumber).val());
		// var row15  = parseInt($('select#row15col'+columnNumber).val());

		// var row16  = parseInt($('select#row16col'+columnNumber).val());
		// var row17  = parseInt($('select#row17col'+columnNumber).val());
		// var row18  = parseInt($('select#row18col'+columnNumber).val());
		// var row19  = parseInt($('select#row19col'+columnNumber).val());
		// var row20 = parseInt($('select#row20col'+columnNumber).val());

		// var row21  = parseInt($('select#row21col'+columnNumber).val());
		// var row22  = parseInt($('select#row22col'+columnNumber).val());
		// var row23  = parseInt($('select#row23col'+columnNumber).val());
		// var row24  = parseInt($('select#row24col'+columnNumber).val());
		// var row25  = parseInt($('select#row25col'+columnNumber).val());

		// var row26  = parseInt($('select#row26col'+columnNumber).val());
		// var row27  = parseInt($('select#row27col'+columnNumber).val());
		// var row28  = parseInt($('select#row28col'+columnNumber).val());
		// var row29  = parseInt($('select#row29col'+columnNumber).val());
		// var row30 = parseInt($('select#row30col'+columnNumber).val());

		// var row31  = parseInt($('select#row31col'+columnNumber).val());
		// var row32  = parseInt($('select#row32col'+columnNumber).val());


		var result = (row1+row2+row3+row4+row5+row6+row7+row8);



		return result;

	}










	// generate selection question
	// =======================================
	for (var i = 1; i < 33; i++) {

		rowcolumnselectionLite(i);

	};












	// generate result
	// =======================================
	$('input#getResultLITE').live('click', function() {


		for (var i = 1; i < 5; i++) {
			$('span#allLiteCol'+i).text(sumAllColLITE(i));
			$('input#allLiteDataCol'+i).val(sumAllColLITE(i));
			console.log(sumAllColLITE(i));
		};


	});



	});