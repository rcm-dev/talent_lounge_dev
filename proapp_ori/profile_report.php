  <?php  

//initialize the session
// if (!isset($_SESSION)) {
//    session_start();
//  }



require_once 'connection/conProApp.php';

$current_view_user_id     = (int) mysql_real_escape_string($_GET['uid']);

$queryID = "SELECT * FROM mj_users WHERE usr_id = ". $current_view_user_id;
$rsID = mysql_query($queryID) or die(mysql_error());
$row_rsID         = mysql_fetch_object($rsID);
$totalRows_rsID   = mysql_num_rows($rsID);


/**
 * Result Filter by User
 */
$query_rsCallReport       = "SELECT * FROM profile_filter WHERE user_id_fk = " . $current_view_user_id;
$rsCallReport             = mysql_query($query_rsCallReport) or die(mysql_error());
$row_rsCallReport         = mysql_fetch_object($rsCallReport);
$totalRows_rsCallReport   = mysql_num_rows($rsCallReport);


// profile



/**
 * If 0 redirect to index.php
 */
if ($totalRows_rsCallReport != 1) 
{

  header("location: index.php");

} 
  else
{

  /**
   * Assign new Var
   */
  $current_disc         =     $row_rsCallReport->DISC;

  // explode comma ,
  $new_DISC             =    explode(',', $current_disc);
  $new_current_disc_1   =    $new_DISC['0'];
  $new_current_disc_2   =    $new_DISC['1'];



  $current_lite         =     $row_rsCallReport->LITE;


  // change mode
  $current_lse          =     $row_rsCallReport->XYZ;

  switch ($current_lse) {
    case 'X':
      $current_lse = 'H';
      break;

    case 'Y':
      $current_lse = 'S';
      break;

    case 'Z':
      $current_lse = 'D';
      break;
  }



  $current_lepj         =     $row_rsCallReport->LEPJ;

  // explode comma ,
  $new_LEPJ              =    explode(',', $current_lepj);
  $new_current_lepj_1   =    $new_LEPJ['0'];

  switch ($new_current_lepj_1) {
    case 'F':
      $new_current_lepj_1   = 'Faithful';
      break;
    case 'S':
      $new_current_lepj_1   = 'Similarity';
      break;
    case 'R':
      $new_current_lepj_1   = 'Righteousness';
      break;
    case 'I':
      $new_current_lepj_1   = 'Individual Liberty';
      break;
  }

  $new_current_lepj_2   =    $new_LEPJ['1'];

  switch ($new_current_lepj_2) {
    case 'F':
      $new_current_lepj_2   = 'Faithful';
      break;
    case 'S':
      $new_current_lepj_2   = 'Similarity';
      break;
    case 'R':
      $new_current_lepj_2   = 'Righteousness';
      break;
    case 'I':
      $new_current_lepj_2   = 'Individual Liberty';
      break;
  }

}

/**
 * REPORT FOR EMPLOYER BASED ON 3 SECTION
 * STRENGTH, THINKING, VALUES
 *
 * STRENGTH CONSIST OF ACTIVE ROLE, PERSONALITY OVERVIEW, MEASUREMENT, & COMMUNICATION
 *
 * Active Role 1 & 2
 ****************************************************************************************/

$query_rsActiveRole1 = "SELECT * FROM personality_style WHERE group_by LIKE '%$new_current_disc_1%'";
$rsActiveRole1 = mysql_query($query_rsActiveRole1) or die(mysql_error());


$query_rsActiveRole2 = "SELECT * FROM personality_style WHERE group_by LIKE '%$new_current_disc_2%'";
$rsActiveRole2 = mysql_query($query_rsActiveRole2) or die(mysql_error());

/*****************************************************************************************/






/**
 * Personality Overview
  ****************************************************************************************/


$query_rsPerOverview1 = "SELECT * FROM personality_system WHERE group_by LIKE '%$new_current_disc_1%'  GROUP BY title";
$rsPerOverview1 = mysql_query($query_rsPerOverview1) or die(mysql_error());

$query_rsPerOverview2 = "SELECT * FROM personality_system WHERE group_by LIKE '%$new_current_disc_2%' GROUP BY title";
$rsPerOverview2 = mysql_query($query_rsPerOverview2) or die(mysql_error());


/*****************************************************************************************/






/**
 * SUMMARY
 */
/*****************************************************************************************/


$query_rsChar1 = "SELECT * FROM apsc_characteristic WHERE GROUP_BY LIKE '%$new_current_disc_1%' GROUP BY POSITION";
$rsChar1 = mysql_query($query_rsChar1) or die(mysql_error());

$query_rsChar2 = "SELECT * FROM apsc_characteristic WHERE GROUP_BY LIKE '%$new_current_disc_2%' GROUP BY POSITION";
$rsChar2 = mysql_query($query_rsChar2) or die(mysql_error());

/*****************************************************************************************/






/**
 * THINKING STYLE
 */
/*****************************************************************************************/


$query_cts = "SELECT * FROM cognitive_thinking_style WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY POSITION";
$result_cts = mysql_query($query_cts) or die(mysql_error());


/*****************************************************************************************/








/**
 * THINK CHAR
 */
/*****************************************************************************************/


$query_rsThinkChar = "SELECT * FROM fice_style_characteristics WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY TITLE";
$rsThinkChar = mysql_query($query_rsThinkChar) or die(mysql_error());

/*****************************************************************************************/








/**
 * THINK SYS
 */
/*****************************************************************************************/


$query_rsThinkSYS = "SELECT * FROM fice_overall_thinking_style WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY POSITION";
$rsThinkSYS = mysql_query($query_rsThinkSYS) or die(mysql_error());

/*****************************************************************************************/






/**
 * THINK IMPROVEMENT
 */
/*****************************************************************************************/


$query_rsThinkIMPROVE = "SELECT * FROM improve_learning WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY TITLE";
$rsThinkIMPROVE = mysql_query($query_rsThinkIMPROVE) or die(mysql_error());

/*****************************************************************************************/







/**
 * THINK hsd_acuteness_listening_style
 */
/*****************************************************************************************/


$query_rsListStyle = "SELECT * FROM hsd_acuteness_listening_style WHERE GROUP_BY LIKE '%$current_lse%'";
$rsListStyle = mysql_query($query_rsListStyle) or die(mysql_error());

/*****************************************************************************************/







/**
 * THINK hsd_acuteness_listening_style
 */
/*****************************************************************************************/

$query_rsUnderValueStyle1 = "SELECT * FROM understanding_value WHERE group_by LIKE '%$new_current_lepj_1%'";
$rsUnderValueStyle1 = mysql_query($query_rsUnderValueStyle1);


$query_rsUnderValueStyle2 = "SELECT * FROM understanding_value WHERE group_by LIKE '%$new_current_lepj_2%'";
$rsUnderValueStyle2 = mysql_query($query_rsUnderValueStyle2);


/*****************************************************************************************/






/**
 * THINK hsd_acuteness_listening_style
 */
/*****************************************************************************************/

$query_rsValueOverStyle1 = "SELECT * FROM value_style WHERE group_by LIKE '%$new_current_lepj_1%' GROUP BY title";
$result_rsValueOverStyle1 = mysql_query($query_rsValueOverStyle1);

$query_rsValueOverStyle2 = "SELECT * FROM value_style WHERE group_by LIKE '%$new_current_lepj_2%' GROUP BY title";
$result_rsValueOverStyle2 = mysql_query($query_rsValueOverStyle2);

/*****************************************************************************************/
//APSC chart data current user
/************************************************************************************/
$sth = mysql_query("SELECT disc_type AS Benda, disc_score AS Jumlah FROM disc_result WHERE user_id_fk = $current_view_user_id ORDER BY disc_time DESC LIMIT 4");

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    //Labels your chart, this represent the column title
    //note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
    array('label' => 'Benda', 'type' => 'string'),
    array('label' => 'Score', 'type' => 'number')

);

$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will used to slice the Pie chart
    $temp[] = array('v' => (string) $r['Benda']); 

    //Values of the each slice
    $temp[] = array('v' => (int) $r['Jumlah']); 
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);


/*****************************************************************************************/
//FICE chart data current user
/************************************************************************************/
 $stfice = mysql_query("SELECT lite_type AS ficetype, lite_score AS ficescore FROM lite_result WHERE user_id_fk = $current_view_user_id ORDER BY lite_time DESC LIMIT 4");

 $rows = array();
 //flag is not needed
 $flag = true;
 $tablefice = array();
 $tablefice['cols'] = array(

    //Labels your chart, this represent the column title
    // note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
     array('label' => 'ficetype', 'type' => 'string'),
     array('label' => 'Score', 'type' => 'number')

 );

  $rows = array();
  while($rfice = mysql_fetch_assoc($stfice)) {
     $tempfice = array();
     //  the following line will used to slice the Pie chart
      $tempfice[] = array('v' => (string) $rfice['ficetype']); 

     // Values of the each slice
     $tempfice[] = array('v' => (int) $rfice['ficescore']); 
      $rows[] = array('c' => $tempfice);
  }

 $tablefice['rows'] = $rows;
 $jsontablefice = json_encode($tablefice);



/*****************************************************************************************/
//HSD chart data current user
/************************************************************************************/
 $sthsd = mysql_query("SELECT lse_type AS hsdtype, lse_score AS hsdscore FROM lse_result WHERE user_id_fk = $current_view_user_id ORDER BY lse_time DESC LIMIT 4");

 $rows = array();
 //flag is not needed
 $flag = true;
 $tablehsd = array();
 $tablehsd['cols'] = array(

    //Labels your chart, this represent the column title
    // note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
     array('label' => 'hsdtype', 'type' => 'string'),
     array('label' => 'Score', 'type' => 'number')

 );

  $rows = array();
  while($rhsd = mysql_fetch_assoc($sthsd)) {
     $temphsd = array();
     //  the following line will used to slice the Pie chart
      $temphsd[] = array('v' => (string) $rhsd['hsdtype']); 

     // Values of the each slice
     $temphsd[] = array('v' => (int) $rhsd['hsdscore']); 
      $rows[] = array('c' => $temphsd);
  }

 $tablehsd['rows'] = $rows;
 $jsontablehsd = json_encode($tablehsd);


/*****************************************************************************************/
//FSIR chart data current user
/************************************************************************************/
 $stfsir = mysql_query("SELECT lepj_type AS fsirtype, lepj_score AS fsirscore FROM lepj_result WHERE user_id_fk = $current_view_user_id ORDER BY lepj_time DESC LIMIT 4");

 $rows = array();
 //flag is not needed
 $flag = true;
 $tablefsir = array();
 $tablefsir['cols'] = array(

    //Labels your chart, this represent the column title
    // note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
     array('label' => 'fsirtype', 'type' => 'string'),
     array('label' => 'Score', 'type' => 'number')

 );

  $rows = array();
  while($rfsir = mysql_fetch_assoc($stfsir)) {
     $tempfsir = array();
     //  the following line will used to slice the Pie chart
      $tempfsir[] = array('v' => (string) $rfsir['fsirtype']); 

     // Values of the each slice
     $tempfsir[] = array('v' => (int) $rfsir['fsirscore']); 
      $rows[] = array('c' => $tempfsir);
  }

 $tablefsir['rows'] = $rows;
 $jsontablefsir = json_encode($tablefsir);





 ?>


<html>
<head>
  <title>Profiling Report</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="css/proapp_style.css">
  <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>



<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>) ;

        var options = {
          title: 'APSC Result Chart',
          hAxis: {title: 'APSC Result Chart', titleTextStyle: {color: '#333'}},
          colors:['red']

        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>) ;

        var options = {
          title: 'APSC Result Chart',
          hAxis: {title: 'APSC Result Chart', titleTextStyle: {color: '#333'}},
          colors:['red']

        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div5'));
        chart.draw(data, options);
      }
    </script>

     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {

        var data2 = new google.visualization.DataTable(<?php echo $jsontablefice; ?>);

        var options = {
          title: 'FICE Result Chart',
          hAxis: {title: 'FICE Result Chart', titleTextStyle: {color: '#333'}},
          colors:['#37a0cc']
        };

        var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options);
      }
    </script>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {

        var data2 = new google.visualization.DataTable(<?php echo $jsontablefice; ?>);

        var options = {
          title: 'FICE Result Chart',
          hAxis: {title: 'FICE Result Chart', titleTextStyle: {color: '#333'}},
          colors:['#37a0cc']
        };

        var chart2 = new google.visualization.BarChart(document.getElementById('chart_div6'));
        chart2.draw(data2, options);
      }
    </script>
 
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = new google.visualization.DataTable(<?php echo $jsontablehsd; ?>);
        
        var options = {
          title: 'HSD Result Chart',
          hAxis: {title: 'HSD Result Chart', titleTextStyle: {color: '#333'}},
          colors:['pink','orange','green']
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options);
      }
    </script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = new google.visualization.DataTable(<?php echo $jsontablehsd; ?>);
        
        var options = {
          title: 'HSD Result Chart',
          hAxis: {title: 'HSD Result Chart', titleTextStyle: {color: '#333'}},
          colors:['pink','orange','green']
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('chart_div7'));
        chart3.draw(data3, options);
      }
    </script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart4);
      function drawChart4() {

        var data4 = new google.visualization.DataTable(<?php echo $jsontablefsir; ?>);

        var options = {
          title: 'FSIR Result Chart',
          hAxis: {title: 'FSIR Result Chart', titleTextStyle: {color: '#333'}},
          colors:['purple']
          

        };

        var chart4 = new google.visualization.ColumnChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options);
      }
    </script>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart4);
      function drawChart4() {

        var data4 = new google.visualization.DataTable(<?php echo $jsontablefsir; ?>);

        var options = {
          title: 'FSIR Result Chart',
          hAxis: {title: 'FSIR Result Chart', titleTextStyle: {color: '#333'}},
          colors:['purple']
          

        };

        var chart4 = new google.visualization.ColumnChart(document.getElementById('chart_div8'));
        chart4.draw(data4, options);
      }
    </script>
     <style type="text/css" media="screen">
      /*body {
	font-family: Arial;
	font-size: 12px;
	text-align: center;        /*background-color: #F0F0F0;
      }*/

      .wrapper {
        background-color: white;
        width: 1000px;
      margin: 0 auto;
        padding: 10px;

        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
      }

         /*.stCap {
    
    margin: 50px 250px;
     font-family: Bebas; 
     font-color: #ff3819;
     font-size: 12px;
     }*/
	 
	 .active{
		 font-family:"Bebas";
		 font-size:36px;
		 font-color:#F00;
		 /*margin-left:30px;*/
     color: red; 
     text-shadow:0px 0px 0 rgb(-22,231,231),1px 1px 0 ;
    /* width: 160px;
    border: 2px dotted white;
    */
    border-bottom-right-radius: 5px;
    border-top-left-radius: 5px;
    background-color:#ece7e7;

		 }


 .active1{
     font-family:"Bebas";
     font-size:36px;
     font-color:;
     margin-left:30px;
     color:#37a0cc; 
    /* width: 160px;
    border: 2px dotted white;
    
    border-bottom-right-radius: 50px;
    border-top-left-radius: 50px;
    padding:40px;*/
     }



     .active3{
     font-family:"Bebas";
     font-size:36px;
     font-color:;
     margin-left:30px;
     color:green; 
    /* width: 160px;
    border: 2px dotted white;
    
    border-bottom-right-radius: 50px;
    border-top-left-radius: 50px;
    padding:40px;*/
     }



.active4{
     font-family:"Bebas";
     font-size:36px;
     font-color:;
     margin-left:30px;
     color:purple; 
    /* width: 160px;
    border: 2px dotted white;
    
    border-bottom-right-radius: 50px;
    border-top-left-radius: 50px;
    padding:40px;*/
     }


     .kotak {
    border:  1px solid #dadada;
    /*width: 500px;*/
    padding: 10px ;
    margin:0px auto;
  }
		 
		 .ar{
		 font-family:"Bebas";
		 font-size:150px;
		 font-color:#F00;
		 margin:50px  100px; 
     color: red;
   }
			 
			 
			 .ar2{
		 font-family:"Bebas";
		 font-size:150px;
		 font-color:#F00;
		 margin:50px  100px; 
     color:red;
   }


 .c{
     font-family:"Bebas";
     font-size:150px;
     font-color:#F00;
     margin:50px  100px; 
     color: red;
   }
       
       
       .c2{
     font-family:"Bebas";
     font-size:150px;
     font-color:#F00;
     margin:50px  100px; 
     color:red;
   }
   #mainKotak {
    border:  1px solid red;
    width: 500px;
    padding: 5px;
    margin:0px auto;
  }

  #left {
    width: 160px;
    border: 2px dotted white;
    float: left;
    border-radius: 100px;
    padding:40px;
  } 

  #left:hover{
    background-color: white;
  } 

  

  #right {
    width: 240px;
    border: 2px dotted black;
    float: right;
  }

  .clear
  {
    clear:both;
    /*border:1px solid black;*/
  }

   .PS{
     font-family:"Bebas";
     font-size:150px;
     font-color:#F00;
     margin:50px  100px; 
     color: red;
   }
       
       
       .PS2{
     font-family:"Bebas";
     font-size:150px;
     font-color:#F00;
     margin:50px  100px; 
     color:red;
   }

   .thinkingBottom{
    margin:0px auto;
   }

.o{
  font-family:"Bebas";
     font-size:150px;
     font-color:#F00;
     margin:50px  100px; 
     color:#37a0cc;
}

.overview{
  color:#37a0cc;
  font-family:"Bebas";
     font-size:36px;
     font-color:#F00;
     margin:50px  100px;
}

.TCHARAC{
   color:#37a0cc;
  font-family:"Bebas";
     font-size:36px;
     font-color:#F00;
     margin:50px  100px;
}

.DOING{
  color:green;
  font-family:"Bebas";
     font-size:36px;
     font-color:#F00;
     margin:50px  100px;
}

.name{
  font-family:"Bebas";
     font-size:36px;
     font-color:#F00;
}

.l{
   color:green;
  font-family:"Bebas";
     font-size:36px;
     font-color:#F00;
     margin:50px  100px;

}

.value{
  color:purple;
  font-family:"Bebas";
     font-size:36px;
    
     margin:50px  100px;
}

.v{
 color:purple;
  font-family:"Bebas";
     font-size:36px;
    
     margin:50px  100px;
}


.valueCharac{
color:purple;
  font-family:"Bebas";
     font-size:36px;
     
     margin:50px  100px;
}

.ThinkingTop{
  padding-left: 50px;
}

.ValueTop{
padding-left: 50px;
}

.thinkingBottom{
  margin:0px auto;
}


.valueBottom{
  margin-left: 30px;
}

.s{
  margin:0px auto;
}


#top{
      /*border: 1px solid blue;*/

     border-radius: 10px;
     width: 980px;
     padding: 2px;
     margin: 0 auto;

   }
     
     .left {
      float:left;
     
     }
     .right {
      float: right;
     }

     

#leftTop{
  width: 480px;
  /*border: 2px dotted black;*/
    text-align: left;
  float: left;
  padding: 2px;
  
  


 }

 #rightTop{
  width: 480px;
  /*border: 2px dotted black;*/
padding: 2px;

  
}
 


 #rightbottom{
  width: 480px;
  /*border: 2px dotted black;*/
padding: 2px;
  
}

#number{
  /*border: 2px dotted black;*/
padding: 2px;
}
#number2{
/*border: 2px dotted black;*/
padding: 0px 0px 0px 3px;
width: 115px;
height: 100px;
line-height: 100px;

}

#numbersub2{
/*border: 2px dotted black;*/
padding: 0px 0px 0px 3px;
width: 450px;
height: 100px;
line-height: 100px;

}
#title{
  /*border: 2px dotted black;*/
  width:380px;
  text-align:left;
  padding: 1px;
  font-family:Bebas;
  font-size:40px;
  color: red;
  height: 77px;
  line-height: 77px;

}
#titleSub1{
  /*border: 2px dotted black;*/
  width:350px;
  text-align:left;
  padding: 2px;
  font-family: bebas;
  font-size:60px;
  color: red;
  height: 100px;
  line-height: 100px;

}
#titleSub2{
  /*border: 2px dotted black;*/
  width:450px;
  text-align:left;
  padding: 2px;
  font-family:bebas;
  font-size:60px;
  color:#37a0cc;
  height: 100px;
  line-height: 100px;

}
#titleSub3{
  /*border: 2px dotted black;*/
  width:480px;
  text-align:auto;
  padding: 2px;
  font-family:bebas;
  font-size:60px;
  color:purple;
  height: 100px;
  line-height: 100px;

}

#mainTitle{

  /*border: 1px solid black;*/

  border-radius: 10px;
  width: 480px;
  padding: 5px;
  margin: 0 auto;
}
#title2{
  width:380px;
  text-align:left;
  padding: 2px;
  font-family: bebas;
  font-size:40px;
  color:#37a0cc;
  height: 77px;
  line-height: 77px;

}


#mainTitle2{

  /*border: 1px solid black;*/
  padding: auto;
  margin: auto;
  border-radius: 10px;
  width: 480px;
  padding: 5px;

 
}
#title3{
   /*border: 2px dotted black;*/
  width:380px;
  text-align:left;
  padding: 2px;
  font-family: bebas;
  font-size:40px;
  color:green;
  height: 77px;
  line-height: 77px;

}


#title4{
   /*border: 2px dotted black;*/
  width:380px;
  text-align:left;
  padding: 2px;
  font-family: bebas;
  font-size:40px;
  color:purple;
  height: 77px;
  line-height: 77px;

}

#call{

height: 77px;
  /*border: 1px solid black;*/
  font-family: bebas;
  font-size:25px;
  
  line-height: 77px;
  text-align:auto;
}
#call2{

height: 77px;
  /*border: 1px solid black;*/
  font-family: bebas;
  font-size:20px;
  
  line-height: 77px;
  text-align:auto;
  colors:purple;
}
a.a {
  color:red;
}

a.v {
  color:purple;
}
 .S{
  font-family: bebas;
  font-size: 150px;
  color: red;
  font-style: auto;

 }
  .t{
  font-family: bebas;
  font-size: 150px;
  color:#37a0cc ;
  font-style: auto;

 }

/* .v{
  font-family: "bebas";
  font-size: 30px;
  color:purple;
  font-style: auto;


 }*/
#active
        {
        border:1px solid #b3b3b3;
        height:90px;
        line-height:90px;
        font-family:bebas;
        font-size:36px;
        color:red;
        text-align:auto;
        width:800px;
        letter-spacing:10px;
        margin:50px 90px;

        }

#thinking{
   
        border:1px solid #b3b3b3;
        height:90px;
        line-height:90px;
        font-family:bebas;
        font-size:36px;
        text-align:auto;
        width:800px;
        letter-spacing:10px;
        margin:50px 90px;
        
}
#value{
  
        border:1px solid #b3b3b3;
        height:90px;
        line-height:90px;
        font-family:bebas;
        font-size:36px;
        text-align:auto;
        width:800px;
        letter-spacing:10px;
        margin:50px 90px;
        color:purple;
}
.titleBesar{
    width:900px;
  
  padding: 2px;
  font-family: bebas;
  font-size:70px;
  color: #981673;
  height: 77px;
  line-height: 77px;
  margin:0px 300px;
   }

.center
        {
        /*border: 1px solid blue;*/
        border-radius:10px;
        width:980px;
        padding:2px;
        margin:auto;
        }

     
     </style>




   




   

 
   
</head>
<body>
  <?php include 'header-sc.php'; ?>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="wrapper">
  <div class="title" align="center"><img src="img/title.gif" width="722" height="110" align="middle"></div>
  <p>&nbsp;</p>
  


<div class="details">
  <div align="center"><img src=/<?php echo $row_rsID->user_pic ; ?>   
       width="200" height="200" class="img-circle" align="middle">
       <p>&nbsp;</p>
        <div class="name" ><?php echo $row_rsID->usr_name ; ?></div>
        <br> 
        <p><?php echo $row_rsID->usr_tel ; ?></p>
        <p><?php echo $row_rsID->usr_email ; ?></p>
       
</div>
<p>&nbsp;</p>
<!-- <table style= "border:1; border-color:#dadada;" >
  <tr>
    <td><div class ="stengthTop"><span class="stengthTop"><img src="img/strengthTop.gif" width="439" height="99"></span></div>
    <div id="chart_div" style="width: 450px; height: 200px;"></div>
    




    <div class="s"><h3><a href="#S1"><font type="Bebas" color="red" size="4px"><?php if ($new_current_disc_1 == 'A'){ echo "Authority";}
elseif($new_current_disc_1 == 'P'){ echo "Persuading";}
elseif($new_current_disc_1 == 'S'){ echo "Stable";}
elseif($new_current_disc_1 == 'C'){ echo "Comform";}?></font></a>
      <a href="#S2"><font type="Bebas" color="red" size="4px"><?php if ($new_current_disc_2 =='A'){ echo "Authority";}
elseif($new_current_disc_2 =='P'){ echo "Persuading";}
elseif($new_current_disc_2 =='S'){ echo "Stable";}
elseif($new_current_disc_2 =='C'){ echo "Comform";}?></font></a></h3></td></div></div>
    
    <td><div class ="ThinkingTop"><img src="img/thinkingTop.gif" width="371" height="65">
    <div id="chart_div2" style="width: 450px; height: 200x;"></div>
   <div align="center"> <h1><strong><a href="#T1"><font type="Bebas"size="4px">
    <?php if ($current_lite == 'F'){ echo "Factual";}
elseif($current_lite == 'I'){ echo "Insticntive";}
elseif($current_lite == 'C'){ echo "Conceptual";}
elseif($current_lite == 'E'){ echo "Experiental";}?></a></strong></div>
 </div>
 </td>
  </tr>
  <tr>
    <td><img src="img/learningTop.gif" width="424" height="102">
    <div id="chart_div3" style="width: 450px; height: 200x;"></div>
    <div align="center"><strong><a href="#L1"><font type="Bebas" color="green" size="4px" ><?php if ($current_lse == 'H'){ echo "Hearing";}
elseif($current_lse== 'S'){ echo "Seeing";}
elseif($current_lse== 'D'){ echo "Doing";}?>
    </a></strong></div></td>
    
    <td><div class ="ValueTop"><img src="img/valueTop.gif" width="328" height="111">
    <div id="chart_div4" style="width: 450px; height: 200x;"></div>
    <div align="center" ><a href="#v1"><font color="purple"><?php echo $new_current_lepj_1 ?></a></font>
   <a href="#v2"><font color="purple"><?php echo $new_current_lepj_2 ?></td></a></div></div></font>
  </tr>
</table>
<div class="underline"><img src="img/underline.gif" width="935" height="65"></div> -->


<div id="top">
  <div id= "leftTop"class="left">
    <div id="mainTitle">
    <div id="number" class ="left">
      <img src="img/1.png">
    </div>
    <div id="title" class ="right">
      STRENGTH
    </div>
     <div class="clear">
    
  </div>
  </div>
    <div id="chart_div" style="width: 450px; height: 200px;"></div>
    <div class="clear">
    
  </div>
    <div id="call" align="center"><a class="a" href="#S1" ><?php if ($new_current_disc_1 == 'A'){ echo "Authority";}
elseif($new_current_disc_1 == 'P'){ echo "Persuading";}
elseif($new_current_disc_1 == 'S'){ echo "Stable";}
elseif($new_current_disc_1 == 'C'){ echo "Comform";}?><?php  echo " & " ?></a>

      <a class ="a" href="#S1"><?php if ($new_current_disc_2 =='A'){ echo "Authority";}
elseif($new_current_disc_2 =='P'){ echo "Persuading";}
elseif($new_current_disc_2 =='S'){ echo "Stable";}
elseif($new_current_disc_2 =='C'){ echo "Comform";}?></a></div>
  </div>


  <div id= "rightTop" class="right">
     <div id="mainTitle">
    <div id="number" class ="left">
      <img src="img/2.png">
    </div>
    <div id="title2" class ="right">
      THINKING STYLE
    </div>
     <div class="clear">
    
  </div>
  </div>
    <div id="chart_div2" style="width: 450px; height: 200px;"></div>
   <div id="call" align="center"><a href="#T1"><?php if ($current_lite == 'F'){ echo "Factual";}
elseif($current_lite == 'I'){ echo "Insticntive";}
elseif($current_lite == 'C'){ echo "Conceptual";}
elseif($current_lite == 'E'){ echo "Experiental";}?></div></td>
  </div>
  <div class="clear">
  
    <img src="img/underline.gif" width="935" height="65"></div>
 <div id= "leftTop"class="left">
    <div id="mainTitle">
    <div id="number" class ="left"><img src="img/number3_profilereport.png" width="71" height="64"></div>
    <div id="title3" class ="right">
      LEARNING STYLE
    </div>
     <div class="clear">
    
  </div>
  </div>
    <div id="chart_div3" style="width: 450px; height: 200px;"></div>
    <div class="clear">
    
  </div>
    <div id="call" align="center"><a class="a" href="#S1" ><font color="green"><?php if ($current_lse == 'H'){ echo "Hearing";}
elseif($current_lse== 'S'){ echo "Seeing";}
elseif($current_lse== 'D'){ echo "Doing";}?></a></div>
  </div>


  <div id= "rightTop" class="right">
     <div id="mainTitle">
    <div id="number" class ="left"><img src="img/number4profile.png" width="73" height="64"></div>
    <div id="title4" class ="right">
      VALUE STYLE
    </div>
     <div class="clear">
    
  </div>
  </div>
    <div id="chart_div4" style="width: 450px; height: 200px;"></div>
   <div id="call" align="center"><a href="#T1"><font color="purple"><?php echo $new_current_lepj_1 ?><?php  echo " & " ?></a></font>
    
   <a href="#v2"><font color="purple"><?php echo $new_current_lepj_2 ?></div></td>
  </div>
  <div class="clear">
    
  </div>
  </div>
  <div class="clear">
    
  </div>

</div>
<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>
<div class="stegthsBottom"><a name="S1"><a name="S2"><img src="img/StrengthsBottom.png" width="252" height="18"></a></a>
</div>

<div id="chart_div5" style="width: 700px; height: 500px; margin:0px auto;"></div>

<!-- ACTIVE ROLES -->
<div class="kotak"><div class="active">Active Roles</div></div>
<div class="container">
<table  border="0">
  <tr>
    <td width="170"><div class="ar"><?php echo $new_current_disc_1 ?></div></td>
    <td width="302"> <dl>
            <?php while ($row_rsActiveRole1 = mysql_fetch_object($rsActiveRole1)) { ?>
                <dt style= "color:red;">
                <?php

                if ($row_rsActiveRole1->title == "Top title" ||
                  $row_rsActiveRole1->title == "Bottom title") {
                  # code...
                } else {
                  echo $row_rsActiveRole1->title;
                }

                ?></dt>
                <dd><?php echo $row_rsActiveRole1->desc; ?></dd><br/>
            <?php } ?> 
          </dl></td>
  </tr>
  <tr>
    <td><div class="ar2"><?php echo $new_current_disc_2 ?></div></td>
    <td> <dl>
          <?php while ($row_rsActiveRole2 = mysql_fetch_object($rsActiveRole2)) { ?>
              <dt style= "color:red;">
                <?php

                if ($row_rsActiveRole2->title == "Top title" ||
                  $row_rsActiveRole2->title == "Bottom title") {
                  # code...
                } else {
                  echo $row_rsActiveRole2->title;
                }

                ?>
              </dt>
              <dd><?php echo $row_rsActiveRole2->desc; ?></dd><br/>
          <?php } ?>
        </dl></td>
  </tr>
</table>
</div>



<!-- PERSONALITY SYSTEM -->
<div class="kotak"><div class="active">PERSONALITY SYSTEM</div></div>
<div class="container">
<table  border="0">
  <tr>
    <td width="170"><div class="PS"><?php echo $new_current_disc_1 ?></div></td>
    <td width="302"> <dl>
            <?php while ($row_rsPerOverview1 = mysql_fetch_object($rsPerOverview1)) { ?>
                 <dt style= "color:red;"><?php echo $row_rsPerOverview1->title; ?></dt>
                <dd>
                <?php 

                $query_detailPO = "SELECT * FROM personality_system WHERE title = '$row_rsPerOverview1->title' AND group_by LIKE '%$new_current_disc_1%'";
                $result_detailPO = mysql_query($query_detailPO);
                while ($row_detailPO = mysql_fetch_object($result_detailPO)) {
                  echo $row_detailPO->desc;
                  echo ", ";
                }

                ?></dd><br/>
            <?php } ?> 
          </dl></td>
  </tr>
  <tr>
    <td><div class="PS2"><?php echo $new_current_disc_2 ?></div></td>
    <td> <dl>
          <?php while ($row_rsPerOverview2 = mysql_fetch_object($rsPerOverview2)) { ?>
               <dt style= "color:red;"><?php echo $row_rsPerOverview2->title; ?></dt>
              <dd><?php 

                $query_detailPO2 = "SELECT * FROM personality_system WHERE title = '$row_rsPerOverview2->title' AND group_by LIKE '%$new_current_disc_2%'";
                $result_detailPO2 = mysql_query($query_detailPO2);
                while ($row_detailPO2 = mysql_fetch_object($result_detailPO2)) {
                  echo $row_detailPO2->desc;
                  echo ", ";
                }

                ?></dd><br/>
          <?php } ?>
        </dl></td>
  </tr>
</table>
</div>




<!-- characteristic -->
<div class="kotak"><div class="active">characteristics</div></div>
<div class="container">
<table  border="0">
  <tr>
    <td width="170"><div class="c"><?php echo $new_current_disc_1 ?></div></td>
    <td width="302"> <dl>
        <?php while ($row_rsChar1 = mysql_fetch_object($rsChar1)) { ?>
           <dt style= "color:red;"><?php echo $row_rsChar1->POSITION ?></dt>

            <dd>
              
            <?php 

            $query_detailChar1 = "SELECT * FROM apsc_characteristic WHERE POSITION = '$row_rsChar1->POSITION' AND GROUP_BY LIKE '%$new_current_disc_1%'";
            $result_detailChar1 = mysql_query($query_detailChar1);

            while ($row_detailChar1 = mysql_fetch_object($result_detailChar1)) {
              echo $row_detailChar1->DESC;
              echo ", ";
            }

            ?>              

            </dd><br>

        <?php } ?>
      </dl></td>
  </tr>
  <tr>
    <td><div class="c2"><?php echo $new_current_disc_2 ?></div></td>
    <td>  <dl>
        <?php while ($row_rsChar2 = mysql_fetch_object($rsChar2)) { ?>
           <dt style= "color:red;"><?php echo $row_rsChar2->POSITION ?></dt>

            <dd>
              
            <?php 

            $query_detailChar2 = "SELECT * FROM apsc_characteristic WHERE POSITION = '$row_rsChar2->POSITION' AND GROUP_BY LIKE '%$new_current_disc_2%'";
            $result_detailChar2 = mysql_query($query_detailChar2);

            while ($row_detailChar2 = mysql_fetch_object($result_detailChar2)) {
              echo $row_detailChar2->DESC;
              echo ", ";
            }

            ?>              

            </dd>
            <br>

        <?php } ?>
      </dl></td>
  </tr>
</table>
</div>


<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>

<!-- thinking part -->
<br>
<div class="thinkingBottom"  ><a name="T1"><img src="img/thinkingBottomtitle.gif"></a></div>
<div id="chart_div6" style="width: 700px; height: 500px;"></div>


<!-- oVERVIEW -->

<div class="kotak"><div class="active1">Overview</div></div>
<div class="container">
<table  border="0" width="100%">
  <tr>
    <td width="100"><div class="o"><?php echo $current_lite ?></div></td>
    <td>  <ul>
          
          <?php while ($row_cs = mysql_fetch_object($result_cts)) { ?>
            
            <dt style= "color:#37a0cc;"><?php echo $row_cs->POSITION ?></dt>

              <!-- <li> -->
                <?php  

                $query_detailCS = "SELECT * FROM cognitive_thinking_style WHERE POSITION = '$row_cs->POSITION' AND GROUP_BY LIKE '%$current_lite%'";
                $result_detailCS = mysql_query($query_detailCS);

                while ($row_detailCS = mysql_fetch_object($result_detailCS)) {
                  echo "<li>".$row_detailCS->DESC."</li>";
                  //echo ", ";
                }

                ?>
              <!-- </li> -->

          <?php } ?>

        </ul></td>
  </tr>
  
</table>
</div>




<!-- THINKING CHARACTERISTIC -->
<div class="kotak"><div class="active1">CHARACTERISTICS</div></div>
<div class="container">
<table  border="0" width="100%">
  <tr>
    <td width="100"><div class="o"><?php echo $current_lite ?></div></td>
    <td>  <ul>
           <?php while ($row_rsThinkChar = mysql_fetch_object($rsThinkChar)) { ?>
                <dt style= "color:#37a0cc;"><?php echo $row_rsThinkChar->TITLE; ?></dt>
                <dd>
                  <?php  

                  $query_detailTS = "SELECT * FROM fice_style_characteristics WHERE title = '$row_rsThinkChar->TITLE' AND GROUP_BY LIKE '%$current_lite%'";
                  $result_detailTS = mysql_query($query_detailTS);

                  while ($row_detailTS = mysql_fetch_object($result_detailTS)) {
                    echo "<li>".$row_detailTS->DESC."</li>";
                    // echo ", ";
                  }

                  ?>
               <!--  </dd><br/> -->
            <?php } ?> 

        </ul></td>
  </tr>
  
</table>
</div>



<!-- think SYSTEM -->
<div class="kotak"><div class="active1">SYSTEM</div></div>
<div class="container">
<table  border="0" width="100%">
  <tr>
    <td width="100"><div class="o"><?php echo $current_lite ?></div></td>
    <td > <dl>
             <?php while ($row_rsThinkSYS = mysql_fetch_object($rsThinkSYS)) { ?>
                 <dt style= "color:#37a0cc;"><?php echo $row_rsThinkSYS->POSITION; ?></dt>
                <dd>
                  <?php  

                  $query_detailTS2 = "SELECT * FROM fice_overall_thinking_style WHERE POSITION = '$row_rsThinkSYS->POSITION' AND GROUP_BY LIKE '%$current_lite%'";
                  $result_detailTS2 = mysql_query($query_detailTS2);

                  while ($row_detailTS2 = mysql_fetch_object($result_detailTS2)) {
                    echo "<li>".$row_detailTS2->DESC."</li>";
                    // echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?> 
          </dl></td>
  </tr>
  
</table>
</div>


<!-- think improvement -->
<div class="kotak"><div class="active1">improvement</div></div>
<div class="container">
<table  border="0" width="100%">
  <tr>
    <td width="100"><div class="o"><?php echo $current_lite ?></div></td>
    <td > <dl>
             <?php while ($row_rsThinkIMPROVE = mysql_fetch_object($rsThinkIMPROVE)) { ?>
                <dt style= "color:#37a0cc;"><?php echo $row_rsThinkIMPROVE->TITLE; ?></dt>
                <dd>
                  <?php  

                  $query_detailThinkIMPROVE = "SELECT * FROM improve_learning WHERE TITLE = '$row_rsThinkIMPROVE->TITLE' AND GROUP_BY LIKE '%$current_lite%'";
                  $result_detailThinkIMPROVE = mysql_query($query_detailThinkIMPROVE);

                  while ($row_detailThinkIMPROVE = mysql_fetch_object($result_detailThinkIMPROVE)) {
                    echo"<li>" .$row_detailThinkIMPROVE->POSITION."</li>";
                    // echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?> 
          </dl></td>
  </tr>
  
</table>
</div>


<!-- LEARNING PART -->
<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>
<div class="learningBottom"><a name ="L1"><img src="img/learningBottom.gif" width="257" height="64"></a></div>
<div id="chart_div7" style="width: 700px; height: 500px;"></div>


<!-- LEARNING SUMMARY -->
<div class="kotak"><div class="active3">SUMMARY</div></div>
<div class="container">
<table  border="0" width="100%">
  <tr>
    <td width="100"><div ><?php echo $current_lse; ?></div></td>
    <dt > <dl>
          <?php //while ($row_rsListStyle = mysql_fetch_object($rsListStyle)) { ?>
            <dt style= "color:green;"><?php echo $row_rsListStyle->POSITION ?></dt>
            <dd>
              <?php

              $query_detailListStyle = "SELECT * FROM hsd_acuteness_listening_style WHERE POSITION = '$row_rsListStyle->POSITION AND GROUP_BY like '%$new_current_lepj_1%'";
              $result_detailListStyle = mysql_query($query_rsListStyle);

              while ($row_detailListStyle = mysql_fetch_object($result_detailListStyle)) {
                echo $row_detailListStyle->DESC;
              }

              ?>
            </dd>
          <?php //} ?>
        </dl></td>
  </tr>
  
</table>
</div>




<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>
<!-- value style -->

<div class="valueBottom"><img src="img/valueBottom.gif" width="252" height="246"></div>
<div id="chart_div8" style="width: 700px; height: 500px;"></div>

<!-- value overview -->
<div class="kotak"><div class="ACTIVE4">OVERVIEW</div></div>
<div class="container">
<table  border="0">
  <tr>
    <td width="100"><div class="V"><?php echo $new_current_lepj_1 ?></div></td>
    <td>
        <dl>
          <?php while($row_detailrsUnderValueStyle1 = mysql_fetch_object($rsUnderValueStyle1)){ ?>

          <dt><?php echo $row_detailrsUnderValueStyle1->desc ?></dt>
          <dd>
            <?php echo $row_detailrsUnderValueStyle1->detail ?>
          </dd>

          <?php } ?>
        </dl>
      </td>
  </tr>
  <tr>
    <td><div class="V"><?php echo $new_current_lepj_2 ?></div></td>
    <td>
        <dl>
          <?php $row_detailrsUnderValueStyle2 = mysql_fetch_object($rsUnderValueStyle2) ?>

          <dt><?php echo $row_detailrsUnderValueStyle2->desc ?></dt>
          <dd>
            <?php echo $row_detailrsUnderValueStyle2->detail ?>
          </dd>

          <?php  ?>
        </dl>
      </td>
  </tr>
</table>
</div>




<!-- value overview -->
 <div class="kotak"><div class="active4">Characteristics</div></div>
<div class="container">
<table  border="0">
  <tr>
    <td width="100"><div class="valueCharac" style= "color:purple;"> <a name="v1"><?php echo $new_current_lepj_1 ?></a></div></td>
    <td>
        <dl>
          <?php while($row_detailrsValueOverStyle1 = mysql_fetch_object($result_rsValueOverStyle1)){ ?>

          <dt style= "color:purple;"><?php echo $row_detailrsValueOverStyle1->title ?></dt>
          <dd>
            <?php  

            $query_detailDescValueOverStyle1 = "SELECT * FROM value_style WHERE title = '$row_detailrsValueOverStyle1->title' AND group_by LIKE '%$new_current_lepj_1%'";
            $result_detailDescValueOverStyle1 = mysql_query($query_detailDescValueOverStyle1);

            while ($row_detailDescValueOverStyle1 = mysql_fetch_object($result_detailDescValueOverStyle1)) {
              echo $row_detailDescValueOverStyle1->desc;
              echo ", ";
            }

            ?>
          </dd>

          <?php } ?>
        </dl>
      </td>
  </tr>
  <tr><td width="100"><div class="valueCharac" ><a name="v2"><?php echo $new_current_lepj_2 ?></a></div></td>
   <td>
        <dl>
          <?php while($row_detailrsValueOverStyle2 = mysql_fetch_object($result_rsValueOverStyle2)){ ?>

          <dt style= "color:purlpe;"><?php echo $row_detailrsValueOverStyle2->title ?></dt>
          <dd>
            <?php  

            $query_detailDescValueOverStyle2 = "SELECT * FROM value_style WHERE title = '$row_detailrsValueOverStyle2->title' AND group_by LIKE '%$new_current_lepj_2%'";
            $result_detailDescValueOverStyle2 = mysql_query($query_detailDescValueOverStyle2);

            while ($row_detailDescValueOverStyle2 = mysql_fetch_object($result_detailDescValueOverStyle2)) {
              echo $row_detailDescValueOverStyle2->desc;
              echo ", ";
            }

            ?>
          </dd>

          <?php } ?>
        </dl>
      </td>
  </tr>
</table>
</div>


</div>


 




</body>
</html>