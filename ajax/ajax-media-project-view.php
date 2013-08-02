<?php  



include '../db/db-connect.php';

$projID = $_GET['projID'];

$querymedia = "SELECT * FROM mj_fund_media WHERE mfm_id_fk = '$projID'";
$result = mysql_query($querymedia);


echo "<h4>Pictures</h4>";

while ($row = mysql_fetch_object($result)) {
	

	echo '<img src="'.$row->mfm_path.'" width="100" height="100" style="padding:5px; border:1px solid #f1f1f1; background-color:#fff; margin: 10px;" />';

}


?>