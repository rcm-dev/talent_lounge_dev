<?php require_once 'db/db-connect.php'; ?>
<?php  

$title         = htmlentities(mysql_real_escape_string($_POST['title']));
$body          = htmlentities(mysql_real_escape_string($_POST['body']));
$visual        = NULL;
$dateposted    = NULL;
$la_article_by = htmlentities(mysql_real_escape_string($_POST['byuser']));
$cat_id_fk     = htmlentities(mysql_real_escape_string($_POST['category_article']));

$query_rsInsertArticle = "INSERT INTO mj_learn_article (la_id, la_title, la_body, la_visual, la_dateposted, la_article_by, la_rat_up, la_rat_down, la_cat_id_fk, la_featured, `la_published`)
VALUES (NULL, '$title', '$body', NULL, CURRENT_TIMESTAMP, '$la_article_by',
                                                              0,
                                                              0,
                                                              '$cat_id_fk',
                                                              0,
                                                              0)";
$rsInsertArticle = mysql_query($query_rsInsertArticle) or die(mysql_error());


if ($rsInsertArticle) {
	echo "Successful post article.";
} else {
	echo "Error";
}

?>