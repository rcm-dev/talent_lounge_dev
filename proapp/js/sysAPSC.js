$(document).ready(function(){


  // function selection
  // =======================================
  function rowcolumnselection(rowNumber) {

    // ============================================= MAIN COLUMN 1 ================================================
    $('select#rowAPSC'+rowNumber+'col1').live('change', function(){

      var rc1Value = $('select#rowAPSC'+rowNumber+'col1').val();


      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      // ========================================== EMPAT ====================================
      if (rc1Value == '4') {

        $('select#rowAPSC'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowAPSC'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="2"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowAPSC'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowAPSC'+rowNumber+'col2').val();


          if (rc2Value == '3' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowAPSC'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowAPSC'+rowNumber+'col3').val();

          if (rc3Value == '2' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '3' && rc1Value == '4') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };





      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      // ========================================== TIGA ====================================
      if (rc1Value == '3') {

        $('select#rowAPSC'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowAPSC'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="2"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowAPSC'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowAPSC'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowAPSC'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowAPSC'+rowNumber+'col3').val();

          if (rc3Value == '2' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '3') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };



      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      // ========================================== DUA ====================================
      if (rc1Value == '2') {

        $('select#rowAPSC'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowAPSC'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="1"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowAPSC'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowAPSC'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '3' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '1' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowAPSC'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowAPSC'+rowNumber+'col3').val();

          if (rc3Value == '3' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '1' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '2') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };




      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      // ========================================== SATU ====================================
      if (rc1Value == '1') {

        $('select#rowAPSC'+rowNumber+'col2 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc1Value+'"]').remove();
        $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc1Value+'"]').remove();


        $('select#rowAPSC'+rowNumber+'col1 option[value="4"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="3"]').remove();
        $('select#rowAPSC'+rowNumber+'col1 option[value="2"]').remove();



        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        // ============ SELECT COL2 =============================
        $('select#rowAPSC'+rowNumber+'col2').live('change', function(){

          var rc2Value = $('select#rowAPSC'+rowNumber+'col2').val();


          if (rc2Value == '4' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '3' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();

          };

          if (rc2Value == '2' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col3 option[value="'+rc2Value+'"]').remove();
            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc2Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col2 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col2 option[value="1"]').remove();
          };

        });



        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        // ============ SELECT COL3 =============================
        $('select#rowAPSC'+rowNumber+'col3').live('change', function(){

          var rc3Value = $('select#rowAPSC'+rowNumber+'col3').val();

          if (rc3Value == '3' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '2' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="4"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();

          };

          if (rc3Value == '4' && rc1Value == '1') {

            $('select#rowAPSC'+rowNumber+'col4 option[value="'+rc3Value+'"]').remove();


            // remove
            $('select#rowAPSC'+rowNumber+'col3 option[value="3"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="2"]').remove();
            $('select#rowAPSC'+rowNumber+'col3 option[value="1"]').remove();
          };

        });

      };



      // ========================================== RESET ====================================
      // ========================================== RESET ====================================
      // ========================================== RESET ====================================
      // ========================================== RESET ====================================

      if (rc1Value == '0') {

        $('select#rowAPSC'+rowNumber+'col1').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowAPSC'+rowNumber+'col2').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowAPSC'+rowNumber+'col3').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
        $('select#rowAPSC'+rowNumber+'col4').html('<option value="0">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>');
      };

    });

  }




  // function sum all row at column 
  // =======================================
  function sumAllCol(columnNumber) {


    var row1  = parseInt($('select#rowAPSC1col'+columnNumber).val());
    var row2  = parseInt($('select#rowAPSC2col'+columnNumber).val());
    var row3  = parseInt($('select#rowAPSC3col'+columnNumber).val());
    var row4  = parseInt($('select#rowAPSC4col'+columnNumber).val());
    var row5  = parseInt($('select#rowAPSC5col'+columnNumber).val());

    var row6  = parseInt($('select#rowAPSC6col'+columnNumber).val());
    var row7  = parseInt($('select#rowAPSC7col'+columnNumber).val());
    var row8  = parseInt($('select#rowAPSC8col'+columnNumber).val());
    var row9  = parseInt($('select#rowAPSC9col'+columnNumber).val());
    var row10 = parseInt($('select#rowAPSC10col'+columnNumber).val());

    var row11  = parseInt($('select#rowAPSC11col'+columnNumber).val());
    var row12  = parseInt($('select#rowAPSC12col'+columnNumber).val());
    var row13  = parseInt($('select#rowAPSC13col'+columnNumber).val());
    var row14  = parseInt($('select#rowAPSC14col'+columnNumber).val());
    var row15  = parseInt($('select#rowAPSC15col'+columnNumber).val());

    // var row16  = parseInt($('select#rowAPSC16col'+columnNumber).val());
    // var row17  = parseInt($('select#rowAPSC17col'+columnNumber).val());
    // var row18  = parseInt($('select#rowAPSC18col'+columnNumber).val());
    // var row19  = parseInt($('select#rowAPSC19col'+columnNumber).val());
    // var row20 = parseInt($('select#rowAPSC20col'+columnNumber).val());

    // var row21  = parseInt($('select#rowAPSC21col'+columnNumber).val());
    // var row22  = parseInt($('select#rowAPSC22col'+columnNumber).val());
    // var row23  = parseInt($('select#rowAPSC23col'+columnNumber).val());
    // var row24  = parseInt($('select#rowAPSC24col'+columnNumber).val());
    // var row25  = parseInt($('select#rowAPSC25col'+columnNumber).val());

    // var row26  = parseInt($('select#rowAPSC26col'+columnNumber).val());
    // var row27  = parseInt($('select#rowAPSC27col'+columnNumber).val());
    // var row28  = parseInt($('select#rowAPSC28col'+columnNumber).val());
    // var row29  = parseInt($('select#rowAPSC29col'+columnNumber).val());
    // var row30 = parseInt($('select#rowAPSC30col'+columnNumber).val());

    // var row31  = parseInt($('select#rowAPSC31col'+columnNumber).val());
    // var row32  = parseInt($('select#rowAPSC32col'+columnNumber).val());


    // var result = (row1+row2+row3+row4+row5+row6+row7+row8+row9+row10+row11+row12+row13+row14+row15+row16+row17+row18+row19+row20+row21+row22+row23+row24+row25+row26+row27+row28+row29+row30+row31+row32);

    var result = (row1+row2+row3+row4+row5+row6+row7+row8+row9+row10+row11+row12+row13+row14+row15);



    return result;

  }










  // generate selection question
  // =======================================
  for (var i = 1; i < 16; i++) {

    rowcolumnselection(i);

  };












  // generate result
  // =======================================
  $('input#getresult').live('click', function() {


    for (var i = 1; i < 5; i++) {
      $('span#allCol'+i).text(sumAllCol(i));
      $('input#allAPSCCol'+i).val(sumAllCol(i));

      console.log(sumAllCol(i));
    };


  });



  });