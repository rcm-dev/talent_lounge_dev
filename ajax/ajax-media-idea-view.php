<?php  



include '../db/db-connect.php';

$midfk = $_GET['midfk'];

$querymedia = "SELECT * FROM mj_idea_media WHERE mi_id_fk = '$midfk'";
$result = mysql_query($querymedia);


echo "<h4>Pictures</h4>";

while ($row = mysql_fetch_object($result)) {
	

	echo '<img src="'.$row->mim_path.'" width="100" height="100" style="padding:5px; border:1px solid #f1f1f1; background-color:#fff; margin: 10px;" />';

}


?>