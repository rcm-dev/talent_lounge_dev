$(document).ready(function(){


  // function selection
  // =======================================
  function rowLEPJcolumnselection(rowNumber) {

    // ============================================= MAIN COLUMN 1 ================================================
    $('select#rowLEPJ'+rowNumber+'col1').live('change', function(){

      var rc1Value = $('select#rowLEPJ'+rowNumber+'col1').val();


      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      if (rc1Value == '4') {

        $('select#rowLEPJ'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowLEPJ'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="2"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowLEPJ'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowLEPJ'+rowNumber+'col2').val();


          if (rc2Value == '3' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowLEPJ'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowLEPJ'+rowNumber+'col3').val();

          if (rc3Value == '2' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '3' && rc1Value == '4') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };





      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      if (rc1Value == '3') {

        $('select#rowLEPJ'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowLEPJ'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="2"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowLEPJ'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowLEPJ'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowLEPJ'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowLEPJ'+rowNumber+'col3').val();

          if (rc3Value == '2' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '3') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };



      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      if (rc1Value == '2') {

        $('select#rowLEPJ'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowLEPJ'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowLEPJ'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowLEPJ'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '3' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowLEPJ'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowLEPJ'+rowNumber+'col3').val();

          if (rc3Value == '3' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '2') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };




      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      if (rc1Value == '1') {

        $('select#rowLEPJ'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowLEPJ'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowLEPJ'+rowNumber+'col1 option[value="2"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowLEPJ'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowLEPJ'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '3' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col2 option[value="1"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowLEPJ'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowLEPJ'+rowNumber+'col3').val();

          if (rc3Value == '3' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '2' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '1') {

            $('select#rowLEPJ'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowLEPJ'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowLEPJ'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };



      // ========================================== RESET ====================================
      // ========================================== RESET ====================================
      // ========================================== RESET ====================================
      // ========================================== RESET ====================================

      if (rc1Value == '0') {

        $('select#rowLEPJ'+rowNumber+'col1').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowLEPJ'+rowNumber+'col2').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowLEPJ'+rowNumber+'col3').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowLEPJ'+rowNumber+'col4').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
      };

    });

  }




  // function sum all row at column 
  // =======================================
  function sumAllLEPJCol(columnNumber) {


    var row1  = parseInt($('select#rowLEPJ1col'+columnNumber).val());
    var row2  = parseInt($('select#rowLEPJ2col'+columnNumber).val());
    var row3  = parseInt($('select#rowLEPJ3col'+columnNumber).val());
    var row4  = parseInt($('select#rowLEPJ4col'+columnNumber).val());
    var row5  = parseInt($('select#rowLEPJ5col'+columnNumber).val());

    var row6  = parseInt($('select#rowLEPJ6col'+columnNumber).val());
    var row7  = parseInt($('select#rowLEPJ7col'+columnNumber).val());
    var row8  = parseInt($('select#rowLEPJ8col'+columnNumber).val());
    var row9  = parseInt($('select#rowLEPJ9col'+columnNumber).val());
    var row10 = parseInt($('select#rowLEPJ10col'+columnNumber).val());

    // var row11  = parseInt($('select#rowLEPJ11col'+columnNumber).val());
    // var row12  = parseInt($('select#rowLEPJ12col'+columnNumber).val());
    // var row13  = parseInt($('select#rowLEPJ13col'+columnNumber).val());
    // var row14  = parseInt($('select#rowLEPJ14col'+columnNumber).val());
    // var row15  = parseInt($('select#rowLEPJ15col'+columnNumber).val());

    // var row16  = parseInt($('select#rowLEPJ16col'+columnNumber).val());
    // var row17  = parseInt($('select#rowLEPJ17col'+columnNumber).val());
    // var row18  = parseInt($('select#rowLEPJ18col'+columnNumber).val());
    // var row19  = parseInt($('select#rowLEPJ19col'+columnNumber).val());
    // var row20 = parseInt($('select#rowLEPJ20col'+columnNumber).val());

    // var row21  = parseInt($('select#rowLEPJ21col'+columnNumber).val());
    // var row22  = parseInt($('select#rowLEPJ22col'+columnNumber).val());
    // var row23  = parseInt($('select#rowLEPJ23col'+columnNumber).val());
    // var row24  = parseInt($('select#rowLEPJ24col'+columnNumber).val());
    // var row25  = parseInt($('select#rowLEPJ25col'+columnNumber).val());

    // var row26  = parseInt($('select#rowLEPJ26col'+columnNumber).val());
    // var row27  = parseInt($('select#rowLEPJ27col'+columnNumber).val());
    // var row28  = parseInt($('select#rowLEPJ28col'+columnNumber).val());
    // var row29  = parseInt($('select#rowLEPJ29col'+columnNumber).val());
    // var row30 = parseInt($('select#rowLEPJ30col'+columnNumber).val());

    // var row31  = parseInt($('select#rowLEPJ31col'+columnNumber).val());
    // var row32  = parseInt($('select#rowLEPJ32col'+columnNumber).val());


    // var result = (row1+row2+row3+row4+row5+row6+row7+row8+row9+row10+row11+row12+row13+row14+row15+row16+row17+row18+row19+row20+row21+row22+row23+row24+row25+row26+row27+row28+row29+row30+row31+row32);

    var result = (row1+row2+row3+row4+row5+row6+row7+row8+row9+row10);



    return result;

  }










  // generate selection question
  // =======================================
  for (var i = 1; i < 11; i++) {

    rowLEPJcolumnselection(i);

  };












  // generate result
  // =======================================
  $('input#getresultLEPJ').live('click', function() {


    for (var i = 1; i < 5; i++) {
      $('span#allLEPJCol'+i).text(sumAllLEPJCol(i));
      console.log(sumAllLEPJCol(i));
    };


  });



  });