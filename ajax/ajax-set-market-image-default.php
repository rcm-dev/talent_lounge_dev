<?php  


# db
include '../db/db-connect.php';

# data
$img_path = $_POST['img_path']; 
$ads_id = $_POST['ads_id'];

$type = $_POST['type'];



// echo $img_path.' and adsid '.$ads_id.' & type '.$type;
# if
if ($type == 'adsmarket') {
	
	$sqlUpdateMarketMedia = "UPDATE mj_market_post SET mrket_post_picture = '$img_path' WHERE mrket_post_id = '$ads_id'";
	$sqlUpdateMarketMediaResult = mysql_query($sqlUpdateMarketMedia);

	if ($sqlUpdateMarketMediaResult) {
		echo 1;
	}

}
elseif ($type == 'creativeidea') {
	$sqlUpdateMarketMedia = "UPDATE mj_idea_post SET id_pictures = '$img_path' WHERE id_post_id = '$ads_id'";
	$sqlUpdateMarketMediaResult = mysql_query($sqlUpdateMarketMedia);

	if ($sqlUpdateMarketMediaResult) {
		echo 1;
	}
}
elseif ($type == 'projectfunding') {
	$sqlUpdateMarketMedia = "UPDATE mj_fund_post SET fund_post_image = '$img_path' WHERE fund_post_id = '$ads_id'";
	$sqlUpdateMarketMediaResult = mysql_query($sqlUpdateMarketMedia);

	if ($sqlUpdateMarketMediaResult) {
		echo 1;
	}
}


?>