<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$comUsr 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['commentbody'])));
	$usr_id 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['usr_id'])));
	$la_id_fk 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['la_id_fk'])));

	mysql_query("INSERT INTO mj_fund_comment (fund_comment_id, fund_usr_id_fk, fund_post_id_fk, fund_comment_body) VALUES ('', '$usr_id', '$la_id_fk', '$comUsr')");


}


?>

<li class="comment-box">
	<span><?php echo $comUsr; ?></span>
</li>