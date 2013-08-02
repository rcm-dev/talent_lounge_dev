<?php  

session_start();

require_once 'connection/conProApp.php';

$current_view_user_id                           = (int) mysql_real_escape_string($_GET['uid']);
$queryID                                        = "SELECT * FROM mj_users WHERE usr_id = ". $current_view_user_id;
$rsID                                           = mysql_query($queryID) or die(mysql_error());
$row_rsID                                       = mysql_fetch_object($rsID);
$totalRows_rsID                                 = mysql_num_rows($rsID);

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
 *  OVERVIEW occupation style table 
 *
 */

$query_cf_ostyle1 = "SELECT * FROM occupational_style WHERE group_by LIKE '%$new_current_disc_1%' GROUP BY type";
$result_cf_ostyle1 = mysql_query($query_cf_ostyle1);




/**
 *  OVERVIEW occupation style table 
 *
 */

$query_cf_ostyle2 = "SELECT * FROM occupational_style WHERE group_by LIKE '%$new_current_disc_2%' GROUP BY type";
$result_cf_ostyle2 = mysql_query($query_cf_ostyle2);






/**
 * OVERVIEW Career
 */
$query_career1 = "SELECT * FROM jp_ads_categorySC WHERE ads_group LIKE '%$new_current_disc_1%'";
$result_career1 = mysql_query($query_career1);


$query_career2 = "SELECT * FROM jp_ads_categorySC WHERE ads_group LIKE '%$new_current_disc_2%'";
$result_career2 = mysql_query($query_career2);



/**
 * OVERVIEW INDUSTRY
 */
$query_industry  = "SELECT * FROM career_style GROUP BY type";
$result_industry = mysql_query($query_industry);



// chart data current user
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
    array('label' => 'Jumlah', 'type' => 'number')

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

// echo $jsonTable;
/************************************************************************************/


?>
<html>
<head>
  <title>Career Profiling</title>
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

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
    <style type="text/css" media="screen">
      body {
  font-family: arial;
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
   #mainTitle{

  /*border: 1px solid black;*/

  border-radius: 10px;
  width: 480px;
  padding: 5px;
  margin: 0 auto;
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
.S{
  font-family: bebas;
  font-size: 150px;
  color: red;
  font-style: auto;

 }
 #call{

height: 77px;
  /*border: 1px solid black;*/
  font-family: bebas;
  font-size:40px;
  
  line-height: 77px;
  text-align:auto;
}
a.a {
  color:red;
}
     
     .left {
      float:left;
     
     }
     .right {
      float: right;
     }
     .clear{
      clear: both;
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
.r{
  width:900;
  font-size:20px;
}

     </style>

</head>
<body>
  <?php include 'header-sc.php'; ?>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="wrapper">
  <div align="center" class="titleBesar">Career Profiling</div> 
  <div align="center" class="r"></div>
  <p>&nbsp;</p>
  


<div class="details">
  <div align="center">
  <img src="../<?php echo $row_rsID->user_pic ; ?>" width="200" height="200" class="img-circle" align="middle"><br/><br/>
        <p><a name="news"><font style="bebas" size="60px"  ><?php echo $row_rsID->usr_name ; ?></font> </a></p>
        <p><?php echo $row_rsID->usr_email ; ?></p></div>
       
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

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
    <div id="call" align="center"><a class="a" href="#S1" ><?php echo $new_current_disc_1 ?></a>
    <a class="a" name="S2"><?php echo $new_current_disc_2 ?></a></div>
  </div>


  
  <div id="rightbottom" class ="right">
    

  </div>
  <div class="clear">
    
  </div>

<div class="underline"><img src="img/underline.gif" width="935" height="65"></div>

<div id="strength1">
<div class="stegthsBottom"><a name="S1"><img src="img/StrengthsBottom.png" width="252" height="112"></a></div>

<div id="chart_div2" style="width: 600px; height: 400px;"></div>
<div id="content">
<div id ="active">Overview</div>

<table width="845">
  <tr>
    <td width="412" align="center" class="s"><?php echo $new_current_disc_1 ?></td>
    <td width="421"><dl>
          <?php while ($row_cf_ostyle1 = mysql_fetch_object($result_cf_ostyle1)) { ?>
            <dt style="color:#F00">
              <?php echo $row_cf_ostyle1->type ?>
            </dt>  

              <!-- <dd> -->
              <?php  

              /**
               *  OVERVIEW occupation style table 
               *
               */

              $query_cf_detail1 = "SELECT * FROM occupational_style WHERE type = '$row_cf_ostyle1->type' AND group_by LIKE '%$new_current_disc_1%'";
              $result_cf_detail1 = mysql_query($query_cf_detail1);

              while ($row_cf_detail1 = mysql_fetch_object($result_cf_detail1)) {
                echo"<li>".$row_cf_detail1->desc."</li>";
               // echo ", ";
              }

              ?><br/>
              <!-- </dd><br/> -->
          <?php } ?>
        </dl></td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="412" align="center" class="s"><?php echo $new_current_disc_2 ?></td>
    <td>   <?php while ($row_cf_ostyle2 = mysql_fetch_object($result_cf_ostyle2)) { ?>
            <dt style="color:#F00">
              <?php echo $row_cf_ostyle2->type ?>
            </dt>  

              <!-- <dd> -->
              <?php  

              /**
               *  OVERVIEW occupation style table 
               *
               */

              $query_cf_detail2 = "SELECT * FROM occupational_style WHERE type = '$row_cf_ostyle2->type' AND group_by LIKE '%$new_current_disc_2%'";
              $result_cf_detail2 = mysql_query($query_cf_detail2);

              while ($row_cf_detail2 = mysql_fetch_object($result_cf_detail2)) {
                echo"<li>".$row_cf_detail2->desc."</li>";
                // echo ", ";
              }

              ?><br/>
              <!-- </dd> -->
          <?php } ?>
        </dl></td>
  </tr>
</table>

<div id ="active">Career Recommendations</div>


<table width="846">
  <tr>
    <td width="412" align="center" class="s"><?php echo $new_current_disc_1 ?></td>
    <td><dl>
          <?php while($row_career1 = mysql_fetch_object($result_career1)){ ?>

          <dt><?php echo $row_career1->ads_cat_name; ?></dt>

          <?php } ?>
        </dl></td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="412" align="center" class="s"><?php echo $new_current_disc_2 ?></td>
    <td> <dl>
          <?php while($row_career2 = mysql_fetch_object($result_career2)){ ?>

          <dt><?php echo $row_career2->ads_cat_name; ?></dt>

          <?php } ?>
        </dl></td>
  </tr>
</table>


<div id ="active">Universities Recommendations</div>
<div>
<img src="img/unilist.jpg" />
</div>

<div id ="active">Career Directions</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="career_path/index.php">Click Here to View Direction</a>


<br/>
<br/>
<br/><br/>
<br/>
<br/>
<br/><br/>
<br/>
<br/>




</div>
</body>
</html>