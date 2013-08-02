<?php  



include '../db/db-connect.php';


$mid        = $_GET['mid'];
$type		= 1; // 2 for video

$querymedia = "SELECT * FROM mj_market_media WHERE mmm_mp_id_fk = '$mid'";
$result     = mysql_query($querymedia);
$totalRow   = mysql_num_rows($result);


echo "<h4>Pictures</h4>";

if ($totalRow ==0) {
	echo "No picture yet. Upload pne or more.";
}
else {


	while ($row = mysql_fetch_object($result)) {
		

		echo '<img src="'.$row->mmm_path.'" width="100" height="100" style="background-color: #fff; padding:5px; border:1px solid #f1f1f1; margin:5px;" />';

	}

}


?>