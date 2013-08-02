<?php  


include '../db/db-connect.php';


$articleId = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['articleId']);
$ratYes	   = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ratYes']);


if ($ratYes == 1) {

	$ratYes = "UPDATE mj_idea_post SET id_rat_up = id_rat_up+1 WHERE id_post_id = '$articleId'";

	$RratYes = mysql_query($ratYes);

} else {
	
	$ratYes = "UPDATE mj_idea_post SET id_rat_down = id_rat_down+1 WHERE id_post_id = '$articleId'";

	$RratYes = mysql_query($ratYes);
}

?>