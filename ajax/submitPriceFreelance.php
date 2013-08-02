<?php  




include '../db/db-connect.php';

$priceRange = mysql_real_escape_string(intval($_GET['priceRange']));
$cuid = mysql_real_escape_string(intval($_GET['cuid']));
$jid = mysql_real_escape_string(intval($_GET['jid']));




echo $priceRange;

/****************************
 *
 * Record Set for InsertBidder 
 * MySQL Info 
 * Table Used InsertBidder
 *
 ***************************/

$query_rsInsertBidder = "INSERT INTO f_bid (fbid_id, fbid_user_id_fk, fbid_job_id_fk, fbid_price, fbid_dateposted) VALUES('', '$cuid', '$jid', '$priceRange', NOW())";
$result_rsInsertBidder = mysql_query($query_rsInsertBidder);

if ($result_rsInsertBidder) {
	echo 1;
} else {
	echo 0;
}




?>