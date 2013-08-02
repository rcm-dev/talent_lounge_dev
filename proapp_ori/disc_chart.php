<?php require_once 'connection/conProApp.php'; ?>
<?php 

$current_view_user_id     = (int) mysql_real_escape_string($_GET['uid']);


$sth = mysql_query("SELECT disc_type AS Benda, disc_score AS Jumlah FROM disc_result WHERE user_id_fk = $current_view_user_id");

/*
---------------------------
example data: Table (Chart)
--------------------------
Weekly_Task     percentage
Sleep           30
Watching Movie  40
work            44
*/

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

echo $jsonTable;


?>	