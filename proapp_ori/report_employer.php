<?php  



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
  $current_lse          =     $row_rsCallReport->XYZ;



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
 * Measurement
  ****************************************************************************************/

/*****************************************************************************************/





/**
 * Communication
  ****************************************************************************************/


$query_rsComm1 = "SELECT * FROM apsc_enhance_communication WHERE GROUP_BY LIKE '%$new_current_disc_1%' GROUP BY TITLE";
$rsComm1 = mysql_query($query_rsComm1) or die(mysql_error());


$query_rsComm2 = "SELECT * FROM apsc_enhance_communication WHERE GROUP_BY LIKE '%$new_current_disc_2%' GROUP BY TITLE";
$rsComm2 = mysql_query($query_rsComm2) or die(mysql_error());


/*****************************************************************************************/




/**
 * THINKING
 */
/**
 * SUMMARY
 */
/*****************************************************************************************/


$query_rsThinkSummary1 = "SELECT * FROM fice_style_characteristics WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY TITLE";
$rsThinkSummary1 = mysql_query($query_rsThinkSummary1) or die(mysql_error());

$query_rsThinkSummary2 = "SELECT * FROM fice_overall_thinking_style WHERE GROUP_BY LIKE '%$current_lite%' GROUP BY POSITION";
$rsThinkSummary2 = mysql_query($query_rsThinkSummary2) or die(mysql_error());


/*****************************************************************************************/






/**
 * VALUES
 */
/**
 * SUMMARY & OVERVIEW
 */
/*****************************************************************************************/


$query_rsValues1 = "SELECT * FROM value_style WHERE group_by LIKE '%$new_current_lepj_1%' GROUP BY title";
$rsValues1 = mysql_query($query_rsValues1) or die(mysql_error());

$query_rsValues2 = "SELECT * FROM value_style WHERE group_by LIKE '%$new_current_lepj_2%' GROUP BY title";
$rsValues2 = mysql_query($query_rsValues2) or die(mysql_error());


/*****************************************************************************************/




/**
 * SUMMARY & OVERVIEW
 */
/*****************************************************************************************/


$query_rsValueOverview1 = "SELECT * FROM understanding_value WHERE group_by LIKE '%$new_current_lepj_1%'";
$rsValueOverview1 = mysql_query($query_rsValueOverview1) or die(mysql_error());

$query_rsValueOverview2 = "SELECT * FROM understanding_value WHERE group_by LIKE '%$new_current_lepj_2%'";
$rsValueOverview2 = mysql_query($query_rsValueOverview2) or die(mysql_error());

/*****************************************************************************************/






/**
 * SUMMARY & OVERVIEW
 */
/*****************************************************************************************/

$query_measurement1 = "SELECT * FROM measures WHERE group_by LIKE '%$new_current_disc_1%' GROUP BY title";
$result_measurement1 = mysql_query($query_measurement1);


$query_measurement2 = "SELECT * FROM measures WHERE group_by LIKE '%$new_current_disc_2%' GROUP BY title";
$result_measurement2 = mysql_query($query_measurement2);


/*****************************************************************************************/



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
//FSIR chart data current user
/************************************************************************************/
 $stlepj = mysql_query("SELECT lepj_type AS lepjtype, lepj_score AS lepjscore FROM lepj_result WHERE user_id_fk = $current_view_user_id ORDER BY lepj_time DESC LIMIT 4");

 $rows = array();
 //flag is not needed
 $flag = true;
 $tablefice = array();
 $tablelepj['cols'] = array(

    //Labels your chart, this represent the column title
    // note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
     array('label' => 'lepjtype', 'type' => 'string'),
     array('label' => 'Score', 'type' => 'number')

 );

  $rows = array();
  while($rlepj= mysql_fetch_assoc($stlepj)) {
     $templepj = array();
     //  the following line will used to slice the Pie chart
      $templepj[] = array('v' => (string) $rlepj['lepjtype']); 

     // Values of the each slice
     $templepj[] = array('v' => (int) $rlepj['lepjscore']); 
      $rows[] = array('c' => $templepj);
  }

 $tablelepj['rows'] = $rows;
 $jsontablelepj = json_encode($tablelepj);

?>

<html>
<head>
  <title>Report for Employer</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
   <link rel="stylesheet" type="text/css" href="css/proapp_style.css">
   
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

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
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {

        var data3 = new google.visualization.DataTable(<?php echo $jsontablelepj; ?>);

        var options = {
          title: 'FSIR Result Chart',
          hAxis: {title: 'FSIR Result Chart', titleTextStyle: {color: '#333'}},
          colors:['purple']
        };

        var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options);
      }
    </script>

 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

        var options = {
          title: 'APSC Result Chart',
          hAxis: {title: 'APSC Result Chart', titleTextStyle: {color: '#333'}},
          colors:['red']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));
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

        var chart2 = new google.visualization.BarChart(document.getElementById('chart_div5'));
        chart2.draw(data2, options);
      }
    </script>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {

        var data3 = new google.visualization.DataTable(<?php echo $jsontablelepj; ?>);

        var options = {
          title: 'FSIR Result Chart',
          hAxis: {title: 'FSIR Result Chart', titleTextStyle: {color: '#333'}},
          colors:['purple']
        };

        var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div6'));
        chart3.draw(data3, options);
      }
    </script>

    <style type="text/css" media="screen">
      body {
  font-family:Arial !important;
  font-size: 12px;
  background-color: #F0F0F0;
      }

      .wrapper {
        background-color: white;
        width: 1000px;
        margin: 0 auto;
        padding: 10px;

        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
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
     #leftbottom{
  width: 480px;
  /*border: 2px dotted black;*/
  text-align: left;
  float: left;
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

#title{
  /*border: 2px dotted black;*/
  width:380px;
  text-align:left;
  padding: 2px;
  font-family: bebas;
  font-size:40px;
  color: red;
  height: 77px;
  line-height: 77px;

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

#title3{
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

 .v{
  font-family: bebas;
  font-size: 30px;
  color:purple;
  font-style: auto;

 }
#active{
  /*border: 1px solid black;*/
  height:90px;
  line-height: 90px;
  font-family: bebas;
  font-size: 36px;
  color: red;
  font-style: auto;
   
     margin:50px  100px;
     
}

#thinking{
  /*border: 1px solid black;*/
  height:90px;
  line-height: 90px;
  font-family: bebas;
  font-size: 36px;
  color:#37a0cc;
  font-style: auto;
  margin:  50px 100px;
}
#value{
  /*border: 1px solid ;*/
  height:90px;
  line-height: 90px;
  font-family: bebas;
  font-size: 36px;
  color:purple;
  font-style: auto;
  margin:  50px 100px;
}
.titleBesar{
    width:900px;
  
  padding: 2px;
  font-family: bebas;
  font-size:70px;
  color: #981673;
  height: 77px;
  line-height: 77px;
   }

.clear{
      clear: both;
     }
     </style>




   




   

 
   
</head>
<body>
  <?php include 'header-sc.php'; ?>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<div style="font-family:verdana;">
<div class="wrapper">
  <div align="center" class="titleBesar">EMPLOYER VIEW</div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>


<div class="details">
  <div align="center"><img src="<?php echo $row_rsID->user_pic ; ?>" width="200" height="200" class="img-circle" align="middle"><br/><br/>
        <p><a name="news"><font style="bebas" size="60px"  ><?php echo $row_rsID->usr_name ; ?></font> </a></p>
        <p><?php echo $row_rsID->usr_email ; ?></p></div>
       
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- <table width="200" border="0">
  <tr>
    <td><div class ="stengthTop"><span class="stengthTop"><img src="img/strengthTop.gif" width="439" height="99"></span></div>
    <div id="chart_div" style="width: 500px; height: 300px;"></div>
    <div align="center"><a href="#S1"><?php echo $new_current_disc_1 ?></a>
    <a name="S2"><?php echo $new_current_disc_2 ?></a></td></div>
    
    <td><div class ="ThinkingTop"><img src="img/thinkingTop.gif" width="371" height="65"></div>
    <div id="chart_div2" style="width: 500px; height: 300px;"></div>
   <div align="center"> <?php echo $current_lite ?></div></td>
  </tr>
  <tr>
    <td><img src="img/learningTop.gif" width="424" height="102">
    <div id="chart_div3" style="width: 500px; height: 300px;"></div>
    <div align="center"><?php echo $current_lse; ?></div></td>
    
    <td><img src="img/valueTop.gif" width="328" height="111">
    <div id="chart_div4" style="width: 500px; height: 300px;"></div>
    <div align="center"><?php echo $new_current_lepj_1 ?>
   <?php echo $new_current_lepj_2 ?></div></td>
  </tr>
</table> -->

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
elseif($new_current_disc_1 == 'C'){ echo "Comform";}?></a>
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
    
  </div>
<div id="leftbottom" class ="left">
  <div id="mainTitle">
    <div id="number" class ="left">
      <img src="img/3.png">
    </div>
    <div id="title3" class ="right">
      VALUE STYLE
    </div>
     <div class="clear">
    
  </div>
  </div>
  <div id="chart_div3" style="width: 450px; height: 200px;"></div>
    <div id="call2" align="center"><a href="#V1"><?php echo $new_current_lepj_1 ?></a>
      <a href="#v1"><?php echo $new_current_lepj_2 ?></div></td></a>
      
  </div>
  <div id="rightbottom" class ="right">
    

  </div>
  <div class="clear">
    
  </div>

</div>
<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>

<div id="strength1">
<div class="stegthsBottom"><a name="S1"><img src="img/StrengthsBottom.png" width="252" height="112"></a></div>

<div id="chart_div4" style="width: 600px; height: 400px;"></div>



<div id="content">
<div id ="active">ACTIVE ROLE</div>
<table width="845">
  <tr>
    <td width="412" align="center" class="s"><?php echo $new_current_disc_1 ?>
</td>
    <td width="421"><dl >
            <?php while ($row_rsActiveRole1 = mysql_fetch_object($rsActiveRole1)) { ?>
                <dt style="color:#F00" size ="12px">
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
          </dl>
    
    
    
    </td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="S" align="center"><?php echo $new_current_disc_2 ?></td>
    <td><dl>
          <?php while ($row_rsActiveRole2 = mysql_fetch_object($rsActiveRole2)) { ?>
              <dt style ="color:red">
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

<div id ="active">Personality   Overview</div>

<table width="846" >
  <tr>
    <td width="405"align="center" class="s"><?php echo $new_current_disc_1 ?></td>
    <td width="425"><dl>
            <?php while ($row_rsPerOverview1 = mysql_fetch_object($rsPerOverview1)) { ?>
                <dt style="color:#F00" size ="12px"><?php echo $row_rsPerOverview1->title; ?></dt>
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
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="405"align="center" class="s"><?php echo $new_current_disc_2 ?></td>
    <td><dl>
          <?php while ($row_rsPerOverview2 = mysql_fetch_object($rsPerOverview2)) { ?>
              <dt style="color:#F00" size ="12px"><?php echo $row_rsPerOverview2->title; ?></dt>
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
<div id ="active">Measurement</div>
<table width="846">
  <tr>
    <td width="400"align="center" class="s"><?php echo $new_current_disc_1; ?></td>
    <td width="422"><dl>
          <?php while($row_measurement1 = mysql_fetch_object($result_measurement1)) { ?>
            <dt style="color:#F00"><?php echo $row_measurement1->title ?></dt>
            <dd>
              <?php  

            $query_detailMeasurement1 = "SELECT * FROM measures WHERE title = '$row_measurement1->title' AND group_by LIKE '%$new_current_disc_1%'";
            $result_detailMeasurement1 = mysql_query($query_detailMeasurement1);

            while ($row_detailMeasurement1 = mysql_fetch_object($result_detailMeasurement1)) {
              echo $row_detailMeasurement1->desc;
              echo ", ";
            }

            ?>
            </dd><br>
          <?php } ?>
        </dl></td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="400"align="center" class="s"><?php echo $new_current_disc_2; ?></td>
    <td><dl>
          <?php while($row_measurement2 = mysql_fetch_object($result_measurement2)) { ?>
            <dt style="color:#F00"><?php echo $row_measurement2->title ?></dt>
            <dd>
              <?php  

            $query_detailMeasurement2 = "SELECT * FROM measures WHERE title = '$row_measurement2->title' AND group_by LIKE '%$new_current_disc_2%'";
            $result_detailMeasurement2 = mysql_query($query_detailMeasurement2);

            while ($row_detailMeasurement2 = mysql_fetch_object($result_detailMeasurement2)) {
              echo $row_detailMeasurement2->desc;
              echo ", ";
            }

            ?>
            </dd><br>
          <?php } ?>
        </dl></td>
  </tr>
</table>

<div id ="active">Communication</div>
<table width="926" >
  <tr>
    <td width="399"align="center" class="s"><?php echo $new_current_disc_1 ?></td>
    <td width="511"><dl>
            <?php while ($row_rsComm1 = mysql_fetch_object($rsComm1)) { ?>
                <dt style ="color:red"><?php echo $row_rsComm1->TITLE; ?></dt><br/>
                <!-- <dd> -->
                  <?php  

                  $query_detailCOM1 = "SELECT * FROM apsc_enhance_communication WHERE TITLE LIKE '%$row_rsComm1->TITLE%'";
                  $result_detailCOM1 = mysql_query($query_detailCOM1);
                  while ($row_detailCOM1 = mysql_fetch_object($result_detailCOM1)) {
                    echo "<li>".$row_detailCOM1->DESC."</li>";;
                    //echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?> 
          </dl></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td><p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td align="center" class="s"><?php echo $new_current_disc_2 ?></td>
    <td><dl>
          <?php while ($row_rsComm2 = mysql_fetch_object($rsComm2)) { ?>
                <dt style ="color:red"><?php echo $row_rsComm2->TITLE; ?></dt><br/>
                <!-- <dd> -->
                  <?php  

                  $query_detailCOM2 = "SELECT * FROM apsc_enhance_communication WHERE TITLE = '$row_rsComm2->TITLE'";
                  $result_detailCOM2 = mysql_query($query_detailCOM2);
                  while ($row_detailCOM2 = mysql_fetch_object($result_detailCOM2)) {
                    echo "<li>".$row_detailCOM2->DESC."</li>";
                    // echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?>
        </dl></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>
</div>



<div id="content2">

<div class="thinkingBottom" align="center"><a name="T1"><img src="img/thinkingBottom.gif" width="278" height="65"></div>
<div id="chart_div5"  style="width: 600px; height: 400px;"></div>

<div id ="thinking">Summary</div>

<table width="958">
  <tr>
    <td width="399"align="center" class="t"><?php echo $current_lite; ?></td>
    <td width="524"><dl>
      <?php while ($row_rsThinkSummary1 = mysql_fetch_object($rsThinkSummary1)) { ?>
      <dt style="color:#37a0cc"><?php echo $row_rsThinkSummary1->TITLE; ?></dt>
      <!-- <dd> -->
        <?php  

                  $query_detailTS = "SELECT * FROM fice_style_characteristics WHERE title = '$row_rsThinkSummary1->TITLE' AND GROUP_BY LIKE '%$current_lite%'";
                  $result_detailTS = mysql_query($query_detailTS);

                  while ($row_detailTS = mysql_fetch_object($result_detailTS)) {
                    echo"<li>".$row_detailTS->DESC."</li>";
                    // echo ", ";
                  }

                  ?>
        <!-- </dd><br/> -->
      <?php } ?> 
      </dl></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>



<table width="959">
  <tr>
    <td width="405"align="center" class="t"><?php echo $current_lite; ?></td>
    <td width="542"><dl>
            <?php while ($row_rsThinkSummary2 = mysql_fetch_object($rsThinkSummary2)) { ?>
                <dt style="color:#37a0cc"><?php echo $row_rsThinkSummary2->POSITION; ?></dt>
                <!-- <dd> -->
                  <?php  

                  $query_detailTS2 = "SELECT * FROM fice_overall_thinking_style WHERE POSITION = '$row_rsThinkSummary2->POSITION' AND GROUP_BY LIKE '%$current_lite%'";
                  $result_detailTS2 = mysql_query($query_detailTS2);

                  while ($row_detailTS2 = mysql_fetch_object($result_detailTS2)) {
                    echo "<li>".$row_detailTS2->DESC."</li>";
                    // echo ", ";
                  }

                  ?>
                  <br/>
                <!-- </dd><br/> -->
            <?php } ?> 
          </dl></td>
  </tr>
</table>



</div>

<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>
<div id="content3">

<div class="thinkingBottom" align="center"><a name="v1"><img src="img/title3.png" width="278" height="65"></div>
<div id="chart_div6"  style="width: 600px; height: 400px;"></div>

<div id ="value">Summary</div>
<table width="960">
  <tr>
    <td width="405"align="center" class="v"><?php echo $new_current_lepj_1 ?></td>
    <td width="513"><dl>
            <?php while ($row_rsValues1 = mysql_fetch_object($rsValues1)) { ?>
                <dt style ="color:purple"><?php echo $row_rsValues1->title; ?></dt>
                <!-- <dd> -->
                  <?php  

                  $query_detailVS1 = "SELECT * FROM value_style WHERE title LIKE '%$row_rsValues1->title%' AND GROUP_BY LIKE '%$new_current_lepj_1%'";
                  $result_detailVS1 = mysql_query($query_detailVS1);

                  while ($row_detailVS1 = mysql_fetch_object($result_detailVS1)) {
                    echo "<li>" .$row_detailVS1->desc."</li>";
                    // echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?> 
          </dl></td>
  </tr>
  <tr>
    <td width="405"align="center" class="v"><?php echo $new_current_lepj_2 ?></td>
    <td><dl>
          <?php while ($row_rsValues2 = mysql_fetch_object($rsValues2)) { ?>
                <dt style ="color:purple"><?php echo $row_rsValues2->title; ?></dt>
                <!-- <dd> -->
                  <?php  

                  $query_detailVS2 = "SELECT * FROM value_style WHERE title = '$row_rsValues2->title' AND GROUP_BY LIKE '%$new_current_lepj_2%'";
                  $result_detailVS2 = mysql_query($query_detailVS2);

                  while ($row_detailVS2 = mysql_fetch_object($result_detailVS2)) {
                    echo "<li>" .$row_detailVS2->desc."</li>";
                    // echo ", ";
                  }

                  ?>
                <!-- </dd><br/> -->
            <?php } ?> 
        </dl></td>
  </tr>
</table>

<div id ="value">Overview</div>
<table width="963">
  <tr>
    <td width="405"align="center" class="v"><?php echo $new_current_lepj_1 ?></td>
    <td><dl>
            <?php while ($row_rsValueOverview1 = mysql_fetch_object($rsValueOverview1)) { ?>
                <dt><?php echo $row_rsValueOverview1->desc; ?></dt>
                <dd><?php echo $row_rsValueOverview1->detail; ?></dd><br/>
            <?php } ?> 
          </dl></td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="405"align="center" class="v"><?php echo $new_current_lepj_2 ?></td>
    <td>  <dl>
          <?php while ($row_rsValueOverview2 = mysql_fetch_object($rsValueOverview2)) { ?>
                <dt><?php echo $row_rsValueOverview2->desc; ?></dt>
                <dd><?php echo $row_rsValueOverview2->detail; ?></dd><br/>
            <?php } ?> 
        </dl></td>
  </tr>
  </table>
</div>
</body>
</html>