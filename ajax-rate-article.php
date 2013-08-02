<?php  


include '..db/db-connect.php';


$articleId = $_POST['articleId'];
$ratYes	   = $_POST['ratYes'];


if ($ratYes == 1) {

$ratYes = "UPDATE mojo.mj_learn_article SET la_rat_up = la_rat_up+1 
			WHERE mj_learn_article.la_id = '$articleId'";

$RratYes = mysql_query($ratYes);

}

?>