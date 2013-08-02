<?php  


include '../db/db-connect.php';


$articleId = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['articleId'])));
$ratYes	   = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ratYes'])));


if ($ratYes == 1) {

	$ratYes = "UPDATE mj_fund_post SET fund_post_ratup = fund_post_ratup+1 WHERE fund_post_id = '$articleId'";

	$RratYes = mysql_query($ratYes);

} else {
	
	$ratYes = "UPDATE mj_fund_post SET fund_post_ratdown = fund_post_ratdown+1 WHERE fund_post_id = '$articleId'";

	$RratYes = mysql_query($ratYes);
}

?>