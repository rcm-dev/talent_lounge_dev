<?php  


include '../db/db-connect.php';

// GET POST
$user_id				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['user_id'])));
$pro_cat				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['pro_cat'])));
$projectIdea			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['projectIdea'])));
$shortBrief				=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['shortBrief'])));
$businessModel			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['businessModel'])));
$customerMarket			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['customerMarket'])));
$accessTiming			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['accessTiming'])));
$economicTrends			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['economicTrends'])));
$techDevinnovation		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['techDevinnovation'])));
$ipRegulation			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ipRegulation'])));
$industryFuture			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['industryFuture'])));
$ideaDevelopment		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ideaDevelopment'])));
$FundingMilestones		=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['FundingMilestones'])));

$curr_proj_id			=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['curr_proj_id'])));



// INSERT SQL
$sql = "UPDATE mj_fund_post 
		SET fund_cat_id_fk = '$pro_cat',
		fund_post_title = '$projectIdea',
		fund_post_short_brief = '$shortBrief',
		fund_post_business_model = '$businessModel',
		fund_post_customer_market = '$customerMarket',
		fund_post_accesstiming = '$accessTiming',
		fund_post_economic_trends = '$economicTrends',
		fund_post_tech_dev_inno = '$techDevinnovation',
		fund_post_ip_regulation = '$ipRegulation',
		fund_post_industry_future = '$industryFuture',
		fund_post_idea_development = '$ideaDevelopment',
		fund_post_funding_miles = '$FundingMilestones'
		WHERE fund_usr_id_fk = '$user_id' 
		AND fund_post_id = '$curr_proj_id'";


$idea_result			=	mysql_query($sql);
//$idea_new_id			=	mysql_insert_id();

//echo $idea_new_id;

if ($idea_result) {
	echo 1;
}
else {
	echo 0;
}


?>