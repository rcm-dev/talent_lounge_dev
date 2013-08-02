<?php  


include '../db/db-connect.php';


$articleId = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['articleId'])));
$ratYes	   = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ratYes'])));


if ($ratYes == 1) {

	$ratYes = "UPDATE mj_learn_article SET la_rat_up = la_rat_up+1 WHERE la_id = '$articleId'";

	$RratYes = mysql_query($ratYes);

} else {
	
	$ratYes = "UPDATE mj_learn_article SET la_rat_down = la_rat_down+1 WHERE la_id = '$articleId'";

	$RratYes = mysql_query($ratYes);
}

?>